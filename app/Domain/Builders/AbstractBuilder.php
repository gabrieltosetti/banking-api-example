<?php

declare(strict_types=1);

namespace App\Domain\Builders;

use Carbon\Carbon;

/**
 * @template T
 */
abstract class AbstractBuilder
{
    /** @var T */
    protected object $object;

    public function reset(): self
    {
        $this->object = new $this->object;
        return $this;
    }

    /** @return T */
    public function get(): object
    {
        $object = $this->object;
        $this->reset();
        return $object;
    }
}