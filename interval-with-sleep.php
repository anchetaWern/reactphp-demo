<?php
// interval-with-sleep.php

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

    sleep(5);
});


$counter2 = 0;
$loop->addPeriodicTimer(1, function (TimerInterface $timer) use (&$counter2, $loop) {
    
    $counter2 += 1;
    echo "Counter 2: {$counter2} iterations\n";

    if ($counter2 === 10) {
        echo "Counter 2: Cancelled after 10 iterations\n";
        $loop->cancelTimer($timer);
    }     
});

$loop->run();