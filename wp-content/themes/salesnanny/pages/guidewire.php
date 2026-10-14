<?php
/**
 * <app-guidewire> — converted from src/app/pages/guidewire/guidewire.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="hero" aria-labelledby="hero-heading">
  <div class="container-fluid px-4">
    <div class="hero-copy">
      <div class="hero-eyebrow">GUIDEWIRE</div>
      <h1 id="hero-heading">Transforming P&amp;C Insurance Operations with Guidewire Solutions</h1>
      <p class="hero-sub">Mahathi is Guidewire-experienced and supports property and casualty insurance carriers, MGAs, and TPAs with end-to-end implementation, cloud migration, integration, and managed services across ClaimCenter, PolicyCenter, and BillingCenter.</p>
      <div class="hero-cta"><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="btn btn-dark">Talk to a Guidewire Expert</a><a class="btn btn-outline" href="#capabilities" data-mh-action="scrollToSection" data-mh-args="<?= esc_attr(wp_json_encode([null, 'capabilities'])) ?>">Explore Capabilities</a></div>
    </div>
    <div class="hero-image"><img class="hero-photo" width="600" height="520" fetchpriority="high" decoding="async" src="<?= mh_asset_url($heroImageSrc) ?>" alt="<?= mh_a($heroImageAlt) ?>"></div>
  </div>
</section>
<section class="numbers" aria-labelledby="numbers-heading">
  <h2 style="position:absolute;left:-9999px" id="numbers-heading">Mahathi Guidewire capability — by the numbers</h2>
  <div class="container-fluid px-4">
    <div class="numbers-grid">
      <?php foreach (mh_list($stats) as $s) : ?>
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
    <h2 class="gw-section-title">Mahathi's Core Guidewire Capabilities</h2>
    <p class="sub">End-to-end Guidewire capabilities across the carrier's full journey, from greenfield implementation through long-term application managed services. Every capability is delivered by experienced Guidewire engineers, P&amp;C domain practitioners, and accelerator-enabled delivery teams.</p>
    <div class="cap-pills" role="list"><?php foreach (mh_list($pills) as $pill) : ?><span class="cap-pill<?= ($pill === $activePill) ? ' active' : '' ?>" role="listitem" data-mh-action="setActivePill" data-mh-args="<?= esc_attr(wp_json_encode([$pill])) ?>"><?= mh_e($pill) ?></span><?php endforeach; ?></div>
  </div>
</div>
<section class="cap-area" aria-label="Mahathi Guidewire capabilities">
  <div class="container-fluid px-4">
    <div class="cap-grid">
      <?php foreach (mh_list($capabilities) as $card) : ?>
        <article class="cap-card">
          <div class="cap-img"><?php if ((($card['iconKey'] ?? null) === 'implementation')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'cloud-migration')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 10h-2V6a4 4 0 0 0-8 0v4H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2z"></path><path d="M8 14v.01"></path><path d="M16 14v.01"></path></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'integration-data')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'configuration')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"></circle><path d="M12 1v6m0 10v6M4.22 4.22l4.24 4.24m7.08 7.08 4.24 4.24M1 12h6m10 0h6M4.22 19.78l4.24-4.24m7.08-7.08 4.24-4.24"></path></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'testing-qa')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'managed-services')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'accelerator')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'ccm-forms')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg><?php endif; ?><?php if ((($card['iconKey'] ?? null) === 'workbench')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="9" x2="9" y2="21"></line></svg><?php endif; ?></div>
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
    <div class="challenges-head"><span class="section-eyebrow">The Current State of Guidewire Programs</span><h2 class="gw-section-title" id="challenges-heading">Why so many Guidewire programs stall — and what carriers are doing about it.</h2><p>Guidewire is the right platform. That is not the question. The question is why so many carriers are on their second or third Guidewire program, on the wrong release of Guidewire Cloud, or running an implementation that has slipped twice. Three industry-wide patterns explain most of it.</p></div>
    <div class="challenges-grid">
      <?php foreach (mh_list($challenges) as $item) : ?>
        <article class="challenge">
          <div class="ico" aria-hidden="true"><?php if ((($item['iconKey'] ?? null) === 'warning')) : ?><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg><?php endif; ?><?php if ((($item['iconKey'] ?? null) === 'cloud-lock')) : ?><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10h-2V6a4 4 0 0 0-8 0v4H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2z"></path></svg><?php endif; ?><?php if ((($item['iconKey'] ?? null) === 'clock')) : ?><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg><?php endif; ?></div>
          <h3><?= mh_e($item['title'] ?? null) ?></h3>
          <p><?= mh_e($item['desc'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="solutions" aria-labelledby="solutions-heading">
  <div class="container-fluid px-4">
    <div class="solutions-head"><span class="section-eyebrow">How Mahathi Helps</span><h2 class="gw-section-title" id="solutions-heading">How Mahathi helps insurers respond to these Guidewire challenges.</h2><p>Each challenge above has a practical response. Mahathi brings certified Guidewire capability, deep insurance domain knowledge, and delivery experience across 40+ Guidewire programs to help insurers move forward with confidence.</p></div>
    <div class="solutions-grid">
      <?php foreach (mh_list($solutions) as $sol) : ?>
        <article class="solution">
          <div class="sol-num"><?= mh_e($sol['num'] ?? null) ?></div>
          <h3><?= mh_e($sol['title'] ?? null) ?></h3>
          <p class="sol-body"><?= mh_e($sol['body'] ?? null) ?></p>
          <div class="sol-proof"><span class="sol-proof-num"><?= mh_e($sol['proofNum'] ?? null) ?></span><span class="sol-proof-text"><?= mh_e($sol['proofText'] ?? null) ?></span></div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="sol-cta"><div class="sol-cta-text"><span class="sol-cta-eyebrow">Get in Touch</span><h3>Speak to our team</h3><p>Interested in learning more about our offerings? Our solutions specialists are ready to help.</p></div><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="sol-cta-btn"> Get in Touch <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a></div>
  </div>
</section>
<section class="faq" aria-labelledby="faq-heading">
  <div class="container-fluid px-4">
    <div class="faq-head"><span class="section-eyebrow">Frequently Asked Questions</span><h2 class="gw-section-title" id="faq-heading">Guidewire — the questions carriers actually ask.</h2></div>
    <div class="faq-list">
      <?php foreach (mh_list($faqs) as $item) : ?>
        <div class="faq-item<?= $item['open'] ?? null ? ' open' : '' ?>"><button class="faq-summary" type="button" aria-expanded="<?= mh_a($item['open'] ?? null) ?>" data-mh-action="toggleFaq" data-mh-args="<?= esc_attr(wp_json_encode([$item])) ?>"> <?= mh_e($item['question'] ?? null) ?> <span class="faq-icon" aria-hidden="true"><?= mh_e((($item['open'] ?? null) ? '×' : '+')) ?></span></button><div class="faq-answer<?= $item['open'] ?? null ? ' is-open' : '' ?>">
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
