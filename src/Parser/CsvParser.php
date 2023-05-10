<?php

namespace J3dyy\FileParser\Parser;

class CsvParser implements Parser
{
    protected string $path;

    protected Options $options;

    protected array $bag;

    public function build(string $path, ?Options $options = null)
    {

        $this->bag = [];

        if (!is_file($path)) {
            throw new \TypeError('J3dyy\FileParser\Parser\CsvParser::__construct(): Argument #1 ($file) must be of type resource.');
        }

        $this->path = $path;

        $this->options = $options ?? new Options();
    }

    public function iterable(): iterable
    {
        $resource = fopen($this->path, 'r');

        $i = ftell($resource);

        while (($row = fgetcsv(
            $resource,
            0,
            $this->options->delimiter,
            $this->options->enclosure,
            $this->options->escape
        )) != false) {
            if ($row[0] == null){
                continue ;
            }
            yield  $this->options->mapper->map(
                $row,
                $this->options->valueConverter
            );
            $i++;
        }

        if (\is_file($this->path)) {
            fseek($resource, $i);
        } else {
            fclose($resource);
        }

    }


    public function all(): array
    {

        foreach ($this->iterable() as $item) {
            $this->bag[] = $item;
        }

        return $this->bag;
    }

}
