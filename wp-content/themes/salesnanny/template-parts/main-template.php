<?php
/**
 * <app-main-template> — converted from src/app/sharedComponents/main-template/main-template.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="top-white py-5">
  <div class="container">
    <div class="row align-items-center"></div>
  </div>
</section>
<section class="hero-section text-white">
  <div class="container-fluid px-4">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 mb-lg-0"><small class="text-uppercase opacity-75" style="color: #000;"> <?= mh_e($pageData['sectionOneText'] ?? null) ?> </small><h1 class="fw-bold mt-3 txt-2" style="color: #000;"> <?= mh_e($pageData['sectionTwoText'] ?? null) ?> </h1><p class="mt-3 txt-3" style="color: #000;"> <?= mh_e($pageData['sectionThreeText'] ?? null) ?> </p></div>
      <div class="col-lg-6 col-md-12 text-center text-lg-end pe-lg-0"><img class="img-fluid hero-img-left-curve" src="<?= mh_asset_url($pageData['heroImage'] ?? null) ?>" alt="<?= mh_a(((($pageData['sectionTwoText'] ?? null) ?: 'Mahathi Infotech Solutions') . ' - Mahathi Infotech')) ?>"></div>
    </div>
  </div>
</section>
<section class="bg-omni-grey py-5">
  <div class="container text-center">
    <?php if ($pageData['sectionHeaderTitle'] ?? null) : ?>
      <h2 class="fw-bold mb-5 section-title"><?php if ($isMobile) : ?> <?= mh_e($pageData['sectionHeaderTitle'] ?? null) ?> <?php if ($pageData['sectionHeaderSubtitle'] ?? null) : ?><span> <?= mh_e($pageData['sectionHeaderSubtitle'] ?? null) ?> </span><?php endif; ?><?php else : ?><span class="<?= mh_cls(((($pageData['sectionHeaderTitle'] ?? null) === 'Streamlining Workers’ Compensation') ? 'sectionHeaderSubtitle' : 'underline_cls1')) ?>"> <?= mh_e($pageData['sectionHeaderTitle'] ?? null) ?> </span><?php if ($pageData['sectionHeaderSubtitle'] ?? null) : ?><br><span class="<?= mh_cls(((($pageData['sectionHeaderTitle'] ?? null) === 'Streamlining Workers’ Compensation') ? 'underline_cls1' : '')) ?>"> <?= mh_e($pageData['sectionHeaderSubtitle'] ?? null) ?> </span><?php endif; ?><?php endif; ?></h2>
    <?php endif; ?>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <?php foreach (mh_list($pageData['features'] ?? null) as $item) : ?>
        <div class="omni-card d-flex align-items-center px-4 py-2 shadow-sm border rounded bg-white" data-mh-action="goTo" data-mh-args="<?= esc_attr(wp_json_encode([($item['icon'] ?? null)])) ?>"><span class="fw-medium text-purple me-4">&nbsp;<?= mh_e($item['label'] ?? null) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="solutions-section pt-1 pb-3 pt-lg-3 pb-lg-5">
  <div class="container">
    <div class="text-center py-3">
      <h1 class="fw-bold txt-5"><?= mh_e($pageData['solutionsHeading'] ?? null) ?></h1>
    </div>
    <div class="row g-4 justify-content-center">
      <?php foreach (mh_list($pageData['solutions'] ?? null) as $card) : ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-4 pt-2 pt-md-3 pt-lg-4 mb-3 mb-lg-0" id="<?= mh_a($card['cta'] ?? null) ?>">
          <div class="solution-card h-100 shadow-sm bg-white d-flex flex-column"><img class="img-fluid solution-img" src="<?= mh_asset_url($card['image'] ?? null) ?>" alt="<?= mh_a((($card['title'] ?? null) . ' solution')) ?>"><div class="p-4 d-flex flex-column flex-grow-1">
              <h5 class="fw-bold mb-2"><?= mh_e($card['title'] ?? null) ?></h5>
              <?php if (mh_isString(($card['description'] ?? null))) : ?>
                <p class="text-muted small text-justify"> <?= mh_e($card['description'] ?? null) ?> </p>
              <?php endif; ?>
              <?php if (mh_isArray(($card['description'] ?? null))) : ?>
                <ul class="text-muted small text-justify">
                  <?php foreach (mh_list($card['description'] ?? null) as $item) : ?>
                    <li> <?= mh_e($item) ?> </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section style="background-color: #ddd;">
  <div class="container">
    <div class="row">
      <div class="col editor-col">
        <div class="editor-text text-lg-center text-md-start"><span> <?= mh_e($title) ?> </span><p class="mt-2"> <?= mh_e($subtitle) ?> </p></div>
        <div class="col-md-12 text-center"><span data-href="<?= esc_url(mh_url('/contact-us')) ?>" class="bg-white contact_common inline-block border rounded-full
         hover:bg-violet hover:text-white">
            <div class="flex items-center lg:text-20 text-center text-black"><span class="order-1 text-black">Contact Us</span><svg class="ml-2" style="display: none;" width="15" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51724 0.947642L14.5954 6.15598L9.51724 11.469" fill="currentColor"></path></svg></div>
          </span></div>
      </div>
    </div>
  </div>
</section>
