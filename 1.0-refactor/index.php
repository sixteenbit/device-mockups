<?php
namespace com\mrdink\device_mockups;

use com\mrdink\device_mockups\app\controllers\DeviceMockups;

// Auto load classes based on namespace
spl_autoload_register(function ($class) {
    if (strpos($class, __NAMESPACE__) > -1) {
        require_once str_replace([__NAMESPACE__ . '\\', '\\'], ['', '/'], $class) . '.php';
    }
});

$deviceMockups = new DeviceMockups();
$deviceMockups->init();
