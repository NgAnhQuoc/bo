<?php
/**
 * Template Name: All Categories Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" >

			<?php
				while ( have_posts() ) : the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content();

							echo "<div class=\"all-categories\">";

							$categories = get_categories( '' );
							foreach($categories as $category) {

							    echo '<div class="category-bar"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'videonow-pro' ), $category->name ) . '" ' . '>';

							    // Display Category Icon
								if ( (function_exists('z_taxonomy_image_url')) && (z_taxonomy_image_url($category->term_id) != null) ) { 
									 echo '<img class="category-icon" src="'. z_taxonomy_image_url($category->term_id) .'" alt="'. $category->name .'"/>';
								};  

							    echo '<span class="category-name">' . $category->name. '</span><span class="category-desc">' . $category->description . '</span> <span class="video-count"><strong>' . $category->count . '</strong> <em>' . esc_html__( 'posts', 'videonow-pro' ) . '</em></span></a></div> ';
							}
							echo "</div>";

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'videonow-pro' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
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
						</footer><!-- .entry-footer -->
					<?php endif; ?>
				</article><!-- #post-## -->

			<?php
				endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

