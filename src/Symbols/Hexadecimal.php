<?php

namespace MChristie\Semaphore\Symbols;

use MChristie\Semaphore\Symbols\CharacterEncodingSymbol;

class Hexadecimal extends CharacterEncodingSymbol
{
    private const CHARACTERS = '0123456789ABCDEF';

    public function __construct(int $length = 0, private bool $uppercase = true)
    {
        parent::__construct($length);
    }

    protected function getCharacters(): string
    {
        return $this->fixCase(self::CHARACTERS);
    }

    public function setValue(mixed $value): static
    {
        return parent::setValue($this->fixCase($value));
    }

    private function fixCase(string $str): string
    {
        return $this->uppercase ? strtoupper($str) : strtolower($str);
    }
}
