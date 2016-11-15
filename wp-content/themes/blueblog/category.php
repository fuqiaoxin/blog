<?php get_header(); ?>
<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content>-->
<div class="content">

<!--<category name>-->
<div class="tm_catname_blog">
	<h1><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h1>
	<div class="tm_catname_blog_small">
		<?php echo category_description(); ?>
			<div class="tm_catname_blog_small_arrow"></div>
	</div>
</div>
<!--</category name>-->

	<?php get_template_part( 'blog' ); ?>
	<?php get_template_part( 'sidebar' ); ?>
</div>
<!--</content>-->

<?php get_footer(); ?>