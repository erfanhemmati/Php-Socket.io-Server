<?php

require_once __DIR__ . '/vendor/autoload.php';

use Workerman\Worker;
use PHPSocketIO\SocketIO;

$io = new SocketIO(3000);

$io->on('connection', function ($socket) use ($io) {
    $socket->on('send_message', function ($data) use ($socket) {
        echo json_encode($data);

        $socket->broadcast->emit('messages', [
            'id' => $data['id'],
            'message' => $data['message']
        ]);
    });

});

Worker::runAll();
