<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Library\Carbon;
use Illuminate\Support\Facades\Hash;

class UserAccountEntity extends AbstractEntity
{
    private string $name;
    private string $email;
    private string $password;
    private Carbon $createdAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Carbon $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function checkPassword(string $password): bool
    {
        return Hash::check($password, $this->getPassword());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'created_at' => $this->getCreatedAt()->toIso8601String(),
        ];
    }
}
