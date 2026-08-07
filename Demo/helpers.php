<?php

declare(strict_types=1);

/**
 * Tiny presentation helpers for the demo script. Not part of the library.
 */

function heading(string $title): void
{
    echo PHP_EOL . $title . PHP_EOL . str_repeat('=', strlen($title)) . PHP_EOL;
}

function line(string $label, string $value): void
{
    echo str_pad($label, 22) . $value . PHP_EOL;
}

function bytes(string $str): string
{
    return strlen($str) . ' bytes';
}

function display(mixed $value): string
{
    if ($value instanceof DateTimeInterface) {
        return $value->format(DATE_ATOM);
    }

    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    return (string) $value;
}
