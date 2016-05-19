<?php

namespace CPWP\Showcase\Enqueue\Styles;

/**
 * Fetch all admin styles to enqueue
 */
function admin_style() {
	$styles = glob( implode( DIRECTORY_SEPARATOR, array(
		untrailingslashit( CPWP_SHOWCASE_PATH ),
		'dist',
		'styles',
		'admin',
		'*.css',
	) ) );
	enqueue_styles( $styles );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_style' );

/**
 * Fetch all front-end styles to enqueue
 */
function front_style() {
	$styles = glob( implode( DIRECTORY_SEPARATOR, array(
		untrailingslashit( CPWP_SHOWCASE_PATH ),
		'dist',
		'styles',
		'front',
		'*.css',
	) ) );
	enqueue_styles( $styles );
}
add_action( 'wp_enqueue_styles', __NAMESPACE__ . '\front_style' );

/**
 * Enqueue styles
 * @param  array $styles styles to be enqueued
 */
function enqueue_styles( $styles ) {
	$debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
	$enqueue_styles = array();

	foreach ( $styles as $style ) {
		if ( '.min.css' === substr( $style, -7 ) ) {
			$has_unminified = ( in_array( str_replace( '.min.css', '.css', $style ), $styles, true ) );
			if ( ! $debug || ( $debug && ! $has_unminified ) ) {
				$enqueue_styles[] = $style;
			}
		} else {
			$has_minified = ( in_array( str_replace( '.css', '.min.css', $style ), $styles, true ) );
			if ( $debug || ( ! $debug && ! $has_minified ) ) {
				$enqueue_styles[] = $style;
			}
		}
	}

	foreach ( $enqueue_styles as $src ) {
		$handle = 'cpwp-' . basename( str_replace( array( '.min', '.css' ), '', $src ) );
		$localization = apply_filters( 'cpwp_showcase_style_localization', array(), $handle );
		wp_register_style(
			$handle,
			CPWP_SHOWCASE_URL . str_replace( CPWP_SHOWCASE_PATH, '', $src ),
			apply_filters( 'cpwp_showcase_style_dependencies', array(), $handle ),
			filemtime( $src ),
			'all'
		);

		wp_enqueue_style( $handle );
	}
}
