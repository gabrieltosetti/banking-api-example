<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\Contracts\Arrayable;
use App\Domain\Contracts\Comparable;

/**
 * @implements Arrayable<string, mixed>
 */
abstract class AbstractValueObject implements Comparable, Arrayable
{
    public function equals(Comparable $object): bool
    {
        if (!($object instanceof AbstractValueObject)) {
            return false;
        }

        return $this->toArray() === $object->toArray();
    }
}