<?php
require_once '../views/Error404View.php';
require_once '../views/ErrorSaveView.php';

class ErrorController {
    public function Error404(){
        return new Error404View();
    }

    public function ErrorSave(){
    	session_start();
    	$errors = $_SESSION['errors'];
    	unset($_SESSION['errors']);
    	return new ErrorSaveView($errors);
	}
}
