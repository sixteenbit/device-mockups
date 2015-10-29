<?php
/**
 * Plugin Name: Device Mockups
 * Plugin URI:  https://wordpress.org/plugins/device-mockups/
 * Description: Show your work in high resolution, responsive device mockups using only shortcodes.
 * Version:     1.5.2
 * Author: Justin Peacock
 * Author URI: https://byjust.in/
 * License:     GPLv2+
 * Text Domain: device_mockups
 * Domain Path: /languages
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
define( 'DEVICE_MOCKUPS_VERSION', '1.5.2' );
define( 'DEVICE_MOCKUPS_URL', plugin_dir_url( __FILE__ ) );
define( 'DEVICE_MOCKUPS_PATH', dirname( __FILE__ ) . '/' );
define( 'DEVICE_MOCKUPS_ADMIN', DEVICE_MOCKUPS_PATH . 'admin/' );
define( 'DEVICE_MOCKUPS_INC', DEVICE_MOCKUPS_PATH . 'includes/' );
define( 'DEVICE_MOCKUPS_DOCS', 'http://devicemockupswp.com/' );

/**
 * Load plugin textdomain.
 */
function device_mockups_load_textdomain() {
	load_plugin_textdomain( 'device_mockups', false, plugin_basename( DEVICE_MOCKUPS_PATH ) . '/languages/' );
}

add_action( 'plugins_loaded', 'device_mockups_load_textdomain' );

/**
 * Register stylesheet to be used within shortcodes.
 */
function device_mockups_register_style() {
	wp_register_style( 'device-mockups-styles', DEVICE_MOCKUPS_URL . 'css/device-mockups.css', array(), DEVICE_MOCKUPS_VERSION, false );
}

add_action( 'wp_enqueue_scripts', 'device_mockups_register_style' );

/**
 * Enqueue script when gallery shortcode is used.
 */
function device_mockups_script() {
	global $post;
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'gallery' ) ) {
		wp_enqueue_script( 'device-mockups-scripts', DEVICE_MOCKUPS_URL . 'js/device-mockups.js', array(), DEVICE_MOCKUPS_VERSION, true );
	}
}

add_action( 'wp_enqueue_scripts', 'device_mockups_script' );

/**
 * Add documentation link
 */
function device_mockups_docs_link( $links ) {
	$settings_link = '<a href="' . esc_url( DEVICE_MOCKUPS_DOCS ) . '" target="_blank">Documentation</a>';
	array_unshift( $links, $settings_link );

	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'device_mockups_docs_link' );

/**
 * Include functions
 */
require_once DEVICE_MOCKUPS_ADMIN . 'device-mockups.php';
require_once DEVICE_MOCKUPS_INC . 'device.php';
require_once DEVICE_MOCKUPS_INC . 'browser.php';

/**
 * Disables wp texturize on registered shortcodes
 */
function device_mockups_shortcode_exclude( $shortcodes ) {
	$shortcodes[] = 'device';
	$shortcodes[] = 'browser';

	return $shortcodes;
}

add_filter( 'no_texturize_shortcodes', 'device_mockups_shortcode_exclude' );

function device_mockups_shortcode_unautop( $pee ) {
	global $shortcode_tags;

	if ( empty( $shortcode_tags ) || ! is_array( $shortcode_tags ) ) {
		return $pee;
	}

	$tagregexp = join( '|', array_map( 'preg_quote', array_keys( $shortcode_tags ) ) );

	$pattern =
		'/'
		. '<p>'                              // Opening paragraph
		. '\\s*+'                            // Optional leading whitespace
		. '('                                // 1: The shortcode
		.     '\\[\\/?'                      // Opening bracket for opening or closing shortcode tag
		.     "($tagregexp)"                 // 2: Shortcode name
		.     '(?![\\w-])'                   // Not followed by word character or hyphen
		// Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
		.     '[\\w\\s="\']*'                // Shortcode attributes
		.     '(?:'
		.         '\\s*+'                    // Optional leading whitespace, supports [footag /]
		.         '\\/\\]'                   // Self closing tag and closing bracket
		.     '|'
		.         '\\]'                      // Closing bracket
		.         '(?:'                      // Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '(?!<\/p>)'            // Not followed by closing paragraph
		.             '[^\\[]*+'             // Not an opening bracket, matches all content between closing bracket and closing shortcode tag
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
		.             '\\[\\/\\2\\]'         // Closing shortcode tag
		.         ')?'
		.     ')'
		. ')'
		. '\\s*+'                            // optional trailing whitespace
		. '<\\/p>'                           // closing paragraph
		. '/s';

	return preg_replace( $pattern, '$1', $pee );
}

foreach ( array( 'device', 'browser' ) as $filter ) {
	remove_filter( $filter, 'shortcode_unautop' );
	add_filter( $filter, 'device_mockups_shortcode_unautop' );
}

remove_filter( 'the_content', 'shortcode_unautop' );
add_filter( 'the_content', 'device_mockups_shortcode_unautop' );
remove_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'device_mockups_shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );