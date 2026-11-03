<?php
/**
 * <app-databricks> — Databricks implementation page (Version 1 design).
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="hero" aria-labelledby="hero-heading">
  <div class="container-fluid px-4">
    <div class="hero-copy">
      <div class="hero-eyebrow"><?= mh_e($hero['eyebrow'] ?? null) ?></div>
      <h1 id="hero-heading"><?= mh_e($hero['title'] ?? null) ?></h1>
      <p class="hero-sub"><?= mh_e($hero['sub'] ?? null) ?></p>
      <div class="hero-cta"><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="btn btn-dark"><?= mh_e($hero['cta'] ?? null) ?></a><a class="btn btn-outline" href="#capabilities" data-mh-action="scrollToSection" data-mh-args="<?= esc_attr(wp_json_encode([null, 'capabilities'])) ?>">Explore Capabilities</a></div>
    </div>
    <div class="hero-image has-badge"><img class="hero-photo" width="600" height="520" fetchpriority="high" decoding="async" src="<?= mh_asset_url($heroImageSrc) ?>" alt="<?= mh_a($heroImageAlt) ?>"><img class="hero-badge" width="130" height="129" decoding="async" src="<?= mh_asset_url($badgeSrc) ?>" alt="Databricks Brickbuilder Partner Network Bronze partner badge"></div>
  </div>
</section>
<?php
mh_component('service-sections', ['sections' => $sections, 'faqs' => $faqs]);
