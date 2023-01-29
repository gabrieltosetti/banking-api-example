<?php

declare(strict_types=1);

namespace App\Infrastructure\DataAccessObjects;

use App\Domain\Builders\BankAccountEntityBuilder;
use App\Domain\DataAccessObjects\BankAccountDAOInterface;
use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\UserAccountEntity;
use App\Infrastructure\Models\BankAccount;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\UserAccount;

/**
 * @extends AbstractDAO<BankAccount>
 */
class BankAccountDAO extends AbstractDAO implements BankAccountDAOInterface
{
    private BankAccountEntityBuilder $bankAccountEntityBuilder;
    private UserAccount $userAccountModel;
    private Currency $currencyModel;

    public function __construct(
        BankAccount $model,
        BankAccountEntityBuilder $bankAccountEntityBuilder,
        UserAccount $userAccountModel,
        Currency $currencyModel
    ) {
        $this->model = $model;
        $this->bankAccountEntityBuilder = $bankAccountEntityBuilder;
        $this->userAccountModel = $userAccountModel;
        $this->currencyModel = $currencyModel;
    }

    private function switchIdToExternalId(array $modelArray): array
    {
        /** @var UserAccount|null */
        $userAccountModel = $this->userAccountModel
            ->newQuery()
            ->find((int) $modelArray['user_account_id'], ['external_id']);

        if (!$userAccountModel) {
            throw new \Exception('User account not found', 404);
        }
        
        /** @var Currency|null */
        $currencyModel = $this->currencyModel
            ->newQuery()
            ->find((int) $modelArray['currency_id'], ['external_id']);

        if (!$currencyModel) {
            throw new \Exception('Currency not found', 404);
        }

        $modelArray['id'] = $modelArray['external_id'];
        $modelArray['user_account_id'] = (string) $userAccountModel->external_id;
        $modelArray['currency_id'] = (string) $currencyModel->external_id;

        return $modelArray;
    }

    public function findById(string $externalId): BankAccountEntity
    {
        /** @var BankAccount|null */
        $model = $this->model->newQuery()->where('external_id', $externalId)->first();

        if (!$model) {
            throw new \Exception('Bank account not found', 404);
        }

        $modelArray = $this->switchIdToExternalId($model->toArray());

        return $this->bankAccountEntityBuilder->setFromArray($modelArray)->get();
    }

    public function findByUserAccount(UserAccountEntity $userAccountEntity): BankAccountEntity
    {
        /** @var UserAccount|null */
        $userAccountModel = $this->userAccountModel
            ->newQuery()
            ->where('external_id', $userAccountEntity->getId())
            ->first();

        if (!$userAccountModel) {
            throw new \Exception('User account not found', 404);
        }

        /** @var BankAccount|null */
        $model = $this->model->newQuery()->where('user_account_id', $userAccountModel->id)->first();

        if (!$model) {
            throw new \Exception('Bank account not found', 404);
        }

        $modelArray = $this->switchIdToExternalId($model->toArray());

        return $this->bankAccountEntityBuilder->setFromArray($modelArray)->get();
    }
}
