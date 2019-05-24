<?php

declare(strict_types=1);

namespace App\Action\Invoice;

use App\Entity\Invoice;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

final class Delete
{
    private $entityManager;
    private $router;
    private $csrfTokenManager;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $router, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function handle(Request $request, Invoice $invoice): Response
    {
        if ($this->csrfTokenManager->isTokenValid(new CsrfToken('delete'.$invoice->getId(), $request->request->get('_token')))) {
            $this->entityManager->remove($invoice);
            $this->entityManager->flush();
        }

        return new RedirectResponse($this->router->generate('invoice_index'), Response::HTTP_FOUND);
    }
}
