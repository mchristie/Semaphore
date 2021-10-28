<?php

namespace MChristie\Semaphore;

use Exception;
use Generator;

class BitStream
{
    private array $bits = [];

    public function append(Bits ...$incoming)
    {
        $this->bits = array_merge($this->bits, ...array_map(fn ($b) => $b->getBits(), $incoming));
    }

    public function chunk(int $size): array
    {
        $return = [];
        $chunks = array_chunk($this->bits, $size);

        foreach ($chunks as $chunk) {
            $return[] = Bits::pad($size, $chunk, false);
        }

        return $return;
    }

    public function pump(int $size): Bits
    {
        if (count($this->bits) === 0) {
            throw new Exception('Reached end of bit stream');
        }

        return Bits::pad($size, array_splice($this->bits, 0, $size));
    }

    public function firstChunk(int $size): Bits
    {
        return Bits::create($size, array_slice($this->bits, 0, $size));
    }
}
