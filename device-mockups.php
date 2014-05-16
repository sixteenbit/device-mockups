<?php
/*
Plugin Name: Device Mockups
Plugin URI: https://wordpress.org/plugins/device-mockups/
Description: Shortcodes for device mockups.
Author: Justin Peacock
Version: 1.0.1
Author URI: http://byjust.in
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function DM_add_stylesheet() {
	wp_register_style( 'DM-style', plugins_url('assets/css/dm-style.css', __FILE__) );
	wp_enqueue_style( 'DM-style' );
}

// Devices
function device_wrapper( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'type' => '',
			'orientation' => '',
			'color' => '',
			'stacked' => '',
			'position' => '',
			'link' => ''
		), $atts )
	);

	// Code
	ob_start();
	if (esc_attr($stacked) == 'open') {
		echo '<div class="stacked">';
	}
	echo '<div class="stacked-' . esc_attr($position) . ' ' . esc_attr($type) . ' ' . esc_attr($orientation) . '">';
		echo '<div class="device-mockup" data-device="' . esc_attr($type) . '" data-orientation="' . esc_attr($orientation) . '" data-color="' . esc_attr($color) . '">';
			echo '<div class="device">';
				echo '<div class="screen">';
					echo '' . do_shortcode($content) . '';
				echo '</div>';
				if ( esc_attr($link ) ) { echo '<a href="' . esc_attr($link) . '" class="home-button"></a>'; }
			echo '</div>';
		echo '</div>';
	echo '</div>';
	if (esc_attr($stacked) == 'closed') {
		echo '</div">';
	}

	return ob_get_clean();
}
add_action( 'wp_enqueue_scripts', 'DM_add_stylesheet' );

add_shortcode( 'device', 'device_wrapper' );