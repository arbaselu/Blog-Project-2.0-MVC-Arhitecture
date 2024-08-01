<?php
require_once 'app/core/Controller.php';

class DeletePostController extends Controller
{    
        public function index($slug=null)
        {
            $model = $this->model('DashbordModel');
            if($model->deletePost($slug)){
                header('location: /blog');
            }
        }

}
