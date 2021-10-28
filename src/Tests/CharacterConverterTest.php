<?php

namespace MChristie\Semaphore\Tests;

use MChristie\Semaphore\Bits;
use PHPUnit\Framework\TestCase;
use MChristie\Semaphore\BitStream;
use MChristie\Semaphore\CharacterConverter;
use MChristie\Semaphore\CharacterSets;

class CharacterConverterTest extends TestCase
{
    private const CHARS = '123abc';

    public function test_instantiates(): void
    {
        $cc = new CharacterConverter(false, self::CHARS, false);

        $this->assertEquals(strlen(self::CHARS), $cc->getCharacterCount());
        $this->assertEquals(3, $cc->getBitLength());
    }

    public function test_end_character(): void
    {
        $cc = new CharacterConverter(false, self::CHARS, true);

        $this->assertFalse($cc->isEndCharacter(5));
        $this->assertTrue($cc->isEndCharacter(6));
        $this->assertFalse($cc->isEndCharacter(7));
    }

    public function test_encodes_small(): void
    {
        $cc = new CharacterConverter(false, self::CHARS, true);
        $bits = $cc->encodeCharacters('2b');

        $expected = [
            [false, false, true],
            [true, false, false],
        ];

        $this->assertEquals(strlen(self::CHARS) + 1, $cc->getCharacterCount());
        $this->assertEquals($expected[0], $bits[0]->getBits(), 'First bits');
        $this->assertEquals($expected[1], $bits[1]->getBits(), 'Second bits');
    }

    public function test_decodes_small(): void
    {
        $cc = new CharacterConverter(false, self::CHARS, false);
        $chars = $cc->decodeCharacters(
            Bits::create(3, [false, false, true]),
            Bits::create(3, [true, false, false]),
        );

        $this->assertEquals('2b', $chars);
    }

    public function test_encodes_ascii(): void
    {
        $original = 'thisUsesL0tsofASC!!Ch4rs??';

        $cc = new CharacterConverter(false, CharacterSets::ASCII, false);
        $bits = $cc->encodeCharacters($original);
        $converted = $cc->decodeCharacters(...$bits);

        $this->assertEquals(strlen($original), count($bits));
        $this->assertEquals($original, $converted);
    }

    public function test_converts_between_characters(): void
    {
        $original = 'thisUsesL0tsofASC!!Ch4rs??';

        $asciConverter = new CharacterConverter(false, CharacterSets::SAFER_ASCII, true);
        $hexConverter = new CharacterConverter(true, CharacterSets::HEXADECIMAL, true);

        $stream = new BitStream();
        $stream->append(...$asciConverter->encodeCharacters($original));
        $convertedToHex = $hexConverter->decodeCharacters(
            ...$stream->chunk($hexConverter->getBitLength())
        );

        $returnStream = new BitStream();
        $returnStream->append(...$hexConverter->encodeCharacters($convertedToHex));
        $convertedBack = $asciConverter->decodeCharacters(
            ...$returnStream->chunk($asciConverter->getBitLength())
        );

        $this->assertEquals('3A4491C707071C5E00E9C303D2364CF9F262210D9CA142D0', $convertedToHex);
        $this->assertEquals($original, $convertedBack, 'Converted to hex and back didnt match');
    }
}
