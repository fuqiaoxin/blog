<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>
	<?php if( is_home()) { ?><?php bloginfo(); ?><?php } ?>
	<?php if(is_single()) { ?><?php the_title(); ?> | <?php bloginfo(); ?><?php } ?>
	<?php if(is_page()) { ?><?php the_title(); ?> | <?php bloginfo(); ?><?php } ?>
	<?php if(is_category()) { ?><?php single_cat_title(); ?> | <?php bloginfo(); ?><?php } ?>
	<?php if(is_tag()) { ?><?php single_tag_title(); ?> | Tag | <?php bloginfo(); ?><?php } ?>
	<?php if(is_404()) { ?>Page Not Found  | <?php bloginfo(); ?><?php } ?>
	<?php if(is_date()) { ?><?php the_time('M jS, Y') ?>  | <?php bloginfo(); ?><?php } ?>
	<?php if(is_search()) { ?><?php echo esc_html($s, 1); ?> | Search Results | <?php bloginfo(); ?> <?php } ?>
	<?php if(is_author()) { ?><?php $author = get_userdata( get_query_var('author') ); ?><?php echo $author->display_name; ?> | Author | <?php bloginfo(); ?><?php } ?>
	</title>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php get_template_part( 'style_custom' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!--<container>-->
<div class="container">

<div id="backtotop"><div class="img_backtotop"></div></div>

<div class="header">
<div class="headerin">
<div class="headerin_box">

	<?php if ( of_get_option('logo_img', true ) ) { ?>
	<!--<logo img>-->
	<div class="logo">
	<a href="<?php echo home_url(); ?>"><img src="<?php echo of_get_option('logo_img'); ?>" alt="<?php bloginfo(); ?>"></a>
	</div>
	<!--</logo img>-->
	<?php } ?>

	<?php if ( of_get_option('code728x90_textarea', true ) ) { ?>
	<!--<widget728>-->
	<div class="widget728_header">
		<?php echo of_get_option('code728x90_textarea'); ?>
	</div>
	<!--</widget728>-->
	<?php } ?>

</div>
</div>
</div>