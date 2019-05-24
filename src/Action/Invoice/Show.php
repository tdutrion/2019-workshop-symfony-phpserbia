<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use App\Renderer\TemplateRenderer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class Show
{
    private $renderer;

    public function __construct(TemplateRenderer $renderer)
    {
        $this->renderer = $renderer;
    }
    
    /**
     * @Route("/invoice/{id}", name="invoice_show", methods={"GET"})
     */
    public function show(Invoice $invoice): Response
    {
        return $this->renderer->renderResponse('invoice/show.html.twig', [
            'invoice' => $invoice,
        ]);
    }
}
