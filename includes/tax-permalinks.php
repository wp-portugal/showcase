<?php

namespace CPWP\Showcase\Core\Taxonomy\Permalinks;

/**
 * Adds custom rewrite rules to pretty permalinks.
 */
function add_rewrite_rules() {

	global $wp_rewrite;

	$new_rules = array(
		'showcase/(year|subject)/(.+?)/(year|subject)/(.+?)/?$' => 'index.php?post_type=cpwp_showcase&cpwp_' . $wp_rewrite->preg_index( 1 ) . '=' . $wp_rewrite->preg_index( 2 ) . '&cpwp_' . $wp_rewrite->preg_index( 3 ) . '=' . $wp_rewrite->preg_index( 4 ),
		'showcase/(year|subject)/(.+)/?$' => 'index.php?post_type=cpwp_showcase&cpwp_' . $wp_rewrite->preg_index( 1 ) . '=' . $wp_rewrite->preg_index( 2 ),
	);

	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;

}

add_action( 'generate_rewrite_rules', __NAMESPACE__ . '\add_rewrite_rules' );
