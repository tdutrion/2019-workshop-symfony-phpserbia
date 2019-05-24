<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use App\Renderer\TemplateRenderer;
use Symfony\Component\HttpFoundation\Response;

final class Show
{
    private $renderer;

    public function __construct(TemplateRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(Invoice $invoice): Response
    {
        return $this->renderer->renderResponse('invoice/show.html.twig', [
            'invoice' => $invoice,
        ]);
    }
}
