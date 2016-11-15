<?php get_header(); ?>

<?php if (have_posts()) : ?>

<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content>-->
<div class="content">

	<!--<search name>-->
	<div class="tm_tagname_blog">
		<h1><?php echo esc_html($s, 1); ?></h1>
		<div class="tm_tagname_blog_arrow"></div>
	</div>
	<!--</search name>-->

	<?php get_template_part( 'blog' ); ?>
	<?php get_template_part( 'sidebar' ); ?>

</div>
<!--</content>-->

<!--<else>-->
<?php else : ?>

<?php get_template_part( '404' ); ?>

<?php endif; ?>
<!--</else>-->

<?php get_footer(); ?>