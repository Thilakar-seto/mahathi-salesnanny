<?php
/**
 * <app-health-top-banner> — converted from src/app/health-top-banner/health-top-banner.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="top-white">
  <div class="container">
    <div class="row align-items-center"></div>
  </div>
</section>
<section class="hero-section text-white">
  <div class="container-fluid"></div>
</section>
<section class="top-white py-5">
  <div class="container">
    <div class="row align-items-center"></div>
  </div>
</section>
<section class="hero-section text-white">
  <div class="container-fluid px-4 mbt">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 mb-lg-0"><small class="text-uppercase opacity-75"> <?= mh_e($pageData['sectionOneText'] ?? null) ?> </small><h1 class="fw-bold mt-3 section-title"> <?= mh_e($pageData['sectionTwoText'] ?? null) ?> </h1><p class="mt-3" style="margin-bottom: 0px;"> <?= mh_e($pageData['sectionThreeText'] ?? null) ?> </p></div>
      <div class="col-lg-6 col-md-12 text-center text-lg-end pe-lg-0 extra"><img class="img-fluid hero-img-left-curve" alt="Mahathi Infotech Solutions Banner" src="<?= mh_asset_url($pageData['heroImage'] ?? null) ?>"></div>
    </div>
  </div>
</section>
