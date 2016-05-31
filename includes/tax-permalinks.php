<?php

namespace CPWP\Showcase\Core\Taxonomy\Permalinks;

/**
 * Adds custom rewrite rules to pretty permalinks.
 */
function add_rewrite_rules() {

	global $wp_rewrite;

	$year_slug = esc_html__( 'year', 'cpwp_showcase' );
	$subject_slug = esc_html__( 'subject', 'cpwp_showcase' );

	$new_rules = array(
		'showcase/('.$year_slug.'|'.$subject_slug.')/(.+?)/('.$year_slug.'|'.$subject_slug.')/(.+?)/?$' => 'index.php?post_type=cpwp_showcase&cpwp_' . $wp_rewrite->preg_index( 1 ) . '=' . $wp_rewrite->preg_index( 2 ) . '&cpwp_' . $wp_rewrite->preg_index( 3 ) . '=' . $wp_rewrite->preg_index( 4 ),
		'showcase/('.$year_slug.'|'.$subject_slug.')/(.+)/?$' => 'index.php?post_type=cpwp_showcase&cpwp_' . $wp_rewrite->preg_index( 1 ) . '=' . $wp_rewrite->preg_index( 2 ),
	);

	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;

}

add_action( 'generate_rewrite_rules', __NAMESPACE__ . '\add_rewrite_rules' );

/**
 * Adds custom rewrite tags
 */
function new_rewrite_tags() {

	add_rewrite_tag( '%year%', '([^&]+)','cpwp_year=' );
	add_rewrite_tag( '%subject%', '([^&]+)','cpwp_subject=' );

}

add_action( 'init', __NAMESPACE__ . '\new_rewrite_tags', 10, 0 );
