<?php

declare(strict_types=1);

namespace Xpl\Task\Validation;

class NoPalindromeValidator implements ValidatorInterface
{
    public function isValid(string $pin): bool
    {
        return $pin !== strrev($pin);
    }
}
