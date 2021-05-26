<div class="section-header">
	
	<h1><?php printf( esc_html__( 'Search Results for %s', 'videonow-pro' ), '"' . get_search_query() . '"' ); ?></h1>

</div><!-- .section-header -->

<div class="content-loop post-loop clear">

<?php
$i = 1;
/* Start the Loop */
while ( have_posts() ) : the_post();

	/*
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	$video_length = get_post_meta($post->ID, 'video_length', true);					
?>
	<article class="hentry clear">

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
			</div><!-- .thumbnail-wrap -->
		</a>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<div class="entry-meta">
			<span class="entry-category">
				<?php
					$category = get_the_category();
					if ($category) {
					  echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'videonow-pro' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
					}
				?>									
			</span><!-- .entry-category -->	
			<span class="entry-views">
				<?php echo videonow_pro_get_post_views(get_the_ID()); ?>
			</span><!-- .entry-views -->		
			<span class="entry-date">
				<?php echo get_the_date(); ?>
			</span><!-- .entry-date -->				
		</div><!-- .entry-meta -->

		<div class="entry-summary">
			<?php the_excerpt(''); ?>	
		</div><!-- .entry-summary -->

	</article><!-- .hentry -->

<?php	
	$i++;
	endwhile;
?>

</div><!-- .content-loop .post-loop -->