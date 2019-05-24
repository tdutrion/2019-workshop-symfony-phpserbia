<?php

declare(strict_types=1);

namespace App\Renderer;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HttpFoundationTwigRenderer implements TemplateRenderer
{
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function renderResponse(string $view, array $parameters = [], Response $response = null): Response
    {
        if (null !== $response) {
            $response->setContent($this->environment->render($view, $parameters));

            return $response;
        }

        return new Response($this->environment->render($view, $parameters));
    }
}
