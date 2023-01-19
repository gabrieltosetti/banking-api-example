<?php

namespace App\Infrastructure\Conversations\Menu;

use App\Infrastructure\Conversations\MenuConversation;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BalanceConversation extends Conversation
{
    protected UserAccount $userAccount;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function showBalance()
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        return $this->bot->startConversation(new MenuConversation($this->userAccount));
    }

    public function run()
    {
        $this->showBalance();
    }
}
