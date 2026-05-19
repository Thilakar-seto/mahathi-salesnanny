<?php
/**
 * Template Name: Category - Blogs
 * Description: Custom template for the "blogs" category.
 */

get_header(); ?>

<style>
    /* =========================================
       External Resources (Fonts & Icons)
       ========================================= */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    /* =========================================
       Layout & Container Styles
       ========================================= */
    .blog-section-container {
        font-family: 'Inter', sans-serif;
        width: 100%;
        background-color: #ffffff;
        box-sizing: border-box;
    }

    .blog-inner-wrapper {
        width: 100%;
    max-width: 1400px;
    padding-inline: clamp(20px, 4vw, 48px);
    margin: 0 auto;
    }

    /* =========================================
       Hero Section (Purple Header)
       ========================================= */
    .blog-hero-header {
        background-color: #1e2152; /* Deep Purple */
        text-align: center;
        padding: 160px 20px 60px;
        color: #ffffff;
        position: relative;
    }

    .common-width-image {
        position: absolute;
        width: 100%;
    }

    .blog-hero-eyebrow {
        display: block;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 12px;
        color: #E9D7FE;
    }

    .blog-hero-heading {
        font-size: 42px;
        font-weight: 700;
        margin: 0 auto 24px;
        line-height: 1.2;
        max-width: 750px;
        position: relative;
        z-index: 2;
    }

    .blog-hero-subtext {
        font-size: 18px;
        color: #E9D7FE;
        max-width: 500px;
        margin: 0 auto 40px auto;
        line-height: 1.5;
        font-weight: 400;
        position: relative;
        z-index: 2;
    }

    /* =========================================
       Search / Subscription Form
       ========================================= */
    .blog-form-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        position: relative;
        z-index: 2;
    }

    .blog-subscribe-form {
        display: flex;
        gap: 16px;
        width: 100%;
        max-width: 500px;
    }

    .blog-input-field {
        flex: 1;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #D0D5DD;
        font-size: 16px;
        outline: none;
        color: #101828;
    }

    .blog-input-field::placeholder {
        color: #667085;
    }

    .blog-submit-button {
        background-color: #c22034;
        color: white;
        border: 1px solid #c22034;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.2s;
    }

    .blog-submit-button:hover {
        background-color: #1e2152;
    }

    /* =========================================
       Blog Grid System
       ========================================= */
    .blog-grid-layout {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        margin-top: 64px;
        margin-bottom: 64px;
    }

    /* =========================================
       Card Styling
       ========================================= */
    .blog-card-article {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .blog-card-img-wrapper {
        width: 100%;
        height: 240px;
        overflow: hidden;
        margin-bottom: 32px;
        border-radius: 20px;
        display: block;
    }

    .blog-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .blog-card-img-wrapper:hover .blog-card-image {
        transform: scale(1.05);
    }

    .blog-card-meta {
        color: #c22034;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .blog-card-header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        width: 100%;
        margin-bottom: 12px;
        cursor: pointer;
    }
    
    .blog-card-link-wrapper {
        text-decoration: none;
        width: 100%;
        display: block;
    }

    .blog-card-title {
        font-size: 24px;
        font-weight: 600;
        color: #101828;
        margin: 0;
        line-height: 32px;
        transition: color 0.2s;
    }

    .blog-card-link-wrapper:hover .blog-card-title {
        color: #c22034;
    }

    .blog-card-link-wrapper:hover .blog-arrow-icon {
        transform: rotate(45deg) translate(2px, -2px);
    }

    .blog-arrow-icon {
        font-size: 20px;
        color: #101828;
        transform: rotate(45deg); /* Pointing up-right */
        transition: transform 0.2s;
        margin-left: 16px;
        margin-top: 4px;
    }

    .blog-card-excerpt {
        color: #667085;
        font-size: 16px;
        line-height: 24px;
        margin: 0 0 24px 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* =========================================
       WordPress Native Pagination Styling
       ========================================= */
    .blog-pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #EAECF0;
        gap: 8px;
    }

    .blog-pagination-wrapper .page-numbers {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 10px;
        border-radius: 8px;
        font-size: 14px;
        color: #667085;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    .blog-pagination-wrapper a.page-numbers:hover {
        background-color: #F9FAFB;
        color: #101828;
    }

    .blog-pagination-wrapper .page-numbers.current {
        background-color: #F9F5FF;
        color: #7F56D9;
        font-weight: 600;
    }

    .blog-pagination-wrapper .prev.page-numbers,
    .blog-pagination-wrapper .next.page-numbers {
        gap: 8px;
        padding: 8px 14px;
    }

    /* =========================================
       Responsive Styles
       ========================================= */
    @media (max-width: 960px) {
        .blog-grid-layout {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .blog-hero-heading { font-size: 36px; }
        .blog-subscribe-form { flex-direction: column; }
        .blog-submit-button { width: 100%; }
        
        .blog-grid-layout {
            grid-template-columns: 1fr;
            gap: 48px;
        }

        .blog-pagination-wrapper {
            flex-wrap: wrap;
        }
    }
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
    .hero-search {
    max-width: 100%;
    margin: 0;
    position: relative;
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
    margin: 0 auto;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
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

  .search-btn {
    background: #14184d;
    color: white;
    border: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

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
    background: linear-gradient(135deg, #14184d 0%, #7c3aed 100%);
    color: white;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
  }
</style>

<section class="blog-section-container">
    
    <!-- Hero Header Section -->
    <div class="blog-hero-header">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/arrow-blue.webp" alt="Background pattern" class="common-width-image" style="width: 269px; opacity: 0.3; left: 0;">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/half-tone-pattern.svg" alt="Background pattern" class="common-width-image" style="right: -810px; opacity: 0.2;">
        
        <h2 class="blog-hero-heading">Stories that Move The World Forward</h2>
        <p class="blog-hero-subtext">Deep dives, quick tips, and real-world freight wisdom—curated for operators who never stop moving.</p>
        
        <!-- WordPress Native Search Form scoped to this category -->
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
    </div>
<style>
    /* 1. Main Search Results Wrapper */
.live-search-results {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08), 0 2px 6px rgba(0, 0, 0, 0.04);
    border: 1px solid #eef0f4;
    width: 100%;
    max-width: 600px; /* Adjust this to match your search bar width */
    max-height: 420px; /* Keeps the dropdown from getting too long */
    overflow-y: auto;
    position: absolute; /* Assuming this drops down below an input */
    z-index: 9999;
    margin-top: 10px;
    animation: slideDownFade 0.3s ease forwards;
}

/* Custom Scrollbar for the dropdown */
.live-search-results::-webkit-scrollbar {
    width: 6px;
}
.live-search-results::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 0 12px 12px 0;
}
.live-search-results::-webkit-scrollbar-thumb {
    background: #cdd4df;
    border-radius: 10px;
}
.live-search-results::-webkit-scrollbar-thumb:hover {
    background: #aab3c2;
}

/* 2. The List Setup */
.search-results-list {
    list-style: none !important;
    margin: 0 !important;
    padding: 8px !important;
    display: flex;
    flex-direction: column;
}

/* 3. The Individual Result Item */
.search-results-list li {
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #f2f4f8;
}
.search-results-list li:last-child {
    border-bottom: none;
}

/* 4. The Clickable Link Layout */
.search-results-list a {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 12px;
    border-radius: 8px;
    text-decoration: none !important;
    transition: background-color 0.2s ease, transform 0.2s ease;
    background: transparent;
}
.search-results-list a:hover {
    background: #f4f7fb; /* Soft blue/grey hover state */
}

/* 5. Thumbnail Styling & Animation */
.search-thumb {
    flex-shrink: 0;
    width: 65px;
    height: 65px;
    border-radius: 6px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.search-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease; /* Smooth zoom transition */
}
/* Zoom image slightly when hovering over the link */
.search-results-list a:hover .search-thumb img {
    transform: scale(1.1);
}

/* 6. Text Container */
.search-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 6px;
    flex-grow: 1;
    min-width: 0; /* REQUIRED: allows text to truncate properly */
}

/* 7. Title Styling */
.search-title {
    font-size: 15px;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.4;
    transition: color 0.2s ease;
    
    /* Truncates extra long titles after 2 lines with an ellipsis (...) */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: left;
}
/* Change title color to a brand blue on hover */
.search-results-list a:hover .search-title {
    color: #0b5fb6; 
}

/* 8. Date Meta Styling */
.search-date {
    font-size: 12px;
    font-weight: 500;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 4px;
}
/* Small aesthetic dot before the date */
.search-date::before {
    content: "•";
    color: #cbd5e1;
    font-size: 16px;
    line-height: 1;
}

/* Optional Pop-in Animation when search runs */
@keyframes slideDownFade {
    0% { opacity: 0; transform: translateY(-8px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Mobile Adjustments */
@media (max-width: 600px) {
    .live-search-results {
        max-width: 100%; /* Take full width on small screens */
        border-radius: 0 0 12px 12px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
}
    </style>
    <!-- Main Content Grid -->
    <div class="blog-inner-wrapper">
        <div class="blog-grid-layout">

            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                
                    <!-- Dynamic WordPress Card -->
                    <article class="blog-card-article" id="post-<?php the_ID(); ?>">
                        
                        <!-- Post Thumbnail -->
                        <a href="<?php the_permalink(); ?>" class="blog-card-img-wrapper">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', array( 'class' => 'blog-card-image' ) ); ?>
                            <?php else : ?>
                                <!-- Fallback image if no featured image is set -->
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/placeholder.jpg" alt="<?php the_title_attribute(); ?>" class="blog-card-image">
                            <?php endif; ?>
                        </a>

                        <!-- Meta: Author and Date -->
                        <div class="blog-card-meta">
                            <?php echo get_the_author(); ?> • <?php echo get_the_date('d M Y'); ?>
                        </div>

                        <!-- Title and Icon -->
                        <a href="<?php the_permalink(); ?>" class="blog-card-link-wrapper">
                            <div class="blog-card-header-row">
                                <h3 class="blog-card-title"><?php the_title(); ?></h3>
                                <i class="fa-solid fa-arrow-up blog-arrow-icon"></i>
                            </div>
                        </a>

                        <!-- Excerpt -->
                        <p class="blog-card-excerpt">
                            <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                        </p>
                        
                    </article>

                <?php endwhile; ?>
            <?php else : ?>
                <p>No articles found in this category.</p>
            <?php endif; ?>

        </div>

        <!-- WordPress Native Pagination -->
        <div class="blog-pagination-wrapper">
            <?php
            echo paginate_links( array(
                'prev_text' => '<i class="fa-solid fa-arrow-left"></i> Previous',
                'next_text' => 'Next <i class="fa-solid fa-arrow-right"></i>',
                'mid_size'  => 2,
            ) );
            ?>
        </div>
        
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Centralized Configuration (Keeps PHP variables clean)
    const ajaxConfig = {
        url: '<?php echo esc_url(admin_url("admin-ajax.php")); ?>',
        action: 'load_posts_ajax',
        category: <?php echo is_category() ? get_queried_object_id() : 0; ?>,
        tag: <?php echo is_tag() ? get_queried_object_id() : 0; ?>,
        author: <?php echo is_author() ? get_queried_object_id() : 0; ?>,
        search: '<?php echo esc_js(get_search_query()); ?>',
        posts_per_page: 8,
        max_pages: <?php echo isset($blog_query->max_num_pages) ? $blog_query->max_num_pages : 0; ?>
    };

    // 2. Optimized IntersectionObserver for Animations
    function initPostCardObserver() {
        const cards = document.querySelectorAll('.post-card:not(.visible)');
        if (!cards.length) return;

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Slight delay based on element index for cascade effect
                    const allCards = Array.from(document.querySelectorAll('.post-card'));
                    const index = allCards.indexOf(entry.target);
                    
                    // RequestAnimationFrame is better for performance than setTimeout here
                    requestAnimationFrame(() => {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, (index % 8) * 100);
                    });
                    
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: '50px 0px', threshold: 0.1 }); // Added rootMargin to trigger slightly before scrolling into view

        cards.forEach(card => observer.observe(card));
    }

    // Initialize animations
    initPostCardObserver();
    window.initPostCardObserver = initPostCardObserver;

    // 3. Vanilla JS AJAX Pagination (Zero jQuery)
    document.addEventListener('click', function(e) {
        const paginationLink = e.target.closest('.pagination-wrapper a.page-numbers');
        if (!paginationLink) return;
        
        e.preventDefault();
        let page = 1;
        const href = paginationLink.getAttribute('href');
        
        // Extract page number
        const matches = href.match(/(?:paged=|page\/)(\d+)/);
        if (matches) page = parseInt(matches[1]);
        
        loadPosts(page);
    });

    async function loadPosts(page) {
        const grid = document.querySelector('.masonry-grid');
        const section = document.querySelector('.posts-section');
        const paginationWrapper = document.querySelector('.pagination-wrapper');
        
        if (!grid) return;

        // Smooth scroll to top of section (Vanilla JS)
        if (section) {
            const y = section.getBoundingClientRect().top + window.scrollY - 100;
            window.scrollTo({ top: y, behavior: 'smooth' });
        }

        grid.classList.add('loading');

        // Format data for WordPress admin-ajax (requires URLSearchParams)
        const params = new URLSearchParams();
        for (const key in ajaxConfig) {
            params.append(key, ajaxConfig[key]);
        }
        params.append('page', page);

        try {
            const response = await fetch(ajaxConfig.url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            });

            const result = await response.json();

            if (result.success && result.data) {
                grid.innerHTML = result.data.posts;
                
                if (result.data.pagination && paginationWrapper) {
                    paginationWrapper.outerHTML = result.data.pagination;
                } else if (paginationWrapper) {
                    paginationWrapper.remove();
                }

                grid.classList.remove('loading');
                
                // Re-initialize animations
                setTimeout(initPostCardObserver, 50);

                // Re-initialize Masonry if it exists (Vanilla JS check)
                if (window.Masonry && typeof window.Masonry === 'function') {
                    setTimeout(() => {
                        new Masonry(grid, { itemSelector: '.post-card' }); // Adjust options as needed
                    }, 100);
                } else if (typeof jQuery !== 'undefined' && jQuery.fn.masonry) {
                    // Fallback to jQuery masonry if Vanilla masonry isn't loaded
                    setTimeout(() => {
                        jQuery(grid).masonry('reloadItems').masonry('layout');
                    }, 100);
                }

            } else {
                throw new Error('Invalid response');
            }
        } catch (error) {
            grid.classList.remove('loading');
            console.error('AJAX Error:', error);
            alert('Error loading posts. Please try again.');
        }
    }

    // 4. Optimized Live Search (Debounced Vanilla JS)
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

            searchTimeout = setTimeout(async () => {
                const ajaxUrl = (typeof global_ajax_object !== 'undefined') ? global_ajax_object.ajax_url : ajaxConfig.url;
                
                const formData = new FormData();
                formData.append('action', 'live_search_posts');
                formData.append('keyword', query);

                try {
                    const response = await fetch(ajaxUrl, { method: 'POST', body: formData });
                    const html = await response.text();
                    
                    if (html.trim()) {
                        resultsContainer.innerHTML = html;
                    } else {
                        resultsContainer.innerHTML = '<div class="no-results">No results found</div>';
                    }
                    resultsContainer.style.display = 'block';
                } catch (error) {
                    console.error('Search error:', error);
                }
            }, 300); // 300ms debounce
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    }
});
</script>
<?php get_footer(); ?>