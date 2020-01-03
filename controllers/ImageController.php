<?php
require_once '../views/ImageAddView.php';
require_once '../views/RedirectView.php';
require_once '../models/Image.php';

class ImageController {
    public function addImage() {
        return new ImageAddView();
    }

    public function sendImage() {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];

        $image = new Image($title, $author, $name, $tmp_name, $size);
        $returnCode = $image->save();

        if($returnCode == 0) {
			return new RedirectView('/image/add', 303);
		}else{
        	session_start();
        	switch($returnCode){
				case -1:
					$_SESSION['errors'] = ['size'];
					break;
				case -2:
					$_SESSION['errors'] = ['ext'];
					break;
				case -3:
					$_SESSION['errors'] = ['size', 'ext'];
					break;
        	}
			return new RedirectView('/image/errorSave', 303);
		}

    }
}