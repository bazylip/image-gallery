<?php

require_once '../views/UserRegisterView.php';
require_once '../views/RedirectView.php';
require_once '../views/UserAddedView.php';
require_once '../views/UserLoginView.php';
require_once '../views/UserLoggedView.php';
require_once '../models/Database.php';

class UserController{

	public function register(){
		$referer = str_replace("http://192.168.56.10:8080", "", $_SERVER['HTTP_REFERER']);
		if(isset($_SESSION['referer']) && $referer != '/user/addError'){
			$_SESSION['referer'] = $referer;
		}
		return new UserRegisterView();
	}

	public function login(){
		$referer = str_replace("http://192.168.56.10:8080", "", $_SERVER['HTTP_REFERER']);
		if(isset($_SESSION['referer']) && $referer != '/user/login'){
			$_SESSION['referer'] = $referer;
		}
		return !$this->isLogged() ? new UserLoginView() : new RedirectView('/gallery', 303);
	}

	public function logout(){
		if ($this->isLogged()){
			session_destroy();
		}
		return new RedirectView('/gallery', 303);
	}

	public function addUser(){
		$email = $_POST['email'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$passwordRepeat = $_POST['passwordRepeat'];
		$_SESSION['errors'] = [];

		if(!$this->checkFreeEmail($email)){
			array_push($_SESSION['errors'], "email");
		}
		if(!$this->checkFreeLogin($login)){
			array_push($_SESSION['errors'], "login");
		}
		if(!$this->checkRepeatedPassword($password, $passwordRepeat)){
			array_push($_SESSION['errors'], "password");
		}

		if($_SESSION['errors'] == []){
			unset($_SESSION['errors']);
		}else{
			return new RedirectView('/user/addError', 303);
		}

		$response = Database::get()->users->insertOne([
			'email' => $email,
			'login' => $login,
			'password' => password_hash($password, PASSWORD_DEFAULT)
		]);

		return new RedirectView('/user/added', 303);
	}

	public function added(){
		return new UserAddedView();
	}

	public function logged(){
		return new UserLoggedView();
	}

	public function loginCheck(){
		$login = $_POST['login'];
		$password = $_POST['password'];
		$db = Database::get();
		$user = $db->users->findOne(['login' => $login]);

		if(!$user !== null && password_verify($password, $user['password'])){
			session_regenerate_id();
			$_SESSION['user_id'] = $user['_id'];
			return new RedirectView('/user/logged', 303);
		}else{
			return new RedirectView('/user/login?error=1', 303);
		}
	}

	private function checkFreeLogin($login){
		$db = Database::get();
		$query = [
			'login' => $login
		];

		$cursor = $db->users->findOne($query);
		return $cursor === null;
	}

	private function checkFreeEmail($email){
		$db = Database::get();
		$query = [
			'email' => $email
		];

		$cursor = $db->users->findOne($query);
		return $cursor === null;
	}

	private function checkRepeatedPassword($password, $passwordRepeat){
		return $password === $passwordRepeat;
	}

	private function isLogged(){
		return isset($_SESSION['user_id']);
	}
}
