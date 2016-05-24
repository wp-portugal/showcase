<?php

namespace CPWP\Showcase\Filter\Display;

/**
 * Adds Year filter in Showcase Archive page before loop starts.
 *
 * @param  query $query Current WP_Query object.
 */
function display_filters( $query ) {

	$cpwp_showcase_taxonomies = get_object_taxonomies( 'cpwp_showcase' );
	$current_taxonomy = get_query_var( 'taxonomy' );

	if ( $query->is_main_query() && ( is_post_type_archive( 'cpwp_showcase' ) || in_array( $current_taxonomy, $cpwp_showcase_taxonomies, true ) ) ) {
		?>
		<form id="filter-showcase" class="filter-showcase" method="get">

			<?php do_action( 'cpwp_showcase_filter' ); ?>

			<input type="submit" value="<?php esc_html_e( 'Filter', 'cpwp_showcase' ); ?>" />

		</form>
		<?php
	}

}
add_action( 'loop_start', __NAMESPACE__ . '\display_filters' );
