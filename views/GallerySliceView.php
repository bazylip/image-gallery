<?php

require_once '../models/Database.php';

class GallerySliceView{

	private $pageNumber;
	protected $maxPageNumber;
	protected $pageSize = 3;

	/**
	 * GallerySliceView constructor.
	 * @param $page_
	 */
	public function __construct($page_) {
		$this->pageNumber = $page_;
	}

	protected function filterThumbnails($var){
		return strpos($var, 't') !== false;
	}

	protected function getImages(){
		$path = '../web/images';
		$images = scandir($path);
		return array_filter($images, array($this, 'filterThumbnails'));
	}

	public function view(){
		$images = $this->getImages();
		$this->maxPageNumber = ceil((count($images)) / $this->pageSize - 1);
		$images = array_slice($images, ($this->pageNumber) * ($this->pageSize), $this->pageSize);
		include '../layouts/gallerySlice.php';
	}

	public function getTitle($id){
		$query = [
			'imageId' => intval($id)
		];
		$cursor = Database::get()->info->find($query);
		foreach ($cursor as $member){
			return $member['title'];
		}
	}

	public function getAuthor($id){
		$query = [
			'imageId' => intval($id)
		];
		$cursor = Database::get()->info->find($query);
		foreach ($cursor as $member){
			return $member['author'];
		}
	}
}