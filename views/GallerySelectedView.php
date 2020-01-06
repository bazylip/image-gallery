<?php

class GallerySelectedView extends GallerySliceView{
	private function filterSelected($var){
		$id = substr($var, 0, strlen($var)-5);
		return isset($_SESSION['picks']) ? in_array($id, $_SESSION['picks']) : false;
	}

	protected function getImages(){
		$path = '../web/images';
		$images = scandir($path);
		$images = array_filter($images, array($this, 'filterSelected'));
		$this->maxPageNumber = $this->maxPageNumber = ceil((count($images)) / $this->pageSize - 1);
		$images = array_filter($images, array($this, 'filterThumbnails'));
		$images = array_filter($images, array($this, 'filterPrivate'));
		return $images;
	}
}