<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\ValueObject\InvoiceIdentifier;
use Ramsey\Uuid\UuidInterface;

class Invoice
{
    private $id;

    private $identifier;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getIdentifier(): ?InvoiceIdentifier
    {
        return $this->identifier;
    }

    public function setIdentifier(InvoiceIdentifier $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }
}
