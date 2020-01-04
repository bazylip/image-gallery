<?php

require_once '../views/GallerySliceView.php';

class GalleryController{

	public function showSlice(){
		(isset($_GET['page'])) ? $page = $_GET['page'] : $page = 0;
		return new GallerySliceView($page);
	}
}