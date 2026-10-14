<?php
/**
 * <app-section3-temp> — converted from src/app/sharedComponents/section3-temp/section3-temp.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="ai-risk-section bg-sec-risk-1">
  <h1 class="main-title"><?= mh_e($title) ?></h1>
  <div class="ai-risk-cards">
    <?php foreach (mh_list($cards) as $card) : ?>
      <div class="ai-risk-card" id="<?= mh_a($card['cta'] ?? null) ?>">
        <div class="ai-risk-image"><img src="<?= mh_asset_url($card['image'] ?? null) ?>" alt="<?= mh_a($card['title'] ?? null) ?>"></div>
        <div class="ai-info-content">
          <h2 class="ai-info-title"><?= mh_e($card['title'] ?? null) ?></h2>
          <?php if ($card['description'] ?? null) : ?>
            <p><?= mh_e($card['description'] ?? null) ?></p>
          <?php endif; ?>
          <ul class="main-list">
            <?php foreach (mh_list($card['list'] ?? null) as $item) : ?>
              <li> <?= mh_e($item) ?> </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
