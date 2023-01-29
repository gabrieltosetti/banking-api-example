<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Domain\Builders\BankAccountEntityBuilder;
use App\Domain\Repositories\BankAccountRepositoryInterface;
use App\Infrastructure\Models\BankAccount;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class RegisterConversation extends AbstractConversation
{
    protected BankAccountRepositoryInterface $bankAccountRepository;
    protected string $firstname;
    protected string $email;

    public function __construct(
        ConversationFactory $conversationFactory,
        BankAccountEntityBuilder $bankAccountEntityBuilder,
        BankAccountRepositoryInterface $bankAccountRepository
    ) {
        parent::__construct($conversationFactory, $bankAccountEntityBuilder);
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function run(): void
    {
        $this->askForPassword();
    }

    public function askForPassword(): void
    {
        $this->ask('Create your password', fn (Answer $answer) => $this->askForPasswordAnswer($answer));
    }

    public function askForPasswordAnswer(Answer $answer): void
    {
        $password = $answer->getText();

        // Create the user account
        $userAccount = new UserAccount();
        $userAccount->external_id = Uuid::uuid4()->toString();
        $userAccount->name = $this->bot->userStorage()->get('name');
        $userAccount->email = $this->bot->userStorage()->get('email');
        $userAccount->password = Hash::make($password);
        $userAccount->save();

        // create a bank account for the user
        $bankAccount = new BankAccount();
        $bankAccount->external_id = Uuid::uuid4()->toString();
        $bankAccount->user_account_id = $userAccount->id;
        $bankAccount->currency_id = Currency::findByCode('USD')->id;
        $bankAccount->balance = 0.0;
        $bankAccount->save();

        $bankAccountEntity = $this->bankAccountRepository->findByUserAccountEmail($userAccount->email);

        $this->say('Thanks, your account has been created');
        $this->startMenuConversation($bankAccountEntity->toArray());
    }
}
