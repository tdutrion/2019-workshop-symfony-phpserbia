<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Renderer\TemplateRenderer;
use App\Repository\InvoiceRepository;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class Listing
{
    private $renderer;
    private $invoiceRepository;

    public function __construct(TemplateRenderer $psrRenderer, InvoiceRepository $invoiceRepository)
    {
        $this->renderer = $psrRenderer;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @Route("/invoice", name="invoice_index", methods={"GET"})
     *
     * @return ResponseInterface
     *
     * @throws LoaderError When the template cannot be found
     * @throws RuntimeError When an error occurred during rendering
     * @throws SyntaxError When an error occurred during compilation
     */
    public function index(): ResponseInterface
    {
        return $this->renderer->renderResponse('invoice/index.html.twig', [
            'invoices' => $this->invoiceRepository->findAll(),
        ]);
    }
}
