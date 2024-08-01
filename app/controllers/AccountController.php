<?php
require_once 'app/core/Controller.php';

class AccountController extends Controller
{
    public function index()
    { 
        clearSessionInputs();
        clearSessionErrors();
        if (isset($_SESSION["authenticated"]) && ($_SESSION["authenticated"] === true)) {
           
        $this->view('user/user');

        }
          else {
                  $this->view('account/index');
          }
    }

}