<?php

require_once '../views/GallerySliceView.php';
require_once '../views/Error404View.php';

class GalleryController{

	public function showSlice(){
		(isset($_GET['page'])) ? $page = $_GET['page'] : $page = 0;
		if ($page < 0) {
			return new Error404View();
		}else{
			return new GallerySliceView($page);
		}
	}
}