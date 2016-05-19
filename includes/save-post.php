<?php

namespace CPWP\Showcase\Core\SavePost;

function save_post( $post_id ) {
	// Verify nounce
	if ( ! isset( $_POST['showcase_details_nonce'] ) || ! wp_verify_nonce( $_POST['showcase_details_nonce'], 'cpwp_showcase_details_nonce' ) ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Handle showcase URL
	if ( isset( $_POST['_cpwp_showcase_url'] ) ) {
		update_post_meta( $post_id, '_cpwp_showcase_url' , sanitize_text_field( $_POST['_cpwp_showcase_url'] ) );
	} else {
		delete_post_meta( $post_id,'_cpwp_showcase_url' );
	}

	// Handle showcase thumbnail
	if ( isset( $_POST['_cpwp_showcase_screenshot'] ) ) {
		update_post_meta( $post_id, '_cpwp_showcase_screenshot' , absint( $_POST['_cpwp_showcase_screenshot'] ) );
	} else {
		delete_post_meta( $post_id,'_cpwp_showcase_screenshot' );
	}
}
add_action( 'save_post_cpwp_showcase', __NAMESPACE__ . '\save_post' );
