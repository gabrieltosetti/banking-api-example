<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

class CurrencyValueObject extends AbstractValueObject
{
    private string $code;
    private string $description;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'description' => $this->getDescription(),
        ];
    }
}