<div class="dm-wrapper">
<?php if (!empty($width)): ?>
  <div style="width:<?= $width ?>;">
<?php endif ?>
    <div class="dm-browser" <?=$browserHelper->getAttr() ?>>
      <div class="device">
        <div class="screen">
          <?php
          	if (!empty($link)) { echo '<a href="' . esc_attr($link) . '">'; }
	          	echo do_shortcode($content);
	          if (!empty($link)) { echo '</a>'; }
	        ?>
        </div><!-- .screen -->
      </div><!-- .device -->
    </div><!-- .dm-browser -->
<?php if (!empty($width)): ?>
  </div><!-- .dm-width -->
<?php endif ?>
</div><!-- .dm-wrapper -->
