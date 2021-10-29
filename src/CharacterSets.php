<?php

namespace MChristie\Semaphore;

final class CharacterSets
{
    public const ALPHANUMERIC = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const ALPHANUMERIC_SPACE = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
    public const HEXADECIMAL = '0123456789ABCDEF';
    public const CROCKFORDS_BASE32 = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    public const ASCII = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&\'()*+,-./:;<=>?@[|]^_`{}~';
    public const SAFER_ASCII = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&()*+,-./:;<=>?@[|]^_{}~';

    public const ALPHANUMERIC_SHUFFLED = '4JWOwBHlu5RXry7ha23mPS9TxpKfQ6zMCstNeIGDEUA0jvndYq8ZFckLigV1ob';
    public const ALPHANUMERIC_SPACE_SHUFFLED = '4JWOwBHlu5RXry7 ha23mPS9TxpKfQ6zMCstNeIGDEUA0jvndYq8ZFckLigV1ob';
    public const HEXADECIMAL_SHUFFLED = '2DA1489E735C6FB0';
    public const CROCKFORDS_BASE32_SHUFFLED = 'PK90HJNX5DGE6ZWVQCY23T8AMFS7B4R1';
    public const ASCII_SHUFFLED = 'B{F^e5Xc-}a8CGVtbA|d:%(>K9yL#UZ=g<iI,JTwh0+xWpjElzQ3&sRN_q@`PSr!m\'~fkou)[7"*$vO.14D?;Y6H2/]Mn';
    public const SAFER_ASCII_SHUFFLED = '7894(_XnZIpTBowu:?5yaeS*V=WzqCL+1Dk6Ocf@N]-$t.GhUgHMld<0K;|#RY2EP[rs/{})iJ,j%Fm>Qbv~!^&A3x';
}
