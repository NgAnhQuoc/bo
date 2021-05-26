<?php
/**
 * Social widget.
 *
 * @package    videonow_pro
 * @author     HappyThemes
 * @copyright  Copyright (c) 2016, HappyThemes
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class videonow_pro_Social_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-videonow_pro-social widget_social_icons',
			'description' => __( 'Display your social media icons.', 'videonow-pro' )
		);

		// Create the widget.
		parent::__construct(
			'videonow_pro-social',                        // $this->id_base
			__( '&raquo; Social Icons', 'videonow-pro' ), // $this->name
			$widget_options                           // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

			// Display the social icons.
			echo '<div class="social-icons"><ul>';
				if ( $instance['facebook'] ) {
					echo '<li class="facebook"><a href="' . esc_url( $instance['facebook'] ) . '">Facebook</a></li>';
				}
				if ( $instance['twitter'] ) {
					echo '<li class="twitter"><a href="' . esc_url( $instance['twitter'] ) . '">Twitter</a></li>';
				}
				if ( $instance['gplus'] ) {
					echo '<li class="google-plus"><a href="' . esc_url( $instance['gplus'] ) . '">Google+</a></li>';

				}
				if ( $instance['pinterest'] ) {
					echo '<li class="pinterest"><a href="' . esc_url( $instance['pinterest'] ) . '">Pinterest</a></li>';
				}
				if ( $instance['youtube'] ) {
					echo '<li class="youtube"><a href="' . esc_url( $instance['youtube'] ) . '">YouTube</a></li>';
				}				
				if ( $instance['linkedin'] ) {
					echo '<li class="linkedin"><a href="' . esc_url( $instance['linkedin'] ) . '">LinkedIn</a></li>';
				}
				if ( $instance['instagram'] ) {
					echo '<li class="instagram"><a href="' . esc_url( $instance['instagram'] ) . '">Instagram</a></li>';
				}
				if ( $instance['tumblr'] ) {
					echo '<li class="tumblr"><a href="' . esc_url( $instance['tumblr'] ) . '">Tumblr</a></li>';
				}
				if ( $instance['rss'] ) {
					echo '<li class="rss"><a href="' . esc_url( $instance['rss'] ) . '">RSS</a></li>';
				}
			echo '</ul></div>';

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['facebook']   = esc_url( $new_instance['facebook'] );
		$instance['twitter']    = esc_url( $new_instance['twitter'] );
		$instance['gplus']      = esc_url( $new_instance['gplus'] );
		$instance['pinterest']  = esc_url( $new_instance['pinterest'] );
		$instance['youtube']      = esc_url( $new_instance['youtube'] );		
		$instance['linkedin']   = esc_url( $new_instance['linkedin'] );
		$instance['instagram']  = esc_url( $new_instance['instagram'] );
		$instance['tumblr']     = esc_url( $new_instance['tumblr'] );
		$instance['rss']        = esc_url( $new_instance['rss'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'      => esc_html__( 'Follow Us', 'videonow-pro' ),
			'facebook'   => '',
			'twitter'    => '',
			'gplus'      => '',
			'pinterest'  => '',
			'youtube'  => '',			
			'linkedin'   => '',
			'instagram'  => '',
			'tumblr'     => '',
			'rss'        => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
				<?php _e( 'Facebook', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
				<?php _e( 'Twitter', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">
				<?php _e( 'Google Plus', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo esc_url( $instance['gplus'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>">
				<?php _e( 'Pinterest', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo esc_url( $instance['pinterest'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">
				<?php _e( 'YouTube', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_url( $instance['youtube'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">
				<?php _e( 'LinkedIn', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_url( $instance['linkedin'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>">
				<?php _e( 'Instagram', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_url( $instance['instagram'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>">
				<?php _e( 'Tumblr', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo esc_url( $instance['tumblr'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>">
				<?php _e( 'RSS Feed', 'videonow-pro' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo esc_url( $instance['rss'] ); ?>" placeholder="<?php echo  esc_attr( 'http://' ); ?>" />
		</p>

	<?php

	}

}
