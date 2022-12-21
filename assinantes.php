<?php
/*
 * Plugin Name: Assinantes
 * Plugin URI: https://assinantes.com.br
 * Description: Plugin de cadastramente de assinantes do site com disparo de email.
 * Author: Leandro Martin
 * Author URI: https://leandromartin.com.br
 * Text Domain: assinantes
 * Domain Path: /languanges
 * Version: 1.0.0
 * License: GPL v2 or later
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('ASSWP_PATH', plugin_dir_path(__FILE__) );

register_activation_hook( __FILE__, 'asswp_activate' );

if( ! function_exists( 'asswp_activate' ) ) {

	function asswp_activate() {
        
		asswp_install();
		asswp_install_data();
		
		flush_rewrite_rules();

	}

}

register_deactivation_hook( __FILE__, 'asswp_deactivate' );

if( ! function_exists( 'asswp_deactivate' ) ) {
	
	function asswp_deactivate() {
        
		flush_rewrite_rules();
        
	}

}

require_once ASSWP_PATH . '/inc/create-table.php';
require_once ASSWP_PATH . '/inc/check.php';
require_once ASSWP_PATH . '/public/form.php';
require_once ASSWP_PATH . '/admin/admin.php';