<?php

declare(strict_types=1);

require_once(__DIR__ . '/vendor/autoload.php');

use Xpl\Task\PinFactory;

$factory = new PinFactory();
$pinGenerator = $factory->create();

try {
    $pins = $pinGenerator->generate(5);
    print_r($pins);
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
