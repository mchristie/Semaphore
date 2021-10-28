<?php

namespace MChristie\Semaphore;

use ArgumentCountError;

final class Bits
{
    const PAD_LEFT = 'left';
    const PAD_RIGHT = 'right';

    private array $bits;

    private function __construct(bool ...$bits)
    {
        $this->bits = $bits;
    }

    public static function pad(int $size, array $bits, $pad = self::PAD_LEFT): Bits
    {
        if (count($bits) < $size) {
            $signedSize = $pad === self::PAD_LEFT ? $size * -1 : $size;
            $bits = array_pad($bits, $signedSize, false);
        }

        return new Bits(...$bits);
    }

    public static function create(int $size, array $bits): Bits
    {
        if (count($bits) !== $size) {
            throw new ArgumentCountError("{$size} bits were specified but not provided");
        }

        return new Bits(...$bits);
    }

    public static function fromInt(int $size, int $val, $pad = self::PAD_LEFT): Bits
    {
        $chars = str_split(decbin($val));
        $bits = array_map(fn ($c) => !!$c, $chars);

        return Bits::pad($size, $bits, $pad);
    }

    public function toInt(): int
    {
        $chars = array_map(fn ($b) => $b ? '1' : '0', $this->bits);
        return bindec(implode('', $chars));
    }

    public function getLength(): int
    {
        return count($this->bits);
    }

    public function getBits(): array
    {
        return $this->bits;
    }
}
