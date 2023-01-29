<?php

declare(strict_types=1);

namespace App\Domain\DataAccessObjects;

use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\UserAccountEntity;

interface UserAccountDAOInterface
{
    public function findByBankAccount(BankAccountEntity $bankAccountEntity): ?UserAccountEntity;
    public function findByEmail(string $email): ?UserAccountEntity;
}