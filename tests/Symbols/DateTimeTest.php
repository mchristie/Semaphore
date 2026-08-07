<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests\Symbols;

use DateTimeImmutable;
use InvalidArgumentException;
use MChristie\Semaphore\Symbols\DateTime;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    public function test_default_bit_length(): void
    {
        $this->assertEquals(32, (new DateTime())->getBitLength());
    }

    public function test_round_trips_integer_timestamp(): void
    {
        $timestamp = 1_691_400_000;

        $encoder = new DateTime();
        $encoder->setValue($timestamp);

        $decoder = new DateTime();
        $decoder->addBits($encoder->getBits()[0]);

        $this->assertTrue($decoder->isSatisfied());
        $this->assertInstanceOf(DateTimeImmutable::class, $decoder->getValue());
        $this->assertSame($timestamp, $decoder->getValue()->getTimestamp());
    }

    public function test_accepts_date_string(): void
    {
        $encoder = new DateTime();
        $encoder->setValue('2023-08-07 09:20:00 UTC');

        $decoder = new DateTime();
        $decoder->addBits($encoder->getBits()[0]);

        $this->assertSame(
            (new DateTimeImmutable('2023-08-07 09:20:00 UTC'))->getTimestamp(),
            $decoder->getValue()->getTimestamp(),
        );
    }

    public function test_accepts_datetime_object(): void
    {
        $when = new DateTimeImmutable('2024-01-01 00:00:00 UTC');

        $encoder = new DateTime();
        $encoder->setValue($when);

        $this->assertSame($when->getTimestamp(), $encoder->getValue()->getTimestamp());
    }

    public function test_custom_epoch_narrows_range(): void
    {
        $epoch = (new DateTimeImmutable('2020-01-01 UTC'))->getTimestamp();
        $timestamp = (new DateTimeImmutable('2020-01-02 12:00:00 UTC'))->getTimestamp();

        // 17 bits from a 2020 epoch is enough for a value ~1.5 days later.
        $encoder = new DateTime(17, $epoch);
        $encoder->setValue($timestamp);

        $decoder = new DateTime(17, $epoch);
        $decoder->addBits($encoder->getBits()[0]);

        $this->assertSame($timestamp, $decoder->getValue()->getTimestamp());
    }

    public function test_throws_when_value_exceeds_bit_width(): void
    {
        $encoder = new DateTime(8);
        $encoder->setValue(100_000);

        $this->expectException(InvalidArgumentException::class);
        $encoder->getBits();
    }

    public function test_rejects_invalid_bit_width(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new DateTime(64);
    }
}
