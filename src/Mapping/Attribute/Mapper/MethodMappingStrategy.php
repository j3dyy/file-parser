<?php

namespace J3dyy\FileParser\Mapping\Attribute\Mapper;

final class MethodMappingStrategy extends Strategy
{
    public function __construct(
        string $targetType,
        private string $methodName,
        int $sourceIndex
    ) {
        parent::__construct($targetType, $sourceIndex);
    }

    public function setValue(object $object, mixed $value): void
    {
        $object->{$this->methodName}($value);
    }
}
