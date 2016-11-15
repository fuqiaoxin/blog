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

<script type="text/javascript" name="baidu-tc-cerfication" src="http://apps.bdimg.com/cloudaapi/lightapp.js#0c1de5e8ea3e9f6b1ae7e4ab5bf9cd7e"></script><script type="text/javascript">window.bd && bd._qdc && bd._qdc.init({app_id: 'fe8ffc5e8da3187350bef7d3'});</script>

</head>
<body <?php body_class(); ?>>

<!--<container>-->
<div class="container">

<div id="backtotop"><div class="img_backtotop"></div></div>

<div class="header">
<div class="headerin">
<div class="headerin_box">
	
	<!--<logo img>-->
	<div class="logo">
		<h1>
			<a href="<?php echo home_url(); ?>" title="<?php echo bloginfo();?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo(); ?>" />
				<span class="head_logotxt"><?php echo bloginfo();?></span>
			</a>
		</h1>
	</div>
	<!--</logo img>-->

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