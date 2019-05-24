<?php

declare(strict_types=1);

namespace App\Renderer;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class Psr7TwigRenderer implements TemplateRenderer
{
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function renderResponse(string $view, array $parameters = [], Response $response = null): ResponseInterface
    {
        $responseFactory = new Psr17Factory();

        return $responseFactory->createResponse(200)->withBody($responseFactory->createStream(
            $this->environment->render($view, $parameters)
        ));
    }
}
