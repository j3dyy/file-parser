<?php

namespace J3dyy\FileParser\Tests;

use J3dyy\FileParser\Exceptions\WrongMappingException;
use J3dyy\FileParser\Mapping\ArrayMapper;
use J3dyy\FileParser\Mapping\AttributeMapper;
use J3dyy\FileParser\Parser\CsvParser;
use J3dyy\FileParser\Parser\Options;
use J3dyy\FileParser\Tests\Mock\Fake;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{


    public function testRawArrayMapping()
    {
        $parser = new CsvParser();

        $parser->build(__DIR__.'/files/fake.csv');

        $array = $parser->all();

        $this->assertIsArray($array);
        $this->assertArrayHasKey(0, $array);
    }

    public function testKeyValueWrongSizeException()
    {

        $options = new Options();
        $options->setMapper(new ArrayMapper());
        $options->mapper->to([
            'foo','bar','kar'
        ]);

        $parser = new CsvParser();

        $parser->build(__DIR__.'/files/fake.csv', $options);

        $this->expectException(WrongMappingException::class);
        $array = $parser->all();

    }

    public function testKeyValueCorrectSize()
    {
        $options = new Options();
        $options->setMapper(new ArrayMapper());
        $options->mapper->to([
            'foo','bar','kar','car','lar','par'
        ]);

        $parser = new CsvParser();

        $parser->build(__DIR__.'/files/fake.csv', $options);

        $array = $parser->all();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('foo',$array[0]);
    }

    public function testEmptySignatureProducesRawArray()
    {
        $options = new Options();
        $options->setMapper(new ArrayMapper());

        $parser = new CsvParser();
        $parser->build(__DIR__.'/files/fake.csv');

        $array = $parser->all();

        $this->assertIsArray($array);
        $this->assertArrayHasKey(0, $array[0]);
    }

    public function testAttributeMapping()
    {

        $options = new Options();
        $options->setMapper(new AttributeMapper());
        $options->mapper->to(Fake::class);

        $parser = new CsvParser();

        $parser->build(__DIR__.'/files/fake.csv', $options);

        $array = $parser->all();

        $this->assertIsArray($array);
        $this->assertInstanceOf(Fake::class, $array[0]);
    }

    public function dies(...$keys)
    {
        echo '<pre>';
        var_dump($keys);
        exit();
    }
}
