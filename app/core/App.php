<?php
require_once 'app/core/Model.php';
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Verifica daca exista un controller în URL si daca fisierul controller exista
        if (isset($url[0]) && file_exists('app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Include fisierul controller
        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Verifică dacă al doilea element din URL este un slug valid
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } elseif (($this->controller instanceof BlogController || $this->controller instanceof EditPostController) && ValidateSlug($url[1])) {
                $this->method = 'post';
            } else {
                $this->redirectErrorPage();
            }
        }

        // Seteaza parametrii
        $this->params = $url ? array_values($url) : [];

        // Ruleaza metoda din controller cu parametrii
        $this->run();
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            return explode('/', filter_var($url, FILTER_SANITIZE_URL));
        }
        return [];
    }

    public function run()
    {
        // Verifică dacă metoda necesită parametri și dacă aceștia sunt furnizați
        $reflection = new ReflectionMethod($this->controller, $this->method);
        $requiredParams = $reflection->getNumberOfRequiredParameters();
        $totalParams = $reflection->getNumberOfParameters();

        if (count($this->params) < $requiredParams || count($this->params) > $totalParams) {
            $this->redirectErrorPage();
            return; // Stop further execution if redirected
        }

        // Apelează metoda din controller cu parametrii
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function redirectErrorPage()
    {
        header('Location: /error');
        exit();
    }


}
