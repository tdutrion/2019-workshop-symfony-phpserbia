<?php

declare(strict_types=1);

namespace App\UI\Renderer;

use Symfony\Component\HttpFoundation\Response;

interface TemplateRenderer
{
    public function renderResponse(string $view, array $parameters = [], Response $response = null);
}
