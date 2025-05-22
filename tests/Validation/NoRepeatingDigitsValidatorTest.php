<?php

use PHPUnit\Framework\TestCase;
use Xpl\Task\Validation\NoRepeatingDigitsValidator;

class NoRepeatingDigitsValidatorTest extends TestCase
{
    private NoRepeatingDigitsValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new NoRepeatingDigitsValidator();
    }

    /**
     * @dataProvider invalidPINs
     */
    public function testRejectsRepeatingDigits(string $pin): void
    {
        $this->assertFalse($this->validator->isValid($pin));
    }

    /**
     * @dataProvider validPINs
     */
    public function testAcceptsUniqueDigits(string $pin): void
    {
        $this->assertTrue($this->validator->isValid($pin));
        $this->assertTrue($this->validator->isValid('9072'));
    }

    private function invalidPINs(): array
    {
        return [
            ['1123'],
            ['2233'],
        ];
    }

    private function validPINs(): array
    {
        return [
            ['1234'],
            ['9072'],
        ];
    }
}
