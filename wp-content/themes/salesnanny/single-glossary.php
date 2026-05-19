<?php
/*
Template Name: Glossary archieve
*/
include 'header.php';
?>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9f9f9;
    color: #333;
  }

  /* Hero Section */
  .glossary-hero {
    position: relative;
    height: 340px;
    display: flex;
    align-items: center;
    background-color: #041a41;
    overflow: hidden;
    padding: 0 120px;
  }
  
  .glossary-hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('/wp-content/themes/fosdesk/image/glossary1.webp');
    background-size: cover;
    background-position: center;
    opacity: 0.15;
    z-index: 0;
  }

  .hero-content {
    max-width: 1400px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }
  
  .hero-content h1 {
    font-size: clamp(50.4px, 3.316vw, 56px);
    font-weight: 700;
    color: #fff;
    margin-bottom: 15px;
  }
  
  .hero-content h1 span {
    color: #ff4916;
  }

  .hero-content p {
    font-size: clamp(15.8px, 1.194vw, 18px);
    line-height: 1.6;
    color: #e0e0e0;
    max-width: 600px;
  }

  /* Main Content */
  .glossary-section {
    padding: 0 40px;
  }
  .glossary-container {
    max-width: 1280px;
    width: 100%;
    margin: 0 auto;
    padding: 60px 0px;
    display: flex;
    gap: 40px;
    position: relative;
  }

  /* Sidebar */
  .glossary-sidebar {
    width: 280px;
    flex-shrink: 0;
    position: sticky;
    top: 105px;
    height: fit-content;
    align-self: flex-start;
  }
  
  .letter-navigation {
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin-bottom: 30px;
  }
  
  .letter-navigation h3 {
    font-size: clamp(16.2px, 1.194vw, 18px);
    margin-bottom: 15px;
    position: relative;
    padding-bottom: 10px;
  }
  
  .letter-navigation h3::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: #ff4916;
  }
  
  .letter-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 8px;
  }
  
  .letter-grid a {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    font-weight: 600;
    background: #f5f5f5;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.2s ease;
  }
  
  .letter-grid a:hover,
  .letter-grid a.active {
    background: #ff4916;
    color: #fff;
  }

  /* Content */
  .glossary-content {
    flex: 1;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    overflow: hidden;
  }
  
  .glossary-header {
    padding: 30px 35px;
    border-bottom: 1px solid #eee;
    position: relative;
  }
  
  .glossary-header h2 {
    font-size: clamp(34.6px, 2.321vw, 35px);
    color: #222;
    margin-bottom: 5px;
    line-height: 1.3;
  }
  
  .glossary-meta {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #666;
  }
  
  .term-categories {
    margin-left: 15px;
    display: flex;
    gap: 8px;
  }
  
  .term-category {
    padding: 3px 10px;
    background: #f0f0f0;
    border-radius: 4px;
    color: #555;
    font-size: 13px;
  }
  
  .first-letter {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: clamp(72px, 5.305vw, 80px);
    font-weight: 800;
    color: #f0f0f0;
    line-height: 1;
  }

  .glossary-body {
    padding: 35px;
  }
  
  .term-definition {
    color: #000;
    line-height: 1.8; /* This is for the container, p overrides it */
    background-color: #fff;
    padding: 32px;
    border-radius: 8px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    font-size: clamp(16.2px, 1.194vw, 18px);
    letter-spacing: 0.01em;
  }
  
  /* === SPACING REDUCTION START === */
  
  /* Remove margin from the last element to prevent extra space at the bottom */
  .term-definition > :last-child {
      margin-bottom: 0 !important;
  }
  
  .term-definition p {
      margin-bottom: 16px; /* Reduced from 24px */
      font-size: clamp(16.2px, 1.194vw, 18px);
      font-weight: 500;
      line-height: 1.6; /* Tighter line height */
  }
    
  .term-definition h2 {
      font-size: clamp(27px, 1.990vw, 30px);
      margin: 30px 0 10px; /* Reduced from 45px 0 22px */
      color: #ff4916;
      position: relative;
      padding-bottom: 14px;
      letter-spacing: -0.02em;
  }
  
  .term-definition h2::after {
      content: "";
      position: absolute;
      bottom: 15px;
      left: 0;
      width: 50px;
      height: 3px;
      background: #ff4916;
  }
    
  .term-definition h3 {
      font-size: clamp(23.4px, 1.723vw, 26px);
      margin: 24px 0 8px; 
      color: #041a41;
      position: relative;
      padding-bottom: 12px;
      letter-spacing: -0.02em;
  }
    
  .term-definition h3::after {
      content: "";
      position: absolute;
      bottom: 15px;
      left: 0;
      width: 45px;
      height: 3px;
      background: #041a41;
  }
    
  .term-definition h4 {
      font-size: clamp(19.8px, 1.458vw, 22px);
      margin: 20px 0 8px; /* Reduced from 35px 0 18px */
      color: #041a41;
      position: relative;
      padding-bottom: 10px;
      letter-spacing: -0.01em;
  }
    
  .term-definition h4::after {
      content: "";
      position: absolute;
      bottom: 15px;
      left: 0;
      width: 40px;
      height: 3px;
      background: #041a41;
  }
    
  .term-definition h5 {
      font-size: clamp(18px, 1.326vw, 20px);
      margin: 20px 0 8px; /* Reduced from 30px 0 16px */
      color: #041a41;
      position: relative;
      padding-bottom: 8px;
  }
    
  .term-definition h5::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 35px;
      height: 2px;
      background: #041a41;
  }
    
  .term-definition h6 {
      font-size: clamp(16.2px, 1.194vw, 18px);
      margin: 20px 0 8px; /* Reduced from 25px 0 15px */
      color: #041a41;
      position: relative;
      padding-bottom: 6px;
  }
    
  .term-definition h6::after {
      content: "";
      position: absolute;
      bottom: 15px;
      left: 0;
      width: 30px;
      height: 2px;
      background: #041a41;
  }
    
  .term-definition h2 b,
  .term-definition h2 {
      color: #ff4916;
  }

  
  .term-definition h3 b,
  .term-definition h4 b,
  .term-definition h5 b,
  .term-definition h6 b,
  .term-definition h3,
  .term-definition h4,
  .term-definition h5,
  .term-definition h6 {
      color: #041a41;
  }

 
    
  .term-definition ul, 
  .term-definition ol {
      margin-bottom: 16px; /* Reduced from 30px */
      padding-left: 28px;
  }
    
  .term-definition li {
      margin-bottom: 8px; /* Reduced from 14px */
      font-size: clamp(16.2px, 1.194vw, 18px);
      color: #222;
  }
    
  .term-definition a {
      color: #ff4916;
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: border-color 0.2s;
      font-weight: 500;
  }
    
  .term-definition a:hover {
      border-color: #ff4916;
  }

  .term-definition strong, .term-definition b {
      font-weight: 700;
  }

  .term-definition blockquote {
      margin: 24px 0 16px; /* Reduced from 30px 0 */
      padding: 20px 30px;
      background-color: #f5f5f5;
      border-left: 4px solid #ddd;
      font-style: italic;
      color: #444;
  }

  /* === SPACING REDUCTION END === */

  /* Related Terms */
  .related-terms {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #eee;
  }
  
  .related-terms h3 {
    font-size: clamp(18px, 1.326vw, 20px);
    margin-bottom: 20px;
    color: #222;
  }
  
  .terms-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  
  .terms-list a {
    display: inline-block;
    padding: 8px 15px;
    background: #f5f5f5;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.2s ease;
  }
  
  .terms-list a:hover {
    background: #ff4916;
    color: #fff;
  }

  /* Reading Progress */
  .reading-progress-container {
    position: fixed;
    width: 100%;
    height: 5px;
    top: 0;
    left: 0;
    z-index: 999;
  }
  
  .reading-progress-bar {
    height: 100%;
    width: 0;
    background-color: #ff4916;
    transition: width 0.1s;
  }

  /* Media Queries */
  @media screen and (max-width: 1024px) {
    .glossary-container { flex-direction: column; }
    .glossary-sidebar { width: 100%; position: relative; top: 0; }
  }

  @media screen and (max-width: 768px) {
    .glossary-hero { height: 280px; padding: 0 20px; }
    .glossary-section { padding: 0 10px; }
    .hero-content { padding: 0 20px; text-align: center; }
    .hero-content h1 { font-size: clamp(34.6px, 2.321vw, 35px); }
    .hero-content p { font-size: clamp(14.4px, 1.061vw, 16px); margin: 0 auto; }
    .glossary-container { padding: 40px 20px; }
    .glossary-header h2 { font-size: clamp(28.8px, 1.989vw, 30px); }
    .first-letter { font-size: clamp(45px, 3.316vw, 50px); opacity: 0.15; }
    .glossary-header, .glossary-body { padding: 25px; }
    .term-definition { padding: 25px; font-size: clamp(15.3px, 1.128vw, 17px); }
    .term-definition p, .term-definition li { font-size: clamp(15.3px, 1.128vw, 17px); }
    .term-definition h3 { font-size: clamp(21.6px, 1.592vw, 24px); }
  }

  @media screen and (max-width: 480px) {
    .glossary-meta { flex-direction: column; align-items: flex-start; gap: 10px; }
    .term-categories { margin-left: 0; }
    .letter-grid { grid-template-columns: repeat(4, 1fr); }
  }

  @media print {
    .glossary-hero, .glossary-sidebar, .reading-progress-container { display: none; }
    .glossary-container { padding: 0; }
    .glossary-content { box-shadow: none; }
  }
</style>

<!-- ... rest of your HTML and PHP code remains the same ... -->
<div class="reading-progress-container">
  <div class="reading-progress-bar" id="progress-bar"></div>
</div>

<section class="glossary-hero">
  <div class="hero-content">
    <h1>Supply Chain <span>Glossary</span></h1>
    <p>This supply chain glossary terms provides detailed explanations through our mini blogs.  Continue reading to increase your vocabulary and gain insight into the supply chain visibility with these terms!</p>
  </div>
</section>

<div class="glossary-section">
<div class="glossary-container">
  <aside class="glossary-sidebar">
    <div class="letter-navigation">
      <h3>Browse by letter</h3>
      <div class="letter-grid">
        <?php
        $alphabet = range('A', 'Z');
        $current_letter = strtoupper(substr(get_the_title(), 0, 1));
        
        foreach ($alphabet as $letter) {
          $active_class = ($letter == $current_letter) ? 'active' : '';
          echo '<a href="'.home_url().'/letter?letter=' . $letter . '" class="' . $active_class . '">' . $letter . '</a>';
        }
        ?>
      </div>
    </div>
  </aside>
  
  <main class="glossary-content">
    <header class="glossary-header">
      <h2><?php the_title(); ?></h2>
      <div class="glossary-meta">
        <span class="term-updated">Last updated: <?php echo get_the_modified_date(); ?></span>
        <div class="term-categories">
          <span class="term-category">Logistics</span>
          <span class="term-category">Supply Chain</span>
        </div>
      </div>
      <div class="first-letter">
        <?php
        $title = get_the_title();
        $first_letter = strtoupper(substr($title, 0, 1));
        echo $first_letter;
        ?>
      </div>
    </header>
    
    <div class="glossary-body">
      <div class="term-definition">
        <?php the_content(); ?>
      </div>
      
      <div class="related-terms">
        <h3>Related Terms</h3>
        <div class="terms-list">
          <?php
          $current_post_id = get_the_ID();
          $current_title = get_the_title();
          $first_letter = strtoupper(substr($current_title, 0, 1));
          
          $related_terms_query = new WP_Query(array(
            'post_type' => 'glossary', 
            'posts_per_page' => 10,
            'post__not_in' => array($current_post_id), 
            'meta_query' => array(
              array(
                'key' => '_first_letter',
                'value' => $first_letter,
                'compare' => '='
              )
            )
          ));
          
          if (!$related_terms_query->have_posts()) {
            add_filter('posts_where', function($where, $query) {
                global $wpdb;
                if ($letter = $query->get('title_starts_with')) {
                    $where .= " AND $wpdb->posts.post_title LIKE '" . esc_sql($wpdb->esc_like($letter)) . "%'";
                }
                return $where;
            }, 10, 2);

            $related_terms_query = new WP_Query(array(
                'post_type' => 'glossary',
                'posts_per_page' => 10,
                'post__not_in' => array($current_post_id),
                'title_starts_with' => $first_letter
            ));
            remove_filter('posts_where', 'my_posts_where', 10, 2);
          }
          
          if ($related_terms_query->have_posts()) {
            while ($related_terms_query->have_posts()) {
              $related_terms_query->the_post();
              echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            }
            wp_reset_postdata();
          } else {
            echo '<p>No related terms found.</p>';
          }
          ?>
        </div>
      </div>
    </div>
  </main>
</div>
</div>
<script>
  window.addEventListener('scroll', function() {
    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;
    document.getElementById("progress-bar").style.width = scrolled + "%";
  });
  
  document.querySelectorAll('.letter-grid a').forEach(link => {
    link.addEventListener('click', function(e) {
      window.location.href = this.getAttribute('href');
    });
  });
</script>

<?php include 'footer.php'; ?>