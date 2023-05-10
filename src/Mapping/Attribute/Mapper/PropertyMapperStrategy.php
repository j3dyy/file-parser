<?php

namespace J3dyy\FileParser\Mapping\Attribute\Mapper;

class PropertyMapperStrategy extends Strategy
{
    public function __construct(
        string $targetType,
        private string $propertyName,
        int $sourceIndex
    ) {
        parent::__construct($targetType, $sourceIndex);
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function setValue(object $object, mixed $value): void
    {
        $object->{$this->propertyName} = $value;
    }
}
