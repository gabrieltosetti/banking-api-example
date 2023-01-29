<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations\Menu;

use App\Domain\Builders\BankAccountEntityBuilder;
use App\Domain\Builders\CurrencyValueObjectBuilder;
use App\Domain\Utils\UserBankManager;
use App\Infrastructure\Conversations\AbstractConversation;
use App\Infrastructure\Conversations\ConversationFactory;
use App\Infrastructure\DataAccessObjects\CurrencyDAO;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ChangeCurrencyConversation extends AbstractConversation
{
    private const CURRENCY_YES = 1;
    private const CURRENCY_NO = 2;

    protected BankAccountEntityBuilder $bankAccountEntityBuilder;
    protected CurrencyValueObjectBuilder $currencyValueObjectBuilder;
    protected CurrencyDAO $currencyDAO;

    protected array $bankAccountEntityArray;
    protected ?array $currencyArray;

    public function __construct(
        ConversationFactory $conversationFactory,
        BankAccountEntityBuilder $bankAccountEntityBuilder,
        CurrencyValueObjectBuilder $currencyValueObjectBuilder,
        CurrencyDAO $currencyDAO,
        array $bankAccountEntityArray
    ) {
        parent::__construct($conversationFactory);
        $this->bankAccountEntityArray = $bankAccountEntityArray;
        $this->bankAccountEntityBuilder = $bankAccountEntityBuilder;
        $this->currencyValueObjectBuilder = $currencyValueObjectBuilder;
        $this->currencyDAO = $currencyDAO;
    }

    public function run(): void
    {
        $this->askForConfirmation();
    }

    public function askForConfirmation(): void
    {
        $bankAccount = $this->bankAccountEntityBuilder->setFromArray($this->bankAccountEntityArray)->get();
        $code = $bankAccount->getCurrency()->getCode();
        $balance = number_format($bankAccount->getBalance(), 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->say('If you change the currency of your account, all the balance will be exchanged');

        $question = Question::create("Do you want to continue?")
            ->fallback('Invalid option')
            ->callbackId('ask_for_exchange_confirmation')
            ->addButtons([
                Button::create('1.Yes')->value(self::CURRENCY_YES),
                Button::create('2.No')->value(self::CURRENCY_NO),
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
            : $this->startMenuConversation($this->bankAccountEntityArray);
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

        try {
            $currency = $this->currencyDAO->findByCode($currencyCode);
        } catch (\Throwable $e) {
            $this->say("We don't work with this currency yet, sorry.");
            $this->repeat();
            return;
        }

        $this->currencyArray = $currency->toArray();
        $bankAccount = $this->bankAccountEntityBuilder->setFromArray($this->bankAccountEntityArray)->get();

        if ($bankAccount->getCurrency()->equals($currency)) {
            $this->say("This is already your account currency");
            $this->repeat();
            return;
        }

        $this->exchangeBalance();
    }

    public function exchangeBalance(): void
    {
        $bankAccount = $this->bankAccountEntityBuilder->setFromArray($this->bankAccountEntityArray)->get();
        $currency = $this->currencyValueObjectBuilder->setFromArray($this->currencyArray)->get();

        // TODO: Change this to a service
        $userBankManager = new UserBankManager();
        $bankAccount = $userBankManager->setDefaultCurrency($bankAccount, $currency);

        $this->bankAccountEntityArray = $bankAccount->toArray();

        $code = $bankAccount->getCurrency()->getCode();
        $balance = number_format($bankAccount->getBalance(), 2, ',', '.');

        $this->say("All done! Your balance now is $" . $balance . " $code");

        $this->startMenuConversation($this->bankAccountEntityArray);
    }
}
