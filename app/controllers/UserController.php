<?php
require_once 'app/core/Controller.php';

class UserController extends Controller
{    
        public function index()
        {
            $this->view('user/user');
        }

    public function logout()
    {
       
        $model = $this->model('UserModel');
            
       if ($model->logout()){

        header("Location: /account");
        exit; 
       }
    }
}

        