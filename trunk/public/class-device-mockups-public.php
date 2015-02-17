<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://byjust.in
 * @since      1.0.0
 *
 * @package    Device_Mockups
 * @subpackage Device_Mockups/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Device_Mockups
 * @subpackage Device_Mockups/public
 * @author     Justin Peacock <contact@byjust.in>
 */
class Device_Mockups_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $device_mockups    The ID of this plugin.
	 */
	private $device_mockups;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $device_mockups       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $device_mockups, $version ) {

		$this->device_mockups = $device_mockups;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Device_Mockups_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Device_Mockups_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->device_mockups, plugin_dir_url( __FILE__ ) . 'css/device-mockups-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Device_Mockups_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Device_Mockups_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->device_mockups, plugin_dir_url( __FILE__ ) . 'js/device-mockups-public.js', array( 'jquery' ), $this->version, false );

	}

}
