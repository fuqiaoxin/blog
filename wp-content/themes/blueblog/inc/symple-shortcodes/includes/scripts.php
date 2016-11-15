<?php
if( !function_exists ('symple_shortcodes_scripts') ) :
	function symple_shortcodes_scripts() {
		wp_enqueue_script('jquery');
		wp_register_script( 'symple_tabs', get_template_directory_uri() . '/inc/symple-shortcodes/includes/js/symple_tabs.js', array ( 'jquery', 'jquery-ui-tabs'), '1.0', true );
		wp_register_script( 'symple_toggle', get_template_directory_uri() . '/inc/symple-shortcodes/includes/js/symple_toggle.js', 'jquery', '1.0', true );
		wp_register_script( 'symple_accordion', get_template_directory_uri() . '/inc/symple-shortcodes/includes/js/symple_accordion.js', array ( 'jquery', 'jquery-ui-accordion'), '1.0', true );
		wp_enqueue_style('symple_shortcode_styles', get_template_directory_uri() . '/inc/symple-shortcodes/includes/css/symple_shortcodes_styles.css');
		
		//@Since v1.1
		wp_register_script('symple_googlemap',  get_template_directory_uri() . '/inc/symple-shortcodes/includes/js/symple_googlemap.js', array('jquery'), '1.0', true);
		wp_register_script('symple_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
		
		//@Since v1.3
		wp_register_script( 'symple_skillbar', get_template_directory_uri() . '/inc/symple-shortcodes/includes/js/symple_skillbar.js', array ( 'jquery' ), '1.0', true );
	}
	add_action('wp_enqueue_scripts', 'symple_shortcodes_scripts');
endif;