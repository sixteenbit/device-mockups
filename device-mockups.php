<?php
/*
Plugin Name: Device Mockups
Plugin URI: https://wordpress.org/plugins/device-mockups/
Description: Shortcodes for device mockups.
Author: Justin Peacock
Version: 1.1.8
Author URI: http://byjust.in
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function DM_add_stylesheet() {
	wp_register_style( 'DM-style', plugins_url('assets/css/dm-style.min.css', __FILE__), false, '1.1.8' );
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
			'link' => '',
			'width' => ''
		), $atts )
	);

	// Code
	ob_start();

	if (esc_attr($stacked) == 'open') { echo '<div class="stacked">';	}

		if ( !empty( $width ) ) { echo '<div style="max-width:'. $width .'">';	} ?>

		<div class="<?php
			if ( !empty( $position ) ) {
				echo 'stacked-'. esc_attr( $position ) .''; }
			if ( !empty( $type ) ) {
				echo ' '. esc_attr( $type ) .''; }
			if ( !empty( $orientation ) ) {
				echo ' '. esc_attr( $orientation ) .''; } ?>">

			<div class="device-mockup" <?php
				if ( !empty( $type ) ) {
					echo 'data-device="'. esc_attr( $type ) .'"'; }
				if ( !empty( $orientation ) ) {
					echo ' data-orientation="'. esc_attr( $orientation ) .'"'; }
				if ( !empty( $color ) ) {
					echo ' data-color="'. esc_attr( $color ) .'"'; } ?>>

		<?php
				echo '<div class="device">';
					echo '<div class="screen">';
						if ( !empty($link) ) { echo '<a href="' . esc_attr($link) . '">'; }
							echo '' . do_shortcode($content) . '';
						if ( !empty($link) ) { echo '</a>'; }
					echo '</div>';
					echo '<div class="home-button"></div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		if ( !empty( $width ) ) { echo '</div>';	}

	if (esc_attr($width) == 'closed') { echo '</div">';	}

	return ob_get_clean();
}
add_action( 'wp_enqueue_scripts', 'DM_add_stylesheet' );

add_shortcode( 'device', 'device_wrapper' );

//
// TinyMCE Button
//
add_action('admin_head', 'DM_tinymce_button');

function DM_tinymce_button() {
		global $typenow;
		// check user permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
		}
		// verify the post type
		if( ! in_array( $typenow, array( 'post', 'page' ) ) )
				return;
	// check if WYSIWYG is enabled
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "DM_add_tinymce_plugin");
		add_filter('mce_buttons', 'DM_register_my_tc_button');
	}
}

function DM_add_tinymce_plugin($plugin_array) {
		$plugin_array['DM_tc_button'] = plugins_url( '/assets/js/editor.min.js', __FILE__ );
		return $plugin_array;
}

function DM_register_my_tc_button($buttons) {
	 array_push($buttons, "DM_tc_button");
	 return $buttons;
}

//
// Dashicons
//
function DM_tinymce_icon() { ?>
	<style type="text/css" media="screen">
		i.mce-i-icon {
			font: 400 20px/1 dashicons;
			padding: 0;
			vertical-align: top;
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			margin-left: -2px;
			padding-right: 2px
		}
	</style>
<?php

}
add_action( 'admin_head', 'DM_tinymce_icon' );
