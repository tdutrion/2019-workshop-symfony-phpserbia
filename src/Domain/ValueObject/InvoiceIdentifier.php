<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

final class InvoiceIdentifier
{
    private $identifier;

    public function __construct(string $identifier)
    {
        if ('INV-' !== mb_substr($identifier, 0, 4)) {
            throw new  \InvalidArgumentException('An invoice identifier should start with "INV-"');
        }
        $this->identifier = $identifier;
    }

    public function asString(): string
    {
        return $this->identifier;
    }
}
