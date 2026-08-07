<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Symbols;

use InvalidArgumentException;
use MChristie\Semaphore\Bits;
use MChristie\Semaphore\Symbol;

/**
 * Encodes a single value chosen from a fixed set of cases using the minimum
 * number of bits required to index the set (ceil(log2(n)), at least 1 bit).
 *
 * This is the most space-efficient symbol when a value is known to be one of a
 * small, closed list - e.g. a status, role or type.
 */
class Enum extends Symbol
{
    /** @var list<int|string> */
    private array $cases;

    private int|string|null $value = null;

    public function __construct(int|string ...$cases)
    {
        if (count($cases) === 0) {
            throw new InvalidArgumentException('Enum requires at least one case');
        }

        // Dedupe with strict comparison so that, e.g., the string '1' and the
        // integer 1 remain distinct cases.
        $unique = [];
        foreach ($cases as $case) {
            if (!in_array($case, $unique, true)) {
                $unique[] = $case;
            }
        }

        $this->cases = $unique;
    }

    public function getBitLength(): int
    {
        return max(1, (int) ceil(log(count($this->cases), 2)));
    }

    public function addBits(Bits $bits): bool
    {
        $index = $bits->toInt();

        if (!array_key_exists($index, $this->cases)) {
            throw new InvalidArgumentException("Decoded index '{$index}' is out of range for this enum");
        }

        $this->value = $this->cases[$index];

        return true;
    }

    public function isSatisfied(): bool
    {
        return $this->value !== null;
    }

    public function setValue(mixed $value): static
    {
        if (array_search($value, $this->cases, true) === false) {
            $allowed = implode(', ', $this->cases);
            throw new InvalidArgumentException("Value '{$value}' is not one of the allowed cases: {$allowed}");
        }

        $this->value = $value;

        return $this;
    }

    public function getBits(): array
    {
        $index = array_search($this->value, $this->cases, true);

        return [
            Bits::fromInt($this->getBitLength(), (int) $index),
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
