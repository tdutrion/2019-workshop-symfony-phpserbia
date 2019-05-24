<?php

declare(strict_types=1);

namespace App\Renderer;

use Symfony\Component\HttpFoundation\Response;

interface TemplateRenderer
{
    public function renderResponse(string $view, array $parameters = [], Response $response = null);
}
