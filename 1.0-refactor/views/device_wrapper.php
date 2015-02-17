<?php
// Open $stacked
if (esc_attr($stacked) == 'open') {
    echo '<div class="dm-stacked">';
}

// Open $hide
if (!empty($hide)) {
    echo '<div class="dm-hide-' . esc_attr($hide) . '">';
}

// Open $width
if (!empty($width)) {
    echo '<div class="dm-width" style="width:' . $width . ';">';
}
?>

<div class="<?php
     if (!empty($position)) {
         echo 'dm-stacked-' . esc_attr($position) . '';
     }
     if (!empty($type)) {
         echo ' ' . esc_attr($type) . '';
     }
     if (!empty($orientation)) {
         echo ' ' . esc_attr($orientation) . '';
     }
     ?>">

    <div class="dm-device" <?php
        if (!empty($type)) {
            echo 'data-device="' . esc_attr($type) . '"';
        }
        if (!empty($orientation)) {
            echo ' data-orientation="' . esc_attr($orientation) . '"';
        }
        if (!empty($color)) {
            echo ' data-color="' . esc_attr($color) . '"';
        }
        ?>>
        <?php
        echo '<div class="device">';
        echo '<div class="screen">';
        if (!empty($link)) {
            echo '<a href="' . esc_attr($link) . '">';
        }
        echo '' . do_shortcode($content) . '';
        if (!empty($link)) {
            echo '</a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Close $width
        if (!empty($width)) {
            echo '</div>';
        }

        // Close $hide
        if (!empty($hide)) {
            echo '</div>';
        }

        // Close $stacked
        if (esc_attr($stacked) == 'closed') {
            echo '</div>';
        }