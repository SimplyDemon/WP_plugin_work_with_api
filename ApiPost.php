<?php


namespace sd;


class ApiPost {
	protected $apiBaseUrl;
	protected $count = 20;
	protected $order = 'DESC';

	public function __construct( $options ) {
		$this->setSettings( $options );
	}

	protected function setSettings( $options ) {
		$this->apiBaseUrl = 'http://simplyd.beget.tech/';
		if ( isset( $options['newsCount'] ) && is_numeric( $options['newsCount'] ) && $options['newsCount'] > 0 ) {
			$this->count = (int) $options['newsCount'];
		}
		if ( isset( $options['newsOrder'] ) && ! empty( $options['newsOrder'] ) && $options['newsOrder'] === 'ASC' ) {
			$this->order = $options['newsOrder'];
		}
	}

	public function getPosts() {
		return file_get_contents( "{$this->apiBaseUrl}?count={$this->count}&order={$this->order}" );
	}
}