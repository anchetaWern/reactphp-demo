<?php 
// upload-server.php

use React\EventLoop\LoopInterface;

use React\Http\Server;
use React\Socket\SocketServer;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;

use React\Http\Middleware\StreamingRequestMiddleware;
use React\Http\Middleware\RequestBodyBufferMiddleware;
use React\Http\Middleware\RequestBodyParserMiddleware;

use React\ChildProcess\Process;

require 'vendor/autoload.php';


$loop = React\EventLoop\Factory::create();

$server = new Server(
    $loop,  

    new StreamingRequestMiddleware(),
    new RequestBodyBufferMiddleware(5 * 1024 * 1024), // 5 Mb
    new RequestBodyParserMiddleware(5 * 1024 * 1024, 1), // 5 Mb
    
    function (ServerRequestInterface $request) use ($loop) { 
    
        if ($request->getMethod() === 'POST') {
        
            $files = $request->getUploadedFiles();

            
            $file = $files['file'];
            
            $process = new Process(
                "cat > uploads/{$file->getClientFilename()}",
                __DIR__
            );

            $process->start($loop);
            $process->stdin->write($file->getStream()->getContents());
         
            return new Response(
                200, ['Content-Type' => 'text/plain'], "Uploaded!"
            ); 
     }
});

$socket = new SocketServer(8080); 
$server->listen($socket);

$loop->run();