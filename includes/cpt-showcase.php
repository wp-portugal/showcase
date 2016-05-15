<?php

namespace CPWP\Showcase\Core\CustomPostType;

/**
 * Register showcase CPT
 */
function custom_post_type() {
	$labels = array(
		'name'                  => _x( 'Showcase', 'Post Type General Name', 'cpwp_showcase' ),
		'singular_name'         => _x( 'Website', 'Post Type Singular Name', 'cpwp_showcase' ),
		'menu_name'             => __( 'Showcase', 'cpwp_showcase' ),
		'name_admin_bar'        => __( 'Showcase', 'cpwp_showcase' ),
		'archives'              => __( 'Item Archives', 'cpwp_showcase' ),
		'all_items'             => __( 'All Items', 'cpwp_showcase' ),
		'add_new_item'          => __( 'Add New Item', 'cpwp_showcase' ),
		'add_new'               => __( 'Add New', 'cpwp_showcase' ),
		'new_item'              => __( 'New Item', 'cpwp_showcase' ),
		'edit_item'             => __( 'Edit Item', 'cpwp_showcase' ),
		'update_item'           => __( 'Update Item', 'cpwp_showcase' ),
		'view_item'             => __( 'View Item', 'cpwp_showcase' ),
		'search_items'          => __( 'Search Item', 'cpwp_showcase' ),
		'not_found'             => __( 'Not found', 'cpwp_showcase' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cpwp_showcase' ),
		'featured_image'        => __( 'Featured Image', 'cpwp_showcase' ),
		'set_featured_image'    => __( 'Set featured image', 'cpwp_showcase' ),
		'remove_featured_image' => __( 'Remove featured image', 'cpwp_showcase' ),
		'use_featured_image'    => __( 'Use as featured image', 'cpwp_showcase' ),
		'insert_into_item'      => __( 'Insert into item', 'cpwp_showcase' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'cpwp_showcase' ),
		'items_list'            => __( 'Items list', 'cpwp_showcase' ),
		'items_list_navigation' => __( 'Items list navigation', 'cpwp_showcase' ),
		'filter_items_list'     => __( 'Filter items list', 'cpwp_showcase' ),
	);

	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'revisions',
	);

	$taxonomies = array(
		'cpwp_year'
	);

	$args = array(
		'label'                 => __( 'Website', 'cpwp_showcase' ),
		'description'           => __( 'Website Showcase', 'cpwp_showcase' ),
		'labels'                => $labels,
		'supports'              => $supports,
		'taxonomies'            => $taxonomies,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-view-site',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'slug',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'cpwp_showcase', $args );
}

add_action( 'init', __NAMESPACE__ . '\custom_post_type' );
