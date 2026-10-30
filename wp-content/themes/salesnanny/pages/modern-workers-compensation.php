<?php
/**
 * <app-modern-workers-compensation> — Workers' Compensation page.
 */
if (!defined('ABSPATH')) { exit; }
?>
<section class="hero" aria-labelledby="hero-heading">
  <div class="container-fluid px-4">
    <div class="hero-copy">
      <div class="hero-eyebrow">WORKERS' COMPENSATION</div>
      <h1 id="hero-heading">Workers' Compensation Claims Management Services</h1>
      <p class="hero-sub">Mahathi helps carriers, employers, self-insured organizations, TPAs, MGAs and PEOs manage workers' compensation across the policy and claims lifecycle, with technology, automation and insurance operations delivered together.</p>
      <div class="hero-cta"><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="btn btn-dark">Talk to a Workers' Comp expert</a><a class="btn btn-outline" href="#capabilities" data-mh-action="scrollToSection" data-mh-args="<?= esc_attr(wp_json_encode([null, 'capabilities'])) ?>">Explore capabilities</a></div>
    </div>
    <div class="hero-image"><img class="hero-photo" width="600" height="488" fetchpriority="high" decoding="async" src="<?= mh_asset_url($heroImageSrc) ?>" alt="<?= mh_a($heroImageAlt) ?>"></div>
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
    'numbersLabel' => 'Mahathi workers\' compensation capability, by the numbers',
    'capTitle' => 'Mahathi\'s Core Workers\' Compensation Capabilities',
    'capSub' => 'We pair insurance domain expertise with technology and business operations, so the system change and the operating change land together. We serve carriers, employers, self-insured organizations, TPAs, PEOs, MGAs and managed care teams.',
    'challengesEyebrow' => 'The Current State of Workers\' Comp',
    'challengesTitle' => 'Why workers\' compensation stays hard to manage.',
    'challengesIntro' => 'Carriers and employers both carry the cost of claims, but the information needed to manage them sits across portals, spreadsheets, vendor systems and email.',
    'solutionsTitle' => 'How Mahathi helps carriers, employers and TPAs respond.',
    'solutionsIntro' => 'Technology programs focus on systems and outsourcing programs focus on people. Workers\' compensation needs both working together, so Mahathi delivers them as one engagement.',
    'ctaTitle' => 'Speak to our Workers\' Compensation team',
    'ctaText' => 'Tell us which part of your program is hardest to manage: claims oversight, vendor coordination, billing exceptions, compliance reporting or the core system. We will come back with the questions needed to scope the work.',
    'ctaButton' => 'Talk to our Workers\' Comp team',
    'faqTitle' => 'Workers\' compensation, the questions carriers and employers actually ask.',
]);
?>
