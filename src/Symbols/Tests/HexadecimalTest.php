<?php

namespace MChristie\Semaphore\Symbols\Tests;

use MChristie\Semaphore\Bits;
use PHPUnit\Framework\TestCase;
use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\Hexadecimal;

class HexadecimalTest extends TestCase
{
    const TEST = 'F5D741A3260EC9B8F5D741A3260EC9B8';

    public function test_hexadecimal_variable_encodes(): array
    {
        $hex = new Hexadecimal(0);

        $hex->setValue(self::TEST);
        $bits = $hex->getBits();

        $this->assertEquals(33, count($bits));

        $end = end($bits)->toInt();
        $this->assertEquals(16, $end);

        return $bits;
    }

    /**
     * @depends test_hexadecimal_variable_encodes
     */
    public function test_hexadecimal_variable_decodes(array $bits): void
    {
        $hex = new Hexadecimal(0);

        // Add some extra bits to test it stops once satisfied
        $bits[] = Bits::pad($hex->getBitLength(), [true, false]);
        $bits[] = Bits::pad($hex->getBitLength(), [false, true]);

        do {
            $hex->addBits(array_shift($bits));
        } while ($hex->isSatisfied() === false);

        $this->assertTrue($hex->isSatisfied());
        $this->assertEquals(self::TEST, $hex->getValue());
        $this->assertEquals(2, count($bits));
    }

    public function test_hexadecimal_fixed_encodes(): array
    {
        $hex = new Hexadecimal(32);

        $hex->setValue(self::TEST);
        $bits = $hex->getBits();

        $this->assertEquals(32, count($bits));

        return $bits;
    }

    /**
     * @depends test_hexadecimal_fixed_encodes
     */
    public function test_hexadecimal_fixed_decodes(array $bits): void
    {
        $hex = new Hexadecimal(32);

        do {
            $hex->addBits(array_shift($bits));
        } while ($hex->isSatisfied() === false);

        $this->assertEquals(self::TEST, $hex->getValue());
    }
}
