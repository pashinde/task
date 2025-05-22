<?php

namespace Xpl\Task;

use InvalidArgumentException;
use RuntimeException;

class PinGenerator
{
    private const MAX_ATTEMPTS_MULTIPLIER = 10;
    private const MIN_ALLOWED_PIN_LENGTH = 2;
    private const MAX_ALLOWED_PIN_LENGTH = 10;

    private array $validators;

    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    public function generate(int $totalNumberOfPins = 4, int $length = 4): array
    {
        $pins = [];
        $attempts = 0;
        $maxAttempts = $totalNumberOfPins * self::MAX_ATTEMPTS_MULTIPLIER;
        if ($length < self::MIN_ALLOWED_PIN_LENGTH || $length > self::MAX_ALLOWED_PIN_LENGTH) {
            throw new InvalidArgumentException(
                sprintf(
                    'Allowed PIN length range is %d - %d digits',
                    self::MIN_ALLOWED_PIN_LENGTH,
                    self::MAX_ALLOWED_PIN_LENGTH
                )
            );
        }

        while (count($pins) < $totalNumberOfPins) {
            if (++$attempts > $maxAttempts) {
                throw new RuntimeException("Could not generate enough valid PINs with the given constraints");
            }

            $pin = str_pad((string) random_int(0, (10 ** $length) - 1), $length, '0', STR_PAD_LEFT);
            if (in_array($pin, $pins, true)) {
                continue;
            }

            foreach ($this->validators as $validator) {
                if (!$validator->isValid($pin)) {
                    continue 2;
                }
            }

            $pins[] = $pin;
        }

        return $pins;
    }
}
