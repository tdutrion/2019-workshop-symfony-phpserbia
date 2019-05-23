<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class Show
{
    private $renderer;

    public function __construct(Environment $renderer)
    {
        $this->renderer = $renderer;
    }
    
    /**
     * @Route("/invoice/{id}", name="invoice_show", methods={"GET"})
     */
    public function show(Invoice $invoice): Response
    {
        return new Response($this->renderer->render('invoice/show.html.twig', [
            'invoice' => $invoice,
        ]));
    }
}
