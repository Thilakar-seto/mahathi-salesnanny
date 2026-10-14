<?php
/**
 * <app-blog> — /blog. Same layout as the company blog (blog.mahathiinfotech.com): topic/search bar,
 * "Featured Articles" (newest three), "Latest Articles" grid with load-more, and the newsletter strip —
 * in this site's header, footer, fonts and colours. Articles come from inc/blog.php (cached feed).
 * Filtering, search, load-more and the newsletter form are in assets/js/blog.js.
 */
if (!defined('ABSPATH')) { exit; }

$feed   = mh_blog_data();
$posts  = $feed['posts'];
$topics = $feed['topics'];
$total  = count($posts);
$topicNames = array();
foreach ($topics as $t) { $topicNames[$t['id']] = $t['name']; }
$featured = array_slice($posts, 0, 3);
$latest   = array_slice($posts, 3);
$perPage  = 9;

/** One article card. $variant: 'featured' | 'side' | 'std'. */
$mh_card = static function (array $p, string $variant, int $index = 0) use ($topicNames) {
    $cats  = array_map(static fn($id) => $topicNames[$id] ?? '', $p['cats']);
    $cats  = array_values(array_filter($cats));
    $label = $cats ? $cats[0] : 'Blog';
    $search = strtolower($p['title'] . ' ' . $p['excerpt'] . ' ' . $p['author'] . ' ' . implode(' ', $cats));
    ob_start(); ?>
    <article class="blog-card blog-card--<?= esc_attr($variant) ?>" data-cats="<?= esc_attr(implode(',', $p['cats'])) ?>" data-search="<?= esc_attr($search) ?>">
      <div class="blog-card__thumb">
        <span class="blog-card__cat"><?= esc_html($label) ?></span>
        <?php if (!empty($p['image']['src'])) : ?>
          <img src="<?= esc_url($p['image']['src']) ?>"<?php if (!empty($p['image']['srcset'])) : ?> srcset="<?= esc_attr($p['image']['srcset']) ?>" sizes="<?= $variant === 'featured' ? '(max-width: 991px) 100vw, 60vw' : '(max-width: 640px) 100vw, 33vw' ?>"<?php endif; ?> alt="<?= esc_attr($p['image']['alt'] ?: $p['title']) ?>" width="<?= (int) $p['image']['w'] ?>" height="<?= (int) $p['image']['h'] ?>" loading="<?= ($variant === 'featured' && $index === 0) ? 'eager' : 'lazy' ?>" decoding="async">
        <?php endif; ?>
      </div>
      <div class="blog-card__body">
        <h3 class="blog-card__title"><a href="<?= esc_url($p['url']) ?>" target="_blank" rel="noopener noreferrer"><?= esc_html($p['title']) ?><span class="blog-sr"> (opens in a new tab)</span></a></h3>
        <?php if ($variant !== 'side' && $p['excerpt'] !== '') : ?><p class="blog-card__excerpt"><?= esc_html($p['excerpt']) ?></p><?php endif; ?>
        <div class="blog-card__meta">
          <?php if ($p['avatar']) : ?>
            <img class="blog-card__avatar" src="<?= esc_url($p['avatar']) ?>" alt="" width="32" height="32" loading="lazy" decoding="async">
          <?php else : ?>
            <span class="blog-card__avatar blog-card__avatar--initials" aria-hidden="true"><?= esc_html(mh_blog_initials($p['author'])) ?></span>
          <?php endif; ?>
          <div class="blog-card__meta-text">
            <?php if ($p['author']) : ?><span class="blog-card__author"><?= esc_html($p['author']) ?></span><?php endif; ?>
            <span class="blog-card__stats"><i class="fa-regular fa-clock" aria-hidden="true"></i> <?= (int) $p['readMin'] ?> min read</span>
          </div>
        </div>
      </div>
    </article>
    <?php
    return ob_get_clean();
};
?>
<section class="blog-bar" aria-label="Browse articles">
  <div class="blog-wrap blog-bar__inner">
    <nav class="blog-chips" id="blogChips" aria-label="Filter articles by topic">
      <button type="button" class="blog-chip is-active" data-topic="all" aria-pressed="true">All Topics <span class="blog-chip__count"><?= (int) $total ?></span></button>
      <?php foreach (mh_blog_topics($feed) as $t) : ?>
        <button type="button" class="blog-chip" data-topic="<?= (int) $t['id'] ?>" data-topic-name="<?= esc_attr($t['name']) ?>" aria-pressed="false"><?= esc_html($t['name']) ?><?php if ($t['count'] > 0) : ?> <span class="blog-chip__count"><?= (int) $t['count'] ?></span><?php endif; ?></button>
      <?php endforeach; ?>
    </nav>
    <label class="blog-search">
      <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
      <span class="blog-sr">Search articles</span>
      <input type="search" id="blogSearch" placeholder="Search articles…" autocomplete="off">
    </label>
  </div>
</section>

<section class="blog-main" id="blogResults" aria-live="polite">
  <div class="blog-wrap">
    <?php if (!$posts) : ?>
      <div class="blog-empty">
        <h2>Articles are on their way</h2>
        <p>We couldn’t load the latest articles just now. Please check back in a moment, or read them on our blog.</p>
        <a class="blog-btn" href="<?= esc_url(MH_BLOG_ORIGIN . '/') ?>" target="_blank" rel="noopener noreferrer">Visit the Mahathi blog</a>
      </div>
    <?php else : ?>
      <div data-blog-default>
        <div class="blog-label"><div><span class="blog-eyebrow">01 — Featured Insights</span><h2>Featured Articles</h2></div><div class="blog-label__line"></div></div>
        <div class="blog-featured">
          <?php foreach ($featured as $i => $p) {
              if ($i === 0) { echo $mh_card($p, 'featured', 0); }
          } ?>
          <?php if (count($featured) > 1) : ?>
            <div class="blog-featured__side">
              <?php foreach ($featured as $i => $p) { if ($i > 0) { echo $mh_card($p, 'side', $i); } } ?>
            </div>
          <?php endif; ?>
        </div>

        <?php if ($latest) : ?>
          <div class="blog-label blog-label--latest"><div><span class="blog-eyebrow">02 — Latest Insights</span><h2>Latest Articles</h2></div><div class="blog-label__line"></div></div>
          <div class="blog-grid" id="blogLatest" data-per-page="<?= (int) $perPage ?>">
            <?php foreach ($latest as $i => $p) { echo $mh_card($p, 'std', $i); } ?>
          </div>
          <?php if (count($latest) > $perPage) : ?>
            <div class="blog-more"><button type="button" class="blog-btn blog-btn--ghost" id="blogMore"><i class="fa-solid fa-arrow-down" aria-hidden="true"></i> Load more articles</button></div>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <div data-blog-results hidden>
        <div class="blog-label"><div><span class="blog-eyebrow" data-blog-results-count></span><h2 data-blog-results-title>Results</h2></div><div class="blog-label__line"></div><button type="button" class="blog-clear" id="blogClear"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Clear filter</button></div>
        <div class="blog-grid" id="blogResultsGrid">
          <?php foreach ($posts as $i => $p) { echo $mh_card($p, 'std', $i); } ?>
        </div>
        <div class="blog-empty" data-blog-none hidden>
          <h3 data-blog-none-title>No articles found</h3>
          <p data-blog-none-text>Try a different search or topic. In the meantime, browse everything we have published.</p>
          <button type="button" class="blog-btn" data-blog-clear-all>View all articles</button>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="blog-nl" aria-labelledby="blogNlTitle">
  <div class="blog-wrap blog-nl__inner">
    <div class="blog-nl__copy">
      <span class="blog-nl__eyebrow">Stay Informed</span>
      <h2 id="blogNlTitle">Intelligence,<br>Delivered.</h2>
      <p>Get the latest insurance-tech insights, growth tactics, and industry analysis delivered to your inbox every week.</p>
    </div>
    <form class="blog-nl__form" id="blogNlForm" novalidate data-ajax="<?= esc_url(admin_url('admin-ajax.php')) ?>" data-nonce="<?= esc_attr(wp_create_nonce('mh_blog_subscribe')) ?>">
      <label class="blog-sr" for="blogNlEmail">Your email address</label>
      <input type="email" id="blogNlEmail" name="email" placeholder="Your email address" autocomplete="email" required>
      <input type="text" name="website" value="" tabindex="-1" autocomplete="off" aria-hidden="true" class="blog-hp">
      <button type="submit" class="blog-btn blog-btn--light">Subscribe <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
      <p class="blog-nl__msg" role="status" aria-live="polite" hidden></p>
    </form>
  </div>
</section>
