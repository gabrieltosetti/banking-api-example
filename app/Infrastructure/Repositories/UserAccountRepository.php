<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\DataAccessObjects\UserAccountDAOInterface;
use App\Domain\Entities\UserAccountEntity;
use App\Domain\Repositories\UserAccountRepositoryInterface;

class UserAccountRepository extends AbstractRepository implements UserAccountRepositoryInterface
{
    private UserAccountDAOInterface $userAccountDAO;

    public function __construct(UserAccountDAOInterface $userAccountDAO)
    {
        $this->userAccountDAO = $userAccountDAO;
    }

    public function findByEmail(string $email): ?UserAccountEntity
    {
        return $this->userAccountDAO->findByEmail($email);
    }
}
