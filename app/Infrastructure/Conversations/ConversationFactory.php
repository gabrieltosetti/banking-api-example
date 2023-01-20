<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Domain\Repositories\UserAccountRepositoryInterface;
use App\Infrastructure\Conversations\Menu\BalanceConversation;
use App\Infrastructure\Conversations\Menu\ChangeCurrencyConversation;
use App\Infrastructure\Conversations\Menu\DepositConversation;
use App\Infrastructure\Conversations\Menu\WithdrawConversation;
use App\Infrastructure\Models\UserAccount;

class ConversationFactory
{
    private UserAccountRepositoryInterface $userAccountRepository;

    public function __construct(
        UserAccountRepositoryInterface $userAccountRepository
    ) {
        $this->userAccountRepository = $userAccountRepository;
    }

    public function createMenuConversation(UserAccount $userAccount): MenuConversation
    {
        return new MenuConversation(clone $this, $userAccount);
    }

    public function createLoginConversation(): LoginConversation
    {
        return new LoginConversation($this, $this->userAccountRepository);
    }

    public function createRegisterConversation(): RegisterConversation
    {
        return new RegisterConversation($this, $this->userAccountRepository);
    }

    public function createBalanceConversation(UserAccount $userAccount): BalanceConversation
    {
        return new BalanceConversation($this, $userAccount);
    }

    public function createChangeCurrencyConversation(UserAccount $userAccount): ChangeCurrencyConversation
    {
        return new ChangeCurrencyConversation($this, $userAccount);
    }

    public function createDepositConversation(UserAccount $userAccount): DepositConversation
    {
        return new DepositConversation($this, $userAccount);
    }

    public function createWithdrawConversation(UserAccount $userAccount): WithdrawConversation
    {
        return new WithdrawConversation($this, $userAccount);
    }
}
