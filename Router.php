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

    public function post($path, $call){
        $this->post_[$path] = $call;
    }

    public function errors($path, $call){
        $this->errors_[$path] = $call;
    }

    public function resolve(){
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $method = strtolower($_SERVER['REQUEST_METHOD']."_");

        if(isset($this->$method) && isset($this->$method[$path])) {
            $call = explode('::', $this->$method[$path]);
        }else{
            $call = explode('::', $this->errors_['404']);
        }
        $controllerName = $call[0];
        $action = $call[1];

        require_once "controllers/{$controllerName}.php";
        $controller = new $controllerName();
        return $controller->$action();
    }
}