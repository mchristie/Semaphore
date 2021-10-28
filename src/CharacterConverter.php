<?php

namespace MChristie\Semaphore;

use ArgumentCountError;
use Exception;
use Generator;

final class CharacterConverter
{
    private int $bitLength;

    public function __construct(
        private bool $actingAsStorage,
        private string $characterSet,
        private bool $appendEndCharacter
    ) {
        $this->calculateBitLength();
    }

    public function getCharacterCount(): int
    {
        if ($this->appendEndCharacter) {
            return strlen($this->characterSet) + 1;
        }

        return strlen($this->characterSet);
    }

    public function getBitLength(): int
    {
        return $this->bitLength;
    }

    public function encodeCharacters(string $characters): array
    {
        $return = [];
        $chars = str_split($characters);

        foreach ($chars as $char) {
            $return[] = $this->encodeCharacter($char);
        }

        if ($this->appendEndCharacter) {
            $return[] = $this->encodeEndCharacter();
        }

        return $return;
    }

    public function decodeCharacters(Bits ...$bits): string
    {
        $return = [];
        foreach ($bits as $bit) {
            if ($this->isEndCharacter($bit->toInt())) {
                break;
            }

            $return[] = $this->decodeCharacter($bit->toInt());
        }

        return implode('', $return);
    }

    public function encodeCharacter(string $char): Bits
    {
        if (strlen($char) !== 1 || str_contains($this->characterSet, $char) === false) {
            throw new Exception("Unable to encode character '{$char}'");
        }

        $int = strpos($this->characterSet, $char);

        return Bits::fromInt($this->bitLength, $int);
    }

    public function decodeCharacter(int $int): ?string
    {
        if ($this->isEndCharacter($int)) {
            return null;
        }

        if ($int < 0 || $int > strlen($this->characterSet)) {
            throw new Exception("Unable to decode character value '{$int}' - " . strlen($this->characterSet));
        }

        return substr($this->characterSet, $int, 1);
    }

    public function isEndCharacter(int $int): bool
    {
        return $int === strlen($this->characterSet);
    }

    private function calculateBitLength()
    {
        $count = $this->getCharacterCount();

        $func = $this->actingAsStorage ? 'floor' : 'ceil';
        $this->bitLength = (int)$func(log($count, 2));
    }

    private function encodeEndCharacter(): Bits
    {
        return Bits::fromInt($this->bitLength, strlen($this->characterSet));
    }

    private function getPaddingSide(): string
    {
        return $this->actingAsStorage ? Bits::PAD_RIGHT : Bits::PAD_LEFT;
    }
}
