<?php

namespace MChristie\Semaphore\Symbols;

use MChristie\Semaphore\Symbols\CharacterEncodingSymbol;

class UUID extends Hexadecimal
{
    public function __construct(private bool $uppercase = true)
    {
        parent::__construct(32, $uppercase);
    }

    public function setValue(mixed $value): static
    {
        return parent::setValue(str_replace('-', '', $value));
    }

    public function getValue(): string
    {
        $str = parent::getValue();
        $r = '[a-zA-Z0-9]';

        return preg_replace("/^({$r}{8})({$r}{4})({$r}{4})({$r}{4})({$r}{12})$/", '$1-$2-$3-$4-$5', $str);
    }
}
