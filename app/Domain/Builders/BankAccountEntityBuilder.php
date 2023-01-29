<?php

declare(strict_types=1);

namespace App\Domain\Builders;

use App\Domain\Collections\TransactionEntityCollection;
use App\Domain\Entities\BankAccountEntity;
use App\Library\Carbon;

/**
 * @extends AbstractBuilder<BankAccountEntity>
 */
class BankAccountEntityBuilder extends AbstractBuilder
{
    private UserAccountEntityBuilder $userAccountEntityBuilder;
    private CurrencyValueObjectBuilder $currencyValueObjectBuilder;
    private TransactionEntityBuilder $transactionEntityBuilder;
    private TransactionEntityCollection $transactionEntityCollection;

    public function __construct(
        BankAccountEntity $entity,
        UserAccountEntityBuilder $userAccountEntityBuilder,
        CurrencyValueObjectBuilder $currencyValueObjectBuilder,
        TransactionEntityBuilder $transactionEntityBuilder,
        TransactionEntityCollection $transactionEntityCollection
    ) {
        $this->object = $entity;
        $this->userAccountEntityBuilder = $userAccountEntityBuilder;
        $this->currencyValueObjectBuilder = $currencyValueObjectBuilder;
        $this->transactionEntityBuilder = $transactionEntityBuilder;
        $this->transactionEntityCollection = $transactionEntityCollection;
    }

    public function setFromArray(array $data): self
    {
        $this->object->setId($data['id'])
            ->setUserAccountId($data['user_account_id'])
            ->setCurrencyId($data['currency_id'])
            ->setBalance($data['balance'])
            ->setCreatedAt(Carbon::parse($data['created_at']))
            ->setUpdatedAt(Carbon::parse($data['updated_at']));

        if (isset($data['user_account'])) {
            $this->setUserAccountFromArray($data['user_account']);
        }

        if (isset($data['currency'])) {
            $this->setCurrencyFromArray($data['currency']);
        }

        if (isset($data['transactions'])) {
            $this->setTransactionCollectionFromArray($data['transactions']);
        }

        return $this;
    }

    public function setUserAccountFromArray(array $data): self
    {
        $this->object->setUserAccount(
            $this->userAccountEntityBuilder->setFromArray($data)->get()
        );
        return $this;
    }

    public function setCurrencyFromArray(array $data): self
    {
        $this->object->setCurrency(
            $this->currencyValueObjectBuilder->setFromArray($data)->get()
        );
        return $this;
    }

    public function setTransactionCollectionFromArray(array $data): self
    {
        $transactionEntityCollection = new TransactionEntityCollection();
        foreach ($data as $transaction) {
            // FIXME: Botman is not able to serialize this object
            // $this->transactionEntityCollection->add(
            //     $this->transactionEntityBuilder->setFromArray($transaction)->get()
            // );
            $transactionEntityCollection->add(
                $this->transactionEntityBuilder->setFromArray($transaction)->get()
            );
        }
        $this->object->setTransactions($this->transactionEntityCollection);
        return $this;
    }
}
