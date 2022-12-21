<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

if( ! function_exists( 'asswp_uninstall' ) ) {
	 
	 function asswp_uninstall() {
         
        global $wpdb;
         
        delete_option( 'asswp_assinantes' );
         
	 	$assinantes = get_posts( 
	 		array(
	 			'post_type' => 'assinantes',
	 			'numberposts' => -1
	 		)
	 	);

	 	if ( !empty( $assinantes ) ) {
	 		foreach( $assinantes as $ass ) {
	 			wp_delete_post( $ass->ID, true );
	 		}
	 	}
         
        asswp_install();
        asswp_install_data();
         
	 }
}

asswp_uninstall();