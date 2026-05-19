<?php
get_header();
?>

<style>
    /* -----------------------------------------------------------
       1. IMPORTS & FONTS
    ----------------------------------------------------------- */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    /* -----------------------------------------------------------
       2. LAYOUT & 50/50 BACKGROUND
    ----------------------------------------------------------- */
    .rv-split-section {
        /* Theme Colors */
        --sn-red: #D92332;
        --sn-navy: #1E2252;
        --sn-light: #f8fafc;
        
        position: relative;
        width: 100%;
        height: 100vh;
        min-height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
        overflow: hidden;
        
        /* The 50/50 Split Gradient */
        background: linear-gradient(
            90deg, 
            var(--sn-light) 0%, 
            var(--sn-light) 50%, 
            var(--sn-navy) 50%, 
            var(--sn-navy) 100%
        );
    }

    /* -----------------------------------------------------------
       3. BACKGROUND DECORATION
    ----------------------------------------------------------- */
    .rv-grid-pattern {
        position: absolute;
        top: 0; left: 0; bottom: 0; width: 50%;
        background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
        background-size: 24px 24px;
        opacity: 0.6;
        pointer-events: none;
    }

    .rv-glow-effect {
        position: absolute;
        top: 50%;
        right: -10%;
        transform: translateY(-50%);
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(217, 35, 50, 0.15) 0%, transparent 70%);
        filter: blur(100px);
        z-index: 0;
        animation: rv-pulse 6s infinite alternate;
    }

    @keyframes rv-pulse {
        0% { opacity: 0.4; transform: translateY(-50%) scale(1); }
        100% { opacity: 0.8; transform: translateY(-50%) scale(1.1); }
    }

    /* -----------------------------------------------------------
       4. CONTAINER & COLUMNS
    ----------------------------------------------------------- */
    .rv-container {
        width: 100%;
        max-width: 1240px;
        padding: 0 40px;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 10;
        gap: 80px;
    }

    /* Left Side (Light - Text) */
    .rv-text-col {
        flex: 1;
        padding-right: 20px;
    }

    /* Right Side (Dark - Visual) */
    .rv-visual-col {
        flex: 1;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* -----------------------------------------------------------
       5. TYPOGRAPHY & ELEMENTS
    ----------------------------------------------------------- */
    .rv-status {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        background: #fff1f2;
        border: 1px solid rgba(217, 35, 50, 0.2);
        color: var(--sn-red);
        border-radius: 100px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 24px;
    }

    .rv-spinner {
        animation: rv-spin 3s linear infinite;
    }
    @keyframes rv-spin { 100% { transform: rotate(360deg); } }

    .rv-title {
        font-size: 45px;
        line-height: 1.15;
        font-weight: 800;
        color: var(--sn-navy);
        margin: 0 0 20px 0;
        letter-spacing: -1px;
    }

    .rv-title span {
        color: var(--sn-red);
        position: relative;
        display: inline-block;
    }

    /* Underline Effect */
    .rv-title span::after {
        content: "";
        position: absolute;
        bottom: 4px;
        left: 0;
        width: 100%;
        height: 8px;
        background: rgba(217, 35, 50, 0.15);
        z-index: -1;
    }

    .rv-description {
        font-size: 17px;
        line-height: 1.6;
        color: #475569;
        margin-bottom: 40px;
        max-width: 480px;
    }

    /* Button */
    .rv-btn {
        background-color: var(--sn-red);
        color: white;
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 15px 30px -10px rgba(217, 35, 50, 0.5);
        transition: transform 0.2s ease, background-color 0.2s;
    }

    .rv-btn:hover {
        background-color: #b91c29;
        transform: translateY(-3px);
    }

    /* -----------------------------------------------------------
       6. VISUALS (Bridge Effect)
    ----------------------------------------------------------- */
    .rv-img-wrapper {
        position: relative;
        /* Negative Margin to pull image across the split line */
        margin-left: -80px; 
        z-index: 5;
    }

    .rv-main-img {
        width: 100%;
        max-width: 480px;
        border-radius: 24px;
        display: block;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5); /* Strong shadow for depth */
        border: 4px solid rgba(255, 255, 255, 0.1);
        transform: rotate(-3deg);
        transition: transform 0.4s ease;
    }

    .rv-visual-col:hover .rv-main-img {
        transform: rotate(0deg) scale(1.02);
    }

    /* Floating Support Card */
    .rv-float-card {
        position: absolute;
        bottom: 40px;
        right: -30px;
        background: #ffffff;
        padding: 16px 24px;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 16px;
        z-index: 10;
        animation: rv-float 5s ease-in-out infinite;
        border-left: 5px solid var(--sn-red);
    }

    .rv-icon-circle {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sn-navy);
        font-size: 18px;
    }

    .rv-float-text h5 { margin: 0; font-size: 14px; color: var(--sn-navy); font-weight: 700; }
    .rv-float-text span { font-size: 12px; color: #64748b; }

    @keyframes rv-float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* -----------------------------------------------------------
       7. RESPONSIVE
    ----------------------------------------------------------- */
    @media (max-width: 992px) {
        .rv-split-section {
            background: var(--sn-light); /* Remove split on mobile */
            height: auto;
            flex-direction: column;
            padding: 80px 20px;
        }

        .rv-grid-pattern { width: 100%; }

        .rv-container {
            flex-direction: column;
            gap: 50px;
            padding: 0;
        }

        .rv-text-col {
            padding-right: 0;
            text-align: center;
        }

        .rv-description { margin-left: auto; margin-right: auto; }

        .rv-visual-col {
            margin-left: 0;
            width: 100%;
        }
        
        .rv-img-wrapper {
            margin-left: 0;
        }

        .rv-main-img {
            transform: rotate(0deg);
        }

        .rv-float-card {
            right: 0;
            bottom: -20px;
        }
    }
</style>

<section class="rv-split-section">
    
    <!-- Background Elements -->
    <div class="rv-grid-pattern"></div>
    <div class="rv-glow-effect"></div>

    <div class="rv-container">
        
        <!-- LEFT: Content (Light Side) -->
        <div class="rv-text-col">
            <div class="rv-status">
                <i class="fa-solid fa-arrows-rotate rv-spinner"></i>
                We're Currently Revamping 🚧
            </div>

            <h1 class="rv-title">
                Our website is getting a <br>
                <span>fresh upgrade</span> to serve you better.
            </h1>

            <p class="rv-description">
                While we work behind the scenes, our team is always here to help you anytime.<br>
                Feel free to reach out — we're just a message away.
            </p>

            <a href="/contact" class="rv-btn">
                <i class="fa-regular fa-envelope"></i>
                Reach Us for Queries
            </a>
        </div>

        <!-- RIGHT: Visual (Dark Side) -->
        <div class="rv-visual-col">
            <div class="rv-img-wrapper">
                
                <!-- Main Image bridging the gap -->
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop" alt="System Upgrade" class="rv-main-img">

                <!-- Floating Info Card -->
                <div class="rv-float-card">
                    <div class="rv-icon-circle">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="rv-float-text">
                        <h5>Support Active</h5>
                        <span>We are here to help via email</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>