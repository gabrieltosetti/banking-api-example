<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use Ramsey\Collection\Collection;

/**
 * @template T
 * @extends Collection<T>
 */
abstract class AbstractCollection extends Collection
{
    public function dataToArray(): array
    {
        $data = [];
        foreach ($this->data as $item) {
            $data[] = $item->toArray();
        }
        return $data;
    }
}