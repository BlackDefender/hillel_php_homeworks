<?php

namespace App\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue
{
  public function __construct($queueName)
  {
    $this->connection = new AMQPStreamConnection(
      env('RMQ_HOST'),
      intval(env('RMQ_PORT')),
      env('RMQ_USER'),
      env('RMQ_PASS')
    );

    $this->queueName = $queueName;

    $this->channel = $this->connection->channel();
    $this->channel->queue_declare($queueName, false, false, false, false);
  }

  public function broadcast($message)
  {
    $msg = new AMQPMessage(json_encode($message));
    $this->channel->basic_publish($msg, '', $this->queueName);
  }

  public function listenAnswer()
  {
      $channel = $this->channel;
      $answer = null;
      $callback = function ($msg) use ($channel, &$answer) {
          $data = json_decode($msg->body);
          $answer = $data->value;
          $channel->callbacks = [];
      };
      $channel->basic_consume($this->queueName, '', false, true, false, false, $callback);

      while (count($channel->callbacks)) {
          $channel->wait();
      }
      return $answer;
  }

  public function __destruct()
  {
    $this->channel->close();
    $this->connection->close();
  }
}
