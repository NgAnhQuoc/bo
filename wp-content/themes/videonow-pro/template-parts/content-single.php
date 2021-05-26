<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package videonow-pro
 */

	$content = get_the_content();

	global $has_embed;

	preg_match  ('/<iframe(.+)\"/', $content, $matches);
	if (!empty($matches)) {
		$has_embed = true;
	}

	preg_match  ('/<object(.+)\"/', $content, $matches);
	if (!empty($matches)) {
		$has_embed = true;
	}

	preg_match  ('/<embed(.+)\"/', $content, $matches);
	if (!empty($matches)) {
		$has_embed = true;
	}		

?>

<article id="post-<?php the_ID(); ?>" <?php if( ($has_embed == true || videonow_pro_has_embed()) && get_theme_mod('video-styles', true) == 'choice-1' ) { post_class('has-embed'); } else { post_class(); }; ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta clear">

			<span class="post-author">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?></a>
				<strong><?php echo the_author_posts_link(); ?></strong>
				<?php echo get_the_date(); ?>					
			</span><!-- .post-author -->

			<span class="post-comment">
				<a href="<?php echo get_comments_link( $post->ID ); ?>"><strong><?php comments_number( '0', '1', '%' ); ?></strong><?php echo __( 'Comments', 'videonow-pro'); ?></a>
			</span><!-- .post-comment -->

			<span class="post-view">
				<?php echo videonow_pro_get_post_views(get_the_ID()); ?>
			</span><!-- .post-view -->

			<span class="entry-share">
				<a class="icon-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" title="<?php echo __('Share on Facebook', 'videonow-pro'); ?>" target="_blank"><span class="genericon genericon-facebook-alt"></span></a>
				<a class="icon-twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( esc_attr( get_the_title( get_the_ID() ) ) ); ?>&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>"  title="<?php echo __('Share on Twitter', 'videonow-pro'); ?>" target="_blank"><span class="genericon genericon-twitter"></span></a>
				<a class="icon-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>" title="<?php echo __('Share on Pinterest', 'videonow-pro'); ?>" target="_blank"><span class="genericon genericon-pinterest"></span></a>
				<a class="icon-google-plus" href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" title="<?php echo __('Share on Google+', 'videonow-pro'); ?>" target="_blank"><span class="genericon genericon-googleplus-alt"></span></a>
			</span><!-- .entry-share -->

		</div><!-- .entry-meta -->

		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'videonow-pro' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'videonow-pro' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-tags">
		<?php if (has_category()) { ?><span><strong><?php echo __('Filed in:', 'videonow-pro'); ?></strong> <?php the_category(', '); ?></span><?php } ?>

		<?php if (has_tag()) { ?><span><strong><?php echo __('Tags:', 'videonow-pro'); ?></strong> <?php the_tags(''); ?></span><?php } ?>
			
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'videonow-pro' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</div><!-- .entry-tags -->

</article><!-- #post-## -->

<?php
	
	if ( get_theme_mod('related-posts-on', true) ) : 
	 
	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Posts query arguments.
	$query = array(
		'post__not_in' => array( get_the_ID() ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 3,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'videonow_pro_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : $i = 1; ?>

		<div class="content-block entry-related clear">
			<h3><?php echo __('You might like', 'videonow-pro'); ?></h3>
			<div class="related-loop clear">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<?php
					$video_length = get_post_meta($post->ID, 'video_length', true);										
					$class = ( 0 == $i % 3 ) ? 'hentry last' : 'hentry';
					?>
					<div class="<?php echo esc_attr( $class ); ?>">
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<div class="thumbnail-wrap">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'general-thumb' ); 
									} else { 
										echo '<img src="' . get_template_directory_uri() . '/assets/img/thumbnail-default.png" alt="" />';
			        				} 
		        				?>
								<?php if (!empty($video_length)) { ?>
									<span class="video-length"><?php echo $video_length; ?></span>
								<?php } ?>	
							</div>
						</a>				
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-meta">
							<span class="entry-views"><?php echo videonow_pro_get_post_views(get_the_ID()); ?></span>
						</div>
					</div><!-- .grid -->
				<?php $i++; endwhile; ?>
			</div><!-- .related-posts -->
		</div><!-- .content-block entry-related -->

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

	endif;
?>