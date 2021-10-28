<?php

function wait()
{
    fgets(STDIN);
    return '';
}

function section(string $title = '')
{
    echo PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . $title . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
}

function lines(string ...$lines)
{
    foreach ($lines as $line) {
        echo $line . PHP_EOL;
    }
}

function values(array $values)
{
    foreach ($values as $key => $value) {
        echo $key . ' => ' . var_export($value, true) . PHP_EOL;
    }
}

function size(string $str)
{
    return number_format(strlen($str), 0, 2) . ' B';
}
