<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class Edit
{
    private $renderer;
    private $invoiceForm;
    private $entityManager;
    private $router;

    public function __construct(Environment $renderer, FormInterface $invoiceForm, EntityManagerInterface $entityManager, UrlGeneratorInterface $router)
    {
        $this->renderer = $renderer;
        $this->invoiceForm = $invoiceForm;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    /**
     * @Route("/invoice/{id}/edit", name="invoice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Invoice $invoice): Response
    {
        $this->invoiceForm->setData($invoice);
        $this->invoiceForm->handleRequest($request);

        if ($this->invoiceForm->isSubmitted() && $this->invoiceForm->isValid()) {
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('invoice_index', [
                'id' => $invoice->getId(),
            ]), Response::HTTP_FOUND);
        }

        return new Response($this->renderer->render('invoice/edit.html.twig', [
            'invoice' => $invoice,
            'form' => $this->invoiceForm->createView(),
        ]));
    }
}
