<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://byjust.in
 * @since             1.0.0
 * @package           Device_Mockups
 *
 * @wordpress-plugin
 * Plugin Name:       Device Mockups
 * Plugin URI:        https://wordpress.org/plugins/device-mockups/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress dashboard.
 * Version:           1.0.0
 * Author:            Justin Peacock
 * Author URI:        http://byjust.in
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       device-mockups
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-device-mockups-activator.php
 */
function activate_device_mockups() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-device-mockups-activator.php';
	Device_Mockups_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-device-mockups-deactivator.php
 */
function deactivate_device_mockups() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-device-mockups-deactivator.php';
	Device_Mockups_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_device_mockups' );
register_deactivation_hook( __FILE__, 'deactivate_device_mockups' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-device-mockups.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_device_mockups() {

	$plugin = new Device_Mockups();
	$plugin->run();

}
run_device_mockups();
