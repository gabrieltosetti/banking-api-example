<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Domain\Builders\BankAccountEntityBuilder;
use App\Domain\Entities\BankAccountEntity;
use App\Domain\Repositories\BankAccountRepositoryInterface;
use BotMan\BotMan\Messages\Incoming\Answer;

class LoginConversation extends AbstractConversation
{
    protected ?array $bankAccountEntityArray = null;
    protected BankAccountRepositoryInterface $bankAccountRepository;
    protected BankAccountEntityBuilder $bankAccountEntityBuilder;

    public function __construct(
        ConversationFactory $conversationFactory,
        BankAccountRepositoryInterface $bankAccountRepository,
        BankAccountEntityBuilder $bankAccountEntityBuilder
    ) {
        parent::__construct($conversationFactory);
        $this->bankAccountRepository = $bankAccountRepository;
        $this->bankAccountEntityBuilder = $bankAccountEntityBuilder;
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

        try {
            $this->bankAccountEntityArray = $this->bankAccountRepository->findByUserAccountEmail($email)->toArray();
        } catch (\Throwable $e) {
            if ($e->getCode() !== 404) {
                throw $e;
            }

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
        $bankAccount = $this->bankAccountEntityBuilder->setFromArray($this->bankAccountEntityArray)->get();

        if (!$bankAccount->getUserAccount()->checkPassword($password)) {
            $this->say("Sorry, try again!");
            $this->repeat();
            return;
        }

        $this->startMenuConversation($this->bankAccountEntityArray);
    }
}
