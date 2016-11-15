<?php get_header(); ?>
<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content>-->
<div class="content">

<!--<tag name>-->
<div class="tm_tagname_blog">
	<h1><?php single_tag_title(); ?></h1>
		<div class="tm_tagname_blog_arrow"></div>
</div>
<!--</tag name>-->

	<?php get_template_part( 'blog' ); ?>
	<?php get_template_part( 'sidebar' ); ?>
</div>
<!--</content>-->

<?php get_footer(); ?>