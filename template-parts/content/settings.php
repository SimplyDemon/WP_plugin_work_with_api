<h2>Настройки ленты новостей</h2>
<form action="options.php" method="post">
	<?php
	settings_fields( $this->optionName );
	do_settings_sections( $this->optionName . 'Page' ); ?>
	<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
</form>