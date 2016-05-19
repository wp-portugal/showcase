<?php

namespace CPWP\Showcase\Fields\Metafields;

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function showcase_details( $post ) {
	wp_nonce_field( 'cpwp_showcase_details_nonce', 'showcase_details_nonce' );

	$current_url        = get_post_meta( $post->ID, '_cpwp_showcase_url', true );
	$current_screenshot = get_post_meta( $post->ID, '_cpwp_showcase_screenshot', true );
	$screenshoot        = null;

	if ( $current_screenshot ) {
		$screenshoot = wp_get_attachment_image_src( $current_screenshot );
		$screenshoot = $screenshoot[0];
	}

	?>
	<div class="cpwp-showcase-url">
		<label for="_cpwp_showcase_url"><?php esc_html_e( 'URL', 'cpwp_showcase' ); ?> <span title="<?php esc_attr_e( 'Required', 'cpwp_showcase' ); ?>" class="required">*</span></label><br>
		<input type="url" name="_cpwp_showcase_url" value="<?php echo esc_attr( $current_url ); ?>" required>
	</div>

	<div class="cpwp-showcase-screenshot">
		<label for="_cpwp_showcase_screenshot"><?php esc_html_e( 'Screenshot', 'cpwp_showcase' ); ?> <span title="<?php esc_attr_e( 'Required', 'cpwp_showcase' ); ?>" class="required">*</span></label><br>
		<div id="cpwp_showcase_screenshot_placeholder" class="cpwp-showcase-screenshot-placeholder" style="background-image: url('<?php echo esc_url( $screenshoot ); ?>')"></div>
		<input type="hidden" name="_cpwp_showcase_screenshot" id="_cpwp_showcase_screenshot" value="<?php echo ! empty( $current_screenshot ) ? esc_attr( $current_screenshot[0] ) : ''; ?>" required>
		<p>
			<input type="button" id="_cpwp_showcase_screenshot_button" class="button" value="<?php esc_html_e( 'Choose or Upload an Image', 'cpwp_showcase' )?>">
		</p>
	</div>

	<?php
}
