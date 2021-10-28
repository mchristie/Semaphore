<?php

namespace MChristie\Semaphore;

use Generator;
use InvalidArgumentException;

final class Library
{
    private array $indexes = [];

    public function __construct(Index ...$indexes)
    {
        foreach ($indexes as $index) {
            $this->addIndex($index);
        }
    }

    public function addIndex(Index $index)
    {
        $this->index[$index->getIdentifier()] = $index;
    }

    public function getIndex(string $identifier)
    {
        return $this->index[$identifier];
    }
}
