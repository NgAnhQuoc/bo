<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package videonow-pro
 */

get_header(); ?>

	<div id="primary" class="content-area layout-1c clear">
		<main id="main" class="site-main clear">

			<div class="section-header">

				<?php
					if ( is_category() ) {
						$category = get_category( get_query_var('cat') );
					}
				?>

				<h1>
					<a href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>">
						<?php
							if (function_exists('z_taxonomy_image')) {
								echo z_taxonomy_image(); 
							}
							printf( single_cat_title( '', false ) );
						?>
					</a>
				</h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>				
				
				<?php
					// Show category feed link
				    if ( ! empty( $category ) )
				        echo '<div class="section-more"><span class="subscribe"><a href="' . get_category_feed_link( $category->cat_ID ) . '" title="' . sprintf( __( 'Subscribe to this category', 'videonow-pro' ), $category->name ) . '" rel="nofollow">' . '<span class="genericon genericon-feed"></span> ' . __( 'Subscribe', 'videonow-pro' ) . '</a></span></div>';

				?>
			</div><!-- .section-header -->

			<div class="content-block clear">

				<?php

				if ( have_posts() ) :

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

					<div class="hentry <?php if ( $i % 4 == 0 ) { echo 'last'; } ?>">

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

					</div><!-- .hentry -->

				<?php

				if ( $i % 4 == 0 ) { 
					echo '<div class="clear"></div>'; 
				}
				
				$i++;

				endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				?>

			<?php endif; ?>

			</div><!-- .content-block -->

		</main><!-- #main -->
		<?php

			echo '<div class="clear"></div>';

			global $wp_version;

			if ( $wp_version >= 4.1 ) :

				the_posts_pagination( array( 'prev_text' => _x( 'Previous', 'previous post', 'videonow-pro' ) ) );
			
			endif;

		?>		
	</div><!-- #primary -->

<?php get_footer(); ?>
