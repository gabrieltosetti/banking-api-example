<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Contracts\Arrayable;

/**
 * @implements Arrayable<string, mixed>
 */
abstract class AbstractEntity implements Arrayable
{
    private string $id;

    public function getId(): string
    {
        return $this->id;
    }

    /** @return $this */
    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }
}