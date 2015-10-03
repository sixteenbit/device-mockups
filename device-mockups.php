<?php
/**
 * Plugin Name: Device Mockups
 * Plugin URI:  https://wordpress.org/plugins/device-mockups/
 * Description: Show your work in high resolution, responsive device mockups using only shortcodes.
 * Version:     1.5.0
 * Author: Justin Peacock
 * Author URI: https://byjust.in/
 * License:     GPLv2+
 * Text Domain: device_mockups
 */

/**
 * Copyright (c) 2015 Sixteenbit LLC (email : wp@sixteenbit.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Useful global constants
define( 'DEVICE_MOCKUPS_VERSION', '1.5.0' );
define( 'DEVICE_MOCKUPS_URL', plugin_dir_url( __FILE__ ) );
define( 'DEVICE_MOCKUPS_PATH', dirname( __FILE__ ) . '/' );
define( 'DEVICE_MOCKUPS_INC', DEVICE_MOCKUPS_PATH . 'inc/' );

require_once DEVICE_MOCKUPS_INC . 'admin/device-mockups-admin.php';

function device_mockups_scripts() {
	wp_enqueue_style( 'device-mockups-styles', DEVICE_MOCKUPS_URL . '/device-mockups.css', array(), DEVICE_MOCKUPS_VERSION, false );
//	wp_enqueue_script( 'script-name', DEVICE_MOCKUPS_URL . '/js/example.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'device_mockups_scripts' );

function device_mockups_docs_link( $links ) {
	$settings_link = '<a href="http://dm.byjust.in" target="_blank">Documentation</a>';
	array_unshift( $links, $settings_link );

	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'device_mockups_docs_link' );

// adds device wrapper shortcode
function device_mockups_device_wrapper( $atts, $content = null ) {
	$specs = shortcode_atts( array(
		'type'        => 'imac',
		'orientation' => '',
		'color'       => '',
		'stacked'     => '',
		'position'    => '',
		'link'        => '',
		'width'       => '',
		'hide'        => ''
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

	return $stacked_s . $hide_s . $width_s . $wrapper_s . '<div class="dm-device" data-device="' . esc_attr( $specs['type'] ) . '" data-orientation="' . esc_attr( $specs['orientation'] ) . '" data-color="' . esc_attr( $specs['color'] ) . '"><div class="device"><div class="screen">' . $anchor_s . do_shortcode( $content ) . $anchor_e . '</div></div></div>' . $wrapper_e . $width_e . $hide_e . $stacked_e;
}

add_shortcode( 'device', 'device_mockups_device_wrapper' );

// adds browser wrapper shortcode
function device_mockups_browser_wrapper( $atts, $content = null ) {
	$specs = shortcode_atts( array(
		'type'  => 'chrome',
		'link'  => '',
		'width' => '',
	), $atts );

	$width_s = ! empty( $specs['width'] ) ? '<div class="dm-width" style="width:' . esc_attr( $specs['width'] ) . ';">' : '';
	$width_e = ! empty( $specs['width'] ) ? '</div>' : '';

	$anchor_s = ! empty( $specs['link'] ) ? '<a href="' . esc_url( $specs['link'] ) . '">' : '';
	$anchor_e = ! empty( $specs['link'] ) ? '</a>' : '';

	return $width_s . '<div class="dm-browser" data-device="' . esc_attr( $specs['type'] ) . '"><div class="device"><div class="screen">' . $anchor_s . do_shortcode( $content ) . $anchor_e . '</div></div></div>' . $width_e;
}

add_shortcode( 'browser', 'device_mockups_browser_wrapper' );


//disables wp texturize on registered shortcodes
function device_mockups_shortcode_exclude( $shortcodes ) {
	$shortcodes[] = 'device';
	$shortcodes[] = 'browser';

	return $shortcodes;
}

add_filter( 'no_texturize_shortcodes', 'device_mockups_shortcode_exclude' );

// remove and re-prioritize wpautop to prevent auto formatting inside shortcodes
// shortcode_unautop is a core function

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop', 99 );
add_filter( 'the_content', 'shortcode_unautop', 100 );