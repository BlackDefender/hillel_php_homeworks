<?php

class FlashMessages
{
    const MESSAGE_TYPE_INFO = 'info';
    const MESSAGE_TYPE_SUCCESS = 'success';
    const MESSAGE_TYPE_ERROR = 'danger';

    private static function ensure()
    {
        if(!isset($_SESSION['flash'])){
            $_SESSION['flash'] = [];
        }
    }
    public static function addMessage($text, $type = self::MESSAGE_TYPE_INFO)
    {
        self::ensure();
        $_SESSION['flash'][] = (object)[
            'text' => $text,
            'type' => $type,
        ];
    }
    public static function getMessages()
    {
        self::ensure();
        $messages = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $messages;
    }
}