<?php
/**
 * Template Name: success stories
 */
get_header();
?>

<!-- Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
  :root {
    --brand-navy: #0C2D48;
    --brand-navy-dark: #051524;
    --brand-accent: lightgreen;
    --brand-accent-hover: #e03e10;
    --text-white: #ffffff;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --bg-light: #f8fafc;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background: #ffffff;
    color: var(--text-main);
    line-height: 1.6;
    overflow-x: hidden;
  }

  .page-wrapper {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
  }

  /* ========================================
     ANIMATED HERO - Split Layout
  =========================================*/
  .blog-hero {
    /* Animated Gradient Background */
    background: linear-gradient(180deg, #482f95, #3e248f);;
    background-size: 400% 400%;
    padding: 160px 20px 100px;
    position: relative;
    overflow: hidden;
  }



  /* Background Animation Keyframes */
  @keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .hero-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    opacity: 0.3;
    pointer-events: none;
  }

  /* Split Layout Container */
  .hero-grid {
    max-width: 1280px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.2fr 1fr; /* Split layout */
    gap: 60px;
    align-items: center;
    position: relative;
    z-index: 2;
  }

  /* Left Side: Text Content */
  .hero-text-side {
    text-align: left;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--brand-accent);
    background: rgba(255, 255, 255, 0.05);
    padding: 0.6rem 1.2rem;
    border-radius: 99px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 24px;
    backdrop-filter: blur(5px);
    
    /* Animation */
    opacity: 0;
    animation: fadeInUp 0.8s ease forwards;
  }

  .hero-title {
    font-size: clamp(40px, 6vw, 64px);
    font-weight: 700;
    color: #fff;
    margin-bottom: 24px;
    line-height: 1.1;
    letter-spacing: -1px;
    
    /* Animation */
    opacity: 0;
    animation: fadeInUp 0.8s ease 0.2s forwards;
  }

  .hero-title span {
    color: transparent;
    -webkit-text-stroke: 1px rgb(255, 255, 255);
    display: block;
  }

  .hero-subtitle {
    margin-bottom: 40px;
    max-width: 90%;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.7;
    
    /* Animation */
    opacity: 0;
    animation: fadeInUp 0.8s ease 0.4s forwards;
  }

  /* Right Side: Visual Animation */
  .hero-visual-side {
    position: relative;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .visual-card {
    position: absolute;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    width: 280px;
    
    /* Float Animation */
    animation: float 6s ease-in-out infinite;
  }

  .visual-card.primary {
    z-index: 2;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .visual-card.secondary {
    z-index: 1;
    width: 200px;
    top: 20%;
    right: 10%;
    animation-delay: -3s; /* Offset animation */
    background: rgba(67, 56, 202, 0.3);
  }

  .card-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #482f95 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin-bottom: 16px;
  }

  .card-lines .line {
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    margin-bottom: 8px;
  }
  .card-lines .line:last-child { width: 60%; }

  /* Animations Keyframes */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes float {
    0% { transform: translate(-50%, -50%) translateY(0px); }
    50% { transform: translate(-50%, -50%) translateY(-20px); }
    100% { transform: translate(-50%, -50%) translateY(0px); }
  }

  /* Enhanced Search */
  .hero-search {
    max-width: 100%;
    margin: 0;
    position: relative;
    opacity: 0;
    animation: fadeInUp 0.8s ease 0.6s forwards;
  }

  .search-wrapper {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 50px;
    padding: 8px 8px 8px 24px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    gap: 12px;
    max-width: 500px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .search-wrapper:focus-within {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
  }

  .search-wrapper i {
    color: var(--text-muted);
    font-size: 18px;
  }

  .search-wrapper input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 15px;
    color: var(--text-main);
  }

  .search-wrapper input::placeholder {
    color: var(--text-muted);
  }

  .search-btn {
    background: linear-gradient(180deg, #264796, #243f80 100%, #182d5f 0);
    color: white;
    border: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .search-btn:hover {
    /* background: linear-gradient(135deg, #482f95 0%,rgb(119, 40, 255) 100%); */
    transform: translateY(-2px);
  }

  /* Live Search Results */
  .live-search-results {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    right: 0;
    max-width: 500px; /* Match search wrapper */
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    display: none;
    overflow: hidden;
    z-index: 100;
  }

  .search-results-list {
    list-style: none;
    max-height: 400px;
    overflow-y: auto;
  }

  .search-results-list li {
    border-bottom: 1px solid #f1f5f9;
  }

  .search-results-list li:last-child {
    border-bottom: none;
  }

  .search-results-list a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    text-decoration: none;
    transition: background 0.2s;
  }

  .search-results-list a:hover {
    background: var(--bg-light);
  }

  .search-thumb img {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
  }

  .search-info {
    flex: 1;
  }

  .search-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--brand-navy);
    margin-bottom: 4px;
  }

  .search-date {
    font-size: 12px;
    color: var(--text-muted);
  }

  .no-results {
    padding: 20px;
    text-align: center;
    color: var(--text-muted);
  }

  /* ========================================
     FEATURED POST - Hero Card
  =========================================*/

  .featured-image {
    position: relative;
    overflow: hidden;
  }

  .featured-image img {
    width: 100%;
    height: auto;
    border-radius: 20px;
    transition: transform 0.6s ease;
  }

  .featured-tag {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #482f95 0%, #7c3aed 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
  }

  .featured-content {
    padding: 50px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .featured-label {
    color: linear-gradient(135deg, #482f95 0%, #7c3aed 100%);
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
  }

  .featured-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--brand-navy);
    margin-bottom: 16px;
    line-height: 1.3;
  }

  .featured-excerpt {
    font-size: 16px;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 24px;
  }

  .featured-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 24px;
    font-size: 14px;
    color: var(--text-muted);
  }

  .featured-meta span {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .featured-cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(180deg, #482f95, #3e248f);
    color: white;
    padding: 14px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    align-self: flex-start;
  }

  .featured-cta:hover {
    /* background: linear-gradient(135deg, #482f95 0%, #7c3aed 100%); */
    transform: translateX(4px);
  }

  /* ========================================
     MASONRY GRID LAYOUT
  =========================================*/
  .posts-section {
    padding: 60px 20px 0px;
    background: white;
  }

  .section-header {
    text-align: center;
    margin-bottom: 50px;
  }

  .section-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--brand-navy);
    margin-bottom: 12px;
  }

  .section-subtitle {
    font-size: 16px;
    color: var(--text-muted);
  }

  .masonry-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    max-width: 1280px;
    margin: 0 auto;
  }

  /* Card Variations */
  .post-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    flex-direction: column;
    opacity: 0;
    transform: translateY(30px);
  }

  .post-card.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .post-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgb(67 56 202 / 15%);
    border-color: #482f95;
  }

  .post-image-wrap {
    position: relative;
    overflow: hidden;
    /* height: 240px; */
  }

  .post-image {
    width: 100%;
    height: auto;
    /* object-fit: cover; */
    transition: transform 0.5s ease;
  }

  .post-card:hover .post-image {
    transform: scale(1.08);
  }

  .post-category {
    position: absolute;
    top: 16px;
    left: 16px;
    background: rgba(12,45,72,0.9);
    color: white;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
  }

  .post-content {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .post-date {
    font-size: 12px;
    color: var(--text-muted);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .post-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--brand-navy);
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .post-card a {
    text-decoration: none;
    color: inherit;
  }

  .post-card:hover .post-title {
    color: #482f95;
  }

  .post-excerpt {
    font-size: 14px;
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
  }

  .post-author {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: var(--text-muted);
  }

  .author-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
  }

  .author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .read-time {
    font-size: 12px;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* ========================================
     PAGINATION
  =========================================*/
  .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin: 60px 0 40px;
    padding: 0 20px;
  }

  .pagination-wrapper ul.page-numbers {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 8px;
    align-items: center;
    background: linear-gradient(180deg, #482f95, #3e248f);
    padding: 31px 20px;
    border-radius: 50px;
    box-shadow: 0 8px 24px rgba(72, 47, 149, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.15);
}

  .pagination-wrapper .page-numbers {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 42px;
    padding: 8px 14px;
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
  }

  .pagination-wrapper .page-numbers:hover::before {
    left: 100%;
  }

  .pagination-wrapper .page-numbers.current {
    background: linear-gradient(180deg, #e56000, #ff9344);
    color: #ffffff;
    border-color: #ff9344;
    box-shadow: 0 0 20px rgba(229, 96, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
    font-weight: 700;
    transform: scale(1.1);
  }

  .pagination-wrapper .page-numbers.prev,
  .pagination-wrapper .page-numbers.next {
    background: linear-gradient(180deg, #264796, #243f80);
    min-width: auto;
    padding: 8px 18px;
    gap: 8px;
    border: 2px solid rgba(255, 255, 255, 0.2);
  }

  /* .pagination-wrapper .page-numbers.prev:hover,
  .pagination-wrapper .page-numbers.next:hover {
    background: linear-gradient(180deg, #e56000, #ff9344);
    color: #ffffff;
    border-color: #ff9344;
    box-shadow: 0 0 20px rgba(229, 96, 0, 0.4);
  } */

  .pagination-wrapper .page-numbers.prev span,
  .pagination-wrapper .page-numbers.next span {
    font-size: 13px;
    font-weight: 600;
  }

  .pagination-wrapper .page-numbers i {
    font-size: 12px;
  }

  .pagination-wrapper .page-numbers.dots {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.5);
    cursor: default;
    box-shadow: none;
    min-width: 30px;
  }

  /* Loading State */
  .masonry-grid.loading {
    opacity: 0.5;
    pointer-events: none;
    position: relative;
    min-height: 300px;
  }

  .masonry-grid.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50px;
    height: 50px;
    margin: -25px 0 0 -25px;
    border: 4px solid rgba(72, 47, 149, 0.3);
    border-top-color: #482f95;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 10;
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }

  /* ========================================
     RESPONSIVE
  =========================================*/
  @media (max-width: 1024px) {
    .hero-grid {
      grid-template-columns: 1fr;
      text-align: center;
      gap: 40px;
    }

    .hero-text-side {
      text-align: center;
    }
    
    .hero-search {
      display: flex;
      justify-content: center;
    }
    
    .search-wrapper {
      width: 100%;
    }

    .hero-visual-side {
      height: 300px;
      display: none; /* Hide visual on smaller tablets/mobile for cleaner look */
    }
    
    .hero-title span {
      display: inline;
    }

    .featured-card {
      grid-template-columns: 1fr;
    }

    .featured-image img {
      min-height: 350px;
    }

    .masonry-grid {
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 24px;
    }
  }

  @media (max-width: 768px) {
    .hero-title {
      font-size: 36px;
    }

    .featured-content {
      padding: 30px 24px;
    }

    .featured-title {
      font-size: 24px;
    }

    .masonry-grid {
      grid-template-columns: 1fr;
    }

    .post-card:nth-child(3n) {
      grid-row: span 1;
    }

    .post-card:nth-child(3n) .post-image-wrap {
      height: 240px;
    }

    .search-wrapper {
      flex-direction: column;
      align-items: stretch;
      padding: 12px;
      gap: 10px;
    }

    .search-btn {
      width: 100%;
      justify-content: center;
    }

    .pagination-wrapper ul.page-numbers {
      padding: 10px 15px;
      gap: 6px;
    }
    
    .pagination-wrapper .page-numbers {
      min-width: 36px;
      height: 36px;
      padding: 6px 10px;
      font-size: 13px;
    }
    
    .pagination-wrapper .page-numbers.prev span,
    .pagination-wrapper .page-numbers.next span {
      display: none;
    }
    
    .pagination-wrapper .page-numbers.prev,
    .pagination-wrapper .page-numbers.next {
      padding: 6px 12px;
    }
  }
</style>

<!-- ANIMATED HERO -->
<section class="blog-hero">
  <div class="hero-pattern"></div>
  
  <div class="hero-grid">
    <!-- Left Column: Content -->
    <div class="hero-text-side">
      <div class="hero-badge">
        <i class="fas fa-bolt"></i>
        Fresh Perspectives
      </div>
      <h1 class="hero-title">
        Stories that Move <br>
        <span>The World Forward</span>
      </h1>
      <p class="hero-subtitle">
        Deep dives, quick tips, and real-world freight wisdom—curated for operators who never stop moving.
      </p>

      <!-- Search -->
      <div class="hero-search">
        <div class="search-wrapper">
          <i class="fas fa-search"></i>
          <input 
            type="text" 
            id="hero-search-input" 
            placeholder="Search articles, topics, insights..." 
            autocomplete="off"
          />
          <button type="button" class="search-btn">Search</button>
        </div>
        <div id="live-search-results" class="live-search-results"></div>
      </div>
    </div>

    <!-- Right Column: Animated Visuals -->
    <div class="hero-visual-side">
      <!-- Decorative Abstract Cards -->
      <!-- <div class="visual-card secondary"></div>
      
      <div class="visual-card primary">
        <div class="card-icon">
          <i class="fas fa-pen-nib"></i>
        </div>
        <div class="card-lines">
          <div class="line" style="width: 80%"></div>
          <div class="line" style="width: 100%"></div>
          <div class="line" style="width: 90%"></div>
          <div class="line"></div>
        </div>
      </div>
    </div> -->
    <section class="featured-section">
      <div class="featured-card">
        <div class="featured-image">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
          <?php else: ?>
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80" alt="<?php the_title(); ?>" />
          <?php endif; ?>
          <div class="featured-tag">Featured</div>
        </div>
      </div>
    </section>
  </div>
</section>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 8,
    'category_name' => 'success stories',
    'paged' => $paged
);

$blog_query = new WP_Query($args);

if ($blog_query->have_posts()) :
    $first_post = true;
    $post_count = 0;
?>

<!-- FEATURED POST (First Post) -->
<?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
  <?php if ($first_post) : ?>
    

    <!-- POSTS GRID -->
    <section class="posts-section">
      <div class="page-wrapper">

        <div class="masonry-grid">
    <?php 
      $first_post = false;
    endif; 
    ?>

    <?php if (!$first_post) : ?>
      <!-- POST CARD -->
      <article class="post-card">
        <div class="post-image-wrap">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('large', array('class' => 'post-image')); ?>
            <?php else: ?>
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&w=800&q=80" alt="<?php the_title(); ?>" class="post-image" />
            <?php endif; ?>
          </a>
          <div class="post-category">Insights</div>
        </div>
        <div class="post-content">
          <div class="post-date">
            <i class="far fa-calendar-alt"></i>
            <?php echo get_the_date('M d, Y'); ?>
          </div>
          <h3 class="post-title">
            <a href="<?php the_permalink(); ?>">
              <?php the_title(); ?>
            </a>
          </h3>
          <p class="post-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
          </p>
          <div class="post-footer">
            <div class="post-author">
              <div class="author-avatar">
                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
              </div>
              <span><?php the_author(); ?></span>
            </div>
            <div class="read-time">
              <i class="far fa-clock"></i>
              5 min
            </div>
          </div>
        </div>
      </article>
    <?php endif; ?>

    <?php 
  $post_count++;
  endwhile; 
?>

        </div> <!-- .masonry-grid -->

        <!-- PAGINATION -->
        <?php if ($blog_query->max_num_pages > 1) : ?>
        <div class="pagination-wrapper">
          <?php
          echo paginate_links(array(
              'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'format' => 'page/%#%/',
              'current' => max(1, get_query_var('paged')),
              'total' => $blog_query->max_num_pages,
              'prev_text' => '<i class="fas fa-chevron-left"></i> <span>Previous</span>',
              'next_text' => '<span>Next</span> <i class="fas fa-chevron-right"></i>',
              'type' => 'list',
              'end_size' => 1,
              'mid_size' => 2
          ));
          ?>
        </div>
        <?php endif; ?>

      </div>
    </section>

<script>
jQuery(document).ready(function($) {
    // Store the current query details
    var ajaxData = {
        action: 'load_posts_ajax',
        category: <?php echo is_category() ? get_queried_object_id() : 0; ?>,
        tag: <?php echo is_tag() ? get_queried_object_id() : 0; ?>,
        author: <?php echo is_author() ? get_queried_object_id() : 0; ?>,
        search: '<?php echo esc_js(get_search_query()); ?>',
        posts_per_page: 8,
        max_pages: <?php echo $blog_query->max_num_pages; ?>
    };
    
    // Function to animate cards after loading
    function initCardAnimations() {
        var cards = document.querySelectorAll('.post-card:not(.visible)');
        cards.forEach(function(card, index) {
            setTimeout(function() {
                card.classList.add('visible');
            }, index * 100);
        });
    }
    
    // AJAX Pagination
    $(document).on('click', '.pagination-wrapper a.page-numbers', function(e) {
        e.preventDefault();
        
        var link = $(this).attr('href');
        var page = 1;
        
        // Extract page number from URL
        var matches = link.match(/paged=(\d+)/);
        if (matches) {
            page = parseInt(matches[1]);
        } else {
            matches = link.match(/page\/(\d+)/);
            if (matches) {
                page = parseInt(matches[1]);
            }
        }
        
        loadPosts(page);
    });
    
    function loadPosts(page) {
        var $grid = $('.masonry-grid');
        var $section = $('.posts-section');
        
        // Add loading state
        $grid.addClass('loading');
        
        // Scroll to top of posts section smoothly
        $('html, body').animate({
            scrollTop: $section.offset().top - 100
        }, 600);
        
        // Prepare AJAX data
        var data = $.extend({}, ajaxData, { page: page });
        
        $.ajax({
            url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log('AJAX Response:', response);
                
                if (response.success && response.data) {
                    // Replace content
                    $grid.html(response.data.posts);
                    
                    // Replace pagination
                    if (response.data.pagination) {
                        $('.pagination-wrapper').replaceWith(response.data.pagination);
                    } else {
                        $('.pagination-wrapper').remove();
                    }
                    
                    // Remove loading state
                    $grid.removeClass('loading');
                    
                    // Re-initialize card animations after content loads
                    setTimeout(function() {
                        if (typeof window.initPostCardObserver === 'function') {
                            window.initPostCardObserver();
                        } else {
                            initCardAnimations();
                        }
                    }, 50);
                    
                    // Reinitialize masonry if you're using it
                    if (typeof $.fn.masonry !== 'undefined') {
                        setTimeout(function() {
                            $grid.masonry('reloadItems').masonry('layout');
                        }, 100);
                    }
                    
                    // URL stays the same - no history update needed
                } else {
                    $grid.removeClass('loading');
                    console.error('Invalid response:', response);
                    alert('Error loading posts. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                $grid.removeClass('loading');
                console.error('AJAX Error:', {xhr: xhr, status: status, error: error});
                alert('Error loading posts. Please refresh the page.');
            }
        });
    }
});
</script>

<?php
else :
    echo '<section class="posts-section"><div class="page-wrapper" style="text-align:center; padding:60px 20px;"><p>No posts found.</p></div></section>';
endif;
wp_reset_postdata();
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Stagger animation for post cards - using IntersectionObserver
  function initPostCardObserver() {
    const cards = document.querySelectorAll('.post-card:not(.visible)');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const allCards = document.querySelectorAll('.post-card');
          const index = [...allCards].indexOf(entry.target);
          setTimeout(() => {
            entry.target.classList.add('visible');
          }, (index % 8) * 100); // Modulo to reset stagger for each page
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    cards.forEach(card => observer.observe(card));
  }
  
  // Initialize on page load
  initPostCardObserver();
  
  // Make function globally available for AJAX reinitialization
  window.initPostCardObserver = initPostCardObserver;

  // Live Search
  const searchInput = document.getElementById('hero-search-input');
  const resultsContainer = document.getElementById('live-search-results');
  let searchTimeout;

  if (searchInput && resultsContainer) {
    searchInput.addEventListener('input', function() {
      clearTimeout(searchTimeout);
      const query = this.value.trim();

      if (query.length < 2) {
        resultsContainer.innerHTML = '';
        resultsContainer.style.display = 'none';
        return;
      }

      searchTimeout = setTimeout(() => {
        const ajaxUrl = (typeof global_ajax_object !== 'undefined') ? global_ajax_object.ajax_url : '/wp-admin/admin-ajax.php';
        
        const formData = new FormData();
        formData.append('action', 'live_search_posts');
        formData.append('keyword', query);

        fetch(ajaxUrl, {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(html => {
          if (html.trim()) {
            resultsContainer.innerHTML = html;
            resultsContainer.style.display = 'block';
          } else {
            resultsContainer.innerHTML = '<div class="no-results">No results found</div>';
            resultsContainer.style.display = 'block';
          }
        })
        .catch(error => console.error('Search error:', error));
      }, 300);
    });

    // Close on outside click
    document.addEventListener('click', function(e) {
      if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
        resultsContainer.style.display = 'none';
      }
    });
  }

});
</script>

<?php get_footer(); ?>