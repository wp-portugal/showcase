<?php

namespace CPWP\Showcase\Enqueue\Scripts;

/**
 * Fetch all front-end scripts to enqueue
 */
function front_script() {
	$scripts = glob( implode( DIRECTORY_SEPARATOR, array(
				untrailingslashit( CPWP_SHOWCASE_PATH ),
				'dist',
				'javascript',
				'front',
				'*.js',
	) ) );
	enqueue_scripts( $scripts );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\front_script' );

/**
 * Fetch all admin scripts to enqueue
 */
function admin_script() {
	$scripts = glob( implode( DIRECTORY_SEPARATOR, array(
				untrailingslashit( CPWP_SHOWCASE_PATH ),
				'dist',
				'javascript',
				'admin',
				'*.js',
	) ) );
	enqueue_scripts( $scripts );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_script' );

/**
 * Set admin strings ready for localization on JS
 * @param  array  $strings Already set strings
 * @param  string $handle  Script handle
 * @return array           Merged strings
 */
function admin_localization( $strings, $handle ) {
	if ( 'cpwp-admin' !== $handle ) {
		return $strings;
	}

	return array_merge( $strings, array(
			'name'         => 'cpwp_admin_localization',
			'localization' => array(
				'title'  => __( 'Choose or Upload an Image', 'cpwp_showcase' ),
				'button' => __( 'Use this image', 'cpwp_showcase' ),
			),
		)
	);
}
add_filter( 'cpwp_showcase_script_localization', __NAMESPACE__ . '\admin_localization', 10, 2 );

/**
 * Enqueue scripts
 * @param  array $scripts Scripts to be enqueued
 */
function enqueue_scripts( $scripts ) {
	$debug = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
	$enqueue_scripts = array();

	foreach ( $scripts as $script ) {
		if ( '.min.js' === substr( $script, -7 ) ) {
			$has_unminified = ( in_array( str_replace( '.min.js', '.js', $script ), $scripts, true ) );
			if ( ! $debug || ( $debug && ! $has_unminified ) ) {
				$enqueue_scripts[] = $script;
			}
		} else {
			$has_minified = ( in_array( str_replace( '.js', '.min.js', $script ), $scripts, true ) );
			if ( $debug || ( ! $debug && ! $has_minified ) ) {
				$enqueue_scripts[] = $script;
			}
		}
	}

	foreach ( $enqueue_scripts as $src ) {
		$handle = 'cpwp-' . basename( str_replace( array( '.min', '.js' ), '', $src ) );
		$localization = apply_filters( 'cpwp_showcase_script_localization', array(), $handle );
		wp_register_script(
			$handle,
			CPWP_SHOWCASE_URL . str_replace( CPWP_SHOWCASE_PATH, '', $src ),
			apply_filters( 'cpwp_showcase_script_dependencies', array(), $handle ),
			filemtime( $src ),
			true
		);

		if ( ! empty( $localization ) ) {
			wp_localize_script( $handle, $localization['name'], $localization['localization'] );
		}

		wp_enqueue_script( $handle );
	}
}
