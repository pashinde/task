<?php

use PHPUnit\Framework\TestCase;
use Xpl\Task\PinFactory;
use Xpl\Task\PinGenerator;
use Xpl\Task\Validation\ValidatorInterface;

class PinGeneratorTest extends TestCase
{
    private PinGenerator $pinGenerator;

    protected function setup(): void
    {
        $factory = new PinFactory();
        $this->pinGenerator = $factory->create();
    }

    public function testPinsAreUnique(): void
    {
        $pins = $this->pinGenerator->generate(100);
        $this->assertCount(100, $pins);
        $this->assertSame($pins, array_unique($pins));
    }

    public function testPinsHaveCorrectLength(): void
    {
        $pins = $this->pinGenerator->generate(20, 6);
        foreach ($pins as $pin) {
            $this->assertMatchesRegularExpression('/^\d{6}$/', $pin);
        }
    }

    public function testNoSequentialDigits(): void
    {
        $pins = $this->pinGenerator->generate(30);
        foreach ($pins as $pin) {
            $digits = str_split($pin);
            $length = count($digits);
            $isSequential = true;
            for ($i = 0; $i < $length - 1; $i++) {
                if ((int)$digits[$i + 1] !== (int)$digits[$i] + 1) {
                    $isSequential = false;
                    break;
                }
            }
            $this->assertFalse($isSequential, "Pin $pin is sequential");
        }
    }

    public function testNoRepeatingDigits(): void
    {
        $pins = $this->pinGenerator->generate(30);
        foreach ($pins as $pin) {
            $digits = str_split($pin);
            $length = count($digits);

            $hasRepeatingDigits = false;
            for ($i = 0; $i < $length - 1; $i++) {
                if ($digits[$i] === $digits[$i + 1]) {
                    $hasRepeatingDigits = true;
                }
            }
            $this->assertFalse($hasRepeatingDigits, "Pin $pin does not contain repeating digits");
        }
    }

    public function testNoPalindromes(): void
    {
        $pins = $this->pinGenerator->generate(30);
        foreach ($pins as $pin) {
            $this->assertNotEquals(strrev($pin), $pin, "Pin $pin is a palindrome");
        }
    }

    public function testGenerateThrowsRuntimeExceptionWhenNotEnoughValidPins(): void
    {
        $invalidValidator = new class implements ValidatorInterface {
            public function isValid(string $pin): bool
            {
                return false;
            }
        };

        $generator = new PinGenerator([$invalidValidator]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Could not generate enough valid PINs');

        $generator->generate(5);
    }

    public function testInvalidPinLengthThrowsAnException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Allowed PIN length range is 2 - 10 digits');

        $this->pinGenerator->generate(5, -4);
    }
}
