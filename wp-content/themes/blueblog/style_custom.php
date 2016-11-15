<style type="text/css">
.header { background:<?php echo of_get_option('tm_header_bcg_color', '#54C0D1' ); ?>; } 
.tm_bricknews_1_images_category { background:<?php echo of_get_option('tm_cat_brick_bcg_color', '#54C0D1' ); ?>; } 
.blogin_desc_more a { background:<?php echo of_get_option('tm_readmore_bcg_color', '#54C0D1' ); ?>; } 
.footerin { background:<?php echo of_get_option('tm_footer_list_color', '#54C0D1' ); ?>; } 
#backtotop { background:<?php echo of_get_option('tm_backtotop_bcg_color', '#54C0D1' ); ?>; } 
#Nav strong.on { background:<?php echo of_get_option('tm_page_navigation_bcg_color', '#54C0D1' ); ?>; } 
#Nav a:hover { background:<?php echo of_get_option('tm_page_navigation_bcg_color', '#54C0D1' ); ?>; } 
.tm_bricknews_1_titles a:hover { color:<?php echo of_get_option('tm_hover_link_bcg_color', '#54C0D1' ); ?>; } 
.blogin_titles h1:hover { color:<?php echo of_get_option('tm_hover_link_bcg_color', '#54C0D1' ); ?>; } 
.footer_recent_titles a:hover { color:<?php echo of_get_option('tm_hover_link_bcg_color', '#54C0D1' ); ?>; } 
#navigasi_menu ul li ul li:hover { background:<?php echo of_get_option('tm_hover_link_bcg_color', '#54C0D1' ); ?>; } 
#navigasi_menu ul li ul li:hover a { background:<?php echo of_get_option('tm_hover_link_bcg_color', '#54C0D1' ); ?>; } 
<?php if ( of_get_option('tm_custom_css_color', true ) ) { ?><?php echo of_get_option('tm_custom_css_color'); ?><?php } ?>
</style>

<?php while ( have_posts() ) : the_post(); ?>
<style type="text/css">
#post-<?php the_ID(); ?>-bcg-blogin { background:<?php echo get_post_meta( get_the_ID(), '_wpb_custom_post_background', true ); ?>; float:left; }
#post-<?php the_ID(); ?>-h1blogin { color:<?php echo get_post_meta( get_the_ID(), '_wpb_custom_post_color', true ); ?>; }
#post-<?php the_ID(); ?>-blogindate { color:<?php echo get_post_meta( get_the_ID(), '_wpb_custom_post_color', true ); ?>; }
#post-<?php the_ID(); ?>-blogindesc { color:<?php echo get_post_meta( get_the_ID(), '_wpb_custom_post_color', true ); ?>; }
#post-<?php the_ID(); ?>-blogin_desc_more a { background:<?php echo get_post_meta( get_the_ID(), '_wpb_custom_readmore_color', true ); ?>; color:<?php echo get_post_meta( get_the_ID(), '_wpb_custom_post_color', true ); ?>; }
#post-<?php the_ID(); ?>-blogin_desc_more a:hover { background:#333333; }
</style>
<?php endwhile; ?>