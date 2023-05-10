### File Parser library


## How to use

```php

//default is CsvParser
$wrapper = new \J3dyy\FileParser\ParseWrapper( $parser|null );

//parse to object
$wrapper->toObject('csvpath', Model::class)

//parse to associative array
$wrapper->toArray('csvpath',['fooKey','barKey'])

//parse to raw array
$wrapper->toArray('csvPath')


```

