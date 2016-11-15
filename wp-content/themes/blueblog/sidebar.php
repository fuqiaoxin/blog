<!--<sidebar>-->
<div class="tm_sidebar">

<!--<entertainment>-->
<?php if ( of_get_option('enable_entertainment_checkbox', true ) ) { ?>
<div class="tm_headlines">
	<div class="tm_headlines_full">

		<!--<entertainment category>-->
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('tm_select_entertainment_categories') ), 'posts_per_page' => 1, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
			<div class="tm_headlines_title">
			<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
			</div>
		<?php endwhile; ?>
		<!--<entertainment category>-->
		
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('tm_select_entertainment_categories') ), 'posts_per_page' => 3, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>

		<div class="tm_sidebar_headlines tm-post-<?php the_ID(); ?>">		
				<div class="tm_sidebar_headlines_images">
					<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img300'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
					<?php }else{ ?>	
						<?php if (catch_that_image()) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo catch_that_image('300'); ?>" />
						<div class="tm_bricknews_1_images_icon"></div></a>
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/nophoto300.png" /><div class="tm_bricknews_1_images_icon"></div></a>
						<?php } ?>
					<?php } ?>
				</div>
				
				<div class="tm_sidebar_headlines_titles">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">			
				<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 92); if (strlen($tit) > 92) echo " ..."; ?>				
				</a>
				</div>		
		</div>
		<?php endwhile; ?>

	</div>		
</div>
<?php } ?>
<!--</entertainment>-->

<!--<sidebar home>-->
<div class="sidebar_home">

	<!--<sidebar widget>-->
	<div class="sidebarwidget">
		<ul>
		<?php if (!dynamic_sidebar('Sidebar Widget') ) : ?><?php endif; ?>
		</ul>
	</div>
	<!--<sidebar widget>-->

</div>
<!--</sidebar home>-->

</div>
<!--<sidebar>-->