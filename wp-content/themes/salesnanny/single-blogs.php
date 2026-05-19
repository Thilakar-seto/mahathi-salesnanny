<?php get_header(); ?>
<!-- Mahathi Brand Fonts: Bebas Neue (display) · DM Sans (body) · DM Mono (labels) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
  :root {
    /* ── Mahathi Brand Colors (from official brand guidelines 2025) ── */
    --brand-navy:        #253830;   /* forest  — was #0C2D48 */
    --brand-navy-dark:   #1e2e27;   /* forest2 — was #051524 */
    --brand-accent:      #76A379;   /* sage    — was #153D4D */
    --brand-accent-hover:#6F8077;   /* sage2   — was #cc5500 */
    --text-white:        #EEF0EC;   /* cream   — was #ffffff */
    --text-main:         #253830;   /* forest  — was #1e293b */
    --text-muted:        #6F8077;   /* sage2   — was #64748b */
    --bg-light:          #EEF0EC;   /* cream   — was #fafafa */
    --gradient-purple:   linear-gradient(180deg, #253830, #1e2e27);
    --gradient-blue:     linear-gradient(180deg, #253830, #1e2e27 100%, #2d4840 0);
    --gradient-orange:   #B2C7B3;   /* mint    — was lightgreen */
  }

  /* ── Font assignments (design/layout unchanged) ── */
  body,
  .audio-details p,
  .author-bio,
  .related-card-date,
  .related-card-link,
  .hero-meta {
    font-family: 'DM Sans', sans-serif;
  }

  .hero-title,
  .section-header h2,
  .related-card-title,
  h1, h2, h3, h4 {
    font-family: 'DM Sans', sans-serif;
  }

  .hero-breadcrumb,
  .audio-details p,
  .author-role,
  .related-card-date {
    font-family: 'DM Mono', monospace;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background: #ffffff;
    color: var(--text-main);
    line-height: 1.7;
    overflow-x: hidden;
  }

  a { text-decoration: none; color: inherit; }

  strong {
    font-weight: unset;
  }

  p strong {
    font-weight: bolder;
    word-spacing: 2px;
    color: #253830;
  }

  .wp-block-separator {
    display: none;
  }

  /* ========================================
     1. CENTERED HERO - Centered Layout
  =========================================*/
  .hero-immersive {
    position: relative;
    padding: 200px 5% 60px;
    background: #253830;
    text-align: center;
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
    font-size: 13px;
    color: rgba(238,240,236,0.7);
    margin-bottom: 24px;
    font-weight: 500;
  }

  .hero-breadcrumb a {
    color: rgba(238,240,236,0.9);
    transition: color 0.3s;
  }

  .hero-breadcrumb a:hover {
    color: #B2C7B3;
  }

  .hero-breadcrumb span {
    color: rgba(238,240,236,0.4);
    text-align: left;
    max-width: 20ch;
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .hero-title {
    font-size: 30px;
    font-weight: 700;
    color: #EEF0EC;
    line-height: 1.4;
    margin-bottom: 24px;
  }

  .hero-meta {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    justify-content: center;
    font-size: 14px;
    color: rgba(238,240,236,0.8);
  }

  /* Featured Image Section - Between Hero and Content */
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
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  }

  .hero-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 30px;
  }

  .hero-meta-item i {
    color: #B2C7B3;
    font-size: 16px;
  }

  /* Scroll Indicator */
  .scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    animation: bounce 2s infinite;
  }

  .scroll-indicator i {
    color: rgba(238,240,236,0.6);
    font-size: 24px;
  }

  @keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40% { transform: translateX(-50%) translateY(-10px); }
    60% { transform: translateX(-50%) translateY(-5px); }
  }

  /* ========================================
     2. FLOATING TOOLBAR
  =========================================*/
  .floating-toolbar {
    position: fixed;
    left: 50%;
    transform: translateX(-50%);
    bottom: 20px;
    z-index: 100;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 50px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    border: 2px solid rgba(37,56,48,0.22);
    display: flex;
    gap: 16px;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .floating-toolbar.visible {
    opacity: 1;
  }

  .toolbar-item {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    background: transparent;
    transition: all 0.3s;
    cursor: pointer;
    border: none;
    font-size: 16px;
  }

  .toolbar-item:hover {
    background: #253830;
    color: #EEF0EC;
    transform: translateY(-2px);
  }

  .toolbar-divider {
    width: 1px;
    height: 24px;
    background: #e2e8f0;
  }

  /* ========================================
     3. ARTICLE CONTENT - Centered Layout
  =========================================*/
  .article-container {
    max-width: 1200px;
    margin: 400px auto 0;
    padding: 0 5%;
  }

  /* Audio Player */
  .audio-player {
    background: linear-gradient(135deg, #f8fafc 0%, #EEF0EC 100%);
    border-radius: 20px;
    padding: 24px 30px;
    margin-bottom: 50px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid #E4E6E2;
  }

  .audio-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #253830;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #EEF0EC;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s;
    flex-shrink: 0;
  }

  @keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(37,56,48,0.7); }
    50% { box-shadow: 0 0 0 15px rgba(37,56,48,0); }
  }

  .audio-details h4 {
    font-size: 15px;
    font-weight: 700;
    color: #253830;
    margin-bottom: 4px;
  }

  .audio-details p {
    font-size: 13px;
    color: var(--text-muted);
    margin: 0;
  }

  /* Article Typography */
  .article-content {
    font-size: 17px;
    font-weight: 400;
    line-height: 1.8;
    color: #222222;
    letter-spacing: 0.6px;
  }

  .article-content p {
    margin-bottom: 15px;
    line-height: 1.5;
  }

  /* ===== H2 — primary section ===== */
  .article-content h2 {
    font-size: 24px;
    line-height: 35px;
    font-weight: 700;
    color: #253830;
    margin: 40px 0 10px;
    position: relative;
    padding-bottom: 10px;
  }

  /* ===== H3 — subsection ===== */
  .article-content h3 {
    font-size: 20px;
    font-weight: 600;
    color: #1e2e27;
    margin: 30px 0 10px;
    line-height: 1.3;
    position: relative;
    padding-left: 14px;
    border-left: 3px solid rgba(37,56,48,0.25);
  }

  /* ===== H4 — minor heading ===== */
  .article-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #6F8077;
    margin: 22px 0 10px;
    line-height: 1.35;
    position: relative;
  }

  .article-content ul,
  .article-content ol {
    margin: 24px 0;
    padding-left: 30px;
  }

  .article-content li {
    padding-left: 8px;
  }

  .article-content li::marker {
    color: #1e2e27;
  }

  .article-content blockquote {
    margin: 40px 0;
    padding: 30px 40px;
    background: #EEF0EC;
    border-left: 5px solid #B2C7B3;
    border-radius: 0 16px 16px 0;
    font-size: 20px;
    font-style: italic;
    color: #1e2e27;
    line-height: 1.6;
  }

  .article-content img {
    width: 100%;
    height: auto;
    border-radius: 16px;
    margin: 40px 0;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
  }

  .article-content a {
    color: #1e2e27;
    font-weight: 600;
    text-decoration: underline;
    text-decoration-color: #1e2e27;
    text-underline-offset: 3px;
    transition: all 0.3s;
  }

  .article-content a:hover {
    text-decoration-color: #000;
  }

  /* ========================================
     4. AUTHOR CARD
  =========================================*/
  .author-section {
    margin: 40px 0 50px;
    padding: 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border-radius: 24px;
    border: 2px solid rgba(37,56,48,0.22);
    display: flex;
    gap: 24px;
    align-items: center;
  }

  .author-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    flex-shrink: 0;
  }

  .author-details h3 {
    font-size: 22px;
    font-weight: 700;
    color: #1e2e27;
    margin-bottom: 6px;
  }

  .author-role {
    display: block;
    font-size: 13px;
    color: #1e2e27;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .author-bio {
    font-size: 15px;
    color: var(--text-muted);
    line-height: 1.6;
    margin: 0;
  }

  /* ========================================
     6. RELATED POSTS - Horizontal Scroll
  =========================================*/
  .related-section {
    background: var(--bg-light);
    padding: 0px 0 60px;
  }

  .related-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
  }

  .section-header {
    text-align: center;
    margin-bottom: 50px;
  }

  .section-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #1e2e27;
    margin-bottom: 12px;
  }

  .section-header p {
    font-size: 16px;
    color: var(--text-muted);
  }

  .related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
  }

  .related-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid transparent;
  }

  .related-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    border-color: #B2C7B3;
  }

  .related-card-image {
    position: relative;
    height: 220px;
    overflow: hidden;
  }

  .related-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
  }

  .related-card:hover .related-card-image img {
    transform: scale(1.08);
  }

  .related-card-body {
    padding: 24px;
  }

  .related-card-date {
    font-size: 13px;
    color: var(--text-muted);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .related-card-title {
    font-size: 20px;
    font-weight: 700;
    color: #1e2e27;
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .related-card-title a {
    transition: color 0.3s;
  }

  .related-card:hover .related-card-title a {
    color: #1e2e27;
  }

  .related-card-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
    color: #1e2e27;
    margin-top: 12px;
  }

  .related-card:hover .related-card-link i {
    transform: translateX(4px);
    transition: transform 0.3s;
  }

  /* ========================================
     7. RESPONSIVE
  =========================================*/
  @media (max-width: 768px) {
    .hero-immersive {
      padding: 80px 5% 450px;
    }

    .hero-title {
      font-size: 28px;
    }

    .hero-featured-image {
      margin-top: 40px;
    }

    .hero-featured-image img {
      max-height: 400px;
      border-radius: 16px;
    }

    .hero-meta {
      gap: 16px;
      font-size: 13px;
    }

    .article-container {
      margin-top: 40px;
    }

    .article-content {
      font-size: 17px;
    }

    .article-content h2 {
      font-size: 26px;
      margin: 40px 0 20px;
    }

    .author-section {
      flex-direction: column;
      text-align: center;
      padding: 30px 20px;
    }

    .floating-toolbar {
      bottom: 20px;
      padding: 10px 16px;
      gap: 12px;
    }

    .toolbar-item {
      width: 36px;
      height: 36px;
      font-size: 14px;
    }

    .related-grid {
      grid-template-columns: 1fr;
    }

    .scroll-indicator {
      display: none;
    }
  }

  .x-twitter-icon {
    width: 18px;
    height: 24px;
    fill: #6F8077;
    transition: fill 0.2s;
  }
</style>

<?php while ( have_posts() ) : the_post(); ?>

<!-- 1. CENTERED HERO -->
<section class="hero-immersive">
<div class="hero-glow" aria-hidden="true"></div>
  <!-- Floor fade -->
  <div class="hero-floor" aria-hidden="true"></div>
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
        $word_count = str_word_count(strip_tags(get_the_content()));
        $reading_time = max(1, ceil($word_count / 200));
      ?>
      <div class="hero-meta-item">
        <i class="far fa-clock"></i>
        <span><?php echo $reading_time; ?> min read</span>
      </div>
      <div class="hero-meta-item">
        <i class="far fa-user"></i>
        <span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
      </div>
    </div>
  </div>
  
  <!-- Featured Image Section -->
<div class="hero-featured-image">
  <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail('full'); ?>
  <?php else: ?>
    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=80" alt="<?php the_title(); ?>" />
  <?php endif; ?>
</div>
</section>



<!-- 2. FLOATING TOOLBAR -->
<div class="floating-toolbar">
  <button class="toolbar-item" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Back to top" style="background: #253830;padding: 0 50px;border-radius: 16px;margin: 0 -12px 0 0;
color: #EEF0EC;">
    <i class="fas fa-arrow-up"></i>
  </button>
  <div class="toolbar-divider"></div>
  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" class="toolbar-item" title="Share on LinkedIn">
    <i class="fab fa-linkedin-in"></i>
  </a>
  <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank" class="toolbar-item" title="Share on Twitter">
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
  
  <!-- Audio Player -->
  <div class="audio-player">
    <div class="audio-icon">
      <i class="fas fa-play"></i>
    </div>
    <div class="audio-details">
      <h4>Listen to this article</h4>
      <p>AI-powered narration · <?php echo $reading_time; ?>:00</p>
    </div>
  </div>

  <!-- Main Content -->
  <article class="article-content">
    <?php the_content(); ?>
  </article>

  <!-- Author Card -->
  <div class="author-section">
    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
      <?php echo get_avatar( get_the_author_meta( 'ID' ), 90, '', 'Author', array('class' => 'author-avatar') ); ?>
    </a>
    <div class="author-details">
      <h3>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
          <?php the_author(); ?>
        </a>
      </h3>
      <span class="author-role">Content Creator</span>
      <p class="author-bio">
        <?php echo get_the_author_meta('description') ? get_the_author_meta('description') : 'Logistics expert writing about industry insights and best practices.'; ?>
      </p>
    </div>
  </div>


  

</div>

<?php endwhile; ?>

<?php
// Fetch FAQs for the current post
$faqs = get_post_meta(get_the_ID(), '_blog_faqs', true);

// Only display the section if FAQs exist
if (!empty($faqs) && is_array($faqs)) : 
?>

<!-- Import external resources -->
<style>
    .modern-faq-section {
        padding: 0px 20px 40px;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
    }

    .modern-faq-container {
        width: 100%;
        max-width: 900px;
    }

    .faq-header-wrapper {
        text-align: center;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .faq-title-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-size: 25px;
        font-weight: 700;
        color: #253830;
        font-family: 'DM Sans', sans-serif;
        margin: 0;
    }

    .faq-title-icon {
        font-size: 28px;
    }

    .faq-title-underline {
        height: 3px;
        width: 60px;
        background-color: #76A379;
        margin-top: 16px;
        border-radius: 2px;
    }

    .faq-list-wrapper {
        display: flex;
        flex-direction: column;
    }

    .faq-list-item {
        border-bottom: 1px solid #f3f4f6;
        padding: 18px 0;
    }

    .faq-list-item:first-child {
        border-top: 1px solid #f3f4f6;
    }

    .faq-trigger-btn {
        width: 100%;
        background: transparent;
        border: none;
        padding: 0;
        display: grid;
        grid-template-columns: 40px 1fr 36px;
        gap: 10px;
        align-items: start;
        text-align: left;
        cursor: pointer;
    }

    .faq-number-indicator {
        font-size: 24px;
        font-weight: 700;
        color: #253830;
        font-family: 'DM Sans', sans-serif;
        line-height: 1.4;
    }

    .faq-question-label {
        font-size: 19px;
        font-weight: 600;
        color: #1f2937;
        font-family: 'DM Sans', sans-serif;
        line-height: 1.4;
        padding-top: 4px;
    }

    .faq-toggle-box {
        width: 36px;
        height: 36px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 14px;
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .faq-trigger-btn:hover .faq-toggle-box {
        border-color: #253830;
        color: #253830;
    }

    .faq-answer-wrapper {
        display: grid;
        grid-template-rows: 0fr;
        transition: grid-template-rows 0.3s ease-in-out;
    }

    .faq-list-item.is-open .faq-answer-wrapper {
        grid-template-rows: 1fr;
    }

    .faq-answer-inner {
        overflow: hidden;
    }

    .faq-answer-content {
        padding: 24px 64px 0 64px; 
        margin: 0;
        font-size: 17px;
        font-family: 'DM Sans', sans-serif;
        color: #4b5563;
        line-height: 1.7;
    }

    @media (max-width: 768px) {
        .modern-faq-section { padding: 50px 16px; }
        .faq-title-group { font-size: 20px; }
        .faq-title-icon { font-size: 22px; }
        
        .faq-trigger-btn {
            grid-template-columns: 30px 1fr 32px;
            gap: 16px;
        }
        .faq-number-indicator { font-size: 20px; }
        .faq-question-label { font-size: 17px; }
        .faq-answer-content { 
            padding: 20px 0 0 46px;
            font-size: 16px; 
        }
    }
</style>

<section class="modern-faq-section">
    <div class="modern-faq-container">
        
        <!-- Header -->
        <div class="faq-header-wrapper">
            <h2 class="faq-title-group">
                <i class="fa-solid fa-circle-question faq-title-icon"></i>
                Frequently Asked Questions
            </h2>
            <div class="faq-title-underline"></div>
        </div>
        
        <!-- FAQ List -->
        <div class="faq-list-wrapper">
            <?php 
            $count = 1;
            foreach ($faqs as $faq) : 
            ?>
                <div class="faq-list-item">
                    <button class="faq-trigger-btn" aria-expanded="false">
                        <span class="faq-number-indicator"><?php echo $count; ?>.</span>
                        <span class="faq-question-label"><?php echo esc_html($faq['q']); ?></span>
                        <div class="faq-toggle-box">
                            <i class="fa-solid fa-plus faq-state-icon"></i>
                        </div>
                    </button>
                    
                    <div class="faq-answer-wrapper">
                        <div class="faq-answer-inner">
                            <p class="faq-answer-content"><?php echo wp_kses_post(nl2br($faq['a'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php 
            $count++;
            endforeach; 
            ?>
        </div>

    </div>

    <!-- JavaScript for Toggle & Icon Swap -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const faqItems = document.querySelectorAll('.faq-list-item');

            faqItems.forEach(item => {
                const button = item.querySelector('.faq-trigger-btn');
                const icon = item.querySelector('.faq-state-icon');

                button.addEventListener('click', () => {
                    const isOpen = item.classList.contains('is-open');

                    faqItems.forEach(otherItem => {
                        otherItem.classList.remove('is-open');
                        otherItem.querySelector('.faq-trigger-btn').setAttribute('aria-expanded', 'false');
                        otherItem.querySelector('.faq-state-icon').classList.replace('fa-minus', 'fa-plus');
                    });

                    if (!isOpen) {
                        item.classList.add('is-open');
                        button.setAttribute('aria-expanded', 'true');
                        icon.classList.replace('fa-plus', 'fa-minus');
                    } else {
                        item.classList.remove('is-open');
                        button.setAttribute('aria-expanded', 'false');
                        icon.classList.replace('fa-minus', 'fa-plus');
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
  <div class="faq-header-wrapper">
            <h2 class="faq-title-group">
                Continue Reading
            </h2>
            <div class="faq-title-underline"></div>
        </div>

    <div class="related-grid">
      <?php
        $related_args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post__not_in' => array( get_the_ID() ),
            'category_name' => 'blogs'
        );
        $related_query = new WP_Query( $related_args );
        if ( $related_query->have_posts() ) :
            while ( $related_query->have_posts() ) : $related_query->the_post();
      ?>
      <div class="related-card">
        <div class="related-card-image">
          <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail('medium_large'); ?>
            <?php else: ?>
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=800&q=80" alt="<?php the_title(); ?>">
            <?php endif; ?>
          </a>
        </div>
        <div class="related-card-body">
          <div class="related-card-date">
            <i class="far fa-calendar-alt"></i>
            <?php echo get_the_date('M d, Y'); ?>
          </div>
          <h3 class="related-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>
          <a href="<?php the_permalink(); ?>" class="related-card-link">
            Read More <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
      <?php 
            endwhile;
            wp_reset_postdata();
        endif;
      ?>
    </div>
  </div>
</section>

<!-- Scripts -->
<script>
  // 1. Floating Toolbar Visibility
  const toolbar = document.querySelector('.floating-toolbar');
  if(toolbar) {
      window.addEventListener('scroll', () => {
          const scrollY = window.scrollY;
          const documentHeight = document.documentElement.scrollHeight;
          const windowHeight = window.innerHeight;
          const bottomOffset = documentHeight - windowHeight - scrollY;
          
          if(scrollY > 500 && bottomOffset > 600) {
              toolbar.classList.add('visible');
          } else {
              toolbar.classList.remove('visible');
          }
      });
  }

  // 2. Text-to-Speech Audio Player
  const audioIcon = document.querySelector('.audio-icon');
  const audioIconI = audioIcon ? audioIcon.querySelector('i') : null;
  const audioPlayer = document.querySelector('.audio-player');
  let isPlaying = false;
  let utterance = null;
  let synth = window.speechSynthesis;

  function getArticleText() {
    const content = document.querySelector('.article-content');
    if(!content) return '';
    return content.innerText.replace(/\s+/g, ' ').trim();
  }

  if(audioIcon && synth) {
      audioIcon.addEventListener('click', () => {
          if(isPlaying) {
              synth.pause();
              isPlaying = false;
              audioIcon.classList.remove('playing');
              audioIconI.className = 'fas fa-play';
          } else {
              if(synth.paused && utterance) {
                  synth.resume();
              } else {
                  if(utterance) synth.cancel();
                  utterance = new SpeechSynthesisUtterance(getArticleText());
                  utterance.onend = () => {
                      isPlaying = false;
                      audioIcon.classList.remove('playing');
                      audioIconI.className = 'fas fa-play';
                  };
                  synth.speak(utterance);
              }
              isPlaying = true;
              audioIcon.classList.add('playing');
              audioIconI.className = 'fas fa-pause';
          }
      });
  }

  // 3. Newsletter Form
  const newsletterForm = document.getElementById('discordNewsletterForm');
  if(newsletterForm) {
      newsletterForm.addEventListener('submit', async function(e) {
          e.preventDefault();
          const form = this;
          const email = form.email.value;
          const button = form.querySelector('.newsletter-btn');
          const btnText = button.querySelector('.btn-text');
          const btnLoader = button.querySelector('.btn-loader');
          const messageDiv = form.querySelector('.form-message');

          form.email.disabled = true;
          button.disabled = true;
          btnText.style.display = 'none';
          btnLoader.style.display = 'inline-block';
          
          try {
              const webhookUrl = 'https://discord.com/api/webhooks/1329759316433178655/fjJQ9s1Asvf86k-eGsUi_gsaiJRGHa9kiYeM0aYx2f531iPkHGy0cKTNQezkaMi8iqvR';
              
              const response = await fetch(webhookUrl, {
                  method: 'POST',
                  headers: { 'Content-Type': 'application/json' },
                  body: JSON.stringify({
                      content: `📧 New newsletter subscription from blog post`,
                      embeds: [{
                          title: 'Newsletter Subscription',
                          description: `Email: ${email}\nSource: ${document.title}`,
                          color: 5814783,
                          timestamp: new Date().toISOString()
                      }]
                  })
              });

              if (!response.ok) throw new Error('Subscription failed');

              messageDiv.textContent = '✓ Thanks for subscribing!';
              messageDiv.className = 'form-message success';
              messageDiv.style.display = 'block';
              form.reset();

          } catch (error) {
              messageDiv.textContent = '✗ Something went wrong. Please try again.';
              messageDiv.className = 'form-message error';
              messageDiv.style.display = 'block';
          } finally {
              form.email.disabled = false;
              button.disabled = false;
              btnText.style.display = 'inline';
              btnLoader.style.display = 'none';
          }
      });
  }
</script>

<?php get_footer(); ?>


<!-- Salesnanny Blog Theme -->