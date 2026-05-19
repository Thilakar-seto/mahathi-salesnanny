<?php
/**
 * Template Name: author
 */
get_header();

// Get the current author from the URL
$author = get_queried_object();
$author_slug = $author->user_nicename;

// Define author data
$authors_data = array(
    'prasanth-m' => array(
        'name' => 'Prasanth',
        'description' => 'I have over three years of experience creating content for the logistics and supply chain industries, simplifying complex topics into engaging articles, blogs, and case studies. My work enhances business visibility and credibility, empowering companies to navigate industry challenges effectively.',
        'years' => '03',
        'years_text' => 'Years of experience',
        'years_description' => 'Demonstrated expertise in creating impactful content for the logistics and supply chain industries over three years.',
        'achievements' => '300+',
        'achievements_text' => 'Successful Write-ups',
        'achievements_description' => 'Authored over 300 high-quality articles, blogs, and case studies, driving visibility and engagement for businesses.',
        'linkedin' => 'https://www.linkedin.com/in/prasanth-m-a5324030a/',
        'image' => 'author2.webp',
        'signature' => 'prasanth-signature.webp'
    ),
    'fahad' => array(
        'name' => 'Fahad',
        'description' => 'Hi, I\'m Fahad. With over 1+ year of experience in logistics content writing, I specialize in turning complex topics in supply chain management into clear, engaging, and meaningful content. My work helps businesses connect with their audience, build trust, and thrive in the competitive logistics industry.',
        'years' => '01+',
        'years_text' => 'Year of Experience',
        'years_description' => 'Demonstrated expertise in logistics content writing, simplifying complex supply chain topics for over a year.',
        'achievements' => '03',
        'achievements_text' => 'Key Skills',
        'achievements_description' => 'Specializes in SEO, SMM, and Poster Design, enhancing online presence and visual communication.',
        'linkedin' => 'mailto:fahad@salesnanny.com',
        'image' => 'fahad.webp',
        'signature' => 'fahad-signature.webp'
    ),
    'swathi' => array(
        'name' => 'Swathi',
        'description' => 'I have 2+ years of experience in the logistics and supply chain field. I enjoy taking complex logistics ideas, insights, and new innovations and explaining them in a way that is simple and useful for others. My aim is to share knowledge that helps people understand logistics better and apply it in everyday work.',
        'years' => '2+',
        'years_text' => 'Years of Experience',
        'years_description' => 'Practical knowledge in logistics and supply chain, focused on making topics clear and easy to follow.',
        'achievements' => '100+',
        'achievements_text' => 'Logistics Insights Explained',
        'achievements_description' => 'Shared 100+ simplified updates and innovations, making complex logistics topics easier for professionals to use.',
        'linkedin' => 'mailto:swathi@salesnanny.com',
        'image' => 'swathi.webp',
        'signature' => 'swathi-signature.webp'
    )
);

// Get current author data or default to Prasanth if not found
$current_author = isset($authors_data[$author_slug]) ? $authors_data[$author_slug] : $authors_data['prasanth-m'];
?>
<style>
    :root {
    --primary-color: #052439;
    --text-dark: #041a41;
    --text-light: #666666;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.hero {
    padding: 80px 0;
    overflow: hidden;
}

.hero-wrapper {
    display: flex;
    gap: 40px;
    align-items: center;
}

/* Left Column */
.hero-content {
    flex: 1;
}

.subtitle {
    color: #fd4816;
    font-size: clamp(14.40px, 1.06vw, 16px);
    font-weight: 800;
    margin-bottom: 16px;
    display: block;
}

.title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    line-height: 1.2;
    margin-bottom: 24px;
    color: var(--text-dark);
    font-weight: 800;
}

.highlight {background: linear-gradient(to right, #052439, #fd4816);-webkit-background-clip: text;background-clip: text;color: transparent;}

.description {
    color: var(--text-light);
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 40px;
    max-width: 500px;
}

.signature {
    max-width: 200px;
    height: auto;
    /* filter: hue-rotate(120deg); */
}

/* Middle Column */
.hero-stats {
    flex: 1;
    position: relative;
}

.profile-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 4/5;
    margin-bottom: 40px;
}

.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
}

.stats {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.stat-item {
    max-width: 400px;
}

.stat-number {
    font-size: clamp(43.20px, 3.18vw, 48px);
    font-weight: 800;
    color: #fd4816;
    line-height: 1;
    display: block;
}

.stat-label {
    font-size: clamp(18.00px, 1.33vw, 20px);
    font-weight: 800;
    color: var(--text-dark);
    margin: 8px 0 12px;
    display: block;
}

.stat-description {
    color: var(--text-light);
    line-height: 1.6;
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-wrapper {
        gap: 40px;
    }
}

@media (max-width: 768px) {
    .hero-wrapper {
        flex-direction: column;
    }

    .hero-content {
        text-align: center;
    }

    .description {
        margin-left: auto;
        margin-right: auto;
    }

    .signature {
        margin: 0 auto;
    }

    .stats {
        text-align: center;
        align-items: center;
    }
}

/* Prevent CLS */
@media (min-width: 769px) {
    .hero-wrapper {
        min-height: 600px;
    }
}
</style>
<style>
   /* Skills Showcase Section */
.skills-showcase {
    background-color: #041a41;
    padding: clamp(64px, 8vw, 80px) 0;
    color: #fff;
    overflow: hidden;
}

.skills-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
    box-sizing: border-box;
}

.skills-showcase-header {
    text-align: center;
    margin-bottom: clamp(48px, 6vw, 64px);
}

.skills-label {
    font-size: clamp(14.40px, 1.06vw, 16px);
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 16px;
    display: block;
    color: rgba(255, 255, 255, 0.9);
    letter-spacing: 0.05em;
}

.skills-heading {
    font-size: clamp(2rem, 5vw, 2.5rem);
    line-height: 1.2;
    margin: 0;
    font-weight: 800;
    color: #fff;
}

.skills-showcase-grid {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin: 0 auto;
    max-width: 1200px;
    contain: content;
}

.showcase-card {
    flex: 1;
    min-width: min(100%, 280px);
    max-width: 320px;
}

.showcase-icon {
    margin-bottom: 15px;
}

.showcase-icon svg {
    color: white;
    width: auto;
    height: auto;
}

.showcase-title {
    font-size: clamp(14.40px, 1.06vw, 16px);
    margin: 0 0 7px 0;
    font-weight: 800;
    color: #fff;
}

.showcase-text {
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
}

/* Prevent CLS */
.skills-showcase-grid {
    min-height: auto;
}

/* Mobile Optimizations */
@media (max-width: 768px) {
    .showcase-card {
        min-width: 100%;
    }
    
    .skills-showcase-grid {
        gap: 20px;
    }
}

/* Print Styles */
@media print {
    .skills-showcase {
        background: #fff;
        color: #052439;
    }
    
    .showcase-card {
        break-inside: avoid;
        background: none;
        border: 1px solid #ccc;
    }
}

/* Blog Showcase Section */
.blog-showcase {
    padding: clamp(64px, 8vw, 80px) 0;
    background: #fff;
    overflow: hidden;
}

.blog-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 max(24px, 5%);
    width: 100%;
    box-sizing: border-box;
    display: flex;
    flex-direction: row;
    gap: 40px;
}

.blog-header {
    flex: 1;
    margin-bottom: clamp(48px, 6vw, 64px);
}

.blog-label {
    font-size: clamp(14.40px, 1.06vw, 16px);
    font-weight: 800;
    color: #fd4816;
    text-transform: uppercase;
    margin-bottom: 16px;
    display: block;
    letter-spacing: 0.05em;
}

.blog-heading {
    font-size: clamp(2rem, 5vw, 2.5rem);
    line-height: 1.2;
    margin: 0;
    font-weight: 800;
    color: #041a41;
}

.blog-grid {
    display: flex;
    gap: clamp(24px, 3vw, 32px);
    contain: content;
    flex-direction: column;
    flex: 1;
}

.blog-card {
    background: #fff;
    border-radius: 0;
    padding: 0;
    contain: layout style paint;
}

.blog-content {
    display: flex;
    flex-direction: column;
    gap: 8px;
    height: 100%;
}

.blog-date {
    font-size: 0.875rem;
    color: #fd4816;
    font-weight: 800;
    text-transform: uppercase;
}

.blog-title {
    font-size: clamp(1.25rem, 2vw, 1.5rem);
    line-height: 1.3;
    margin: 0;
    font-weight: 800;
    /* Add these properties for line clamping */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: calc(1.3em * 2); /* Ensure consistent height */
}

.blog-link {
    color: #041a41;
    text-decoration: none;
    transition: color 0.3s ease;
    /* Inherit line clamping from parent */
    display: inherit;
    -webkit-line-clamp: inherit;
    -webkit-box-orient: inherit;
    overflow: inherit;
}

/* Add title attribute hover styles for full text */
.blog-link[title]:hover::before {
    content: attr(title);
    position: absolute;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 0.5em;
    border-radius: 4px;
    font-size: 0.875rem;
    max-width: 300px;
    z-index: 1;
    pointer-events: none;
    transform: translateY(-100%);
}

.blog-link:hover,
.blog-link:focus {
    color: #fd4816;
}

.blog-excerpt {
    margin: 0;
    font-size: clamp(14.40px, 1.06vw, 16px);
    line-height: 1.6;
    color: #666;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: calc(1.6em * 2); /* Ensure consistent height */
}

/* Performance Optimizations */
@media (prefers-reduced-motion: reduce) {
    .blog-link {
        transition: none;
    }
}

/* Prevent CLS */
.blog-grid {
    min-height: 200px;
}

/* Content-visibility optimization */
.blog-card {
    content-visibility: auto;
    contain-intrinsic-size: 0 200px;
}

/* Print Styles */
@media print {
    .blog-card {
        break-inside: avoid;
    }
}
/* Add fallback for browsers that don't support line-clamp */
@supports not (-webkit-line-clamp: 2) {
    .blog-title,
    .blog-excerpt {
        position: relative;
        max-height: calc(1.3em * 2);
        padding-right: 1rem;
    }

    .blog-title::after,
    .blog-excerpt::after {
        content: '...';
        position: absolute;
        right: 0;
        bottom: 0;
        background: inherit;
        padding-left: 0.5rem;
    }
    
    .blog-excerpt {
        max-height: calc(1.6em * 2);
    }
}
/* Contact Section Styles */
.contact-section {
    padding: clamp(64px, 8vw, 80px) 0;
    background: #fff;
    overflow: hidden;
    text-align: center;
}

.contact-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 max(24px, 5%);
    width: 100%;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.contact-label {
    font-size: clamp(1rem, 1.5vw, 1.25rem);
    font-weight: 500;
    color: #fd4816;
    display: block;
    letter-spacing: -0.01em;
}

.contact-heading {
    font-size: clamp(2.5rem, 6vw, 4rem);
    line-height: 1.1;
    margin-bottom: 30px;
    font-weight: 800;
    letter-spacing: -0.02em;
}

.cta-button {
    display: inline-block;
    padding: .5rem 1rem;
    font-size: clamp(14.40px, 1.06vw, 16px);
    font-weight: 600;
    color: #052439;
    background-color: transparent;
    border: 2px solid #052439;
    border-radius: 50px;
    text-decoration: none;
    transition: all .3s ease;
}

.cta-button:hover {
    color: #fff;
    background-color: #052439;
    transform: translateY(-2px);
}

/* Performance Optimizations */
@media (prefers-reduced-motion: reduce) {
    .cta-button {
        transition: none;
    }
}

/* Content-visibility optimization */
.contact-section {
    content-visibility: auto;
    contain-intrinsic-size: 0 400px;
}

/* Mobile Optimizations */
@media (max-width: 768px) {
    .contact-container {
        gap: 16px;
    }
}

/* Print Styles */
@media print {
    .contact-section {
        padding: 40px 0;
    }
}
</style>

<section class="hero" aria-label="About Me">
    <div class="container">
        <div class="hero-wrapper">
            <!-- Left Column -->
            <div class="hero-content">
                <span class="subtitle">ABOUT ME</span>
                <h1 class="title">
                    Hello! I'm<br>
                    <span class="highlight"><?php echo esc_html($current_author['name']); ?>.</span>
                </h1>
                <p class="description">
                    <?php echo esc_html($current_author['description']); ?>
                </p>
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo esc_attr($current_author['signature']); ?>" 
                    alt="<?php echo esc_attr($current_author['name']); ?>'s signature" 
                    class="signature"
                    width="200"
                    height="80"
                    loading="eager"
                >
            </div>

            <!-- Middle Column -->
            <div class="hero-stats">
                <div class="profile-wrapper">
                    <img 
                        src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo esc_attr($current_author['image']); ?>" 
                        alt="<?php echo esc_attr($current_author['name']); ?> profile image" 
                        class="profile-image"
                        width="400"
                        height="500"
                        loading="eager"
                    >
                </div>
            </div>

            <!-- Right Column -->
            <div class="hero-stats-right">
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo esc_html($current_author['years']); ?></span>
                        <span class="stat-label"><?php echo esc_html($current_author['years_text']); ?></span>
                        <p class="stat-description"><?php echo esc_html($current_author['years_description']); ?></p>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo esc_html($current_author['achievements']); ?></span>
                        <span class="stat-label"><?php echo esc_html($current_author['achievements_text']); ?></span>
                        <p class="stat-description"><?php echo esc_html($current_author['achievements_description']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="skills-showcase" aria-label="My Skills">
    <div class="skills-container">
        <div class="skills-showcase-header">
            <span class="skills-label">MY SKILLS</span>
            <h2 class="skills-heading">My extensive list of skills</h2>
        </div>
        
        <div class="skills-showcase-grid">
            <!-- Research Card -->
            <div class="showcase-card">
                <div class="showcase-icon">
                    <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9.63438 20.1999H3.63437C2.30888 20.1999 1.23437 19.1254 1.23438 17.7999L1.23447 3.39999C1.23448 2.07451 2.30899 1 3.63447 1H14.4347C15.7602 1 16.8347 2.07452 16.8347 3.4V8.2M18.0344 18.4L19.2344 19.6M5.43475 5.8H12.6348M5.43475 9.4H12.6348M5.43475 13H9.03475M18.6344 16C18.6344 17.6569 17.2912 19 15.6344 19C13.9775 19 12.6344 17.6569 12.6344 16C12.6344 14.3431 13.9775 13 15.6344 13C17.2912 13 18.6344 14.3431 18.6344 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="showcase-title">Research & Reading</h3>
                <p class="showcase-text">I continuously engage in thorough research and extensive reading to gather accurate information, ensuring my content remains credible, informative, and relevant.</p>
            </div>

            <!-- SEO Card -->
            <div class="showcase-card">
                <div class="showcase-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9.62579 18.5328C14.1912 18.5328 17.8922 14.8318 17.8922 10.2664C17.8922 5.701 14.1912 2 9.62579 2C5.06037 2 1.35938 5.701 1.35938 10.2664C1.35938 14.8318 5.06037 18.5328 9.62579 18.5328Z" stroke="currentColor" stroke-width="2" stroke-miterlimit="10"/>
                        <path d="M2.48438 14.434L7.28853 9.5037C7.77382 9.00566 8.5726 9.00044 9.06436 9.49209L10.6808 11.1082C11.1719 11.5991 11.9693 11.5947 12.4549 11.0984L21.3564 2" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M18.3594 1H22.5416V5.02772" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M15.7967 16.0977L21.527 22.1087" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="showcase-title">Domain Knowledge</h3>
                <p class="showcase-text">My profound expertise in IT and Supply Chain allows me to write with authority and deep understanding on specialized topics within these industries.</p>
            </div>

            <!-- Domain Card -->
            <div class="showcase-card">
                <div class="showcase-icon">
                <svg width="37" height="23" viewBox="0 0 37 23" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.38281 17.7093C2.02567 17.6583 2.67228 17.6817 3.30976 17.7791C4.88085 18.0222 5.88527 18.652 6.39823 18.9004C8.98583 20.1707 10.8819 17.5576 15.2608 17.6744C18.7145 17.7644 18.5332 19.4201 21.7063 19.2159C24.9921 19.0105 25.7696 17.2084 28.5022 17.7791C29.8169 18.0544 30.4627 18.6426 32.5656 18.9353C33.4823 19.0626 34.4094 19.0977 35.3331 19.04" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
<path d="M1.38281 20.0418C2.02565 19.9901 2.67235 20.0135 3.30976 20.1116C4.88085 20.3546 5.88527 20.9831 6.39823 21.2328C8.98583 22.5018 10.8819 19.89 15.2608 20.0068C18.7145 20.0968 18.5332 21.7458 21.7063 21.547C24.9921 21.3429 25.7696 19.5395 28.5022 20.1116C29.8169 20.3801 30.4627 20.975 32.5656 21.2677C33.4823 21.3944 34.4094 21.4294 35.3331 21.3725" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
<path d="M3.80095 17.8403L2.09693 12.2206C2.069 12.129 2.06295 12.0321 2.07926 11.9377C2.09558 11.8433 2.13379 11.7541 2.19086 11.6772C2.24793 11.6002 2.32225 11.5378 2.40785 11.4948C2.49345 11.4518 2.58794 11.4295 2.68373 11.4297H7.115" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
<path d="M5.45312 11.4044V5.60747C5.45312 5.18011 5.62288 4.77024 5.92508 4.46805C6.22727 4.16586 6.63714 3.99609 7.0645 3.99609H23.1339C23.4395 3.99629 23.7388 4.08337 23.9967 4.24719C24.2547 4.411 24.4608 4.64479 24.5909 4.92129L27.1503 10.3543" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
<path d="M8.89844 11.6404H20.6964C21.1885 11.6402 21.6658 11.4726 22.0499 11.1651L22.571 10.7488C22.9546 10.4413 23.4315 10.2736 23.9231 10.2734H33.7042C33.8182 10.2737 33.9298 10.3057 34.0266 10.3658C34.1234 10.4259 34.2016 10.5118 34.2523 10.6139C34.3031 10.7159 34.3244 10.8301 34.3139 10.9436C34.3035 11.057 34.2616 11.1654 34.193 11.2564L29.1279 17.9704" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
<path d="M7.39844 4.15158V1.92386C7.39844 1.67883 7.49578 1.44385 7.66903 1.27059C7.84229 1.09734 8.07725 1 8.32228 1H9.77252C10.2058 0.999635 10.6295 1.12676 10.991 1.36554C11.3526 1.60432 11.6358 1.94419 11.8056 2.34281L12.6273 4.28049" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
<path d="M9.71361 6H8.05201C7.68242 6 7.38281 6.29961 7.38281 6.6692V8.3308C7.38281 8.70039 7.68242 9 8.05201 9H9.71361C10.0832 9 10.3828 8.70039 10.3828 8.3308V6.6692C10.3828 6.29961 10.0832 6 9.71361 6Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
<path d="M15.7136 6H14.052C13.6824 6 13.3828 6.29961 13.3828 6.6692V8.3308C13.3828 8.70039 13.6824 9 14.052 9H15.7136C16.0832 9 16.3828 8.70039 16.3828 8.3308V6.6692C16.3828 6.29961 16.0832 6 15.7136 6Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
<path d="M22.8239 9H19.9398C19.8665 9 19.7939 8.98611 19.7262 8.95913C19.6585 8.93214 19.5971 8.8926 19.5453 8.84275C19.4936 8.79291 19.4526 8.73375 19.4247 8.66867C19.3968 8.60359 19.3826 8.53387 19.3828 8.4635V6.5365C19.3828 6.39452 19.4415 6.25834 19.5459 6.15778C19.6503 6.05722 19.7919 6.00048 19.9398 6H21.7726C21.8745 6.00022 21.9745 6.0272 22.0616 6.07802C22.1487 6.12884 22.2197 6.20156 22.2668 6.28832L23.3182 8.21533C23.3631 8.29694 23.3853 8.38835 23.3826 8.48064C23.3798 8.57293 23.3522 8.66297 23.3025 8.74198C23.2527 8.82099 23.1824 8.88628 23.0986 8.9315C23.0147 8.97672 22.9201 9.00031 22.8239 9Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
</svg>
                </div>
                <h3 class="showcase-title">SEO Proficiency</h3>
                <p class="showcase-text">With a robust grasp of SEO principles, I strategically incorporate keywords and optimize content to enhance search engine rankings and drive organic traffic.</p>
            </div>
        </div>
    </div>
</section>
<section class="blog-showcase" aria-label="Latest Blog Posts and Case Studies">
    <div class="blog-container">
        <div class="blog-header">
            <span class="blog-label">MY BLOG & CASE STUDY</span>
            <h2 class="blog-heading">Check out my latest blog and success stories</h2>
        </div>
        
        <div class="blog-grid">
            <?php
            // Query for 2 blog posts
            $blog_args = array(
                'post_type' => 'post',
                'category_name' => 'blogs',
                'posts_per_page' => 2,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $blog_query = new WP_Query($blog_args);
            
            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) : $blog_query->the_post();
            ?>
                <article class="blog-card">
                    <div class="blog-content">
                        <time class="blog-date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                            <?php echo get_the_date('F j, Y'); ?>
                        </time>
                        <h3 class="blog-title">
                            <a href="<?php the_permalink(); ?>" class="blog-link">
                                <?php echo esc_html(get_the_title()); ?>
                            </a>
                        </h3>
                        <p class="blog-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            
            // Query for 1 case study
            $case_args = array(
                'post_type' => 'post',
                'category_name' => 'blogs',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $case_query = new WP_Query($case_args);
            
            if ($case_query->have_posts()) :
                while ($case_query->have_posts()) : $case_query->the_post();
            ?>
                <article class="blog-card">
                    <div class="blog-content">
                        <time class="blog-date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                            <?php echo get_the_date('F j, Y'); ?>
                        </time>
                        <h3 class="blog-title">
                            <a href="<?php the_permalink(); ?>" class="blog-link">
                                <?php echo esc_html(get_the_title()); ?>
                            </a>
                        </h3>
                        <p class="blog-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>
<section class="contact-section" aria-label="Contact Information">
    <div class="contact-container">
        <span class="contact-label">You have any questions?</span>
        <h2 class="contact-heading highlight">Just Say Hello!</h2>
        <a href="<?php echo esc_url($current_author['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="cta-button">Connect Me</a>
    </div>
</section>
<?php get_footer(); ?>