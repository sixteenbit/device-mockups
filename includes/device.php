<?php
/**
 * Adds device wrapper shortcode
 *
 * @param $atts
 * @param null $content
 *
 * @return string
 */
function device_mockups_device_wrapper( $atts, $content = null ) {
	$specs = shortcode_atts( array(
		'type'        => 'imac',
		'orientation' => '',
		'color'       => '',
		'stacked'     => '',
		'position'    => '',
		'link'        => '',
		'width'       => '',
		'hide'        => '',
		'scroll'      => ''
	), $atts );

	$stacked_s = $specs['stacked'] == 'open' ? '<div class="dm-stacked">' : '';
	$stacked_e = $specs['stacked'] == 'closed' ? '</div>' : '';

	$hide_s = ! empty( $specs['hide'] ) ? '<div class="dm-hide-' . esc_attr( $specs['hide'] ) . '">' : '';
	$hide_e = ! empty( $specs['hide'] ) ? '</div>' : '';

	$width_s = ! empty( $specs['width'] ) ? '<div class="dm-width" style="width:' . esc_attr( $specs['width'] ) . ';">' : '';
	$width_e = ! empty( $specs['width'] ) ? '</div>' : '';

	$wrapper_s = ! empty( $specs['position'] ) ? '<div class="dm-stacked-' . esc_attr( $specs['position'] ) . ' ' . esc_attr( $specs['type'] ) . ' ">' : '';
	$wrapper_e = ! empty( $specs['position'] ) ? '</div>' : '';

	$anchor_s = ! empty( $specs['link'] ) ? '<a href="' . esc_url( $specs['link'] ) . '">' : '';
	$anchor_e = ! empty( $specs['link'] ) ? '</a>' : '';

	$scroll = '';

	if ( $specs['scroll'] == true ) {
		$scroll = ' dm-scroll';
	}

	wp_enqueue_style( 'device-mockups-styles' );

	return $stacked_s . $hide_s . $width_s . $wrapper_s . '<div class="dm-device' . $scroll . '" data-device="' . esc_attr( $specs['type'] ) . '" data-orientation="' . esc_attr( $specs['orientation'] ) . '" data-color="' . esc_attr( $specs['color'] ) . '"><div class="device"><div class="screen">' . $anchor_s . do_shortcode( $content ) . $anchor_e . '</div></div></div>' . $wrapper_e . $width_e . $hide_e . $stacked_e;
}

add_shortcode( 'device', 'device_mockups_device_wrapper' );
