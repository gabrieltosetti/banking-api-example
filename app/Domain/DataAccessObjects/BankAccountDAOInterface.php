<?php

declare(strict_types=1);

namespace App\Domain\DataAccessObjects;

use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\UserAccountEntity;

interface BankAccountDAOInterface
{
    public function findById(string $externalId): BankAccountEntity;
    public function findByUserAccount(UserAccountEntity $userAccountEntity): BankAccountEntity;
}