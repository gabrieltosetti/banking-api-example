<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Infrastructure\Models\BankAccount;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Hash;

class RegisterConversation extends Conversation
{
    protected string $firstname;
    protected string $email;

    public function askForPassword()
    {
        $this->ask('Create your password', function(Answer $answer) {
            $password = $answer->getText();

            // Create the user account
            $userAccount = new UserAccount();
            $userAccount->name = $this->bot->userStorage()->get('name');
            $userAccount->email = $this->bot->userStorage()->get('email');
            $userAccount->password = Hash::make($password);
            $userAccount->save();

            // create a bank account for the user
            $bankAccount = new BankAccount();
            $bankAccount->user_account_id = $userAccount->id;
            $bankAccount->currency_id = Currency::findByCode('USD')->id;
            $bankAccount->balance = 0.0;
            $bankAccount->save();

            $this->say('Thanks, your account has been created');
            $this->bot->startConversation(new MenuConversation($userAccount));
        });
    }

    public function run()
    {
        $this->askForPassword();
    }
}