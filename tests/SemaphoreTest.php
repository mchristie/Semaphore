<?php

declare(strict_types=1);

namespace MChristie\Semaphore\Tests;

use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Index;
use MChristie\Semaphore\Library;
use MChristie\Semaphore\Semaphore;
use MChristie\Semaphore\Symbols\Alphanumeric;
use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\DateTime;
use MChristie\Semaphore\Symbols\Enum;
use MChristie\Semaphore\Symbols\Hexadecimal;
use MChristie\Semaphore\Symbols\Integer;
use MChristie\Semaphore\Symbols\UUID;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class SemaphoreTest extends TestCase
{
    private array $values = [
        'firstBool' => true,
        'secondBool' => false,
        'firstHex' => 'AB67F', // Fixed
        'secondHex' => 'abcdef12345', // Variable
        'uuid' => 'DE9F6D0A-2DCE-4E9B-ABED-F6002E5E173F',
        'alpha' => 'ThisIs1BigLongSentenceWithNoSpaces999',
    ];

    private function getSemaphore(string $characterSet): Semaphore
    {
        $index = new Index(
            (new Hexadecimal(1))->setValue('a'),
            [
                'firstBool' => new Boolean(),
                'secondBool' => new Boolean(),
                'firstHex' => new Hexadecimal(5),
                'secondHex' => new Hexadecimal(0, false),
                'uuid' => new UUID(),
                'alpha' => new Alphanumeric(),
            ]
        );
        $otherIndex = new Index(
            (new Hexadecimal(1))->setValue('b'),
            [
                'bool' => new Boolean(),
            ]
        );

        $library = new Library($index, $otherIndex);

        return new Semaphore(new Hexadecimal(1), $library, $characterSet);
    }

    public function test_encodes_safer_ascii(): string
    {
        $semaphore = $this->getSemaphore(CharacterSets::SAFER_ASCII);

        $encoded = $semaphore->encodeValues('A', $this->values);
        $this->assertEquals('GGSvRboRPMy6gIdWvrgEJPAWrG!TS02Vu5P#t59ONM6l92Zxt3oVtQVsMXF9R75zpAEMVMAADU', $encoded);

        return $encoded;
    }

    #[Depends('test_encodes_safer_ascii')]
    public function test_decodes_safer_ascii(string $encoded): void
    {
        $semaphore = $this->getSemaphore(CharacterSets::SAFER_ASCII);

        $decoded = $semaphore->decodeValues($encoded);

        $this->assertEquals($this->values, $decoded);
    }

    public function test_encodes_hexadecimal(): string
    {
        $semaphore = $this->getSemaphore(CharacterSets::HEXADECIMAL);

        $encoded = $semaphore->encodeValues('A', $this->values);
        $this->assertEquals('AAAD9FD4B635CF088642C37A7DB428B7393A6EAFB7D800B9785CFF745272C70195242F61743639774E5CC3BA49D47163664A30E709249F8', $encoded);

        return $encoded;
    }

    #[Depends('test_encodes_hexadecimal')]
    public function test_decodes_hexadecimal(string $encoded): void
    {
        $semaphore = $this->getSemaphore(CharacterSets::HEXADECIMAL);

        $decoded = $semaphore->decodeValues($encoded);

        $this->assertEquals($this->values, $decoded);
    }

    public function test_round_trips_enum_integer_and_datetime(): void
    {
        $index = new Index(
            (new Hexadecimal(1))->setValue('c'),
            [
                'role' => new Enum('admin', 'editor', 'viewer'),
                'status' => new Enum('active', 'suspended'),
                'loginCount' => new Integer(100000),
                'createdAt' => new DateTime(),
            ]
        );

        $semaphore = new Semaphore(
            new Hexadecimal(1),
            new Library($index),
            CharacterSets::SAFER_ASCII,
        );

        $createdAt = 1_691_400_000; // a fixed Unix timestamp
        $encoded = $semaphore->encodeValues('C', [
            'role' => 'editor',
            'status' => 'active',
            'loginCount' => 4213,
            'createdAt' => $createdAt,
        ]);

        $decoded = $semaphore->decodeValues($encoded);

        $this->assertSame('editor', $decoded['role']);
        $this->assertSame('active', $decoded['status']);
        $this->assertSame(4213, $decoded['loginCount']);
        $this->assertSame($createdAt, $decoded['createdAt']->getTimestamp());
    }

    public function test_unknown_index_identifier_throws(): void
    {
        $semaphore = $this->getSemaphore(CharacterSets::SAFER_ASCII);

        $this->expectException(\InvalidArgumentException::class);
        $semaphore->encodeValues('Z', $this->values);
    }
}
