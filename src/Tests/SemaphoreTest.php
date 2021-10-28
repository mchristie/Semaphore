<?php

namespace MChristie\Semaphore\Tests;

use InvalidArgumentException;
use MChristie\Semaphore\Bits;
use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Index;
use MChristie\Semaphore\Library;
use MChristie\Semaphore\Semaphore;
use MChristie\Semaphore\Symbols\Alphanumeric;
use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\Hexadecimal;
use MChristie\Semaphore\Symbols\UUID;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException as RecursionContextInvalidArgumentException;

class SemaphoreTest extends TestCase
{
    private $values = [
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

    /**
     * @depends test_encodes_safer_ascii
     */
    public function test_decodes_safer_ascii(string $encoded)
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

    /**
     * @depends test_encodes_hexadecimal
     */
    public function test_decodes_hexadecimal(string $encoded)
    {
        $semaphore = $this->getSemaphore(CharacterSets::HEXADECIMAL);

        $decoded = $semaphore->decodeValues($encoded);

        $this->assertEquals($this->values, $decoded);
    }
}
