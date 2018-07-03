<?php

class UsersRepo extends Repo
{
    private static $sessionUserFieldName = 'user';

    private static function generateSalt()
    {
        $saltLength = rand(40, 50);
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
        return hash('sha512', $password . $salt);
    }

    private static function prepareValue($value)
    {
        return htmlspecialchars(trim($value));
    }

    public static function getCurrentUser()
    {
        if(isset($_SESSION[self::$sessionUserFieldName])){
            return $_SESSION[self::$sessionUserFieldName];
        }else{
            return null;
        }
    }

    private static function setCurrentUser($user)
    {
        $_SESSION[self::$sessionUserFieldName] = $user;
    }

    public static function logout()
    {
        unset($_SESSION[self::$sessionUserFieldName]);
    }

    public static function autoRegister($name, $email)
    {
        $password = self::generateSalt();
        $newUser = self::register($name, $email, $password, User::ROLE_CUSTOMER, User::REGISTRATION_TYPE_AUTO);
        return $newUser;
    }

    public static function register($name, $email, $password, $role = User::ROLE_CUSTOMER, $registrationType = User::REGISTRATION_TYPE_MANUAL)
    {
        try {
            $salt = self::generateSalt();
            $password = self::getPasswordHash(self::prepareValue($password), $salt);
            $statement = self::connection()->prepare("INSERT INTO users SET name = :name,
                                                                                      email = :email,
                                                                                      salt = :salt,
                                                                                      password = :password,
                                                                                      role = :role,
                                                                                      registration_type = :registration_type");
            $statement->execute([
                ':name' => self::prepareValue($name),
                ':email' => self::prepareValue($email),
                ':salt' => $salt,
                ':password' => $password,
                ':role' => $role,
                ':registration_type' => $registrationType,
            ]);

            $newUserId = self::connection()->lastInsertId();
            return self::getById($newUserId);

        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getById($id)
    {
        $statement = self::connection()->prepare("SELECT id, name, email, role FROM users WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $statement->fetch();
    }

    public static function getAllUsers()
    {
        $res = self::connection()->query('SELECT * FROM users');
        return $res->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function login($email, $password_raw)
    {
        $currentUser = null;
        try{
            $email = self::prepareValue($email);

            $statement = self::connection()->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $statement->execute([
                ':email' => $email
            ]);
            $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $statement->fetch();

            if($user->password === self::getPasswordHash(self::prepareValue($password_raw), $user->salt)){
                $currentUser = $user;
            }
        } catch (PDOException $e) {}

        self::setCurrentUser($currentUser);
    }

    public static function getUserByEmail($email)
    {
        $statement = self::connection()->prepare("SELECT id, name, email, role FROM users WHERE email = :email");
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $statement->fetch();
    }

}