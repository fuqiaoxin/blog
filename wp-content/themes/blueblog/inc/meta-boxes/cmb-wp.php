<?php
/*
Plugin Name: Custom Meta Boxes
License: GPL
*/

//Initialize the metabox class

function wpb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		get_template_part( 'inc/meta-boxes/init' ); 
}

add_action( 'init', 'wpb_initialize_cmb_meta_boxes', 9999 );

//Add Meta Boxes

function wpb_sample_metaboxes( $meta_boxes ) {
	$prefix = '_wpb_'; // Prefix for all fields

	$meta_boxes[] = array(
		'id' => 'test_metabox',
		'title' => 'Custom Color Post',
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(

			array(
				'name' => 'Custom Background',
				'desc' => 'Select your custom background color.',
				'id' => $prefix . 'custom_post_background',
				'type' => 'colorpicker'
			),

			array(
				'name' => 'Custom Font Color',
				'desc' => 'Select your custom font color.',
				'id' => $prefix . 'custom_post_color',
				'type' => 'colorpicker'
			),

			array(
				'name' => 'Custom Read More',
				'desc' => 'Select your custom read more background color.',
				'id' => $prefix . 'custom_readmore_color',
				'type' => 'colorpicker'
			),

		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'wpb_sample_metaboxes' );