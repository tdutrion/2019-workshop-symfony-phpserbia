<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Invoice;

interface InvoiceRepository extends MultipleInvoiceRetrieval
{
    public function find(int $identifier): ?Invoice;
    public function save(?Invoice $invoice = null): void;
    public function delete(Invoice $invoice): void;
}
