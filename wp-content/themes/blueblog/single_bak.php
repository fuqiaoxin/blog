<?php get_header(); ?>
<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content>-->
<div class="content">

<!--<post>-->
<div class="post_content_all">
    <div class="postin">

	<!--<postinfull>-->
	<div class="postinfull">
	
	<!--<loop>-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h1><?php the_title(); ?></h1>
		<div class="datepost">
		<div class="datepostin">

			<div class="single_date_item_1">
			By <?php the_author(); ?>
			</div>

			<div class="single_date_item_2">
			In <?php $category = get_the_category(); echo $category[0]->cat_name; ?>
			</div>

			<div class="single_date_item_3">
			<?php the_time('M jS, Y') ?> 
			</div>

			<div class="single_date_item_4">
			<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
			</div>

			<div class="single_date_item_5">
			<?php if(function_exists('bac_PostViews')) { echo bac_PostViews(get_the_ID()); } ?>
			</div>

		</div>
		</div>

	<!--<post content>-->
	<div id="post-<?php the_ID(); ?>" class="post_text">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
	<!--</loop>-->
	</div>
	<!--</post content>-->

	<!--<edit post>-->
	<?php edit_post_link('edit', '<p>', '</p>'); ?>
	<!--</edit post>-->

	<?php if( get_the_tags() ) { ?>
	<!--<tags>-->
	<div class="post_tags">
		<?php the_tags('<span>Tagged:</span><ul><li>','</li><li>','</li>','</ul>'); ?> 
	</div>
	<!--</tags>-->
	<?php } ?>

	<!--<share post>-->
	<div class="share_post">
		<div class="share_post_pad">

			<!--facebook share-->
			<div class="share_post_facebook">
				<div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-layout="button_count" data-show-faces="false"></div>
			</div>
			<!--// facebook share-->

			<!--G+-->
			<div class="share_post_gplus">
		<!-- Place this tag where you want the share button to render. -->
				<div class="g-plus" data-action="share" data-annotation="bubble"></div>
			</div>
			<!--/G+-->

			<!--linkedIn-->
			<div class="share_post_linkedin">
				<script type="IN/Share" data-url="<?php the_permalink() ?>"></script>
			</div>
			<!--linkedIN-->

			<!--twitter share-->
			<div class="share_post_twitter">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>">Tweet</a>
			</div>
			<!--/twitter share-->

		</div>
	</div>
	<!--</share post>-->

		<?php if( get_the_author_meta('description') ) { ?>
		<!--<author>-->
		<div class="author_post">
			<div class="author_post_item">
					<div class="author_post_name">
					<h4>About "<?php the_author_posts_link(); ?>" Has <?php the_author_posts(); ?> Posts</h4>
					</div>

					<div class="author_post_pic">
					<?php echo get_avatar( get_the_author_meta('ID'), 56 ); ?>
					</div>

					<div class="author_post_desc">
					<?php the_author_meta('description'); ?>
					</div>
			</div>
		</div>
		<!--</author>-->
		<?php } ?>


		<!--<related>-->
		<div class="recent_post_category">

		<h3>Related Posts By Category</h3>

		<?php $cats = array(); foreach( get_the_category() as $cat ) { $cats[] = $cat->term_id; }; $recent = new WP_Query( array('category__in' => $cats, 'posts_per_page' => 4 )); while($recent->have_posts()) : $recent->the_post();?>

			<div class="rpc_posts">
				<div class="rpc_postimage">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('img150'); ?>
					<div class="tm_bricknews_1_images_icon"></div>
					</a>
				<?php } else { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto.png" /></a>
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

			<?php if ( of_get_option('enable_defaultcomment_checkbox', true ) ) { ?>
			<!--<default comments>-->
			<?php comments_template( '', true ); ?>
			<!--</default comments>-->
			<?php } ?>

			<?php if ( of_get_option('enable_facebookcomment_checkbox', true ) ) { ?>
			<!--<facebook comments>-->
			<div id="facebook_comments">
			<div id="facebook_comments_box"><h3>facebook comments:</h3></div>

			<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="10" mobile="false"></div>

			</div>
			<!--</facebook comments>-->
			<?php } ?>

	</div>
	<!--</postinfull>-->

    </div>
</div>
<!--</post>-->

<?php get_template_part( 'sidebar' ); ?>

</div>
<!--</content>-->

<?php get_footer(); ?>