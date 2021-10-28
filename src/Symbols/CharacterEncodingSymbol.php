<?php

namespace MChristie\Semaphore\Symbols;

use Generator;
use InvalidArgumentException;
use MChristie\Semaphore\Bits;
use MChristie\Semaphore\CharacterConverter;
use MChristie\Semaphore\Symbol;

abstract class CharacterEncodingSymbol extends Symbol
{
    private string $value = '';
    private int $length = 0;
    private bool $satisfied = false;

    private CharacterConverter $converter;

    abstract protected function getCharacters(): string;

    public function __construct(int $length = 0)
    {
        $this->length = $length;
        $this->converter = new CharacterConverter(false, $this->getCharacters(), $length === 0);
    }

    public function getBitLength(): int
    {
        return $this->converter->getBitLength();
    }

    public function addBits(Bits $bits): bool
    {
        $int = $bits->toInt();

        if ($this->converter->isEndCharacter($int)) {
            return $this->satisfied = true;
        }

        $this->value .= $this->converter->decodeCharacter($int);

        if ($this->length && strlen($this->value) === $this->length) {
            return $this->satisfied = true;
        }

        return false;
    }

    public function isSatisfied(): bool
    {
        return $this->satisfied;
    }

    public function setValue(mixed $value): static
    {
        if ($this->length && strlen($value) !== $this->length) {
            throw new InvalidArgumentException("Value '{$value}' did not match fixed length of {$this->length}");
        }

        $this->value = $value;

        return $this;
    }

    public function getBits(): array
    {
        return $this->converter->encodeCharacters($this->value);
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function reset(): void
    {
        $this->value = '';
        $this->satisfied = false;
    }
}
