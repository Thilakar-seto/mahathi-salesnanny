<?php
/**
 * <app-dashboard-our-solutions> — converted from src/app/sharedComponents/dashboard-our-solutions/dashboard-our-solutions.component.html
 *
 * Cards open the side panel with the solution list (links resolved by mh_our_solutions_link()).
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="vg-wrapper" id="our-solutions">
  <h2 class="vg-section-title">OUR SOLUTIONS</h2>
  <div class="vg-grid">
    <div class="vg-stack vg-stack--a">
      <?php foreach (mh_list($stackA) as $card) : ?>
        <div class="vg-item" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_our_solutions_link')])) ?>"><img class="vg-item__img" src="<?= mh_asset_url($card['imageUrl'] ?? null) ?>" alt="<?= mh_a($card['title'] ?? null) ?>"><div class="vg-item__overlay"></div><div class="vg-item__label"><div class="vg-item__label-content">
              <p class="vg-item__title"><?= mh_e($card['title'] ?? null) ?></p>
              <p class="vg-item__desc"><?= mh_e($card['description'] ?? null) ?></p>
            </div><button class="vg-item__btn" aria-label="View details" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_our_solutions_link')])) ?>" data-mh-stop="1"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"></path></svg></button></div></div>
      <?php endforeach; ?>
    </div>
    <div class="vg-stack vg-stack--b">
      <?php foreach (mh_list($stackB) as $card) : ?>
        <div class="vg-item" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_our_solutions_link')])) ?>"><img class="vg-item__img" src="<?= mh_asset_url($card['imageUrl'] ?? null) ?>" alt="<?= mh_a($card['title'] ?? null) ?>"><div class="vg-item__overlay"></div><div class="vg-item__label"><div class="vg-item__label-content">
              <p class="vg-item__title"><?= mh_e($card['title'] ?? null) ?></p>
              <p class="vg-item__desc"><?= mh_e($card['description'] ?? null) ?></p>
            </div><button class="vg-item__btn" aria-label="View details" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_our_solutions_link')])) ?>" data-mh-stop="1"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"></path></svg></button></div></div>
      <?php endforeach; ?>
    </div>
    <div class="vg-stack vg-stack--c">
      <?php foreach (mh_list($stackC) as $card) : ?>
        <div class="vg-item" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_our_solutions_link')])) ?>"><img class="vg-item__img" src="<?= mh_asset_url($card['imageUrl'] ?? null) ?>" alt="<?= mh_a($card['title'] ?? null) ?>"><div class="vg-item__overlay"></div><div class="vg-item__label"><div class="vg-item__label-content">
              <p class="vg-item__title"><?= mh_e($card['title'] ?? null) ?></p>
              <p class="vg-item__desc"><?= mh_e($card['description'] ?? null) ?></p>
            </div><button class="vg-item__btn" aria-label="View details" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_our_solutions_link')])) ?>" data-mh-stop="1"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"></path></svg></button></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php /* Sidebar content is rendered by assets/js/mahathi.js (MH.sidebar) when a card is opened. */ ?>
<aside class="vg-sidebar" role="dialog" aria-modal="true" data-mh-sidebar="vg"></aside>
