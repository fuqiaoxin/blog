<?php get_header(); ?>

<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content>-->
<div class="content">
<div class="post_content_all">

<!--<post>-->
<div class="post">
    <div class="postin">

	<!--<postinfull>-->
	<div class="postinfull">

	<!--<404 post content>-->
	<div class="error_posts">404 - Page not found!</div>
	<div class="error_postsin">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</div>
	<!--</404 post content>-->

		<!--<related>-->
		<div class="recent_post_category">

		<h3>Recent Posts</h3>

		<?php $cats = array(); foreach( get_the_category() as $cat ) { $cats[] = $cat->term_id; }; $recent = new WP_Query( array('category__in' => $cats, 'post__not_in' => get_option( 'sticky_posts' ), 'posts_per_page' => 4 )); while($recent->have_posts()) : $recent->the_post();?>

			<div class="rpc_posts">
				<div class="rpc_postimage">
				<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('img150'); ?></a>

				<?php } else { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/nophoto.png" /></a>
				<?php } ?>
				</div>

				<div class="rpc_postinfo">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
				<h4><?php $tit = the_title('','',FALSE); echo substr($tit, 0, 70); if (strlen($tit) > 70) echo " ..."; ?></h4>
				</a>
				</div>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

		</div>
		<!--</related>-->

			<!--<comments>-->
			<?php comments_template(); ?>
			<!--</comments>-->

	</div>
	<!--</postinfull>-->

    </div>
</div>
<!--</post>-->

<?php get_template_part( 'sidebar' ); ?>

</div>
</div>
<!--</content>-->

<?php get_footer(); ?>