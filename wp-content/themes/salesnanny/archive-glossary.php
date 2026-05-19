<?php
/*
Template Name: Glossary
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
    background-color: #f7f9fc;
    color: #333;
  }

  .glossaryhero {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    background: #041a41;
    color: #fff;
    height: 60vh;
    width: 100%;
    overflow: hidden;
    padding: 0 40px;
}

  .glossaryhero-container {
    max-width: 1280px;
    width: 100%;
    margin: 0 auto;
  }

  .glossaryhero-content {
    max-width: 600px;
    position: relative;
  }

  .glossaryhero h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 18px;
    line-height: 1.1;
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
}
  
  .glossaryhero h1::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 9%;
    transform: translateX(-50%);
    width: 100px;
    height: 6px;
    background-color: #FF5C35;
    display: block;
    margin-top: 10px;
    z-index: 2;
  }

  .glossaryhero p {
    font-size: 1rem;
    line-height: 1.5;
    opacity: 0.9;
}
  
  .container {
    max-width: 1280px;
    margin: 0 auto;
    position: relative;
  }
  
  .glossary-section {
    padding: 0 40px;
    position: relative;
  }
  
  .glossary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
    margin-top: 50px;
  }

  .glossarycard {
    position: relative;
    background-color: #fff;
    border-radius: 12px;
    padding: 35px 30px;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-top: 5px solid transparent;
  }

  .glossarycard:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(218, 29, 43, 0.15);
    border-top: 5px solid #ff4916;
  }

  .definitions-list {
    list-style: none;
    margin-bottom: 25px;
    position: relative;
    z-index: 1;
  }

  .definitions-list li {
    margin-bottom: 12px;
    position: relative;
    padding-left: 15px;
  }
  
  /* .definitions-list li::before {
    content: "•";
    color: #ff4916;
    font-weight: bold;
    position: absolute;
    left: 0;
  } */

  .definitions-list li a {
    color: #444;
    text-decoration: none;
    font-size: 17px;
    font-weight: 600;
    letter-spacing: 0.2px;
    transition: all 0.3s ease;
    display: inline-block;
    max-width: 257px;
}

  .definitions-list li a:hover {
    color: #ff4916;
    transform: translateX(3px);
  }

  .more-definitions {
    display: inline-block;
    margin-top: 10px;
    position: relative;
    z-index: 1;
  }

  .more-definitions a {
    color: #ff4916;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
  }
  
  .more-definitions a::after {
    content: "→";
    margin-left: 5px;
    transition: transform 0.3s ease;
  }
  
  .more-definitions a:hover::after {
    transform: translateX(5px);
  }

  .big-letter {
    position: absolute;
    right: 10px;
    bottom: 10px;
    font-size: 150px;
    font-weight: 900;
    color: rgba(0,0,0,0.04);
    line-height: 0.8;
    z-index: 0;
    transition: all 0.4s ease;
  }

  .glossarycard:hover .big-letter {
    color: rgba(218, 29, 43, 0.05);
    transform: scale(1.2);
  }
  
  /* .section-title {
    text-align: center;
    margin-bottom: 50px;
  }
  
  .section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
  }
  
  .section-title h2::after {
    content: '';
    position: absolute;
    width: 80px;
    height: 4px;
    background-color: #ff4916;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
  }
  
  .section-title p {
    max-width: 600px;
    margin: 20px auto 0;
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
  } */

  @media screen and (max-width: 1024px) {
    .glossaryhero h1 {
      font-size: 4rem;
    }
    
    .glossary-grid {
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
  }

  @media screen and (max-width: 768px) {
    .glossaryhero {
        height: auto;
        min-height: 50vh;
        text-align: center;
        justify-content: center;
        padding: 60px 20px;
    }
    
    .glossaryhero h1 {
        font-size: 32px;
        margin-bottom: 30px;
        padding-bottom: 15px;
    }
    
    .glossaryhero h1::after {
        width: 100px;
        height: 3px;
    }
    
    .glossaryhero p {
        font-size: 16px;
        line-height: 1.5;
    }
    
    .container, .glossaryhero-container {
        padding: 0;
    }
    
    .glossary-section {
        padding: 40px 20px;
    }
    
    .glossaryhero h1::after {
      left: 50%;
      transform: translateX(-50%);
    }
    
    .glossary-grid {
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
    }
  }

  @media screen and (max-width: 480px) {
    .glossaryhero h1 {
      font-size: 2.5rem;
    }
    
    .glossaryhero p {
      font-size: 1rem;
    }
    
    .glossary-grid {
      grid-template-columns: 1fr;
    }
    
    .section-title h2 {
      font-size: 1.8rem;
    }
    
    .big-letter {
      font-size: 120px;
    }
  }
</style>
<section class="glossaryhero">
  <div class="glossaryhero-container">
    <div class="glossaryhero-content">
      <h1>Glossary Guide for Supply Chain Visibility</h1>
      <p>Explore our comprehensive Glossary Guide for Supply Chain Visibility – a clear and concise resource defining key terms, technologies, and concepts that enhance transparency, tracking, and performance across global supply chain operations. Perfect for logistics professionals and businesses aiming to stay informed.</p>
    </div>
  </div>
</section>

<div class="glossary-section">
  <div class="container">
    <!-- <div class="section-title">
      <h2>Navigate Logistics Terms</h2>
      <p>Browse our comprehensive collection of logistics and supply chain management terminology organized alphabetically.</p>
    </div> -->
    <div class="glossary-grid"> 
    <?php
    // Get all glossary terms
    $args = array(
        'post_type' => 'glossary',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    );
    $glossary_query = new WP_Query($args);

    // Loop through glossary terms to organize them alphabetically
    $glossary_terms = array();
    if ($glossary_query->have_posts()) {
        while ($glossary_query->have_posts()) {
            $glossary_query->the_post();
            $title = get_the_title();
            $first_letter = strtoupper(substr($title, 0, 1));
            $glossary_terms[$first_letter][] = array(
                'title' => $title,
                'permalink' => get_permalink(),
            );
        }
    }
    wp_reset_postdata();

    // Output glossary terms organized alphabetically with limit
    foreach (range('A', 'Z') as $letter) {
        if (isset($glossary_terms[$letter])) {
            echo '
			<div class="glossarycard">';
            echo '
				<ul class="definitions-list">';
            $count = 0;
            foreach ($glossary_terms[$letter] as $term) {
                if ($count < 8) {
                    echo '
				<li>
					<a href="' . esc_url($term['permalink']) . '" class="link underline-trail w-inline-block">' . esc_html($term['title']) . '</a>
				</li>';
                    $count++;
                } else {
                    break;
                }
            }
            echo '
				</ul>';

            // Calculate remaining terms
            $remaining_terms = count($glossary_terms[$letter]) - $count;
            if ($remaining_terms > 0) {
                echo '
				<p class="more-definitions">';
                echo '
					<a href="/letter/?letter=' . $letter . '" class="link w-inline-block more-definitions">' . $remaining_terms . ' More Definitions</a>';
                echo '
				</p>';
            }
            echo '
				<div class="big-letter">' . $letter . '</div>';

            echo '
			</div>';
        }
    }
    ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>






