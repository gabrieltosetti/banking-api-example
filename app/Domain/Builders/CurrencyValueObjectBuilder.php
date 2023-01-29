<?php

declare(strict_types=1);

namespace App\Domain\Builders;

use App\Domain\ValueObjects\CurrencyValueObject;

/**
 * @extends AbstractBuilder<CurrencyValueObject>
 */
class CurrencyValueObjectBuilder extends AbstractBuilder
{
    public function __construct(CurrencyValueObject $valueObject)
    {
        $this->object = $valueObject;
    }

    public function setFromArray(array $data): self
    {
        $this->object->setCode($data['code']);
        $this->object->setDescription($data['description']);

        return $this;
    }
}
