<?php

require ROOT . '/models/Auth.php';

class AuthController
{
	public function actionLogin() {
		$firstname = '';
		$email = '';
		$password = '';
		
		if (isset($_POST['login'])) {
			unset($_SESSION["flash"]);
			
		    $firstname = $_POST['firstname'];
		    $email = $_POST['email'];
		    $password = $_POST['password'];
		    
		    $errors = false;

		    if (!Auth::checkName($firstname)) {
		        $errors[] = 'First name doesn\'t be less 2 symbols' ;
		    }
		                
		    if (!Auth::checkEmail($email)) {
		        $errors[] = 'Email is wrong';
		    }   

		    if (!Auth::checkPassword($password)) {
		        $errors[] = 'Password doesn\'t be less 3 symbols';
		    }
		    
		    if ($errors == false) {
		    	$user = Auth::checkUserData($firstname, $email, $password);
		    	
		    	if ($user == false) {
		    	    $errors[] = 'First name, email or password is wrong';
		    	} else {
		    	    Auth::authorization($user);
		    	    
		    	    if ($user['is_active']) {
		    	    	header("Location: /content");
		    	    } else {
		    	    	$errors[] = 'Please check your email and verificite';
		    	    }
		    	}
		    }
		}

		require_once(ROOT . '/views/auth/login.php');
		
		return true;
	}

	public function actionRegister() {
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

		    if (!Auth::checkName($firstname)) {
		        $errors[] = 'First name doesn\'t be less 2 symbols' ;
		    }

		    if (!Auth::checkName($lastname)) {
		        $errors[] = 'Last name doesn\'t be less 2 symbols' ;
		    }

		    if (!Auth::checkEmail($email)) {
		        $errors[] = 'Email is wrong' ;
		    }

		    if (!Auth::checkPassword($password)) {
		        $errors[] = 'Password doesn\'t be less 3 symbols' ;
		    }

		    if (!Auth::confirmPassword($password, $confirmPassword)) {
		        $errors[] = 'Passwords must be equal and not empty' ;
		    }

		    if (Auth::checkEmailExists($email)) {
		        $errors[] = 'This email is already used';
		    }

		    if ($errors == false) {
		        $result = Auth::register($firstname, $lastname, $email, $password);
		    }
		}

		require_once(ROOT . '/views/auth/register.php');
		
		return true;
	}

	public function actionConfirm($hash) {
		$result = Auth::confirmEmail($hash);

		if ($result) {
		    $_SESSION['flash'] = 'Your email is verificated';
		    header("Location: /login");
		} else {
		    echo "Verification is wrong";
		}
	}
}