<?php

function getClass() {
    $output = '';
    if (!empty($position)) {
        $output .= 'dm-stacked-' . esc_attr($position) . '';
    }
    if (!empty($type)) {
        $output .= ' ' . esc_attr($type) . '';
    }
    if (!empty($orientation)) {
        $output .= ' ' . esc_attr($orientation) . '';
    }
    return $output;
}

function getAttr() {
    $output = '';
    if (!empty($type)) {
        $output .= 'data-device="' . esc_attr($type) . '"';
    }
    if (!empty($orientation)) {
        $output .= ' data-orientation="' . esc_attr($orientation) . '"';
    }
    if (!empty($color)) {
        $output .= ' data-color="' . esc_attr($color) . '"';
    }
    return $output;
}
?>
<div class="wrapper">
    <?php if (esc_attr($stacked) == 'open'): ?>
        <div class="dm-stacked">
        <?php endif ?>

        <?php if (!empty($hide)): ?>
            <div class="dm-hide-<?= esc_attr($hide) ?>">
            <?php endif ?>

            <?php if (!empty($width)): ?>
                <div class="dm-width" style="width:<?= $width ?>;">
                <?php endif ?>

                <div class="<?= getClass() ?>">

                    <div class="dm-device" <?= getAttr() ?>>
                        <div class="device">
                            <div class="screen">
                                <?php
                                if (!empty($link)) {
                                    echo '<a href="' . esc_attr($link) . '">';
                                    echo '' . do_shortcode($content) . '';
                                    echo '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($width)): ?>
                </div>
            <?php endif ?>

            <?php if (!empty($hide)): ?>
            </div>
        <?php endif ?>

        <?php if (esc_attr($stacked) == 'closed'): ?>
        </div>
    <?php endif ?>
</div>