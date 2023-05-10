<?php

namespace J3dyy\FileParser\Mapping\Attribute\Mapper;

abstract class Strategy
{
    protected function __construct(
        private string $targetType,
        private int $sourceIndex
    ) {
    }

    public function getType(): string
    {
        return $this->targetType;
    }

    public function getIndex(): int
    {
        return $this->sourceIndex;
    }

    abstract public function setValue(object $object, mixed $value): void;
}
