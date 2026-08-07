<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests\Symbols;

use MChristie\Semaphore\Symbols\Integer;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
    private const TEST = 123456;

    public function test_integer_encodes(): array
    {
        $int = new Integer(124444);

        $length = $int->getBitLength();
        $int->setValue(self::TEST);
        $bits = $int->getBits();

        $this->assertEquals(17, $length);
        $this->assertEquals(1, count($bits));

        return $bits;
    }

    #[Depends('test_integer_encodes')]
    public function test_integer_decodes(array $bits): void
    {
        $int = new Integer(124444);

        do {
            $int->addBits(array_shift($bits));
        } while ($int->isSatisfied() === false);

        $this->assertEquals(self::TEST, $int->getValue());
    }
}
