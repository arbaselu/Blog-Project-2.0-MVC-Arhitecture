<?php
require_once 'app/core/Controller.php';

class LoginController extends Controller
{
    public function index($username = null, $password = null)
    { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

            $username = sanitize($_POST['username']);
            $password = trim($_POST['password']);
            $model = $this->model('UserModel');
            $_SESSION['input_username'] = $username;
            if ($user = $model->login($username, $password)) {
                
                $_SESSION["authenticated"] = true; 
                $_SESSION["id"] = $user['id']; 
                $_SESSION["fullName"] = $user['full_name'];
                $_SESSION["username"] = $user['username']; 
                $_SESSION["role_user"] = $user['role_user'];
                clearSessionErrors();
                clearSessionInputs();
                header('location: /user');
                exit();
            } else {
                $this->view('user/login');
            }
        } else {      
            $this->view('user/login');
            clearSessionInputs();
            clearSessionErrors();
        }
    }
}

