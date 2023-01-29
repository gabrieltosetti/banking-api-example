<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\ValueObjects\CurrencyValueObject;
use App\Library\Carbon;

class TransactionEntity extends AbstractEntity
{
    private string $bankAccountId;
    private string $bankAccountCurrencyId;
    private string $targetCurrencyId;
    private float $value;
    private float $rate;
    private float $type;
    private Carbon $createdAt;
    private ?CurrencyValueObject $bankAccountCurrency = null;
    private ?CurrencyValueObject $targetCurrency = null;

    public function getBankAccountId(): string
    {
        return $this->bankAccountId;
    }

    public function setBankAccountId(string $bankAccountId): self
    {
        $this->bankAccountId = $bankAccountId;
        return $this;
    }

    public function getBankAccountCurrencyId(): string
    {
        return $this->bankAccountCurrencyId;
    }

    public function setBankAccountCurrencyId(string $bankAccountCurrencyId): self
    {
        $this->bankAccountCurrencyId = $bankAccountCurrencyId;
        return $this;
    }

    public function getTargetCurrencyId(): string
    {
        return $this->targetCurrencyId;
    }

    public function setTargetCurrencyId(string $targetCurrencyId): self
    {
        $this->targetCurrencyId = $targetCurrencyId;
        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;
        return $this;
    }

    public function getType(): float
    {
        return $this->type;
    }

    public function setType(float $type): self
    {
        $this->type = $type;
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

    public function getBankAccountCurrency(): ?CurrencyValueObject
    {
        return $this->bankAccountCurrency;
    }

    public function setBankAccountCurrency(?CurrencyValueObject $bankAccountCurrency): self
    {
        $this->bankAccountCurrency = $bankAccountCurrency;
        return $this;
    }

    public function getTargetCurrency(): ?CurrencyValueObject
    {
        return $this->targetCurrency;
    }

    public function setTargetCurrency(?CurrencyValueObject $targetCurrency): self
    {
        $this->targetCurrency = $targetCurrency;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'bank_account_id' => $this->getBankAccountId(),
            'bank_account_currency_id' => $this->getBankAccountCurrencyId(),
            'target_currency_id' => $this->getTargetCurrencyId(),
            'value' => $this->getValue(),
            'rate' => $this->getRate(),
            'type' => $this->getType(),
            'created_at' => $this->getCreatedAt()->toISOString(),
            'bank_account_currency' => $this->getBankAccountCurrency()
                ? $this->getBankAccountCurrency()->toArray()
                : null,
            'target_currency' => $this->getTargetCurrency() ? $this->getTargetCurrency()->toArray() : null,
        ];
    }
}
