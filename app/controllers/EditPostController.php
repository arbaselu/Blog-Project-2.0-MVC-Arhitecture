<?php
require_once 'app/core/Controller.php';

class EditPostController extends Controller
{    
     public function post($slug=null){
          $model = $this->model('PostModel');
          $data = $model->getPost($slug); 
          $this->view('dashbord/editPost', ['posts' => $data]);
     }
     
     public function edit($slug=null,$title=null,$content=null,$public=null){
          
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
               $title = trim($_POST['new_title']);
               $content = trim($_POST['new_content']);
               $public = intval($_POST['new_public']);
               $slug = sanitize($_POST['slug']);

               $model = $this->model('DashbordModel');
               if ($model->editPost($slug,$title,$content,$public)) { 
               header('location: /blog/'.$slug);
           }else{
               $this->view('dashbord/editPost');
           }
       }else{
           $this->view('dashbord/editPost');
       }
  
     }
}