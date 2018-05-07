<?php

class User
{
    private static function prepareValue($value){
        return htmlspecialchars(trim($value));
    }

    public function __construct($name, $email)
    {
        $this->name = self::prepareValue($name);
        $this->email = self::prepareValue($email);
    }
}