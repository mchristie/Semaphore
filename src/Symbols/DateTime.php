<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Symbols;

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;
use MChristie\Semaphore\Bits;
use MChristie\Semaphore\Symbol;

/**
 * Encodes a point in time as a fixed-width integer number of seconds relative
 * to an epoch.
 *
 * Defaults to 32 bits from the Unix epoch, which covers 1970-2106 to the
 * second. Narrow the range with a later epoch and/or fewer bits when you only
 * need to represent near-future dates (e.g. token expiry) and want to save
 * space.
 *
 * Sub-second precision is not preserved: values round-trip to whole seconds.
 * setValue() accepts a DateTimeInterface, an integer Unix timestamp, or any
 * string understood by DateTimeImmutable. getValue() always returns a
 * DateTimeImmutable in UTC.
 */
class DateTime extends Symbol
{
    private ?int $timestamp = null;

    public function __construct(
        private int $bits = 32,
        private int $epoch = 0,
    ) {
        if ($bits < 1 || $bits > 48) {
            throw new InvalidArgumentException('DateTime bit width must be between 1 and 48');
        }
    }

    public function getBitLength(): int
    {
        return $this->bits;
    }

    public function addBits(Bits $bits): bool
    {
        $this->timestamp = $bits->toInt() + $this->epoch;

        return true;
    }

    public function isSatisfied(): bool
    {
        return $this->timestamp !== null;
    }

    public function setValue(mixed $value): static
    {
        $this->timestamp = $this->normalise($value);

        return $this;
    }

    public function getBits(): array
    {
        $stored = $this->timestamp - $this->epoch;
        $max = (2 ** $this->bits) - 1;

        if ($stored < 0 || $stored > $max) {
            throw new InvalidArgumentException(
                "Timestamp is out of range for a {$this->bits}-bit DateTime with the configured epoch"
            );
        }

        return [
            Bits::fromInt($this->bits, $stored),
        ];
    }

    public function getValue(): DateTimeImmutable
    {
        return (new DateTimeImmutable('@' . $this->timestamp));
    }

    private function normalise(mixed $value): int
    {
        if ($value instanceof DateTimeInterface) {
            return $value->getTimestamp();
        }

        if (is_int($value)) {
            return $value;
        }

        if (is_string($value)) {
            return (new DateTimeImmutable($value))->getTimestamp();
        }

        throw new InvalidArgumentException('DateTime value must be a DateTimeInterface, integer timestamp, or date string');
    }

    public function reset(): void
    {
        $this->timestamp = null;
    }
}
