<?php 
// child-process.php

use React\ChildProcess\Process;

require 'vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$process = new Process('curl https://pokeapi.co/api/v2/pokemon/ditto');
$process->start($loop);

$process->stdout->on('data', function ($data) {
    echo $data;
});

$loop->run();