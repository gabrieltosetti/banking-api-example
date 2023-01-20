<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations\Menu;

use App\Domain\Utils\UserBankManager;
use App\Infrastructure\Conversations\Conversation;
use App\Infrastructure\Conversations\ConversationFactory;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class WithdrawConversation extends Conversation
{
    private const CURRENCY_YES = 1;
    private const CURRENCY_NO = 2;
    
    protected UserAccount $userAccount;
    protected Currency $currency;
    protected float $withdrawAmmount;

    public function __construct(
        ConversationFactory $conversationFactory,
        UserAccount $userAccount
    ) {
        parent::__construct($conversationFactory);
        $this->userAccount = $userAccount;
        $this->currency = $this->userAccount->bankAccount->currency;
    }

    public function run(): void
    {
        $this->askForWithdrawAmmount();
    }

    public function askForWithdrawAmmount(): void
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->ask(
            'How much do you like to withdraw (eg. 1.00)?',
            fn (Answer $answer) => $this->askForWithdrawAmmountAnswer($answer)
        );
    }

    public function askForWithdrawAmmountAnswer(Answer $answer): void
    {
        $withdrawAmmount = $answer->getText();

        if (!is_numeric($withdrawAmmount)) {
            $this->say("Only numbers please");
            $this->repeat();
            return;
        }

        $withdrawAmmount = (float) $withdrawAmmount;

        if ($withdrawAmmount <= 0) {
            $this->say("Ammount must be greater than 0");
            $this->repeat();
            return;
        }

        $this->withdrawAmmount = floor($withdrawAmmount * 100) / 100;

        $this->askToChangeCurrency();
    }

    public function askToChangeCurrency(): void
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $description = $this->userAccount->bankAccount->currency->description;

        $question = Question::create("Your account is using $code ($description). Do you want to change it?")
            ->fallback('Invalid option')
            ->callbackId('ask_for_currency')
            ->addButtons([
                Button::create('1.Yes')->value(1),
                Button::create('2.No')->value(2),
            ]);

        $this->ask($question, fn (Answer $answer) => $this->askToChangeCurrencyAnswer($answer));
    }

    public function askToChangeCurrencyAnswer(Answer $answer): void
    {
        $selectedValue = (int) $answer->getText();

        if ($this->buttonWasPressed($answer)) {
            $selectedValue = (int) $answer->getValue();
        }

        if ($selectedValue !== self::CURRENCY_YES && $selectedValue !== self::CURRENCY_NO) {
            $this->say("Invalid option");
            $this->repeat();
            return;
        }

        $selectedValue === self::CURRENCY_YES
            ? $this->askForNewCurrency()
            : $this->withdrawAmmount();
    }

    public function askForNewCurrency(): void
    {
        $this->ask(
            'Please inform the currency code (eg. USD, EUR, BRL)',
            fn (Answer $answer) => $this->askForNewCurrencyAnswer($answer)
        );
    }

    public function askForNewCurrencyAnswer(Answer $answer): void
    {
        $currencyCode = strtoupper(trim($answer->getText()));

        if (strlen($currencyCode) !== 3) {
            $this->say("Currency codes have exactly 3 characters");
            $this->repeat();
            return;
        }

        // TODO: Change this to a repository
        $this->currency = Currency::findByCode($currencyCode);

        if (!$this->currency) {
            $this->say("We don't work with this currency yet, sorry.");
            $this->repeat();
            return;
        }

        $this->withdrawAmmount();
    }

    public function withdrawAmmount(): void
    {
        try {
            // TODO: Change this to a service
            $userBankManager = new UserBankManager($this->userAccount);
            $userBankManager->withdraw($this->withdrawAmmount, $this->currency);
        } catch (\Throwable $ex) {
            $this->say('Error while withdrawing: ' . $ex->getMessage());
            throw $ex;
        }

        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("All done! Your balance now is $" . $balance . " $code");

        $this->startMenuConversation($this->userAccount);
    }
}
