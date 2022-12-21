<?php

class asswp_admin {

	static $instance = false;

	public static function get_instance() {

		if( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	private function __construct() {

		add_action( 'admin_menu', array($this, 'asswp_menu_page') );
        
	}

	public function asswp_menu_page() {
		// add top level menu page
        
        add_menu_page(
			'Assinantes',
			'Assinantes',
			'manage_options',
			'assinantes',            
			array( $this, 'asswp_page_html' ),
            'dashicons-businesswoman',
            56
		);
	}
    
	public function asswp_page_html() {
        
		include( ASSWP_PATH . 'admin/admin-list.php' );
        
	}
    public function asswp_page_edit_html() {
        
		include( ASSWP_PATH . 'admin/admin-edit.php' );
        
	}

}
add_action('plugins_loaded', array('asswp_admin', 'get_instance') );    