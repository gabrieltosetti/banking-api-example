<?php

declare(strict_types=1);

namespace App\Domain\Builders;

use App\Domain\Entities\TransactionEntity;
use App\Library\Carbon;

/**
 * @extends AbstractBuilder<TransactionEntity>
 */
class TransactionEntityBuilder extends AbstractBuilder
{
    public function __construct(TransactionEntity $entity)
    {
        $this->object = $entity;
    }

    public function setFromArray(array $data): self
    {
        $this->object->setId($data['id']);
        $this->object->setBankAccountId($data['bank_account_id']);
        $this->object->setBankAccountCurrencyId($data['bank_account_currency_id']);
        $this->object->setTargetCurrencyId($data['target_currency_id']);
        $this->object->setValue($data['value']);
        $this->object->setRate($data['rate']);
        $this->object->setType($data['type']);
        $this->object->setCreatedAt(Carbon::parse($data['created_at']));
        return $this;
    }
}
