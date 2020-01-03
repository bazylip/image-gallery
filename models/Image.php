<?php

define('KB', 1024);

class Image {
    private $id;
    private $title;
    private $author;
    private $extension;
    private $uploadName;
    private $uploadTmpName;
    private $uploadSize;
    private $dest = '../web/images/';
    private $maxSize = 1000*KB;
    private $allowedExt = array('jpg', 'png');

	public function __construct($title_, $author_, $uploadName_, $uploadTmpName_, $uploadSize_) {
		$this->id = count(scandir('../web/images')) - 2;
		$this->title = $title_;
		$this->author = $author_;
		$this->uploadName = $uploadName_;
		$this->uploadTmpName = $uploadTmpName_;
		$this->uploadSize = $uploadSize_;
		$this->extension = pathinfo($this->uploadName, PATHINFO_EXTENSION);
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
				if(move_uploaded_file($this->uploadTmpName, $this->dest . $this->id . "." . $this->extension)){
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
		return ($this->uploadSize < $this->maxSize);
	}

	/**
	 * Return codes:
	 * true		-> file extension correct
	 * false	-> file extension incorrect
	 */
	private function checkCorrectExtension(){
		return (in_array(strtolower($this->extension), $this->allowedExt));
	}
}
