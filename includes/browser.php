<?php
/**
 * Adds browser wrapper shortcode
 *
 * @param $atts
 * @param null $content
 *
 * @return string
 */
function device_mockups_browser_wrapper( $atts, $content = null ) {
	$specs = shortcode_atts( array(
		'type'   => 'chrome',
		'link'   => '',
		'width'  => '',
		'scroll' => ''
	), $atts );

	$scroll = '';

	if ( $specs['scroll'] == true ) {
		$scroll = ' dm-scroll';
	}

	$width_s = ! empty( $specs['width'] ) ? '<div class="dm-width" style="width:' . esc_attr( $specs['width'] ) . ';">' : '';
	$width_e = ! empty( $specs['width'] ) ? '</div>' : '';

	$anchor_s = ! empty( $specs['link'] ) ? '<a href="' . esc_url( $specs['link'] ) . '">' : '';
	$anchor_e = ! empty( $specs['link'] ) ? '</a>' : '';

	wp_enqueue_style( 'device-mockups-styles' );

	return $width_s . '<div class="dm-browser' . $scroll . '" data-device="' . esc_attr( $specs['type'] ) . '"><div class="device"><div class="screen">' . $anchor_s . do_shortcode( $content ) . $anchor_e . '</div></div></div>' . $width_e;
}

add_shortcode( 'browser', 'device_mockups_browser_wrapper' );
