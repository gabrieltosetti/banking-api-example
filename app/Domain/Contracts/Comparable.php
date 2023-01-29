<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

interface Comparable
{
    public function equals(Comparable $object);
}
