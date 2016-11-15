<?php
/**
 * Template Name: Blog
 */
?>

<?php if(is_home()) { ?>
<!--<latest post text>-->
<?php if ( of_get_option('tm_latestpost_text', true ) ) { ?>
<div class="tm_last_blog">
	<span><?php echo of_get_option('tm_latestpost_text'); ?></span>
	<div class="tm_last_blog_small">
		<?php echo of_get_option('tm_latestpost_text_small'); ?>
			<div class="tm_last_blog_small_arrow"></div>
	</div>
</div>
<?php } ?>
<!--</latest post text>-->
<?php } ?>

<!--<full blog>-->
<div class="full_blog">
<div class="blogin">

	<div class="blogin_allpost">
	<div class="blogin_posts">

		<?php $count=0; ?> <!-- count must be outside the loop -->
		<?php while ( have_posts() ) : the_post(); ?>
		
			<!--<blogin_item>-->
			<div class="blogin_item">

<!--<custom_color>-->
<div id="post-<?php the_ID(); ?>-bcg-blogin">

				<!--<post class>-->
				<div <?php post_class(); ?>>

				<div class="blogin_images">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img200'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
				<?php }else{
						if(catch_that_image()){
				?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo catch_that_image('205'); ?>" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>					

					<?php }else{ ?>
						 
						 <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto205.png" />
							<div class="tm_bricknews_1_images_icon"></div>
						 </a>
						 
				<?php	}

					}	
				?>			
				
					
				</div>

			     <div class="blogin_title_img">
				<div class="blogin_titles">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
				<h1 id="post-<?php the_ID(); ?>-h1blogin">
				<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 92); if (strlen($tit) > 92) echo " ..."; ?>
				</h1>
				</a>
				</div>

				<!--<blog date>-->
				<div class="blogin_date">
				<div id="post-<?php the_ID(); ?>-blogindate">
					
					<div class="blogin_date_item_1">
					By <?php the_author(); ?>
					</div>

					<div class="blogin_date_item_4">
					<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
					</div>

					<div class="blogin_date_item_3">
					<?php the_time('Y.m.d') ?>
					</div>

				</div>
				</div>
				<!--<blog date>-->
				<div class="clear"></div>
				<div class="blogin_desc">

				<div id="post-<?php the_ID(); ?>-blogindesc">
				<?php //echo excerpt(150);
					echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"..."); 
				?> 
				</div>

				<div class="blogin_desc_more">
					<div id="post-<?php the_ID(); ?>-blogin_desc_more">
					<a href="<?php the_permalink() ?>">Read More</a>
					</div>
				</div>

				</div>
			     </div>

			</div>
			<!--<post class>-->

</div>
<!--</custom_color>-->

			</div>
			<!--</blogin_item>-->
			
		<!--<insert code after second post>-->
		<?php if(is_home()) { ?>
		<?php if ($count == 1) : ?><!-- count number -->
			
<!--<insert>-->
<?php if ( of_get_option('enable_inserpost1_checkbox', true ) ) { ?>
<div class="tm_inserthome_1">

	<!--<insert category>-->
	<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('tm_select_insertpost1_categories') ), 'posts_per_page' => 1, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
		<div class="tm_inserthome_1_category">
		<?php $category = get_the_category(); echo $category[0]->cat_name; ?>
		</div>
	<?php endwhile; ?>
	<!--</insert category>-->
	
	<ul class="tm_inserthome_box_1">
			
		<?php $recent = new WP_Query( array( 'category__in' => array( of_get_option('tm_select_insertpost1_categories') ), 'posts_per_page' => 5, 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ) ) ); while($recent->have_posts()) : $recent->the_post(); ?>
				
		<li class="tm_inserthome_1_box tm-post-<?php the_ID(); ?>">					
		
				<div class="tm_inserthome_1_images">
						<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img253'); ?>
						<div class="tm_inserthome_1_images_icon"></div>
					</a>
					<?php }else{ ?>	
						<?php if(catch_that_image()){ ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo catch_that_image('253'); ?>" />
						<div class="tm_inserthome_1_images_icon"></div>
						</a>				
						<?php } else { ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto253.png" />					
						</a>
						<?php } ?>
					<?php } ?>	
				</div>
				
				<div class="tm_inserthome_1_titles_desc">
					<div class="tm_inserthome_1_titles">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">			
					<?php $tit = the_title('','',FALSE); echo substr($tit, 0, 57); if (strlen($tit) > 57) echo " ..."; ?>				
					</a>
					</div>	
				</div>
				
		</li>
		
		<?php endwhile; ?>
	
	</ul>
</div>
<?php } ?>
<!--</insert>-->

		<?php endif; $count++; ?>
		<?php } ?>
		<!--</insert code after second post>-->	
		
		<?php endwhile; ?>
		
	</div>
	</div>
	
<!--<page navigation>-->
<div class="navigation">
	<?php if( function_exists('wp_pagenavi') ) { wp_pagenavi('', '', '', '', 3, false); } ?>
</div>
<!--</page navigation>-->

</div>
</div>
<!--</full blog>-->
