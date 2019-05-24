<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

final class Delete
{
    private $router;
    private $csrfTokenManager;
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository, UrlGeneratorInterface $router, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function handle(Request $request, Invoice $invoice): Response
    {
        if ($this->csrfTokenManager->isTokenValid(new CsrfToken('delete'.$invoice->getId(), $request->request->get('_token')))) {
            $this->invoiceRepository->delete($invoice);
        }

        return new RedirectResponse($this->router->generate('invoice_index'), Response::HTTP_FOUND);
    }
}
