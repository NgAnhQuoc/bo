<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package videonow-pro
 */

/**
 * Get Post Views.
 */
if ( ! function_exists( 'videonow_pro_get_post_views' ) ) :

function videonow_pro_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '<span class="view-count">0</span> View';
    }
    return '<span class="view-count">' . number_format($count) . '</span> ' . __('Views', 'videonow-pro');
}

endif;

/**
 * Set Post Views.
 */
if ( ! function_exists( 'videonow_pro_set_post_views' ) ) :

function videonow_pro_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

endif;

/**
 * Home Widgets Title Link
 */
if ( ! function_exists( 'videonow_pro_home_widget_title_link' ) ) :

function videonow_pro_home_widget_title_link( $instance ) {

	if ( $instance['cat'] ) {

		// Get the category archive link.
		$title_link = get_category_link( $instance['cat'] );

	} elseif ( $instance['format'] ) {

		// Get the post format archive link
		$title_link = get_post_format_link( $instance['format'] );

	} elseif ( get_option( 'page_for_posts' ) ) {

		// 'page_for_posts' link
		$title_link = get_permalink( get_option( 'page_for_posts' ) );

	} else {

		// just throw to home
		$title_link = home_url( '/' );

	}

	return $title_link;

}

endif;

/**
 * Search Filter 
 */
if ( ! function_exists( 'videonow_pro_search_filter' ) ) :

function videonow_pro_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','videonow_pro_search_filter');

endif;

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'videonow_pro_custom_excerpt_length' ) ) :

function videonow_pro_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'videonow_pro_custom_excerpt_length', 999 );

endif;

/**
 * Add custom meta box.
 */
if ( ! function_exists( 'videonow_pro_add_custom_meta_box' ) ) :

function videonow_pro_add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Post Options", "videonow_pro_custom_meta_box_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "videonow_pro_add_custom_meta_box");

endif;
/**
 * Displaying fields in a custom meta box.
 */
if ( ! function_exists( 'videonow_pro_custom_meta_box_markup' ) ) :

function videonow_pro_custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
            <label for="is_featured"><?php echo __('Featured this post on homepage', 'videonow-pro'); ?> </label>
            <?php
                $checkbox_value = get_post_meta($object->ID, "is_featured", true);

                if($checkbox_value == "")
                {
                    ?>
                        <input name="is_featured" type="checkbox" value="true">
                    <?php
                }
                else if($checkbox_value == "true")
                {
                    ?>  
                        <input name="is_featured" type="checkbox" value="true" checked>
                    <?php
                }
            ?>
            <br>
            <br>

            <label for="video_length"><?php echo __('Video Length', 'videonow-pro'); ?> <span style="color: #999; font-style: italic;"><?php echo __('(optional)', 'videonow-pro'); ?></span></label>
            <input name="video_length" type="text" value="<?php echo get_post_meta($object->ID, "video_length", true); ?>" placeholder="00:00" style="width: 70px;">

        </div>
    <?php  
}

endif;

/**
 * Storing Meta Data.
 */
if ( ! function_exists( 'videonow_pro_save_custom_meta_box' ) ) :

function videonow_pro_save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_textarea_value = "";
    $meta_box_checkbox_value = "";

    if(isset($_POST["video_length"]))
    {
        $meta_box_text_value = $_POST["video_length"];
    }   
    update_post_meta($post_id, "video_length", $meta_box_text_value);

    if(isset($_POST["is_featured"]))
    {
        $meta_box_checkbox_value = $_POST["is_featured"];
    }   
    update_post_meta($post_id, "is_featured", $meta_box_checkbox_value);
}

add_action("save_post", "videonow_pro_save_custom_meta_box", 10, 3);

endif;

/**
 * Enqueues scripts and styles.
 */
if ( ! function_exists( 'videonow_pro_disable_specified_widgets' ) ) :

function videonow_pro_disable_specified_widgets( $sidebars_widgets ) {

    if ( isset($sidebars_widgets['homepage']) ) {
        if ( is_home() && is_array($sidebars_widgets['homepage']) ) {
            foreach($sidebars_widgets['homepage'] as $i => $widget) {
                if( (strpos($widget, 'happythemes-') === false) ) {
                    unset($sidebars_widgets['homepage'][$i]);
                }
            }

        }
    }

    if ( isset($sidebars_widgets['footer-1']) ) {
        if ( is_array($sidebars_widgets['footer-1']) ) {
            foreach($sidebars_widgets['footer-1'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-1'][$i]);
                }
            }
        } 
    }

    if ( isset($sidebars_widgets['footer-2']) ) {
        if ( is_array($sidebars_widgets['footer-2']) ) {
            foreach($sidebars_widgets['footer-2'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-2'][$i]);
                }
            }

        }   
    }

    if ( isset($sidebars_widgets['footer-3']) ) {

        if ( is_array($sidebars_widgets['footer-3']) ) {
            foreach($sidebars_widgets['footer-3'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-3'][$i]);
                }
            }

        }   
    }

    if ( isset($sidebars_widgets['footer-4']) ) {
        if ( is_array($sidebars_widgets['footer-4']) ) {
            foreach($sidebars_widgets['footer-4'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['footer-4'][$i]);
                }
            }

        }   
    }

    if ( isset($sidebars_widgets['sidebar-1']) ) {
        if ( is_array($sidebars_widgets['sidebar-1']) ) {
            foreach($sidebars_widgets['sidebar-1'] as $i => $widget) {
                if(strpos($widget, 'happythemes-home-') !== false) {
                    unset($sidebars_widgets['sidebar-1'][$i]);
                }
            }
        }                    
    }                 

    return $sidebars_widgets;
}
add_filter( 'sidebars_widgets', 'videonow_pro_disable_specified_widgets' );

endif;

/** 
 * Create a new page on theme activation.
 */
if ( ! function_exists( 'videonow_pro_create_initial_pages' ) ) :

function videonow_pro_create_initial_pages() {
        $new_page_title = __('All Categories', 'videonow-pro');
        $new_page_content = __('Browse our latest videos by category', 'videonow-pro');
        $new_page_template = 'page-templates/all-categories.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
        //don't change the code bellow, unless you know what you're doing
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
} 
if (isset($_GET['activated']) && is_admin()) {
    add_action('init', 'videonow_pro_create_initial_pages');
}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'videonow_pro_categorized_blog' ) ) :

function videonow_pro_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'videonow_pro_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'videonow_pro_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so videonow_pro_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so videonow_pro_categorized_blog should return false.
        return false;
    }
}

endif;

/**
 * Flush out the transients used in videonow_pro_categorized_blog.
 */
if ( ! function_exists( 'videonow_pro_category_transient_flusher' ) ) :

function videonow_pro_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'videonow_pro_categories' );
}
add_action( 'edit_category', 'videonow_pro_category_transient_flusher' );
add_action( 'save_post',     'videonow_pro_category_transient_flusher' );

endif;

/**
 * Detect if post content has video embed.
 */
if ( ! function_exists( 'videonow_pro_has_embed' ) ) :

function videonow_pro_has_embed( $post_id = false ) {
    if( !$post_id )
        $post_id = get_the_ID();
    else
        $post_id = absint( $post_id );
    if( !$post_id )
        return false;
 
    $post_meta = get_post_custom_keys( $post_id );
 
    foreach( $post_meta as $meta ) {
        if( '_oembed' != substr( trim( $meta ) , 0 , 7 ) )
            continue;
        return true;
    }
    return false;
}

endif;
