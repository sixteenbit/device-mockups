<?php

global $wp_version;
define('DM_VERSION', version_compare($wp_version, '3.9', '>='));

if(!defined("PHP_EOL")){define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");}

if (!class_exists("DMGallery")) {
Class DMGallery
{
	var $isrss = false;

	/* html div ids */
	var $noscriptdiv  = 'smg_noscript';

	var $smg_instance = 0;

	function stylemygallery()
	{
		if (!DM_VERSION)
		{
			add_action ('admin_notices',__('Device Mockups requires at least WordPress 3.9','device-mockups'));
			return;
		}

		register_activation_hook( __FILE__, array(&$this, 'activate'));
		register_deactivation_hook( __FILE__, array(&$this, 'deactivate'));
		add_action('init', array(&$this, 'addScripts'));
		add_shortcode('device-mockups', array(&$this, 'gallery_func'));

		// Localization
		load_plugin_textdomain('device-mockups', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}

	function activate()
	{
		/*
		** Nothing needs to be done for now
		*/
	}

	function deactivate()
	{
		/*
		** Nothing needs to be done for now
		*/
	}

	function gallery_func($attr) {
		/*
		** shortcode handler
		*/
		$this->smg_instance ++;

		if ( isset( $attr['style'] ) ) {
			$style = $attr['style'];
		} else {
			$style = 'FlexSlider';
		}

		/* First produce the Javascript for this instance */
		if ($style == 'xxx') {

		} else {
			/* Default FlexSlider */
			$js  = "\n".'<script type="text/javascript">'."\n";
			$js .= 'jQuery(window).load(function() { '."\n";
			$js .= '  jQuery("#smg_' . $this->smg_instance . '").flexslider({';
			if ( isset( $attr['options'] ) ) {
				$js .= $attr['options'];
			}
			$js .= '});'."\n";
			$js .= '});'."\n";
			$js .= "</script>\n\n";
		}

		/* Now produce the gallery html */
		return $js . $this->galleryBuild($attr);
	}

	function galleryBuild($attr) {
		/*
		** Build the gallery of images
		*/
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		/*
		** Standard gallery shortcode defaults that we support here
		*/
		global $post;
		extract(shortcode_atts(array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post->ID,
				'size'       => 'large',	// thumbnail, medium, large or full
				'include'    => '',
				'exclude'    => '',
				'mediatag'	 => '',	// corresponds to Media Tags plugin by Paul Menard
				'css'		 => '',	// css to apply to containing div
				'options'	 => '',	// custom options (applied to JavaScript)
				'style'	 => 'FlexSlider', // Choices: FlexSlider
		  ), $attr));

		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($mediatag) ) {
			$mediaList = get_attachments_by_media_tags("media_tags=$mediatag&orderby=$orderby&order=$order");
			$attachments = array();
			foreach ($mediaList as $key => $val) {
				$attachments[$val->ID] = $mediaList[$key];
			}
		} elseif ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, 'thumbnail', true) . "\n";
			return $output;
		}


		$plugin_url = get_option('siteurl') . "/" . PLUGINDIR . "/" . plugin_basename(dirname(__FILE__));

		/**
		* Start output
		*/
		$noscript = '<noscript><div id="' . $this->noscriptdiv . '_' . $this->smg_instance . '" class="' . $this->noscriptdiv . '">';

		/**
		* Containing boxes
		*/
		if ($style == "xxx") {
		} else {
			$output = '<div id="smg_container_' . $this->smg_instance . '" class="flex-container" ';
		}
		if ( !empty($css) ) $output .= 'style="' . $css . '" ';
		$output .= '>' . PHP_EOL;
		if ($style == 'FlexSlider') $output .= '<div id="smg_' . $this->smg_instance . '" class="flexslider"><ul class="slides">' . PHP_EOL;

		/**
		* Add images
		*/
		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			$image 		= wp_get_attachment_image_src($id, $size);

			if ($style == 'FlexSlider') $output .= '<li>';
			$output .= '<img src="' . $image[0] . '" alt="' . $attachment->post_title . '" ';
			$output .= '/>' . PHP_EOL;
			if (($style == 'FlexSlider') && ($attachment->post_content != '')) {
				$output .= '<p class="flex-caption">' . $attachment->post_content . '</p>' . PHP_EOL;
			}
			if ($style == 'FlexSlider') $output .= '</li>' . PHP_EOL;

			/* build separate thumbnail list for users with scripts disabled */
			$noscript .= '<img src="' . $image[0] . '" width="100px">' . PHP_EOL;
			$i++;
		}


		/**
		* Close containers and append noscript
		*/
		if ($style == 'FlexSlider') $output .= '</ul></div>' . PHP_EOL;

		$noscript .= '</div></noscript>';

		$output .= '</div>' . $noscript . PHP_EOL;

		return $output;
	}

	function addScripts()
	{
		$plugin_url = get_option('siteurl') . "/" . PLUGINDIR . "/" . plugin_basename(dirname(__FILE__));
		if (!is_admin()) {
			wp_enqueue_style( 'smg_flexslidercss', $plugin_url.'/FlexSlider-1.8/flexslider.css');
			wp_enqueue_script('smg_flexslider', $plugin_url.'/FlexSlider-1.8/jquery.flexslider-min.js', array('jquery'));
		}
	}


}

}

if (class_exists("DMGallery")) {
	$stylemygallery = new DMGallery();
}
?>
