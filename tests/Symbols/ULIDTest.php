<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests\Symbols;

use MChristie\Semaphore\Symbols\ULID;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class ULIDTest extends TestCase
{
    private const TEST = '01FK5G8GKXVNPQSCWCQXG1VNP3';

    public function test_ulid_encodes(): array
    {
        $ulid = new ULID();

        $ulid->setValue(self::TEST);
        $bits = $ulid->getBits();

        // 26 Crockford base32 characters, 5 bits each, no end character.
        $this->assertEquals(5, $ulid->getBitLength());
        $this->assertEquals(26, count($bits));

        return $bits;
    }

    #[Depends('test_ulid_encodes')]
    public function test_ulid_decodes(array $bits): void
    {
        $ulid = new ULID();

        do {
            $ulid->addBits(array_shift($bits));
        } while ($ulid->isSatisfied() === false);

        $this->assertEquals(self::TEST, $ulid->getValue());
    }
}
