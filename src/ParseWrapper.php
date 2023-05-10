<?php

namespace J3dyy\FileParser;

use J3dyy\FileParser\Mapping\ArrayMapper;
use J3dyy\FileParser\Mapping\AttributeMapper;
use J3dyy\FileParser\Mapping\Mapper;
use J3dyy\FileParser\Parser\CsvParser;
use J3dyy\FileParser\Parser\Options;
use J3dyy\FileParser\Parser\Parser;

class ParseWrapper
{
    /**
     * @var Parser
     */
    protected Parser $parser;

    /**
     * @var Options
     */
    protected Options $options;

    /**
     * @param Parser|null $parser
     * @desription if parser not provided default parser will be used
     */
    public function __construct(?Parser $parser = null)
    {
        $this->options = new Options();

        $this->parser = $parser ?? new CsvParser();
    }

    public function toObject(string $csv, string $className): array
    {
        $this->options->setMapper(new AttributeMapper());
        $this->options->mapper->to($className);

        return $this->build($csv);
    }

    public function toArray(string $csv, array $signature = []): array
    {
        $this->options->setMapper(new ArrayMapper());

        $this->options->mapper->to($signature);

        return $this->build($csv);
    }

    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function setMapper(Mapper $mapper)
    {
        $this->options->mapper = $mapper;
    }

    private function get(): array
    {
        return $this->parser->all();
    }

    private function build(string $csv): array
    {
        $this->parser->build($csv, $this->options);

        return $this->get();
    }
}
