<?php
require_once '../views/Error404View.php';
require_once '../views/ErrorSaveView.php';
require_once '../views/UserAddErrorView.php';

class ErrorController {
    public function Error404(){
        return new Error404View();
    }

    public function ErrorSaveImage(){
    	$errors = $_SESSION['errors'];
    	unset($_SESSION['errors']);
    	return new ErrorSaveView($errors);
	}

	public function ErrorAddUser(){
    	$errors = $_SESSION['errors'];
    	unset($_SESSION['errors']);
    	return new UserAddErrorView($errors);
	}
}
