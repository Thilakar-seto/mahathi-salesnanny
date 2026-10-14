<?php
/**
 * <app-section4-temp> — converted from src/app/sharedComponents/section4-temp/section4-temp.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="page-block-section position-relative font-dark" id="healthcare-capabilities-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 sec-1 text-center">
        <?php if ($headerTitle) : ?>
          <h2 class="h1"><span class="big"> <?= mh_e($headerTitle['main'] ?? null) ?> <span class="underline_cls1 highlight-pop"> <?= mh_e($headerTitle['highlight'] ?? null) ?> </span></span></h2>
        <?php endif; ?>
        <?php if (mh_length($ctaButtons)) : ?>
          <div class="cta-wrapper"><?php foreach (mh_list($ctaButtons) as $btn) : ?><button class="cta-btn" data-mh-action="onCtaClick" data-mh-args="<?= esc_attr(wp_json_encode([($btn['action'] ?? null)])) ?>"> <?= mh_e($btn['label'] ?? null) ?> </button><?php endforeach; ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
