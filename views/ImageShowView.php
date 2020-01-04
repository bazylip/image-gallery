<?php

class ImageShowView{
	private $id;

	/**
	 * ImageShowView constructor.
	 * @param $id_
	 */
	public function __construct($id_) {
		$this->id = $id_;
	}

	private function filterId($var){
		return strpos($var, $this->id) !== false;
	}

	public function view(){
		$path = '../web/images';
		$images = scandir($path);
		$images = array_filter($images, array($this, 'filterId'));
		$extension = substr(reset($images), -3, 3);
		if($extension == "jpg") {
			header('Content-type: image/jpeg');
			readfile('../web/images/' . $this->id . '.jpg');
		}else{
			header('Content-type: image/png');
			readfile('../web/images/' . $this->id . '.png');
		}
	}
}