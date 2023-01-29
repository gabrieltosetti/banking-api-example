<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\UserAccountEntity;

interface BankAccountRepositoryInterface
{
    public function findByUserAccount(UserAccountEntity $userAccountEntity): BankAccountEntity;
    public function findByUserAccountEmail(string $email): ?BankAccountEntity;
    public function findById(string $id): BankAccountEntity;
}