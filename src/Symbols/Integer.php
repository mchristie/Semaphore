<?php

namespace MChristie\Semaphore\Symbols;

use Generator;
use MChristie\Semaphore\Bits;
use MChristie\Semaphore\CharacterConverter;
use MChristie\Semaphore\Symbol;

class Integer extends Symbol
{
    private ?int $value = null;
    private int $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    public function getBitLength(): int
    {
        return strlen(decbin($this->max));
    }

    public function addBits(Bits $bits): bool
    {
        $this->value = $bits->toInt();
        return true;
    }

    public function isSatisfied(): bool
    {
        return is_int($this->value);
    }

    public function setValue(mixed $value): static
    {
        $this->value = (int) $value;

        return $this;
    }

    public function getBits(): array
    {
        return [
            Bits::fromInt($this->getBitLength(), (int) $this->value)
        ];
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function reset(): void
    {
        $this->value = null;
    }
}
