<?php

class ErrorSaveView{
	private $errors = [];

	public function __construct($errors_) {
		$this->errors = $errors_;
	}

	public function view(){
		include '../layouts/errorSave.php';
	}
}