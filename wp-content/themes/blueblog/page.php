<?php get_header(); ?>
<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->


<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content page>-->
<div class="content_page">

<!--<page file>-->
<div class="pages_file">
    <div class="pages_filein">

	<!--<postinfull>-->
	<div class="postinfull">

	<h1 class="pages_filein_h1"><?php the_title(); ?></h1>

	<div class="page_datepost">
	
			<div class="single_date_item_3">
			<?php the_time('M jS, Y') ?> 
			</div>

	</div>

	<!--<post content>-->
	<div class="page_text">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
	</div>
	<!--</post content>-->

	</div>
	<!--</postinfull>-->

    </div>
</div>
<!--</pages file>-->

</div>
<!--</content page>-->

<?php get_footer(); ?>