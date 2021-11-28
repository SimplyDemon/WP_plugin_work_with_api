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
		?>
		<h2>Настройки ленты новостей</h2>
		<form action="options.php" method="post">
			<?php
			settings_fields( $this->optionName );
			do_settings_sections( $this->optionName . 'Page' ); ?>
			<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
		</form>
		<?php
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
		echo "<input id='$fieldName' name='{$this->optionName}[$fieldName]' type='text' value='$value' />";
	}

	function newsOrder() {
		$fieldName    = 'newsOrder';
		$value        = isset( $this->options[ $fieldName ] ) ? esc_attr( $this->options[ $fieldName ] ) : 'DESC';
		$descSelected = $value === 'DESC' ? 'selected' : '';
		$ascSelected  = $value === 'ASC' ? 'selected' : '';
		echo "<select id='$fieldName' name='{$this->optionName}[$fieldName]}' />
				<option {$descSelected} value='DESC'>
					Сначала новые
				</option>
				<option {$ascSelected} value='ASC'>
					Сначала старые
				</option>
			  </select>";
	}

}