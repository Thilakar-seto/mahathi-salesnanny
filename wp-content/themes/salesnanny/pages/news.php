<?php
/**
 * <app-news> — converted from src/app/pages/news/news.component.html
 *
 * Newsroom layout: filterable story list + sticky sidebar. Stories come from inc/data/news.php;
 * filters, "full story" toggles and image sliders are wired up in assets/js/mahathi.js.
 */
if (!defined('ABSPATH')) { exit; }
$sectionKeys = array_keys(mh_list($newsSections));
$activeSection = $sectionKeys[0] ?? 'mahathi';
$sectionCounts = array_fill_keys($sectionKeys, 0);
foreach (mh_list($newsItems) as $item) {
    $key = $item['section'] ?? $activeSection;
    $sectionCounts[$key] = ($sectionCounts[$key] ?? 0) + 1;
}
?>
<app-newsbanner><?php mh_component('newsbanner', ['pageData' => $healthcareData]); ?></app-newsbanner>
<section class="newsroom" aria-labelledby="newsroom-heading">
  <div class="newsroom__inner">
    <header class="newsroom__head">
      <div>
        <nav class="newsroom__crumbs" aria-label="Breadcrumb"><a href="<?= esc_url(mh_url('/')) ?>">Home</a><i class="fa-solid fa-chevron-right" aria-hidden="true"></i><span aria-current="page">News</span></nav>
        <h2 class="newsroom__title" id="newsroom-heading">Newsroom</h2>
        <p class="newsroom__intro">Announcements, recognition, and moments from the Mahathi team and the communities we serve.</p>
      </div>
    </header>

    <div class="newsroom__layout">
      <div class="newsroom__main">
        <div class="news-tabs" role="group" aria-label="Choose a news section">
          <?php foreach (mh_list($newsSections) as $key => $section) : $on = $key === $activeSection; ?>
            <button type="button" class="news-tab<?= $on ? ' is-active' : '' ?>" aria-pressed="<?= $on ? 'true' : 'false' ?>" data-mh-action="news-filter" data-mh-args="<?= esc_attr(wp_json_encode([$key])) ?>"><i class="<?= mh_a($section['icon'] ?? '') ?>" aria-hidden="true"></i><span class="news-tab__label"><?= mh_e($section['label'] ?? '') ?></span><span class="news-tab__count" aria-label="<?= (int) ($sectionCounts[$key] ?? 0) ?> stories"><?= (int) ($sectionCounts[$key] ?? 0) ?></span></button>
          <?php endforeach; ?>
        </div>

        <div class="news-list">
          <?php foreach (mh_list($newsItems) as $i => $item) :
            $images = mh_list($item['images'] ?? null);
            $isSlider = count($images) > 1;
            $fitClass = ($item['fit'] ?? '') === 'contain' ? ' news-media--contain' : '';
            $titleId = 'news-title-' . $i;
            $moreId = 'news-more-' . $i;
            $time = strtotime($item['date'] ?? '');
            $section = $item['section'] ?? $activeSection;
            $classes = 'news-item' . (!empty($item['featured']) ? ' news-item--featured' : '') . ($images ? '' : ' news-item--text');
          ?>
            <article class="<?= $classes ?>" data-section="<?= mh_a($section) ?>" aria-labelledby="<?= $titleId ?>"<?= $section !== $activeSection ? ' hidden' : '' ?>>
              <?php if ($images) : ?>
              <div class="news-media<?= $fitClass ?>"<?php if ($fitClass) : ?> style="--news-backdrop: url('<?= mh_asset_url($images[0]) ?>');"<?php endif; ?>>
                <?php if ($isSlider) : ?>
                  <div class="news-slider" role="region" aria-roledescription="carousel" aria-label="<?= mh_a(($item['alt'] ?? '') . ' — photo gallery') ?>">
                    <div class="news-slider__track">
                      <?php foreach ($images as $n => $img) : ?>
                        <img src="<?= mh_asset_url($img) ?>" alt="<?= mh_a(($item['alt'] ?? '') . ' (photo ' . ($n + 1) . ' of ' . count($images) . ')') ?>" loading="lazy" decoding="async">
                      <?php endforeach; ?>
                    </div>
                    <button type="button" class="news-slider__nav news-slider__nav--prev" aria-label="Previous photo" data-mh-action="news-slide" data-mh-args="[-1]"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
                    <button type="button" class="news-slider__nav news-slider__nav--next" aria-label="Next photo" data-mh-action="news-slide" data-mh-args="[1]"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
                    <div class="news-slider__dots">
                      <?php foreach ($images as $n => $img) : ?>
                        <button type="button" class="news-slider__dot<?= $n === 0 ? ' is-active' : '' ?>" aria-label="Show photo <?= $n + 1 ?>" data-mh-action="news-slide-to" data-mh-args="<?= esc_attr(wp_json_encode([$n])) ?>"></button>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php else : ?>
                  <img src="<?= mh_asset_url($images[0]) ?>" alt="<?= mh_a($item['alt'] ?? '') ?>" loading="<?= $i === 0 ? 'eager' : 'lazy' ?>" decoding="async">
                <?php endif; ?>
              </div>
              <?php endif; ?>

              <div class="news-body">
                <div class="news-body__top">
                  <span class="news-tag news-tag--<?= mh_a($item['category'] ?? '') ?>"><?= mh_e($item['label'] ?? '') ?></span>
                  <?php if (!empty($item['featured'])) : ?><span class="news-latest">Latest</span><?php endif; ?>
                </div>
                <h3 class="news-title" id="<?= $titleId ?>"><a href="<?= esc_url($item['url'] ?? '') ?>" target="_blank" rel="noopener noreferrer"><?= mh_e($item['title'] ?? '') ?></a></h3>
                <ul class="news-meta">
                  <li><i class="<?= mh_a($item['sourceIcon'] ?? '') ?>" aria-hidden="true"></i><?= mh_e($item['source'] ?? '') ?></li>
                  <?php if ($time) : ?><li><i class="fa-regular fa-calendar" aria-hidden="true"></i><time datetime="<?= mh_a(gmdate('Y-m-d', $time)) ?>"><?= mh_e(gmdate('F j, Y', $time)) ?></time></li><?php endif; ?>
                </ul>
                <p class="news-excerpt"><?= mh_e($item['excerpt'] ?? '') ?></p>
                <?php if (mh_list($item['body'] ?? null)) : ?>
                  <div class="news-more" id="<?= $moreId ?>">
                    <div class="news-more__inner">
                      <?php foreach (mh_list($item['body']) as $para) : ?><p><?= mh_e($para) ?></p><?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="news-actions">
                  <?php if (mh_list($item['body'] ?? null)) : ?>
                    <button type="button" class="news-toggle" aria-expanded="false" aria-controls="<?= $moreId ?>" data-mh-action="news-toggle"><span data-news-toggle-label>Read full story</span><i class="fa-solid fa-chevron-down" aria-hidden="true"></i></button>
                  <?php endif; ?>
                  <a class="news-link" href="<?= esc_url($item['url'] ?? '') ?>" target="_blank" rel="noopener noreferrer"><?= mh_e($item['linkText'] ?? 'Read more') ?><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i><span class="news-sr"> (opens in a new tab)</span></a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
        <?php foreach (mh_list($newsSections) as $key => $section) : if (!empty($sectionCounts[$key])) { continue; } $empty = $newsEmpty[$key] ?? []; ?>
          <div class="news-empty" data-section="<?= mh_a($key) ?>"<?= $key !== $activeSection ? ' hidden' : '' ?>>
            <span class="news-empty__icon"><i class="<?= mh_a($section['icon'] ?? 'fa-regular fa-newspaper') ?>" aria-hidden="true"></i></span>
            <h3 class="news-empty__title"><?= mh_e($empty['title'] ?? 'Stories coming soon') ?></h3>
            <p class="news-empty__text"><?= mh_e($empty['text'] ?? 'Check back soon for the latest updates.') ?></p>
            <a class="news-empty__link" href="https://blog.mahathiinfotech.com/" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-book-open" aria-hidden="true"></i>Visit the Mahathi blog<span class="news-sr"> (opens in a new tab)</span></a>
          </div>
        <?php endforeach; ?>
      </div>

      <aside class="newsroom__aside" aria-label="About Mahathi">
        <div class="aside-card aside-card--brand">
          <img class="aside-card__logo" src="<?= mh_asset_url('images/mahathi_logo2.png') ?>" alt="Mahathi Infotech" width="168" height="57" loading="lazy">
          <p>Technology, AI, and operations partner to P&amp;C insurers, healthcare payers, MGAs, and TPAs — modernizing platforms and delivering measurable outcomes.</p>
          <button type="button" class="aside-card__cta" data-mh-action="open-contact">Connect With Us</button>
          <div class="aside-card__follow">
            <span>Follow us for more updates</span>
            <a class="aside-card__social" href="<?= esc_url($newsLinkedinUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="Mahathi Infotech on LinkedIn (opens in a new tab)"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
