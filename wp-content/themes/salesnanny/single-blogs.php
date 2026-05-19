<?php get_header(); ?>

<!--
  ╔══════════════════════════════════════════════════════════════╗
  ║   MAHATHI INFOTECH — OFFICIAL BRAND GUIDELINES APPLIED      ║
  ║   Source: mahathi-brand-guidelines.html (2025 Edition)      ║
  ║                                                              ║
  ║   COLORS                                                     ║
  ║   --forest  #253830  Primary BG · Headlines · Sidebar       ║
  ║   --forest2 #1e2e27  Dark variant                           ║
  ║   --sage    #76A379  Brand Accent · Logo · Active Nav       ║
  ║   --sage2   #6F8077  Muted text · Descriptions              ║
  ║   --mint    #B2C7B3  Borders · Labels · Support             ║
  ║   --pink    #B88794  Highlights · Partner Marks             ║
  ║   --gold    #D2A974  Callouts · Premium · Nav Active        ║
  ║   --cream   #EEF0EC  Page BG · Cards · Inputs               ║
  ║   --cream2  #E4E6E2  Subtle borders                         ║
  ║                                                              ║
  ║   FONTS                                                      ║
  ║   Bebas Neue → Display / Hero / Section Titles              ║
  ║   DM Sans    → Body / Card Headlines / Descriptions         ║
  ║   DM Mono    → Labels / Metadata / Tags / Captions          ║
  ╚══════════════════════════════════════════════════════════════╝
-->

<!-- Mahathi Official Brand Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
  /* ═══════════════════════════════════════════════════════
     MAHATHI BRAND TOKENS — exact from brand guidelines
  ═══════════════════════════════════════════════════════ */
  :root {
    --forest:        #253830;
    --forest2:       #1e2e27;
    --sage:          #76A379;
    --sage2:         #6F8077;
    --mint:          #B2C7B3;
    --pink:          #B88794;
    --gold:          #D2A974;
    --cream:         #EEF0EC;
    --cream2:        #E4E6E2;
    --white:         #ffffff;

    --gradient-hero:    linear-gradient(135deg, var(--forest2) 0%, var(--forest) 55%, #2d4840 100%);
    --gradient-stripe:  linear-gradient(90deg, var(--gold) 0%, var(--pink) 35%, var(--sage) 70%, var(--forest) 100%);
    --gradient-divider: linear-gradient(90deg, var(--gold), var(--pink));
    --gradient-card:    linear-gradient(135deg, var(--cream) 0%, var(--white) 100%);

    --font-display: 'Bebas Neue', sans-serif;
    --font-body:    'DM Sans', sans-serif;
    --font-mono:    'DM Mono', monospace;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background: var(--cream);
    color: var(--forest);
    line-height: 1.7;
    overflow-x: hidden;
    font-family: var(--font-body);
  }

  a { text-decoration: none; color: inherit; }
  strong { font-weight: 700; color: var(--forest); }
  p strong { color: var(--forest); }
  .wp-block-separator { display: none; }

  /* ═══════════════════════════════════════════
     1. HERO
  ════════════════════════════════════════════ */
  .hero-immersive {
    position: relative;
    padding: 200px 5% 60px;
    background: var(--gradient-hero);
    text-align: center;
    overflow: hidden;
  }

  /* Brand top stripe */
  .hero-immersive::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 4px;
    background: var(--gradient-stripe);
    z-index: 10;
  }

  /* Sage radial glow */
  .hero-immersive::after {
    content: '';
    position: absolute;
    top: -120px; right: -100px;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(118,163,121,0.08) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .hero-content-wrap {
    position: relative;
    z-index: 2;
    max-width: 900px;
    margin: 0 auto;
  }

  .hero-breadcrumb {
    display: flex;
    gap: 12px;
    align-items: center;
    justify-content: center;
    font-family: var(--font-mono);
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(238,240,236,0.5);
    margin-bottom: 24px;
  }

  .hero-breadcrumb a { color: rgba(238,240,236,0.82); transition: color 0.2s; }
  .hero-breadcrumb a:hover { color: var(--gold); }
  .hero-breadcrumb span {
    color: rgba(238,240,236,0.3);
    max-width: 20ch;
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Bebas Neue display */
  .hero-title {
    font-family: var(--font-display);
    font-size: clamp(2.8rem, 5.5vw, 4.8rem);
    font-weight: 400;
    letter-spacing: 1.5px;
    color: var(--cream);
    line-height: 1.0;
    margin-bottom: 28px;
  }

  .hero-meta {
    display: flex;
    gap: 28px;
    flex-wrap: wrap;
    justify-content: center;
    font-family: var(--font-mono);
    font-size: 10px;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: rgba(238,240,236,0.55);
  }

  .hero-meta-item { display: flex; align-items: center; gap: 8px; margin-bottom: 30px; }
  .hero-meta-item i { color: var(--gold); font-size: 13px; }

  .hero-featured-image {
    max-width: 1200px;
    margin: 0 auto -400px;
    padding: 0 5%;
    position: relative;
    z-index: 3;
  }

  .hero-featured-image img {
    width: 100%;
    height: auto;
    max-height: 600px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 0 0 3px var(--sage), 0 24px 60px rgba(37,56,48,0.40);
  }

  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40%  { transform: translateX(-50%) translateY(-10px); }
    60%  { transform: translateX(-50%) translateY(-5px); }
  }

  /* ═══════════════════════════════════════════
     2. FLOATING TOOLBAR
  ════════════════════════════════════════════ */
  .floating-toolbar {
    position: fixed;
    left: 50%;
    transform: translateX(-50%);
    bottom: 20px;
    z-index: 100;
    background: rgba(255,255,255,0.97);
    backdrop-filter: blur(12px);
    padding: 8px 20px;
    border-radius: 50px;
    box-shadow: 0 10px 40px rgba(37,56,48,0.16), 0 4px 16px rgba(0,0,0,0.06);
    border: 1.5px solid rgba(118,163,121,0.28);
    display: flex;
    gap: 16px;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .floating-toolbar.visible { opacity: 1; }

  .toolbar-item {
    width: 40px; height: 40px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--sage2);
    background: transparent;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
    font-size: 15px;
  }

  .toolbar-item:hover { background: var(--forest); color: var(--cream); transform: translateY(-2px); }

  .toolbar-divider { width: 1px; height: 24px; background: var(--cream2); }

  .toolbar-item.back-top {
    background: var(--forest);
    padding: 0 50px;
    border-radius: 16px;
    margin: 0 -12px 0 0;
    color: var(--cream);
    font-family: var(--font-mono);
    font-size: 11px;
    letter-spacing: 1px;
  }

  .toolbar-item.back-top:hover { background: var(--sage); color: var(--forest); }

  /* ═══════════════════════════════════════════
     3. ARTICLE CONTENT
  ════════════════════════════════════════════ */
  .article-container {
    max-width: 1200px;
    margin: 400px auto 0;
    padding: 0 5%;
  }

  /* Audio player — cream card */
  .audio-player {
    background: var(--gradient-card);
    border-radius: 10px;
    padding: 24px 30px;
    margin-bottom: 50px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid var(--cream2);
    box-shadow: 0 4px 20px rgba(37,56,48,0.06);
  }

  .audio-icon {
    width: 56px; height: 56px;
    border-radius: 50%;
    background: var(--forest);
    display: flex; align-items: center; justify-content: center;
    color: var(--cream);
    font-size: 18px;
    cursor: pointer;
    transition: all 0.2s;
    flex-shrink: 0;
  }

  .audio-icon:hover  { background: var(--sage); color: var(--forest); transform: scale(1.05); }
  .audio-icon.playing { background: var(--sage); color: var(--forest); }

  @keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(118,163,121,0.7); }
    50%       { box-shadow: 0 0 0 15px rgba(118,163,121,0); }
  }

  .audio-details h4 {
    font-family: var(--font-body);
    font-size: 15px; font-weight: 700;
    color: var(--forest); margin-bottom: 4px;
  }

  .audio-details p {
    font-family: var(--font-mono);
    font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
    color: var(--sage2); margin: 0;
  }

  /* Article body — DM Sans */
  .article-content {
    font-family: var(--font-body);
    font-size: 16px; font-weight: 400;
    line-height: 1.85;
    color: #2c3a32;
    letter-spacing: 0.1px;
  }

  .article-content p { margin-bottom: 16px; line-height: 1.8; }

  /* H2 — Bebas Neue, forest, gold-pink divider underline */
  .article-content h2 {
    font-family: var(--font-display);
    font-size: 2.5rem; font-weight: 400;
    letter-spacing: 1px;
    color: var(--forest);
    margin: 48px 0 14px;
    line-height: 1.0;
    position: relative;
    padding-bottom: 16px;
  }

  .article-content h2::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 40px; height: 3px;
    background: var(--gradient-divider);
    border-radius: 2px;
  }

  /* H3 — DM Sans 700, sage left border */
  .article-content h3 {
    font-family: var(--font-body);
    font-size: 20px; font-weight: 700;
    color: var(--forest);
    margin: 32px 0 10px;
    line-height: 1.3;
    padding-left: 14px;
    border-left: 3px solid var(--sage);
  }

  /* H4 — DM Sans 600, gold-warm */
  .article-content h4 {
    font-family: var(--font-body);
    font-size: 17px; font-weight: 600;
    color: #7a5a20;
    margin: 24px 0 10px;
    line-height: 1.35;
  }

  .article-content ul, .article-content ol { margin: 24px 0; padding-left: 30px; }
  .article-content li { padding-left: 8px; }
  .article-content li::marker { color: var(--sage); }

  /* Blockquote — forest bg, gold border (brand statement block) */
  .article-content blockquote {
    margin: 40px 0;
    padding: 28px 36px;
    background: var(--forest);
    border-left: 5px solid var(--gold);
    border-radius: 0 10px 10px 0;
    font-family: var(--font-display);
    font-size: 1.75rem;
    letter-spacing: 0.5px;
    color: var(--cream);
    line-height: 1.25;
    position: relative;
    overflow: hidden;
  }

  .article-content blockquote::before {
    content: '';
    position: absolute; top: -40px; right: -40px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(118,163,121,0.1) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
  }

  .article-content img {
    width: 100%; height: auto;
    border-radius: 10px; margin: 40px 0;
    box-shadow: 0 10px 40px rgba(37,56,48,0.1);
  }

  /* Links — sage */
  .article-content a {
    color: var(--sage);
    font-weight: 600;
    text-decoration: underline;
    text-decoration-color: rgba(118,163,121,0.4);
    text-underline-offset: 3px;
    transition: all 0.2s;
  }

  .article-content a:hover { color: var(--forest); text-decoration-color: var(--forest); }

  .article-content code {
    font-family: var(--font-mono);
    font-size: 13px;
    background: var(--cream);
    color: var(--forest);
    padding: 2px 8px;
    border-radius: 4px;
    border: 1px solid var(--cream2);
  }

  /* ═══════════════════════════════════════════
     4. AUTHOR CARD
  ════════════════════════════════════════════ */
  .author-section {
    margin: 40px 0 50px;
    padding: 24px;
    background: var(--white);
    border-radius: 10px;
    border: 1px solid var(--cream2);
    display: flex;
    gap: 24px;
    align-items: center;
    box-shadow: 0 4px 20px rgba(37,56,48,0.06);
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .author-section:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(37,56,48,0.1); }

  .author-avatar {
    width: 90px; height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--sage);
    box-shadow: 0 4px 12px rgba(37,56,48,0.15);
    flex-shrink: 0;
  }

  .author-details h3 {
    font-family: var(--font-body);
    font-size: 20px; font-weight: 700;
    color: var(--forest); margin-bottom: 6px;
  }

  /* Role — DM Mono tag style */
  .author-role {
    display: inline-block;
    font-family: var(--font-mono);
    font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
    color: var(--sage2);
    background: var(--cream);
    padding: 3px 10px; border-radius: 20px;
    margin-bottom: 12px;
  }

  .author-bio {
    font-family: var(--font-body);
    font-size: 14px; color: var(--sage2); line-height: 1.72; margin: 0;
  }

  /* ═══════════════════════════════════════════
     5. RELATED POSTS
  ════════════════════════════════════════════ */
  .related-section { background: var(--cream); padding: 0 0 60px; }

  .related-container { max-width: 1400px; margin: 0 auto; padding: 0 5%; }

  .related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 24px;
  }

  .related-card {
    background: var(--white);
    border-radius: 10px; overflow: hidden;
    box-shadow: 0 4px 20px rgba(37,56,48,0.06);
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid var(--cream2);
  }

  .related-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 32px rgba(37,56,48,0.12);
    border-color: rgba(118,163,121,0.35);
  }

  .related-card-image { position: relative; height: 220px; overflow: hidden; }
  .related-card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
  .related-card:hover .related-card-image img { transform: scale(1.06); }

  .related-card-body { padding: 24px; }

  .related-card-date {
    font-family: var(--font-mono);
    font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
    color: var(--sage2); margin-bottom: 10px;
    display: flex; align-items: center; gap: 6px;
  }

  .related-card-title {
    font-family: var(--font-body);
    font-size: 18px; font-weight: 700;
    color: var(--forest); margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .related-card-title a { transition: color 0.2s; }
  .related-card:hover .related-card-title a { color: var(--sage); }

  .related-card-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-family: var(--font-body);
    font-size: 13px; font-weight: 600;
    color: var(--sage); margin-top: 12px;
    transition: color 0.2s;
  }

  .related-card-link:hover { color: var(--forest); }
  .related-card:hover .related-card-link i { transform: translateX(4px); transition: transform 0.2s; }

  /* ═══════════════════════════════════════════
     6. SHARED SECTION HEADER
  ════════════════════════════════════════════ */
  .faq-header-wrapper {
    text-align: center; margin-bottom: 40px;
    display: flex; flex-direction: column; align-items: center;
  }

  .section-eyebrow {
    font-family: var(--font-mono);
    font-size: 10px; letter-spacing: 5px; text-transform: uppercase;
    color: var(--gold); margin-bottom: 8px;
  }

  /* Bebas Neue section title */
  .faq-title-group {
    font-family: var(--font-display);
    font-size: 3rem; font-weight: 400;
    letter-spacing: 1px; line-height: 1;
    color: var(--forest);
    display: flex; align-items: center;
    justify-content: center; gap: 16px; margin: 0;
  }

  .faq-title-icon { font-size: 26px; color: var(--sage); }

  /* Gold–pink gradient divider */
  .faq-title-underline {
    height: 3px; width: 48px;
    background: var(--gradient-divider);
    margin-top: 14px; border-radius: 2px;
  }

  /* ═══════════════════════════════════════════
     7. FAQ
  ════════════════════════════════════════════ */
  .modern-faq-section {
    padding: 0 20px 40px;
    background: var(--white);
    display: flex; justify-content: center;
  }

  .modern-faq-container { width: 100%; max-width: 900px; }

  .faq-list-wrapper { display: flex; flex-direction: column; }

  .faq-list-item { border-bottom: 1px solid var(--cream2); padding: 18px 0; }
  .faq-list-item:first-child { border-top: 1px solid var(--cream2); }

  .faq-trigger-btn {
    width: 100%; background: transparent; border: none; padding: 0;
    display: grid; grid-template-columns: 40px 1fr 36px;
    gap: 10px; align-items: start; text-align: left; cursor: pointer;
  }

  /* Bebas Neue number, gold */
  .faq-number-indicator {
    font-family: var(--font-display);
    font-size: 26px; font-weight: 400;
    color: var(--gold); line-height: 1.4; letter-spacing: 0.5px;
  }

  /* DM Sans 600, forest */
  .faq-question-label {
    font-family: var(--font-body);
    font-size: 17px; font-weight: 600;
    color: var(--forest); line-height: 1.45; padding-top: 5px;
  }

  .faq-toggle-box {
    width: 36px; height: 36px;
    border: 1.5px solid var(--cream2); border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    color: var(--sage2); font-size: 13px;
    transition: all 0.2s; background: var(--white);
  }

  .faq-trigger-btn:hover .faq-toggle-box {
    border-color: var(--sage); color: var(--sage);
    background: rgba(118,163,121,0.06);
  }

  .faq-answer-wrapper {
    display: grid; grid-template-rows: 0fr;
    transition: grid-template-rows 0.3s ease-in-out;
  }

  .faq-list-item.is-open .faq-answer-wrapper { grid-template-rows: 1fr; }
  .faq-answer-inner { overflow: hidden; }

  /* DM Sans body, sage2 muted */
  .faq-answer-content {
    padding: 20px 64px 0 64px; margin: 0;
    font-family: var(--font-body);
    font-size: 15px; color: var(--sage2); line-height: 1.78;
  }

  /* ═══════════════════════════════════════════
     8. RESPONSIVE
  ════════════════════════════════════════════ */
  @media (max-width: 768px) {
    .hero-immersive       { padding: 80px 5% 450px; }
    .hero-title           { font-size: 2.4rem; }
    .hero-featured-image  { margin-top: 40px; }
    .hero-featured-image img { max-height: 400px; border-radius: 10px; }
    .article-container    { margin-top: 40px; }
    .article-content      { font-size: 15px; }
    .article-content h2   { font-size: 2rem; margin: 36px 0 14px; }
    .author-section       { flex-direction: column; text-align: center; padding: 24px 16px; }
    .floating-toolbar     { bottom: 20px; padding: 10px 16px; gap: 12px; }
    .toolbar-item         { width: 36px; height: 36px; font-size: 14px; }
    .related-grid         { grid-template-columns: 1fr; }
    .faq-trigger-btn      { grid-template-columns: 30px 1fr 32px; gap: 12px; }
    .faq-number-indicator { font-size: 22px; }
    .faq-question-label   { font-size: 15px; }
    .faq-answer-content   { padding: 16px 0 0 42px; font-size: 14px; }
    .faq-title-group      { font-size: 2.2rem; }
    .modern-faq-section   { padding: 40px 16px; }
  }

  .x-twitter-icon { width: 16px; height: 22px; fill: var(--sage2); transition: fill 0.2s; }
  .toolbar-item:hover .x-twitter-icon { fill: var(--cream); }
</style>

<?php while ( have_posts() ) : the_post(); ?>

<!-- 1. HERO -->
<section class="hero-immersive">
  <div class="hero-content-wrap">
    <div class="hero-breadcrumb">
      <a href="<?php echo home_url(); ?>">Home</a>
      <span>/</span>
      <?php
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
            echo '<span>/</span>';
        }
      ?>
      <span><?php the_title(); ?></span>
    </div>

    <h1 class="hero-title"><?php the_title(); ?></h1>

    <div class="hero-meta">
      <div class="hero-meta-item">
        <i class="far fa-calendar-alt"></i>
        <span><?php echo get_the_date('M d, Y'); ?></span>
      </div>
      <?php
        $word_count   = str_word_count( strip_tags( get_the_content() ) );
        $reading_time = max( 1, ceil( $word_count / 200 ) );
      ?>
      <div class="hero-meta-item">
        <i class="far fa-clock"></i>
        <span><?php echo $reading_time; ?> min read</span>
      </div>
      <div class="hero-meta-item">
        <i class="far fa-user"></i>
        <span><a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author(); ?></a></span>
      </div>
    </div>
  </div>

  <div class="hero-featured-image">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('full'); ?>
    <?php else : ?>
      <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=80" alt="<?php the_title(); ?>" />
    <?php endif; ?>
  </div>
</section>

<!-- 2. FLOATING TOOLBAR -->
<div class="floating-toolbar">
  <button class="toolbar-item back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Back to top">
    <i class="fas fa-arrow-up"></i>
  </button>
  <div class="toolbar-divider"></div>
  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" class="toolbar-item" title="Share on LinkedIn">
    <i class="fab fa-linkedin-in"></i>
  </a>
  <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank" class="toolbar-item" title="Share on Twitter / X">
    <svg class="x-twitter-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"></path></svg>
  </a>
  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="toolbar-item" title="Share on Facebook">
    <i class="fab fa-facebook-f"></i>
  </a>
  <button class="toolbar-item" onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');" title="Copy link">
    <i class="fas fa-link"></i>
  </button>
</div>

<!-- 3. ARTICLE CONTENT -->
<div class="article-container">
  <div class="audio-player">
    <div class="audio-icon"><i class="fas fa-play"></i></div>
    <div class="audio-details">
      <h4>Listen to this article</h4>
      <p>AI-powered narration · <?php echo $reading_time; ?>:00</p>
    </div>
  </div>

  <article class="article-content">
    <?php the_content(); ?>
  </article>

  <div class="author-section">
    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
      <?php echo get_avatar( get_the_author_meta('ID'), 90, '', 'Author', array('class' => 'author-avatar') ); ?>
    </a>
    <div class="author-details">
      <h3><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php the_author(); ?></a></h3>
      <span class="author-role">Content Creator</span>
      <p class="author-bio"><?php echo get_the_author_meta('description') ?: 'Logistics expert writing about industry insights and best practices.'; ?></p>
    </div>
  </div>
</div>

<?php endwhile; ?>

<?php
$faqs = get_post_meta( get_the_ID(), '_blog_faqs', true );
if ( ! empty( $faqs ) && is_array( $faqs ) ) :
?>
<section class="modern-faq-section">
  <div class="modern-faq-container">
    <div class="faq-header-wrapper">
      <span class="section-eyebrow">Have Questions?</span>
      <h2 class="faq-title-group">
        <i class="fa-solid fa-circle-question faq-title-icon"></i>
        Frequently Asked Questions
      </h2>
      <div class="faq-title-underline"></div>
    </div>

    <div class="faq-list-wrapper">
      <?php $count = 1; foreach ( $faqs as $faq ) : ?>
        <div class="faq-list-item">
          <button class="faq-trigger-btn" aria-expanded="false">
            <span class="faq-number-indicator"><?php echo $count; ?>.</span>
            <span class="faq-question-label"><?php echo esc_html( $faq['q'] ); ?></span>
            <div class="faq-toggle-box"><i class="fa-solid fa-plus faq-state-icon"></i></div>
          </button>
          <div class="faq-answer-wrapper">
            <div class="faq-answer-inner">
              <p class="faq-answer-content"><?php echo wp_kses_post( nl2br( $faq['a'] ) ); ?></p>
            </div>
          </div>
        </div>
      <?php $count++; endforeach; ?>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const faqItems = document.querySelectorAll('.faq-list-item');
      faqItems.forEach(item => {
        const button = item.querySelector('.faq-trigger-btn');
        const icon   = item.querySelector('.faq-state-icon');
        button.addEventListener('click', () => {
          const isOpen = item.classList.contains('is-open');
          faqItems.forEach(o => {
            o.classList.remove('is-open');
            o.querySelector('.faq-trigger-btn').setAttribute('aria-expanded','false');
            o.querySelector('.faq-state-icon').classList.replace('fa-minus','fa-plus');
          });
          if (!isOpen) {
            item.classList.add('is-open');
            button.setAttribute('aria-expanded','true');
            icon.classList.replace('fa-plus','fa-minus');
          }
        });
      });
    });
  </script>
</section>
<?php endif; ?>

<!-- 4. RELATED POSTS -->
<section class="related-section">
  <div class="related-container">
    <div class="faq-header-wrapper" style="padding-top:60px;">
      <span class="section-eyebrow">Keep Exploring</span>
      <h2 class="faq-title-group">Continue Reading</h2>
      <div class="faq-title-underline"></div>
    </div>

    <div class="related-grid">
      <?php
        $related_args  = array( 'post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => array( get_the_ID() ), 'category_name' => 'blogs' );
        $related_query = new WP_Query( $related_args );
        if ( $related_query->have_posts() ) :
          while ( $related_query->have_posts() ) : $related_query->the_post();
      ?>
      <div class="related-card">
        <div class="related-card-image">
          <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : the_post_thumbnail('medium_large');
            else : ?><img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=800&q=80" alt="<?php the_title(); ?>"><?php endif; ?>
          </a>
        </div>
        <div class="related-card-body">
          <div class="related-card-date"><i class="far fa-calendar-alt"></i><?php echo get_the_date('M d, Y'); ?></div>
          <h3 class="related-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <a href="<?php the_permalink(); ?>" class="related-card-link">Read More <i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>
</section>

<script>
  // 1. Toolbar visibility
  const toolbar = document.querySelector('.floating-toolbar');
  if (toolbar) {
    window.addEventListener('scroll', () => {
      const scrollY = window.scrollY;
      const bottom  = document.documentElement.scrollHeight - window.innerHeight - scrollY;
      toolbar.classList.toggle('visible', scrollY > 500 && bottom > 600);
    });
  }

  // 2. Text-to-Speech
  const audioIcon  = document.querySelector('.audio-icon');
  const audioIconI = audioIcon ? audioIcon.querySelector('i') : null;
  let isPlaying = false, utterance = null;
  const synth = window.speechSynthesis;

  function getArticleText() {
    const c = document.querySelector('.article-content');
    return c ? c.innerText.replace(/\s+/g, ' ').trim() : '';
  }

  if (audioIcon && synth) {
    audioIcon.addEventListener('click', () => {
      if (isPlaying) {
        synth.pause(); isPlaying = false;
        audioIcon.classList.remove('playing'); audioIconI.className = 'fas fa-play';
      } else {
        if (synth.paused && utterance) { synth.resume(); }
        else {
          if (utterance) synth.cancel();
          utterance = new SpeechSynthesisUtterance(getArticleText());
          utterance.onend = () => { isPlaying = false; audioIcon.classList.remove('playing'); audioIconI.className = 'fas fa-play'; };
          synth.speak(utterance);
        }
        isPlaying = true; audioIcon.classList.add('playing'); audioIconI.className = 'fas fa-pause';
      }
    });
  }

  // 3. Newsletter form
  const newsletterForm = document.getElementById('discordNewsletterForm');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      const form = this, email = form.email.value;
      const button = form.querySelector('.newsletter-btn');
      const btnText = button.querySelector('.btn-text'), btnLoader = button.querySelector('.btn-loader');
      const msgDiv = form.querySelector('.form-message');
      form.email.disabled = button.disabled = true;
      btnText.style.display = 'none'; btnLoader.style.display = 'inline-block';
      try {
        const r = await fetch('https://discord.com/api/webhooks/1329759316433178655/fjJQ9s1Asvf86k-eGsUi_gsaiJRGHa9kiYeM0aYx2f531iPkHGy0cKTNQezkaMi8iqvR', {
          method:'POST', headers:{'Content-Type':'application/json'},
          body: JSON.stringify({ content:'📧 New newsletter subscription from blog post', embeds:[{ title:'Newsletter Subscription', description:`Email: ${email}\nSource: ${document.title}`, color:7709561, timestamp:new Date().toISOString() }] })
        });
        if (!r.ok) throw new Error('Subscription failed');
        msgDiv.textContent = '✓ Thanks for subscribing!'; msgDiv.className = 'form-message success'; msgDiv.style.display = 'block';
        form.reset();
      } catch(err) {
        msgDiv.textContent = '✗ Something went wrong. Please try again.'; msgDiv.className = 'form-message error'; msgDiv.style.display = 'block';
      } finally {
        form.email.disabled = button.disabled = false;
        btnText.style.display = 'inline'; btnLoader.style.display = 'none';
      }
    });
  }
</script>

<?php get_footer(); ?>
