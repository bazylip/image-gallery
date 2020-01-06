<?php

class ImageAddView {
    public function view(){
        include '../layouts/addImage.php';
    }

    private function getUser(){
		if($this->isLogged()){
			$db = Database::get();
			$cursor = $db->users->find(['_id' => $_SESSION['user_id']]);
			$user = iterator_to_array($cursor);
			foreach ($user as $data){
				echo($data['login']);
			}
		}
		return "";
	}

	private function isLogged(){
		return isset($_SESSION['user_id']);
	}
}