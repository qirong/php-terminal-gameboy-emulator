<?php

require_once __DIR__.'/vendor/autoload.php';

use GameBoy\Core;
use GameBoy\Settings;

$rom = base64_decode(file_get_contents('drmario.rom'));

$core = new Core(null, null, $rom);
$core->start();

if ($core->stopEmulator & 2 == 2) {
    $core->stopEmulator &= 1;
    $core->lastIteration = microtime(true);
    // echo "Starting the iterator." . PHP_EOL;

    //gbRunInterval = setInterval(continueCPU, settings[20]);

    while (true) {
        sleep(Settings::$settings[20] / 1000);
        $core->run();
    }
} else if (($core->stopEmulator & 2) == 0) {
    echo "The GameBoy core is already running." . PHP_EOL;
}
else {
    echo "GameBoy core cannot run while it has not been initialized." . PHP_EOL;
}