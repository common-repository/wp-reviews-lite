<?php
/*
*  Add custom post types and custom taxonomies here.
*/

// disable direct access 
if ( ! defined( 'WPINC' ) ) die(';)');

// Reviews CPT

function wprl_review_post_type() {
  $labels = array(
    'name'                => __( 'Reviews', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => __( 'Review', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Reviews', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
    'all_items'           => __( 'All Reviews', 'text_domain' ),
    'view_item'           => __( 'View Review', 'text_domain' ),
    'add_new_item'        => __( 'Add New Review', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'edit_item'           => __( 'Edit Review', 'text_domain' ),
    'update_item'         => __( 'Update Review', 'text_domain' ),
    'search_items'        => __( 'Search Review', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'Reviews', 'text_domain' ),
    'description'         => __( 'This is a custom post type for reviews.', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 6,
    'menu_icon'           => 'dashicons-star-half',
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'review', $args );
}
add_action( 'init', 'wprl_review_post_type', 0 );

function wprl_createcustom_tax() {
  register_taxonomy(
    'review_category',
    'review',
    array(
      'label' => __( 'Category' ),
      'rewrite' => array( 'slug' => 'review-cat' ),
      'hierarchical' => true,
      'show_ui' => true,
      'show_admin_column' => true,
    )
  );
}
add_action( 'init', 'wprl_createcustom_tax' );