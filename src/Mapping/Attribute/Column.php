<?php

declare(strict_types=1);

namespace J3dyy\FileParser\Mapping\Attribute;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_PROPERTY)]
class Column extends MappingAttribute
{
    public function __construct(private string $column = '')
    {

    }
    public function getColumn(): string
    {
        return $this->column;
    }
}
