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
    <div class="hero-image hero-scene"><svg class="scene" viewBox="0 0 600 520" role="img" aria-label="Databricks Brickbuilder Partner Network Bronze badge awarded to Mahathi Infotech, above layered Lakehouse data tiers" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <defs>
        <linearGradient id="dbx-lt" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#E3ECDF"/><stop offset="1" stop-color="#B7C9B1"/></linearGradient>
        <linearGradient id="dbx-lm" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#8FA587"/><stop offset="1" stop-color="#6E8467"/></linearGradient>
        <linearGradient id="dbx-lb" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#5E7357"/><stop offset="1" stop-color="#3D4D38"/></linearGradient>
        <filter id="dbx-blur" x="-20%" y="-50%" width="140%" height="200%"><feGaussianBlur stdDeviation="9"/></filter>
        <filter id="dbx-shadow" x="-20%" y="-20%" width="140%" height="150%"><feDropShadow dx="0" dy="14" stdDeviation="12" flood-color="#0F1A2A" flood-opacity=".18"/></filter>
      </defs>
      <g opacity=".55" stroke="#94A88C" stroke-opacity=".35" stroke-width="1" fill="none"><circle cx="330" cy="250" r="150"/><circle cx="330" cy="250" r="215"/><circle cx="330" cy="250" r="280"/></g>
      <ellipse cx="330" cy="478" rx="170" ry="22" fill="#0F1A2A" opacity=".22" filter="url(#dbx-blur)"/>
      <path d="M208 431 L330 391 L452 431 L330 471 Z" fill="url(#dbx-lb)"/>
      <path d="M208 431 L208 443 L330 483 L452 443 L452 431 L330 471 Z" fill="#2F3D2B"/>
      <path d="M208 403 L330 363 L452 403 L330 443 Z" fill="url(#dbx-lm)"/>
      <path d="M208 403 L208 415 L330 455 L452 415 L452 403 L330 443 Z" fill="#4F6149"/>
      <path d="M208 375 L330 335 L452 375 L330 415 Z" fill="url(#dbx-lt)" stroke="#fff" stroke-opacity=".7"/>
      <path d="M208 375 L208 387 L330 427 L452 387 L452 375 L330 415 Z" fill="#7A8E73"/>
      <ellipse cx="330" cy="372" rx="72" ry="13" fill="#0F1A2A" opacity=".3" filter="url(#dbx-blur)"/>
      <g transform="translate(185 30)" filter="url(#dbx-shadow)"><g class="badge-float">
      <?php if (!empty($badgeSrc) && file_exists(get_template_directory() . '/' . ltrim(str_replace('/assets/', 'assets/', $badgeSrc), '/'))) : // official badge artwork, when it has been added ?>
        <image href="<?= mh_asset_url($badgeSrc) ?>" xlink:href="<?= mh_asset_url($badgeSrc) ?>" x="0" y="0" width="290" height="288"/>
      <?php else : // drawn badge used until the official artwork is added ?>
        <defs>
          <linearGradient id="dbx-bz" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#E9B27A"/><stop offset=".55" stop-color="#B8733A"/><stop offset="1" stop-color="#8A5226"/></linearGradient>
          <linearGradient id="dbx-bz-face" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#F6D3A8"/><stop offset="1" stop-color="#D49455"/></linearGradient>
        </defs>
        <path d="M78 200 L128 228 L108 288 L84 262 L50 270 Z" fill="#C45A36"/>
        <path d="M212 200 L162 228 L182 288 L206 262 L240 270 Z" fill="#A84B2B"/>
        <circle cx="145" cy="128" r="122" fill="url(#dbx-bz)"/>
        <circle cx="145" cy="128" r="122" fill="none" stroke="#fff" stroke-opacity=".55" stroke-width="2"/>
        <circle cx="145" cy="128" r="104" fill="url(#dbx-bz-face)" stroke="#8A5226" stroke-opacity=".5" stroke-width="2"/>
        <g fill="#7A3F1B"><path d="M145 52 L173 66 L145 80 L117 66 Z"/><path d="M117 74 L145 88 L173 74 L173 80 L145 94 L117 80 Z" opacity=".75"/></g>
        <g font-family="Poppins,sans-serif" text-anchor="middle" fill="#5A3414">
          <text x="145" y="138" font-size="34" font-weight="900" letter-spacing="1">BRONZE</text>
          <text x="145" y="162" font-size="15" font-weight="700" letter-spacing="5">PARTNER</text>
          <line x1="95" y1="176" x2="195" y2="176" stroke="#7A3F1B" stroke-opacity=".5"/>
          <text x="145" y="194" font-size="10.5" font-weight="700" letter-spacing="1.5">DATABRICKS</text>
          <text x="145" y="208" font-size="8.5" font-weight="600" letter-spacing="1">BRICKBUILDER PARTNER NETWORK</text>
        </g>
      <?php endif; ?>
      </g></g>
    </svg></div>
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
