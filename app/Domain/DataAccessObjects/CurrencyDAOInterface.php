<?php

declare(strict_types=1);

namespace App\Domain\DataAccessObjects;

use App\Domain\Entities\BankAccountEntity;
use App\Domain\ValueObjects\CurrencyValueObject;

interface CurrencyDAOInterface
{
    public function findByBankAccount(BankAccountEntity $bankAccountEntity): CurrencyValueObject;
}