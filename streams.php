<?php 
// streams.php

use React\Stream\ReadableResourceStream;

require 'vendor/autoload.php';


$loop = React\EventLoop\Factory::create();

$logFile = './logfile.txt';

$readChunkSize = 100;

$stream = new ReadableResourceStream(fopen($logFile, 'r'), $loop, $readChunkSize);
$stream->on(
    'data',
    function ($data) {
        echo "===" . $data . "\n";
    }
);

$stream->on('end', fn() => print "Finished reading the file."); 
$loop->run();