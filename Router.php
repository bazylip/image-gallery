<?php

class Router {
    private $get;
    private $post;
    private $errors;

    public function __construct(){
        $this->get = [];
        $this->post = [];
        $this->errors = [];
    }

    public function get($path, $call){
        $this->get[$path] = $call;
    }

    public function post($path, $call){
        $this->post[$path] = $call;
    }

    public function errors($path, $call){
        $this->errors[$path] = $call;
    }

    public function resolve(){
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if(isset($this->$method) && isset($this->$method[$path])) {
            $call = explode('::', $this->$method[$path]);
        }else{
            $call = explode('::', $this->errors['404']);
        }
        $controllerName = $call[0];
        $action = $call[1];

        require_once "controllers/{$controllerName}.php";
        $controller = new $controllerName();
        return $controller->$action();
    }
}