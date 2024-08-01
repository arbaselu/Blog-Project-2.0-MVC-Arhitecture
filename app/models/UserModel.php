<?php

require_once 'app/core/Model.php';
require_once 'logs/logError.php';
require_once 'app/utils/helper.php';
class UserModel extends Model
{

    public function login($username,$password){

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Clear session errors
    clearSessionErrors();

    //Validate username
    if (empty($username)) {
        $_SESSION['usernameError'] = "Enter a username"; 
        header('location: /login');
    } else if (!isUsernameTaken($username, $this->connect)) { 
        $_SESSION['usernameError'] = "Username does not exist!";
        header('location: /login');
        die();
    }  

    // Validate password
    if (empty($password)) {
        $_SESSION['passwordError'] = "Enter a password";
        header('location: /login');
    } else if (strlen($password) < 8) {
        $_SESSION['passwordError'] = "The password must have at least 8 characters!";
        header('location: /login');
    }

    // If there are no validation errors, proceed with authentication
    if (empty($_SESSION['usernameError']) && empty($_SESSION['passwordError'])) {
        $sql = "SELECT id, full_name, username, password, role_user FROM users WHERE username = :username";
        if ($stmt = $this->connect->prepare($sql)) {
            $stmt->bindParam(":username", $username);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) { // If a row with that username exists
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $user["password"])) { 
                        return $user;
                    } else {
                        $_SESSION['passwordError'] = "Wrong password. Try again or click Forgot password to reset it.";
                        header('location: /login');
                        
                    }
                } else {
                    $_SESSION['usernameError'] = "Couldn't find your account";
                    header('location: /login');
                }
            } else {
                logError("Failed to execute query.", __FILE__, __LINE__);
                header("Location: /error");
            }
            $stmt = null;
        } else {
            logError("Failed to prepare query.", __FILE__, __LINE__);
            header("Location: /error");
        }
    }
} 
    }


    public function register($fullName,$email,$username,$password,$confirmPassword){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            clearSessionErrors();
        
            if (empty($fullName)) {
                $_SESSION['fullNameError'] = "Enter a name";
                header('location: /register');
            }
            if (empty($email) || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $_SESSION['emailError'] = "Enter a valid email";
            } else if (isEmailTaken($email, $this->connect)) {
                $_SESSION['emailError'] = "There is already an account associated with this email!";
            }else{
                header('location: /register');
            }
        
            if (empty($username)) {
                $_SESSION['usernameError'] = "Enter a username";
            } else if (isUsernameTaken($username, $this->connect)) {
                $_SESSION['usernameError'] = "Username already exists!";
            }else{
                header('location: /register');
            }
        
            if (empty($password)) {
                $_SESSION['passwordError'] = "Enter a password";
            } else if (strlen($password) < 8) {
                $_SESSION['passwordError'] = "The password must have at least 8 characters!";
            }else{
                header('location: /register');
            }
        
            if (empty($confirmPassword)) {
                $_SESSION['confirmPasswordError'] = "Enter a password to confirm";
            } else if ($password != $confirmPassword) {
                $_SESSION['confirmPasswordError'] = "Passwords do not match!";
            }else{
                header('location: /register');
            }
        
            if (empty($_SESSION['fullNameError']) && empty($_SESSION['emailError']) && empty($_SESSION['usernameError']) && empty($_SESSION['passwordError']) && empty($_SESSION['confirmPasswordError'])) {
                $sql = "INSERT INTO users (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)";
                if ($stmt = $this->connect->prepare($sql)) {
                    $stmt->bindParam(':full_name', $fullName);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':email', $email);
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt->bindParam(':password', $hashedPassword);
                    if ($stmt->execute()) {
                        $userId = $this->connect->lastInsertId();
        
                        $sql = "SELECT * FROM users WHERE id = :id";
                        if ($stmt = $this->connect->prepare($sql)) {
                            $stmt->bindParam(':id', $userId);
                            if ($stmt->execute()) {
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                return $user;
                            } else {
                                logError("An unexpected error occurred while retrieving user data", __FILE__, __LINE__);
                                header("Location: /error");
                                exit();
                            }
                        }
                    } else {
                        logError("An unexpected error occurred while inserting the user", __FILE__, __LINE__);
                        header("Location: /error");
                        exit();
                    }
                } else {
                    logError("Failed to prepare SQL statement for user insertion", __FILE__, __LINE__);
                    header("Location: /error");
                    exit();
                }
              
            }
        }
        
        $this->connect = null;
    }
                public function logout(){
    
                // Unset all session variables
                $_SESSION = array();

                // Destroy the session
              return session_destroy();
    }

}
    