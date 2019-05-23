<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Repository\InvoiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class Listing
{
    private $renderer;
    private $invoiceRepository;

    public function __construct(Environment $renderer, InvoiceRepository $invoiceRepository)
    {
        $this->renderer = $renderer;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @Route("/invoice", name="invoice_index", methods={"GET"})
     *
     * @return Response
     *
     * @throws LoaderError When the template cannot be found
     * @throws RuntimeError When an error occurred during rendering
     * @throws SyntaxError When an error occurred during compilation
     */
    public function index(): Response
    {
        return new Response($this->renderer->render('invoice/index.html.twig', [
            'invoices' => $this->invoiceRepository->findAll(),
        ]));
    }
}
