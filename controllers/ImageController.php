<?php
require_once '../views/ImageAddView.php';
require_once '../views/RedirectView.php';

class ImageController {
    public function addImage() {
        return new ImageAddView();
    }

    public function sendImage() {
        $title = $_POST['title'];

        return new RedirectView('/image/add', 303);
    }
}