<?php
require_once '../views/ImageAddView.php';

class ImageController {
    public function addImage() {
        return new ImageAddView();
    }
}