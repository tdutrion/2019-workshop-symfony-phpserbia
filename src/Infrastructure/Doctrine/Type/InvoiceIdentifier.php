<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use App\Domain\ValueObject\InvoiceIdentifier as InvoiceIdentifierVO;
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

        if ($value instanceof InvoiceIdentifierVO) {
            return $value;
        }

        return new InvoiceIdentifierVO($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        if ($value instanceof InvoiceIdentifierVO) {
            return $value->asString();
        }

        throw ConversionException::conversionFailed($value, static::INVOICE_IDENTIFIER);
    }

    public function getName()
    {
        return self::INVOICE_IDENTIFIER;
    }
}
