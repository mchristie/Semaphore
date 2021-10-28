<?php

namespace MChristie\Semaphore\Symbols;

use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Symbols\CharacterEncodingSymbol;

class Alphanumeric extends CharacterEncodingSymbol
{
    private bool $spaces;

    public function __construct(int $length = 0, bool $spaces = false)
    {
        $this->spaces = $spaces;
        parent::__construct($length);
    }

    protected function getCharacters(): string
    {
        return $this->spaces ? CharacterSets::ALPHANUMERIC_SPACE : CharacterSets::ALPHANUMERIC;
    }
}
