<?php

namespace App\Conversations\Menu;

use App\Conversations\MenuConversation;
use App\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class ChangeCurrencyConversation extends Conversation
{
    protected UserAccount $userAccount;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function askForCurrency()
    {
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

    public function run()
    {
        $this->askForCurrency();
    }
}
