<?php

namespace com\mrdink\device_mockups\app\controllers;

use com\mrdink\device_mockups\app\controllers\AppController;

class DeviceMockups extends AppController {

    public $viewVariables = array();
    
    public $deviceMockupGallery;

    public function init() {
        add_shortcode('device', array($this, 'deviceWrapper'));
        add_shortcode('browser', array($this, 'browserWrapper'));
        add_action('admin_head', array($this, 'tinymceButton'));
        add_action('admin_head', array($this, 'tinymceIcon'));
        add_filter('plugin_action_links_' . $this->getPluginName(), array($this, 'docsLink'));

        $this->deviceMockupGallery = new DeviceMockupsGallery();
    }

    /**
     * Devices
     */
    public function deviceWrapper($atts, $content = null) {
        $viewVars = array(
            'type' => '',
            'orientation' => '',
            'color' => '',
            'stacked' => '',
            'position' => '',
            'link' => '',
            'width' => '',
            'hide' => '');
        $this->setFromAttributes($viewVars, $atts);
        return $this->loadViewContents('device_wrapper');
    }

    /**
     * Browsers
     */
    public function browserWrapper($atts, $content = null) {
        $viewVars = array(
            'type' => 'chrome',
            'link' => '',
            'width' => '');
        $this->setFromAttributes($viewVars, $atts);
        return $this->loadViewContents('browser_wrapper');
    }

    /**
     * TinyMCE Button
     */
    public function tinymceButton() {
        global $typenow;
        // check user permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }
        // verify the post type
        if (!in_array($typenow, array('post', 'page'))) {
            return;
        }
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

}
