<?php

namespace MChristie\Semaphore\Tests;

use MChristie\Semaphore\Bits;
use PHPUnit\Framework\TestCase;
use MChristie\Semaphore\BitStream;

class BitStreamTest extends TestCase
{
    public function test_stream_resizes(): void
    {
        $stream = new BitStream();
        $stream->append(Bits::create(8, [true, false, true, false, true, false, true, false]));
        $stream->append(Bits::create(8, [true, false, true, false, true, false, true, false]));
        $stream->append(
            Bits::create(8, [true, false, true, false, true, false, true, false]),
            Bits::create(8, [true, false, true, false, true, false, true, false]),
        );

        $chunks = $stream->chunk(4);

        $expected = [
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
            Bits::create(4, [true, false, true, false]),
        ];

        $this->assertEquals($expected, $chunks);
    }
}
