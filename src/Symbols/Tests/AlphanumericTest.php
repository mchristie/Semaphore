<?php

namespace MChristie\Semaphore\Symbols\Tests;

use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\Alphanumeric;
use PHPUnit\Framework\TestCase;

class AlphanumericTest extends TestCase
{
    const TEST = 'ThisIs1LongSentenceWithNoSpaces999';

    public function test_alphanumeric_variable_encodes(): array
    {
        $alpha = new Alphanumeric(0);

        $alpha->setValue(self::TEST);
        $bits = $alpha->getBits();

        $this->assertEquals(35, count($bits));

        return $bits;
    }

    /**
     * @depends test_alphanumeric_variable_encodes
     */
    public function test_alphanumeric_variable_decodes(array $bits): void
    {
        $alpha = new Alphanumeric(0);

        do {
            $alpha->addBits(array_shift($bits));
        } while ($alpha->isSatisfied() === false);

        $this->assertEquals(self::TEST, $alpha->getValue());
        $this->assertTrue($alpha->isSatisfied());
    }

    public function test_alphanumeric_fixed_encodes(): array
    {
        $alpha = new Alphanumeric(34);

        $alpha->setValue(self::TEST);
        $bits = $alpha->getBits();

        $this->assertEquals(34, count($bits));

        return $bits;
    }

    /**
     * @depends test_alphanumeric_fixed_encodes
     */
    public function test_alphanumeric_fixed_decodes(array $bits): void
    {
        $alpha = new Alphanumeric(34);

        do {
            $alpha->addBits(array_shift($bits));
        } while ($alpha->isSatisfied() === false);

        $this->assertEquals(self::TEST, $alpha->getValue());
        $this->assertTrue($alpha->isSatisfied());
    }
}
