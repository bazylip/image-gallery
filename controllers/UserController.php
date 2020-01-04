<?php

require_once '../views/UserRegisterView.php';
require_once '../views/RedirectView.php';
require_once '../views/UserAddedView.php';
require_once '../views/UserLoginView.php';
require_once '../views/UserLoggedView.php';
require_once '../models/Database.php';

class UserController{

	public function register(){
		return new UserRegisterView();
	}

	public function login(){
		return new UserLoginView();
	}

	public function addUser(){
		$email = $_POST['email'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$passwordRepeat = $_POST['passwordRepeat'];
		session_start();
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
			session_start();
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
}
