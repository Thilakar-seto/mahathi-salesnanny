<?php 
/**
* template name: Privacy Policy
*/
get_header(); ?>

<main class="privacy-policy">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- Content Section -->
    <section class="policy-content">
        <div class="privacy-container">
            <article>
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </article>
        </div>
    </section>
</main>

<style>
/* Root Variables */
:root {
    --primary-color: #052439;
    --secondary-color: #ff4916;
    --text-color: #444;
    --bg-light: #f8f9fa;
    --spacing: clamp(2rem, 5vw, 4rem);
    --container-width: 900px;
    --heading-line-height: 1.3;
    --text-line-height: 1.7;
}

/* Privacy Policy Specific Styles */
.privacy-policy {
    color: var(--text-color);
    line-height: var(--text-line-height);
}

/* Hero Section */
.privacy-policy .hero {
    background: rgb(4 26 65);
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    padding: var(--spacing);
}

.privacy-policy .hero h1 {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 700;
    margin: 0;
    animation: fadeIn 1s ease-out;
}

/* Layout & Container */
.privacy-policy .privacy-container {
    max-width: var(--container-width);
    margin: 0 auto;
    padding: 2rem;
    background-color: #fff;
}

.privacy-policy .policy-content {
    padding: var(--spacing) 0;
    background-color: #f0f0f0;
}

/* Typography & Content Styling */
.privacy-policy .policy-content article {
    font-size: clamp(15.84px, 1.17vw, 17.6px);
}

/* Headings */
.privacy-policy .policy-content h2,
.privacy-policy .policy-content h3,
.privacy-policy .policy-content h4 {
    color: var(--primary-color);
    font-weight: 700;
    line-height: var(--heading-line-height);
}

.privacy-policy .policy-content h2 {
    font-size: clamp(1.5rem, 2.5vw, 1.8rem);  /* Reduced from 2.2rem */
    margin: 2.5rem 0 1.2rem;  /* Reduced margin */
}

.privacy-policy .policy-content h3 {
    font-size: clamp(1.25rem, 2vw, 1.5rem);  /* Reduced from 1.8rem */
    margin: 2rem 0 1rem;  /* Reduced margin */
}

.privacy-policy .policy-content h4 {
    font-size: clamp(1.1rem, 1.5vw, 1.25rem);  /* Reduced from 1.5rem */
    margin: 1.5rem 0 0.8rem;  /* Reduced margin */
}

/* Paragraphs */
.privacy-policy .policy-content p {
    margin-bottom: 1.5rem;
    line-height: var(--text-line-height);
}

/* Lists */

.wp-block-group__inner-container.is-layout-constrained.wp-block-group-is-layout-constrained h3 {
    font-size: clamp(15.30px, 1.13vw, 17px);
    line-height: 10px;
}

.privacy-policy .policy-content ul,
.privacy-policy .policy-content ol {
    margin: 1.5rem 0;
    padding-left: 2.5rem;
}

.privacy-policy .policy-content li {
    margin-bottom: 0.8rem;
    line-height: var(--text-line-height);
}

.privacy-policy .policy-content ul li {
    list-style-type: disc;
}

.privacy-policy .policy-content ul ul li {
    list-style-type: circle;
}

.privacy-policy .policy-content ol li {
    list-style-type: decimal;
}

/* Links */
.privacy-policy .policy-content a {
    color: var(--secondary-color);
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: all 0.3s ease;
}

.privacy-policy .policy-content a:hover {
    border-bottom-color: var(--secondary-color);
}

/* Blockquotes */
.privacy-policy .policy-content blockquote {
    margin: 2.5rem 0;
    padding: 1.5rem 2rem;
    background-color: var(--bg-light);
    border-left: 4px solid var(--secondary-color);
    border-radius: 0 4px 4px 0;
}

.privacy-policy .policy-content blockquote p {
    margin-bottom: 0;
    font-style: italic;
}

/* Tables */
.privacy-policy .policy-content table {
    width: 100%;
    margin: 2rem 0;
    border-collapse: collapse;
}

.privacy-policy .policy-content th,
.privacy-policy .policy-content td {
    padding: 0.75rem;
    border: 1px solid #ddd;
    text-align: left;
}

.privacy-policy .policy-content th {
    background-color: var(--bg-light);
    font-weight: 800;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive Design */
@media (max-width: 768px) {
    .privacy-policy .container {
        padding: 0 1rem;
    }

    .privacy-policy .policy-content {
        padding: calc(var(--spacing) * 0.7) 0;
    }

    .privacy-policy .policy-content ul,
    .privacy-policy .policy-content ol {
        padding-left: 1.5rem;
    }

    .privacy-policy .policy-content blockquote {
        padding: 1rem 1.5rem;
        margin: 2rem 0;
    }
}

/* Print Styles */
@media print {
    .privacy-policy .hero {
        background: none;
        color: var(--primary-color);
        min-height: auto;
        padding: 2rem 0;
    }

    .privacy-policy .policy-content {
        font-size: 11pt;
    }

    .privacy-policy .policy-content a {
        text-decoration: underline;
        color: var(--primary-color);
    }

    .privacy-policy .policy-content blockquote {
        border: 1px solid #ddd;
        page-break-inside: avoid;
    }
}
</style>

<?php get_footer(); ?>