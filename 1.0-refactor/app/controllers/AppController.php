<?php

namespace com\mrdink\device_mockups\app\controllers;

/**
 * Some general purpos methods used by any controllers.
 */
class AppController {

    /**
     * A wrapper for wordpress plugin_basename.
     * @return string Gets the basename of a plugin.
     */
    public function getPluginName() {
        return plugin_basename(__FILE__);
    }

    /**
     * Gets the plugin directory path.
     * @return stirng the path
     */
    public function pluginPath() {
        return untrailingslashit(plugin_dir_path(__FILE__));
    }

    /**
     * Gets the contents of the view.
     * @param string $view filename without .php
     * @return string view contents.
     */
    public function loadViewContents($view) {
        ob_start();
        $this->loadView($view);
        return ob_get_clean();
    }

    /**
     * Load a selected view. 
     * @param string $view filename without .php
     */
    public function loadView($view) {
        $viewToLoad = $this->pluginPath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR  . 'views' . DIRECTORY_SEPARATOR . $view . '.php';
        if (file_exists($viewToLoad)) {
            extract($this->viewVariables);
            include $viewToLoad;
        }
    }

    /**
     * Merge the attributes from a shortcode with the defaults and set them in
     * the view.
     * @param array $viewVars default values.
     * @param array $atts from the short code.
     */
    public function setFromAttributes($viewVars, $atts) {
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
