<?php

declare(strict_types=1);

use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Index;
use MChristie\Semaphore\Library;
use MChristie\Semaphore\Semaphore;
use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\DateTime;
use MChristie\Semaphore\Symbols\Enum;
use MChristie\Semaphore\Symbols\Hexadecimal;
use MChristie\Semaphore\Symbols\Integer;
use MChristie\Semaphore\Symbols\UUID;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/helpers.php';

// An Index is a schema: an ordered map of field name => typed Symbol. Its
// identifier ('1') lets a Library hold several schemas and choose the right one
// automatically when decoding. Here we model a compact API access token.
$index = new Index(
    (new Hexadecimal(1))->setValue('1'),
    [
        'role' => new Enum('owner', 'admin', 'editor', 'viewer'),
        'plan' => new Enum('free', 'pro', 'enterprise'),
        'canExport' => new Boolean(),
        'canInvite' => new Boolean(),
        'betaFeatures' => new Boolean(),
        'seats' => new Integer(1000),
        'userId' => new UUID(false),
        'issuedAt' => new DateTime(),
        'expiresAt' => new DateTime(),
    ]
);

$semaphore = new Semaphore(
    new Hexadecimal(1),
    new Library($index),
    CharacterSets::SAFER_ASCII,
);

$values = [
    'role' => 'admin',
    'plan' => 'pro',
    'canExport' => true,
    'canInvite' => false,
    'betaFeatures' => true,
    'seats' => 42,
    'userId' => 'de9f6d0a-2dce-4e9b-abed-f6002e5e173f',
    'issuedAt' => '2026-08-07 09:00:00 UTC',
    'expiresAt' => '2026-08-08 09:00:00 UTC',
];

heading('Input values');
foreach ($values as $key => $value) {
    line($key, display($value));
}

$json = json_encode($values, JSON_THROW_ON_ERROR);
$encoded = $semaphore->encodeValues('1', $values);

heading('Size comparison');
line('JSON', bytes($json));
line('JSON + base64', bytes(base64_encode($json)));
line('Semaphore', bytes($encoded));
line('Semaphore + base64', bytes(base64_encode($encoded)));

heading('Encoded');
echo $encoded . PHP_EOL;

heading('Decoded round-trip');
foreach ($semaphore->decodeValues($encoded) as $key => $value) {
    line($key, display($value));
}
