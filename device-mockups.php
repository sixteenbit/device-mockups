<?php
/*
  Plugin Name: Device Mockups
  Plugin URI: https://github.com/mrdink/device-mockups
  Description: WordPress shortcodes for Pixelsign's HTML5 mockups.
  Author: Justin Peacock
  Version: 1.0
  Author URI: http://byjust.in
  License: GNU General Public License v2.0
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function DM_add_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'DM-style', plugins_url('assets/css/device-mockups.css', __FILE__) );
    wp_enqueue_style( 'DM-style' );
}

// Devices
function device_wrapper( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'device' => '',
			'orientation' => 'portrait',
			'color' => 'black',
		), $atts )
	);

	// Code
	ob_start();

	echo '<div class="device-mockup" data-device="' . esc_attr($device) . '" data-orientation="' . esc_attr($orientation) . '" data-color="' . esc_attr($color) . '">';
	  echo '<div class="device">';
	      echo '<div class="screen">';
	          echo '' . do_shortcode($content) . '';
	      echo '</div>';
	      echo '<div class="btn">';
	          echo '<!-- You can hook the "home button" to some JavaScript events or just remove it -->';
	      echo '</div>';
	  echo '</div>';
	echo '</div>';

	return ob_get_clean();
}
add_shortcode( 'devices', 'device_wrapper' );