<?php
require_once 'app/core/Controller.php';
class BlogController extends Controller
{
    public function index()
    {
        $model = $this->model('PostModel');
        $data = $model->getPostsBlog();
        $this->view('blog/index', ['posts' => $data]);
    }

    public function post($slug)
    {
        $model = $this->model('PostModel');
        $data = $model->getPost($slug);

        // Verifică dacă datele sunt obținute
        if (!$data) {
            $this->redirectErrorPage();
            return;
        }

        // Încarcă vederea pentru postare
        $this->view('blog/post', ['posts' => $data]);
    }

    private function redirectErrorPage()
    {
        header('Location: /error');
        exit();
    }

  
    
}
