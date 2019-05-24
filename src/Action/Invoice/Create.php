<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use App\Renderer\TemplateRenderer;
use App\Repository\InvoiceRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


final class Create
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

    public function handle(Request $request): Response
    {
        $invoice = new Invoice();
        $this->invoiceForm->setData($invoice);
        $this->invoiceForm->handleRequest($request);

        if ($this->invoiceForm->isSubmitted() && $this->invoiceForm->isValid()) {
            $this->invoiceRepository->save($invoice);

            return new RedirectResponse($this->router->generate('invoice_index'), Response::HTTP_FOUND);
        }

        return $this->renderer->renderResponse('invoice/new.html.twig', [
            'invoice' => $invoice,
            'form' => $this->invoiceForm->createView(),
        ]);
    }
}
