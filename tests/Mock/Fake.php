<?php

namespace J3dyy\FileParser\Tests\Mock;

use J3dyy\FileParser\Mapping\Attribute\Column;

class Fake
{
    #[Column(0)]
    public string $date;

    #[Column(1)]
    public int $userId;

    #[Column(2)]
    public string $userType;

    #[Column(3)]
    public string $operationType;

    #[Column(4)]
    public float $operationAmount;

    #[Column(5)]
    public string $operationCurrency;
}
