<?php

class AuthController
{
    public function actionLogin() 
    {
        $firstname = '';
        $email = '';
        $password = '';
        
        if (isset($_POST['login'])) {
            unset($_SESSION["flash"]);
            
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;

            if (!User::checkName($firstname)) {
                $errors[] = 'First name doesn\'t be less 2 symbols' ;
            }
                        
            if (!User::checkEmail($email)) {
                $errors[] = 'Email is wrong';
            }   

            if (!User::checkPassword($password)) {
                $errors[] = 'Password doesn\'t be less 3 symbols';
            }
            
            if ($errors == false) {
                $user = User::getUserData($firstname, $email, $password);
                
                if ($user == false) {
                    $errors[] = 'First name, email or password is wrong';
                } else {
                    User::authorization($user);
                    
                    if ($user['is_active']) {
                        if (User::hasPreferences($_SESSION['user']['user_id'])) {
                            header("Location: /");
                        } else {
                            header("Location: /preferences");
                        }
                    } else {
                        $errors[] = 'Please check your email and verificite';
                    }
                }
            }
        }

        require_once(ROOT . '/views/auth/login.php');
        
        return true;
    }

    public function actionRegister() 
    {
        $firstname = '';
        $lastname = '';
        $email = '';
        $password = '';
        $confirmPassword = '';
        $result = false;

        if(isset($_POST['register'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            $errors = false;

            if (!User::checkName($firstname)) {
                $errors[] = 'First name doesn\'t be less 2 symbols' ;
            }

            if (!User::checkName($lastname)) {
                $errors[] = 'Last name doesn\'t be less 2 symbols' ;
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Email is wrong' ;
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Password doesn\'t be less 3 symbols' ;
            }

            if (!User::confirmPassword($password, $confirmPassword)) {
                $errors[] = 'Passwords must be equal and not empty' ;
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'This email is already used';
            }

            if ($errors == false) {
                $result = User::register($firstname, $lastname, $email, $password);
            }
        }

        require_once(ROOT . '/views/auth/register.php');
        
        return true;
    }

    public function actionConfirm($hash) 
    {
        $result = User::confirmEmail($hash);

        if ($result) {
            $_SESSION['flash'] = 'Your email is verificated';
            header("Location: /preferences");
        } else {
            echo "Verification is wrong";
        }
    }

    public function actionLogout()
    {
        unset($_SESSION["user"]);

        header("Location: /");
    }
}