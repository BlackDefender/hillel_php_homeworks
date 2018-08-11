<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once './GetValueProcessor.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('getQueue', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) use ($channel) {
    echo ' [x] Received ', $msg->body, "\n";
    $processor = new GetValueProcessor();
    $res = $processor->process($msg->body);

    $msg = new AMQPMessage(json_encode($res));
    $channel->basic_publish($msg, '', 'answer');
};

$channel->basic_consume('getQueue', '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}
