<?php
// timeout.php

require 'vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

// add a timer
$loop->addTimer(1, function () {
    echo "After timer\n";
});

echo "Before timer\n";

$loop->run(); // start the event loop