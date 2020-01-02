<?php

class Router {
    private $get_;
    private $post_;
    private $errors_;

    public function __construct(){
        $this->get_ = [];
        $this->post_ = [];
        $this->errors_ = [];
    }

    public function get($path, $call){
        $this->get_[$path] = $call;
    }

    public function dispatch(){
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $method = strtolower($_SERVER['REQUEST_METHOD']."_");

        $call = explode('::', $this->$method[$path]);
        $controllerName = $call[0];
        $action = $call[1];

        require_once "controllers/{$controllerName}.php";
        $controller = new $controllerName();
        return $controller->$action();
    }
}