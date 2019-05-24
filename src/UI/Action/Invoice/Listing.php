<?php

declare(strict_types=1);

namespace App\UI\Action\Invoice;

use App\Domain\Repository\MultipleInvoiceRetrieval;
use App\UI\Renderer\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;

final class Listing
{
    private $renderer;
    private $invoices;

    public function __construct(TemplateRenderer $psrRenderer, MultipleInvoiceRetrieval $invoices)
    {
        $this->renderer = $psrRenderer;
        $this->invoices = $invoices;
    }

    public function handle(): ResponseInterface
    {
        return $this->renderer->renderResponse('invoice/index.html.twig', [
            'invoices' => $this->invoices->findAll(),
        ]);
    }
}
