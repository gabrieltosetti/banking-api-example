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

class ChangeCurrencyConversation extends Conversation
{
    private const CURRENCY_YES = 1;
    private const CURRENCY_NO = 2;

    protected UserAccount $userAccount;
    protected ?Currency $currency;

    public function __construct(
        ConversationFactory $conversationFactory,
        UserAccount $userAccount
    ) {
        parent::__construct($conversationFactory);
        $this->userAccount = $userAccount;
    }

    public function run(): void
    {
        $this->askForConfirmation();
    }

    public function askForConfirmation(): void
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->say('If you change the currency of your account, all the balance will be exchanged');

        $question = Question::create("Do you want to continue?")
            ->fallback('Invalid option')
            ->callbackId('ask_for_exchange_confirmation')
            ->addButtons([
                Button::create('1.Yes')->value(1),
                Button::create('2.No')->value(2),
            ]);

        $this->ask($question, fn (Answer $answer) => $this->askForConfirmationAnswer($answer));
    }

    public function askForConfirmationAnswer(Answer $answer): void
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
            : $this->startMenuConversation($this->userAccount);
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

        if ($this->userAccount->bankAccount->currency->id === $this->currency->id) {
            $this->say("This is already your account currency");
            $this->repeat();
            return;
        }

        $this->exchangeBalance();
    }

    public function exchangeBalance(): void
    {
        // TODO: Change this to a service
        $userBankManager = new UserBankManager($this->userAccount);
        $userBankManager->setDefaultCurrency($this->currency);

        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("All done! Your balance now is $" . $balance . " $code");

        $this->startMenuConversation($this->userAccount);
    }
}
