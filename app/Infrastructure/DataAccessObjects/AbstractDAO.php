<?php

declare(strict_types=1);

namespace App\Infrastructure\DataAccessObjects;

use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
abstract class AbstractDAO
{
    /** @var T */
    protected Model $model;

    /** @param T $model */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findByPrimaryId(int $id, array $columns = ['*']): Model
    {
        /** @var Model|null */
        $model = $this->model->newQuery()->find($id, $columns);

        if (!$model) {
            throw new \Exception('Model not found', 404);
        }

        return $model;
    }
}