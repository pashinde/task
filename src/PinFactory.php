<?php

declare(strict_types=1);

namespace Xpl\Task;

use Xpl\Task\Validation\NoPalindromeValidator;
use Xpl\Task\Validation\NoRepeatingDigitsValidator;
use Xpl\Task\Validation\NoSequentialDigitsValidator;

class PinFactory
{
    public function create(): PinGenerator
    {
        $validators = [
            new NoSequentialDigitsValidator(),
            new NoRepeatingDigitsValidator(),
            new NoPalindromeValidator(),
        ];

        return new PinGenerator($validators);
    }
}