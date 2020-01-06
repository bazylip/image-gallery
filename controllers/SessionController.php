<?php

class SessionController{

	public function saveChoice() {
		$this->manipulatePicks("add");
		return isset($_GET['page']) ? new RedirectView('/gallery?page='.$_GET['page'], 303) : new RedirectView('/gallery', 303);
	}

	public function forgetChoice(){
		$this->manipulatePicks("remove");
		return isset($_GET['page']) ? new RedirectView('/gallery/selected?page='.$_GET['page'], 303) : new RedirectView('/gallery', 303);
	}

	private function manipulatePicks($action){
		$picks = [];
		if (isset($_POST['picks'])) {
			foreach ($_POST['picks'] as $key => $value) {
				array_push($picks, $value);
			}
		}

		ob_start();
		session_start();

		if(!isset($_SESSION['picks'])){
			$_SESSION['picks'] = [];
		}
		foreach ($picks as $pick){
			switch($action) {
				case "add":
					if (!in_array($pick, $_SESSION['picks'])) {
						array_push($_SESSION['picks'], $pick);
					}
					break;
				case "remove":
					if (($key = array_search($pick, $_SESSION['picks'])) !== false) {
						unset($_SESSION['picks'][$key]);
					}
					break;
			}
		}
	}
}