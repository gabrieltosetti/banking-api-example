<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Collections\TransactionEntityCollection;
use App\Domain\ValueObjects\CurrencyValueObject;
use App\Library\Carbon;

class BankAccountEntity extends AbstractEntity
{
    private string $userAccountId;
    private string $currencyId;
    private float $balance;
    private Carbon $createdAt;
    private Carbon $updatedAt;
    private ?UserAccountEntity $userAccount = null;
    private ?CurrencyValueObject $currency = null;
    private ?TransactionEntityCollection $transactions = null;

    public function getUserAccountId(): string
    {
        return $this->userAccountId;
    }

    public function setUserAccountId(string $userAccountId): self
    {
        $this->userAccountId = $userAccountId;
        return $this;
    }

    public function getCurrencyId(): string
    {
        return $this->currencyId;
    }

    public function setCurrencyId(string $currencyId): self
    {
        $this->currencyId = $currencyId;
        return $this;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;
        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Carbon $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(Carbon $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUserAccount(): UserAccountEntity
    {
        return $this->userAccount;
    }

    public function setUserAccount(UserAccountEntity $userAccount): self
    {
        $this->userAccount = $userAccount;
        return $this;
    }

    public function getCurrency(): CurrencyValueObject
    {
        return $this->currency;
    }

    public function setCurrency(CurrencyValueObject $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getTransactions(): ?TransactionEntityCollection
    {
        return $this->transactions;
    }

    public function setTransactions(?TransactionEntityCollection $transactions): self
    {
        $this->transactions = $transactions;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'user_account_id' => $this->getUserAccountId(),
            'currency_id' => $this->getCurrencyId(),
            'balance' => $this->getBalance(),
            'created_at' => $this->getCreatedAt()->toIso8601String(),
            'updated_at' => $this->getUpdatedAt()->toIso8601String(),
            'user_account' => $this->userAccount->toArray(),
            'currency' => $this->currency->toArray(),
            'transactions' => $this->getTransactions() ? $this->getTransactions()->dataToArray() : null,
        ];
    }
}
