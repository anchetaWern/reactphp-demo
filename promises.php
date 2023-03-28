<?php
// promises.php

use React\Promise\Deferred;

require 'vendor/autoload.php';

function httpRequest($url) {
    $response = file_get_contents($url);
    $deferred = new Deferred();

    if($response) {
        $deferred->resolve($response);
    } else {
        $deferred->reject(new Exception('No response returned'));
    }

    return $deferred->promise();
}

httpRequest('https://pokeapi.co/api/v2/pokemon/ditto')
    ->then(function ($response) {
        $response_arr = json_decode($response, true);
        return [
            'name' => $response_arr['name'],
            'sprite' => $response_arr['sprites']['front_default'],
        ];
    })
    ->then(
        function ($response) {
            print_r($response);
        })
    ->otherwise(
        function (Exception $exception) {
            echo $exception->getMessage();
        });