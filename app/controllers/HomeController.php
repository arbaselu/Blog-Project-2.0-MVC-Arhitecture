<?php

require_once 'app/core/Controller.php';


class HomeController extends Controller
{ 
    public function index()
    {
        // Creează o instanță a modelului HomeModel
        $model = $this->model('PostModel');
        
        // Obține datele necesare de la model
        $data = $model->getPostsHome();
        
        // Încarcă vederea și îi transmite datele
        $this->view('home/index', ['posts' => $data]);
    }

  public function newsletter($toEmail=null){
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_newsletter'])) {
    $toEmail = sanitize($_POST["email_newsletter"]);
    $model = $this->model('PostModel');
    $data = $model->getPostsHome();
    include 'app/views/newsletter/index.php';
    $model = $this->model('NewsletterModel');
    if($model->sendNewsletter($toEmail,$newsletterContent)){
        header('location: /'); //reincarca home page
    }else{
        header('location: /');
       //reincarca home page
    }
    }
  }
    
}
