<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package videonow-pro
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" >

		<?php
		
			if ( have_posts() ) :
				get_template_part( 'template-parts/content', 'search');
			else :
				get_template_part( 'template-parts/content', 'none' );

		?>


		<?php endif; ?>

		</main><!-- #main -->
		<?php

			global $wp_version;

			if ( $wp_version >= 4.1 ) :

				the_posts_pagination( array( 'prev_text' => _x( 'Previous', 'previous post', 'videonow-pro' ) ) );
			
			endif;

		?>		
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
