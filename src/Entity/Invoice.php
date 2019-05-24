<?php

declare(strict_types=1);

namespace App\Entity;

use App\ValueObject\InvoiceIdentifier;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity
 */
class Invoice
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var InvoiceIdentifier
     *
     * @ORM\Column(type="invoice_identifier")
     */
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
