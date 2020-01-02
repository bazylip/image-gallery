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
        $image = new Image($title, $author);
        return new RedirectView('/image/add', 303);
    }
}