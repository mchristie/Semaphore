<?php

namespace MChristie\Semaphore\Symbols\Tests;

use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
    const TEST = 123456;

    public function test_Integer_encodes(): array
    {
        $int = new Integer(124444);

        $length = $int->getBitLength();
        $int->setValue(self::TEST);
        $bits = $int->getBits();

        $this->assertEquals(17, $length);
        $this->assertEquals(1, count($bits));

        return $bits;
    }

    /**
     * @depends test_Integer_encodes
     */
    public function test_Integer_decodes(array $bits): void
    {
        $int = new Integer(0);

        do {
            $int->addBits(array_shift($bits));
        } while ($int->isSatisfied() === false);

        $this->assertEquals(self::TEST, $int->getValue());
    }
}
