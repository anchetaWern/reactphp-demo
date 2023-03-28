<?php
// interval.php

use React\EventLoop\TimerInterface;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$counter = 0;
$loop->addPeriodicTimer(1, function (TimerInterface $timer) use (&$counter, $loop) {
    
    $counter += 1;
    echo "{$counter} iterations\n";

    if ($counter === 10) {
        echo "Cancelled after 10 iterations\n";
        $loop->cancelTimer($timer);
    } 

    
});

$loop->run();