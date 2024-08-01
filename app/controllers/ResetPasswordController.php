<?php
require_once 'app/core/Controller.php';

class ResetPasswordController extends Controller
{
    public function index()
    {
        
        $this->view('user/resetPassword');
    }


}