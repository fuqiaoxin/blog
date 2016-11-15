<?php

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

function optionsframework_options() {

	// data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo Image', 'options_check'),
		'desc' => __('Upload your logo.', 'options_check'),
		'id' => 'logo_img',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Enable / Disable Slider', 'options_check'),
		'desc' => __('Check the box if you want to enable Slide Show.', 'options_check'),
		'id' => 'tm_enable_slide_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Slider Category', 'options_check'),
		'desc' => __('Please select your slide show category.', 'options_check'),
		'id' => 'tm_select_slide_categories',
		'type' => 'select',
		'options' => $options_categories);	
		
	$options[] = array(
		'name' => __('Enable / Disable Brick 1', 'options_check'),
		'desc' => __('Check the box if you want to enable Brick 1.', 'options_check'),
		'id' => 'enable_brick1_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Brick 1 Category', 'options_check'),
		'desc' => __('Please select your Brick 1 category.', 'options_check'),
		'id' => 'brick1_select_categories',
		'type' => 'select',
		'options' => $options_categories);	


	$options[] = array(
		'name' => __('Enable / Disable Brick 2', 'options_check'),
		'desc' => __('Check the box if you want to enable Brick 2.', 'options_check'),
		'id' => 'enable_brick2_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Brick 2 Category', 'options_check'),
		'desc' => __('Please select your Brick 2 category.', 'options_check'),
		'id' => 'brick2_select_categories',
		'type' => 'select',
		'options' => $options_categories);	


	$options[] = array(
		'name' => __('Enable / Disable Brick 3', 'options_check'),
		'desc' => __('Check the box if you want to enable Brick 3.', 'options_check'),
		'id' => 'enable_brick3_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Brick 3 Category', 'options_check'),
		'desc' => __('Please select your Brick 3 category.', 'options_check'),
		'id' => 'brick3_select_categories',
		'type' => 'select',
		'options' => $options_categories);	


	$options[] = array(
		'name' => __('Enable / Disable Brick 4', 'options_check'),
		'desc' => __('Check the box if you want to enable Brick 4.', 'options_check'),
		'id' => 'enable_brick4_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Brick 4 Category', 'options_check'),
		'desc' => __('Please select your Brick 4 category.', 'options_check'),
		'id' => 'brick4_select_categories',
		'type' => 'select',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Enable / Disable Tagline', 'options_check'),
		'desc' => __('Check the box if you want to enable tagline.', 'options_check'),
		'id' => 'tm_enable_tagline_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Big Tagline', 'options_check'),
		'desc' => __('Input your big tagline text.', 'options_check'),
		'id' => 'big_tagline_text',
		'std' => 'You only <a href="#">live</a> once, but if you <a href="#">do it</a> right, once is enough',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Small Tagline', 'options_check'),
		'desc' => __('Input your small tagline text.', 'options_check'),
		'id' => 'small_tagline_text',
		'std' => 'Please enter your small title for this section. Ini adalah contoh text yang dapat anda gunakan untuk pembuatan dummy situs.',
		'class' => 'textarea',
		'type' => 'text');

	$options[] = array(
		'name' => __('Latest Post Big Text', 'options_check'),
		'desc' => __('Input your latest post text', 'options_check'),
		'id' => 'tm_latestpost_text',
		'std' => 'Latest from our Posts',
		'class' => 'textarea',
		'type' => 'text');

	$options[] = array(
		'name' => __('Latest Post Small Text', 'options_check'),
		'desc' => __('Input your latest post text', 'options_check'),
		'id' => 'tm_latestpost_text_small',
		'std' => 'Please enter your small title for this section',
		'class' => 'textarea',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable / Disable Insert Post Category', 'options_check'),
		'desc' => __('Check the box if you want to enable insert post category.', 'options_check'),
		'id' => 'enable_inserpost1_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Insert Category', 'options_check'),
		'desc' => __('Please select your insert post category.', 'options_check'),
		'id' => 'tm_select_insertpost1_categories',
		'type' => 'select',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Enable / Disable Entertainment Category in Sidebar', 'options_check'),
		'desc' => __('Check the box if you want to enable entertainment category in sidebar.', 'options_check'),
		'id' => 'enable_entertainment_checkbox',
		'std' => '1',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Select Entertainment Category', 'options_check'),
		'desc' => __('Please select entertainment post category.', 'options_check'),
		'id' => 'tm_select_entertainment_categories',
		'type' => 'select',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Ads', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Ads 728x90', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 728 x 90 pixel.', 'options_check'),
		'id' => 'code728x90_textarea',
		'std' => '<img src="http://i.imgur.com/87C0jlB.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 300x250', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 300 x 250 pixel.', 'options_check'),
		'id' => 'code300x250_textarea',
		'std' => '<img src="http://i.imgur.com/nWKKbmI.jpg">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 A', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_a_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 B', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_b_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 C', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_c_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 D', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_d_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 E', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_e_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 F', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_f_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 G', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_g_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Ads 125x125 H', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_h_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');
		
		$options[] = array(
		'name' => __('Ads 125x125 I', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_i_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');
		
		$options[] = array(
		'name' => __('Ads 125x125 J', 'options_check'),
		'desc' => __('insert your ads / adsense code. Ads size 125 x 125 pixel.', 'options_check'),
		'id' => 'code125x125_j_textarea',
		'std' => '<img src="http://i.imgur.com/MpAqzdm.png">',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Socials', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Twitter', 'options_check'),
		'desc' => __('Input your twitter url. Must use http://', 'options_check'),
		'id' => 'twitter_url',
		'std' => '#twitter',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Facebook', 'options_check'),
		'desc' => __('Input your facebook url. Must use http://', 'options_check'),
		'id' => 'facebook_url',
		'std' => '#facebook',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google Plus', 'options_check'),
		'desc' => __('Input your G+ url. Must use http://', 'options_check'),
		'id' => 'gplus_url',
		'std' => '#gplus',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('LinkedIn', 'options_check'),
		'desc' => __('Input your LinkedIn url. Must use http://', 'options_check'),
		'id' => 'linkedin_url',
		'std' => '#linkedin',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Youtube', 'options_check'),
		'desc' => __('Input your youtube url. Must use http://', 'options_check'),
		'id' => 'youtube_url',
		'std' => '#youtube',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Subscribed', 'options_check'),
		'desc' => __('Input your subscribed url. Must use http://', 'options_check'),
		'id' => 'subscribed_url',
		'std' => '#subscribed',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Dribble', 'options_check'),
		'desc' => __('Input your dribble url. Must use http://', 'options_check'),
		'id' => 'dribble_url',
		'std' => '#dribble',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Enable / Disable Social Icon', 'options_check'),
		'desc' => __('Check the box if you want to enable social icon.', 'options_check'),
		'id' => 'enable_social_icon',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Footer', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Footer Text', 'options_check'),
		'desc' => __('Insert your footer text.', 'options_check'),
		'id' => 'abouttext_textarea',
		'std' => 'Copyright 2013 Developed by <a href="//www.template.my.id">Template</a> - Your footer notes here.',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Style', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Header Background Color', 'options_check'),
		'desc' => __('Change the header background color.', 'options_check'),
		'id' => 'tm_header_bcg_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Category Brick Background Color', 'options_check'),
		'desc' => __('Change the "category brick" background color.', 'options_check'),
		'id' => 'tm_cat_brick_bcg_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Read More Background Color', 'options_check'),
		'desc' => __('Change the "Read More" background color.', 'options_check'),
		'id' => 'tm_readmore_bcg_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Back To Top', 'options_check'),
		'desc' => __('Change "Back To Top" background color.', 'options_check'),
		'id' => 'tm_backtotop_bcg_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Page Navigation', 'options_check'),
		'desc' => __('Change "Page Navigation" color.', 'options_check'),
		'id' => 'tm_page_navigation_bcg_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Hover Color', 'options_check'),
		'desc' => __('Change "Hover" color.', 'options_check'),
		'id' => 'tm_hover_link_bcg_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Footer List Color', 'options_check'),
		'desc' => __('Change the footer list color.', 'options_check'),
		'id' => 'tm_footer_list_color',
		'std' => '#54C0D1',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Custom CSS', 'options_check'),
		'desc' => __('You can add custom css in here.', 'options_check'),
		'id' => 'tm_custom_css_color',
		'type' => 'textarea' );

	$options[] = array(
		'name' => __('Comments', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Enable / Disable defult Wordpress comment', 'options_check'),
		'desc' => __('Check the box if you want to enable defult Wordpress comment.', 'options_check'),
		'id' => 'enable_defaultcomment_checkbox',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable / Disable Facebook comment', 'options_check'),
		'desc' => __('Check the box if you want to enable Facebook comment.', 'options_check'),
		'id' => 'enable_facebookcomment_checkbox',
		'std' => '0',
		'type' => 'checkbox');
	

	return $options;
}