<?php
/**
 * Template Name: about
 */
get_header();
?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* ========================================
       FONTS & IMPORTS
       ======================================== */
    
    /* ========================================
       VARIABLES (YOUR EXACT THEME)
       ======================================== */
    :root {
        --brand-navy: #0C2D48;
        --brand-navy-dark: #051524;
        --brand-accent-start: #ff4916;
        --brand-accent-end: #c94444;
        --text-white: #ffffff;
        --text-muted: #64748b; 
        --shadow-soft: 0 20px 40px -10px rgba(0,0,0,0.05);
    }
    
    /* ========================================
       HERO LAYOUT
       ======================================== */
    .hero-section {
        position: relative;
        background-color: var(--brand-navy);
        background: radial-gradient(circle at top right, #133b5c 0%, var(--brand-navy) 40%, var(--brand-navy-dark) 100%);
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 80px 5% 60px;
        min-height: 600px; /* Ensure height match */
    }
    
    /* Animated Background Grid */
    .hero-bg-grid {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: grid-move 30s linear infinite;
        pointer-events: none;
        z-index: 0;
    }
    
    @keyframes grid-move {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }
    
    /* Floating Orbs */
    .hero-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        opacity: 0.4;
        animation: orb-float 15s ease-in-out infinite;
        pointer-events: none;
        z-index: 0;
    }
    
    .hero-orb-1 {
        width: 500px;
        height: 500px;
        background: var(--brand-accent-start);
        top: -20%;
        right: -10%;
        opacity: 0.15;
    }
    
    .hero-orb-2 {
        width: 400px;
        height: 400px;
        background: #4facfe;
        bottom: -10%;
        left: -10%;
        opacity: 0.1;
        animation-delay: -5s;
    }
    
    @keyframes orb-float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-30px, 20px) scale(1.1); }
    }
    
    .hero-container {
        max-width: 1300px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    
    /* Hero Content */
    .hero-content {
        max-width: 850px;
    }
    
    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--brand-accent-start);
        margin-bottom: 24px;
        animation: fade-up 0.8s ease forwards;
    }
    
    .hero-label-line {
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, var(--brand-accent-start), transparent);
        border-radius: 2px;
    }
    
    .hero-label-badge {
        background: rgba(255, 255, 255, 0.08);
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        backdrop-filter: blur(4px);
    }
    
    .hero-title {
         /* Enforce Inter for Header */
        font-size: 46px;
        font-weight: 800;
        color: var(--text-white);
        line-height: 1.1;
        margin: 0 0 24px 0;
        letter-spacing: -1.5px;
        animation: fade-up 0.8s ease 0.1s forwards;
        opacity: 0;
    }
    
    .hero-title-highlight {
        background: linear-gradient(135deg, var(--brand-accent-start) 0%, var(--brand-accent-end) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }
    
    .hero-description {
        font-size: 18px;
        line-height: 1.8;
        color: #fff;
        margin: 0 0 40px 0;
        max-width: 90%;
        animation: fade-up 0.8s ease 0.2s forwards;
        opacity: 0;
    }
    
    /* Buttons */
    .hero-actions {
        display: flex;
        gap: 20px;
        animation: fade-up 0.8s ease 0.3s forwards;
        opacity: 0;
    }
    
    .hero-btn-primary {
        padding: 16px 36px;
        background: linear-gradient(135deg, var(--brand-accent-start), var(--brand-accent-end));
        color: white;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(255, 73, 22, 0.3);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none; /* Ensure link looks like button */
        display: inline-block;
    }
    
    .hero-btn-primary::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
    }
    
    .hero-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 73, 22, 0.4);
    }
    
    .hero-btn-primary:hover::after {
        left: 100%;
    }
    
    /* Hero Visual */
    .hero-visual {
        position: relative;
        height: 100%;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fade-left 1s ease 0.4s forwards;
        opacity: 0;
    }
    
    .hero-image-wrapper {
        position: relative;
        width: 100%;
        max-width: 550px;
    }
    
    .hero-image-container {
        position: relative;
        border-radius: 32px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
        z-index: 5;
    }
    
    .hero-image-main {
        width: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .hero-image-container:hover .hero-image-main {
        transform: scale(1.03);
    }
    
    /* Floating Cards */
    .hero-float-card {
        position: absolute;
        background: rgba(12, 45, 72, 0.6);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        z-index: 10;
        transition: transform 0.3s ease;
    }
    
    .hero-float-card:hover {
        transform: scale(1.05) translateY(-5px);
        background: rgba(12, 45, 72, 0.8);
    }
    
    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        background: linear-gradient(135deg, #1e4b75, #0C2D48);
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.1);
    }
    
    .card-icon.accent {
        background: linear-gradient(135deg, var(--brand-accent-start), var(--brand-accent-end));
        box-shadow: 0 5px 15px rgba(255, 73, 22, 0.4);
    }
    
    .card-content h4 {
        margin: 0;
        color: white;
        font-size: 18px;
        font-weight: 700;
        
    }
    
    .card-content p {
        margin: 2px 0 0;
        color: #fff;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .float-1 {
        top: 40px;
        right: -30px;
        animation: float-y 6s ease-in-out infinite;
    }
    
    .float-2 {
        bottom: 50px;
        left: -40px;
        animation: float-y 7s ease-in-out 1s infinite;
    }
    
    /* Animations */
    @keyframes float-y {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes fade-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fade-left {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-section { padding: 100px 5%; }
        .hero-container { grid-template-columns: 1fr; text-align: center; gap: 50px; }
        .hero-content { margin: 0 auto; display: flex; flex-direction: column; align-items: center; }
        .hero-label { justify-content: center; }
        .hero-actions { justify-content: center; }
        .float-1 { right: 0; top: -20px; }
        .float-2 { left: 0; bottom: -20px; }
    }
    
    @media (max-width: 768px) {
        .hero-title { font-size: 36px; }
        .float-1, .float-2 { display: none; }
    }
</style>

<section class="hero-section">
    <div class="hero-bg-grid"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>

    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-label">
                <span class="hero-label-line"></span>
                <span class="hero-label-badge">WHO WE ARE</span>
            </div>

            <h1 class="hero-title">
                Your Behind-the-Scenes Operations Team for <span class="services-title-highlight">Global Freight</span>
            </h1>

            <p class="hero-description">
                We take care of the operational load - documentation, follow-ups, updates, billing, coordination - so your frontline teams can focus on customers, exceptions, and growth.
            </p>

            <div class="hero-actions">
                <a href="#" class="services-cta-btn">Talk to Us</a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-image-wrapper">
                <div class="hero-image-container">
                    <!-- Using a high quality office/ops team image -->
                    <img 
                        src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                        alt="Operations Team" 
                        class="hero-image-main"
                    >
                </div>

                <div class="hero-float-card float-1">
                    <div class="card-icon accent">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="card-content">
                        <h4>Documentation</h4>
                        <p>Managed</p>
                    </div>
                </div>

                <div class="hero-float-card float-2">
                    <div class="card-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="card-content">
                        <h4>Coordination</h4>
                        <p>Seamless</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelector('.hero-section').addEventListener('mousemove', (e) => {
        const cards = document.querySelectorAll('.hero-float-card');
        const x = (window.innerWidth - e.pageX) / 50;
        const y = (window.innerHeight - e.pageY) / 50;
        
        cards.forEach((card, index) => {
            const speed = (index + 1) * 1.5;
            card.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
        });
    });
</script>
<style>
    /* ========================================
       SHARED VARIABLES (Ensure consistency)
       ======================================== */
    :root {
        --brand-navy: #0C2D48;
        --brand-navy-dark: #051524;
        --brand-accent-start: #ff4916;
        --text-main: #1e293b;
        --text-muted: #475569;
        --grid-line: #e2e8f0;
    }

    /* ========================================
       SECTION 2: ABOUT GRID LAYOUT
       ======================================== */
    .about-feature-section {
        position: relative;
        background-color: #ffffff;
        /* The requested Grid Pattern */
        background-image: 
            linear-gradient(var(--grid-line) 1px, transparent 1px),
            linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
        background-size: 40px 40px;
        padding: 80px 5% 60px;
        
        overflow: hidden;
    }

    /* Fade overlay to blend grid at edges (Optional premium touch) */
    .about-feature-section::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(to top, #ffffff 20%, transparent 100%);
        pointer-events: none;
    }

    .feature-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    /* --- LEFT SIDE: IMAGE --- */
    .feature-image-col {
        position: relative;
    }

    .image-back-pattern {
        position: absolute;
        top: -20px;
        left: -20px;
        width: 200px;
        height: 200px;
        /* Dot pattern accent */
        background-image: radial-gradient(var(--brand-accent-start) 1.5px, transparent 1.5px);
        background-size: 12px 12px;
        opacity: 0.3;
        z-index: 0;
    }

    .main-feature-img {
        width: 100%;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(12, 45, 72, 0.25); /* Navy shadow */
        position: relative;
        z-index: 1;
        border: 1px solid rgba(12, 45, 72, 0.05);
        display: block;
    }

    /* Floating "Badge" on image */
    .feature-badge {
        position: absolute;
        bottom: 30px;
        right: -20px;
        background: #ffffff;
        padding: 15px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 15px;
        z-index: 2;
        border-left: 4px solid var(--brand-accent-start);
    }

    .badge-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 73, 22, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-accent-start);
        font-size: 18px;
    }

    .badge-text strong {
        display: block;
        color: var(--brand-navy);
        
        font-size: 16px;
        line-height: 1.2;
    }
    .badge-text span {
        font-size: 12px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* --- RIGHT SIDE: CONTENT --- */
    .feature-content-col {
        display: flex;
        flex-direction: column;
    }

    .section-tag {
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 2px;
        color: var(--brand-accent-start);
        text-transform: uppercase;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-tag::before {
        content: "";
        width: 20px;
        height: 2px;
        background: var(--brand-accent-start);
    }

    .feature-title {
        
        font-size: 36px;
        line-height: 1.2;
        font-weight: 800;
        color: var(--brand-navy);
        margin: 0 0 24px 0;
    }

    .feature-desc {
    font-size: 18px;
    line-height: 1.6;
    color: #475569;
    margin-bottom: 20px;
}

    /* The Highlight Quote Box */
    .quote-box {
        margin-top: 20px;
        background: linear-gradient(to right, #f8fafc, #ffffff);
        border: 1px solid #e2e8f0;
        border-left: 4px solid var(--brand-accent-start);
        padding: 24px 30px;
        border-radius: 0 12px 12px 0;
        position: relative;
    }

    .quote-icon {
        font-size: 24px;
        color: #cbd5e1;
        position: absolute;
        top: 15px;
        left: 15px;
    }

    .quote-text {
         /* Distinct font for quote */
        font-size: 18px;
        font-weight: 600;
        color: var(--brand-navy);
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .feature-container { grid-template-columns: 1fr; gap: 50px; }
        .feature-image-col { order: 2; margin-top: 20px; }
        .feature-badge { right: 0; }
    }
</style>
<section class="about-feature-section">
    <div class="feature-container">
        
        <!-- Left: Image -->
        <div class="feature-image-col">
            <div class="image-back-pattern"></div>
            <!-- Image: Professional person working in a modern environment -->
            <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Dedicated Freight Operations" class="main-feature-img">
            
            <!-- Floating Badge -->
            <div class="feature-badge">
                <div class="badge-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="badge-text">
                    <strong>Specialized</strong>
                    <span>Freight BPO</span>
                </div>
            </div>
        </div>

        <!-- Right: Content -->
        <div class="feature-content-col">
            <div class="section-tag">Our Approach</div>
            
            <h2 class="feature-title">A Dedicated Operations Partner for Modern Freight Teams</h2>
            
            <p class="feature-desc">
                We are a specialized Freight BPO built entirely around the realities of freight forwarding, customs brokerage, transport coordination, NVOCC operations, and multimodal logistics.
            </p>
            
            <p class="feature-desc">
                Our teams operate as an extension of your office - handling the daily execution work that keeps shipments moving, customers updated, and finance running smoothly.
            </p>

            <!-- The Quote Block -->
            <div class="quote-box">
                <p class="quote-text">
                    “We are not a traditional BPO. We are your operations engine, built by logistics people for logistics teams.”
                </p>
            </div>
        </div>

    </div>
</section>
<style>
    /* ========================================
       IMPORTS
       ======================================== */
    
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

    /* ========================================
       SECTION LAYOUT & BACKGROUND
       ======================================== */
    .gcc-purpose-section {
        position: relative;
        background-color: #051524; /* Dark Navy */
        background-image: radial-gradient(circle at top center, #0C2D48 0%, #051524 70%);
        padding: 80px 5% 60px;
        
        overflow: hidden;
        box-sizing: border-box;
    }

    /* Decorative background grid */
    .gcc-bg-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        opacity: 0.6;
        pointer-events: none;
    }

    .gcc-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* ========================================
       HEADER TYPOGRAPHY
       ======================================== */
    .gcc-header-wrapper {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 60px auto;
        opacity: 0; /* Hidden for animation */
        transform: translateY(20px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .gcc-header-wrapper.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .gcc-subtitle {
        display: inline-block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #ff4916; /* Brand Orange */
        text-transform: uppercase;
        margin-bottom: 16px;
        border: 1px solid rgba(255, 73, 22, 0.3);
        padding: 8px 16px;
        border-radius: 30px;
        background: rgba(255, 73, 22, 0.1);
    }

    .gcc-title {
        
        font-size: 36px;
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        line-height: 1.2;
    }

    /* ========================================
       CARD GRID SYSTEM
       ======================================== */
    .gcc-card-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    /* Individual Card Styling */
    .gcc-card {
        background: rgba(12, 45, 72, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease;
        opacity: 0; /* Hidden for animation */
        transform: translateY(30px);
    }

    .gcc-card.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .gcc-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border-color: rgba(255, 73, 22, 0.3);
    }

    /* Card Image Area */
    .gcc-card-image-box {
        height: 240px;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .gcc-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .gcc-card:hover .gcc-card-img {
        transform: scale(1.05);
    }

    /* Image Overlay Gradient */
    .gcc-card-image-box::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 0%, rgba(12, 45, 72, 0.9) 100%);
    }

    /* Floating Icon on Image */
    .gcc-card-icon {
        position: absolute;
        bottom: 20px;
        left: 30px;
        width: 50px;
        height: 50px;
        background: #ff4916;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        z-index: 2;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    /* Card Content Area */
    .gcc-card-content {
        padding: 30px 30px 40px;
        flex-grow: 1;
        position: relative;
    }

    .gcc-card-title {
        
        font-size: 24px;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 20px 0;
    }

    /* Quote Styling */
    .gcc-quote-box {
        position: relative;
        margin-bottom: 24px;
        padding-left: 20px;
        border-left: 3px solid #ff4916;
    }

    .gcc-quote-text {
        
        font-size: 18px;
        color: #e2e8f0;
        line-height: 1.5;
        margin: 0;
        font-weight: 500;
    }

    .gcc-body-text {
        font-size: 15px;
        color: #fff; /* Muted text */
        line-height: 1.7;
        margin: 0;
        font-weight: 300;
    }

    /* ========================================
       RESPONSIVE DESIGN
       ======================================== */
    @media (max-width: 900px) {
        .gcc-card-grid {
            grid-template-columns: 1fr;
            max-width: 600px;
            margin: 0 auto;
        }

        .gcc-title {
            font-size: 28px;
        }
        
        .gcc-card-image-box {
            height: 200px;
        }
    }
</style>

<section class="gcc-purpose-section" id="gccPurpose">
    <div class="gcc-bg-pattern"></div>
    
    <div class="gcc-container">
        <!-- Header -->
        <div class="gcc-header-wrapper">
            <span class="services-badge" style="opacity: 1; transform: translateY(0px);"><span class="services-badge-icon"></span> Our Core Values</span>
            <h2 class="gcc-title">The Purpose Behind Our GCC</h2>
        </div>

        <!-- Cards Container -->
        <div class="gcc-card-grid">
            
            <!-- Mission Card -->
            <div class="gcc-card">
                <div class="gcc-card-image-box">
                    <!-- Image: Team collaboration/Ops floor -->
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Logistics Team Mission" class="gcc-card-img">
                    <div class="gcc-card-icon">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                </div>
                <div class="gcc-card-content">
                    <h3 class="gcc-card-title">Our Mission</h3>
                    <div class="gcc-quote-box">
                        <p class="gcc-quote-text">“To strengthen global freight operations with a reliable, always-on execution engine that delivers accuracy, speed, and operational excellence—every single day.”</p>
                    </div>
                    <p class="gcc-body-text">
                        We act as a seamless extension of your logistics team, ensuring every shipment, document, and workflow moves with discipline and dependability.
                    </p>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="gcc-card" style="transition-delay: 0.2s;">
                <div class="gcc-card-image-box">
                    <!-- Image: Global scale/Technology/Future -->
                    <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Global Vision" class="gcc-card-img">
                    <div class="gcc-card-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                </div>
                <div class="gcc-card-content">
                    <h3 class="gcc-card-title">Our Vision</h3>
                    <div class="gcc-quote-box">
                        <p class="gcc-quote-text">“To redefine how logistics companies scale by becoming the world’s most trusted partner for freight process outsourcing and operational transformation.”</p>
                    </div>
                    <p class="gcc-body-text">
                        We envision a world where freight teams operate without limits—supported by a GCC that blends human expertise, process discipline, and 24/7 global capability.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const elementsToAnimate = document.querySelectorAll('.gcc-header-wrapper, .gcc-card');
        elementsToAnimate.forEach(el => observer.observe(el));
    });
</script>

<style>
    /* ========================================
       IMPORTS
       ======================================== */
    
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

    /* ========================================
       SECTION STYLES
       ======================================== */
    .challenge-section {
        position: relative;
        background-color: #ffffff;
        padding: 80px 5% 60px;
        
        overflow: hidden;
    }

    /* Subtle Grid Pattern on White */
    .challenge-bg-grid {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(#e2e8f0 1.5px, transparent 1.5px);
        background-size: 30px 30px;
        opacity: 0.7;
        z-index: 0;
    }

    .challenge-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.2fr 0.8fr; /* Content wider than visual */
        gap: 60px;
        align-items: center;
    }

    /* ========================================
       LEFT COLUMN: CONTENT
       ======================================== */
    .challenge-content-col {
        display: flex;
        flex-direction: column;
    }

    /* Label */
    .challenge-label {
        display: inline-block;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #ff4916; /* Brand Orange */
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .challenge-label::before {
        content: '';
        width: 25px;
        height: 2px;
        background-color: #ff4916;
    }

    /* Title */
    .challenge-title {
        
        font-size: 40px;
        font-weight: 800;
        color: #0C2D48; /* Brand Navy */
        line-height: 1.15;
        margin: 0 0 24px 0;
        max-width: 600px;
    }

    /* Intro Text */
    .challenge-intro {
    font-size: 18px;
    line-height: 1.6;
    color: #475569;
    margin-bottom: 20px;
}

    /* ========================================
       PAIN POINT LIST
       ======================================== */
    .pain-point-wrapper {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 40px;
    }

    .pain-point-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px 20px;
        background: #f8fafc;
        border-left: 3px solid #cbd5e1;
        border-radius: 0 8px 8px 0;
        transition: all 0.3s ease;
    }

    .pain-point-item:hover {
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-left-color: #ff4916;
        transform: translateX(5px);
    }

    .pain-point-icon {
        color: #ff4916;
        font-size: 18px;
        margin-top: 2px;
    }

    .pain-point-text {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        line-height: 1.5;
    }

    /* ========================================
       RIGHT COLUMN: VISUAL & SOLUTION
       ======================================== */
    .challenge-visual-col {
        position: relative;
    }

    /* The Image */
    .visual-image-container {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        height: 550px;
    }

    .visual-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Grayscale to color on hover effect if desired, keeping simple here */
    }

    /* The "Solution" Floating Card */
    .solution-card {
        position: absolute;
        bottom: 40px;
        left: -40px; /* Overlaps the image to the left */
        right: 20px;
        background: #0C2D48; /* Brand Navy */
        color: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(12, 45, 72, 0.3);
        border-top: 4px solid #ff4916;
        z-index: 5;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .solution-card.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .solution-icon {
        font-size: 32px;
        color: #ff4916;
        margin-bottom: 16px;
        display: block;
    }

    .solution-text {
        
        font-size: 18px;
        font-weight: 600;
        line-height: 1.5;
        margin: 0;
    }

    /* ========================================
       RESPONSIVE DESIGN
       ======================================== */
    @media (max-width: 992px) {
        .challenge-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .challenge-content-col {
            order: 1;
        }
        
        .challenge-visual-col {
            order: 2;
            margin-top: 20px;
        }

        .solution-card {
            position: relative;
            left: 0;
            right: 0;
            bottom: 0;
            margin-top: -50px; /* Pull up slightly */
            margin-left: 20px;
            margin-right: 20px;
        }
        
        .visual-image-container {
            height: 400px;
        }
    }

    @media (max-width: 600px) {
        .challenge-section { padding: 60px 5%; }
        .challenge-title { font-size: 32px; }
        .solution-card { margin: -30px 10px 0 10px; padding: 20px; }
    }
</style>

<section class="challenge-section">
    <div class="challenge-bg-grid"></div>
    
    <div class="challenge-container">
        
        <!-- Left Column: Problem Content -->
        <div class="challenge-content-col">
            <div class="challenge-label">The Bottleneck</div>
            <h2 class="challenge-title">Solving the Operational Load Challenge in Logistics</h2>
            <p class="challenge-intro">
                Freight companies lose countless hours to repetitive and time-critical tasks—coordinating with carriers, updating milestones, validating documents, preparing invoices, chasing PODs, responding to agents, and closing exceptions.
            </p>

            <div class="pain-point-wrapper">
                <div class="pain-point-item">
                    <i class="fas fa-exclamation-circle pain-point-icon"></i>
                    <p class="pain-point-text">Inconsistent outputs during rush hours</p>
                </div>
                <div class="pain-point-item">
                    <i class="fas fa-clock pain-point-icon"></i>
                    <p class="pain-point-text">Communication delays across time zones</p>
                </div>
                <div class="pain-point-item">
                    <i class="fas fa-hand-holding-usd pain-point-icon"></i>
                    <p class="pain-point-text">High hiring and training costs</p>
                </div>
                <div class="pain-point-item">
                    <i class="fas fa-layer-group pain-point-icon"></i>
                    <p class="pain-point-text">Backlogs that block shipments and billing</p>
                </div>
                <div class="pain-point-item">
                    <i class="fas fa-headset pain-point-icon"></i>
                    <p class="pain-point-text">Constant multitasking that slows customer service</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Visual & Solution -->
        <div class="challenge-visual-col">
            <div class="visual-image-container">
                <!-- Image depicting busy/chaotic logistics environment -->
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=1000&q=80" alt="Busy Logistics Operations" class="visual-img">
            </div>
            
            <div class="solution-card">
                <i class="fas fa-check-circle solution-icon"></i>
                <p class="solution-text">
                    We solve these challenges by absorbing the operational load and delivering fast, accurate, daily execution without interruption.
                </p>
            </div>
        </div>

    </div>
</section>

<script>
    // Simple Intersection Observer for the Solution Card animation
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.3 });

        const card = document.querySelector('.solution-card');
        if(card) observer.observe(card);
    });
</script>
<style>
    /* ========================================
       IMPORTS
       ======================================== */
    
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

    /* ========================================
       SECTION SETUP
       ======================================== */
    .depth-features-section {
        position: relative;
        background: radial-gradient(ellipse at 30% 20%, #0C2D48 0%, #051524 60%, #020a12 100%);
        padding: 80px 5% 60px;
        
        overflow: hidden;
        min-height: 100vh;
    }

    /* Animated Particle Background */
    .particle-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: 0;
    }

    .particle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 73, 22, 0.02);
        animation: float-particle 25s infinite linear;
    }

    @keyframes float-particle {
        0% { transform: translateY(100vh) translateX(0) scale(0); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100px) translateX(50px) scale(1.5); opacity: 0; }
    }

    .depth-container {
        max-width: 1300px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* ========================================
       HEADER
       ======================================== */
    .depth-header {
        text-align: center;
        margin-bottom: 80px;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .depth-header.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .depth-subtitle {
        display: inline-block;
        font-size: 13px;
        font-weight: 700;
        color: #ff4916;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        padding: 8px 16px;
        border: 1px solid rgba(255, 73, 22, 0.3);
        border-radius: 30px;
        background: rgba(255, 73, 22, 0.05);
    }

    .depth-title {
        
        font-size: 42px;
        font-weight: 800;
        color: #fff;
        margin: 0;
    }

    /* ========================================
       MASONRY GRID LAYOUT
       ======================================== */
    .depth-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: auto;
        gap: 30px;
    }

    /* ========================================
       MULTI-LAYER CARD
       ======================================== */
    .depth-card {
        position: relative;
        background: linear-gradient(145deg, rgba(255,255,255,0.02), rgba(255,255,255,0.005));
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 24px;
        padding: 40px 30px;
        overflow: hidden;
        transform-style: preserve-3d;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        opacity: 0;
        transform: translateY(30px);
    }

    .depth-card.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Layer 1: Base Glow (appears on hover) */
    .depth-card::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, #ff4916, #c94444, transparent, transparent);
        border-radius: 26px;
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -2;
    }

    /* Layer 2: Inner Sheen */
    .depth-card::after {
        content: '';
        position: absolute;
        inset: 1px;
        border-radius: 23px;
        background: linear-gradient(135deg, rgba(255,73,22,0.1), transparent 60%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    /* Layer 3: Side Accent Bar */
    .depth-accent {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(to bottom, #ff4916, #c94444);
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.4s ease;
    }

    .depth-card:hover::before,
    .depth-card:hover::after {
        opacity: 1;
    }

    .depth-card:hover .depth-accent {
        transform: scaleY(1);
    }

    .depth-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        border-color: rgba(255,73,22,0.2);
    }

    /* ========================================
       CARD CONTENT
       ======================================== */
    .depth-content {
        position: relative;
        z-index: 2;
    }

    .depth-number {
        position: absolute;
        top: -10px;
        right: 20px;
        
        font-size: 70px;
        font-weight: 900;
        color: rgba(255,255,255,0.03);
        line-height: 1;
        transition: color 0.4s ease;
    }

    .depth-card:hover .depth-number {
        color: #fff;
    }

    .depth-icon {
        font-size: 36px;
        color: #ff4916;
        margin-bottom: 24px;
        display: block;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .depth-card:hover .depth-icon {
        color: #fff;
        transform: scale(1.15);
    }

    .depth-card-title {
        
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 16px 0;
        line-height: 1.4;
    }

    .depth-card-desc {
        font-size: 15px;
        color: #fff;
        line-height: 1.7;
        margin: 0;
        font-weight: 300;
    }

    /* ========================================
       RESPONSIVE
       ======================================== */
    @media (max-width: 1100px) {
        .depth-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .depth-grid {
            grid-template-columns: 1fr;
        }
        .depth-title { font-size: 32px; }
    }
</style>

<section class="depth-features-section" id="depthFeatures">
    <!-- Animated Particle Background -->
    <div class="particle-bg"></div>
    
    <div class="depth-container">
        <div class="depth-header">
            <span class="services-badge" style="opacity: 1; transform: translateY(0px);"><span class="services-badge-icon"></span> The Advantage</span>
            <h2 class="depth-title">What Sets Our Freight GCC Apart?</h2>
        </div>

        <div class="depth-grid">
            
            <!-- Card 01 -->
            <div class="depth-card" style="transition-delay: 0ms;">
                <div class="depth-accent"></div>
                <span class="depth-number">01</span>
                <div class="depth-content">
                    <i class="fas fa-chart-pie depth-icon"></i>
                    <h3 class="depth-card-title">Significant Cost Savings</h3>
                    <p class="depth-card-desc">Reduce operating expenses while gaining a skilled logistics team trained for global freight workflows.</p>
                </div>
            </div>

            <!-- Card 02 -->
            <div class="depth-card" style="transition-delay: 100ms;">
                <div class="depth-accent"></div>
                <span class="depth-number">02</span>
                <div class="depth-content">
                    <i class="fas fa-clock depth-icon"></i>
                    <h3 class="depth-card-title">Time-Zone Aligned, 24/7 Availability</h3>
                    <p class="depth-card-desc">Your GCC operates exactly in your hours - ensuring real-time response and zero downtime.</p>
                </div>
            </div>

            <!-- Card 03 -->
            <div class="depth-card" style="transition-delay: 200ms;">
                <div class="depth-accent"></div>
                <span class="depth-number">03</span>
                <div class="depth-content">
                    <i class="fas fa-user-tie depth-icon"></i>
                    <h3 class="depth-card-title">Built by Logistics Professionals</h3>
                    <p class="depth-card-desc">Our team members have real experience in air, sea, and road operations, customs, billing, and coordination.</p>
                </div>
            </div>

            <!-- Card 04 -->
            <div class="depth-card" style="transition-delay: 300ms;">
                <div class="depth-accent"></div>
                <span class="depth-number">04</span>
                <div class="depth-content">
                    <i class="fas fa-clipboard-check depth-icon"></i>
                    <h3 class="depth-card-title">Process Discipline: SOP + TAT + QC</h3>
                    <p class="depth-card-desc">Every task follows a defined workflow - structured, timestamped, tracked, and quality-checked.</p>
                </div>
            </div>

            <!-- Card 05 -->
            <div class="depth-card" style="transition-delay: 400ms;">
                <div class="depth-accent"></div>
                <span class="depth-number">05</span>
                <div class="depth-content">
                    <i class="fas fa-arrow-trend-up depth-icon"></i>
                    <h3 class="depth-card-title">Rapid Scalability for Peak Loads</h3>
                    <p class="depth-card-desc">Whether it’s month-end billing, carrier backlog, or seasonal spikes - we expand support instantly.</p>
                </div>
            </div>

            <!-- Card 06 -->
            <div class="depth-card" style="transition-delay: 500ms;">
                <div class="depth-accent"></div>
                <span class="depth-number">06</span>
                <div class="depth-content">
                    <i class="fas fa-list-check depth-icon"></i>
                    <h3 class="depth-card-title">Transparent Communication & Reporting</h3>
                    <p class="depth-card-desc">Daily updates, task logs, exception reports, and dashboards give your team complete operational visibility.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Generate animated particles
        const particleContainer = document.querySelector('.particle-bg');
        for (let i = 0; i < 25; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.width = Math.random() * 4 + 2 + 'px';
            particle.style.height = particle.style.width;
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 25 + 's';
            particle.style.animationDuration = (20 + Math.random() * 15) + 's';
            particleContainer.appendChild(particle);
        }

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.depth-header, .depth-card').forEach(el => observer.observe(el));
    });
</script>


<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ========================================
       THEME & VARS
       ======================================== */
    

    :root {
        --brand-navy: #0C2D48;
        --brand-orange: #ff4916;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --grid-line: #e2e8f0;
        --bg-white: #ffffff;
        --circle-size: 80px;
    }


    /* ========================================
       SECTION LAYOUT
       ======================================== */
    .road-section {
        position: relative;
        height: 114vh !important;
        max-height: 114vh !important;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center; 
        overflow: hidden;
        background: #fff;
    }

    .road-bg-grid {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-image: 
            linear-gradient(var(--grid-line) 1px, transparent 1px),
            linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.8;
        z-index: 0;
    }

    .header-content {
        position: relative;
        z-index: 5;
        text-align: center;
        margin-bottom: 20px;
        flex-shrink: 0;
    }

    /* ========================================
       STAGE & ROAD SVG
       ======================================== */
    .infographic-stage {
        position: relative;
        width: 100%;
        max-width: 1100px;
        height: 500px; 
        max-height: 70vh; 
        margin-top: 10px;
        z-index: 2;
    }

    .road-svg {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        overflow: visible;
        pointer-events: none;
        z-index: 1;
    }

    /* Broad Road Styles */
    .road-base {
        fill: none;
        stroke: #0c2d48; /* Light concrete color */
        stroke-width: 40px; /* Broad width */
        stroke-linecap: round;
        /* Drop shadow for depth */
        filter: drop-shadow(0px 10px 10px rgba(0,0,0,0.05));
    }

    .road-dashed {
        fill: none;
        stroke: #cbd5e1; /* Lane markers */
        stroke-width: 4px;
        stroke-dasharray: 15, 20;
        stroke-linecap: round;
    }

    /* ========================================
       PRO CARD DESIGN (CENTER HUB)
       ======================================== */
       .center-info-hub {
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    width: 479px;
    text-align: center;
    z-index: 10;
    perspective: 1000px;
}

    .hub-content {
    position: relative;
    background: #ffffff;
    padding: 50px 40px;
    border-radius: 20px;
    border: 1px solid #000000;
    border-top: 7px solid var(--brand-orange);
    box-shadow: 9px 9px 2px 0px rgb(0 0 0 / 33%), 0 0 0 1px rgb(0 0 0) inset;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    opacity: 1;
    transform: translateY(0);
    overflow: hidden;
}
    
.hub-watermark {
    position: absolute;
    top: 0px;
    right: 14px;
    
    font-size: 68px;
    font-weight: 800;
    color: #0c2d48c4;
    line-height: 1;
    z-index: 0;
    pointer-events: none;
    transition: all 0.3s ease;
}

    .hub-inner { position: relative; z-index: 1; }
    
    .hub-content.fade-out {
        opacity: 0;
        transform: translateY(15px) scale(0.98);
    }

    .hub-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        color: var(--brand-orange);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 12px;
        background: rgba(255, 73, 22, 0.08);
        padding: 6px 14px;
        border-radius: 30px;
        border: 1px solid rgba(255, 73, 22, 0.15);
    }

    .hub-title {
        
        font-size: 28px;
        font-weight: 800;
        color: var(--brand-navy);
        margin: 0 0 12px 0;
        line-height: 1.1;
    }

    .hub-desc {
    font-size: 18px;
    line-height: 1.6;
    color: #000;
    margin-top: 20px;
    font-weight: 700;
    }

    /* ========================================
       NODES (Items)
       ======================================== */
    .node-item {
        position: absolute;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100px; 
        cursor: pointer;
        z-index: 5;
        visibility: hidden; 
    }

    .node-circle {
        width: var(--circle-size);
        height: var(--circle-size);
        background: #fff;
        border: 4px solid var(--brand-navy); /* Thicker border to match road */
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        color: var(--brand-navy);
        box-shadow: 0 10px 25px rgba(12, 45, 72, 0.15);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        z-index: 2;
    }

    .node-number {
        width: 30px;
        height: 30px;
        background-color: #fff;
        border: 2px solid var(--brand-navy);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        
        font-weight: 700;
        font-size: 13px;
        color: var(--brand-navy);
        margin-top: 12px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }
    
    /* Connector */
    .node-number::before {
        content: '';
        position: absolute;
        top: -16px; left: 50%; transform: translateX(-50%);
        width: 3px; height: 16px; background: var(--brand-navy);
    }

    /* Active / Hover States */
    .node-item:hover .node-circle,
    .node-item.active .node-circle {
        transform: scale(1.25);
        border-color: var(--brand-orange);
        background-color: var(--brand-navy);
        color: #fff;
        box-shadow: 0 15px 40px rgba(255, 73, 22, 0.3);
    }

    .node-item:hover .node-number,
    .node-item.active .node-number {
        background-color: var(--brand-orange);
        border-color: var(--brand-orange);
        color: #fff;
    }

    /* ========================================
       MOBILE RESPONSIVE
       ======================================== */
    .mobile-content { display: none; }

    @media (max-width: 900px) {
        .road-section { padding: 60px 20px; height: auto; min-height: auto; display: block; }
        .header-content { margin-bottom: 30px; }
        .infographic-stage { height: auto; max-width: 100%; max-height: none; margin-top: 0; }
        
        .road-svg, .center-info-hub { display: none; }

        .node-item {
            visibility: visible !important;
            position: relative !important;
            transform: none !important;
            left: auto !important;
            top: auto !important;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            flex-direction: row;
            align-items: flex-start;
            justify-content: flex-start;
            background: #fff;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .node-circle { width: 50px; height: 50px; font-size: 20px; margin-right: 15px; flex-shrink: 0; border-width: 2px; }
        .node-number { display: none; }
        .mobile-content { display: block; text-align: left; }
        .mobile-title {  font-size: 18px; font-weight: 700; color: var(--brand-navy); margin-bottom: 5px; }
        .mobile-desc { font-size: 14px; color: var(--text-muted); line-height: 1.5; }
    }
</style>

<!-- GSAP Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/MotionPathPlugin.min.js"></script>

<section class="road-section">
    <div class="header-content">
            <div class="framer-badge">
                <span class="framer-badge-dot"></span>
                Workflow
            </div>
            <h2 class="framer-title">Our Operational Model</h2>
        </div>

    <div class="infographic-stage" id="stageContainer">
        
        <!-- SVG Road -->
        <svg class="road-svg">
            <!-- Thick road base -->
            <path id="mainPath" class="road-base" d="" />
            <!-- Dashed markings -->
            <path id="dashedPath" class="road-dashed" d="" />
        </svg>

        <!-- Center Hub (PRO CARD) -->
        <div class="center-info-hub">
            <div class="hub-content" id="hubContent">
                <div class="hub-watermark" id="hubWatermark">00</div>
                <div class="hub-inner">
                    <span class="hub-badge" id="hubBadge">Overview</span>
                    <h3 class="hub-title" id="hubTitle">Process Timeline</h3>
                    <p class="hub-desc" id="hubDesc">Scroll or click a step to explore our operational workflow.</p>
                </div>
            </div>
        </div>

        <!-- NODES -->
        <div class="node-item" data-index="0" data-step="Step 1" data-title="Workflow Understanding" data-desc="We map your freight processes, SLAs, customer expectations, and tool stack.">
            <div class="node-circle"><i class="fas fa-magnifying-glass"></i></div>
            <div class="node-number">01</div>
            <div class="mobile-content">
                <div class="mobile-title">Workflow Understanding</div>
                <div class="mobile-desc">We map your freight processes, SLAs, and tool stack.</div>
            </div>
        </div>

        <div class="node-item" data-index="1" data-step="Step 2" data-title="SOP & Quality Framework" data-desc="We create detailed SOPs, checklists, and time-bound actions for seamless execution.">
            <div class="node-circle"><i class="fas fa-clipboard-check"></i></div>
            <div class="node-number">02</div>
            <div class="mobile-content">
                <div class="mobile-title">SOP & Quality Framework</div>
                <div class="mobile-desc">Detailed SOPs and checklists for seamless execution.</div>
            </div>
        </div>

        <div class="node-item" data-index="2" data-step="Step 3" data-title="Pilot Team Setup" data-desc="A trained pilot team runs your tasks live to ensure accuracy and alignment.">
            <div class="node-circle"><i class="fas fa-users-gear"></i></div>
            <div class="node-number">03</div>
            <div class="mobile-content">
                <div class="mobile-title">Pilot Team Setup</div>
                <div class="mobile-desc">Trained pilot team runs tasks live to ensure accuracy.</div>
            </div>
        </div>

        <div class="node-item" data-index="3" data-step="Step 4" data-title="Dedicated GCC Deployment" data-desc="Your assigned operations team takes over daily documentation, updates, and billing.">
            <div class="node-circle"><i class="fas fa-rocket"></i></div>
            <div class="node-number">04</div>
            <div class="mobile-content">
                <div class="mobile-title">Dedicated GCC Deployment</div>
                <div class="mobile-desc">Assigned ops team takes over daily documentation and updates.</div>
            </div>
        </div>

        <div class="node-item" data-index="4" data-step="Step 5" data-title="Reporting & Optimization" data-desc="You receive daily/weekly reports, QC reviews, and ongoing workflow improvements.">
            <div class="node-circle"><i class="fas fa-chart-line"></i></div>
            <div class="node-number">05</div>
            <div class="mobile-content">
                <div class="mobile-title">Reporting & Optimization</div>
                <div class="mobile-desc">Daily/weekly reports, QC reviews, and continuous improvement.</div>
            </div>
        </div>

    </div>
</section>

<script>
    gsap.registerPlugin(ScrollTrigger, MotionPathPlugin);

    const defaultState = {
        badge: 'Overview',
        title: 'Process Timeline',
        desc: 'Scroll or click a step to explore our operational workflow.',
        num: '00'
    };

    function updateHubContent(index, nodes) {
        const hubContent = document.getElementById('hubContent');
        const hubBadge = document.getElementById('hubBadge');
        const hubTitle = document.getElementById('hubTitle');
        const hubDesc = document.getElementById('hubDesc');
        const hubWatermark = document.getElementById('hubWatermark');

        nodes.forEach(n => n.classList.remove('active'));

        if (index === -1) {
            hubBadge.innerText = defaultState.badge;
            hubTitle.innerText = defaultState.title;
            hubDesc.innerText = defaultState.desc;
            hubWatermark.innerText = defaultState.num;
        } else {
            const activeNode = nodes[index];
            activeNode.classList.add('active');
            
            hubBadge.innerText = activeNode.getAttribute('data-step');
            hubTitle.innerText = activeNode.getAttribute('data-title');
            hubDesc.innerText = activeNode.getAttribute('data-desc');
            
            const num = index + 1;
            hubWatermark.innerText = num < 10 ? `0${num}` : num;
        }
        
        gsap.fromTo(hubContent, {opacity: 0.5, y: 5}, {opacity: 1, y: 0, duration: 0.3});
    }

    ScrollTrigger.matchMedia({

        "(min-width: 901px)": function() {
            const container = document.getElementById('stageContainer');
            const mainPath = document.getElementById('mainPath');
            const dashedPath = document.getElementById('dashedPath');
            const nodes = document.querySelectorAll('.node-item');

            const width = container.offsetWidth;
            const height = container.offsetHeight;
            const centerX = width / 2;
            const centerY = height; 
            
            // Padding to ensure nodes are fully visible on edges
            const radius = Math.min(width / 2, height) - 80;

            const startX = centerX - radius;
            const startY = centerY;
            const endX = centerX + radius;
            const endY = centerY;

            // ARCH Path (180deg to 0deg)
            const pathD = `M ${startX} ${startY} A ${radius} ${radius} 0 0 1 ${endX} ${endY}`;
            mainPath.setAttribute('d', pathD);
            dashedPath.setAttribute('d', pathD);

            const step = 1 / (nodes.length - 1);
            nodes.forEach((node, index) => {
                const progress = step * index;
                gsap.set(node, {
                    motionPath: {
                        path: "#mainPath",
                        align: "#mainPath",
                        alignOrigin: [0.5, 0.5],
                        start: progress, end: progress
                    },
                    yPercent: -35, // Shift up slightly so circle sits on the thick road
                    autoAlpha: 0,
                    scale: 0
                });
            });

            // SCROLL TIMELINE
            const totalScrollDistance = 2000; 
            const tl = gsap.timeline({
                scrollTrigger: {
                    id: "roadScroll",
                    trigger: ".road-section",
                    start: "center center", // Centered Pin
                    end: `+=${totalScrollDistance}`,
                    pin: true,
                    scrub: 1,
                    anticipatePin: 1
                }
            });

            const len = mainPath.getTotalLength();
            tl.fromTo([mainPath, dashedPath], 
                { strokeDasharray: len, strokeDashoffset: len },
                { strokeDashoffset: 0, duration: 5, ease: "none" }
            );

            nodes.forEach((node, i) => {
                // Synchronize node pop with road drawing
                const insertTime = (i / (nodes.length - 1)) * 4; 
                tl.to(node, {
                    autoAlpha: 1,
                    scale: 1,
                    duration: 1,
                    ease: "back.out(1.7)",
                    onStart: () => updateHubContent(i, nodes),
                    onReverseComplete: () => updateHubContent(i - 1, nodes)
                }, insertTime);
            });

            // CLICK INTERACTION
            nodes.forEach((node, index) => {
                node.addEventListener('click', () => {
                    const st = ScrollTrigger.getById("roadScroll");
                    if(st) {
                        const targetProgress = (index / 4.5); 
                        const scrollPos = st.start + (st.end - st.start) * targetProgress;

                        window.scrollTo({
                            top: scrollPos,
                            behavior: "smooth"
                        });
                    }
                });
            });

        },

        "(max-width: 900px)": function() {
            const nodes = document.querySelectorAll('.node-item');
            gsap.set(nodes, { clearProps: "all" });
        }
    });
</script>
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
  
    :root {
      --brand-navy: #0C2D48;
      --brand-navy-dark: #051524;
      --brand-accent: #ff4916;
      --text-white: #ffffff;
      --text-light: #cbd5e1;
    }
  
    /* =============================
       SECTION LAYOUT
    ==============================*/
    .results-section-dark {
      position: relative;
      background: radial-gradient(circle at top right, #133b5c 0%, var(--brand-navy) 40%, var(--brand-navy-dark) 100%);
      padding: 80px 5% 60px;
      
      overflow: hidden;
    }
  
    /* Grid overlay */
    .results-dark-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
      background-size: 50px 50px;
      opacity: .8;
      z-index: 0;
      pointer-events: none;
    }
  
    /* Orbs */
    .results-orb-dark {
      position: absolute;
      border-radius: 50%;
      filter: blur(90px);
      opacity: .25;
      z-index: 0;
      pointer-events: none;
    }
    .results-orb-dark-1 {
      width: 420px; height: 420px;
      background: var(--brand-accent);
      top: -18%; right: -12%;
    }
    .results-orb-dark-2 {
      width: 360px; height: 360px;
      background: #38bdf8;
      bottom: -16%; left: -10%;
      opacity: .18;
    }
  
    .results-container-dark {
      position: relative;
      z-index: 2;
      max-width: 1240px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr);
      gap: 60px;
      align-items: stretch; /* make image and content same height */
    }
  
    /* =============================
       LEFT – IMAGE
    ==============================*/
    .results-media-col {
      display: flex;
      align-items: stretch;
    }
  
    .results-media-card {
      position: relative;
      width: 100%;
      border-radius: 26px;
      overflow: hidden;
      border: 1px solid rgba(148,163,184,0.6);
      box-shadow: 0 28px 60px rgba(0,0,0,0.7);
      background: radial-gradient(circle at top, rgba(148,163,184,0.35), rgba(15,23,42,0.95));
    }
  
    .results-media-img {
      width: 100%;
      height: 100%;
      min-height: 360px;
      max-height: 730px;
      object-fit: cover;
      filter: saturate(1.05) contrast(1.05);
      transform: scale(1.05);
      transition: transform .9s ease;
    }
  
    .results-media-card:hover .results-media-img {
      transform: scale(1.12);
    }
  
    .results-media-tag {
      position: absolute;
      top: 16px;
      left: 16px;
      padding: 6px 14px;
      border-radius: 999px;
      background: rgba(15,23,42,0.88);
      border: 1px solid rgba(148,163,184,0.7);
      font-size: 13px;
      color: var(--text-light);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .results-media-tag i {
      color: var(--brand-accent);
      font-size: 14px;
    }
  
    .results-media-badge {
      position: absolute;
      bottom: 18px;
      right: 18px;
      padding: 12px 18px;
      border-radius: 18px;
      background: rgba(15,23,42,0.92);
      border: 1px solid rgba(148,163,184,0.8);
      color: var(--text-white);
      font-size: 13px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .results-media-badge span:first-child {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--text-light);
    }
    .results-media-badge span:last-child {
      
      font-size: 18px;
      font-weight: 700;
      color: var(--brand-accent);
    }
  
    /* =============================
       RIGHT – CONTENT & CARDS
    ==============================*/
    .results-content-col {
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }
  
    .results-kicker-dark {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 2.2px;
      text-transform: uppercase;
      color: var(--brand-accent);
      margin-bottom: 18px;
    }
    .results-kicker-dark::before {
      content: "";
      width: 34px;
      height: 2px;
      background: linear-gradient(90deg, var(--brand-accent), transparent);
      border-radius: 2px;
    }
  
    .results-title-dark {
      
      font-size: 46px;
      font-weight: 800;
      color: var(--text-white);
      margin: 0 0 18px;
      letter-spacing: -0.03em;
    }
  
    .results-subtext-dark {
      font-size: 17px;
      color: var(--text-light);
      line-height: 1.8;
      margin: 0 0 32px;
      max-width: 560px;
    }
  
    /* Top stats row */
    .results-stat-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 26px;
    }
  
    .results-stat-card {
      flex: 1 1 190px;
      min-width: 0;
      padding: 18px 20px;
      border-radius: 18px;
      border: 1px solid rgba(148,163,184,0.45);
      background: radial-gradient(circle at top left, rgba(148,163,184,0.3), rgba(7,14,32,0.95));
      box-shadow: 0 18px 40px rgba(0,0,0,0.7);
      display: flex;
      align-items: center;
      gap: 14px;
      opacity: 0;
      transform: translateY(24px);
      transition: opacity .5s ease, transform .5s ease;
    }
    .results-stat-card.visible {
      opacity: 1;
      transform: translateY(0);
    }
  
    .results-stat-icon {
      width: 38px;
      height: 38px;
      border-radius: 13px;
      background: rgba(15,23,42,0.9);
      border: 1px solid rgba(148,163,184,0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--brand-accent);
      font-size: 18px;
    }
  
    .results-stat-main {
      
      font-size: 28px;
      font-weight: 800;
      color: var(--text-white);
      line-height: 1.1;
      margin-bottom: 10px;
    }
    .results-stat-main span {
      font-size: 18px;
      opacity: .8;
    }
  
    .results-stat-label {
      font-size: 13px;
      color: var(--text-light);
      line-height: 1.6;
      letter-spacing: 1px;
    }
  
    /* Feature cards grid (remaining 4 points) */
    .results-feature-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 18px 20px;
    }
  
    .result-feature {
      position: relative;
      border-radius: 16px;
      border: 1px solid rgba(148,163,184,0.35);
      background: rgba(7,14,32,0.95);
      padding: 18px 18px 18px 50px;
      box-shadow: 0 14px 35px rgba(0,0,0,0.6);
      display: flex;
      flex-direction: column;
      gap: 6px;
      opacity: 0;
      transform: translateY(28px);
      transition: opacity .5s ease, transform .5s ease, border-color .25s ease;
    }
    .result-feature.visible {
      opacity: 1;
      transform: translateY(0);
    }
  
    .feature-icon-circle {
      position: absolute;
      left: 14px;
      top: 16px;
      width: 26px;
      height: 26px;
      border-radius: 999px;
      background: radial-gradient(circle at 30% 20%, #fff, #fed7aa);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--brand-accent);
      font-size: 14px;
      box-shadow: 0 0 0 1px rgba(248,250,252,0.6), 0 10px 20px rgba(0,0,0,.45);
    }
  
    .feature-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-white);
      margin: 0;
    }
  
    .feature-text {
      font-size: 15px;
      color: var(--text-light);
      margin: 0;
      line-height: 1.7;
    }
  
    .result-feature:hover {
      border-color: var(--brand-accent);
    }
  
    /* =============================
       RESPONSIVE
    ==============================*/
    @media (max-width: 1100px) {
      .results-container-dark {
        grid-template-columns: minmax(0, 1fr);
        gap: 40px;
      }
    }
  
    @media (max-width: 720px) {
      .results-title-dark { font-size: 36px; }
      .results-subtext-dark { font-size: 15px; }
      .results-stat-row {
        flex-direction: column;
      }
      .results-feature-grid {
        grid-template-columns: 1fr;
      }
      .results-media-img {
        min-height: 280px;
        max-height: 360px;
      }
    }
  </style>
  
  <section class="results-section-dark">
    <div class="results-dark-grid"></div>
    <div class="results-orb-dark results-orb-dark-1"></div>
    <div class="results-orb-dark results-orb-dark-2"></div>
  
    <div class="results-container-dark">
      <!-- LEFT: Image Column -->
      <div class="results-media-col">
        <div class="results-media-card">
          <img
            src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=1000&q=80"
            alt="Global operations team collaborating"
            class="results-media-img"
          />
          <div class="results-media-tag">
            <i class="fas fa-network-wired"></i>
            GCC Operations Hub
          </div>
          <div class="results-media-badge">
            <span>Quietly behind your brand</span>
            <span>Always‑On Execution</span>
          </div>
        </div>
      </div>
  
      <!-- RIGHT: Content & Result Cards -->
      <div class="results-content-col">
        <span class="services-badge" style="opacity: 1; transform: translateY(0px);"><span class="services-badge-icon"></span> The Outcomes</span>
        <h2 class="results-title-dark">The Results We Deliver</h2>
        <p class="results-subtext-dark">
          Your teams stay focused on customers and exceptions, while our GCC takes over the heavy operational lift across documentation, updates, billing, and coordination.
        </p>
  
        <!-- Top Stats -->
        <div class="results-stat-row">
          <div class="results-stat-card">
            <div class="results-stat-icon"><i class="fas fa-sack-dollar"></i></div>
            <div>
              <div class="results-stat-main">60<span>%</span></div>
              <div class="results-stat-label">Reduction in backend operational costs</div>
            </div>
          </div>
  
          <div class="results-stat-card">
            <div class="results-stat-icon"><i class="fas fa-bullseye"></i></div>
            <div>
              <div class="results-stat-main">99<span>%</span></div>
              <div class="results-stat-label">Accuracy achieved via SOP‑driven workflows</div>
            </div>
          </div>
        </div>
  
        <!-- Feature Grid -->
        <div class="results-feature-grid">
          <div class="result-feature">
            <div class="feature-icon-circle"><i class="fas fa-headset"></i></div>
            <h3 class="feature-title">24/7 support aligned to your business hours</h3>
            <p class="feature-text">
              Follow‑the‑sun operations mapped exactly to your origin, hub, and destination time zones.
            </p>
          </div>
  
          <div class="result-feature">
            <div class="feature-icon-circle"><i class="fas fa-file-invoice-dollar"></i></div>
            <h3 class="feature-title">Faster billing cycles & clean documentation</h3>
            <p class="feature-text">
              Accurate milestones, PODs, and documentation ensure invoices move without disputes or holds.
            </p>
          </div>
  
          <div class="result-feature">
            <div class="feature-icon-circle"><i class="fas fa-user-slash"></i></div>
            <h3 class="feature-title">Zero hiring, training, or people management</h3>
            <p class="feature-text">
              We handle recruitment, onboarding, training, and performance so your leaders don’t have to.
            </p>
          </div>
  
          <div class="result-feature">
            <div class="feature-icon-circle"><i class="fas fa-rocket"></i></div>
            <h3 class="feature-title">Instant scalability with no downtime</h3>
            <p class="feature-text">
              Add capacity for peak seasons, carrier backlogs, or new trade lanes in weeks—not months.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <script>
    // Fade/slide-in animations using IntersectionObserver
    document.addEventListener('DOMContentLoaded', () => {
      const statCards = document.querySelectorAll('.results-stat-card');
      const featureCards = document.querySelectorAll('.result-feature');
  
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const target = entry.target;
            const all = [...statCards, ...featureCards];
            const index = all.indexOf(target);
            setTimeout(() => target.classList.add('visible'), index * 140);
            observer.unobserve(target);
          }
        });
      }, { threshold: 0.2 });
  
      statCards.forEach(card => observer.observe(card));
      featureCards.forEach(card => observer.observe(card));
    });
  </script>
  <style>
    
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
  
    :root {
      --brand-navy: #0C2D48;
      --brand-navy-dark: #051524;
      --brand-accent: #ff4916;
      --text-main: #1e293b;
      --text-muted: #64748b;
      --bg-white: #ffffff;
      --grid-line: #e2e8f0;
    }
  
    /* =============================
       SECTION LAYOUT
    ==============================*/
    .work-section-white {
      position: relative;
      padding: 90px 5% 0;
      
      overflow: hidden;
    }
  
    .work-container {
      position: relative;
      z-index: 2;
      max-width: 1240px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.95fr);
      gap: 60px;
      align-items: center;
    }
  
    /* =============================
       LEFT – CONTENT & ICON CARDS
    ==============================*/
    .work-left {
      display: flex;
      flex-direction: column;
      gap: 26px;
    }
  
    .work-kicker {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--brand-accent);
    }
    .work-kicker::before {
      content: "";
      width: 34px;
      height: 2px;
      background: linear-gradient(90deg, var(--brand-accent), transparent);
      border-radius: 2px;
    }
  
    .work-title {
      
      font-size: 40px;
      font-weight: 800;
      color: var(--brand-navy);
      margin: 0;
      letter-spacing: -0.03em;
    }
  
    .work-intro {
    font-size: 18px;
    line-height: 1.6;
    color: #475569;
    margin-bottom: 20px;
}
  
    .work-subheading {
      font-size: 15px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: var(--text-main);
      margin: 4px 0 6px;
    }
  
    .work-values-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 16px;
      margin-top: 6px;
    }
  
    .work-value-card {
      position: relative;
      border-radius: 16px;
      border: 1px solid rgba(148,163,184,0.55);
      background: rgba(248,250,252,0.9);
      padding: 16px 14px 14px 46px;
      box-shadow: 0 12px 30px rgba(15,23,42,0.06);
      min-height: 80px;
      display: flex;
      align-items: center;
      font-size: 14px;
      color: var(--text-main);
  
      opacity: 0;
      transform: translateY(22px);
      transition: opacity .5s ease, transform .5s ease, box-shadow .25s ease, border-color .25s ease, background .25s ease;
    }
    .work-value-card.visible {
      opacity: 1;
      transform: translateY(0);
    }
  
    .work-icon-circle {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 26px;
      height: 26px;
      border-radius: 999px;
      background: radial-gradient(circle at 30% 20%, #ffffff, #fee2c5);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--brand-accent);
      font-size: 14px;
      box-shadow: 0 0 0 1px rgba(15,23,42,0.06), 0 8px 20px rgba(15,23,42,0.25);
    }
  
    .work-value-label {
      font-weight: 600;
    }
  
    .work-value-card:hover {
      border-color: var(--brand-accent);
      background: #ffffff;
      box-shadow: 0 18px 40px rgba(15,23,42,0.12);
    }
  
    .work-footer-note {
      font-size: 16px;
      color: var(--text-main);
      line-height: 1.7;
      margin-top: 10px;
      max-width: 560px;
    }
    .work-footer-note span {
      font-weight: 600;
      color: var(--brand-navy);
    }
  
    /* =============================
       RIGHT – IMAGE PANEL
    ==============================*/
    .work-right {
      display: flex;
      align-items: stretch;
      justify-content: flex-end;
    }
  
    .work-image-card {
      position: relative;
      width: 100%;
      border-radius: 26px;
      overflow: hidden;
      border: 1px solid rgba(148,163,184,0.8);
      box-shadow: 0 30px 70px rgba(15,23,42,0.25);
      background: radial-gradient(circle at top, rgba(148,163,184,0.25), #ffffff);
    }
  
    .work-main-img {
      width: 100%;
      height: 100%;
      min-height: 320px;
      max-height: 420px;
      object-fit: cover;
      transform: scale(1.04);
      filter: saturate(1.05) contrast(1.05);
      transition: transform .9s ease;
    }
  
    .work-image-card:hover .work-main-img {
      transform: scale(1.1);
    }
  
    .work-image-label {
      position: absolute;
      top: 16px;
      left: 16px;
      padding: 6px 14px;
      border-radius: 999px;
      background: rgba(15,23,42,0.9);
      color: #e5e7eb;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      border: 1px solid rgba(148,163,184,0.7);
    }
    .work-image-label i {
      color: var(--brand-accent);
    }
  
    .work-image-note {
      position: absolute;
      bottom: 18px;
      left: 18px;
      padding: 12px 18px;
      border-radius: 18px;
      background: rgba(255,255,255,0.96);
      border: 1px solid rgba(148,163,184,0.75);
      font-size: 13px;
      color: var(--text-main);
      max-width: 260px;
      box-shadow: 0 12px 30px rgba(15,23,42,0.18);
    }
    .work-image-note strong {
      display: block;
      
      font-size: 15px;
      margin-bottom: 3px;
      color: var(--brand-navy);
    }
  
    /* =============================
       RESPONSIVE
    ==============================*/
    @media (max-width: 1100px) {
      .work-container {
        grid-template-columns: minmax(0,1fr);
        gap: 40px;
      }
      .work-right {
        justify-content: flex-start;
      }
    }
  
    @media (max-width: 768px) {
      .work-section-white {
        padding: 70px 5%;
      }
      .work-title {
        font-size: 32px;
      }
      .work-values-grid {
        grid-template-columns: repeat(2, minmax(0,1fr));
      }
      .work-main-img {
        min-height: 260px;
        max-height: 340px;
      }
    }
  
    @media (max-width: 560px) {
      .work-values-grid {
        grid-template-columns: 1fr;
      }
      .work-value-card {
        padding-left: 52px;
      }
    }
  </style>
  
  <section class="work-section-white">
  
    <div class="work-container">
      <!-- LEFT: Content -->
      <div class="work-left">
        <div class="work-kicker">How We Work</div>
        <h2 class="work-title">How We Work Behind the Scenes?</h2>
        <p class="work-intro">
          Our culture is built on the rhythm of logistics — responsive, disciplined, detail‑driven, and relentlessly customer‑focused.
        </p>
  
        <p class="work-subheading">We believe in</p>
  
        <div class="work-values-grid">
          <div class="work-value-card">
            <div class="work-icon-circle"><i class="fas fa-comments"></i></div>
            <span class="work-value-label">Clear communication</span>
          </div>
  
          <div class="work-value-card">
            <div class="work-icon-circle"><i class="fas fa-wave-square"></i></div>
            <span class="work-value-label">Operational consistency</span>
          </div>
  
          <div class="work-value-card">
            <div class="work-icon-circle"><i class="fas fa-clipboard-check"></i></div>
            <span class="work-value-label">Process accountability</span>
          </div>
  
          <div class="work-value-card">
            <div class="work-icon-circle"><i class="fas fa-clock"></i></div>
            <span class="work-value-label">Respect for timelines</span>
          </div>
  
          <div class="work-value-card">
            <div class="work-icon-circle"><i class="fas fa-arrows-rotate"></i></div>
            <span class="work-value-label">Continuous improvement</span>
          </div>
  
          <div class="work-value-card">
            <div class="work-icon-circle"><i class="fas fa-user-check"></i></div>
            <span class="work-value-label">Ownership of every task</span>
          </div>
        </div>
  
        <p class="work-footer-note">
          <span>We don’t behave like an outsourced vendor.</span><br>
          We operate like your in‑house freight team — we just happen to sit on another floor.
        </p>
      </div>
  
      <!-- RIGHT: Image -->
      <div class="work-right">
        <div class="work-image-card">
          <img
            src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=1000&q=80"
            alt="Operations team collaborating behind the scenes"
            class="work-main-img"
          />
          <div class="work-image-label">
            <i class="fas fa-network-wired"></i>
            Behind-the-scenes operations
          </div>
          <div class="work-image-note">
            <strong>Feels like your team, not a vendor.</strong>
            Tasks are handled with the same care, urgency, and accountability as if we were sitting inside your HQ.
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <script>
    // Fade-in for the belief cards
    document.addEventListener('DOMContentLoaded', () => {
      const cards = document.querySelectorAll('.work-value-card');
  
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const el = entry.target;
            const index = [...cards].indexOf(el);
            setTimeout(() => el.classList.add('visible'), index * 120);
            observer.unobserve(el);
          }
        });
      }, { threshold: 0.2 });
  
      cards.forEach(card => observer.observe(card));
    });
  </script>
<?php get_footer(); ?>