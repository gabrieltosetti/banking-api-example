<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Domain\Builders\BankAccountEntityBuilder;
use App\Domain\Builders\CurrencyValueObjectBuilder;
use App\Domain\Repositories\BankAccountRepositoryInterface;
use App\Infrastructure\Conversations\Menu\BalanceConversation;
use App\Infrastructure\Conversations\Menu\ChangeCurrencyConversation;
use App\Infrastructure\Conversations\Menu\DepositConversation;
use App\Infrastructure\Conversations\Menu\WithdrawConversation;
use App\Infrastructure\DataAccessObjects\CurrencyDAO;

class ConversationFactory
{
    private BankAccountRepositoryInterface $bankAccountRepository;
    private BankAccountEntityBuilder $bankAccountEntityBuilder;
    private CurrencyValueObjectBuilder $currencyValueObjectBuilder;
    private CurrencyDAO $currencyDAO;

    public function __construct(
        BankAccountRepositoryInterface $bankAccountRepository,
        BankAccountEntityBuilder $bankAccountEntityBuilder,
        CurrencyValueObjectBuilder $currencyValueObjectBuilder,
        CurrencyDAO $currencyDAO
    ) {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->bankAccountEntityBuilder = $bankAccountEntityBuilder;
        $this->currencyValueObjectBuilder = $currencyValueObjectBuilder;
        $this->currencyDAO = $currencyDAO;
    }

    public function createMenuConversation(array $bankAccountEntityArray): MenuConversation
    {
        return new MenuConversation(
            clone $this,
            $this->bankAccountEntityBuilder,
            $bankAccountEntityArray
        );
    }

    public function createLoginConversation(): LoginConversation
    {
        return new LoginConversation(
            $this,
            $this->bankAccountRepository,
            $this->bankAccountEntityBuilder
        );
    }

    public function createRegisterConversation(): RegisterConversation
    {
        return new RegisterConversation(
            $this,
            $this->bankAccountEntityBuilder,
            $this->bankAccountRepository
        );
    }

    public function createBalanceConversation(array $bankAccountEntityArray): BalanceConversation
    {
        return new BalanceConversation(
            $this,
            $this->bankAccountEntityBuilder,
            $bankAccountEntityArray
        );
    }

    public function createChangeCurrencyConversation(array $bankAccountEntityArray): ChangeCurrencyConversation
    {
        return new ChangeCurrencyConversation(
            $this,
            $this->bankAccountEntityBuilder,
            $this->currencyValueObjectBuilder,
            $this->currencyDAO,
            $bankAccountEntityArray
        );
    }

    public function createDepositConversation(array $bankAccountEntityArray): DepositConversation
    {
        return new DepositConversation(
            $this,
            $this->bankAccountEntityBuilder,
            $this->currencyValueObjectBuilder,
            $this->currencyDAO,
            $bankAccountEntityArray
        );
    }

    public function createWithdrawConversation(array $bankAccountEntityArray): WithdrawConversation
    {
        return new WithdrawConversation(
            $this,
            $this->bankAccountEntityBuilder,
            $bankAccountEntityArray
        );
    }
}
