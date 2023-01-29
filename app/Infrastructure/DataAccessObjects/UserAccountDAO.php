<?php

declare(strict_types=1);

namespace App\Infrastructure\DataAccessObjects;

use App\Domain\Builders\UserAccountEntityBuilder;
use App\Domain\DataAccessObjects\UserAccountDAOInterface;
use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\UserAccountEntity;
use App\Infrastructure\Models\UserAccount;

/**
 * @extends AbstractDAO<UserAccount>
 */
class UserAccountDAO extends AbstractDAO implements UserAccountDAOInterface
{
    private UserAccountEntityBuilder $userAccountEntityBuilder;

    public function __construct(
        UserAccount $model,
        UserAccountEntityBuilder $userAccountEntityBuilder
    ) {
        $this->model = $model;
        $this->userAccountEntityBuilder = $userAccountEntityBuilder;
    }

    public function findByBankAccount(BankAccountEntity $bankAccountEntity): ?UserAccountEntity
    {
        /** @var UserAccount|null */
        $userAccountModel = $this->model
            ->newQuery()
            ->where('external_id', $bankAccountEntity->getUserAccountId())
            ->first();

        if (!$userAccountModel) {
            throw new \Exception('User account not found', 404);
        }

        return $this->userAccountEntityBuilder->setFromArray($userAccountModel->toArray())->get();
    }

    public function findByEmail(string $email): UserAccountEntity
    {
        /** @var UserAccount|null */
        $userAccountModel = $this->model->newQuery()->where('email', $email)->first();

        if (!$userAccountModel) {
            throw new \Exception('User account not found', 404);
        }

        return $this->userAccountEntityBuilder->setFromArray($userAccountModel->toArray())->get();
    }
}
