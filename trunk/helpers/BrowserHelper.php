<?php

namespace com\mrdink\device_mockups\helpers;

class BrowserHelper {
	public $attr;

	function getAttr() {
		$output='' ; if (!empty($this->attr['type'])) {
			$output .='data-device="' . esc_attr($this->attr['type']) . '"';
		}
		if (!empty($this->attr['orientation'])) {
			$output .=' data-orientation="' . esc_attr($this->attr['orientation']) . '"';
		}
		if (!empty($this->attr['color'])) {
			$output .=' data-color="' . esc_attr($this->attr['color']) . '"';
		}
		return $output;
	}

}
