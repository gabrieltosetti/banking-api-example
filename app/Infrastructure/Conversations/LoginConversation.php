<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Domain\Repositories\UserAccountRepositoryInterface;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Hash;

class LoginConversation extends Conversation
{
    protected ?UserAccount $user = null;
    protected UserAccountRepositoryInterface $userAccountRepository;

    public function __construct(
        ConversationFactory $conversationFactory,
        UserAccountRepositoryInterface $userAccountRepository
    ) {
        parent::__construct($conversationFactory);
        $this->userAccountRepository = $userAccountRepository;
    }

    public function run(): void
    {
        $this->bot->userStorage()->delete();
        $this->askFirstname();
    }

    public function askFirstname(): void
    {
        $this->ask('Hello! What is your first name?', fn (Answer $answer) => $this->askFirstnameAnswer($answer));
    }
    
    public function askFirstnameAnswer(Answer $answer): void
    {
        $name = $answer->getText();

        $this->bot->userStorage()->save(['name' => $name]);

        $this->say('Nice to meet you ' . $name);
        $this->askForEmail();
    }

    public function askForEmail(): void
    {
        $this->ask('What is your email?', fn (Answer $answer) => $this->askForEmailAnswer($answer));
    }

    public function askForEmailAnswer(Answer $answer): void
    {
        $email = $answer->getText();
        $this->bot->userStorage()->save([
            'email' => $email
        ]);

        $this->user = $this->userAccountRepository->findByEmail($email);

        if (!$this->user) {
            $this->say("I see that you don't have a account. Let's create one!");
            $this->startRegisterConversation();
            return;
        }

        $this->say("You already have a account. Let's login!");
        $this->askForPassword();
    }

    public function askForPassword(): void
    {
        $this->ask('Enter the account password', fn (Answer $answer) => $this->askForPasswordAnswer($answer));
    }

    public function askForPasswordAnswer(Answer $answer): void
    {
        $password = $answer->getText();

        if (!Hash::check($password, $this->user->password)) {
            $this->say("Sorry, try again!");
            $this->repeat();
            return;
        }

        $this->startMenuConversation($this->user);
    }
}
