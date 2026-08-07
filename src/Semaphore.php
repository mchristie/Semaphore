<?php

declare(strict_types=1);

namespace MChristie\Semaphore;

use Exception;
use MChristie\Semaphore\Symbols\CharacterEncodingSymbol;

final class Semaphore
{
    private CharacterConverter $converter;

    public function __construct(
        private CharacterEncodingSymbol $identifier,
        private Library $library,
        private string $characterSet = CharacterSets::SAFER_ASCII,
    ) {
        $this->converter = new CharacterConverter(true, $this->characterSet, true);
    }

    public function encodeValues(string $index, array $values): string
    {
        $index = $this->library->getIndex($index);
        $bits = $this->convertValuesToBitStream($index, $values);
        return $this->encodeBitStream($bits);
    }

    public function decodeValues(string $encoded): array
    {
        $bits = $this->convertEncodedStringToBitStream($encoded);
        $identifier = $this->getIndexIdentifierFromBitStream($bits);
        $index = $this->library->getIndex($identifier);
        return $this->convertBitStreamToValues($index, $bits);
    }

    private function convertValuesToBitStream(Index $index, array $values): BitStream
    {
        $bits = new BitStream();
        $bits->append(
            ...$this->identifier->setValue($index->getIdentifier())->getBits()
        );

        foreach ($index->iterateSymbols() as $key => $symbol) {
            $bits->append(
                ...$symbol->setValue($values[$key])->getBits()
            );
        }

        return $bits;
    }

    private function convertEncodedStringToBitStream(string $encoded): BitStream
    {
        $bits = new BitStream();
        $bits->append(...$this->converter->encodeCharacters($encoded));

        return $bits;
    }

    private function getIndexIdentifierFromBitStream(BitStream $bitStream): string
    {
        $bits = $bitStream->firstChunk($this->identifier->getBitLength());
        $this->identifier->reset();
        $this->identifier->addBits($bits);

        return $this->identifier->getValue();
    }

    private function encodeBitStream(BitStream $bits): string
    {
        return $this->converter->decodeCharacters(
            ...$bits->chunk($this->converter->getBitLength())
        );
    }

    private function convertBitStreamToValues(Index $index, BitStream $bits): array
    {
        $values = [];
        // Knock the bits off for the index identifier
        $bits->pump($this->identifier->getBitLength());

        foreach ($index->iterateSymbols() as $key => $symbol) {
            do {
                try {
                    $symbol->addBits($bits->pump($symbol->getBitLength()));
                } catch (Exception $e) {
                    throw new Exception("Failed converting '{$key}' ('{$symbol->getValue()}') - {$e->getMessage()}");
                }
            } while ($symbol->isSatisfied() === false);

            $values[$key] = $symbol->getValue();
        }

        return $values;
    }
}
