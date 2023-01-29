<?php

declare(strict_types=1);

namespace App\Infrastructure\DataAccessObjects;

use App\Domain\Builders\CurrencyValueObjectBuilder;
use App\Domain\DataAccessObjects\CurrencyDAOInterface;
use App\Domain\Entities\BankAccountEntity;
use App\Domain\ValueObjects\CurrencyValueObject;
use App\Infrastructure\Models\Currency;

/**
 * @extends AbstractDAO<Currency>
 */
class CurrencyDAO extends AbstractDAO implements CurrencyDAOInterface
{
    private CurrencyValueObjectBuilder $currencyBuilder;

    public function __construct(
        Currency $model,
        CurrencyValueObjectBuilder $currencyBuilder
    ) {
        $this->model = $model;
        $this->currencyBuilder = $currencyBuilder;
    }

    public function findByBankAccount(BankAccountEntity $bankAccountEntity): CurrencyValueObject
    {
        $model = $this->model->query()->where('external_id', $bankAccountEntity->getCurrencyId())->first();

        if (!$model) {
            throw new \Exception('Currency not found', 404);
        }

        return $this->currencyBuilder->setFromArray($model->toArray())->get();
    }

    public function findByCode(string $code): CurrencyValueObject
    {
        $model = $this->model->query()->where('code', $code)->first();

        if (!$model) {
            throw new \Exception('Currency not found', 404);
        }

        return $this->currencyBuilder->setFromArray($model->toArray())->get();
    }
}
