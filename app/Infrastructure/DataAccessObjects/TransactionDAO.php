<?php

declare(strict_types=1);

namespace App\Infrastructure\DataAccessObjects;

use App\Domain\Builders\TransactionEntityBuilder;
use App\Domain\Collections\TransactionEntityCollection;
use App\Domain\DataAccessObjects\TransactionDAOInterface;
use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\TransactionEntity;
use App\Infrastructure\Models\BankAccount;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends AbstractDAO<Transaction>
 */
class TransactionDAO extends AbstractDAO implements TransactionDAOInterface
{
    private TransactionEntityBuilder $transactionBuilder;
    private BankAccount $bankAccountModel;
    private Currency $currencyModel;
    protected TransactionEntityCollection $transactionEntityCollection;

    public function __construct(
        Transaction $model,
        TransactionEntityBuilder $transactionBuilder,
        BankAccount $bankAccountModel,
        Currency $currencyModel,
        TransactionEntityCollection $transactionEntityCollection
    ) {
        $this->model = $model;
        $this->transactionBuilder = $transactionBuilder;
        $this->bankAccountModel = $bankAccountModel;
        $this->currencyModel = $currencyModel;
        $this->transactionEntityCollection = $transactionEntityCollection;
    }

    private function switchIdToExternalId(array $modelArray): array
    {

        // $this->object->setBankAccountId($data['bank_account_id']);
        // $this->object->setBankAccountCurrencyId($data['bank_account_currency_id']);
        // $this->object->setTargetCurrencyId($data['target_currency_id']);

        /** @var BankAccount|null */
        $bankAccountModel = $this->bankAccountModel
            ->newQuery()
            ->find((int) $modelArray['bank_account_id'], ['external_id']);

        if (!$bankAccountModel) {
            throw new \Exception('Bank account not found', 404);
        }

        /** @var Currency|null */
        $bankAccountCurrencyModel = $this->currencyModel
            ->newQuery()
            ->find((int) $modelArray['bank_account_currency_id'], ['external_id']);

        if (!$bankAccountCurrencyModel) {
            throw new \Exception('Bank account currency not found', 404);
        }

        /** @var Currency|null */
        $targetCurrencyModel = $this->currencyModel
            ->newQuery()
            ->find((int) $modelArray['target_currency_id'], ['external_id']);

        if (!$targetCurrencyModel) {
            throw new \Exception('Target currency not found', 404);
        }

        $modelArray['id'] = $modelArray['external_id'];
        $modelArray['bank_account_id'] = $bankAccountModel->external_id;
        $modelArray['bank_account_currency_id'] = $bankAccountCurrencyModel->external_id;
        $modelArray['target_currency_id'] = $targetCurrencyModel->external_id;

        return $modelArray;
    }

    public function findByBankAccount(BankAccountEntity $bankAccountEntity): ?TransactionEntityCollection
    {
        $bankAccountModel = $this->bankAccountModel
            ->newQuery()
            ->where('external_id', $bankAccountEntity->getId())
            ->first();

        if (!$bankAccountModel) {
            throw new \Exception('Bank account not found', 404);
        }

        /** @var Collection<Transaction> */
        $transactionModelCollection = $this->model->newQuery()->where('bank_account_id', $bankAccountModel->id)->get();

        if ($transactionModelCollection->isEmpty()) {
            return null;
        }

        foreach ($transactionModelCollection as $transactionModel) {
            $transactionModelArray = $this->switchIdToExternalId($transactionModel->toArray());

            $this->transactionEntityCollection->add(
                $this->transactionBuilder->setFromArray($transactionModelArray)->get()
            );
        }

        return $this->transactionEntityCollection;
    }
}
