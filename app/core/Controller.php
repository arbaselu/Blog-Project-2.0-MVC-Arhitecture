<?php
 session_start();
class Controller
{
    // Încarcă un model
    public function model($model)
    {
        require_once "app/models/$model.php";
        return new $model();
    }

    // Încarcă o vedere
    public function view($view, $data = [])
    {
        require_once "app/views/$view.php";
    }

   

}
