<?php
/**
 * Shared body of the Databricks and Workers' Compensation pages (Version 1 design).
 * Renders the ordered `$sections` list: numbers band, challenges, capability cards,
 * solutions, outcome cards, CTA bands and FAQ. `$faqs` feeds the FAQ section.
 * Called from pages/databricks.php and pages/modern-workers-compensation.php.
 */
if (!defined('ABSPATH')) { exit; }

$icons = [
    'database' => '<ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>',
    'clock' => '<circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>',
    'chart' => '<line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line>',
    'grid' => '<rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>',
    'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>',
    'chip' => '<rect x="4" y="4" width="16" height="16" rx="2"></rect><rect x="9" y="9" width="6" height="6"></rect><path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 14h3M1 9h3M1 14h3"></path>',
    'layers' => '<path d="M12 2 2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path>',
    'server' => '<rect x="2" y="2" width="20" height="8" rx="2"></rect><rect x="2" y="14" width="20" height="8" rx="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line>',
    'pulse' => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>',
    'clipboard' => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1"></rect><polyline points="9 14 11 16 15 12"></polyline>',
    'link' => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>',
    'mail' => '<path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>',
    'doc' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>',
    'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>',
    'home' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>',
    'alert' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>',
];
$arrow = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
$cardIcon = static function (array $item) use ($icons): string {
    return '<div class="cap-img"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($icons[$item['iconKey'] ?? ''] ?? '') . '</svg></div>'; // phpcs:ignore -- static markup
};
$secHead = static function (array $sec): void {
    ?>
    <div class="sec-head<?= !empty($sec['intro']) && mb_strlen($sec['intro']) <= 125 ? ' wide' : '' ?>"><h2 class="gw-section-title"><?= mh_e($sec['title'] ?? null) ?></h2><?php if (!empty($sec['intro'])) : ?><p><?= mh_e($sec['intro']) ?></p><?php endif; ?></div>
    <?php
};

foreach (mh_list($sections ?? null) as $sec) :
    switch ($sec['type'] ?? '') :

        case 'numbers':
            $items = mh_list($sec['items'] ?? null);
            ?>
<section class="numbers stats" aria-label="<?= mh_a($sec['label'] ?? null) ?>">
  <div class="container-fluid px-4">
    <div class="numbers-grid<?= 4 === count($items) ? ' c4' : '' ?>">
      <?php foreach ($items as $s) : ?>
        <div class="num-cell"><div class="stat"><?= mh_e($s['value'] ?? null) ?><span class="accent"><?= mh_e($s['accent'] ?? null) ?></span></div><h3><?= mh_e($s['title'] ?? null) ?></h3></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
            <?php
            break;

        case 'challenges':
            ?>
<section class="challenges">
  <div class="container-fluid px-4">
    <?php $secHead($sec); ?>
    <div class="challenges-grid<?= 4 === (int) ($sec['cols'] ?? 3) ? ' c4' : '' ?>">
      <?php foreach (mh_list($sec['items'] ?? null) as $item) : ?>
        <article class="challenge">
          <div class="ico" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $icons[$item['iconKey'] ?? ''] ?? '' // phpcs:ignore -- static markup ?></svg></div>
          <h3><?= mh_e($item['title'] ?? null) ?></h3>
          <p><?= mh_e($item['desc'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
            <?php
            break;

        case 'capabilities':
            $cards = mh_list($sec['cards'] ?? null);
            $leadClass = !empty($sec['plainLead']) ? 'lead plain' : 'lead';
            ?>
<div class="cap-banner" id="<?= mh_a($sec['id'] ?? 'capabilities') ?>">
  <div class="container-fluid px-4">
    <h2 class="gw-section-title"><?= mh_e($sec['title'] ?? null) ?></h2>
    <?php if (!empty($sec['sub'])) : ?><p class="sub"><?= mh_e($sec['sub']) ?></p><?php endif; ?>
    <div class="cap-pills" role="list"><?php foreach ($cards as $i => $card) : ?><button type="button" class="cap-pill<?= 0 === $i ? ' active' : '' ?>" data-mh-action="scrollToCap" data-mh-args="<?= esc_attr(wp_json_encode(['cap-' . $i])) ?>"><?= mh_e($card['title'] ?? null) ?></button><?php endforeach; ?></div>
  </div>
</div>
<section class="cap-area" aria-label="<?= mh_a($sec['title'] ?? null) ?>">
  <div class="container-fluid px-4">
    <div class="cap-grid caps" style="--rows:4">
      <?php foreach ($cards as $i => $card) : ?>
        <article class="cap-card" id="cap-<?= (int) $i ?>">
          <?= $cardIcon($card) // phpcs:ignore -- built from escaped static markup ?>
          <div class="cap-body">
            <h3><?= mh_e($card['title'] ?? null) ?></h3>
            <p class="<?= $leadClass ?>"><?= mh_e($card['lead'] ?? null) ?></p>
            <ul>
              <?php foreach (mh_list($card['points'] ?? null) as $point) : ?>
                <li><?= mh_e($point) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
            <?php
            break;

        case 'solutions':
            ?>
<section class="solutions">
  <div class="container-fluid px-4">
    <?php $secHead($sec); ?>
    <div class="solutions-grid<?= 4 === (int) ($sec['cols'] ?? 3) ? ' c4' : '' ?>">
      <?php foreach (mh_list($sec['items'] ?? null) as $n => $item) : ?>
        <article class="solution">
          <div class="sol-num<?= 4 === (int) ($sec['cols'] ?? 3) ? ' sm' : '' ?>"><?= sprintf('%02d', $n + 1) ?></div>
          <h3><?= mh_e($item['title'] ?? null) ?></h3>
          <p class="sol-body"><?= mh_e($item['body'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
            <?php
            break;

        case 'outcomes':
            // rows shared by the cards through subgrid: image, [tag], title, paragraphs, [proof]
            $outRows = 2;
            foreach (mh_list($sec['cards'] ?? null) as $card) {
                $outRows = max($outRows, 2 + (empty($card['tag']) ? 0 : 1) + count(mh_list($card['paras'] ?? null)) + (empty($card['proof']) ? 0 : 1));
            }
            ?>
<section class="cap-area tight">
  <div class="container-fluid px-4">
    <?php $secHead($sec); ?>
    <div class="cap-grid outcomes<?= 2 === (int) ($sec['cols'] ?? 3) ? ' two' : '' ?>" style="--rows:<?= (int) $outRows ?>">
      <?php foreach (mh_list($sec['cards'] ?? null) as $card) : ?>
        <article class="cap-card">
          <?= $cardIcon($card) // phpcs:ignore -- built from escaped static markup ?>
          <div class="cap-body">
            <?php if (!empty($card['tag'])) : ?><span class="tag"><?= mh_e($card['tag']) ?></span><?php endif; ?>
            <h3><?= mh_e($card['title'] ?? null) ?></h3>
            <?php foreach (mh_list($card['paras'] ?? null) as $para) : ?>
              <p class="lead plain"><?= mh_e($para) ?></p>
            <?php endforeach; ?>
            <?php if (!empty($card['proof'])) : ?><div class="proof"><?= mh_e($card['proof']) ?></div><?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
            <?php
            break;

        case 'cta':
            ?>
<section class="solutions cta-only">
  <div class="container-fluid px-4">
    <?php foreach (mh_list($sec['items'] ?? null) as $cta) : ?>
      <div class="sol-cta"><div class="sol-cta-text"><span class="sol-cta-eyebrow"><?= mh_e($cta['eyebrow'] ?? null) ?></span><h3><?= mh_e($cta['title'] ?? null) ?></h3><p><?= mh_e($cta['text'] ?? null) ?></p></div><a class="sol-cta-btn" href="<?= esc_url(mh_url('/contact-us')) ?>"><?= mh_e($cta['button'] ?? null) ?> <?= $arrow // phpcs:ignore -- static markup ?></a></div>
    <?php endforeach; ?>
  </div>
</section>
            <?php
            break;

        case 'faq':
            ?>
<section class="faq">
  <div class="container-fluid px-4">
    <div class="faq-head"><h2 class="gw-section-title"><?= mh_e($sec['title'] ?? null) ?></h2><?php if (!empty($sec['intro'])) : ?><p><?= mh_e($sec['intro']) ?></p><?php endif; ?></div>
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
            <?php
            break;

    endswitch;
endforeach;
