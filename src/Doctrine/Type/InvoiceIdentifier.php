<?php

declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class InvoiceIdentifier extends Type
{
    public const INVOICE_IDENTIFIER = 'invoice_identifier';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $fieldDeclaration['length'] = 10;
        $fieldDeclaration['fixed']  = true;

        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof \App\ValueObject\InvoiceIdentifier) {
            return $value;
        }

        return new \App\ValueObject\InvoiceIdentifier($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof \App\ValueObject\InvoiceIdentifier) {
            return $value->asString();
        }

        throw ConversionException::conversionFailed($value, static::INVOICE_IDENTIFIER);
    }

    public function getName()
    {
        return self::INVOICE_IDENTIFIER;
    }
}