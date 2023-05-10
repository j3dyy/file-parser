<?php

namespace J3dyy\FileParser\Converter;

interface ValueConverter
{
    public function convert(string $value, string $targetType): mixed;

    public function supports(string $targetType): bool;
}
