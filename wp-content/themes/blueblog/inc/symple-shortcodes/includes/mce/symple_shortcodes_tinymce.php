<?php

class SYMPLE_TinyMCE_Buttons {
	function __construct() {
    	add_action( 'init', array(&$this,'init') );
    }
    function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		
		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array(&$this, 'add_plugin') );  
			add_filter( 'mce_buttons', array(&$this,'register_button') ); 
			wp_localize_script( 'jquery', 'sympleShortcodesVars', array('template_url' => get_template_directory_uri() ) );
		}  
    }  
	function add_plugin($plugin_array) {  
	   $plugin_array['symple_shortcodes'] = get_template_directory_uri() .'/inc/symple-shortcodes/includes/mce/js/symple_shortcodes_tinymce.js';
	   return $plugin_array; 
	}
	function register_button($buttons) {  
	   array_push($buttons, "symple_shortcodes_button");
	   return $buttons; 
	} 	
}
$sympleshortcode = new SYMPLE_TinyMCE_Buttons;