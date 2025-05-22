<?php

use PHPUnit\Framework\TestCase;
use Xpl\Task\Validation\NoSequentialDigitsValidator;

class NoSequentialDigitsValidatorTest extends TestCase
{
    private NoSequentialDigitsValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new NoSequentialDigitsValidator();
    }

    /**
     * @dataProvider invalidPINs
     */
    public function testRejectsSequentialDigits(string $pin): void
    {
        $this->assertFalse($this->validator->isValid($pin));
    }

    /**
     * @dataProvider validPINs
     */
    public function testAcceptsNonSequentialDigits(string $pin): void
    {
        $this->assertTrue($this->validator->isValid($pin));
    }

    private function invalidPINs(): array
    {
        return [
            ['1234'],
            ['4567'],
        ];
    }

    private function validPINs(): array
    {
        return [
            ['1324'],
            ['8472'],
        ];
    }
}
