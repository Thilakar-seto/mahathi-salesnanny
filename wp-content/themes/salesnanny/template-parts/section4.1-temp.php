<?php
/**
 * <app-section41-temp> — converted from src/app/sharedComponents/section4.1-temp/section4.1-temp.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="bg-omni-grey Sectionheadertitle">
  <div class="container text-center">
    <h2 class="fw-bold mb-5 section-title"> <?= mh_e($sectionHeaderTitle) ?> <?php if ($sectionHeaderSubtitle) : ?><br><?php endif; ?> <?= mh_e($sectionHeaderSubtitle) ?> </h2>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <?php foreach (mh_list($features) as $item) : ?>
        <div class="omni-card d-flex align-items-center px-4 py-2 shadow-sm border rounded bg-white" data-mh-action="goTo" data-mh-args="<?= esc_attr(wp_json_encode([($item['icon'] ?? null)])) ?>"><span class="fw-medium text-purple"> <?= mh_e($item['label'] ?? null) ?> </span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
