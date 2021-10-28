<?php

namespace MChristie\Semaphore;

use Generator;
use InvalidArgumentException;
use MChristie\Semaphore\Symbols\CharacterEncodingSymbol;

final class Index
{
    private CharacterEncodingSymbol $identifier;

    private array $symbols;

    public function __construct(CharacterEncodingSymbol $identifier, array $symbols)
    {
        foreach ($symbols as $key => $symbol) {
            if ($symbol instanceof Symbol === false || is_string($key) === false) {
                throw new InvalidArgumentException('Index received invalid key/value symbols');
            }
        }

        $this->identifier = $identifier;
        $this->symbols = $symbols;
    }

    public function getIdentifier(): string
    {
        return $this->identifier->getValue();
    }

    public function iterateSymbols(): Generator
    {
        foreach ($this->symbols as $key => $symbol) {
            $symbol->reset();
            yield $key => $symbol;
        }
    }
}
