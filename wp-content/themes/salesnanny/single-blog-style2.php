<?php
/**
 * The template for displaying all single posts
 */
get_header();

// --- Calculate Reading Time ---
$word_count = str_word_count( strip_tags( get_post_field( 'post_content', get_the_ID() ) ) );
$reading_time = ceil( $word_count / 200 ); // Average 200 words per minute
?>

    <style>
        /* --- CSS Variables / Design System --- */
        :root {
            --primary: #E62E2D;       /* Vibrant Red */
            --primary-hover: #cc2524;
            --dark: #111111;          /* Deep Charcoal/Black */
            --gray-bg: #F9FAFB;       /* Very Light Gray */
            --text-gray: #4b5563;
            --text-dark: #1f2937;
            --text-light: #9ca3af;
            --border-color: #e5e7eb;
            --white: #ffffff;
            --custom-gradient: linear-gradient(135deg, #7a0f1c, #c31432, #240b36);
            --font-main: 'Inter', sans-serif;
        }

        /* --- Reset & Base Styles --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-main); color: var(--text-gray); background-color: var(--gray-bg); line-height: 1.6; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; transition: color 0.2s ease; }
        img { max-width: 100%; height: auto; display: block; }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }

        /* --- Buttons --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.875rem 1.5rem; border-radius: 0.5rem; font-weight: 600; transition: all 0.3s ease; gap: 0.5rem; border: none; cursor: pointer;}
        .btn svg { width: 18px; height: 18px; transition: transform 0.3s ease; }
        .btn:hover svg { transform: translateX(4px); }
        .btn-primary { background-color: var(--primary); color: var(--white); box-shadow: 0 4px 6px -1px rgba(230, 46, 45, 0.2); }
        .btn-primary:hover { background-color: var(--primary-hover); box-shadow: 0 10px 15px -3px rgba(230, 46, 45, 0.3); }
        .btn-dark { background-color: var(--dark); color: var(--white); }
        .btn-dark:hover { background-color: #000; }

        /* --- Hero Section (Section 1) --- */
        .single-hero {
            position: relative; background: var(--custom-gradient);
            padding: 8rem 0 10rem 0; overflow: hidden; color: var(--white);
        }
        
        .hero-pattern {
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0);
            background-size: 32px 32px; z-index: 1;
        }

        .hero-grid {
            position: relative; z-index: 2;
            display: grid; grid-template-columns: 1fr; gap: 4rem; align-items: center;
        }
        @media (min-width: 1024px) {
            .hero-grid { grid-template-columns: 1.2fr 0.8fr; }
        }

        /* Hero Left: Content */
        .breadcrumbs {
            display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem;
            font-size: 0.875rem; font-weight: 500; color: rgba(255,255,255,0.7);
            margin-bottom: 2rem;
        }
        .breadcrumbs a:hover { color: var(--white); }
        .breadcrumbs .separator { color: var(--primary); font-weight: bold; }
        .breadcrumbs .current { color: var(--white); }

        .single-title  {
            font-size: 2.35rem;
            line-height: 1.15;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
        }

        .single-title .highlight {
            font-size: 2.35rem;
            line-height: 1.15;
            font-weight: 800;
            background: linear-gradient(90deg, #f5c542, #ffea8a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 0.25rem;
        }
        .hero-meta {
            display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;
            border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem;
        }
        .meta-author { display: flex; align-items: center; gap: 0.75rem; }
        .meta-author img { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255,255,255,0.2); }
        .author-info strong { display: block; font-size: 1rem; color: var(--white); font-weight: 600; }
        .author-info span { font-size: 0.875rem; color: rgba(255,255,255,0.7); }
        
        .meta-date { display: flex; align-items: center; gap: 0.5rem; color: rgba(255,255,255,0.8); font-size: 0.9375rem; font-weight: 500; }
        .meta-date svg { width: 18px; height: 18px; color: var(--primary); }

        /* Hero Right: Featured Image */
        .hero-image-wrapper {
            position: relative; border-radius: 1.5rem; overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            transform: translateY(20px);
        }
        .hero-image-wrapper img { width: 100%; height: 100%; object-fit: cover; aspect-ratio: 4/3; }
        .hero-image-wrapper::after {
            content: ''; position: absolute; inset: 0;
            border: 1px solid rgba(255,255,255,0.2); border-radius: 1.5rem; pointer-events: none;
        }

        /* Sweeping Curve */
        .hero-curve { position: absolute; bottom: -1px; left: 0; width: 100%; line-height: 0; z-index: 10; }
        .hero-curve svg { display: block; width: 100%; height: 60px; }
        @media (min-width: 1024px) { .hero-curve svg { height: 120px; } }
        .hero-curve path { fill: var(--gray-bg); }

        /* --- Main Content Area (Section 2) --- */
        .content-section { padding: 4rem 0 8rem; position: relative; z-index: 20; }
        .content-layout {
            display: grid; grid-template-columns: 1fr; gap: 4rem;
        }
        @media (min-width: 1024px) {
            .content-layout { grid-template-columns: 1fr 350px; }
        }

        .article-content {
            background: var(--white); padding: 2.5rem; border-radius: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid var(--border-color);
        }
        @media (min-width: 768px) { .article-content { padding: 4rem; } }

        .article-content h2 { font-size: 2rem; font-weight: 700; color: var(--dark); margin: 3rem 0 1.25rem; line-height: 1.3; }
        .article-content h2:first-child { margin-top: 0; }
        .article-content h3 { font-size: 1.5rem; font-weight: 600; color: var(--dark); margin: 2rem 0 1rem; }
        .article-content p { font-size: 1.125rem; color: var(--text-gray); margin-bottom: 1.5rem; line-height: 1.8; }
        .article-content a { color: var(--primary); font-weight: 500; text-decoration: underline; text-decoration-color: transparent; transition: all 0.2s; }
        .article-content a:hover { text-decoration-color: var(--primary); }
        .article-content ul, .article-content ol { margin-bottom: 1.5rem; padding-left: 1.5rem; font-size: 1.125rem; line-height: 1.8; color: var(--text-gray); }
        .article-content li { margin-bottom: 0.5rem; }
        .article-content li::marker { color: var(--primary); font-weight: bold; }
        .article-content blockquote {
            background-color: var(--gray-bg); border-left: 4px solid var(--primary);
            padding: 2rem; margin: 2.5rem 0; border-radius: 0 1rem 1rem 0;
            font-size: 1.25rem; font-style: italic; font-weight: 500; color: var(--text-dark);
        }
        .article-content img { border-radius: 1rem; margin: 3rem 0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }

        .article-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border-color); }
        .tag { background: var(--gray-bg); border: 1px solid var(--border-color); color: var(--text-dark); font-size: 0.875rem; font-weight: 600; padding: 0.5rem 1rem; border-radius: 0.5rem; transition: all 0.2s; }
        .tag:hover { border-color: var(--primary); color: var(--primary); }

        .sidebar { position: relative; }
        .sticky-wrapper { position: sticky; top: 100px; }
        .cta-banner {
            background: var(--dark); border-radius: 1.5rem; padding: 2.5rem 2rem;
            color: var(--white); text-align: center; overflow: hidden; position: relative;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); border-bottom: 4px solid var(--primary);
        }
        .cta-banner::before {
            content: ''; position: absolute; top: -50px; right: -50px; width: 150px; height: 150px;
            background: radial-gradient(circle, rgba(230,46,45,0.2) 0%, transparent 70%); z-index: 1;
        }
        .cta-banner-content { position: relative; z-index: 2; }
        .cta-banner h3 { font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem; line-height: 1.3; }
        .cta-banner h3 span { color: var(--primary); }
        .cta-banner p { color: rgba(255,255,255,0.7); font-size: 0.9375rem; margin-bottom: 2rem; }
        .cta-banner .btn { width: 100%; justify-content: center; }

        .recent-posts { background-color: var(--white); padding: 6rem 0; border-top: 1px solid var(--border-color); }
        .section-header { display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 1px solid var(--border-color); padding-bottom: 1.5rem; margin-bottom: 3rem; }
        .section-header h2 { font-size: 2.25rem; font-weight: 800; color: var(--dark); }
        .section-header h2 span { color: var(--primary); }
        .view-all { font-weight: 600; color: var(--dark); display: inline-flex; align-items: center; gap: 0.5rem; }
        .view-all:hover { color: var(--primary); }

        .grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
        @media (min-width: 768px) { .grid { grid-template-columns: repeat(3, 1fr); } }
        .post-card {
            background: var(--white); border-radius: 1rem; border: 1px solid var(--border-color);
            overflow: hidden; display: flex; flex-direction: column; cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); transition: box-shadow 0.3s ease;
        }
        .post-card:hover { box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1); }
        .card-img { position: relative; height: 220px; overflow: hidden; }
        .card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .post-card:hover .card-img img { transform: scale(1.05); }
        .card-content { padding: 2rem; display: flex; flex-direction: column; flex-grow: 1; }
        .card-tag { color: var(--primary); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.75rem; }
        .post-card h3 { font-size: 1.25rem; font-weight: 700; color: var(--dark); line-height: 1.4; margin-bottom: 1rem; transition: color 0.3s ease; }
        .post-card:hover h3 { color: var(--primary); }
        .read-more { display: inline-flex; align-items: center; color: var(--dark); font-weight: 700; font-size: 0.875rem; text-transform: uppercase; gap: 0.25rem; margin-top: auto; transition: color 0.3s ease; }
        .read-more svg { width: 16px; height: 16px; transition: transform 0.3s ease; }
        .post-card:hover .read-more { color: var(--primary); }
        .post-card:hover .read-more svg { transform: translateX(4px); }
    </style>

    <main>
        <?php 
        // Start the Main WordPress Loop
        while ( have_posts() ) : the_post(); 
        ?>

        <!-- Section 1: Hero -->
        <section class="single-hero">
        <div class="background-wrapper">
        <div class="pattern-wrap"> <svg class="pattern-lines" viewBox="0 0 600 800" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
          <g fill="none" stroke="#FF6B00" stroke-width="1">
              <path d="M-50,350 C50,320 150,200 300,180 C450,160 500,100 650,80"></path>
              <path d="M-50,360 C50,330 150,215 300,195 C450,175 500,115 650,95"></path>
              <path d="M-50,370 C50,340 150,230 300,210 C450,190 500,130 650,110"></path>
              <path d="M-50,380 C50,350 150,245 300,225 C450,205 500,145 650,125"></path>
              <path d="M-50,390 C50,360 150,260 300,240 C450,220 500,160 650,140"></path>
              <path d="M-50,400 C50,370 150,275 300,255 C450,235 500,175 650,155"></path>
          </g>
      </svg> <svg class="star-svg" viewBox="0 0 600 800" preserveAspectRatio="xMidYMid meet">
          <path id="logoPath1" d="M-50,370 C50,340 150,230 300,210 C450,190 500,130 650,110" fill="none" stroke="none"></path> <text id="logoStar1" font-family="Inter,sans-serif" font-size="14" fill="#fff" text-anchor="middle" dominant-baseline="central" opacity="1" x="645.7842407226562" y="110.57681274414062">✦</text>
      </svg> </div>
  

<style>
  .background-wrapper {
    position: absolute;
    top: -95px;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
    /* rotate: 15deg; */
    opacity: 0.3;
}

        .dot-grid {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: radial-gradient(#CBD5E1 1px, transparent 1px);
            background-size: 24px 24px; /* Tighter grid */
            opacity: 0.5;
            mask-image: linear-gradient(to bottom, black 20%, transparent 80%);
            -webkit-mask-image: linear-gradient(to bottom, black 20%, transparent 80%);
        }

        .ambient-glow {
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(230,0,35,0.08) 0%, transparent 70%);
            top: -100px; right: 10%;
            z-index: 0;
        }
/* SVG running trails */
.bg-trails {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 77%;
    pointer-events: none;
    z-index: 0;
    overflow: visible;
    opacity: 0.8;
    top: -31px;
    left: -166px;
    rotate: -159deg;
}

.bg-trails-2 {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 77%;
    pointer-events: none;
    z-index: 0;
    overflow: visible;
    opacity: 0.8;
    top: -31px;
    left: 130px;
    rotate: -14deg;
}

.wht-fx-trail-path {
    fill: none;
    stroke-linecap: round;
}

.wht-fx-trail-path-one {
    stroke: #ffffff; /* FIX: Alpha channel changed to 1 (Solid White) */
    stroke-width: 1.5;
    stroke-dasharray: 6 20;
    animation: wht-fx-trail-dash-anim 8s linear infinite;
}

.wht-fx-trail-path-two {
    stroke: #ffffff; /* FIX: Alpha channel changed to 1 (Solid White) */
    stroke-width: 1.5;
    stroke-dasharray: 8 24;
    animation: wht-fx-trail-dash-anim 12s linear infinite reverse;
}

@keyframes wht-fx-trail-dash-anim {
    to { stroke-dashoffset: -200; }
}
</style>
</div> 
            <div class="hero-pattern"></div>
            
            <div class="container hero-grid">
                <!-- Left Side: Content -->
                <div class="hero-text-side">
                    
                    <!-- Dynamic Breadcrumbs -->
                    <nav class="breadcrumbs">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <span class="separator">/</span>
                        <?php 
                            // Get the assigned blog page URL
                            $blog_page_id = get_option('page_for_posts');
                            if ( $blog_page_id ) : 
                        ?>
                            <a href="<?php echo esc_url(get_permalink($blog_page_id)); ?>">Blog</a>
                            <span class="separator">/</span>
                        <?php endif; ?>
                        <span class="current"><?php echo wp_trim_words( get_the_title(), 5, '...' ); ?></span>
                    </nav>

                    <!-- Dynamic Title (Wraps last 2 words in your gradient highlight span automatically) -->
                    <h1 class="single-title">
                        <?php 
                            $title = get_the_title();
                            $words = explode( ' ', $title );
                            if ( count( $words ) > 2 ) {
                                $last_two = array_splice( $words, -2 );
                                echo implode( ' ', $words ) . ' <span class="highlight">' . implode( ' ', $last_two ) . '</span>';
                            } else {
                                echo $title;
                            }
                        ?>
                    </h1>

                    <!-- Dynamic Author & Date Meta -->
                    <div class="hero-meta">
                        <div class="meta-author">
                            <?php echo get_avatar( get_the_author_meta('ID'), 100, '', get_the_author(), array('class' => 'author-avatar') ); ?>
                            <div class="author-info">
                                <strong><?php the_author(); ?></strong>
                                <span><?php echo get_the_author_meta('description') ? wp_trim_words(get_the_author_meta('description'), 5) : 'Author'; ?></span>
                            </div>
                        </div>
                        <div class="meta-date">
                            <!-- Calendar Icon -->
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <?php echo get_the_date(); ?>
                        </div>
                        <div class="meta-date">
                            <!-- Clock Icon -->
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <?php echo $reading_time; ?> min read
                        </div>
                    </div>
                </div>

                <!-- Right Side: Dynamic Featured Image -->
                <div class="hero-visual-side">
                    <div class="hero-image-wrapper">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                        <?php else : ?>
                            <img src="https://via.placeholder.com/1200x800?text=<?php echo urlencode(get_the_title()); ?>" alt="Placeholder">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sweeping Curved Background Separator -->
            <div class="hero-curve">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0 V46.29 c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V120 H0 Z"></path>
                </svg>
            </div>
        </section>

        <!-- Section 2: Main Content Area -->
        <section class="content-section container">
            <div class="content-layout">
                
                <!-- Left Side: Dynamic Article Body -->
                <article class="article-content">
                    
                    <?php the_content(); ?>

                    <!-- Dynamic Article Tags -->
                    <?php 
                    $post_tags = get_the_tags();
                    if ( $post_tags ) : 
                    ?>
                        <div class="article-tags">
                            <?php foreach( $post_tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </article>

                <!-- Right Side: Sticky CTA Banner (Kept Static as designed) -->
                <aside class="sidebar">
                    <div class="sticky-wrapper">
                        <div class="cta-banner">
                            <div class="cta-banner-content">
                                <h3>Stop Reacting. <br><span>Start Predicting.</span></h3>
                                <p>See how Fleeta's AI can reduce your vehicle downtime by up to 35%.</p>
                                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                                    Book a Demo
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </section>
        
        <?php endwhile; // End of main loop ?>

        <!-- Section 3: Dynamic Recent Posts -->
        <?php 
        // Custom Query for 3 most recent posts (excluding current post)
        $recent_posts_query = new WP_Query( array(
            'post_type'           => 'post',
            'posts_per_page'      => 3,
            'post__not_in'        => array( get_the_ID() ),
            'ignore_sticky_posts' => 1
        ));

        if ( $recent_posts_query->have_posts() ) : 
        ?>
        <section class="recent-posts">
            <div class="container">
                <div class="section-header">
                    <h2>Read <span>Next</span></h2>
                    <?php if ( $blog_page_id ) : ?>
                        <a href="<?php echo esc_url(get_permalink($blog_page_id)); ?>" class="view-all">
                            View All Resources
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="grid">
                    <?php while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); ?>
                        
                        <article class="post-card" onclick="window.location.href='<?php the_permalink(); ?>'">
                            <div class="card-img">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else : ?>
                                    <img src="https://via.placeholder.com/600x400?text=Read+More" alt="Placeholder">
                                <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <?php 
                                    // Get the first category for the tag
                                    $categories = get_the_category();
                                    if ( ! empty( $categories ) ) {
                                        echo '<span class="card-tag">' . esc_html( $categories[0]->name ) . '</span>';
                                    }
                                ?>
                                <h3><?php the_title(); ?></h3>
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    Read More 
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php 
        endif; 
        wp_reset_postdata(); // Reset query after custom loop 
        ?>

    </main>

<?php
get_footer();
?>

<!-- Fleeta Blog Theme -->