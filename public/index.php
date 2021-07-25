<?php

use Library\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();
$kernel->setup();
$kernel->run();
