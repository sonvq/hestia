<?php

/*
	WPB Advanced FAQ
	By WPBean
	
*/


/**
 * Register FAQ post type
 */


if ( ! function_exists('wpb_af_post_type') ) {

function wpb_af_post_type() {

	$labels = array(
		'name'                => _x( 'FAQ\'s', 'Post Type General Name', 'wpb-advanced-faq' ),
		'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'wpb-advanced-faq' ),
		'menu_name'           => __( 'FAQ', 'wpb-advanced-faq' ),
		'name_admin_bar'      => __( 'FAQ', 'wpb-advanced-faq' ),
		'parent_item_colon'   => __( 'Parent FAQ:', 'wpb-advanced-faq' ),
		'all_items'           => __( 'All FAQ\'s', 'wpb-advanced-faq' ),
		'add_new_item'        => __( 'Add New FAQ', 'wpb-advanced-faq' ),
		'add_new'             => __( 'Add New', 'wpb-advanced-faq' ),
		'new_item'            => __( 'New FAQ', 'wpb-advanced-faq' ),
		'edit_item'           => __( 'Edit FAQ', 'wpb-advanced-faq' ),
		'update_item'         => __( 'Update FAQ', 'wpb-advanced-faq' ),
		'view_item'           => __( 'View FAQ', 'wpb-advanced-faq' ),
		'search_items'        => __( 'Search FAQ', 'wpb-advanced-faq' ),
		'not_found'           => __( 'Not found', 'wpb-advanced-faq' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'wpb-advanced-faq' ),
	);
	$rewrite = array(
		'slug'                => 'faq',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'FAQ', 'wpb-advanced-faq' ),
		'description'         => __( 'WPB Advanced FAQ', 'wpb-advanced-faq' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'page-attributes', ),
		'taxonomies'          => array( 'wpb_af_faq_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 80,
		'menu_icon'           => 'dashicons-editor-help',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'wpb_af_faq', $args );

}
add_action( 'init', 'wpb_af_post_type', 0 );

}	



/**
 *  Register FAQ category 
 */


if ( ! function_exists( 'wpb_af_faq_category' ) ) {

function wpb_af_faq_category() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'wpb-advanced-faq' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'wpb-advanced-faq' ),
		'menu_name'                  => __( 'Category', 'wpb-advanced-faq' ),
		'all_items'                  => __( 'All Categories', 'wpb-advanced-faq' ),
		'parent_item'                => __( 'Parent Category', 'wpb-advanced-faq' ),
		'parent_item_colon'          => __( 'Parent Category:', 'wpb-advanced-faq' ),
		'new_item_name'              => __( 'New Category Name', 'wpb-advanced-faq' ),
		'add_new_item'               => __( 'Add New Category', 'wpb-advanced-faq' ),
		'edit_item'                  => __( 'Edit Category', 'wpb-advanced-faq' ),
		'update_item'                => __( 'Update Category', 'wpb-advanced-faq' ),
		'view_item'                  => __( 'View Category', 'wpb-advanced-faq' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'wpb-advanced-faq' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'wpb-advanced-faq' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wpb-advanced-faq' ),
		'popular_items'              => __( 'Popular Categories', 'wpb-advanced-faq' ),
		'search_items'               => __( 'Search Categories', 'wpb-advanced-faq' ),
		'not_found'                  => __( 'Not Found', 'wpb-advanced-faq' ),
	);
	$rewrite = array(
		'slug'                       => 'faq_category',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'wpb_af_faq_category', array( 'wpb_af_faq' ), $args );

}
add_action( 'init', 'wpb_af_faq_category', 0 );

}



/**
 * Register FAQ Tags 
 */


if ( ! function_exists( 'wpb_af_faq_tags' ) ) {

function wpb_af_faq_tags() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'wpb-advanced-faq' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'wpb-advanced-faq' ),
		'menu_name'                  => __( 'Tag', 'wpb-advanced-faq' ),
		'all_items'                  => __( 'All Tags', 'wpb-advanced-faq' ),
		'parent_item'                => __( 'Parent Tag', 'wpb-advanced-faq' ),
		'parent_item_colon'          => __( 'Parent Tag:', 'wpb-advanced-faq' ),
		'new_item_name'              => __( 'New Tag Name', 'wpb-advanced-faq' ),
		'add_new_item'               => __( 'Add New Tag', 'wpb-advanced-faq' ),
		'edit_item'                  => __( 'Edit Tag', 'wpb-advanced-faq' ),
		'update_item'                => __( 'Update Tag', 'wpb-advanced-faq' ),
		'view_item'                  => __( 'View Tag', 'wpb-advanced-faq' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'wpb-advanced-faq' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'wpb-advanced-faq' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wpb-advanced-faq' ),
		'popular_items'              => __( 'Popular Tags', 'wpb-advanced-faq' ),
		'search_items'               => __( 'Search Tags', 'wpb-advanced-faq' ),
		'not_found'                  => __( 'Not Found', 'wpb-advanced-faq' ),
	);
	$rewrite = array(
		'slug'                       => 'faq_tags',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'wpb_af_faq_tags', array( 'wpb_af_faq' ), $args );

}
add_action( 'init', 'wpb_af_faq_tags', 0 );

}