<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Infrastructure\Models\UserAccount;

interface UserAccountRepositoryInterface
{
    public function findByEmail(string $email): ?UserAccount;
}