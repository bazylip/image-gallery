<?php

class GallerySliceView{

	private $pageNumber;
	private $pageSize = 3;

	/**
	 * GallerySliceView constructor.
	 * @param $page_
	 */
	public function __construct($page_) {
		$this->pageNumber = $page_;
	}

	private function filterThumbnails($var){
		return strpos($var, 't') !== false;
	}

	public function view(){
		$path = '../web/images';
		$images = scandir($path);
		$images = array_filter($images, array($this, 'filterThumbnails'));
		$images = array_slice($images, ($this->pageNumber) * ($this->pageSize), $this->pageSize);
		include '../layouts/gallerySlice.php';
	}
}