<?php

declare(strict_types=1);

namespace MChristie\Semaphore;

use InvalidArgumentException;

final class Library
{
    /** @var array<string, Index> */
    private array $indexes = [];

    public function __construct(Index ...$indexes)
    {
        foreach ($indexes as $index) {
            $this->addIndex($index);
        }
    }

    public function addIndex(Index $index): void
    {
        $this->indexes[$index->getIdentifier()] = $index;
    }

    public function getIndex(string $identifier): Index
    {
        if (!isset($this->indexes[$identifier])) {
            throw new InvalidArgumentException("No index registered for identifier '{$identifier}'");
        }

        return $this->indexes[$identifier];
    }
}
