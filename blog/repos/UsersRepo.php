<?php

class UsersRepo
{


    private static function connection()
    {
        return DB::getConnection();
    }


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

    public static function register($name, $email, $password)
    {
        try {
            $newUser = new stdClass();
            $newUser->salt = self::generateSalt();
            $newUser->name = self::prepareValue($name);
            $newUser->email = self::prepareValue($email);
            $newUser->password = self::getPasswordHash(self::prepareValue($password), $newUser->salt);

            $statement = self::connection()->prepare("INSERT INTO users SET name = :name, email = :email, salt = :salt, password = :password");
            $statement->execute([
                ':name' => $newUser->name,
                ':email' => $newUser->email,
                ':salt' => $newUser->salt,
                ':password' => $newUser->password,
            ]);

            $newUser->id = self::connection()->lastInsertId();
            return $newUser;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function check($email, $password_raw)
    {
        try{
            $email = self::prepareValue($email);

            $statement = self::connection()->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $statement->execute([
                ':email' => $email
            ]);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $user = $statement->fetchObject();

            if($user->password === self::getPasswordHash(self::prepareValue($password_raw), $user->salt)){
                return $user;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}