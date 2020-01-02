<?php

class Image {
    private $id;
    private $title;
    private $author;

	/**
	 * Image constructor.
	 * @param $title_
	 * @param $author_
	 */
	public function __construct($title_, $author_) {
		$this->title = $title_;
		$this->author = $author_;
		$this->id = count(scandir('../web/images')) - 2;
	}

	public function save(){

	}
}
