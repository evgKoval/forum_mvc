<?php

require ROOT . '/db/db.php';
$db = $db->getConnection();

class Auth {
    public static function register($firstname, $lastname, $email, $password) 
    {
        global $db;

        $hash = hash('ripemd160', $firstname . $email);

        $sql = 'INSERT INTO users (first_name, last_name, email, password, hash) ' . 'VALUES (:first_name, :last_name, :email, :password, :hash)';

        $result = $db->prepare($sql);
        $result->bindParam(':first_name', $firstname, PDO::PARAM_STR);
        $result->bindParam(':last_name', $lastname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);

        if ($result->execute()) {
            if (isset($_SESSION['flash'])) {
                unset($_SESSION["flash"]);
            }

            require ROOT . '/phpmailer/send.php';
        }
    }

    public static function checkName($name) 
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 3) {
            return true;
        }
        return false;
    }

    public static function confirmPassword($password, $confirmPassword) 
    {
        if (strlen($password) == 0 || strlen($confirmPassword) == 0) {
            return false;
        }
        if ($password === $confirmPassword) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email) 
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email) {
        global $db;

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    public static function checkUserData($firstname, $email, $password) {
        global $db;

        $sql = 'SELECT * FROM users WHERE first_name = :firstname AND email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return [
                "id" => $user['id'],
                "is_active" => $user['is_active']
            ];
        }

        return false;
    }

    public static function confirmEmail($hash) {
        global $db;

        var_dump($hash);
        $sql = 'UPDATE users SET is_active = 1 WHERE hash = :hash';

        $result = $db->prepare($sql);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);

        $result->execute();

        return $result->rowCount();
    }

    public static function authorization($userId) 
    {
        $_SESSION['user'] = $userId;
    }
}