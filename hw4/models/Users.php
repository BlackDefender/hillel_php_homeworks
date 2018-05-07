<?php

class Users
{
    private static $dataFilePath = './models/users.data';

    private static function read()
    {
        $dataStr = file_get_contents(self::$dataFilePath);
        return ($dataStr !== '') ? unserialize($dataStr) : [];
    }

    private static function write($data)
    {
        file_put_contents(self::$dataFilePath, serialize($data));
    }

    public static function get($index = null)
    {
        $data = self::read();
        if (!is_null($index) && isset($data[$index])) {
            return $data[$index];
        }
        return $data;
    }

    public static function add($user)
    {
        $data = self::read();
        $data[] = $user;
        self::write($data);
    }

    public static function remove($index = null)
    {
        if (!is_null($index)) {
            $data = self::read();
            if (isset($data[$index])) {
                unset($data[$index]);
                self::write($data);
                return true;
            }
        }
        return false;
    }

    public static function update($index = null, $user = null)
    {
        if(!is_null($index) && !is_null($user)){
            $data = self::read();
            $data[$index] = $user;
            self::write($data);
            return true;
        }
        return false;
    }
}