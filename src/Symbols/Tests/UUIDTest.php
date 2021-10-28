<?php

namespace MChristie\Semaphore\Symbols\Tests;

use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\UUID;
use PHPUnit\Framework\TestCase;

class UUIDTest extends TestCase
{
    const TEST = 'bf51f3e9-e0dc-4270-97f9-deeb02ea396a';

    public function test_uuid_encodes(): array
    {
        $hex = new UUID();

        $hex->setValue(self::TEST);
        $bits = $hex->getBits();

        $this->assertEquals(32, count($bits));

        return $bits;
    }

    /**
     * @depends test_uuid_encodes
     */
    public function test_uuid_decodes(array $bits): void
    {
        $hex = new UUID(0);

        do {
            $hex->addBits(array_shift($bits));
        } while ($hex->isSatisfied() === false);

        $this->assertEquals(self::TEST, $hex->getValue());
    }
}
