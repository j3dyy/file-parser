<?php

namespace J3dyy\FileParser\Mapping;

use J3dyy\FileParser\Converter\ValueConverter;
use J3dyy\FileParser\Exceptions\WrongMappingException;

class ArrayMapper implements Mapper
{
    protected array $signature = [];

    public function to(mixed $mapTo): void
    {
        $this->signature = $mapTo;
    }

    public function map(array $data, ValueConverter $valueConverter): array
    {

        if (count($this->signature) > 0) {
            $item = [];

            if (count($data) !== count($this->signature)) {
                throw new WrongMappingException("Wrong size signature and data");
            }

            foreach ($this->signature as $k => $key) {
                $item[$key] = $data[$k] ?? null;
            }

            return  $item;
        }

        //raw data
        return $data;
    }

}
