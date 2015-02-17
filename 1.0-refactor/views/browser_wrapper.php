<?php
function getDataAttribute() {
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

<div class="wrap">
    <?php if (!empty($width)): ?>
        <div style="max-width:<?= $width ?>">
        <?php endif ?>

        <div class="dm-browser" <?= getDataAttribute() ?>>
            <div class="device">
                <div class="screen">
                    <?php if (!empty($link)): ?>
                        <a href="<?= esc_attr($link) ?>">
                            <?= do_shortcode($content) ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <?php if (!empty($width)): ?>
        </div>
    <?php endif ?>
</div>