<?php

namespace J3dyy\FileParser\Mapping;

use J3dyy\FileParser\Converter\ValueConverter;
use J3dyy\FileParser\Mapping\Attribute\Column;
use J3dyy\FileParser\Mapping\Attribute\Mapper\MethodMappingStrategy;
use J3dyy\FileParser\Mapping\Attribute\Mapper\PropertyMapperStrategy;
use J3dyy\FileParser\Mapping\Attribute\MappingAttribute;

class AttributeMapper implements Mapper
{
    protected string $mappableClass;

    protected ?array $mappings = null;

    public function to(mixed $mapTo): void
    {
        if (!is_string($mapTo)) {
            throw new \TypeError("Type mapTo not is a string");
        }
        $this->mappableClass = $mapTo;
    }

    public function map(array $data, ValueConverter $valueConverter): object
    {
        if ($this->mappings == null){
            $this->build($data);
        }

        return $this->resolveMapping($this->mappings, $valueConverter, $data);
    }

    private function build(array $data): void
    {

        $class = new \ReflectionClass($this->mappableClass);

        $this->mappings = [];

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (($index = $this->resolveAttribute($property, $data)) === null) {
                continue;
            }

            $this->mappings[] = new PropertyMapperStrategy((string) $property->getType(), $property->getName(), $index);
        }

        foreach ($class->getMethods(\ReflectionProperty::IS_PUBLIC) as $method) {
            if (($index = $this->resolveAttribute($method, $data)) === null) {
                continue;
            }

            $this->mappings[] = new MethodMappingStrategy((string) $method->getParameters()[0]->getType(), $method->getName(), $index);
        }

    }


    private function resolveAttribute(\ReflectionProperty | \ReflectionMethod $target, $data): ?string
    {

        $attributes = $target->getAttributes(MappingAttribute::class, \ReflectionAttribute::IS_INSTANCEOF);

        if (count($attributes) === 0) {
            return null;
        }

        if (count($attributes) > 1) {
            throw new \Exception("Multiple mapping key provided");
        }

        $attributeInstance = $attributes[0]->newInstance();

        if($attributeInstance instanceof Column) {
            return $attributeInstance->getColumn();
        }

        throw new \Exception("Attribute Type not supported $attributeInstance->getTitle()");
    }

    private function resolveMapping(array $mappings, ValueConverter $converter, array $data)
    {
        $object = new $this->mappableClass();

        foreach ($mappings as $strategy) {

            $strategy->setValue(
                $object,
                $converter->convert($data[$strategy->getIndex()] , $strategy->getType())
            );

        }

        return $object;
    }

}
