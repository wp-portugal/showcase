<?php

namespace CPWP\Showcase\Filter\Display;

/**
 * Adds Year filter in Showcase Archive page before loop starts.
 */
function display_filters() {

	$cpwp_showcase_taxonomies = get_object_taxonomies( 'cpwp_showcase' );
	$current_taxonomy = get_query_var( 'taxonomy' );
	$current_term = get_query_var( 'term' );

	if ( is_post_type_archive( 'cpwp_showcase' ) || in_array( $current_taxonomy, $cpwp_showcase_taxonomies ) ) {
		?>
		<form id="filter-showcase" class="filter-showcase" method="get">

			<?php do_action( 'cpwp_showcase_filter', $current_term ); ?>
			
			<input type="submit" value="<?php esc_html_e( 'Filter', 'cpwp_showcase' ); ?>" />

		</form>
		<?php
	}

}
add_action( 'loop_start', __NAMESPACE__ . '\display_filters' );
