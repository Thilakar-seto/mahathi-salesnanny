<?php
/**
 * <app-faq-page> — converted from src/app/pages/faq/faq-page/faq-page.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<main class="faq-page" id="faq-main"><section class="faq-hero" aria-labelledby="faq-h1">
    <div class="faq-container">
      <p class="faq-hero__eyebrow"> Knowledge Base </p>
      <h1 class="faq-hero__title" id="faq-h1"> Mahathi Frequently Asked Questions </h1>
      <p class="faq-hero__subtitle"> Expert answers on insurance technology, Guidewire, healthcare IT, AI enablement, and modernization services. </p>
    </div>
  </section><nav class="faq-jump-nav" aria-label="Jump to FAQ category">
    <div class="faq-container">
      <ul class="faq-jump-nav__list" role="list">
        <?php foreach (mh_list($sections) as $section) : ?>
          <li><a class="faq-jump-nav__link" href="javascript:void(0)" data-mh-action="scrollToSection" data-mh-args="<?= esc_attr(wp_json_encode([($section['slug'] ?? null)])) ?>"> <?= mh_e($section['category'] ?? null) ?> </a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav><div class="faq-content">
    <div class="faq-container">
      <?php foreach (mh_list($sections) as $section) : ?>
        <section class="faq-section" id="<?= mh_a(('faq-section-' . ($section['slug'] ?? null))) ?>" aria-labelledby="<?= mh_a(('faq-section-heading-' . ($section['slug'] ?? null))) ?>"><h2 class="faq-section__heading" id="<?= mh_a(('faq-section-heading-' . ($section['slug'] ?? null))) ?>"> <?= mh_e($section['category'] ?? null) ?> <span class="faq-section__count"> (<?= mh_e(mh_length(($section['items'] ?? null))) ?>) </span></h2><?php foreach (mh_list($section['items'] ?? null) as $item) : ?><app-faq-accordion><?php mh_component('faq-accordion', ['item' => $item]); ?></app-faq-accordion><?php endforeach; ?><div class="faq-section__cta"><a href="<?= esc_url(mh_link(($section['ctaRoute'] ?? null))) ?>" class="faq-section__cta-link"> Explore our <?= mh_e($section['category'] ?? null) ?> services → </a></div></section>
      <?php endforeach; ?>
    </div>
  </div><section class="faq-bottom-cta" aria-labelledby="faq-cta-heading">
    <div class="faq-container faq-bottom-cta__inner"><h2 class="faq-bottom-cta__heading" id="faq-cta-heading"> Have a specific insurance, healthcare, Guidewire, AI, or modernization challenge? </h2><p class="faq-bottom-cta__text"> Talk to Mahathi about how we can help improve operations, extend platforms, deploy practical AI, and accelerate business outcomes. </p><button class="faq-bottom-cta__btn" type="button" data-mh-action="open-contact"> Contact Us </button></div>
  </section><?php if ($isContactPopupOpen) : ?><app-contact-popup><?php mh_component('contact-popup', []); ?></app-contact-popup><?php endif; ?></main>
