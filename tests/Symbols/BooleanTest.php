<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests\Symbols;

use MChristie\Semaphore\Bits;
use MChristie\Semaphore\Symbols\Boolean;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    public function test_boolean_true(): void
    {
        $bool = new Boolean();
        $bool->setValue(true);

        $this->assertEquals(1, $bool->getBitLength());
        $this->assertEquals([true], $bool->getBits()[0]->getBits());
        $this->assertTrue($bool->isSatisfied());
    }

    public function test_boolean_false(): void
    {
        $bool = new Boolean();
        $bool->setValue(false);

        $this->assertEquals([false], $bool->getBits()[0]->getBits());
    }

    public function test_boolean_round_trips(): void
    {
        $bool = new Boolean();
        $bool->addBits(Bits::create(1, [true]));

        $this->assertTrue($bool->getValue());
        $this->assertTrue($bool->isSatisfied());

        $bool->reset();
        $this->assertFalse($bool->isSatisfied());
    }
}
