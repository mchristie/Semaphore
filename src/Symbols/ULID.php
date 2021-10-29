<?php

namespace MChristie\Semaphore\Symbols;

use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Symbols\CharacterEncodingSymbol;

class ULID extends Hexadecimal
{
    public function __construct()
    {
        parent::__construct(26);
    }

    protected function getCharacters(): string
    {
        return CharacterSets::CROCKFORDS_BASE32;
    }
}
