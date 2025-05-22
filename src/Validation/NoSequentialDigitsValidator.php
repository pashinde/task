<?php

declare(strict_types=1);

namespace Xpl\Task\Validation;

class NoSequentialDigitsValidator implements ValidatorInterface
{
    public function isValid(string $pin): bool
    {
        $digits = str_split($pin);
        $length = count($digits);

        for ($i = 0; $i < $length - 1; $i++) {
            if ((int) $digits[$i + 1] !== (int) $digits[$i] + 1) {
                return true;
            }
        }

        return false;
    }
}