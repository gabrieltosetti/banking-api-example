<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations\Menu;

use App\Infrastructure\Conversations\Conversation;
use App\Infrastructure\Conversations\ConversationFactory;
use App\Infrastructure\Models\UserAccount;

class BalanceConversation extends Conversation
{
    protected UserAccount $userAccount;

    public function __construct(
        ConversationFactory $conversationFactory,
        UserAccount $userAccount
    ) {
        parent::__construct($conversationFactory);
        $this->userAccount = $userAccount;
    }

    public function run()
    {
        $this->showBalance();
    }

    public function showBalance()
    {
        $code = $this->userAccount->bankAccount->currency->code;
        $balance = $this->userAccount->bankAccount->balance;
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->startMenuConversation($this->userAccount);
    }
}
