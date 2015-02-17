<?php

/**
 * Gallery shortcode
 */
if (!class_exists("DM_Gallery")) {

    Class DM_Gallery {

        var $isrss = false;

        /* html div ids */
        var $noscriptdiv = 'dm_noscript';
        var $dm_instance = 0;

        function dm_gallery() {
            add_action('init', array(&$this, 'dm_scripts'));
            add_shortcode('dm-gallery', array(&$this, 'dm_gallery_func'));
        }

        function dm_gallery_func($attr) {
            /*
             * * shortcode handler
             */
            $this->dm_instance ++;

            if (isset($attr['style'])) {
                $style = $attr['style'];
            } else {
                $style = 'FlexSlider';
            }

            /* First produce the Javascript for this instance */
            if ($style == 'xxx') {
                
            } else {
                /* Default FlexSlider */
                $js = "\n" . '<script type="text/javascript">' . "\n";
                $js .= 'jQuery(window).load(function() { ' . "\n";
                $js .= '  jQuery("#dm_' . $this->dm_instance . '").flexslider({controlNav:false,';
                if (isset($attr['options'])) {
                    $js .= $attr['options'];
                }
                $js .= '});' . "\n";
                $js .= '});' . "\n";
                $js .= "</script>\n\n";
            }

            /* Now produce the gallery html */
            return $js . $this->galleryBuild($attr);
        }

        function galleryBuild($attr) {
            /*
             * * Build the gallery of images
             */
            if (isset($attr['orderby'])) {
                $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
                if (!$attr['orderby']) {
                    unset($attr['orderby']);
                }
            }

            /*
             * * Standard gallery shortcode defaults that we support here
             */
            global $post;
            extract(shortcode_atts(array(
                'order' => 'ASC',
                'orderby' => 'menu_order ID',
                'id' => $post->ID,
                'size' => 'large', // thumbnail, medium, large or full
                'include' => '',
                'exclude' => '',
                'mediatag' => '', // corresponds to Media Tags plugin by Paul Menard
                'css' => '', // css to apply to containing div
                'options' => '', // custom options (applied to JavaScript)
                'style' => 'FlexSlider', // Choices: FlexSlider
                            ), $attr));

            $id = intval($id);
            if ('RAND' == $order) {
                $orderby = 'none';
            }

            if (!empty($mediatag)) {
                $mediaList = get_attachments_by_media_tags("media_tags=$mediatag&orderby=$orderby&order=$order");
                $attachments = array();
                foreach ($mediaList as $key => $val) {
                    $attachments[$val->ID] = $mediaList[$key];
                }
            } elseif (!empty($include)) {
                $include = preg_replace('/[^0-9,]+/', '', $include);
                $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

                $attachments = array();
                foreach ($_attachments as $key => $val) {
                    $attachments[$val->ID] = $_attachments[$key];
                }
            } elseif (!empty($exclude)) {
                $exclude = preg_replace('/[^0-9,]+/', '', $exclude);
                $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
            } else {
                $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
            }

            if (empty($attachments)) {
                return '';
            }

            if (is_feed()) {
                $output = "\n";
                foreach ($attachments as $att_id => $attachment)
                    $output .= wp_get_attachment_link($att_id, 'thumbnail', true) . "\n";
                return $output;
            }

            /**
             * Start output
             */
            $noscript = '<noscript><div id="' . $this->noscriptdiv . '_' . $this->dm_instance . '" class="' . $this->noscriptdiv . '">';

            /**
             * Containing boxes
             */
            if ($style == "xxx") {
                
            } else {
                $output = '<div id="dm_container_' . $this->dm_instance . '" class="flex-container" ';
            }
            if (!empty($css))
                $output .= 'style="' . $css . '" ';
            $output .= '>' . PHP_EOL;
            if ($style == 'FlexSlider')
                $output .= '<div id="dm_' . $this->dm_instance . '" class="flexslider"><ul class="slides">' . PHP_EOL;

            /**
             * Add images
             */
            $i = 0;
            foreach ($attachments as $id => $attachment) {
                $image = wp_get_attachment_image_src($id, $size);

                if ($style == 'FlexSlider')
                    $output .= '<li>';
                $output .= '<img src="' . $image[0] . '" alt="' . $attachment->post_title . '" ';
                $output .= '/>' . PHP_EOL;
                if (($style == 'FlexSlider') && ($attachment->post_content != '')) {
                    $output .= '<p class="flex-caption">' . $attachment->post_content . '</p>' . PHP_EOL;
                }
                if ($style == 'FlexSlider')
                    $output .= '</li>' . PHP_EOL;

                /* build separate thumbnail list for users with scripts disabled */
                $noscript .= '<img src="' . $image[0] . '" width="100px">' . PHP_EOL;
                $i++;
            }

            /**
             * Close containers and append noscript
             */
            if ($style == 'FlexSlider')
                $output .= '</ul></div>' . PHP_EOL;

            $noscript .= '</div></noscript>';

            $output .= '</div>' . $noscript . PHP_EOL;

            return $output;
        }

        function dm_scripts() {
            if (!is_admin()) {
                wp_enqueue_style('DM-style', plugins_url('assets/css/dm-style.min.css', __FILE__), false, '1.4.2.1');
                wp_enqueue_script('dm_flexslider', plugins_url('assets/js/jquery.flexslider.min.js', __FILE__), array('jquery'));
            }
        }

    }

}

if (class_exists("DM_Gallery")) {
    $dm_gallery = new DM_Gallery();
}