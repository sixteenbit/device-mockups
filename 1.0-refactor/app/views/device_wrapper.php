<div class="wrapper">
  <?php if (esc_attr($stacked)=='open' ): ?>
  <div class="dm-stacked">
    <?php endif ?>

    <?php if (!empty($hide)): ?>
    <div class="dm-hide-<?= esc_attr($hide) ?>">
      <?php endif ?>

      <?php if (!empty($width)): ?>
      <div class="dm-width" style="width:<?= $width ?>;">
        <?php endif ?>

        <div class="<?= $deviceHelper->getClassAttr() ?>">

          <div class="dm-device" <?=$deviceHelper->getAttr() ?>>
            <div class="device">
              <div class="screen">
	              <?php
	              	if (!empty($link)) { echo '<a href="' . esc_attr($link) . '">'; }
	                	echo do_shortcode($content);
                	if (!empty($link)) { echo '</a>'; }
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

    <?php if (esc_attr($stacked)=='closed' ): ?>
  </div>
  <?php endif ?>
</div>
