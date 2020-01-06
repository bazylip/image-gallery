<?php

require_once '../views/GallerySliceView.php';
require_once '../views/GallerySelectedView.php';
require_once '../views/Error404View.php';

class GalleryController{

	public function showSlice(){
		$page = $this->getPage();
		return $page < 0 ? new Error404View() : new GallerySliceView($page);
	}

	public function showSelected(){
		$page = $this->getPage();
		return $page < 0 ? new Error404View() : new GallerySelectedView($page);
	}

	private function getPage(){
		return (isset($_GET['page'])) ? $_GET['page'] : 0;
	}
}