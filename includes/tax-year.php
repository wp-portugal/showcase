<?php

namespace CPWP\Showcase\Core\Taxonomy\Year;

/**
 * Register year taxonomy
 */
function taxonomy() {
	$labels = array(
		'name'                       => _x( 'Years', 'Taxonomy General Name', 'cpwp_showcase' ),
		'singular_name'              => _x( 'Year', 'Taxonomy Singular Name', 'cpwp_showcase' ),
		'menu_name'                  => __( 'Years', 'cpwp_showcase' ),
		'all_items'                  => __( 'All Items', 'cpwp_showcase' ),
		'new_item_name'              => __( 'New Item Name', 'cpwp_showcase' ),
		'add_new_item'               => __( 'Add New Item', 'cpwp_showcase' ),
		'edit_item'                  => __( 'Edit Item', 'cpwp_showcase' ),
		'update_item'                => __( 'Update Item', 'cpwp_showcase' ),
		'view_item'                  => __( 'View Item', 'cpwp_showcase' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'cpwp_showcase' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'cpwp_showcase' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'cpwp_showcase' ),
		'popular_items'              => __( 'Popular Items', 'cpwp_showcase' ),
		'search_items'               => __( 'Search Items', 'cpwp_showcase' ),
		'not_found'                  => __( 'Not Found', 'cpwp_showcase' ),
		'no_terms'                   => __( 'No items', 'cpwp_showcase' ),
		'items_list'                 => __( 'Items list', 'cpwp_showcase' ),
		'items_list_navigation'      => __( 'Items list navigation', 'cpwp_showcase' ),
	);

	$rewrite = array(
		'slug'                       => sanitize_title( _x( 'Year', 'Taxonomy slug', 'cpwp_showcase' ) ),
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

	register_taxonomy( 'cpwp_year', array( 'cpwp_showcase' ), $args );
}

add_action( 'init', __NAMESPACE__ . '\taxonomy' );
