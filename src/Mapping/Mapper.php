<?php

namespace J3dyy\FileParser\Mapping;

use J3dyy\FileParser\Converter\ValueConverter;

interface Mapper
{
    public function to(mixed $mapTo): void;

    public function map(array $data, ValueConverter $valueConverter): mixed;
}
