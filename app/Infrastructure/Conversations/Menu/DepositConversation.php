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

class DepositConversation extends Conversation
{
    private const CURRENCY_YES = 1;
    private const CURRENCY_NO = 2;

    protected UserAccount $userAccount;
    protected ?Currency $currency;
    protected float $depositAmmount;

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
        $this->askForDepositAmmount();
    }

    public function askForDepositAmmount(): void
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->ask(
            'How much do you like to deposit (eg. 1.00)?',
            fn (Answer $answer) => $this->askForDepositAmmountAnswer($answer)
        );
    }

    public function askForDepositAmmountAnswer(Answer $answer): void
    {
        $depositAmmount = $answer->getText();

        if (!is_numeric($depositAmmount)) {
            $this->say("Only numbers please");
            $this->repeat();
            return;
        }

        $depositAmmount = (float) $depositAmmount;

        if ($depositAmmount <= 0) {
            $this->say("Ammount must be greater than 0");
            $this->repeat();
            return;
        }

        $this->depositAmmount = floor($depositAmmount * 100) / 100;

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
            : $this->depositAmmount();
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

        $this->depositAmmount();
    }

    public function depositAmmount(): void
    {
        // TODO: Change this to a service
        $userBankManager = new UserBankManager($this->userAccount);
        $userBankManager->deposit($this->depositAmmount, $this->currency);

        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("All done! Your balance now is $" . $balance . " $code");

        $this->startMenuConversation($this->userAccount);
    }
}
