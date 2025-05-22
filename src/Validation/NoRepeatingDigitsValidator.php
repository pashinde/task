<?php

declare(strict_types=1);

namespace Xpl\Task\Validation;

class NoRepeatingDigitsValidator implements ValidatorInterface
{
    /**
     * Assumption: if a pin contains a same consecutive digit in it then it's considered as a repeating number
     * e.g. 1223, 2256, 1266 are repeating numbers
     */
    public function isValid(string $pin): bool
    {
        $digits = str_split($pin);
        $length = count($digits);

        for ($i = 0; $i < $length - 1; $i++) {
            if ($digits[$i] === $digits[$i + 1]) {
                return false;
            }
        }

        return true;
    }
}
