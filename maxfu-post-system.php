<?php
/**
 * Plugin Name: Max Post System
 * Plugin URI:
 * Description: A plugin to add custom post types
 * Version: 1.0
 * Author: Max Fu
 * Author URI:
 * License: GPL2
 * Text Domain:       max-post-sys
 * Domain Path:       /languages
 */

/**
 * Defining constants for later use
 */
define( 'ROOT', plugins_url( '', __FILE__ ) );
define( 'STYLES', ROOT . '/css/' );
define( 'SCRIPTS', ROOT . '/js/' );

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function mps_load_textdomain() {
  load_plugin_textdomain( 'max-post-sys', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'init', 'mps_load_textdomain' );

function mps_admin_script_style( $hook ) {
	global $post_type;

	if ( ( 'post.php' == $hook || 'post-new.php' == $hook ) && ( 'slider-items' == $post_type ) ) {
    wp_enqueue_script(
			'jquery-ui-datetimepicker',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js',
			array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-slider' ),
			'1.6.3',
			true
		);

    wp_enqueue_script(
			'mps-script',
			SCRIPTS . 'script.js',
			array( 'jquery', 'jquery-ui-datepicker' , 'jquery-ui-datetimepicker' ),
			'1.1',
			true
		);

    wp_enqueue_style(
			'jquery-ui-calendar',
			STYLES . 'jquery-ui-1.10.4.custom.min.css',
			false,
			'1.10.4',
			'all'
		);

    wp_enqueue_style(
			'jquery-ui-datetimepicker-css',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css',
			false,
			'1.6.3',
			'all'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'mps_admin_script_style' );

function mps_advanced_options_get_meta( $value ) {
  global $post;

  $field = get_post_meta( $post->ID, $value, true );
  if ( ! empty( $field ) ) {
    return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
  } else {
    return false;
  }
}

// Register Custom Post Type
function mps_slider_items() {
  $labels = array(
    'name'                  => _x( 'Slider Items', 'Post Type General Name', 'max-post-sys' ),
    'singular_name'         => _x( 'Slider Item', 'Post Type Singular Name', 'max-post-sys' ),
    'menu_name'             => __( 'Slider Items', 'max-post-sys' ),
    'name_admin_bar'        => __( 'Slider Items', 'max-post-sys' ),
    'archives'              => __( 'Item Archives', 'max-post-sys' ),
    'attributes'            => __( 'Item Attributes', 'max-post-sys' ),
    'parent_item_colon'     => __( 'Parent Item:', 'max-post-sys' ),
    'all_items'             => __( 'All Items', 'max-post-sys' ),
    'add_new_item'          => __( 'Add New Item', 'max-post-sys' ),
    'add_new'               => __( 'Add New', 'max-post-sys' ),
    'new_item'              => __( 'New Item', 'max-post-sys' ),
    'edit_item'             => __( 'Edit Item', 'max-post-sys' ),
    'update_item'           => __( 'Update Item', 'max-post-sys' ),
    'view_item'             => __( 'View Item', 'max-post-sys' ),
    'view_items'            => __( 'View Items', 'max-post-sys' ),
    'search_items'          => __( 'Search Item', 'max-post-sys' ),
    'not_found'             => __( 'Not found', 'max-post-sys' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'max-post-sys' ),
    'featured_image'        => __( 'Featured Image', 'max-post-sys' ),
    'set_featured_image'    => __( 'Set featured image', 'max-post-sys' ),
    'remove_featured_image' => __( 'Remove featured image', 'max-post-sys' ),
    'use_featured_image'    => __( 'Use as featured image', 'max-post-sys' ),
    'insert_into_item'      => __( 'Insert into item', 'max-post-sys' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'max-post-sys' ),
    'items_list'            => __( 'Items list', 'max-post-sys' ),
    'items_list_navigation' => __( 'Items list navigation', 'max-post-sys' ),
    'filter_items_list'     => __( 'Filter items list', 'max-post-sys' ),
  );
  $args = array(
    'label'                 => __( 'Slider Item', 'max-post-sys' ),
    'description'           => __( 'Header Slider Items', 'max-post-sys' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'thumbnail' ),
    'taxonomies'            => array( 'category' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'slider-items', $args );
}
add_action( 'init', 'mps_slider_items', 0 );

function mps_slider_items_add_meta_box() {
  add_meta_box(
    'advanced_options-advanced-options',
    __( 'Advanced Options', 'advanced_options' ),
    'mps_advanced_options_html',
    'slider-items',
    'normal',
    'default'
  );
}
add_action( 'add_meta_boxes', 'mps_slider_items_add_meta_box' );

function mps_survey_items() {
  $labels = array(
    'name'                  => _x( 'Survey Items', 'Post Type General Name', 'max-post-sys' ),
    'singular_name'         => _x( 'Survey Item', 'Post Type Singular Name', 'max-post-sys' ),
    'menu_name'             => __( 'Survey Items', 'max-post-sys' ),
    'name_admin_bar'        => __( 'Survey Items', 'max-post-sys' ),
    'archives'              => __( 'Item Archives', 'max-post-sys' ),
    'attributes'            => __( 'Item Attributes', 'max-post-sys' ),
    'parent_item_colon'     => __( 'Parent Item:', 'max-post-sys' ),
    'all_items'             => __( 'All Items', 'max-post-sys' ),
    'add_new_item'          => __( 'Add New Item', 'max-post-sys' ),
    'add_new'               => __( 'Add New', 'max-post-sys' ),
    'new_item'              => __( 'New Item', 'max-post-sys' ),
    'edit_item'             => __( 'Edit Item', 'max-post-sys' ),
    'update_item'           => __( 'Update Item', 'max-post-sys' ),
    'view_item'             => __( 'View Item', 'max-post-sys' ),
    'view_items'            => __( 'View Items', 'max-post-sys' ),
    'search_items'          => __( 'Search Item', 'max-post-sys' ),
    'not_found'             => __( 'Not found', 'max-post-sys' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'max-post-sys' ),
    'featured_image'        => __( 'Featured Image', 'max-post-sys' ),
    'set_featured_image'    => __( 'Set featured image', 'max-post-sys' ),
    'remove_featured_image' => __( 'Remove featured image', 'max-post-sys' ),
    'use_featured_image'    => __( 'Use as featured image', 'max-post-sys' ),
    'insert_into_item'      => __( 'Insert into item', 'max-post-sys' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'max-post-sys' ),
    'items_list'            => __( 'Items list', 'max-post-sys' ),
    'items_list_navigation' => __( 'Items list navigation', 'max-post-sys' ),
    'filter_items_list'     => __( 'Filter items list', 'max-post-sys' ),
  );
  $args = array(
    'label'                 => __( 'Survey Item', 'max-post-sys' ),
    'description'           => __( 'Header Survey Items', 'max-post-sys' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'thumbnail' ),
    'taxonomies'            => array( 'category' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'survey-items', $args );
}
add_action( 'init', 'mps_survey_items', 0 );

function mps_survey_items_add_meta_box() {
  add_meta_box(
    'advanced_options-advanced-options',
    __( 'Advanced Options', 'advanced_options' ),
    'mps_advanced_options_html',
    'survey-items',
    'normal',
    'default'
  );
}
add_action( 'add_meta_boxes', 'mps_survey_items_add_meta_box' );

 function mps_advanced_options_html( $post) {
   wp_nonce_field( '_advanced_options_nonce', 'advanced_options_nonce' ); ?>

   <p>
     <label for="advanced_options_destination_link"><?php _e( 'Destination Link', 'advanced_options' ); ?></label><br>
     <input type="text" name="advanced_options_destination_link" id="advanced_options_destination_link" value="<?php echo mps_advanced_options_get_meta( 'advanced_options_destination_link' ); ?>">
   </p>
   <p>
     <label for="advanced_options_event_date"><?php _e( 'Event Date', 'advanced_options' ); ?></label><br>
     <input type="date" name="advanced_options_event_date" id="advanced_options_event_date" value="<?php echo mps_advanced_options_get_meta( 'advanced_options_event_date' ); ?>">
   </p><?php
 }

 function mps_advanced_options_save( $post_id ) {
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
   if ( ! isset( $_POST['advanced_options_nonce'] ) || ! wp_verify_nonce( $_POST['advanced_options_nonce'], '_advanced_options_nonce' ) ) return;
   if ( ! current_user_can( 'edit_post', $post_id ) ) return;

   if ( isset( $_POST['advanced_options_destination_link'] ) )
     update_post_meta( $post_id, 'advanced_options_destination_link', esc_attr( $_POST['advanced_options_destination_link'] ) );
   if ( isset( $_POST['advanced_options_event_date'] ) )
     update_post_meta( $post_id, 'advanced_options_event_date', esc_attr( $_POST['advanced_options_event_date'] ) );
 }
 add_action( 'save_post', 'mps_advanced_options_save' );

 /*
   Usage: mps_advanced_options_get_meta( 'advanced_options_destination_link' )
   Usage: mps_advanced_options_get_meta( 'advanced_options_event_date' )
 */
