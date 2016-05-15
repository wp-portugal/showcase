<?php
/*
 * Plugin Name: Showcase
 * Description: Website showcase
 * Version: 0.1
 * Author: Comunidade Portuguesa de WordPress, Marco Pereirinha,
 * Author URI: http://wp-portugal.com
 * Text Domain: cpwp_showcase
 * Domain Path: /languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 */

namespace CPWP\Showcase\Core\Init;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Register plugin textdomain
function load_textdomain() {
	load_plugin_textdomain( 'cpwp_showcase', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'admin_init', __NAMESPACE__ . '\load_textdomain' );

function boot() {
	$boot_sequence = [
		'includes/*.php',
	];

	foreach ( $boot_sequence as $path ) {
		$includes = glob( trailingslashit( plugin_dir_path( __FILE__ ) ) . $path );

		foreach ( $includes as $entry ) {
			include_once( $entry );
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\boot', 0 );
