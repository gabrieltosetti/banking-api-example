<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations\Menu;

use App\Infrastructure\Conversations\MenuConversation;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Utils\Domain\UserBankManager;

class ChangeCurrencyConversation extends Conversation
{
    protected UserAccount $userAccount;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function askForConfirmation()
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

        $this->ask($question, function (Answer $answer) {
            $selectedValue = (int) $answer->getText();

            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = (int) $answer->getValue();
            }

            if ($selectedValue !== 1 && $selectedValue !== 2) {
                $this->say("Invalid option");
                return $this->repeat();
            }

            // Yes
            if ($selectedValue === 1) {
                return $this->askForNewCurrency();
            }

            return $this->bot->startConversation(new MenuConversation($this->userAccount));
        });
    }

    public function askForNewCurrency()
    {
        $this->ask('Please inform the currency code (eg. USD, EUR, BRL)', function (Answer $answer) {
            $currencyCode = strtoupper(trim($answer->getText()));

            if (strlen($currencyCode) !== 3) {
                $this->say("Currency codes have exactly 3 characters");
                return $this->repeat();
            }

            $this->currency = Currency::findByCode($currencyCode);

            if (!$this->currency) {
                $this->say("We don't work with this currency yet, sorry.");
                return $this->repeat();
            }

            if ($this->userAccount->bankAccount->currency->id === $this->currency->id) {
                $this->say("This is already your account currency");
                return $this->repeat();
            }

            return $this->exchangeBalance();
        });
    }

    public function exchangeBalance()
    {
        $userBankManager = new UserBankManager($this->userAccount);
        $userBankManager->setDefaultCurrency($this->currency);

        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("All done! Your balance now is $" . $balance . " $code");

        return $this->bot->startConversation(new MenuConversation($this->userAccount));
    }

    public function run()
    {
        $this->askForConfirmation();
    }
}
