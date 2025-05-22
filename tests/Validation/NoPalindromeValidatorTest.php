<?php

use PHPUnit\Framework\TestCase;
use Xpl\Task\Validation\NoPalindromeValidator;

class NoPalindromeValidatorTest extends TestCase
{
    private NoPalindromeValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new NoPalindromeValidator();
    }

    /**
     * @dataProvider invalidPINs
     */
    public function testRejectsPalindromePins(string $pin): void
    {
        $this->assertFalse($this->validator->isValid($pin));
    }

    /**
     * @dataProvider validPINs
     */
    public function testAcceptsNonPalindromePins(string $pin): void
    {
        $this->assertTrue($this->validator->isValid($pin));
    }

    private function invalidPINs(): array
    {
        return [
            ['1221'],
            ['3443'],
            ['2112'],
        ];
    }

    private function validPINs(): array
    {
        return [
            ['1234'],
            ['1243'],
        ];
    }
}
