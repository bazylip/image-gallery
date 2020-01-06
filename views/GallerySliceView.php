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

	protected function filterPrivate($var){
		$id = substr($var, 0, strlen($var)-5);
		$cursor = Database::get()->info->find(['imageId' => intval($id)]);

		foreach($cursor as $info){

			if($this->isLogged()){
				if($info['privacy'] == 'private'){
					return $info['author'] == $this->getAuthor($id);
				}
				return true;
			}else{
				return $info['privacy'] == 'public';
			}
		}
	}

	private function isLogged(){
		return isset($_SESSION['user_id']);
	}

	protected function getImages(){
		$path = '../web/images';
		$images = scandir($path);
		$images = array_filter($images, array($this, 'filterThumbnails'));
		$images = array_filter($images, array($this, 'filterPrivate'));
		return $images;
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