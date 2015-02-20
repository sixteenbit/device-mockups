<?php

namespace com\mrdink\device_mockups\controllers;

use com\mrdink\device_mockups\controllers\AppController;
use com\mrdink\device_mockups\helpers\DeviceHelper;

class DeviceMockups extends AppController {

    public $viewVariables = array();

    public $deviceMockupGallery;

    public function init() {
        add_shortcode('device', array($this, 'deviceWrapper'));
        add_shortcode('browser', array($this, 'browserWrapper'));
        add_action('admin_head', array($this, 'tinymceButton'));
        add_action('admin_head', array($this, 'tinymceIcon'));
      	add_action('init', array($this, 'scripts'));
        add_filter('plugin_action_links_' . $this->getPluginName(), array($this, 'docsLink'));
        $this->deviceMockupGallery = new DeviceMockupsGallery();
        $this->deviceMockupGallery->dm_gallery();
    }

    /**
     * Devices
     */
    public function deviceWrapper($atts, $content = null) {
    		$deviceHelper = new DeviceHelper();
        $viewVars = array(
            'type' => '',
            'orientation' => '',
            'color' => '',
            'stacked' => '',
            'position' => '',
            'link' => '',
            'width' => '',
            'hide' => '',
            'content' => $content);
        $this->setFromAttributes($viewVars, $atts);
        $deviceHelper->attr = $this->viewVariables;
        $this->viewVariables['deviceHelper'] = $deviceHelper;
        return $this->loadViewContents('device_wrapper');
    }

    /**
     * Browsers
     */
    public function browserWrapper($atts, $content = null) {
        $viewVars = array(
            'type' => 'chrome',
            'link' => '',
            'width' => '',
            'content' => $content);
        $this->setFromAttributes($viewVars, $atts);
        return $this->loadViewContents('browser_wrapper');
    }

    /**
     * TinyMCE Button
     */
    public function tinymceButton() {

        // check if WYSIWYG is enabled
        if (get_user_option('rich_editing') == 'true') {
            add_filter("mce_external_plugins", array($this, "addTinymcePlugin"));
            add_filter('mce_buttons', array($this, 'registerMyTcButton'));
        }
    }

    public function addTinymcePlugin($plugin_array) {
        $plugin_array['DM_tc_button'] = plugins_url('../assets/js/editor.min.js', __FILE__);
        return $plugin_array;
    }

    public function registerMyTcButton($buttons) {
        array_push($buttons, "DM_tc_button");
        return $buttons;
    }

    public function docsLink($links) {
        $settings_link = $this->loadViewContents('docs_links');
        array_unshift($links, $settings_link);
        return $links;
    }

    /**
     * Dashicons
     */
    public function tinymceIcon() {
        $this->loadView('tinymce_icon');
    }

    function scripts() {
    	if ( !is_admin() ) {
	  		wp_enqueue_style( 'device-mockups-style', plugins_url('../assets/css/device-mockups.css', __FILE__), false, '2.0.0-wip' );
	  		wp_enqueue_script('device-mockups-flexslider', plugins_url( '../assets/js/flexslider.js', __FILE__ ), array('jquery'));
	  	}
    }

}
