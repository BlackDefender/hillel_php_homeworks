<?php

class GetValueProcessor
{
    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=laravel_repo', 'root', '');
    }

    public function process($msg)
    {
        $parsedMessage = json_decode($msg);

        $stmt = $this->conn->prepare('SELECT `value` FROM storages WHERE `key`=? AND `user_id`=?');
        $stmt->execute([$parsedMessage->key, $parsedMessage->user_id]);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetch();
    }
}