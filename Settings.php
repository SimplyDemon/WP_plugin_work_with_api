<?php

namespace sd;

class Settings {
	protected $options;
	protected $optionName;

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'addOptionPage' ] );
		add_action( 'admin_init', [ $this, 'pluginRegisterSettings' ] );
		$this->optionName = 'sd-news-options';
		$this->options    = get_option( $this->optionName );

	}

	function addOptionPage() {
		add_options_page( 'Новости - плагин', 'Новости - плагин', 'manage_options', 'sd-news', [ $this, 'content' ] );
	}

	function content() {
		$apiPost  = new ApiPost( $this->options );
		$apiPosts = json_decode( $apiPost->getPosts(), true );
		require 'template-parts/content/settings.php';
		if ( ! empty( $apiPosts ) && is_array( $apiPosts ) ) {
			require 'template-parts/content/table.php';
		}
	}

	function pluginRegisterSettings() {
		register_setting( $this->optionName, $this->optionName, $this->optionName . 'Validate' );
		add_settings_section( 'newsSettings', 'Настройки', null, $this->optionName . 'Page' );

		add_settings_field( 'newsCount', 'Количество новостей', [
			$this,
			'newsCount',
		], $this->optionName . 'Page', 'newsSettings' );
		add_settings_field( 'newsOrder', 'Сортировка новостей', [
			$this,
			'newsOrder',
		], $this->optionName . 'Page', 'newsSettings' );
	}


	function newsCount() {
		$fieldName = 'newsCount';
		$value     = isset( $this->options[ $fieldName ] ) ? esc_attr( $this->options[ $fieldName ] ) : 20;
		require 'template-parts/fields/count.php';
	}

	function newsOrder() {
		$fieldName    = 'newsOrder';
		$value        = isset( $this->options[ $fieldName ] ) ? esc_attr( $this->options[ $fieldName ] ) : 'DESC';
		$descSelected = $value === 'DESC' ? 'selected' : '';
		$ascSelected  = $value === 'ASC' ? 'selected' : '';
		require 'template-parts/fields/order.php';
	}

}