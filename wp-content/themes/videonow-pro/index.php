<?php get_header(); ?>

	<?php
	// Display the featured content block if featured post exists
	$args = array(
	'post_type'      => 'post',
	//'orderby'        => 'date',
	//'order'          => 'DESC',
	//'posts_per_page' => 1,
    'meta_query' => array(
        array(
            'key'   => 'is_featured',
            'value' => 'true'
        	)
    	)			
	);

	// The Query
	$the_query = new WP_Query( $args );

	?>

	<?php 
		if( !($the_query->have_posts()) && (get_theme_mod('featured-on', true)) ) {	
	?>

		<div id="featured-content" class="clear">

			<div class="widget sidebar-notice">
				<p><?php echo __('There is no featured posts', 'videonow-pro'); ?></p>
				<p><?php echo __('Please edit any post and tick the <strong>Featured this post on homepage</strong> checkbox from <strong>Post Options</strong>', 'videonow-pro'); ?> (<a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-featured.png" target="_blank"><?php echo __('how to', 'videonow-pro'); ?></a>)</p>
				<div class="home-more">
					<a class="btn" href="<?php echo home_url(); ?>/wp-admin/edit.php"><?php echo __('Okay, I\'m doing now', 'videonow-pro'); ?></a>
				</div>
			</div>
					
		</div><!-- #featured-content -->

	<?php } ?>

	<?php

	if( ($the_query->have_posts()) && (get_theme_mod('featured-on', true)) ) {

	?>

	<div id="featured-content" class="clear">

		<div class="featured-left">
			<?php

			$args = array(
			'post_type'      => 'post',
			//'orderby'        => 'date',
			//'order'          => 'DESC',
			'posts_per_page' => 1,
		    'meta_query' => array(
		        array(
		            'key'   => 'is_featured',
		            'value' => 'true'
		        	)
		    	)			
			);

			// The Query
			$the_query = new WP_Query( $args );

			// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
			?>	
				<?php
					$video_length = get_post_meta($post->ID, 'video_length', true);
				?>
				<div class="hentry">
					<a class="thumbnail-link" href="<?php the_permalink(); ?>">
						<div class="thumbnail-wrap">
							<?php 
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'featured-large-thumb' ); 
								} else { 
									echo '<img src="' . get_template_directory_uri() . '/assets/img/thumbnail-default.png" alt="" />';
		        				} 
	        				?>
							<?php if (!empty($video_length)) { ?>
								<span class="video-length"><?php echo $video_length; ?></span>
							<?php } ?>
						</div>
						<div class="overlay"></div>						
					</a>
					<div class="entry-info">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
						<span class="entry-category">
							<?php
								$category = get_the_category();
								if ($category) {
								  echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'videonow-pro' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
								}
							?>
						</span>
						<span class="entry-views"><?php echo videonow_pro_get_post_views(get_the_ID()); ?></span>
						<span class="entry-date"><?php echo get_the_date(); ?></span>
					</div>	
					</div>	
				</div>
			<?php   
				endwhile;
				wp_reset_postdata();
			?>		
		</div><!-- .featured-left -->

		<div class="featured-right">

			<?php

			$args = array(
			'post_type'      => 'post',
			//'orderby'        => 'date',
			//'order'          => 'ASC',
			'offset'	     =>  '1',
			'posts_per_page' => 3,
		    'meta_query' => array(
		        array(
		            'key'   => 'is_featured',
		            'value' => 'true'
		        	)
		    	)				
			);

			// The Query
			$the_query = new WP_Query( $args );

			// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
			?>	

			<?php
				$video_length = get_post_meta($post->ID, 'video_length', true);
			?>

			<div class="hentry clear">
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
					<span class="entry-category">
						<?php
							$category = get_the_category();
							if ($category) {
							  echo '<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'videonow-pro' ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
							}
						?>							
					</span>
					<span class="entry-views"><?php echo videonow_pro_get_post_views(get_the_ID()); ?></span>
					<span class="entry-date"><?php echo get_the_date(); ?></span>
				</div>			
			</div>
			<?php   
				endwhile;
				wp_reset_postdata();
			?>															
		</div><!-- .featured-right -->

	</div><!-- #featured-content -->

	<?php 
		} 
		wp_reset_postdata();
	?>


	<?php if ( is_active_sidebar( 'homepage' ) ) : ?>

		<?php dynamic_sidebar( 'homepage' ); ?>

		<?php if(get_theme_mod('home-button-on', true)) : ?>

			<div class="home-more">
				<a href="<?php echo get_theme_mod('home-button-url', home_url().'/all-categories'); ?>" class="btn"><?php echo get_theme_mod('home-button-text', __('Explore all categories', 'videonow-pro')); ?></a>
			</div>

		<?php endif; ?>

	<?php else : ?>

		<div class="home-content-notice">
			<p><?php echo __('There is no content on homepage', 'videonow-pro'); ?></p>
			<p><?php echo __('Please put the <strong>Home Posts Block</strong> widget to the <strong>Home Content Area</strong>', 'videonow-pro'); ?> (<a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-home-widgets.png" target="_blank"><?php echo __('how to', 'videonow-pro'); ?></a>)</p>
			<div class="home-more">
				<a class="btn" href="<?php echo home_url(); ?>/wp-admin/widgets.php"><?php echo __('Okay, I\'m doing now', 'videonow-pro'); ?></a>
			</div>
		</div>

	<?php endif; ?>

<?php get_footer(); ?>
