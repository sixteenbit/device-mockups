<?php

/*
  Plugin Name: Device Mockups
  Plugin URI: https://wordpress.org/plugins/device-mockups/
  Description: Show your work in high resolution, responsive device mockups using only shortcodes.
  Author: Justin Peacock
  Version: 1.4.2.1
  Author URI: http://byjust.in
  License: GNU General Public License v2.0
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

class DeviceMockups {

    public $viewVariables = array();

    public function init() {
        add_shortcode('device', array($this, 'deviceWrapper'));
        add_shortcode('browser', array($this, 'browserWrapper'));
        add_action('admin_head', array($this, 'tinymceButton'));
        add_action('admin_head', array($this, 'tinymceIcon'));
        add_filter('plugin_action_links_' . $this->getPluginName(), array($this, 'docsLink'));
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
        $plugin_array['DM_tc_button'] = plugins_url('assets/js/editor.min.js', __FILE__);
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

    
    ////////////////////////////////////////////////////////////////////////////
    // HELPER FUNCTIONS
    ////////////////////////////////////////////////////////////////////////////
    private function getPluginName() {
        return plugin_basename(__FILE__);
    }

    private function pluginPath() {
        return untrailingslashit(plugin_dir_path(__FILE__));
    }

    private function loadViewContents($view) {
        ob_start();
        $this->loadView('browser_wrapper');
        return ob_get_clean();
    }

    private function loadView($view) {
        $viewToLoad = $this->pluginPath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';
        if (file_exists($viewToLoad)) {
            extract($this->viewVariables);
            include $viewToLoad;
        }
    }

    private function setFromAttributes($viewVars, $atts) {
        extract(shortcode_atts($viewVars, $atts));
        foreach ($viewVars as $name => $value) {
            $this->set($name, ${$name});
        }
    }

    /**
     * Add a key value pair to be availabe in the view.
     * @param string $key name of variable in the view
     * @param mixed $value for the variable.
     */
    public function set($key, $value) {
        $this->viewVariables[$key] = $value;
    }

}
