<?php

require_once 'Database.php';

define('KB', 1024);

class Image {
    private $id;
    private $title;
    private $author;

    //private $infoId;
    private $extension;
    private $uploadName;
    private $uploadTmpName;
    private $size;
    private $watermark;
    private $dest = '../web/images/';
    private $maxSize = 1000*KB;
    private $allowedExt = array('jpg', 'png');
    private $path;

	public function __construct($title_, $author_, $uploadName_, $uploadTmpName_, $uploadSize_, $watermark_) {
		$this->id = (count(scandir('../web/images')) - 2) / 3;
		$this->title = $title_;
		$this->author = $author_;
		$this->uploadName = $uploadName_;
		$this->uploadTmpName = $uploadTmpName_;
		$this->size = $uploadSize_;
		$this->watermark = $watermark_;
		$this->extension = strtolower(pathinfo($this->uploadName, PATHINFO_EXTENSION));
		$this->path = $this->dest . $this->id . "." . $this->extension;
	}

	/**
	 *	Save image to server.
	 * 	Return codes:
	 * 	1		-> file correct but save failed
	 * 	0 		-> save successful
	 * 	-1 		-> file size too big
	 * 	-2 		-> file extension incorrect
	 * 	-3		-> -1 && -2
	 */
	public function save(){
		if ($this->checkCorrectSize()){
			if ($this->checkCorrectExtension()){
				if(move_uploaded_file($this->uploadTmpName, $this->path)){
					$this->createWatermarkCopy();
					$this->createThumbnail();
					$this->saveInfoToDatabase();
					return 0;
				}else{
					return 1;
				}
			}else {
				return -2;
			}
		}else{
			return (($this->checkCorrectExtension()) ? -1 : -3);
		}
	}

	/**
	 * Return codes:
	 * true		-> file size correct
	 * false 	-> file size incorrect
	 */
	private function checkCorrectSize(){
		return ($this->size < $this->maxSize);
	}

	/**
	 * Return codes:
	 * true		-> file extension correct
	 * false	-> file extension incorrect
	 */
	private function checkCorrectExtension(){
		return (in_array($this->extension, $this->allowedExt));
	}

	private function createWatermarkCopy(){
		($this->extension == "jpg") ? $image = imagecreatefromjpeg($this->path) : $image = imagecreatefrompng($this->path);
		imagestring($image, 5, 0, 0, $this->watermark, imagecolorallocate($image, 0, 0, 0));
		($this->extension == "jpg") ? imagejpeg($image, $this->dest . $this->id . "w." . $this->extension) : imagepng($image, $this->dest . $this->id . "w." . $this->extension);
	}

	private function createThumbnail(){
		($this->extension == "jpg") ? $image = imagecreatefromjpeg($this->path) : $image = imagecreatefrompng($this->path);
		$resizedImage = imagescale($image, 200, 125);
		($this->extension == "jpg") ? imagejpeg($resizedImage, $this->dest . $this->id . "t." . $this->extension) : imagepng($image, $this->dest . $this->id . "t." . $this->extension);
	}

	private function saveInfoToDatabase(){
		//Database::get()->info->drop();
		$response = Database::get()->info->insertOne([
			'imageId' => $this->id,
			'title' => $this->title,
			'author' => $this->author
		]);

		//$this->infoId = $response->getInsertedId();
	}
}
