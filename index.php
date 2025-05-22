<?php
declare(strict_types = 1);

require_once(__DIR__ . '/vendor/autoload.php');

use Xpl\Task\PinGenerator;


$obj = new PinGenerator;
$pins = $obj->generate();

print_r($pins);