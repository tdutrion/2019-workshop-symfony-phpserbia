<?php

declare(strict_types=1);

namespace App\UI\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

final class InvoiceIdentifier implements DataTransformerInterface
{
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if ($value instanceof \App\Domain\ValueObject\InvoiceIdentifier) {
            return $value->asString();
        }

        throw new \LogicException('Should never be called.');
    }

    public function reverseTransform($value)
    {
        if (!$value) {
            return;
        }

        try {
            return new \App\Domain\ValueObject\InvoiceIdentifier($value);
        } catch (\Throwable $exception) {
            throw new TransformationFailedException('Invalid invoice identifier');
        }
    }
}
