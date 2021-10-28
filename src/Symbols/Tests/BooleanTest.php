<?php

namespace MChristie\Semaphore\Symbols\Tests;

use MChristie\Semaphore\Symbols\Boolean;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    public function test_boolean(): void
    {
        $bool = new Boolean();
        $bool->setValue(true);

        $this->assertEquals(1, $bool->getBitLength());
        $this->assertEquals([true], $bool->getBits()[0]->getBits());
    }
}
