<?php

namespace Xpl\Task\Validation;

interface ValidatorInterface
{
    public function isValid(string $pin): bool;
}
