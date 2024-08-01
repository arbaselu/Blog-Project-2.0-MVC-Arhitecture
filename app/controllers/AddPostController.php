<?php
require_once 'app/core/Controller.php';

class AddPostController extends Controller
{    
        public function index($title=null,$content=null,$public=null)
        { 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
            $title = sanitize($_POST['title']);
            $content = trim($_POST['content']);
            $public = sanitize($_POST['public']);
            $slug = createSlug($title);
            $model = $this->model('DashbordModel');
            if ($model->createPost($slug,$title,$content,$public)) { 
            header('location: /blog/'.$slug);
        }else{
            $this->view('dashbord/addPost');
        }
    }else{
        $this->view('dashbord/addPost');
    }

}
}
