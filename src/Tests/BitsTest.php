<?php

namespace MChristie\Semaphore\Tests;

use MChristie\Semaphore\Bits;
use PHPUnit\Framework\TestCase;

class BitsTest extends TestCase
{
    public function test_set_size(): void
    {
        $bits = Bits::create(4, [true, true, false, false]);

        $this->assertEquals(4, $bits->getLength());
        $this->assertEquals([true, true, false, false], $bits->getBits());
    }

    public function test_pad(): void
    {
        $bits = Bits::pad(8, [true, true, false, false]);

        $this->assertEquals(8, $bits->getLength());
        $this->assertEquals([false, false, false, false, true, true, false, false], $bits->getBits());
    }

    public function test_from_int(): void
    {
        $bits = Bits::fromInt(6, 12);

        $this->assertEquals([false, false, true, true, false, false], $bits->getBits());
    }

    public function test_to_int(): void
    {
        $bits = Bits::pad(6, [true, true, false, false]);

        $this->assertEquals(12, $bits->toInt());
    }
}
