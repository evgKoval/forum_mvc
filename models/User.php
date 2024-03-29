<?php

class User
{
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

            Mailer::sendConfirm($email, $hash);
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

    public static function checkEmailExists($email) 
    {
        global $db;

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    public static function getUserData($firstname, $email, $password) 
    {
        global $db;

        $sql = 'SELECT u.id id_user, u.email, u.is_active, p.id, p.user_id FROM users u LEFT JOIN posts p ON p.user_id = u.id WHERE first_name = :firstname AND email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetchAll(PDO::FETCH_ASSOC);
        if ($user) {
            $userData = [
                'is_active' => $user[0]['is_active'],
                'email' => $user[0]['email'],
                'user_id' => $user[0]['id_user'],
                'posts_id' => []
            ];

            foreach ($user as $data) {
                array_push($userData['posts_id'], $data['id']);
            }

            return $userData;
        }

        return false;
    }

    public static function getUserDataById()
    {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'SELECT * FROM users WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function confirmEmail($hash) 
    {
        global $db;

        $sql = 'UPDATE users SET is_active = 1 WHERE hash = :hash';

        $result = $db->prepare($sql);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);

        $result->execute();

        return $result->rowCount();
    }

    public static function authorization($user) 
    {
        $_SESSION['user'] = $user;
    }

    public static function isGuest() {
        if (!isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public static function getUserFirstNameById($userId) 
    {
        global $db;

        $sql = 'SELECT first_name FROM users WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_STR);

        $result->execute();

        $firstname = $result->fetch(PDO::FETCH_ASSOC);

        return $firstname['first_name'];
    }

    public static function hasPreferences($userId)
    {
        global $db;

        $sql = 'SELECT COUNT(*) FROM user_preferences WHERE user_id = :user_id';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    } 

    public static function getUserPreferences() 
    {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'SELECT s.name FROM user_preferences u LEFT JOIN sub_categories s ON u.sub_category = s.id WHERE user_id = :user_id';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        $result->execute();

        $preferences = $result->fetchAll(PDO::FETCH_ASSOC);

        return $preferences;
    }

    public static function editProfile($firstname, $lastname, $email, $password)
    {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'UPDATE users SET first_name = :firstname, last_name = :lastname, email = :email, password = :password WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':id', $userId, PDO::PARAM_STR);

        $result->execute();

        return $result->rowCount();
    }
}