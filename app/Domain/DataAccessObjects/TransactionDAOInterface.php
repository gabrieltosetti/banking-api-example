<?php

declare(strict_types=1);

namespace App\Domain\DataAccessObjects;

use App\Domain\Collections\TransactionEntityCollection;
use App\Domain\Entities\BankAccountEntity;

interface TransactionDAOInterface
{
    public function findByBankAccount(BankAccountEntity $bankAccountEntity): ?TransactionEntityCollection;
}