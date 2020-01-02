<?php

class Error404View {
    public function view(){
        http_response_code(404);
        include '../layouts/error404.php';
    }
}