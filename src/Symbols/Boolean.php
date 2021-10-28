<?php

namespace MChristie\Semaphore\Symbols;

use Generator;
use MChristie\Semaphore\Bits;
use MChristie\Semaphore\Symbol;

class Boolean extends Symbol
{
    private ?bool $value = null;

    public function getBitLength(): int
    {
        return 1;
    }

    public function addBits(Bits $bits): bool
    {
        $this->value = $bits->getBits()[0];

        return true;
    }

    public function isSatisfied(): bool
    {
        return is_bool($this->value);
    }

    public function setValue(mixed $value): static
    {
        $this->value = (bool) $value;

        return $this;
    }

    public function getBits(): array
    {
        return [
            Bits::create(1, [$this->value])
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
