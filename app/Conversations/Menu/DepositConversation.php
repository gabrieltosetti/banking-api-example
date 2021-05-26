<?php

namespace App\Conversations\Menu;

use App\Conversations\MenuConversation;
use App\Models\Currency;
use App\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Utils\UserBankManager;

class DepositConversation extends Conversation
{
    protected UserAccount $userAccount;
    protected float $depositAmmount;
    protected ?Currency $currency;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function askForDepositAmmount()
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->ask('How much do you like to deposit (eg. 1.00)?', function (Answer $answer) {
            $this->depositAmmount = $answer->getText();

            if (!is_numeric($this->depositAmmount)) {
                $this->say("Only numbers please");
                return $this->repeat();
            }

            if ($this->depositAmmount <= 0) {
                $this->say("Greater than 0");
                return $this->repeat();
            }

            $this->depositAmmount = floor((float) $this->depositAmmount * 100) / 100;

            return $this->askToChangeCurrency();
        });
    }

    public function askToChangeCurrency()
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

            // Set the currency from the default bank account
            $this->currency = $this->userAccount->bankAccount->currency;

            return $this->depositAmmount();
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

            return $this->depositAmmount();
        });
    }

    public function depositAmmount()
    {
        $userBankManager = new UserBankManager($this->userAccount);
        $userBankManager->deposit($this->depositAmmount, $this->currency);

        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("All done! Your balance now is $" . $balance . " $code");

        return $this->bot->startConversation(new MenuConversation($this->userAccount));
    }

    public function run()
    {
        $this->askForDepositAmmount();
    }
}
