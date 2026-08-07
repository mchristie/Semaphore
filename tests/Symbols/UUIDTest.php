<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests\Symbols;

use MChristie\Semaphore\Symbols\UUID;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class UUIDTest extends TestCase
{
    private const TEST = 'bf51f3e9-e0dc-4270-97f9-deeb02ea396a';

    public function test_uuid_encodes(): array
    {
        $uuid = new UUID();

        $uuid->setValue(self::TEST);
        $bits = $uuid->getBits();

        $this->assertEquals(32, count($bits));

        return $bits;
    }

    #[Depends('test_uuid_encodes')]
    public function test_uuid_decodes(array $bits): void
    {
        $uuid = new UUID(false);

        do {
            $uuid->addBits(array_shift($bits));
        } while ($uuid->isSatisfied() === false);

        $this->assertEquals(self::TEST, $uuid->getValue());
    }
}
