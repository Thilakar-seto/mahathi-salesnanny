<?php
/**
 * Shared body of the Databricks and Workers' Compensation pages:
 * numbers band, capability cards, challenges, solutions + CTA and FAQ.
 * Called from pages/databricks.php and pages/modern-workers-compensation.php.
 */
if (!defined('ABSPATH')) { exit; }

$capIcons = [
    'lakehouse' => '<path d="M12 2 2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path>',
    'migration' => '<ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>',
    'analytics' => '<line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line>',
    'ai' => '<rect x="4" y="4" width="16" height="16" rx="2"></rect><rect x="9" y="9" width="6" height="6"></rect><path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>',
    'governance' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>',
    'managed' => '<rect x="2" y="2" width="20" height="8" rx="2"></rect><rect x="2" y="14" width="20" height="8" rx="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line>',
    'claims' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>',
    'vendors' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>',
    'medical' => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>',
    'mailroom' => '<path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>',
    'compliance' => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1"></rect><polyline points="9 14 11 16 15 12"></polyline>',
    'guidewire' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>',
];
$challengeIcons = [
    'lock' => '<rect x="3" y="11" width="18" height="11" rx="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path>',
    'clock' => '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>',
    'warning' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>',
    'grid' => '<rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>',
    'link' => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>',
];
?>
<section class="numbers" aria-labelledby="numbers-heading">
  <h2 style="position:absolute;left:-9999px" id="numbers-heading"><?= mh_e($numbersLabel ?? null) ?></h2>
  <div class="container-fluid px-4">
    <div class="numbers-grid">
      <?php foreach (mh_list($stats ?? null) as $s) : ?>
        <div class="num-cell">
          <div class="stat"><?= mh_e($s['value'] ?? null) ?><span class="accent"><?= mh_e($s['accent'] ?? null) ?></span></div>
          <h3><?= mh_e($s['title'] ?? null) ?></h3>
          <p><?= mh_e($s['desc'] ?? null) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<div class="cap-banner" id="capabilities">
  <div class="container-fluid px-4">
    <h2 class="gw-section-title"><?= mh_e($capTitle ?? null) ?></h2>
    <p class="sub"><?= mh_e($capSub ?? null) ?></p>
    <div class="cap-pills" role="list"><?php foreach (mh_list($pills ?? null) as $i => $pill) : ?><button type="button" class="cap-pill<?= 0 === $i ? ' active' : '' ?>" data-mh-action="scrollToCap" data-mh-args="<?= esc_attr(wp_json_encode(['cap-' . $i])) ?>"><?= mh_e($pill) ?></button><?php endforeach; ?></div>
  </div>
</div>
<section class="cap-area" aria-label="<?= mh_a($capTitle ?? null) ?>">
  <div class="container-fluid px-4">
    <div class="cap-grid">
      <?php foreach (mh_list($capabilities ?? null) as $i => $card) : ?>
        <article class="cap-card" id="cap-<?= (int) $i ?>">
          <div class="cap-img"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $capIcons[$card['iconKey'] ?? ''] ?? '' // phpcs:ignore -- static markup ?></svg></div>
          <div class="cap-body">
            <h3><?= mh_e($card['title'] ?? null) ?></h3>
            <p class="lead"><?= mh_e($card['lead'] ?? null) ?></p>
            <ul>
              <?php foreach (mh_list($card['points'] ?? null) as $point) : ?>
                <li><?= mh_e($point) ?></li>
              <?php endforeach; ?>
            </ul>
            <div class="proof"><?= mh_e($card['proof'] ?? null) ?></div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="challenges" aria-labelledby="challenges-heading">
  <div class="container-fluid px-4">
    <div class="challenges-head"><span class="section-eyebrow"><?= mh_e($challengesEyebrow ?? null) ?></span><h2 class="gw-section-title" id="challenges-heading"><?= mh_e($challengesTitle ?? null) ?></h2><p><?= mh_e($challengesIntro ?? null) ?></p></div>
    <div class="challenges-grid">
      <?php foreach (mh_list($challenges ?? null) as $item) : ?>
        <article class="challenge">
          <div class="ico" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $challengeIcons[$item['iconKey'] ?? ''] ?? '' // phpcs:ignore -- static markup ?></svg></div>
          <h3><?= mh_e($item['title'] ?? null) ?></h3>
          <p><?= mh_e($item['desc'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="solutions" aria-labelledby="solutions-heading">
  <div class="container-fluid px-4">
    <div class="solutions-head"><span class="section-eyebrow">How Mahathi Helps</span><h2 class="gw-section-title" id="solutions-heading"><?= mh_e($solutionsTitle ?? null) ?></h2><p><?= mh_e($solutionsIntro ?? null) ?></p></div>
    <div class="solutions-grid">
      <?php foreach (mh_list($solutions ?? null) as $sol) : ?>
        <article class="solution">
          <div class="sol-num"><?= mh_e($sol['num'] ?? null) ?></div>
          <h3><?= mh_e($sol['title'] ?? null) ?></h3>
          <p class="sol-body"><?= mh_e($sol['body'] ?? null) ?></p>
          <div class="sol-proof"><span class="sol-proof-num"><?= mh_e($sol['proofNum'] ?? null) ?></span><span class="sol-proof-text"><?= mh_e($sol['proofText'] ?? null) ?></span></div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="sol-cta"><div class="sol-cta-text"><span class="sol-cta-eyebrow">Get in Touch</span><h3><?= mh_e($ctaTitle ?? null) ?></h3><p><?= mh_e($ctaText ?? null) ?></p></div><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="sol-cta-btn"> <?= mh_e($ctaButton ?? null) ?> <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a></div>
  </div>
</section>
<section class="faq" aria-labelledby="faq-heading">
  <div class="container-fluid px-4">
    <div class="faq-head"><span class="section-eyebrow">Frequently Asked Questions</span><h2 class="gw-section-title" id="faq-heading"><?= mh_e($faqTitle ?? null) ?></h2></div>
    <div class="faq-list">
      <?php foreach (mh_list($faqs ?? null) as $item) : ?>
        <div class="faq-item"><button class="faq-summary" type="button" aria-expanded="false" data-mh-action="toggleFaq"> <?= mh_e($item['question'] ?? null) ?> <span class="faq-icon" aria-hidden="true">+</span></button><div class="faq-answer">
            <div class="faq-answer__inner">
              <?php foreach (mh_list($item['answerParas'] ?? null) as $para) : ?>
                <p><?= mh_e($para) ?></p>
              <?php endforeach; ?>
            </div>
          </div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
