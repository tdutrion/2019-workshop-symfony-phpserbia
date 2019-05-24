<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Renderer\TemplateRenderer;
use App\Repository\InvoiceRepository;
use Psr\Http\Message\ResponseInterface;

final class Listing
{
    private $renderer;
    private $invoiceRepository;

    public function __construct(TemplateRenderer $psrRenderer, InvoiceRepository $invoiceRepository)
    {
        $this->renderer = $psrRenderer;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function handle(): ResponseInterface
    {
        return $this->renderer->renderResponse('invoice/index.html.twig', [
            'invoices' => $this->invoiceRepository->findAll(),
        ]);
    }
}
