<?php

namespace J3dyy\FileParser\Parser;

interface Parser
{
    public function build(string $path);
    public function all(): array;
}
