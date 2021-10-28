<?php

namespace MChristie\Semaphore;

use Generator;

abstract class Symbol
{
    abstract public function getBitLength(): int;

    abstract public function addBits(Bits $bits): bool;

    abstract public function isSatisfied(): bool;

    abstract public function setValue(mixed $value): static;

    abstract public function getBits(): array;

    abstract public function getValue(): mixed;

    abstract public function reset(): void;
}
