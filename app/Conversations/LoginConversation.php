<?php

namespace App\Conversations;

use App\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Hash;

class LoginConversation extends Conversation
{
    protected ?UserAccount $user = null;

    public function askFirstname()
    {
        $this->ask('Hello! What is your first name?', function (Answer $answer) {
            $name = $answer->getText();

            $this->bot->userStorage()->save([
                'name' => $name
            ]);

            $this->say('Nice to meet you ' . $name);
            $this->askForEmail();
        });
    }

    public function askForEmail()
    {
        $this->ask('What is your email?', function (Answer $answer) {
            $email = $answer->getText();
            $this->bot->userStorage()->save([
                'email' => $email
            ]);

            $this->user = UserAccount::where('email', $email)->first();

            if (!$this->user) {
                $this->say("I see that you don't have a account. Let's create one!");
                return $this->bot->startConversation(new RegisterConversation());
            }

            $this->say("You already have a account. Let's login!");
            $this->askForPassword();
        });
    }

    public function askForPassword()
    {
        $this->ask('Enter the account password', function (Answer $answer) {
            $password = $answer->getText();

            if (!Hash::check($password, $this->user->password)) {
                $this->say("Sorry, try again!");
                return $this->repeat();
            }

            $this->bot->startConversation(new MenuConversation($this->user));
        });
    }

    public function run()
    {
        $this->bot->userStorage()->delete();
        $this->askFirstname();
    }
}
