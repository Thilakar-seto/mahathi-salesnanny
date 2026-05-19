<?php
/*
 * Template Name: Glossary by Letter
 */
include 'header.php';
// Get the selected letter from the URL query string
$selected_letter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : 'A';
?>
<style>
  /* Reset and base styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    
    color: #333;
    background-color: #f9f9f9;
    line-height: 1.6;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
  }

  /* Header section */
  .glossary-header {
    background: #041a41;
    padding: 100px 120px 50px;
    position: relative;
    overflow: hidden;
}

  .glossary-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: url('/wp-content/themes/fosdesk/image/glossary1.webp') no-repeat right center;
    background-size: cover;
    opacity: 0.15;
    z-index: 1;
  }

  .header-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
  }

  .header-content h1 {
    font-size: 3.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 20px;
    line-height: 1.1;
  }

  .header-content p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.85);
    max-width: 700px;
    margin-bottom: 30px;
}

  /* Alphabet navigation */
  .alphabet-nav-container {
    padding: 0 120px;
  }

  @media screen and (max-width: 768px) {
    .alphabet-nav-container, .glossary-header {
      padding-left: 20px;
      padding-right: 20px;
    }
  }

  .alphabet-nav {
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    padding: 5px;
    margin-top: -25px;
    position: relative;
    z-index: 10;
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
  }

  .alphabet-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(40px, 1fr));
    gap: 5px;
  }

  .alphabet-grid a {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    font-weight: 500;
    color: #555;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
  }

  .alphabet-grid a:hover {
    background: #f3f4f6;
    color: #FF4916;
  }

  .alphabet-grid a.selected {
    background: #FF4916;
    color: white;
    font-weight: 600;
  }

  /* Terms section */
  .terms-section {
    padding: 60px 120px;
  }

  .section-heading {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
  }

  .section-heading h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
  }

  .letter-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: #FF4916;
    color: white;
    font-size: 2rem;
    font-weight: 700;
    border-radius: 12px;
    margin-right: 20px;
    box-shadow: 0 5px 15px rgba(218, 29, 43, 0.2);
  }

  /* Glossary terms grid */
  .terms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
  }

  .term-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    overflow: hidden;
    display: block;
    text-decoration: none;
    color: #333;
    position: relative;
  }

  .term-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .term-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    background: #FF4916;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .term-card:hover::before {
    opacity: 1;
  }

  .term-content {
    padding: 25px;
  }

  .term-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
  }

  .empty-state {
    background: white;
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  }

  .empty-state h3 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 15px;
  }

  .empty-state p {
    color: #666;
    max-width: 500px;
    margin: 0 auto;
  }

  /* Responsive styles */
  @media screen and (max-width: 768px) {
    .container {
      padding: 0 20px;
    }

    .glossary-header {
      padding: 80px 0 40px;
    }

    .header-content h1 {
      font-size: 2.5rem;
    }

    .header-content p {
      font-size: 1rem;
    }

    .alphabet-grid {
      grid-template-columns: repeat(auto-fit, minmax(30px, 1fr));
    }

    .alphabet-grid a {
      height: 35px;
    }

    .section-heading h2 {
      font-size: 1.5rem;
    }

    .letter-badge {
      width: 45px;
      height: 45px;
      font-size: 1.5rem;
    }

    .terms-grid {
      grid-template-columns: 1fr;
    }

    .terms-section {
      padding: 40px 0;
    }
  }

  @media (max-width: 1090px) {
    .alphabet-nav-container, .glossary-header  {
                padding: 16px 40px !important;
            }
        }
</style>

<!-- Header Section -->
<section class="glossary-header">
  <div class="container">
    <div class="header-content">
      <h1>Supply Chain Glossary Terms</h1>
      <p>This glossary of supply chain terms provides detailed explanations through our mini blogs.  Continue reading to increase your vocabulary and gain insight into the supply chain visibility with these terms!</p>
    </div>
  </div>
</section>

<!-- Alphabet Navigation -->
<div class="alphabet-nav-container">
  <div class="alphabet-nav">
    <div class="alphabet-grid">
      <?php
      foreach (range('A', 'Z') as $letter) {
          $class = ($letter == $selected_letter) ? 'selected' : '';
          echo '<a class="' . $class . '" href="?letter=' . $letter . '">' . $letter . '</a>';
      }
      ?>
    </div>
  </div>
</div>

<!-- Terms Section -->
<section class="terms-section">
  <div class="container">
    <div class="section-heading">
      <div class="letter-badge"><?php echo $selected_letter; ?></div>
      <h2>Glossary Terms</h2>
    </div>
    
    <?php
    // Get glossary terms for the selected letter
    $args = array(
        'post_type' => 'glossary',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'first_letter',
                'value' => $selected_letter,
                'compare' => '='
            )
        )
    );
    $glossary_query = new WP_Query($args);

    // Display the glossary terms
    if ($glossary_query->have_posts()) {
        echo '<div class="terms-grid">';
        while ($glossary_query->have_posts()) {
            $glossary_query->the_post();
            echo '<a href="' . get_permalink() . '" class="term-card">
                    <div class="term-content">
                        <h3 class="term-title">' . get_the_title() . '</h3>
                    </div>
                  </a>';
        }
        echo '</div>';
    } else {
        echo '<div class="empty-state">
                <h3>No terms found for "' . $selected_letter . '"</h3>
                <p>We don\'t have any glossary terms starting with this letter yet. Please try selecting another letter from the navigation above.</p>
              </div>';
    }
    wp_reset_postdata();
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>