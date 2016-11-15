<?php get_header(); ?>

<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

	<div class="content">
		<div class="post_content_all">
		<div class="postin">
		<div class="postinfull">
		

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>

		<!--<date>-->
		<div class="datepost">
		<div class="datepostin">

			<div class="single_date_item_1">
			By <?php the_author(); ?>
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

			<div class="single_date_item_6">
			<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
			</div>
		</div>
		</div>
		<!--</date>-->
	
					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">

<?php
/**
 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
 */
$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
foreach ( $attachments as $k => $attachment ) :
	if ( $attachment->ID == $post->ID )
		break;
endforeach;

$k++;
// If there is more than 1 attachment in a gallery
if ( count( $attachments ) > 1 ) :
	if ( isset( $attachments[ $k ] ) ) :
		// get the URL of the next image attachment
		$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	else :
		// or get the URL of the first image attachment
		$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	endif;
else :
	// or, if there's only 1 image, get the URL of the image
	$next_attachment_url = wp_get_attachment_url();
endif;
?>

								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'twentytwelve_attachment_size', array( 960, 960 ) );
								echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>

			<span class="previous-next-image">
				<?php previous_image_link( false, 'Previous' ); ?>
				<?php next_image_link( false, 'Next' ); ?>
			</span>

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .attachment -->

						</div><!-- .entry-attachment -->

						<div class="entry-description">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->

					</div><!-- .entry-content -->

				</article><!-- #post -->

				<div class="pfg_attach_comments">
				<?php comments_template(); ?>
				</div>

			<?php endwhile; // end of the loop. ?>

		</div><!-- postinfull -->
		</div><!-- postin -->
		</div><!-- content -->

<?php get_template_part( 'sidebar' ); ?>

	</div><!-- content-->

<?php get_footer(); ?>