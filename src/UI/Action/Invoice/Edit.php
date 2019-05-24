<?php

declare(strict_types=1);

namespace App\UI\Action\Invoice;

use App\Domain\Entity\Invoice;
use App\Domain\Repository\InvoiceRepository;
use App\UI\Renderer\TemplateRenderer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class Edit
{
    private $renderer;
    private $invoiceForm;
    private $router;
    private $invoiceRepository;

    public function __construct(TemplateRenderer $renderer, FormInterface $invoiceForm, InvoiceRepository $invoiceRepository, UrlGeneratorInterface $router)
    {
        $this->renderer = $renderer;
        $this->invoiceForm = $invoiceForm;
        $this->router = $router;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function handle(Request $request, Invoice $invoice): Response
    {
        $this->invoiceForm->setData($invoice);
        $this->invoiceForm->handleRequest($request);

        if ($this->invoiceForm->isSubmitted() && $this->invoiceForm->isValid()) {
            $this->invoiceRepository->save();

            return new RedirectResponse($this->router->generate('invoice_index', [
                'id' => $invoice->getId(),
            ]), Response::HTTP_FOUND);
        }

        return $this->renderer->renderResponse('invoice/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $this->invoiceForm->createView(),
        ]);
    }
}
