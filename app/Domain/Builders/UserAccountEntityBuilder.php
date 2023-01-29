<?php

declare(strict_types=1);

namespace App\Domain\Builders;

use App\Domain\Entities\UserAccountEntity;
use App\Library\Carbon;

/**
 * @extends AbstractBuilder<UserAccountEntity>
 */
class UserAccountEntityBuilder extends AbstractBuilder
{
    public function __construct(UserAccountEntity $entity)
    {
        $this->object = $entity;
    }

    public function setFromArray(array $data): self
    {
        $this->object->setId($data['external_id'] ?? $data['id']);
        $this->object->setName($data['name']);
        $this->object->setEmail($data['email']);
        $this->object->setPassword($data['password']);
        $this->object->setCreatedAt(Carbon::parse($data['created_at']));
        return $this;
    }
}