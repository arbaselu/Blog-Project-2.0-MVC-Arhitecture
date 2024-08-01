<?php
require_once 'app/core/Controller.php';

class RegisterController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preia datele din formular și le salvează în sesiune
            $_SESSION['input_full_name'] = sanitize($_POST['full_name']);
            $_SESSION['input_email'] = sanitize($_POST['email']);
            $_SESSION['input_username'] = sanitize($_POST['username']);

            $fullName = sanitize($_POST['full_name']);
            $email = sanitize($_POST['email']);
            $username = sanitize($_POST['username']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirmPassword']);
                
            $model = $this->model('UserModel');

            if ($user = $model->register($fullName, $email, $username, $password, $confirmPassword)) {
               $_SESSION["authenticated"] = true; 
               $_SESSION["id"] = $user['id'];
               $_SESSION["fullName"] = $user['full_name'];
               $_SESSION["username"] = $user['username'];
               $_SESSION["email_user"] = $user['email'];
               $_SESSION['role_user'] = $user['role_user'];
               clearSessionErrors();
                clearSessionInputs();
               header('location: /user');
               exit();
            } else {
               $this->view('user/register');
            }
        } else {
            $this->view('user/register');
            clearSessionInputs();
            clearSessionErrors();
        } 
    }
}
