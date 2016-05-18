<?php

namespace CPWP\Showcase\Fields\Metaboxes;

/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function metabox_details( $post ) {
	add_meta_box( 'cpwp_showcase', __( 'Details', 'cpwp_showcase' ), 'CPWP\Showcase\Fields\Metafields\showcase_details', 'cpwp_showcase', 'normal', 'high' );
}
add_action( 'add_meta_boxes_cpwp_showcase', __NAMESPACE__ . '\metabox_details' );
