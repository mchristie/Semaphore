# Semaphore

Semaphore packs a set of typed values into the fewest characters possible. You
describe the shape of your data once as a schema of typed *symbols*, and
Semaphore bit-packs the values and re-encodes them into a compact string —
handy for compact token payloads, signed cookies, or anything you want to keep
short. (For a strictly URL-safe result, encode into `ALPHANUMERIC` or
base64url-encode the output.)

In the bundled [demo](Demo/demo.php), a 9-field payload shrinks from **218
bytes of JSON to 36 bytes**:

| Encoding             | Size       |
| -------------------- | ---------- |
| JSON                 | 218 bytes  |
| JSON + base64        | 292 bytes  |
| **Semaphore**        | **36 bytes** |
| Semaphore + base64   | 48 bytes   |

> [!IMPORTANT]
> Semaphore is a **compression / serialization** library, not a security one.
> The output is not encrypted or signed — anyone with the schema can decode it,
> and the "shuffled" character sets are light obfuscation, not cryptography. If
> the payload must not be read or tampered with, sign or encrypt it separately
> (e.g. wrap the encoded string in a signed JWT).

## Requirements

- PHP 8.3+

## Installation

```bash
composer require mchristie/semaphore
```

## How it works

Most serialization formats spend bytes describing structure (JSON repeats every
key, quotes every string, and stores numbers as text). Semaphore removes that
overhead by agreeing the structure ahead of time:

1. A **schema** (`Index`) declares each field and its type (`Symbol`).
2. Each symbol knows the minimum number of *bits* its value needs — a boolean
   is 1 bit, a value from a list of 4 options is 2 bits, a UUID is a fixed
   128 bits, and so on.
3. All the fields are concatenated into one continuous **bit stream**.
4. That bit stream is re-sliced into a target **character set** (by default a
   90-character ASCII set), producing the final string.

Decoding runs the same schema in reverse. Because both sides share the schema,
none of the field names or type information needs to travel with the data.

## Quick start

```php
use MChristie\Semaphore\CharacterSets;
use MChristie\Semaphore\Index;
use MChristie\Semaphore\Library;
use MChristie\Semaphore\Semaphore;
use MChristie\Semaphore\Symbols\Boolean;
use MChristie\Semaphore\Symbols\Enum;
use MChristie\Semaphore\Symbols\Hexadecimal;
use MChristie\Semaphore\Symbols\Integer;

// 1. Describe the data. The first argument is the schema's identifier symbol,
//    given a fixed value ('1'); the second is the ordered map of fields.
$index = new Index(
    (new Hexadecimal(1))->setValue('1'),
    [
        'role'      => new Enum('owner', 'admin', 'editor', 'viewer'),
        'canExport' => new Boolean(),
        'seats'     => new Integer(1000),
    ]
);

// 2. Put the schema in a Library and hand it to Semaphore. The identifier
//    symbol passed here must match the type/width used by your indexes.
$semaphore = new Semaphore(
    new Hexadecimal(1),
    new Library($index),
    CharacterSets::SAFER_ASCII,
);

// 3. Encode by referencing the schema identifier ('1').
$encoded = $semaphore->encodeValues('1', [
    'role'      => 'admin',
    'canExport' => true,
    'seats'     => 42,
]);
// e.g. "5xk"

// 4. Decode. The identifier is embedded in the output, so Semaphore knows
//    which schema in the library to use.
$values = $semaphore->decodeValues($encoded);
// ['role' => 'admin', 'canExport' => true, 'seats' => 42]
```

## Concepts

| Class          | Role |
| -------------- | ---- |
| `Symbol`       | A single typed field that knows how to convert its value to and from bits. |
| `Index`        | A schema: an identifier symbol plus an ordered, named map of symbols. |
| `Library`      | A collection of indexes, keyed by identifier, so one Semaphore can handle several payload shapes. |
| `Semaphore`    | The encoder/decoder that ties a library to a target character set. |
| `CharacterSets`| Ready-made character sets to encode into (see below). |

### Multiple schemas

A `Library` can hold several indexes. Each index has a distinct identifier, and
that identifier is written into the encoded output, so `decodeValues()` always
knows which schema to apply:

```php
$library = new Library($userTokenIndex, $sessionIndex);
$semaphore = new Semaphore(new Hexadecimal(1), $library);

$encoded = $semaphore->encodeValues('1', $userValues);   // uses $userTokenIndex
$decoded = $semaphore->decodeValues($encoded);            // picks it back automatically
```

## Symbols

| Symbol | Constructor | Notes |
| ------ | ----------- | ----- |
| `Boolean` | `new Boolean()` | 1 bit. |
| `Integer` | `new Integer(int $max)` | Unsigned. Allocates just enough bits to hold `$max` (e.g. `Integer(1000)` → 10 bits, range 0–1023). Use the same `$max` when decoding. |
| `Enum` | `new Enum(int\|string ...$cases)` | Encodes one value from a fixed list in `ceil(log2(n))` bits. The most compact choice for a closed set of options (status, role, type). |
| `Hexadecimal` | `new Hexadecimal(int $length = 0, bool $uppercase = true)` | `$length = 0` is variable length (terminated by an end marker); a positive length is fixed. |
| `Alphanumeric` | `new Alphanumeric(int $length = 0, bool $spaces = false)` | `[0-9a-zA-Z]`, optionally including spaces. Variable or fixed length. |
| `UUID` | `new UUID(bool $uppercase = true)` | A 128-bit UUID stored as 32 hex characters. Dashes are added back on decode. |
| `ULID` | `new ULID()` | A 26-character Crockford Base32 ULID. |
| `DateTime` | `new DateTime(int $bits = 32, int $epoch = 0)` | A point in time as seconds from an epoch. Default 32 bits from the Unix epoch (covers 1970–2106). Accepts a `DateTimeInterface`, an int timestamp, or a date string; returns a `DateTimeImmutable` (UTC, whole seconds). Narrow `$bits`/`$epoch` to save space for near-future dates. |

Fixed vs variable length is a space trade-off: fixed-length symbols store no
terminator, while variable-length symbols append a small end marker so any
length round-trips.

### Adding your own symbol

Extend `Symbol` (or `Symbols\CharacterEncodingSymbol` for anything backed by a
character set) and implement how the value maps to and from bits. See
[`src/Symbols/Enum.php`](src/Symbols/Enum.php) for a compact, self-contained
example.

## Character sets

The final string is drawn from a character set you choose. Smaller sets are
safer in more places; larger sets pack more bits per character.

| Constant | Characters | Notes |
| -------- | ---------- | ----- |
| `SAFER_ASCII` | 90 ASCII characters | **Default.** Good density; omits quotes, backtick and backslash that often need escaping. Not URL-safe. |
| `ASCII` | 93 printable ASCII characters | Slightly denser than `SAFER_ASCII`. |
| `ALPHANUMERIC` | `0-9a-zA-Z` | Safe almost everywhere. |
| `ALPHANUMERIC_SPACE` | alphanumeric + space | |
| `HEXADECIMAL` | `0-9A-F` | Widest compatibility, least dense. |
| `CROCKFORDS_BASE32` | Crockford Base32 | Case-insensitive, avoids ambiguous characters. |

Each set also has a `*_SHUFFLED` variant with the characters reordered. This
only scrambles the output visually — treat it as obfuscation, never as
encryption.

## Try the demo

```bash
composer install
php Demo/demo.php
```

It encodes a sample access-token payload, compares the size against JSON, and
decodes it back.

## Development

```bash
composer test        # run the PHPUnit suite
composer lint        # check coding standards (PSR-12)
composer lint:fix    # auto-fix coding standards
```

## Caveats

- **The schema is the contract.** Encoder and decoder must use the same index
  definition (symbol types, order, and options such as `Integer`'s `$max`). A
  mismatch produces garbage or an exception, not a helpful error.
- **Integers are unsigned** and bounded by the `$max` you declare.
- **`DateTime` keeps whole seconds** and returns UTC `DateTimeImmutable`
  objects, so sub-second precision and the original timezone are not preserved.
- **Not a security boundary** — see the note at the top.

## License

Released under the [MIT License](LICENSE).
