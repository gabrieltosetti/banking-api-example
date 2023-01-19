<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
abstract class AbstractRepository
{
    /** @var T */
    protected Model $model;

    /** @param T $model */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}