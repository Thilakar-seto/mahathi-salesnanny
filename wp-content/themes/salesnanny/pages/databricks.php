<?php
/**
 * <app-databricks> — Databricks implementation page.
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="hero" aria-labelledby="hero-heading">
  <div class="container-fluid px-4">
    <div class="hero-copy">
      <div class="hero-eyebrow">DATABRICKS BRONZE PARTNER</div>
      <h1 id="hero-heading">Databricks Implementation for Insurance Carriers, TPAs and Payers</h1>
      <p class="hero-sub">Mahathi is a Databricks Bronze partner. We help P&amp;C carriers, MGAs, TPAs and healthcare payers bring claims, policy and member data onto one governed Lakehouse, migrate without stopping daily operations, and apply AI to claims and underwriting.</p>
      <div class="hero-cta"><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="btn btn-dark">Talk to a Databricks expert</a><a class="btn btn-outline" href="#capabilities" data-mh-action="scrollToSection" data-mh-args="<?= esc_attr(wp_json_encode([null, 'capabilities'])) ?>">Explore capabilities</a></div>
    </div>
    <div class="hero-image"><img class="hero-photo" width="600" height="520" fetchpriority="high" decoding="async" src="<?= mh_asset_url($heroImageSrc) ?>" alt="<?= mh_a($heroImageAlt) ?>"><img class="hero-badge" width="130" height="129" decoding="async" src="<?= mh_asset_url($badgeSrc) ?>" alt="Databricks Brickbuilder Partner Network Bronze partner badge"></div>
  </div>
</section>
<?php
mh_component('service-sections', [
    'stats' => $stats,
    'pills' => $pills,
    'capabilities' => $capabilities,
    'challenges' => $challenges,
    'solutions' => $solutions,
    'faqs' => $faqs,
    'numbersLabel' => 'Mahathi Databricks capability, by the numbers',
    'capTitle' => 'Mahathi\'s Core Databricks Capabilities',
    'capSub' => 'From the first Lakehouse release to day-to-day operations, Mahathi pairs Databricks engineers with insurance practitioners who know claims, policy and billing data.',
    'challengesEyebrow' => 'The Current State of Insurance Data',
    'challengesTitle' => 'Why insurance data programs stall before AI delivers value.',
    'challengesIntro' => 'Carriers and payers already own the data they need. The problem is where it sits, how old it is, and whether anyone can prove who used it.',
    'solutionsTitle' => 'How Mahathi helps insurers respond to these data challenges.',
    'solutionsIntro' => 'Each challenge has a practical response. Mahathi pairs its Databricks partnership with insurance practitioners and Guidewire delivery experience, so the Lakehouse reflects how carriers actually work.',
    'ctaTitle' => 'Speak to our Databricks team',
    'ctaText' => 'Tell us which data problem is slowing claims or underwriting. We will come back with the questions needed to scope the work.',
    'ctaButton' => 'Talk to our Databricks team',
    'faqTitle' => 'Databricks for insurance, the questions carriers actually ask.',
]);
?>
