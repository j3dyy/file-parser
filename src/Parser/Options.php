<?php

namespace J3dyy\FileParser\Parser;

use J3dyy\FileParser\Converter\MixedValueConverter;
use J3dyy\FileParser\Converter\ValueConverter;
use J3dyy\FileParser\Mapping\ArrayMapper;
use J3dyy\FileParser\Mapping\AttributeMapper;
use J3dyy\FileParser\Mapping\Mapper;
use J3dyy\FileParser\Mapping\TradeOptionMapper;

class Options
{
    /**
     * Field enclosure passed to `fgetcsv()` (one character only).
     */
    public string $enclosure = '"';

    /**
     * Field delimiter passed to `fgetcsv()` (one character only).
     */
    public string $delimiter = ',';

    /**
     * Escape character passed to `fgetcsv()` (one character only).
     */
    public string $escape = '\\';

    /**
     * Instance of a `ValueConverter` implementation responsible to convert values from the file to their
     * respective target types.
     */
    public ValueConverter $valueConverter;

    public Mapper $mapper;

    public function __construct()
    {
        $this->valueConverter = new MixedValueConverter();
        //default mapper is array
        $this->mapper = new ArrayMapper();
    }

    /**
     * @param Mapper $mapper
     */
    public function setMapper(Mapper $mapper): void
    {
        $this->mapper = $mapper;
    }


}
