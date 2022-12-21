<?php

define('ASSWP_ASSINANTES', '1.0.0');

function asswp_install() {
    
	global $wpdb;

	$table_name = $wpdb->prefix . 'asswp_assinantes';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		data datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		nome tinytext NOT NULL,
		email varchar(60) NOT NULL,
		telefone varchar(60) NOT NULL,
		assunto varchar(60) NOT NULL,
		mensagem varchar(220) NOT NULL,
		form varchar(60) NOT NULL,
		nome_repre varchar(60) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

    update_option('version_table_asswp', ASSWP_ASSINANTES);
}

function asswp_install_data() {
    
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'asswp_assinantes';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ),
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}

function asswp_check_version_table(){
    if(get_site_option('version_table_asswp') != ASSWP_ASSINANTES){
         asswp_install();
    }
}
add_action('plugins_loaded', 'asswp_check_version_table');