<?php

class UserAddErrorView{
	private $errors = [];

	/**
	 * UserAddErrorView constructor.
	 * @param array $errors_
	 */
	public function __construct(array $errors_) {
		$this->errors = $errors_;
	}

	public function view(){
		include "../layouts/errorRegister.php";
	}
}