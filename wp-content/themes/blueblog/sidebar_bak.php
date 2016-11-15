<!--<sidebar>-->
<div class="tm_sidebar">

 
<!--<sidebar ads>-->
<div class="sidebar_share_ads">

	<!--<share>-->
	<div class="share">
		<?php if ( of_get_option('enable_social_icon', true ) ) { ?>
		<div class="share_item">
			<?php if ( of_get_option('twitter_url', true ) ) { ?><a href="<?php echo of_get_option('twitter_url'); ?>" class="twitterIcon">twitter</a> <?php } ?>
			<?php if ( of_get_option('facebook_url', true ) ) { ?><a href="<?php echo of_get_option('facebook_url'); ?>" class="facebookIcon">facebook</a> <?php } ?>
			<?php if ( of_get_option('gplus_url', true ) ) { ?><a href="<?php echo of_get_option('gplus_url'); ?>" class="googleIcon">google</a> <?php } ?>
			<?php if ( of_get_option('linkedin_url', true ) ) { ?><a href="<?php echo of_get_option('linkedin_url'); ?>" class="inIcon">linkedIn</a> <?php } ?>
			<?php if ( of_get_option('youtube_url', true ) ) { ?><a href="<?php echo of_get_option('youtube_url'); ?>" class="youtubeIcon">youtube</a> <?php } ?>
			<?php if ( of_get_option('subscribed_url', true ) ) { ?><a href="<?php echo of_get_option('subscribed_url'); ?>" class="shareIcon">shareThis</a> <?php } ?>
			<?php if ( of_get_option('dribble_url', true ) ) { ?><a href="<?php echo of_get_option('dribble_url'); ?>" class="dribbleIcon">dribble</a> <?php } ?>
		</div>
		<?php } ?>
	</div>
	<!--</share>-->
	
	<?php if ( of_get_option('code300x250_textarea', true ) ) { ?>
	<!--<ads300>-->
	<div class="ads300">
	<?php echo of_get_option('code300x250_textarea'); ?>
	</div>
	<!--</ads300>-->
	<?php } ?>

	<!--<ads125>-->
	<div class="ads125">

		<?php if ( of_get_option('code125x125_a_textarea', true ) ) { ?>
		<div class="ads125_a"><?php echo of_get_option('code125x125_a_textarea'); ?></div>
		<?php } ?>

		<?php if ( of_get_option('code125x125_b_textarea', true ) ) { ?>
		<div class="ads125_b"><?php echo of_get_option('code125x125_b_textarea'); ?></div>
		<?php } ?>

		<div class="clear"></div>

		<?php if ( of_get_option('code125x125_c_textarea', true ) ) { ?>
		<div class="ads125_c"><?php echo of_get_option('code125x125_c_textarea'); ?></div>
		<?php } ?>

		<?php if ( of_get_option('code125x125_d_textarea', true ) ) { ?>
		<div class="ads125_d"><?php echo of_get_option('code125x125_d_textarea'); ?></div>
		<?php } ?>

		<div class="clear"></div>

		<?php if ( of_get_option('code125x125_e_textarea', true ) ) { ?>
		<div class="ads125_e"><?php echo of_get_option('code125x125_e_textarea'); ?></div>
		<?php } ?>

		<?php if ( of_get_option('code125x125_f_textarea', true ) ) { ?>
		<div class="ads125_f"><?php echo of_get_option('code125x125_f_textarea'); ?></div>
		<?php } ?>
		
		<div class="clear"></div>

		<?php if ( of_get_option('code125x125_g_textarea', true ) ) { ?>
		<div class="ads125_g"><?php echo of_get_option('code125x125_g_textarea'); ?></div>
		<?php } ?>

		<?php if ( of_get_option('code125x125_h_textarea', true ) ) { ?>
		<div class="ads125_h"><?php echo of_get_option('code125x125_h_textarea'); ?></div>
		<?php } ?>
		
		<div class="clear"></div>

		<?php if ( of_get_option('code125x125_i_textarea', true ) ) { ?>
		<div class="ads125_i"><?php echo of_get_option('code125x125_i_textarea'); ?></div>
		<?php } ?>

		<?php if ( of_get_option('code125x125_j_textarea', true ) ) { ?>
		<div class="ads125_j"><?php echo of_get_option('code125x125_j_textarea'); ?></div>
		<?php } ?>
		
		<div class="clear"></div>

	</div>
	<!--</ads125>-->
	
</div>	
<!--</sidebar ads>-->
-->

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
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('img300'); ?><div class="tm_bricknews_1_images_icon"></div></a>
				<?php } else { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/nophoto300.png" /><div class="tm_bricknews_1_images_icon"></div></a>
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