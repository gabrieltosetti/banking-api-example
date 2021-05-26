<?php

namespace App\Conversations\Menu;

use App\Conversations\MenuConversation;
use App\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;

class WithdrawConversation extends Conversation
{
    protected UserAccount $userAccount;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function askForCurrency()
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("You have $" . $balance . " $code");

        return $this->bot->startConversation(new MenuConversation($this->userAccount));
    }

    public function run()
    {
        $this->askForCurrency();
    }
}
