<?php

namespace J3dyy\FileParser\Exceptions;

final class ValueConversionException extends \Exception
{
    public const TYPE_NOT_SUPPORTED = 1;
    public const CONVERSION_FAILED = 2;

    public function __construct(string $message, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function fromValueAndTargetType(string $value, string $targetType, ?\Throwable $innerException = null): self
    {
        return new self(sprintf('Could not parse "%s" as "%s".', $value, $targetType), self::CONVERSION_FAILED, $innerException);
    }
}
