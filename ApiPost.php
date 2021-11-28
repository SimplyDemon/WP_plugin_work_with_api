<?php


namespace sd;


class ApiPost {
	protected $apiBaseUrl;

	public function __construct() {
		$this->setSettings();
	}

	protected function setSettings() {
		$this->apiBaseUrl = 'http://simplyd.beget.tech/';
	}

	public function getPosts() {
		return file_get_contents( $this->apiBaseUrl );
	}
}