<?php

namespace com\mrdink\device_mockups\app\helpers;

class DeviceHelper {
	public $attr;

	function getClassAttr() {
	    $output = '';
	    if (!empty($this->attr['position'])) {
	        $output .= 'dm-stacked-' . esc_attr($this->attr['position']) . '';
	    }
	    if (!empty($this->attr['type'])) {
	        $output .= ' ' . esc_attr($this->attr['type']) . '';
	    }
	    if (!empty($this->attr['orientation'])) {
	        $output .= ' ' . esc_attr($this->attr['orientation']) . '';
	    }
	    return $output;
	}

	function getAttr() {
	    $output = '';
	    if (!empty($this->attr['type'])) {
	        $output .= 'data-device="' . esc_attr($this->attr['type']) . '"';
	    }
	    if (!empty($this->attr['orientation'])) {
	        $output .= ' data-orientation="' . esc_attr($this->attr['orientation']) . '"';
	    }
	    if (!empty($this->attr['color'])) {
	        $output .= ' data-color="' . esc_attr($this->attr['color']) . '"';
	    }
	    return $output;
	}
}
