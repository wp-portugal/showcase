<?php

namespace CPWP\Showcase\Fields\Metafields;

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function showcase_details( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'showcase_details_nonce' );

	$current_url        = get_post_meta( $post->ID, '_cpwp_showcase_url', true );
	$current_screenshot = get_post_meta( $post->ID, '_cpwp_showcase_screenshot', true );

	?>
	<p>
		<label for="_cpwp_showcase_url"><?php esc_html_e( 'URL', 'cpwp_showcase' ); ?></label><br>
		<input type="url" name="_cpwp_showcase_url" value="<?php echo esc_attr( $current_url ); ?>">
	</p>

	<p>
		<label for="_cpwp_showcase_screenshot"><?php esc_html_e( 'Screenshot', 'cpwp_showcase' ); ?></label><br>
		<input type="text" name="_cpwp_showcase_screenshot" id="_cpwp_showcase_screenshot" value="<?php echo ! empty( $current_screenshot ) ? esc_attr( $current_screenshot[0] ) : ''; ?>" />
		<input type="button" id="_cpwp_showcase_screenshot_button" class="button" value="<?php esc_html_e( 'Choose or Upload an Image', 'cpwp_showcase' )?>" />
	</p>

	<?php
}
