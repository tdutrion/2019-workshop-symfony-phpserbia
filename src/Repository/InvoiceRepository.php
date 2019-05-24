<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Entity\Invoice;
use Doctrine\ORM\EntityManagerInterface;

final class InvoiceRepository implements MultipleInvoiceRetrieval
{
    private $entityManager;
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Invoice::class);
    }

    public function find(int $identifier): ?Invoice
    {
        return $this->entityManager->find($identifier);
    }

    public function save(?Invoice $invoice = null): void
    {
        if (null !== $invoice) {
            $this->entityManager->persist($invoice);
        }
        $this->entityManager->flush();
    }

    public function delete(Invoice $invoice): void
    {
        $this->entityManager->remove($invoice);
        $this->entityManager->flush();
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}
