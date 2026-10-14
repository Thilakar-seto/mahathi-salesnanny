<?php
/**
 * <app-databricks> — converted from src/app/pages/databricks/databricks.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="hero" aria-labelledby="hero-heading">
  <div class="container-fluid px-4">
    <div class="hero-content"><span class="hero-badge">Databricks Bronze Partner</span><h1 id="hero-heading">Enterprise Databricks Implementation &amp; Migration Services</h1><p> Transform fragmented legacy data infrastructure into a unified, AI-ready Lakehouse. Mahathi delivers zero-downtime migrations, real-time analytics, and AI-powered intelligence for insurance carriers, healthcare payers, MGAs, and TPAs. Several successful Databricks implementations. </p></div>
    <div class="hero-image"><img class="hero-photo" width="600" height="460" fetchpriority="high" decoding="async" src="<?= mh_asset_url($heroImageSrc) ?>" alt="<?= mh_a($heroImageAlt) ?>"></div>
  </div>
</section>
<section class="challenges-section" aria-labelledby="challenges-heading">
  <div class="container-fluid px-4">
    <div class="section-header">
      <h2 id="challenges-heading">Industry Challenges That Databricks Solves</h2>
      <p class="section-intro"><?= mh_e($challengesIntro) ?></p>
    </div>
    <div class="challenges-grid">
      <?php foreach (mh_list($challenges) as $item) : ?>
        <article class="challenge-card">
          <div class="challenge-title"><?= mh_e($item['title'] ?? null) ?></div>
          <p class="challenge-description"><?= mh_e($item['description'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section id="services" aria-labelledby="services-heading">
  <div class="container-fluid px-4">
    <div class="section-header">
      <h2 id="services-heading">Mahathi Core Databricks Capabilities</h2>
    </div>
    <div class="services-grid">
      <?php foreach (mh_list($services) as $service) : ?>
        <article class="service-card">
          <div class="service-icon" aria-hidden="true"><?php if ((($service['iconKey'] ?? null) === 'migration')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path><path d="M16 16h5v5"></path></svg><?php endif; ?><?php if ((($service['iconKey'] ?? null) === 'analytics')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10"></path><path d="M10 20V4"></path><path d="M16 20v-6"></path><path d="M22 20V8"></path></svg><?php endif; ?><?php if ((($service['iconKey'] ?? null) === 'ai')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"></rect><path d="M9 9h.01"></path><path d="M15 9h.01"></path><path d="M9 15a3 3 0 0 0 6 0"></path></svg><?php endif; ?><?php if ((($service['iconKey'] ?? null) === 'governance')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="10" rx="2"></rect><path d="M8 11V7a4 4 0 0 1 8 0v4"></path></svg><?php endif; ?><?php if ((($service['iconKey'] ?? null) === 'etl')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"></path></svg><?php endif; ?><?php if ((($service['iconKey'] ?? null) === 'managed')) : ?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"></rect><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"></path></svg><?php endif; ?></div>
          <h3><?= mh_e($service['title'] ?? null) ?></h3>
          <p><?= mh_e($service['description'] ?? null) ?></p>
          <?php foreach (mh_list($service['metrics'] ?? null) as $metric) : ?>
            <div class="service-metric"><span class="metric-icon">✓</span><span class="metric-text"><?= mh_e($metric) ?></span></div>
          <?php endforeach; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="why-section" id="why" aria-labelledby="why-heading">
  <div class="container-fluid px-4">
    <div class="section-header">
      <h2 id="why-heading">Why Databricks for Insurance &amp; Healthcare</h2>
      <p class="section-intro"><?= mh_e($whyIntro) ?></p>
    </div>
    <div class="features-grid">
      <?php foreach (mh_list($whyFeatures) as $feature) : ?>
        <article class="feature-card">
          <div class="feature-header">
            <div class="feature-checkmark">✓</div>
            <h3 class="feature-title"><?= mh_e($feature['title'] ?? null) ?></h3>
          </div>
          <p class="feature-description"><?= mh_e($feature['description'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="why-mahathi-section" id="why-mahathi" aria-labelledby="why-mahathi-heading">
  <div class="container-fluid px-4">
    <div class="mahathi-section-content">
      <div class="mahathi-left-column">
        <h2 id="why-mahathi-heading">Why Choose Mahathi for Databricks Implementation</h2>
      </div>
      <div class="mahathi-right-column">
        <ul class="reasons-list">
          <?php foreach (mh_list($mahathiReasons) as $reason) : ?>
            <li class="reason-item">
              <div class="reason-icon">✓</div>
              <div class="reason-content">
                <div class="reason-title"><?= mh_e($reason['title'] ?? null) ?></div>
                <p class="reason-description"><?= mh_e($reason['description'] ?? null) ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="outcomes-section" aria-labelledby="outcomes-heading">
  <div class="container-fluid px-4">
    <div class="section-header">
      <h2 id="outcomes-heading">Proven Customer Outcomes</h2>
    </div>
    <div class="outcomes-cards">
      <?php foreach (mh_list($outcomes) as $outcome) : ?>
        <article class="outcome-card">
          <h3><?= mh_e($outcome['title'] ?? null) ?></h3>
          <p><?= mh_e($outcome['description'] ?? null) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="footer-cta" aria-labelledby="footer-cta-heading">
  <div class="container-fluid px-4">
    <div class="footer-cta-card"><div class="footer-cta-text"><span class="footer-cta-eyebrow">Get in Touch</span><h2 id="footer-cta-heading">Speak to our team</h2><p>Interested in learning more about our offerings? Our solutions specialists are ready to help.</p></div><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="footer-cta-action"> Get in Touch <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a></div>
  </div>
</section>
<section class="faq-section" id="faq" aria-labelledby="faq-heading">
  <div class="container-fluid px-4">
    <div class="section-header">
      <h2 id="faq-heading">Frequently Asked Questions</h2>
      <p>Common questions about Databricks implementation, migration, and platform capabilities.</p>
    </div>
    <div class="faq-grid"><?php foreach (mh_list($faqs) as $item) : ?><details class="faq-item"><summary><h4><?= mh_e($item['question'] ?? null) ?></h4><span class="faq-toggle" aria-hidden="true"></span></summary><p><?= mh_e($item['answer'] ?? null) ?></p></details><?php endforeach; ?></div>
  </div>
</section>
