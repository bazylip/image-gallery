<?php

class GallerySliceView{

	private $pageNumber;
	private $maxPageNumber;
	private $pageSize = 3;

	/**
	 * GallerySliceView constructor.
	 * @param $page_
	 */
	public function __construct($page_) {
		$this->pageNumber = $page_;
		$this->maxPageNumber = ceil(((count(scandir('../web/images')) - 2) / 3) / $this->pageSize - 1);
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