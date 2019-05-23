<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class Create
{
    private $renderer;
    private $invoiceForm;
    private $entityManager;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(Environment $renderer, FormInterface $invoiceForm, EntityManagerInterface $entityManager, UrlGeneratorInterface $router)
    {
        $this->renderer = $renderer;
        $this->invoiceForm = $invoiceForm;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    /**
     * @Route("/invoice/new", name="invoice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $invoice = new Invoice();
        $this->invoiceForm->setData($invoice);
        $this->invoiceForm->handleRequest($request);

        if ($this->invoiceForm->isSubmitted() && $this->invoiceForm->isValid()) {
            $this->entityManager->persist($invoice);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('invoice_index'), Response::HTTP_FOUND);
        }

        return new Response($this->renderer->render('invoice/new.html.twig', [
            'invoice' => $invoice,
            'form' => $this->invoiceForm->createView(),
        ]));
    }
}
