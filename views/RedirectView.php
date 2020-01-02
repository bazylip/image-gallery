<?php

class RedirectView {
    private $path;
    private $code;

	/**
	 * RedirectView constructor.
	 * @param $path
	 * @param $code
	 */
	public function __construct($path, $code) {
		$this->path = $path;
		$this->code = $code;
	}


	public function view(){
        http_response_code($this->code);
        header("Location: {$this->path}");
    }
}