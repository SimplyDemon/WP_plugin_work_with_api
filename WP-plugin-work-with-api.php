<?php
/*
 * Plugin Name: Work with API
 * Description: Get posts from remote API
 * Requires PHP: 5.4
 */

require_once 'ApiPost.php';
require_once 'Settings.php';

new \sd\Settings();
global $pagenow;

/* Enqueue only for current page */
if ( $pagenow === 'options-general.php' && isset( $_GET['page'] ) && $_GET['page'] === 'sd-news' ) {
	add_action( 'admin_enqueue_scripts', 'sdPluginStyles' );
}

function sdPluginStyles() {
	wp_enqueue_style( 'sd-plugin-styles-main', plugin_dir_url( __FILE__ ) . 'assets/css/main.css', null, filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/main.css' ) );
}