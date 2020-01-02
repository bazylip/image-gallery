<?php

class RedirectView {
    private $path_;
    private $code_;

    public function __construct($path, $code) {
        $this->path_ = $path;
        $this->code_ = $code;
    }

    public function view(){
        http_response_code($this->code_);
        header("Location: {$this->path_}");
    }
}