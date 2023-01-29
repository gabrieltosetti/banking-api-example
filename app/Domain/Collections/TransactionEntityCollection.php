<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\Entities\TransactionEntity;

/**
 * @extends AbstractCollection<TransactionEntity>
 */
class TransactionEntityCollection extends AbstractCollection
{
    /**
     * @param TransactionEntity[] $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct(TransactionEntity::class, $data);
    }
}
