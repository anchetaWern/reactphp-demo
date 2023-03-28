<?php

// interval-and-timeout.php

use React\EventLoop\TimerInterface;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$loop->addTimer(2, function () {
    echo "At the second iteration\n";
});

$loop->addTimer(4, function () {
    echo "At the fourth iteration\n";
});

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