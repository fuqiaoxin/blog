<?php get_header(); ?>

<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<div class="content">

<!--<only home>-->
<?php if(is_home()) { ?>

<!--<slideshow>-->

<!--</slideshow>-->

<!--<brick news 1>-->
<?php if ( of_get_option('enable_brick1_checkbox', true ) ) { ?>
<div class="tm_bricknews_1">
	<ul class="tm_bricknews_box_1">
			
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('brick1_select_categories') ), 'posts_per_page' => 4, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
		<li class="tm_bricknews_1_box tm-post-<?php the_ID(); ?>">		
				<div class="tm_bricknews_1_images">
					<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img253'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
					<?php }else { ?>
						<?php if(catch_that_image()){ ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo catch_that_image('253'); ?>" alt="<?php the_title_attribute(); ?>" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>				
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto253.png" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>
						<?php } ?>

					<?php } ?>
					
					<div class="tm_bricknews_1_images_category">
					<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
					</div>
				</div>

				<div class="tm_bricknews_1_titles_desc">
				<div class="tm_bricknews_1_titles_desc_arrow">

					<div class="tm_bricknews_1_titles">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
					<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 55); if (strlen($tit) > 55) echo " ..."; ?>				
					</a>
					</div>

				</div>
				</div>


				<div class="tm_bricknews_1_date">
					<div class="brick_date_item_1">
					<?php the_time('Y.m.d') ?> 
					</div>

					<div class="brick_date_item_2">
					<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
					</div>
				</div>
				
		</li>
		<?php endwhile; wp_reset_query(); ?>
	
	</ul>
</div>
<?php } ?>
<!--</brick news 1>-->

<!--<brick news 2>-->
<?php if ( of_get_option('enable_brick2_checkbox', true ) ) { ?>
<div class="tm_bricknews_1">
	<ul class="tm_bricknews_box_1">
			
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('brick2_select_categories') ), 'posts_per_page' => 4, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
		<li class="tm_bricknews_1_box tm-post-<?php the_ID(); ?>">	
		
				<div class="tm_bricknews_1_images">
					<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img253'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
					<?php }else{ ?>
						<?php if (catch_that_image()) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo catch_that_image('253');?>" alt="<?php the_title_attribute(); ?>" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>				
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto253.png" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>
						<?php } ?>
					
					<?php } ?>
						
				
					<div class="tm_bricknews_1_images_category">
					<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
					</div>
				</div>
				
				<div class="tm_bricknews_1_titles_desc">
				<div class="tm_bricknews_1_titles_desc_arrow">
					<div class="tm_bricknews_1_titles">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">			
					<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 55); if (strlen($tit) > 55) echo " ..."; ?>				
					</a>
					</div>	
				</div>
				</div>

				<div class="tm_bricknews_1_date">
					<div class="brick_date_item_1">
					<?php the_time('Y.m.d') ?> 
					</div>

					<div class="brick_date_item_2">
					<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
					</div>
				</div>
				
		</li>
		<?php endwhile; wp_reset_query(); ?>
	
	</ul>
</div>
<?php } ?>
<!--</brick news 2>-->

<!--<tagline>-->
<?php if ( of_get_option('tm_enable_tagline_checkbox', true ) ) { ?>
<div class="tm_boxhome">
	<div class="tm_boxhome_all">
		<div class="tm_boxhome_tagline">
			<div class="tm_boxhome_big">
			<?php echo of_get_option('big_tagline_text'); ?>
			</div>

			<div class="tm_boxhome_small">
			<?php echo of_get_option('small_tagline_text'); ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--</tagline>-->

<!--<brick news 3>-->
<?php if ( of_get_option('enable_brick3_checkbox', true ) ) { ?>
<div class="tm_bricknews_1">
	<ul class="tm_bricknews_box_1">
			
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('brick3_select_categories') ), 'posts_per_page' => 4, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
		<li class="tm_bricknews_1_box tm-post-<?php the_ID(); ?>">	
		
				<div class="tm_bricknews_1_images">
					<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img253'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
					<?php }else{ ?>
						<?php if (catch_that_image()) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo catch_that_image('253');?>" alt="<?php the_title_attribute(); ?>" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>				
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto253.png" />
							<div class="tm_bricknews_1_images_icon"></div>							
						</a>
						<?php } ?>
					
					<?php }?>
						
					
					<div class="tm_bricknews_1_images_category">
					<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
					</div>
				</div>
				
				<div class="tm_bricknews_2_titles_desc">
				<div class="tm_bricknews_1_titles_desc_arrow">

					<div class="tm_bricknews_1_titles">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">			
					<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 55); if (strlen($tit) > 55) echo " ..."; ?>				
					</a>
					</div>	

					<div class="tm_bricknews_1_desc">
					<?php //echo excerpt(85); 
						echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"..."); 
					?> 
					</div>

				</div>
				</div>
				
				<div class="tm_bricknews_1_date">
					<div class="brick_date_item_1">
					<?php the_time('Y.m.d') ?> 
					</div>

					<div class="brick_date_item_2">
					<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
					</div>
				</div>

		</li>
		<?php endwhile; wp_reset_query(); ?>
	
	</ul>
</div>
<?php } ?>
<!--</brick news 3>-->

<!--<brick news 4>-->
<?php if ( of_get_option('enable_brick4_checkbox', true ) ) { ?>
<div class="tm_bricknews_1">
	<ul class="tm_bricknews_box_1">
			
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('brick4_select_categories') ), 'posts_per_page' => 4, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
		<li class="tm_bricknews_1_box tm-post-<?php the_ID(); ?>">	
		
				<div class="tm_bricknews_1_images">
					<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img253'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
					<?php }else{ ?>	
						<?php if (catch_that_image()) { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo catch_that_image('253');?>" alt="<?php the_title_attribute(); ?>" />
						<div class="tm_bricknews_1_images_icon"></div>
						</a>				
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto253.png" />					
						</a>
						<?php } ?>
					<?php } ?>
					
					<div class="tm_bricknews_1_images_category">
					<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
					</div>
				</div>
				
				<div class="tm_bricknews_2_titles_desc">
				<div class="tm_bricknews_1_titles_desc_arrow">

					<div class="tm_bricknews_1_titles">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">			
					<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 55); if (strlen($tit) > 55) echo " ..."; ?>				
					</a>
					</div>	

					<div class="tm_bricknews_1_desc">
					<?php //echo excerpt(85);
						echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"..."); 
					?> 
					</div>

				</div>
				</div>

				<div class="tm_bricknews_1_date">
					<div class="brick_date_item_1">
					<?php the_time('Y.m.d') ?> 
					</div>

					<div class="brick_date_item_2">
					<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
					</div>
				</div>
				
		</li>
		<?php endwhile; wp_reset_query(); ?>
	
	</ul>
</div>
<?php } ?>
<!--</brick news 4>-->

<?php } ?>
<!--</only home>-->

<?php get_template_part( 'blog' ); ?>
<?php get_template_part( 'sidebar' ); ?>

</div>

<?php get_footer(); ?>