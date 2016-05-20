<?php

namespace CPWP\Showcase\Filter\Year;

/**
 * Adds Year filter in Showcase Archive page before loop starts.
 */
function add_filter( $current_term ) {

	?>
	<span><?php esc_html_e( 'Posts by Year','cpwp_showcase' ); ?><span>
	<?php
	$args = array(
		'show_option_all'    => '',
		'show_option_none'   => esc_html__( 'All Years', 'cpwp_showcase' ),
		'option_none_value'  => '',
		'orderby'            => 'ID',
		'order'              => 'ASC',
		'show_count'         => 0,
		'hide_empty'         => 1,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 1,
		'selected'           => $current_term,
		'hierarchical'       => 0,
		'name'               => 'cpwp_year',
		'id'                 => '',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'cpwp_year',
		'hide_if_empty'      => false,
		'value_field'	     => 'slug',
	);

	wp_dropdown_categories( $args );

}
add_action( 'cpwp_showcase_filter', __NAMESPACE__ . '\add_filter' );
