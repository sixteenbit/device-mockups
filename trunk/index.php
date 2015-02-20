<?php
/*
  Plugin Name: Device Mockups
  Plugin URI: https://wordpress.org/plugins/device-mockups/
  Description: Show your work in high resolution, responsive device mockups using only shortcodes.
  Author: Justin Peacock
  Version: 2.0.0-wip
  Author URI: http://byjust.in
  License: GNU General Public License v2.0
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace com\mrdink\device_mockups;

use com\mrdink\device_mockups\controllers\DeviceMockups;

// Auto load classes based on namespace
spl_autoload_register(function ($class) {
    if (strpos($class, __NAMESPACE__) > -1) {
        require_once str_replace([__NAMESPACE__ . '\\', '\\'], ['', '/'], $class) . '.php';
    }
});

$deviceMockups = new DeviceMockups();
$deviceMockups->init();
