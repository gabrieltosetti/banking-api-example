<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\UserAccountRepositoryInterface;
use App\Infrastructure\Models\UserAccount;

/**
 * @inherits AbstractRepository<UserAccount>
 * @property UserAccount $model
 */
class UserAccountRepository extends AbstractRepository implements UserAccountRepositoryInterface
{
    public function __construct(UserAccount $userAccountModel)
    {
        parent::__construct($userAccountModel);
    }

    public function findByEmail(string $email): ?UserAccount
    {
        return $this->model->newQuery()->where('email', $email)->first();
    }
}