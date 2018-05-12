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

    private static function generateSalt()
    {
        $saltLength = rand(20, 30);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $salt = '';
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= $characters[rand(0, $charactersLength - 1)];
        }
        return $salt;
    }

    private static function getPasswordHash($password, $salt)
    {
        return crypt($password, $salt);
    }

    private static function prepareValue($value)
    {
        return htmlspecialchars(trim($value));
    }

    public static function create($name, $email, $password)
    {
        $salt = self::generateSalt();
        $newUser = new stdClass();
        $newUser->name = self::prepareValue($name);
        $newUser->email = self::prepareValue($email);
        $newUser->salt = $salt;
        $newUser->passwordHash = self::getPasswordHash(self::prepareValue($password), $salt);
        return self::add($newUser);
    }

    public static function check($email, $password){
        $users = self::read();
        $currentUser = false;
        foreach ($users as $user){
            if($user->email === $email){
                if($user->passwordHash === self::getPasswordHash($password, $user->salt)){
                    $currentUser = $user;
                    break;
                }
            }
        }
        return $currentUser;
    }

    public static function get($index = null)
    {
        $data = self::read();
        if (!is_null($index) && isset($data[$index])) {
            return $data[$index];
        }
        return $data;
    }

    public static function add($newUser)
    {
        $users = self::read();
        $userExist = false;
        foreach ($users as $user) {
            if($user->email === $newUser->email){
                $userExist = true;
                break;
            }
        }
        if($userExist){
            return [
                'type'=>'danger',
                'text'=>'Пользователь с таким email уже существует'
            ];
        }else{
            $users[] = $newUser;
            self::write($users);
            return [
                'type'=>'success',
                'text'=>'Пользователь добавлен'
            ];
        }
    }

    public static function remove($index = null)
    {
        if (!is_null($index)) {
            $data = self::read();
            if (isset($data[$index])) {
                $userName = $data[$index]->name;
                unset($data[$index]);
                self::write($data);
                return [
                    'type'=>'success',
                    'text'=>'Пользователь '.$userName.' удален'
                ];
            }
            return [
                'type'=>'danger',
                'text'=>'Нет такого пользователя'
            ];
        }
        return [
            'type'=>'danger',
            'text'=>'Что-то пошло не так'
        ];
    }

    public static function update($index, $name, $email, $oldPassword, $newPassword)
    {
        $users = self::read();
        if (isset($index) && isset($users[$index])) {
            if(!empty($oldPassword) && !empty($newPassword)){
                if($users[$index]->passwordHash === self::getPasswordHash($oldPassword, $users[$index]->salt)){
                    $users[$index]->passwordHash = self::getPasswordHash($newPassword, $users[$index]->salt);
                }else{
                    return [
                        'type'=>'danger',
                        'text'=>'Неверный пароль'
                    ];
                }
            }
            $users[$index]->name = $name;
            $users[$index]->email = $email;
            self::write($users);
            return [
                'type'=>'success',
                'text'=>'Пользователь '.$name.' изменен'
            ];
        }
        return [
            'type'=>'danger',
            'text'=>'Что-то пошло не так'
        ];
    }
}