<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests\Symbols;

use InvalidArgumentException;
use MChristie\Semaphore\Symbols\Enum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function test_bit_length_scales_with_case_count(): void
    {
        $this->assertEquals(1, (new Enum('a'))->getBitLength());
        $this->assertEquals(1, (new Enum('a', 'b'))->getBitLength());
        $this->assertEquals(2, (new Enum('a', 'b', 'c'))->getBitLength());
        $this->assertEquals(2, (new Enum('a', 'b', 'c', 'd'))->getBitLength());
        $this->assertEquals(3, (new Enum('a', 'b', 'c', 'd', 'e'))->getBitLength());
    }

    public function test_round_trips(): void
    {
        $encoder = new Enum('admin', 'editor', 'viewer');
        $encoder->setValue('viewer');
        $bits = $encoder->getBits();

        $this->assertCount(1, $bits);

        $decoder = new Enum('admin', 'editor', 'viewer');
        $decoder->addBits($bits[0]);

        $this->assertTrue($decoder->isSatisfied());
        $this->assertSame('viewer', $decoder->getValue());
    }

    public function test_supports_integer_cases(): void
    {
        $encoder = new Enum(10, 20, 30);
        $encoder->setValue(20);

        $decoder = new Enum(10, 20, 30);
        $decoder->addBits($encoder->getBits()[0]);

        $this->assertSame(20, $decoder->getValue());
    }

    public function test_requires_at_least_one_case(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Enum();
    }

    public function test_rejects_unknown_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new Enum('a', 'b'))->setValue('c');
    }

    public function test_string_and_integer_cases_are_distinct(): void
    {
        // Strict comparison means '1' (string) and 1 (int) are separate cases.
        $enum = new Enum('1', 1);
        $enum->setValue(1);

        $this->assertSame(1, $enum->getValue());
    }
}
