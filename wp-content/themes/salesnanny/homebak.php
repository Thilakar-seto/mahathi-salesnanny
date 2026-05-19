<?php
/**
 * Template Name: Homebak
 */
get_header();
?> 
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css">

    <style>
    /* 1. External Resources */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    /* 2. CSS Variables (The Design System) */
    :root {
        /* Palette: Deep Space Logistics */
        --cv-bg-dark: #020617;
        --cv-primary: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%);   /* Tech Blue */
        --cv-accent: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%);    /* Cyan AI Glow */
        --cv-surface: rgba(15, 23, 42, 0.6);
        --cv-glass-border: rgba(255, 255, 255, 0.1);
        --cv-text-main: #ffffff;
        --cv-text-muted: #94a3b8;
        
        /* Spacing & Layout */
        --cv-container: 1280px;
        --cv-radius: 16px;
        --cv-ease: cubic-bezier(0.25, 0.1, 0.25, 1.0);
    }

    /* 3. Base Reset */
    .cv-hero-section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-color: var(--cv-bg-dark);
        color: var(--cv-text-main);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 24px;
        box-sizing: border-box;
    }

    .cv-hero-section * { box-sizing: border-box; }

    /* 4. Background Layers */
    
    /* Image Layer */
    .cv-bg-layer {
        position: absolute;
        inset: 0;
        /* High-quality Warehouse Fallback */
        background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2600&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        z-index: 0;
        /* Slight zoom effect */
        animation: cv-zoom-drift 30s infinite alternate ease-in-out;
    }

    /* Gradient Overlay (Readability) */
    .cv-overlay-layer {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg,rgba(2, 6, 23, 1) 0%, rgba(2, 6, 23, 0.85) 50%, rgba(2, 6, 23, 0) 100%);
        z-index: 1;
    }

    /* Technical Grid Pattern */
    /*
    
    

    /* 5. Main Content Container */
    .cv-container {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: var(--cv-container);
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 60px;
        align-items: center;
    }

    /* 6. Typography Column (Left) */
    .cv-content-col {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    /* Animated Badge */
    .cv-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        background: rgba(6, 182, 212, 0.1);
        border: 1px solid rgba(6, 182, 212, 0.3);
        border-radius: 100px;
        color: var(--cv-accent);
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        opacity: 0;
        animation: cv-slide-up 0.8s var(--cv-ease) forwards;
        margin-bottom: 20px;
    }
    
    .cv-pulse-dot {
        width: 8px;
        height: 8px;
        background: var(--cv-accent);
        border-radius: 50%;
        box-shadow: 0 0 10px var(--cv-accent);
        animation: cv-pulse 2s infinite;
    }

    /* Hero Heading */
    .cv-h1 {
        font-size: 3.75rem;
        line-height: 1.1;
        font-weight: 700;
        margin-bottom: 24px;
        opacity: 0;
        animation: cv-slide-up 0.8s var(--cv-ease) forwards 0.1s;
    }

    /* Gradient Text Highlight */
    .cv-text-gradient {
        background: linear-gradient(135deg, #ffffff 30%, lightgreen 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700; /* its 800 before  */
    }

    /* Description Paragraph */
    .cv-p {
        font-size: 1.125rem;
        line-height: 1.6;
        color: #fff;
        margin-bottom: 40px;
        max-width: 650px;
        opacity: 0;
        animation: cv-slide-up 0.8s var(--cv-ease) forwards 0.2s;
    }

    /* 7. Buttons */
    .cv-btn-group {
        display: flex;
        gap: 16px;
        opacity: 0;
        animation: cv-slide-up 0.8s var(--cv-ease) forwards 0.3s;
    }

    .cv-btn {
        position: relative;
        padding: 16px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s var(--cv-ease);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Primary Button (Fill) */
    .cv-btn-primary {
        background: var(--cv-primary);
        color: white;
        border: 1px solid var(--cv-primary);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
    }
    .cv-btn-primary:hover {
        /* background: #2563eb; */
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    }

    /* Secondary Button (Glass) */
    .cv-btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(4px);
    }
    .cv-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
        transform: translateY(-2px);
    }

    /* 8. Floating UI (Right Column) */
    /* Instead of just an image, we create a CSS "WMS Interface" */
    .cv-ui-col {
        position: relative;
        display: flex;
        justify-content: center;
        perspective: 1000px;
    }

    .cv-interface-card {
        width: 100%;
        max-width: 460px;
        background: linear-gradient(160deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.9));
        border: 1px solid var(--cv-glass-border);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(20px);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
        opacity: 0;
        transform: rotateY(-10deg) rotateX(5deg) translateY(30px);
        animation: cv-float-in 1s var(--cv-ease) forwards 0.5s;
    }

    /* UI Header */
    .cv-ui-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding-bottom: 16px;
    }
    .cv-ui-title { font-size: 0.9rem; font-weight: 600; color: white; display: flex; align-items: center; gap: 8px; }
    .cv-ui-status { font-size: 0.75rem; color: var(--cv-accent); font-weight: 500; background: rgba(6, 182, 212, 0.1); padding: 4px 8px; border-radius: 4px; }

    /* UI Metric Grid */
    .cv-ui-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .cv-metric {
        background: rgba(255,255,255,0.03);
        padding: 16px;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.05);
    }
    .cv-metric label { font-size: 0.75rem; color: var(--cv-text-muted); display: block; margin-bottom: 4px; }
    .cv-metric div { font-size: 1.25rem; font-weight: 700; color: white; }

    /* Floating Badge on Card */
    .cv-ui-float-badge {
        position: absolute;
        top: -15px;
        right: -15px;
        background: var(--cv-primary);
        color: white;
        padding: 12px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
        font-size: 1.25rem;
        animation: cv-bounce 3s infinite ease-in-out;
    }

    /* 9. Bottom Ticker (Trust Signal) */
    .cv-ticker {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        border-top: 1px solid rgba(255,255,255,0.05);
        background: rgba(2, 6, 23, 0.8);
        padding: 16px 40px;
        display: flex;
        gap: 40px;
        backdrop-filter: blur(10px);
        z-index: 10;
        overflow: hidden;
    }
    .cv-ticker-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--cv-text-muted);
        font-size: 0.85rem;
        font-weight: 500;
        white-space: nowrap;
    }
    .cv-ticker-item i { color: var(--cv-primary); }

    /* 10. Animations */
    @keyframes cv-slide-up {
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes cv-float-in {
        to { opacity: 1; transform: rotateY(-10deg) rotateX(5deg) translateY(0); }
    }
    @keyframes cv-zoom-drift {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }
    @keyframes cv-pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
    @keyframes cv-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* 11. Responsive Design */
    @media (max-width: 1024px) {
        .cv-h1 { font-size: 3rem; }
        .cv-container { grid-template-columns: 1fr; }
        .cv-ui-col { display: none; } /* Hide complex UI on tablet for cleaner look */
        .cv-bg-layer { opacity: 0.4; } /* Dim background more */
    }

    @media (max-width: 768px) {
        .cv-hero-section { padding: 40px 20px; text-align: left; }
        .cv-h1 { font-size: 2.5rem; }
        .cv-btn-group { flex-direction: column; width: 100%; }
        .cv-btn { width: 100%; justify-content: center; }
        .cv-ticker { display: none; } /* Hide footer on mobile */
    }
</style>

<section class="cv-hero-section">
    <!-- Backgrounds -->
    <div class="cv-bg-layer"></div>
    <div class="cv-overlay-layer"></div>
    <div class="cv-grid-layer"></div>

    <div class="cv-container">
        
        <!-- Left Content -->
        <div class="cv-content-col">
            <div class="cv-badge">
                <div class="cv-pulse-dot"></div> AI + WMS Integration Online
            </div>

            <h1 class="cv-h1">
                The New Standard for <br>
                <span class="cv-text-gradient">High-Performance</span> <br>
                Logistics Operations
            </h1>

            <p class="cv-p">
                Cargoa is an AI-driven warehouse management ERP designed to eliminate bottlenecks. Gain live control over receiving, GRN, putaway, picking, and dispatch—so every task moves with clarity and zero guesswork.
            </p>

            <div class="cv-btn-group">
                <a href="#" class="cv-btn cv-btn-primary">
                    See Cargoa In Action <i class="fa-solid fa-bolt"></i>
                </a>
                <a href="#" class="cv-btn cv-btn-secondary">
                    Talk to Our Experts
                </a>
            </div>
        </div>

        <!-- Right Content: Floating Dashboard Mockup -->
        <div class="cv-ui-col">
            <div class="cv-interface-card">
                <div class="cv-ui-float-badge">
                    <i class="fa-solid fa-robot"></i>
                </div>
                
                <div class="cv-ui-header">
                    <div class="cv-ui-title"><i class="fa-solid fa-layer-group"></i> Warehouse A - Live View</div>
                    <div class="cv-ui-status">● Real-time</div>
                </div>

                <div class="cv-ui-grid">
                    <div class="cv-metric">
                        <label>Dispatch Velocity</label>
                        <div>1,240 <span style="font-size:0.8rem; color:#22c55e;">▲ 12%</span></div>
                    </div>
                    <div class="cv-metric">
                        <label>Picking Accuracy</label>
                        <div>99.8%</div>
                    </div>
                    <div class="cv-metric">
                        <label>Active Robots</label>
                        <div>24/24 Online</div>
                    </div>
                    <div class="cv-metric">
                        <label>Pending Orders</label>
                        <div>84</div>
                    </div>
                </div>
                
                <!-- Simulated Graph Line -->
                <div style="margin-top:20px; height: 4px; width: 100%; background: #334155; border-radius: 2px; overflow:hidden;">
                    <div style="height:100%; width: 65%; background: var(--cv-accent);"></div>
                </div>
                <div style="margin-top:8px; display:flex; justify-content:space-between; color:var(--cv-text-muted); font-size:0.75rem;">
                    <span>System Load</span>
                    <span>65% Optimal</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Ticker -->
    <div class="cv-ticker">
        <div class="cv-ticker-item"><i class="fa-solid fa-check-circle"></i> 99.99% Uptime</div>
        <div class="cv-ticker-item"><i class="fa-solid fa-shield-halved"></i> SOC2 Type II Certified</div>
        <div class="cv-ticker-item"><i class="fa-solid fa-plug"></i> 50+ ERP Integrations</div>
        <div class="cv-ticker-item"><i class="fa-solid fa-globe"></i> 24/7 Global Support</div>
    </div>
</section>
<style>
    /* --- 1. Imports --- */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    /* --- 2. Animations (Matching Your Script) --- */
    .anim-fade-up,
    .anim-fade-down,
    .anim-fade-left,
    .anim-fade-right,
    .anim-scale {
        opacity: 0;
        transition: transform 0.8s cubic-bezier(0.22, 1, 0.36, 1),
                    opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: transform, opacity;
    }
    
    /* Initial Positions */
    .anim-fade-up { transform: translateY(50px); }
    .anim-fade-down { transform: translateY(-50px); }
    .anim-fade-left { transform: translateX(50px); }
    .anim-fade-right { transform: translateX(-50px); }
    .anim-scale { transform: scale(0.9); }

    /* Active State */
    .animate-in {
        opacity: 1 !important;
        transform: translate(0, 0) scale(1) !important;
    }

    /* Internal Dashboard Animations */
    .bar-fill { width: 0%; transition: width 1.5s ease-out; }
    .animate-in .bar-fill { width: 85%; } /* Triggers progress bar */
    
    .map-dot { transform: scale(0); transition: transform 0.5s ease-out; }
    .animate-in .map-dot:nth-child(1) { transition-delay: 0.2s; transform: scale(1); }
    .animate-in .map-dot:nth-child(2) { transition-delay: 0.3s; transform: scale(1); }
    .animate-in .map-dot:nth-child(3) { transition-delay: 0.4s; transform: scale(1); }

    /* --- 3. Base Styles --- */
    .vis-section {
        /*font-family: 'Inter', sans-serif;*/
        background-color: #f8fafc;
        color: #1e293b;
        padding: 120px 20px;
        overflow: hidden;
    }

    .vis-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    /* --- 4. Header --- */
    .vis-header {
        text-align: center;
        max-width: 900px;
        margin: 0 auto 100px auto;
    }

    .vis-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #e0e7ff;
        color: #4338ca;
        padding: 8px 20px;
        border-radius: 100px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
        margin-bottom: 30px;
    }

    .vis-pill-dot {
        width: 8px;
        height: 8px;
        background: #4338ca;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    .vis-headline {
        font-size: 64px;
        font-weight: 900;
        line-height: 1.05;
        letter-spacing: -2px;
        color: #0f172a;
        margin-bottom: 24px;
    }

    .vis-headline span {
        color: #2563eb;
        position: relative;
        white-space: nowrap;
    }

    .vis-subhead {
        font-size: 24px;
        color: #64748b;
        line-height: 1.5;
        max-width: 750px;
        margin: 0 auto;
    }

    /* --- 5. The Comparison Layout --- */
    .vis-comparison {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0; /* Connected look */
        border: #cbd5e1 1px solid;
    border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 40px 100px -20px rgba(0,0,0,0.1);
        margin-bottom: 80px;
    }

    /* --- LEFT SIDE: THE PROBLEM --- */
    .vis-panel-chaos {
        background: #f1f5f9;
        padding: 80px 60px;
        position: relative;
        border-right: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Chaos Visual Element (CSS Illustration) */
    .vis-illustration {
        background: white;
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 40px;
        position: relative;
        height: 220px;
    }

    .chaos-path {
        position: absolute;
        top: 50%; left: 20px; right: 20px;
        height: 4px;
        background: repeating-linear-gradient(90deg, #cbd5e1 0, #cbd5e1 10px, transparent 10px, transparent 20px);
        transform: translateY(-50%);
    }

    .chaos-icon {
        position: absolute;
        top: 35%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 40px;
        color: #ef4444;
        background: #fef2f2;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(239, 68, 68, 0.1);
        z-index: 2;
    }

    .chaos-alert {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: #fee2e2;
        color: #991b1b;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Content */
    .vis-panel-title-bad {
        font-size: 32px;
        font-weight: 700; /* its 800 before  */
        color: #334155;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .vis-panel-title-bad i { color: #ef4444; }

    .vis-list-bad { list-style: none; padding: 0; margin: 0; }
    .vis-list-bad li {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        color: #64748b;
        line-height: 1.6;
        font-size: 18px;
        align-items: flex-start;
    }
    .vis-list-bad i {
        color: #ef4444;
        margin-top: 5px;
        font-size: 16px;
    }

    /* --- RIGHT SIDE: THE SOLUTION --- */
    .vis-panel-control {
        background: #003854;
        padding: 80px 60px;
        position: relative;
        color: white;
        overflow: hidden;
    }

    /* Background Glow */
    .vis-panel-control::before {
        content: '';
        position: absolute;
        top: -50%; right: -50%;
        width: 100%; height: 100%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.3) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Dashboard UI (CSS Illustration) */
    .vis-dashboard-ui {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 40px;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        position: relative;
        z-index: 2;
        height: 220px;
    }

    /* UI Header */
    .ui-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 24px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 16px;
    }
    .ui-badge {
        background: lightgreen;
        color: #000;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* UI Grid/Map */
    .ui-grid {
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .ui-map-visual {
        flex: 1;
        height: 80px;
        background-image: radial-gradient(rgba(255,255,255,0.2) 1px, transparent 1px);
        background-size: 10px 10px;
        border-radius: 12px;
        position: relative;
    }
    .map-dot {
        width: 12px; height: 12px;
        background: lightgreen;
        border-radius: 50%;
        position: absolute;
        box-shadow: 0 0 10px lightgreen;
    }

    /* UI Progress Bar */
    .ui-progress-container {
        margin-top: 20px;
    }
    .ui-label-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 6px;
    }
    .ui-bar-bg {
        height: 6px;
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    .bar-fill {
        height: 100%;
        background: lightgreen;
        border-radius: 10px;
    }

    /* Content */
    .vis-panel-title-good {
        font-size: 32px;
        font-weight: 700; /* its 800 before  */
        color: white;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        z-index: 2;
    }
    .vis-panel-title-good i { color: lightgreen; }

    .vis-list-good { list-style: none; padding: 0; margin: 0; position: relative; z-index: 2;}
    .vis-list-good li {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        color: #cbd5e1;
        font-size: 18px;
        align-items: center;
        line-height: 1.6;
    }
    .vis-list-good i {
        color: lightgreen;
        font-size: 18px;
        background: rgba(59, 130, 246, 0.1);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* --- 6. CTA Area --- */
    .cta-wrapper {
        text-align: center;
    }

    .primary-btn {
        background: #2563eb;
        color: white;
        font-size: 20px;
        font-weight: 700;
        padding: 24px 60px;
        border-radius: 16px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.5);
        transition: transform 0.2s, background 0.2s;
    }
    .primary-btn:hover { transform: translateY(-3px); background: #1d4ed8; }

    .testimonial {
        margin-top: 40px;
        color: #475569;
        font-size: 18px;
    }
    .author-sig {
        font-weight: 700; /* its 800 before  */
        color: #0f172a;
        margin-top: 10px;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    @keyframes pulse {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(0.95); opacity: 0.8; }
    }

    /* --- Responsive --- */
    @media (max-width: 1024px) {
        .vis-comparison {
            grid-template-columns: 1fr;
            border-radius: 24px;
        }
        .vis-panel-chaos { border-right: none; border-bottom: 1px solid #e2e8f0; padding: 60px 30px; }
        .vis-panel-control { padding: 60px 30px; }
        .vis-headline { font-size: 42px; }
    }
</style>

<section class="vis-section">
    <div class="vis-container">
        
        <!-- Header -->

        <div class="efficiency-header" bis_skin_checked="1">
                    <span class="efficiency-badge">
                        <svg class="efficiency-badge-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                        Real-Time Warehouse Visibility
                    </span>
                    <h2 class="efficiency-title">Your warehouse isn't slow. <span class="efficiency-title-highlight">Your visibility is.</span></h2>
                    <p class="efficiency-description">
                    CargoVa brings the "micro-movements" defining daily performance into the light. Stop guessing, start knowing.
                    </p>
                </div>

        <!-- The Comparison Visual -->
        <div class="vis-comparison anim-scale">
            
            <!-- LEFT: The Problem (Visualizing Confusion) -->
            <div class="vis-panel-chaos">
                <div class="vis-illustration">
                    <!-- CSS Art: Broken Timeline -->
                    <div class="chaos-path"></div>
                    <div class="chaos-icon">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="chaos-alert">
                        <i class="fa-solid fa-circle-exclamation"></i> Delay Detected?
                    </div>
                </div>

                <h3 class="vis-panel-title-bad">
                    <i class="fa-solid fa-eye-slash"></i>
                    Without CargoVa
                </h3>
                <ul class="vis-list-bad">
                    <li>
                        <i class="fa-solid fa-xmark"></i>
                        <span><strong>Operational Blind Spots:</strong> Jobs finish, but time taken remains unknown.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-xmark"></i>
                        <span><strong>Reactive Mode:</strong> Plans rely on assumptions, leading to constant rework.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-xmark"></i>
                        <span><strong>Hidden Costs:</strong> Labor looks busy, but productivity can't be proven.</span>
                    </li>
                </ul>
            </div>

            <!-- RIGHT: The Solution (Visualizing Dashboard/Software) -->
            <div class="vis-panel-control">
                
                <!-- CSS Art: Dashboard UI Mockup -->
                <div class="vis-dashboard-ui">
                    <div class="ui-header">
                        <div style="font-size:12px; font-weight:700; color:#cbd5e1;">Live Shipment Tracking</div>
                        <div class="ui-badge">Active</div>
                    </div>
                    
                    <div class="ui-grid">
                        <div class="ui-map-visual">
                            <div class="map-dot" style="top:20%; left:30%;"></div>
                            <div class="map-dot" style="top:60%; left:50%;"></div>
                            <div class="map-dot" style="top:30%; left:80%;"></div>
                        </div>
                        <div style="flex:1;">
                             <div class="ui-progress-container">
                                <div class="ui-label-row">
                                    <span>Dispatch Readiness</span>
                                    <span style="color:lightgreen; font-weight:700;">85%</span>
                                </div>
                                <div class="ui-bar-bg">
                                    <div class="bar-fill"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="vis-panel-title-good">
                    <i class="fa-solid fa-bolt"></i>
                    With CargoVa
                </h3>
                <ul class="vis-list-good">
                    <li>
                        <i class="fa-solid fa-check"></i>
                        <span><strong>Live Clarity:</strong> See exactly where inventory sits and how it moves.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        <span><strong>Predictive Planning:</strong> Build accurate plans in 2 hours based on real data.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        <span><strong>Connected Costs:</strong> Connect every dollar spent to specific activities.</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- CTA -->
        <div class="cta-wrapper anim-fade-up">
            <button class="primary-btn">
                Create Your AI Logistics Plan
                <i class="fa-solid fa-arrow-right"></i>
            </button>
            <div class="testimonial">
                <i class="fa-solid fa-star" style="color:#fbbf24;"></i>
                <i class="fa-solid fa-star" style="color:#fbbf24;"></i>
                <i class="fa-solid fa-star" style="color:#fbbf24;"></i>
                <i class="fa-solid fa-star" style="color:#fbbf24;"></i>
                <i class="fa-solid fa-star" style="color:#fbbf24;"></i>
                <br>
                "Quality level better than manual planning."
                <div class="author-sig">— Mark, Operations Manager</div>
            </div>
        </div>

    </div>
</section>

<script>
    // Intersection Observer for scroll-triggered animations
    document.addEventListener('DOMContentLoaded', () => {
        
        // Configuration for the observer
        const observerConfig = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        };

        // Create observer
        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Add animate-in class
                    entry.target.classList.add('animate-in');
                    
                    // Handle nested animations
                    const nestedElements = entry.target.querySelectorAll(
                        '.bar, .badge-ai, .chaos-block, .alert-icon, .vs-circle, .line, ' +
                        '.solution-list li, .problem-list li, .handwritten-note, .primary-btn, .testimonial'
                    );
                    
                    nestedElements.forEach(el => {
                        el.classList.add('animate-in');
                    });

                    // Unobserve after animation is triggered
                    animationObserver.unobserve(entry.target);
                }
            });
        }, observerConfig);

        // Elements to observe
        const animatedElements = document.querySelectorAll(
            '.anim-fade-up, .anim-fade-down, .anim-fade-left, .anim-fade-right, ' +
            '.anim-scale, .anim-scale-bounce, .anim-rotate-in, .cards-container, .cta-area'
        );

        animatedElements.forEach(el => {
            animationObserver.observe(el);
        });

        // Special observer for the CTA area with different threshold
        const ctaObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const ctaElements = entry.target.querySelectorAll(
                        '.primary-btn, .testimonial, .handwritten-note'
                    );
                    ctaElements.forEach(el => {
                        el.classList.add('animate-in');
                    });
                    ctaObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        const ctaArea = document.querySelector('.cta-area');
        if (ctaArea) {
            ctaObserver.observe(ctaArea);
        }
    });
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

        /* =========================================
           Core Modules Section (CM)
           ========================================= */
        .cm-section {
            position: relative;
            background: #003854; 
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            color: #ffffff;
            padding: 6rem 1.5rem;
            box-sizing: border-box;
            overflow: visible;
        }

        .cm-section * { box-sizing: border-box; }

        .cm-container {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Header */
        .cm-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .cm-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: lightgreen;
    background: rgba(56, 189, 248, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 99px;
    border: 1px solid rgba(56, 189, 248, 0.2);
    margin-bottom: 1.5rem;
}

        .cm-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin: 0;
            color: #fff;
        }

        @media (min-width: 768px) {
            .cm-title { font-size: 3.5rem; }
        }

        /* Grid Layout */
        .cm-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        @media (min-width: 1024px) {
            .cm-grid {
                grid-template-columns: 300px 1fr;
                gap: 4rem;
                align-items: flex-start;
            }
        }

        /* Sidebar Navigation */
        .cm-sidebar {
            display: none;
        }

        @media (min-width: 1024px) {
            .cm-sidebar {
                display: block;
                position: sticky;
                top: 30vh;
                align-self: start;
            }
        }

        .cm-nav {
            display: flex;
            flex-direction: column;
            position: relative;
            border-left: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cm-nav-indicator {
            position: absolute;
            left: -1.5px;
            width: 3px;
            background: #38bdf8;
            box-shadow: 0 0 10px #38bdf8;
            transition: top 0.3s ease, height 0.3s ease, background 0.3s ease;
            border-radius: 2px;
            z-index: 10;
        }

        .cm-nav-item {
            padding: 1.25rem 0 1.25rem 1.5rem;
            cursor: pointer;
            opacity: 0.4;
            transition: opacity 0.3s ease;
        }

        .cm-nav-item:hover { opacity: 0.7; }
        .cm-nav-item.active { opacity: 1; }

        .cm-nav-title {
    display: block;
    font-size: 1.2rem;
    font-weight: 700; /* its 800 before  */
    color: #fff;
    margin-bottom: 1rem;
}

.cm-nav-desc {
    display: block;
    font-size: 0.9rem;
    color: #fff;
}

        /* Cards Wrapper - Natural Stacking */
        .cm-cards-wrapper {
            position: relative;
        }

        /* Card Styles - CSS Sticky Stacking */
        .cm-card {
  background-color: #fff; /* fallback + base color */

  background-image: url('https://cdn.prod.website-files.com/621ec104fe396061affb8664/62410ae472ff2f36821d2da5_Timeline%2001.png');
  background-repeat: no-repeat;
  background-size: contain;
  background-position: right center;

  border: 1px solid rgba(255, 255, 255, 0.15);
  box-shadow: 0 6px 25px rgba(0, 0, 0, 0.35);
  border-radius: 20px;

  padding: 2.5rem 25% 2.5rem 2.5rem;
  position: sticky;
  top: 15vh;

  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
  will-change: transform;
}


        /* Stacking offsets - cards stack with slight vertical offset */
        .cm-card:nth-child(1) { top: 15vh; z-index: 1; margin-bottom: 3rem; }
        .cm-card:nth-child(2) { top: 17vh; z-index: 2; margin-bottom: 3rem; }
        .cm-card:nth-child(3) { top: 19vh; z-index: 3; margin-bottom: 0; }

        .cm-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 50px -15px rgba(0, 0, 0, 0.6);
            border-color: rgba(255, 255, 255, 0.15);
        }

        /* Card Content */
        .cm-card-header {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .cm-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
    color: #401b9e;
    background: rgba(56, 189, 248, 0.1);
    border: 1px solid rgba(56, 189, 248, 1);
}

        /* Theme Colors */
        .cm-theme-1 { --accent: #06b6d4; }
        .cm-theme-2 { --accent: lightgreen; }
        .cm-theme-3 { --accent: #84cc16; }

       

        .cm-card-title {
    font-size: 1.4rem;
    font-weight: 700; /* its 800 before  */
    color: #000;
    margin: 0;
}

        .cm-card-body {
            font-size: 1rem;
            line-height: 1.65;
            color: #000;
            margin-bottom: 2rem;
        }

        /* Tags */
        .cm-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .cm-tag {
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.4rem 0.9rem;
            border-radius: 99px;
            background: #003854;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            transition: all 0.2s ease;
        }

        .cm-theme-1 .cm-tag:hover { color: #06b6d4; border-color: #06b6d4; }
        .cm-theme-2 .cm-tag:hover { color: lightgreen; border-color: lightgreen; }
        .cm-theme-3 .cm-tag:hover { color: #84cc16; border-color: #84cc16; }

        /* Glow */
        .cm-glow-bg {
            position: absolute;
            top: -30%;
            right: -30%;
            width: 60%;
            height: 60%;
            background: radial-gradient(circle, var(--accent) 0%, transparent 70%);
            opacity: 0.1;
            filter: blur(50px);
            pointer-events: none;
        }

        /* Mobile */
        @media (max-width: 1023px) {
            .cm-card, .cm-card:nth-child(n) {
                position: relative !important;
                top: auto !important;
                margin-bottom: 1.5rem !important;
                z-index: 1 !important;
            }
        }
    </style>

    <section class="cm-section" id="core-modules">
        <div class="services-noise"></div>
        <div class="services-bg-glow services-bg-glow-1"></div>
        <div class="services-bg-glow services-bg-glow-2"></div>
        <div class="services-bg-glow services-bg-glow-3"></div>
        <div class="services-grid-pattern"></div>
        <div class="services-gradient-line services-gradient-line-1"></div>
        <div class="services-gradient-line services-gradient-line-2"></div>
        
        <!-- Floating Particles -->
        <div class="services-particles">
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
        </div>
        <div class="cm-container">
            
            <div class="cm-header">
                <div class="cm-badge"><i class="fa-solid fa-cube"></i> CORE MODULES</div>
                <h2 class="cm-title">The Engine Behind<br> Every <span class="cargoa-title-highlight">Delivery</span></h2>
            </div>

            <div class="cm-grid">
                
                <!-- Sidebar -->
                <div class="cm-sidebar">
                    <div class="cm-nav">
                        <div class="cm-nav-indicator" id="cm-indicator"></div>
                        
                        <div class="cm-nav-item active" data-index="0">
                            <span class="cm-nav-title">01. Warehouse Management</span>
                            <span class="cm-nav-desc">AI-guided inventory control</span>
                        </div>
                        <div class="cm-nav-item" data-index="1">
                            <span class="cm-nav-title">02. Transport Control</span>
                            <span class="cm-nav-desc">Live dispatch & fleet tracking</span>
                        </div>
                        <div class="cm-nav-item" data-index="2">
                            <span class="cm-nav-title">03. Intelligence & Forecast</span>
                            <span class="cm-nav-desc">Predictive resource planning</span>
                        </div>
                    </div>
                </div>

                <!-- Cards -->
                <div class="cm-cards-wrapper">
                    
                    <div class="cm-card cm-theme-1" data-card="0">
                        <div class="cm-glow-bg"></div>
                        <div class="cm-card-header">
                            <div class="cm-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                            <h3 class="cm-card-title">Warehouse Management (WMS)</h3>
                        </div>
                        <p class="cm-card-body">
                            Orchestrate every movement within your four walls. Our AI-driven WMS optimizes putaway logic, reduces picker travel time by 30%, and ensures 99.9% inventory accuracy without paper trails.
                        </p>
                        <div class="cm-tags">
                            <span class="cm-tag">AI Slotting</span>
                            <span class="cm-tag">Wave Picking</span>
                            <span class="cm-tag">Cross-Docking</span>
                            <span class="cm-tag">Real-time Inventory</span>
                        </div>
                    </div>

                    <div class="cm-card cm-theme-2" data-card="1">
                        <div class="cm-glow-bg"></div>
                        <div class="cm-card-header">
                            <div class="cm-icon"><i class="fa-solid fa-truck-fast"></i></div>
                            <h3 class="cm-card-title">Transport Control (TMS)</h3>
                        </div>
                        <p class="cm-card-body">
                            Bridge the gap between warehouse and road. Sync dispatch readiness with transporter ETAs to eliminate detention charges. Auto-allocate loads based on cost, performance, and route density.
                        </p>
                        <div class="cm-tags">
                            <span class="cm-tag">Live Fleet Tracking</span>
                            <span class="cm-tag">Auto-Dispatch</span>
                            <span class="cm-tag">Route Optimization</span>
                            <span class="cm-tag">Proof of Delivery</span>
                        </div>
                    </div>

                    <div class="cm-card cm-theme-3" data-card="2">
                        <div class="cm-glow-bg"></div>
                        <div class="cm-card-header">
                            <div class="cm-icon"><i class="fa-solid fa-chart-line"></i></div>
                            <h3 class="cm-card-title">Operational Intelligence</h3>
                        </div>
                        <p class="cm-card-body">
                            Stop reacting and start predicting. Analyze SKU velocity to forecast labour needs weeks in advance. Identify potential bottlenecks in your supply chain before they impact customer SLAs.
                        </p>
                        <div class="cm-tags">
                            <span class="cm-tag">Demand Forecasting</span>
                            <span class="cm-tag">Labour Planning</span>
                            <span class="cm-tag">Space Utilization</span>
                            <span class="cm-tag">Cost Analytics</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                gsap.registerPlugin(ScrollTrigger);

                const cards = gsap.utils.toArray('.cm-card');
                const navItems = document.querySelectorAll('.cm-nav-item');
                const indicator = document.getElementById('cm-indicator');
                const navContainer = document.querySelector('.cm-nav');
                const colors = ['lightgreen', 'lightgreen', 'lightgreen'];

                // Update indicator position & color
                function updateIndicator(index) {
                    const activeItem = navItems[index];
                    if (!activeItem || !indicator || !navContainer) return;
                    
                    const itemRect = activeItem.getBoundingClientRect();
                    const containerRect = navContainer.getBoundingClientRect();
                    
                    indicator.style.top = `${itemRect.top - containerRect.top}px`;
                    indicator.style.height = `${itemRect.height}px`;
                    indicator.style.backgroundColor = colors[index];
                    indicator.style.boxShadow = `0 0 10px ${colors[index]}`;
                    
                    navItems.forEach((item, i) => {
                        item.classList.toggle('active', i === index);
                    });
                }

                // Initial setup
                updateIndicator(0);

                // GSAP ScrollTrigger for each card - simple entrance animation
                cards.forEach((card, i) => {
                    // Animate cards on enter (subtle scale + opacity)
                    gsap.fromTo(card, 
                        { 
                            opacity: 0.3, 
                            scale: 0.97,
                            y: 30
                        },
                        {
                            opacity: 1,
                            scale: 1,
                            y: 0,
                            duration: 0.5,
                            ease: "power2.out",
                            scrollTrigger: {
                                trigger: card,
                                start: "top 80%",
                                end: "top 40%",
                                toggleActions: "play none none reverse"
                            }
                        }
                    );

                    // Update nav when card enters center of viewport
                    ScrollTrigger.create({
                        trigger: card,
                        start: "top 50%",
                        end: "bottom 50%",
                        onEnter: () => updateIndicator(i),
                        onEnterBack: () => updateIndicator(i)
                    });
                });

                // Nav item click to scroll
                navItems.forEach((item, i) => {
                    item.addEventListener('click', () => {
                        const targetCard = cards[i];
                        if (targetCard) {
                            const y = targetCard.getBoundingClientRect().top + window.pageYOffset - window.innerHeight * 0.2;
                            window.scrollTo({ top: y, behavior: 'smooth' });
                        }
                    });
                });
            });
        </script>
    </section>
    <style>
        /* ========================================
           External Resources
        ======================================== */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        /* ========================================
           Section Layout
        ======================================== */
        .efficiency-section {
            /* font-family: 'Plus Jakarta Sans', sans-serif; */
            background-color: #F2F4F7;
            -webkit-font-smoothing: antialiased;
            padding: 5rem 2rem;
            overflow: hidden;
        }
        
        .efficiency-container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        
        /* ========================================
           Header Section
        ======================================== */

        
        /* ========================================
           Grid Layout
        ======================================== */
        .efficiency-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        /* ========================================
           Card Styles
        ======================================== */
        .efficiency-card {
            background: #FFFFFF;
            border-radius: 20px;
            padding: 2.5rem;
            position: relative;
            isolation: isolate;
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            cursor: default;
            opacity: 0;
            transform: translateY(40px);
        }
        
        .efficiency-card.animate-in {
            animation: cardFadeIn 0.7s ease forwards;
        }
        
        .efficiency-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 2;
        }
        
        .efficiency-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(67, 56, 202, 0.04) 0%, rgba(124, 58, 237, 0.04) 100%);
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
        }
        
        .efficiency-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 
                0 25px 50px -5px rgba(124, 58, 237, 0.2),
                0 15px 25px -5px rgba(67, 56, 202, 0.15);
            border-color: rgba(124, 58, 237, 0.15);
        }
        
        .efficiency-card:hover::before {
            transform: scaleX(1);
        }
        
        .efficiency-card:hover::after {
            opacity: 1;
        }
        
        /* ========================================
           Icon Box Styles
        ======================================== */
        .efficiency-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: linear-gradient(145deg, #F1F5F9, #E2E8F0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            z-index: 2;
        }
        
        .efficiency-icon-box::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #4338ca 0%, #7c3aed 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .efficiency-icon {
            width: 26px;
            height: 26px;
            stroke: #475569;
            stroke-width: 2;
            fill: none;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }
        
        .efficiency-card:hover .efficiency-icon-box {
            transform: scale(1.15) rotate(8deg);
            box-shadow: 0 12px 20px -3px rgba(124, 58, 237, 0.35);
        }
        
        .efficiency-card:hover .efficiency-icon-box::before {
            opacity: 1;
        }
        
        .efficiency-card:hover .efficiency-icon {
            stroke: #ffffff;
            transform: scale(1.1);
        }
        
        /* ========================================
           Card Typography
        ======================================== */
        .efficiency-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.4;
            letter-spacing: -0.015em;
            position: relative;
            z-index: 2;
            transition: color 0.3s ease;
        }
        
        .efficiency-card:hover .efficiency-card-title {
            color: #4338ca;
        }
        
        .efficiency-card-text {
            font-size: 0.95rem;
            color: #475569;
            line-height: 1.7;
            font-weight: 500;
            position: relative;
            z-index: 2;
        }
        
        /* ========================================
           Animations
        ======================================== */
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
        
        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.3);
            }
            50% {
                box-shadow: 0 0 20px 5px rgba(124, 58, 237, 0.15);
            }
        }
        
        .efficiency-badge {
            animation: fadeInUp 0.8s ease forwards, pulseGlow 3s ease-in-out infinite 1s;
        }
        
        /* ========================================
           Responsive Styles
        ======================================== */
        @media (max-width: 1024px) {
            .efficiency-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .efficiency-title {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 650px) {
            .efficiency-section {
                padding: 3rem 1.25rem;
            }
            
            .efficiency-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .efficiency-title {
                font-size: 1.875rem;
            }
            
            .efficiency-card {
                padding: 2rem;
            }
            
            .efficiency-description {
                font-size: 1rem;
            }
        }
        </style>
        
        <section class="efficiency-section">
            <div class="efficiency-container">
                
                <!-- Header Section -->
                <div class="efficiency-header">
                    <span class="efficiency-badge">
                        <svg class="efficiency-badge-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                        Intelligent Logistics
                    </span>
                    <h2 class="efficiency-title">Built to Improve <span class="efficiency-title-highlight">Speed</span>, <span class="efficiency-title-highlight">Accuracy</span>, and <span class="efficiency-title-highlight">Operational Control</span></h2>
                    <p class="efficiency-description">
                        Transform your warehouse with AI-driven precision. From inbound logistics to final dispatch, our platform ensures every movement is optimized for maximum efficiency and zero waste.
                    </p>
                </div>
        
                <!-- Grid Layout -->
                <div class="efficiency-grid">
                    
                    <!-- Card 1 -->
                    <div class="efficiency-card" data-delay="0">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 19 22 12 13 5 13 19"></polygon>
                                <polygon points="2 19 11 12 2 5 2 19"></polygon>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">30–50% Faster Inbound-to-Dispatch Cycle</h3>
                        <p class="efficiency-card-text">Reduced waiting time and smoother transitions across every stage ensuring streamlined velocity.</p>
                    </div>
        
                    <!-- Card 2 -->
                    <div class="efficiency-card" data-delay="1">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">Real-Time Inventory Accuracy Above 99%</h3>
                        <p class="efficiency-card-text">AI-driven checks eliminate mismatches and manual errors, creating a single source of truth.</p>
                    </div>
        
                    <!-- Card 3 -->
                    <div class="efficiency-card" data-delay="2">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">25–35% Better Labour Utilization</h3>
                        <p class="efficiency-card-text">Accurate planning prevents overstaffing, understaffing, and misuse, maximizing human potential.</p>
                    </div>
        
                    <!-- Card 4 -->
                    <div class="efficiency-card" data-delay="3">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">Up to 30% Higher Space Utilization</h3>
                        <p class="efficiency-card-text">Layout intelligence and congestion detection unlock hidden capacity within your existing infrastructure.</p>
                    </div>
        
                    <!-- Card 5 -->
                    <div class="efficiency-card" data-delay="4">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">40% Improvement in Picking & Putaway</h3>
                        <p class="efficiency-card-text">AI-directed paths shorten walking time and reduce task repetition for peak operational cadence.</p>
                    </div>
        
                    <!-- Card 6 -->
                    <div class="efficiency-card" data-delay="5">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">Predictable Transport Readiness</h3>
                        <p class="efficiency-card-text">Warehouse progress and transport ETAs stay connected, ensuring synchronized on-time dispatch.</p>
                    </div>
        
                    <!-- Card 7 -->
                    <div class="efficiency-card" data-delay="6">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">Visibility Uptime of 100% Across All SKUs</h3>
                        <p class="efficiency-card-text">Every item is traceable—view real-time location, status, and movement history instantly.</p>
                    </div>
        
                    <!-- Card 8 -->
                    <div class="efficiency-card" data-delay="7">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                                <polyline points="17 18 23 18 23 12"></polyline>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">Reduction in Revenue Leakage & Waste</h3>
                        <p class="efficiency-card-text">Time loss, labour misuse, and unbilled activities are identified and eliminated seamlessly.</p>
                    </div>
        
                    <!-- Card 9 -->
                    <div class="efficiency-card" data-delay="8">
                        <div class="efficiency-icon-box">
                            <svg class="efficiency-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                <rect x="9" y="9" width="6" height="6"></rect>
                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                <line x1="1" y1="14" x2="4" y2="14"></line>
                            </svg>
                        </div>
                        <h3 class="efficiency-card-title">Faster Decision Making With AI</h3>
                        <p class="efficiency-card-text">Supervisors spend less time firefighting and more time improving operations via smart recommendations.</p>
                    </div>
        
                </div>
            </div>
        </section>
        
        <script>
        (function() {
            // Intersection Observer for scroll-triggered animations
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -80px 0px',
                threshold: 0.15
            };
        
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const card = entry.target;
                        const delay = parseInt(card.dataset.delay) || 0;
                        
                        setTimeout(() => {
                            card.classList.add('animate-in');
                        }, delay * 100);
                        
                        cardObserver.unobserve(card);
                    }
                });
            }, observerOptions);
        
            // Observe all cards
            document.querySelectorAll('.efficiency-card').forEach(card => {
                cardObserver.observe(card);
            });
        
            // Add parallax effect on mouse move
            const section = document.querySelector('.efficiency-section');
            const cards = document.querySelectorAll('.efficiency-card');
        
            section.addEventListener('mousemove', (e) => {
                const { clientX, clientY } = e;
                const { left, top, width, height } = section.getBoundingClientRect();
                
                const x = (clientX - left - width / 2) / width;
                const y = (clientY - top - height / 2) / height;
        
                cards.forEach((card, index) => {
                    const factor = (index % 3 + 1) * 0.5;
                    const rotateX = y * factor * 2;
                    const rotateY = -x * factor * 2;
                    
                    if (!card.matches(':hover')) {
                        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                    }
                });
            });
        
            section.addEventListener('mouseleave', () => {
                cards.forEach(card => {
                    if (!card.matches(':hover')) {
                        card.style.transform = '';
                    }
                });
            });
        })();
        </script>
    <style>
        /* ============================================
           IMPORTS - Fonts
        ============================================ */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        /* ============================================
           SECTION CONTAINER
        ============================================ */
        .cargoa-section {
    position: relative;
    background: #003854;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    color: #ffffff;
    padding: 6rem 1.5rem;
    box-sizing: border-box;
    overflow: visible;
}
        
        .cargoa-container {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .cargoa-bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
                linear-gradient(rgba(0,0,0,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.02) 1px, transparent 1px);
            background-size: 100% 100%, 60px 60px, 60px 60px;
            z-index: 0;
            pointer-events: none;
        }
        
        /* ============================================
           HEADER STYLES - Matching Efficiency Section
        ============================================ */
        .cargoa-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4rem auto;
            position: relative;
            z-index: 1;
        }
        
        .cargoa-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: rgba(245, 158, 11, 0.1);
            color: #b45309;
            font-weight: 700;
            font-size: 0.875rem;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(245, 158, 11, 0.2);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards, pulseGlowAmber 3s ease-in-out infinite 1s;
        }
        
        .cargoa-badge-icon {
            width: 18px;
            height: 18px;
            stroke: #b45309;
            stroke-width: 2;
            fill: none;
        }
        
        .cargoa-badge-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse 2s infinite;
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
        }
        
        .cargoa-title {
            font-size: 3rem;
            font-weight: 700; /* its 800 before  */
            line-height: 1.15;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
            color: #0F172A;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease 0.15s forwards;
        }
        
        .cargoa-title-highlight {
            background: lightgreen;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }
        
        .cargoa-title-highlight::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(144, 238, 144, 0.4);
            border-radius: 4px;
            z-index: -1;
        }
        
        .cargoa-description {
            font-size: 1.125rem;
            line-height: 1.7;
            color: #fff;
            max-width: 650px;
            margin: 2rem auto;
            font-weight: 500;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease 0.3s forwards;
        }
        
        .cargoa-description-highlight {
            color: lightgreen;
            font-weight: 600;
        }
        
        .cargoa-features {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease 0.45s forwards;
        }
        
        .cargoa-feature {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #fff;
            font-weight: 500;
        }
        
        .cargoa-feature-check {
            color: #22c55e;
            font-weight: bold;
        }
        
        .cargoa-stats {
            display: flex;
            justify-content: center;
            gap: 4rem;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease 0.6s forwards;
        }
        
        .cargoa-stat {
            text-align: center;
        }
        
        .cargoa-stat-value {
            font-size: 2.5rem;
            font-weight: 700; /* its 800 before  */
            background: lightgreen;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }
        
        .cargoa-stat-label {
            font-size: 0.8rem;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 0.25rem;
            font-weight: 600;
        }
        
        /* ============================================
           INTEGRATION ENGINE LAYOUT
        ============================================ */
        .cargoa-engine {
            position: relative;
            height: 650px;
            display: flex;
            justify-content: end;
            align-items: center;
            margin: -170px auto -50px;
            z-index: 1;
        }
        
        .cargoa-engine-section {
            z-index: 2;
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }
        
        .cargoa-engine-inputs {
            width: 30%;
        }
        
        .cargoa-engine-core {
            width: 20%;
            justify-content: center;
        }
        
        .cargoa-engine-outputs {
            width: 40%;
            justify-content: flex-end;
        }
        
        /* ============================================
           SVG FLOW LINES
        ============================================ */
        .cargoa-flow-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: visible;
        }
        
        .cargoa-track-base {
    fill: none;
    stroke: #fff;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-dasharray: 6 8; /* dash length + gap length */
}
        
        .cargoa-track-base-thick {
            fill: none;
            stroke: rgba(0, 0, 0, 1);
            stroke-width: 24;
            stroke-linecap: round;
        }
        
        .cargoa-track-flow {
            fill: none;
            stroke: url(#cargoaFlowGradient);
            stroke-width: 3;
            stroke-linecap: round;
            stroke-dasharray: 60 800;
            stroke-dashoffset: 860;
            animation: flowLine 12s infinite ease-in-out;
            filter: url(#cargoaGlow);
        }
        
        .cargoa-track-flow-thick {
            fill: none;
            stroke: url(#cargoaFlowGradientSoft);
            stroke-width: 16;
            stroke-linecap: round;
            stroke-dasharray: 40 900;
            stroke-dashoffset: 940;
            animation: flowLine 12s infinite ease-in-out;
            filter: url(#cargoaGlowSoft);
            opacity: 0.4;
        }
        
        .cargoa-particle {
            fill: #f59e0b;
            filter: url(#cargoaGlow);
        }
        
        /* ============================================
           INPUT CLUSTER
        ============================================ */
        .cargoa-input-cluster {
            position: relative;
            width: 100%;
            height: 100%;
        }
        
        .cargoa-input-item {
            position: absolute;
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 10px 16px;
            border-radius: 14px;
            display: flex;
            gap: 10px;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06), 0 0 40px rgba(245, 158, 11, 0.03);
            transition: all 0.4s ease;
            cursor: pointer;
            opacity: 0;
            white-space: nowrap;
        }
        
        .cargoa-input-item:hover {
            border-color: rgba(245, 158, 11, 0.3);
            transform: scale(1.05) !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1), 0 0 40px rgba(245, 158, 11, 0.15);
        }
        
        .cargoa-input-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        
        .cargoa-input-icon--amber { background: rgba(245, 158, 11, 0.15); }
        .cargoa-input-icon--orange { background: rgba(234, 88, 12, 0.15); }
        .cargoa-input-icon--green { background: rgba(34, 197, 94, 0.15); }
        .cargoa-input-icon--blue { background: rgba(59, 130, 246, 0.15); }
        .cargoa-input-icon--purple { background: rgba(139, 92, 246, 0.15); }
        .cargoa-input-icon--rose { background: rgba(244, 63, 94, 0.15); }
        
        .cargoa-input-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #0F172A;
        }
        
        .cargoa-input-sublabel {
            font-size: 0.7rem;
            color: #64748B;
        }
        
        .cargoa-input-status {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
            margin-left: auto;
            animation: blink 2s infinite;
        }
        
        /* Input Path Animations */
        .cargoa-path-1 { animation: travelPath1 12s infinite ease-in-out; }
        .cargoa-path-2 { animation: travelPath2 12s infinite ease-in-out; }
        .cargoa-path-3 { animation: travelPath3 12s infinite ease-in-out; }
        .cargoa-path-4 { animation: travelPath4 12s infinite ease-in-out; }
        .cargoa-path-5 { animation: travelPath5 12s infinite ease-in-out; }
        .cargoa-path-6 { animation: travelPath6 12s infinite ease-in-out; }
        
        .cargoa-delay-0 { animation-delay: 0s; }
        .cargoa-delay-1 { animation-delay: 1.5s; }
        .cargoa-delay-2 { animation-delay: 3.2s; }
        .cargoa-delay-3 { animation-delay: 4.8s; }
        .cargoa-delay-4 { animation-delay: 6.5s; }
        .cargoa-delay-5 { animation-delay: 8s; }
        .cargoa-delay-6 { animation-delay: 9.5s; }
        .cargoa-delay-7 { animation-delay: 11s; }
        
        /* ============================================
           CORE PROCESSOR
        ============================================ */
        .cargoa-core-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .cargoa-core-node {
            width: 120px;
            height: 120px;
            background: linear-gradient(145deg, #FFFFFF, #FEF3C7);
            border-radius: 32px;
            border: 1px solid rgba(245, 158, 11, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 6px;
            z-index: 10;
            box-shadow: 0 20px 50px rgba(245, 158, 11, 0.15), inset 0 0 30px rgba(245, 158, 11, 0.05);
            position: relative;
            overflow: hidden;
            animation: coreFloat 5s ease-in-out infinite;
        }
        
        .cargoa-core-node::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 34px;
            background: conic-gradient(from 0deg, transparent, #f59e0b, transparent, #d97706, transparent);
            animation: rotateBorder 6s linear infinite;
            z-index: -1;
            opacity: 0.5;
        }
        
        .cargoa-core-node::after {
            content: '';
            position: absolute;
            inset: 2px;
            border-radius: 30px;
            background: linear-gradient(145deg, #FFFFFF, #FEF3C7);
        }
        
        .cargoa-core-label {
            font-size: 0.65rem;
            font-weight: 700;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            z-index: 5;
        }
        
        .cargoa-sparkle-container {
            position: relative;
            z-index: 5;
        }
        
        .cargoa-sparkle {
            width: 50px;
            height: 50px;
            animation: spinPulse 8s linear infinite;
            filter: drop-shadow(0 0 12px rgba(245, 158, 11, 0.6));
        }
        
        .cargoa-sparkle path {
            fill: #f59e0b;
        }
        
        .cargoa-halo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            border-radius: 36px;
            border: 2px solid #f59e0b;
            opacity: 0;
            animation: ripple 4s infinite ease-out;
            z-index: 1;
        }
        
        .cargoa-halo--orange { border-color: #ea580c; }
        .cargoa-halo--yellow { border-color: #eab308; }
        
        .cargoa-halo-delay-1 { animation-delay: 0s; }
        .cargoa-halo-delay-2 { animation-delay: 1.3s; }
        .cargoa-halo-delay-3 { animation-delay: 2.6s; }
        
        .cargoa-orbit {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px dashed rgba(245, 158, 11, 0.2);
            border-radius: 50%;
            animation: orbitSpin 25s linear infinite;
        }
        
        .cargoa-orbit--1 { width: 180px; height: 180px; }
        .cargoa-orbit--2 { width: 260px; height: 260px; animation-direction: reverse; animation-duration: 30s; }
        
        .cargoa-orbit-dot {
            position: absolute;
            width: 5px;
            height: 5px;
            background: #f59e0b;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(245, 158, 11, 0.6);
        }
        
        .cargoa-orbit--1 .cargoa-orbit-dot { top: -2.5px; left: 50%; }
        .cargoa-orbit--2 .cargoa-orbit-dot { bottom: -2.5px; left: 50%; }
        
        /* ============================================
           OUTPUT CARDS
        ============================================ */
        .cargoa-output-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
            width: 360px;
        }
        
        .cargoa-output-card {
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 18px 22px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06), 0 0 40px rgba(245, 158, 11, 0.03);
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateX(50px);
            animation: cardSlideIn 12s infinite ease-out;
        }
        
        .cargoa-output-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #f59e0b, #d97706);
            border-radius: 4px 0 0 4px;
        }
        
        .cargoa-output-card--1 { animation-delay: 4s; }
        .cargoa-output-card--2 { animation-delay: 5.5s; }
        .cargoa-output-card--3 { animation-delay: 7s; }
        
        .cargoa-output-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .cargoa-output-title {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #0F172A;
        }
        
        .cargoa-output-title-icon {
            font-size: 1.1rem;
        }
        
        .cargoa-output-timestamp {
            font-size: 0.65rem;
            color: #94a3b8;
            font-weight: 500;
        }
        
        .cargoa-output-description {
            font-size: 0.8rem;
            color: #64748B;
            margin: 0 0 12px;
            line-height: 1.5;
        }
        
        .cargoa-output-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .cargoa-tag {
            font-size: 0.65rem;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.04);
            padding: 4px 10px;
            border-radius: 100px;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .cargoa-tag--success { color: #16a34a; background: rgba(34, 197, 94, 0.1); }
        .cargoa-tag--synced { color: #0891b2; background: rgba(6, 182, 212, 0.1); }
        .cargoa-tag--processing { color: #d97706; background: rgba(245, 158, 11, 0.1); }
        .cargoa-tag--mapped { color: #7c3aed; background: rgba(124, 58, 237, 0.1); }
        
        .cargoa-progress {
            margin-top: 10px;
        }
        
        .cargoa-progress-bar {
            width: 100%;
            height: 3px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .cargoa-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #f59e0b, #d97706);
            border-radius: 10px;
            animation: progressAnim 3s ease-in-out infinite;
        }
        
        .cargoa-output-stats {
            display: flex;
            gap: 20px;
            margin-top: 14px;
            padding-top: 10px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .cargoa-output-stat-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #d97706;
        }
        
        .cargoa-output-stat-label {
            font-size: 0.65rem;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        /* ============================================
           INTEGRATIONS SHOWCASE
        ============================================ */
        .cargoa-showcase {
            margin-top: 5rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .cargoa-showcase-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #64748B;
            margin: 0 0 1.5rem;
            font-weight: 600;
        }
        
        .cargoa-showcase-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        
        .cargoa-showcase-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        
        .cargoa-showcase-badge:hover {
            background: #FFFFFF;
            border-color: rgba(245, 158, 11, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.1);
        }
        
        .cargoa-showcase-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        
        .cargoa-showcase-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #0F172A;
        }
        
        /* ============================================
           KEYFRAME ANIMATIONS
        ============================================ */
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
        
        @keyframes pulseGlowAmber {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.3);
            }
            50% {
                box-shadow: 0 0 20px 5px rgba(245, 158, 11, 0.15);
            }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }
        
        @keyframes flowLine {
            0% { stroke-dashoffset: 860; opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { stroke-dashoffset: -860; opacity: 0; }
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        
        @keyframes travelPath1 {
            0% { left: -20px; top: 5%; opacity: 0; transform: scale(0.8); }
            8% { opacity: 1; transform: scale(1); }
            75% { left: calc(100% - 40px); top: 48%; opacity: 1; transform: scale(1); }
            85% { opacity: 0.3; transform: scale(0.7); }
            100% { left: calc(100% + 30px); top: 50%; opacity: 0; transform: scale(0); }
        }
        
        @keyframes travelPath2 {
            0% { left: 10px; top: 18%; opacity: 0; transform: scale(0.8); }
            8% { opacity: 1; transform: scale(1); }
            75% { left: calc(100% - 40px); top: 48%; opacity: 1; transform: scale(1); }
            85% { opacity: 0.3; transform: scale(0.7); }
            100% { left: calc(100% + 30px); top: 50%; opacity: 0; transform: scale(0); }
        }
        
        @keyframes travelPath3 {
            0% { left: -10px; top: 32%; opacity: 0; transform: scale(0.8); }
            8% { opacity: 1; transform: scale(1); }
            75% { left: calc(100% - 40px); top: 49%; opacity: 1; transform: scale(1); }
            85% { opacity: 0.3; transform: scale(0.7); }
            100% { left: calc(100% + 30px); top: 50%; opacity: 0; transform: scale(0); }
        }
        
        @keyframes travelPath4 {
            0% { left: 5px; top: 52%; opacity: 0; transform: scale(0.8); }
            8% { opacity: 1; transform: scale(1); }
            75% { left: calc(100% - 40px); top: 51%; opacity: 1; transform: scale(1); }
            85% { opacity: 0.3; transform: scale(0.7); }
            100% { left: calc(100% + 30px); top: 50%; opacity: 0; transform: scale(0); }
        }
        
        @keyframes travelPath5 {
            0% { left: -15px; top: 68%; opacity: 0; transform: scale(0.8); }
            8% { opacity: 1; transform: scale(1); }
            75% { left: calc(100% - 40px); top: 51%; opacity: 1; transform: scale(1); }
            85% { opacity: 0.3; transform: scale(0.7); }
            100% { left: calc(100% + 30px); top: 50%; opacity: 0; transform: scale(0); }
        }
        
        @keyframes travelPath6 {
            0% { left: 0px; top: 85%; opacity: 0; transform: scale(0.8); }
            8% { opacity: 1; transform: scale(1); }
            75% { left: calc(100% - 40px); top: 52%; opacity: 1; transform: scale(1); }
            85% { opacity: 0.3; transform: scale(0.7); }
            100% { left: calc(100% + 30px); top: 50%; opacity: 0; transform: scale(0); }
        }
        
        @keyframes coreFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1deg); }
        }
        
        @keyframes rotateBorder {
            100% { transform: rotate(360deg); }
        }
        
        @keyframes spinPulse {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }
        
        @keyframes ripple {
            0% { width: 120px; height: 120px; opacity: 0.6; border-width: 2px; }
            100% { width: 320px; height: 320px; opacity: 0; border-width: 0px; }
        }
        
        @keyframes orbitSpin {
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        @keyframes cardSlideIn {
            0%, 30% { opacity: 0; transform: translateX(60px) scale(0.95); }
            40% { opacity: 1; transform: translateX(0) scale(1); }
            85% { opacity: 1; transform: translateX(-5px); }
            100% { opacity: 0; transform: translateX(-25px) scale(0.95); }
        }
        
        @keyframes progressAnim {
            0% { width: 0%; }
            60% { width: 100%; }
            100% { width: 100%; }
        }
        
        /* ============================================
           RESPONSIVE STYLES
        ============================================ */
        @media (max-width: 1024px) {
            .cargoa-engine {
                height: auto;
                flex-direction: column;
                gap: 3rem;
                padding: 2rem 0;
            }
        
            .cargoa-engine-section {
                width: 100% !important;
                height: auto;
                justify-content: center !important;
            }
        
            .cargoa-input-cluster {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center;
                height: auto;
            }
        
            .cargoa-input-item {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                animation: fadeInUpMobile 0.6s ease-out forwards !important;
                animation-delay: calc(var(--index) * 0.15s) !important;
            }
        
            @keyframes fadeInUpMobile {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        
            .cargoa-flow-svg {
                display: none;
            }
        
            .cargoa-output-grid {
                width: 100%;
                max-width: 400px;
            }
        
            .cargoa-output-card {
                animation: fadeInUpMobile 0.6s ease-out forwards !important;
            }
            
            .cargoa-title {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .cargoa-stats {
                gap: 2rem;
            }
        
            .cargoa-stat-value {
                font-size: 1.75rem;
            }
        
            .cargoa-core-node {
                width: 100px;
                height: 100px;
            }
        
            .cargoa-sparkle {
                width: 40px;
                height: 40px;
            }
        
            .cargoa-features {
                gap: 1rem;
            }
        }
        
        @media (max-width: 650px) {
            .cargoa-section {
                padding: 3rem 1.25rem;
            }
        
            .cargoa-stats {
                flex-direction: column;
                gap: 1.5rem;
            }
        
            .cargoa-showcase-grid {
                gap: 8px;
            }
        
            .cargoa-showcase-badge {
                padding: 8px 12px;
            }
        
            .cargoa-features {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .cargoa-title {
                font-size: 1.875rem;
            }
            
            .cargoa-description {
                font-size: 1rem;
            }
        }
        </style>
        
        <section class="cargoa-section">
            <div class="services-noise"></div>
        <div class="services-bg-glow services-bg-glow-1"></div>
        <div class="services-bg-glow services-bg-glow-2"></div>
        <div class="services-bg-glow services-bg-glow-3"></div>
        <div class="services-grid-pattern"></div>
        <div class="services-gradient-line services-gradient-line-1"></div>
        <div class="services-gradient-line services-gradient-line-2"></div>
        
        <!-- Floating Particles -->
        <div class="services-particles">
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
        </div>
            
            <div class="cargoa-container">
                <!-- HEADER -->
                <div class="cm-header">
                    <div class="cm-badge"><i class="fa-solid fa-cube"></i> With CargoVa BOT</div>
                    <h2 class="cm-title">Integrate Any System <span class="cargoa-title-highlight">In a Day</span></h2>
                    <p class="cargoa-description">
                        Most logistics ERPs take weeks or months to integrate. CargoVa's <span class="cargoa-description-highlight">BOT-driven mapping engine</span> connects your ERP, WMS, TMS, supplier portals, accounting platforms, and transport APIs—<span class="cargoa-description-highlight">in one day</span>.
                    </p>
                    <div class="cargoa-features">
                        <div class="cargoa-feature">
                            <span class="cargoa-feature-check">✓</span>
                            <span>No coding required</span>
                        </div>
                        <div class="cargoa-feature">
                            <span class="cargoa-feature-check">✓</span>
                            <span>No long implementation cycles</span>
                        </div>
                        <div class="cargoa-feature">
                            <span class="cargoa-feature-check">✓</span>
                            <span>No hidden complexity</span>
                        </div>
                    </div>
                    <div class="cargoa-stats">
                        <div class="cargoa-stat">
                            <div class="cargoa-stat-value">1 Day</div>
                            <div class="cargoa-stat-label">Integration Time</div>
                        </div>
                        <div class="cargoa-stat">
                            <div class="cargoa-stat-value">100%</div>
                            <div class="cargoa-stat-label">Auto-Mapping</div>
                        </div>
                        <div class="cargoa-stat">
                            <div class="cargoa-stat-value">0</div>
                            <div class="cargoa-stat-label">Code Required</div>
                        </div>
                    </div>
                </div>
        
                <!-- INTEGRATION ENGINE -->
                <div class="cargoa-engine">
                    <!-- SVG FLOW LINES -->
                    <svg class="cargoa-flow-svg" viewBox="0 0 1200 650" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="cargoaFlowGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#f59e0b; stop-opacity:0" />
                                <stop offset="30%" style="stop-color:#f59e0b; stop-opacity:1" />
                                <stop offset="70%" style="stop-color:#d97706; stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#d97706; stop-opacity:0" />
                            </linearGradient>
                            <linearGradient id="cargoaFlowGradientSoft" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#f59e0b; stop-opacity:0" />
                                <stop offset="50%" style="stop-color:#d97706; stop-opacity:0.3" />
                                <stop offset="100%" style="stop-color:#d97706; stop-opacity:0" />
                            </linearGradient>
                            <linearGradient id="cargoaOutputGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#d97706; stop-opacity:0" />
                                <stop offset="30%" style="stop-color:#d97706; stop-opacity:1" />
                                <stop offset="70%" style="stop-color:#22c55e; stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#22c55e; stop-opacity:0" />
                            </linearGradient>
                            <filter id="cargoaGlow" x="-50%" y="-50%" width="200%" height="200%">
                                <feGaussianBlur stdDeviation="5" result="coloredBlur"/>
                                <feMerge>
                                    <feMergeNode in="coloredBlur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                            <filter id="cargoaGlowSoft" x="-50%" y="-50%" width="200%" height="200%">
                                <feGaussianBlur stdDeviation="10" result="coloredBlur"/>
                                <feMerge><feMergeNode in="coloredBlur"/></feMerge>
                            </filter>
                        </defs>
        
                        <!-- INPUT THREADS -->
                        <path class="cargoa-track-base-thick" d="M0,50 C180,50 320,325 600,325" />
                        <path class="cargoa-track-base" d="M0,50 C180,50 320,325 600,325" />
                        <path class="cargoa-track-flow-thick" d="M0,50 C180,50 320,325 600,325" style="animation-delay: 0s;" />
                        <path class="cargoa-track-flow" d="M0,50 C180,50 320,325 600,325" style="animation-delay: 0s;" />
        
                        <path class="cargoa-track-base-thick" d="M0,140 C200,140 380,325 600,325" />
                        <path class="cargoa-track-base" d="M0,140 C200,140 380,325 600,325" />
                        <path class="cargoa-track-flow-thick" d="M0,140 C200,140 380,325 600,325" style="animation-delay: 1.5s;" />
                        <path class="cargoa-track-flow" d="M0,140 C200,140 380,325 600,325" style="animation-delay: 1.5s;" />
        
                        <path class="cargoa-track-base-thick" d="M0,230 C180,230 350,325 600,325" />
                        <path class="cargoa-track-base" d="M0,230 C180,230 350,325 600,325" />
                        <path class="cargoa-track-flow-thick" d="M0,230 C180,230 350,325 600,325" style="animation-delay: 3.2s;" />
                        <path class="cargoa-track-flow" d="M0,230 C180,230 350,325 600,325" style="animation-delay: 3.2s;" />
        
                        <path class="cargoa-track-base-thick" d="M0,370 C180,370 350,325 600,325" />
                        <path class="cargoa-track-base" d="M0,370 C180,370 350,325 600,325" />
                        <path class="cargoa-track-flow-thick" d="M0,370 C180,370 350,325 600,325" style="animation-delay: 4.8s;" />
                        <path class="cargoa-track-flow" d="M0,370 C180,370 350,325 600,325" style="animation-delay: 4.8s;" />
        
                        <path class="cargoa-track-base-thick" d="M0,470 C200,470 380,325 600,325" />
                        <path class="cargoa-track-base" d="M0,470 C200,470 380,325 600,325" />
                        <path class="cargoa-track-flow-thick" d="M0,470 C200,470 380,325 600,325" style="animation-delay: 6.5s;" />
                        <path class="cargoa-track-flow" d="M0,470 C200,470 380,325 600,325" style="animation-delay: 6.5s;" />
        
                        <path class="cargoa-track-base-thick" d="M0,570 C180,570 320,325 600,325" />
                        <path class="cargoa-track-base" d="M0,570 C180,570 320,325 600,325" />
                        <path class="cargoa-track-flow-thick" d="M0,570 C180,570 320,325 600,325" style="animation-delay: 8s;" />
                        <path class="cargoa-track-flow" d="M0,570 C180,570 320,325 600,325" style="animation-delay: 8s;" />
        
                        <!-- OUTPUT THREADS -->
                        <path class="cargoa-track-base-thick" d="M600,325 C850,325 920,150 1200,150" />
                        <path class="cargoa-track-base" d="M600,325 C850,325 920,150 1200,150" />
                        <path class="cargoa-track-flow-thick" d="M600,325 C850,325 920,150 1200,150" style="animation-delay: 4s; stroke: url(#cargoaOutputGradient);" />
                        <path class="cargoa-track-flow" d="M600,325 C850,325 920,150 1200,150" style="animation-delay: 4s; stroke: url(#cargoaOutputGradient);" />
        
                        <path class="cargoa-track-base-thick" d="M600,325 C800,325 900,325 1200,325" />
                        <path class="cargoa-track-base" d="M600,325 C800,325 900,325 1200,325" />
                        <path class="cargoa-track-flow-thick" d="M600,325 C800,325 900,325 1200,325" style="animation-delay: 5.5s; stroke: url(#cargoaOutputGradient);" />
                        <path class="cargoa-track-flow" d="M600,325 C800,325 900,325 1200,325" style="animation-delay: 5.5s; stroke: url(#cargoaOutputGradient);" />
        
                        <path class="cargoa-track-base-thick" d="M600,325 C850,325 920,500 1200,500" />
                        <path class="cargoa-track-base" d="M600,325 C850,325 920,500 1200,500" />
                        <path class="cargoa-track-flow-thick" d="M600,325 C850,325 920,500 1200,500" style="animation-delay: 7s; stroke: url(#cargoaOutputGradient);" />
                        <path class="cargoa-track-flow" d="M600,325 C850,325 920,500 1200,500" style="animation-delay: 7s; stroke: url(#cargoaOutputGradient);" />
        
                        <!-- PARTICLES -->
                        <circle class="cargoa-particle" r="3" fill="#f59e0b">
                            <animateMotion dur="12s" repeatCount="indefinite" path="M0,50 C180,50 320,325 600,325" begin="0s"/>
                        </circle>
                        <circle class="cargoa-particle" r="3" fill="#d97706">
                            <animateMotion dur="12s" repeatCount="indefinite" path="M0,230 C180,230 350,325 600,325" begin="3.2s"/>
                        </circle>
                        <circle class="cargoa-particle" r="3" fill="#f59e0b">
                            <animateMotion dur="12s" repeatCount="indefinite" path="M0,470 C200,470 380,325 600,325" begin="6.5s"/>
                        </circle>
                        <circle class="cargoa-particle" r="4" fill="#22c55e">
                            <animateMotion dur="12s" repeatCount="indefinite" path="M600,325 C800,325 900,325 1200,325" begin="5.5s"/>
                        </circle>
                    </svg>
        
                    <!-- INPUTS -->
                    <div class="cargoa-engine-section cargoa-engine-inputs">
                        <div class="cargoa-input-cluster">
                            <div class="cargoa-input-item cargoa-path-1 cargoa-delay-0" style="--index: 0;">
                                <div class="cargoa-input-icon cargoa-input-icon--amber">📊</div>
                                <div>
                                    <div class="cargoa-input-label">ERP System</div>
                                    <div class="cargoa-input-sublabel">SAP / Oracle</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-3 cargoa-delay-1" style="--index: 1;">
                                <div class="cargoa-input-icon cargoa-input-icon--blue">🏭</div>
                                <div>
                                    <div class="cargoa-input-label">WMS</div>
                                    <div class="cargoa-input-sublabel">Warehouse Mgmt</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-5 cargoa-delay-2" style="--index: 2;">
                                <div class="cargoa-input-icon cargoa-input-icon--green">🚛</div>
                                <div>
                                    <div class="cargoa-input-label">TMS</div>
                                    <div class="cargoa-input-sublabel">Transport Mgmt</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-2 cargoa-delay-3" style="--index: 3;">
                                <div class="cargoa-input-icon cargoa-input-icon--orange">🤝</div>
                                <div>
                                    <div class="cargoa-input-label">Supplier Portal</div>
                                    <div class="cargoa-input-sublabel">Vendor Data</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-6 cargoa-delay-4" style="--index: 4;">
                                <div class="cargoa-input-icon cargoa-input-icon--purple">💰</div>
                                <div>
                                    <div class="cargoa-input-label">Accounting</div>
                                    <div class="cargoa-input-sublabel">QuickBooks / Xero</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-4 cargoa-delay-5" style="--index: 5;">
                                <div class="cargoa-input-icon cargoa-input-icon--blue">🔗</div>
                                <div>
                                    <div class="cargoa-input-label">Transport API</div>
                                    <div class="cargoa-input-sublabel">Carrier Integration</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-1 cargoa-delay-6" style="--index: 6;">
                                <div class="cargoa-input-icon cargoa-input-icon--green">📁</div>
                                <div>
                                    <div class="cargoa-input-label">Excel / CSV</div>
                                    <div class="cargoa-input-sublabel">Legacy Data</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                            <div class="cargoa-input-item cargoa-path-4 cargoa-delay-7" style="--index: 7;">
                                <div class="cargoa-input-icon cargoa-input-icon--rose">📡</div>
                                <div>
                                    <div class="cargoa-input-label">EDI</div>
                                    <div class="cargoa-input-sublabel">Electronic Data</div>
                                </div>
                                <div class="cargoa-input-status"></div>
                            </div>
                        </div>
                    </div>
        
                    <!-- CORE -->
                    <div class="cargoa-engine-section cargoa-engine-core">
                        <div class="cargoa-core-container">
                            <div class="cargoa-orbit cargoa-orbit--1">
                                <div class="cargoa-orbit-dot"></div>
                            </div>
                            <div class="cargoa-orbit cargoa-orbit--2">
                                <div class="cargoa-orbit-dot"></div>
                            </div>
                            <div class="cargoa-core-node">
                                <span class="cargoa-core-label">CargoVa</span>
                                <div class="cargoa-sparkle-container">
                                    <svg class="cargoa-sparkle" viewBox="0 0 24 24">
                                        <path d="M12 0L14.5 9.5L24 12L14.5 14.5L12 24L9.5 14.5L0 12L9.5 9.5L12 0Z" />
                                    </svg>
                                </div>
                                <span class="cargoa-core-label">BOT</span>
                            </div>
                            <div class="cargoa-halo cargoa-halo-delay-1"></div>
                            <div class="cargoa-halo cargoa-halo--orange cargoa-halo-delay-2"></div>
                            <div class="cargoa-halo cargoa-halo--yellow cargoa-halo-delay-3"></div>
                        </div>
                    </div>
        
                    <!-- OUTPUTS -->
                    <div class="cargoa-engine-section cargoa-engine-outputs">
                        <div class="cargoa-output-grid">
                            <article class="cargoa-output-card cargoa-output-card--1">
                                <div class="cargoa-output-header">
                                    <div>
                                        <h3 class="cargoa-output-title"><span class="cargoa-output-title-icon">✨</span> Field Mapping Complete</h3>
                                        <span class="cargoa-output-timestamp">Just now</span>
                                    </div>
                                </div>
                                <p class="cargoa-output-description">BOT aligned source fields with CargoVa structure automatically.</p>
                                <div class="cargoa-output-meta">
                                    <span class="cargoa-tag cargoa-tag--success">✓ Auto-Mapped</span>
                                    <span class="cargoa-tag cargoa-tag--mapped">248 Fields</span>
                                </div>
                                <div class="cargoa-output-stats">
                                    <div class="cargoa-output-stat">
                                        <span class="cargoa-output-stat-value">100%</span>
                                        <span class="cargoa-output-stat-label">Accuracy</span>
                                    </div>
                                    <div class="cargoa-output-stat">
                                        <span class="cargoa-output-stat-value">0</span>
                                        <span class="cargoa-output-stat-label">Errors</span>
                                    </div>
                                </div>
                            </article>
                            <article class="cargoa-output-card cargoa-output-card--2">
                                <div class="cargoa-output-header">
                                    <div>
                                        <h3 class="cargoa-output-title"><span class="cargoa-output-title-icon">🔄</span> Data Flow Active</h3>
                                        <span class="cargoa-output-timestamp">Processing...</span>
                                    </div>
                                </div>
                                <p class="cargoa-output-description">Real-time sync between all connected systems.</p>
                                <div class="cargoa-output-meta">
                                    <span class="cargoa-tag cargoa-tag--processing">◉ Syncing</span>
                                    <span class="cargoa-tag cargoa-tag--synced">6 Systems</span>
                                </div>
                                <div class="cargoa-progress">
                                    <div class="cargoa-progress-bar">
                                        <div class="cargoa-progress-fill"></div>
                                    </div>
                                </div>
                            </article>
                            <article class="cargoa-output-card cargoa-output-card--3">
                                <div class="cargoa-output-header">
                                    <div>
                                        <h3 class="cargoa-output-title"><span class="cargoa-output-title-icon">🚀</span> Integration Live</h3>
                                        <span class="cargoa-output-timestamp">Day 1 Complete</span>
                                    </div>
                                </div>
                                <p class="cargoa-output-description">Your data flows accurately from day one.</p>
                                <div class="cargoa-output-meta">
                                    <span class="cargoa-tag cargoa-tag--success">✓ Production Ready</span>
                                    <span class="cargoa-tag">No Code</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
        
                <!-- SHOWCASE -->
                <div class="cargoa-showcase">
                    <p class="cargoa-showcase-title">Connects your entire logistics tech stack</p>
                    <div class="cargoa-showcase-grid">
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(245, 158, 11, 0.15);">📊</div>
                            <span class="cargoa-showcase-label">ERP Systems</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(59, 130, 246, 0.15);">🏭</div>
                            <span class="cargoa-showcase-label">WMS</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(34, 197, 94, 0.15);">🚛</div>
                            <span class="cargoa-showcase-label">TMS</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(234, 88, 12, 0.15);">🤝</div>
                            <span class="cargoa-showcase-label">Supplier Portals</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(139, 92, 246, 0.15);">💰</div>
                            <span class="cargoa-showcase-label">Accounting</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(6, 182, 212, 0.15);">🔗</div>
                            <span class="cargoa-showcase-label">Transport APIs</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(34, 197, 94, 0.15);">📁</div>
                            <span class="cargoa-showcase-label">Excel / CSV</span>
                        </div>
                        <div class="cargoa-showcase-badge">
                            <div class="cargoa-showcase-icon" style="background: rgba(244, 63, 94, 0.15);">📡</div>
                            <span class="cargoa-showcase-label">EDI</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- <script>
        document.addEventListener('mousemove', (e) => {
            const core = document.querySelector('.cargoa-core-container');
            if (!core) return;
            const rect = core.getBoundingClientRect();
            const deltaX = (e.clientX - (rect.left + rect.width / 2)) / 60;
            const deltaY = (e.clientY - (rect.top + rect.height / 2)) / 60;
            core.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
        });
        </script> -->
        <style>

            /* 2. Container & Layout (Scoped to .cv-section) */
            .cv-section {
                background-color: #f8fafc;
                /* Subtle dot pattern background */
                background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
                background-size: 24px 24px;
                color: #475569;
                padding: 4rem 1.5rem;
                box-sizing: border-box;
                line-height: 1.5;
                overflow: hidden; /* Prevent animation scrollbars */
            }
        
            .cv-section * {
                box-sizing: border-box;
            }
        
            .cw-container {
                max-width: 1200px;
                margin: 0 auto;
            }
        
            .cv-grid {
                display: grid;
                gap: 3rem;
                align-items: flex-start;
            }
        
            /* 3. Typography & Elements */
            .cv-eyebrow {
                display: block;
                color: #6366f1; /* Indigo */
                font-size: 0.875rem;
                font-weight: 700;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                margin-bottom: 1rem;
                /* Fixed height for alignment calculation */
                height: 1.5rem; 
                line-height: 1.5rem;
            }
        
            .cv-hero-title {
                color: #0f172a; /* Slate 900 */
                font-size: 2.5rem;
                line-height: 1.1;
                font-weight: 700; /* its 800 before  */
                letter-spacing: -0.03em;
                margin: 0 0 1.5rem 0;
            }
        
            .cv-highlight {
                background: linear-gradient(120deg, #bef264 0%, #bef264 100%); /* Lime */
                background-repeat: no-repeat;
                background-size: 100% 0.35em;
                background-position: 0 85%;
                padding: 0 4px;
            }
        
            .cv-description {
                font-size: 1.125rem;
                color: #475569; /* Slate 600 */
                margin-bottom: 2rem;
                max-width: 90%;
            }
        
            .cv-description p {
                margin: 0 0 1rem 0;
            }
        
            /* 4. Visuals (Image & Floating Card) */
            .cv-visual-wrapper {
                position: relative;
                margin-top: 2rem;
                perspective: 1000px; /* For 3D tilt effects */
            }
        
            .cv-main-image {
                width: 100%;
                height: auto;
                display: block;
                border-radius: 12px;
                /* Blend mode to integrate placeholder with bg */
                mix-blend-mode: multiply; 
                opacity: 0.9;
                transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
            }
        
            .cv-visual-wrapper:hover .cv-main-image {
                transform: rotateY(1deg) rotateX(1deg) scale(1.005);
            }
        
            .cv-float-card {
                position: absolute;
                bottom: 25px;
                right: -160px;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(8px);
                padding: 1.25rem;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.6);
                box-shadow: 0 20px 40px -10px rgba(0,0,0,0.15);
                max-width: 260px;
                z-index: 2;
                /* Continuous Float Animation */
                animation: cv-float 6s ease-in-out infinite;
            }
        
            .cv-card-header {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 0.5rem;
            }
        
            .cv-status-dot {
                width: 8px;
                height: 8px;
                background-color: #10b981; /* Emerald 500 */
                border-radius: 50%;
                box-shadow: 0 0 0 2px #d1fae5;
                animation: cv-pulse 2s infinite;
            }
        
            .cv-status-text {
                font-size: 0.75rem;
                font-weight: 700;
                color: #763ae9;
                text-transform: uppercase;
            }
        
            .cv-card-body {
                font-size: 0.875rem;
                color: #0f172a;
                line-height: 1.4;
            }
        
            /* 5. Right Column Features */
            .cv-feature-list {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }
        
            .cv-feature-item {
                display: flex;
                gap: 1.25rem;
                padding: 1.5rem;
                background: transparent;
                border-radius: 12px;
                transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            }
        
            .cv-feature-item:hover {
                background: #ffffff;
                box-shadow: 0 10px 30px -10px rgba(0,0,0,0.06);
                transform: translateY(-4px) scale(1.01);
            }
        
            .cv-icon-box {
                width: 52px;
                height: 52px;
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                color: #0f172a;
                transition: border-color 0.3s ease, color 0.3s ease;
            }
        
            .cv-feature-item:hover .cv-icon-box {
                border-color: #6366f1;
                color: #6366f1;
            }
        
            .cv-feature-content h3 {
                margin: 0 0 0.5rem 0;
                font-size: 1.25rem;
                font-weight: 700;
                color: #0f172a;
            }
        
            .cv-feature-content p {
                margin: 0;
                font-size: 1rem;
                color: #475569;
            }
        
            .cv-footer-note {
                margin-top: 3rem;
                padding-top: 1.5rem;
                border-top: 1px solid #e2e8f0;
                display: flex;
                gap: 0.5rem;
                font-size: 0.875rem;
                color: #64748b;
            }
        
            .cv-asterisk {
                color: #f97316; /* Orange */
                font-size: 1.25rem;
                line-height: 1;
            }
        
            /* 6. Responsive Logic & Alignment */
            @media (min-width: 900px) {
                .cv-grid {
                    grid-template-columns: 1.1fr 0.9fr; /* Left slightly wider */
                    gap: 5rem;
                }
        
                .cv-hero-title {
                    font-size: 3.5rem;
                }
        
                /* 
                   Alignment Magic:
                   Eyebrow is ~24px tall (1.5rem). Margin bottom is 16px (1rem).
                   Total offset = 40px. 
                   Pushing the right column down by 40px ensures H1 aligns with First Feature.
                */
                .cv-col-right {
                    padding-top: 2.5rem; 
                }
            }
        
            @media (max-width: 600px) {
                .cv-float-card {
                    position: relative;
                    bottom: auto;
                    right: auto;
                    margin-top: -30px;
                    margin-left: 20px;
                }
            }
        
            /* 7. Animations (High Performance / Physics Based) */
            
            /* Utility class used by JS */
            .cv-reveal-item {
                opacity: 0;
                transform: translateY(40px) scale(0.96);
                filter: blur(4px);
                will-change: transform, opacity, filter;
                transition: 
                    opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 1s cubic-bezier(0.16, 1, 0.3, 1),
                    filter 0.8s ease;
            }
            
            .cv-visual-wrapper.cv-reveal-item.cv-delay-4.cv-active {
            width: 210px;
        }
        
            .cv-reveal-item.cv-active {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        
            /* Specific Delays for Cascading Effect */
            .cv-delay-1 { transition-delay: 0.1s; } /* Eyebrow */
            .cv-delay-2 { transition-delay: 0.2s; } /* Title */
            .cv-delay-3 { transition-delay: 0.3s; } /* Text */
            .cv-delay-4 { transition-delay: 0.4s; } /* Image & Feature 1 */
            .cv-delay-5 { transition-delay: 0.5s; } /* Feature 2 */
            .cv-delay-6 { transition-delay: 0.6s; } /* Feature 3 */
        
            /* Keyframes */
            @keyframes cv-float {
                0% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-10px) rotate(1deg); }
                66% { transform: translateY(5px) rotate(-0.5deg); }
                100% { transform: translateY(0px) rotate(0deg); }
            }
        
            @keyframes cv-pulse {
                0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
                70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
                100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
            }
        
        </style>
        
        <section class="cv-section">
            <div class="cw-container">
                <div class="cv-grid">
                    
                    <!-- Left Column -->
                    <div class="cv-col-left">
                        <div class="efficiency-header left">
                            <span class="efficiency-badge">
                                <svg class="efficiency-badge-icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                    <path d="M2 17l10 5 10-5"></path>
                                    <path d="M2 12l10 5 10-5"></path>
                                </svg>
                                ULIP Connected
                            </span>
                            <h2 class="efficiency-title"> Warehouse Decisions <span class="efficiency-title-highlight">Reinvented</span></h2>
                            <p class="efficiency-description">
                                CargoVa’s official ULIP integration brings verified national logistics data directly into your warehouse workflows.
                                With real-time vehicle movement, FASTag-based visibility, and instant e-way bill validation, CargoVa strengthens your outbound planning.
                            </p>
                        </div>
        
                        <div class="cv-visual-wrapper cv-reveal-item cv-delay-4">
                            <img src="https://cdn.prod.website-files.com/67240d8f6a16c3be26ab07cd/67400115123c9ba868d99c7f_Header%20Slider%20Illustration.svg" alt="Live logistics map" class="cv-main-image">
                            
                            <div class="cv-float-card">
                                <div class="cv-card-header">
                                    <span class="cv-status-dot"></span>
                                    <span class="cv-status-text">Live Tracking</span>
                                </div>
                                <div class="cv-card-body">
                                    <strong>MH-12-DT-8890</strong><br>
                                    Verified arriving at Dock 4.
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Right Column -->
                    <div class="cv-col-right">
                        <ul class="cv-feature-list">
                            
                            <!-- Item 1 -->
                            <li class="cv-feature-item cv-reveal-item cv-delay-4">
                                <div class="cv-icon-box">
                                    <!-- Radar Icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20l-9-5 9-5 9 5-9 5z"/><path d="M12 10L3 15"/><path d="M12 10v10"/><path d="M12 10l9 5"/><path d="M12 4v6"/></svg>
                                </div>
                                <div class="cv-feature-content">
                                    <h3>Verified Movement Visibility</h3>
                                    <p>Real FASTag movement data keeps your dispatch planning accurate.</p>
                                </div>
                            </li>
        
                            <!-- Item 2 -->
                            <li class="cv-feature-item cv-reveal-item cv-delay-5">
                                <div class="cv-icon-box">
                                    <!-- Check File Icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 15l2 2 4-4"/></svg>
                                </div>
                                <div class="cv-feature-content">
                                    <h3>Instant E-Way Bill Checks</h3>
                                    <p>Faster compliance, fewer delays, and cleaner depot exits.</p>
                                </div>
                            </li>
        
                            <!-- Item 3 -->
                            <li class="cv-feature-item cv-reveal-item cv-delay-6">
                                <div class="cv-icon-box">
                                    <!-- Timer Icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div class="cv-feature-content">
                                    <h3>More Accurate ETA & Scheduling</h3>
                                    <p>ULIP data feeds CargoVa’s AI, reducing wait times and uncertainty.</p>
                                </div>
                            </li>
                        </ul>
        
                        <div class="cv-footer-note cv-reveal-item cv-delay-6">
                            <span class="cv-asterisk">*</span>
                            <span>Zero guesswork in your logistics operations.</span>
                        </div>
                    </div>
        
                </div>
            </div>
        
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('cv-active');
                                observer.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.15, rootMargin: "0px 0px -50px 0px" });
        
                    document.querySelectorAll('.cv-reveal-item').forEach(el => observer.observe(el));
                });
            </script>
        </section>
        <style>

            /* 2. Section Layout */
            .fc-dark-section {
                background-color: #003854; /* Specific Dark Blue Request */
                color: #e2e8f0; /* Light text for dark bg */
                padding: 5rem 1.5rem;
                box-sizing: border-box;
                line-height: 1.6;
                position: relative;
                overflow: hidden;
            }
        
            .fc-dark-section * {
                box-sizing: border-box;
            }
        
            .fc-container {
                max-width: 1200px;
                margin: 0 auto;
            }
        
            .fc-grid {
                display: grid;
                gap: 4rem;
                grid-template-columns: 1fr;
            }
        
            /* 3. Typography (Dark Theme Adapted) */
            .fc-eyebrow {
                display: block;
                color: #38bdf8; /* Bright Sky Blue for pop */
                font-size: 0.875rem;
                font-weight: 700;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                margin-bottom: 0.75rem;
            }
        
            .fc-title {
                color: #ffffff; /* Pure White */
                font-size: 2.5rem;
                font-weight: 700; /* its 800 before  */
                line-height: 1.1;
                letter-spacing: -0.02em;
                margin: 0 0 1rem 0;
            }
        
            .fc-subtitle {
                font-size: 1.125rem;
                color: #cbd5e1; /* Slate 300 */
                margin-bottom: 3rem;
                max-width: 90%;
            }
        
            /* 4. Left Column: FAQ Accordion (Dark Theme) */
            .fc-accordion {
                display: flex;
                flex-direction: column;
                gap: 0; /* Removing gap for border collapse look */
            }
        
            .fc-faq-item {
                border-bottom: 1px solid rgba(255, 255, 255, 0.15); /* Subtle transparent border */
                padding-bottom: 0.5rem;
                margin-bottom: 1rem;
            }
        
            .fc-faq-trigger {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: flex-start; /* Align top for multi-line questions */
                background: none;
                border: none;
                padding: 1rem 0;
                text-align: left;
                cursor: pointer;
                color: #ffffff;
                font-size: 1.125rem;
                font-weight: 600;
                font-family: inherit;
                transition: color 0.3s ease;
                line-height: 1.4;
            }
        
            .fc-faq-trigger:hover {
                color: lightgreen;
            }
        
            .fc-faq-icon {
                width: 24px;
                height: 24px;
                flex-shrink: 0;
                margin-left: 1.5rem;
                color: #94a3b8;
                transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.3s ease;
                margin-top: 2px; /* Optical alignment */
            }
        
            .fc-faq-trigger[aria-expanded="true"] .fc-faq-icon {
                transform: rotate(45deg);
                color: lightgreen;
            }
        
            /* Smooth Height Animation */
            .fc-faq-content-wrapper {
                display: grid;
                grid-template-rows: 0fr;
                transition: grid-template-rows 0.5s cubic-bezier(0.25, 1, 0.5, 1);
                opacity: 0.6;
            }
        
            .fc-faq-trigger[aria-expanded="true"] + .fc-faq-content-wrapper {
                grid-template-rows: 1fr;
                opacity: 1;
            }
        
            .fc-faq-inner {
                overflow: hidden;
            }
        
            .fc-faq-text {
                margin: 0;
                padding-bottom: 1.5rem;
                color: #cbd5e1; /* Slate 300 */
                font-size: 1rem;
            }
        
            /* 5. Right Column: Contact Form (White Card for Contrast) */
            .fc-form-card {
                background: #ffffff;
                padding: 2.5rem;
                border-radius: 16px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.2);
                position: relative;
            }
        
            .fc-form-title {
                color: #0f172a;
                font-size: 1.5rem;
                font-weight: 700;
                margin: 0 0 0.5rem 0;
            }
            
            .fc-form-desc {
                color: #64748b;
                font-size: 0.9rem;
                margin: 0 0 1.5rem 0;
            }
        
            .fc-form-group {
                margin-bottom: 1.25rem;
            }
        
            .fc-label {
                display: block;
                font-size: 0.875rem;
                font-weight: 600;
                color: #334155;
                margin-bottom: 0.5rem;
            }
        
            .fc-input, .fc-textarea {
                width: 100%;
                padding: 0.875rem 1rem;
                border: 1px solid #cbd5e1;
                background-color: #f8fafc;
                border-radius: 8px;
                font-family: inherit;
                font-size: 1rem;
                color: #0f172a;
                transition: all 0.2s ease;
                outline: none;
            }
        
            .fc-textarea {
                resize: vertical;
                min-height: 100px;
            }
        
            .fc-input:focus, .fc-textarea:focus {
                border-color: #003854;
                background-color: #fff;
                box-shadow: 0 0 0 3px rgba(0, 56, 84, 0.1);
            }
        
            .fc-submit-btn {
                width: 100%;
                background-color: #003854; /* Brand Match */
                color: #ffffff;
                border: none;
                padding: 1rem;
                font-size: 1rem;
                font-weight: 600;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                margin-top: 0.5rem;
            }
        
            .fc-submit-btn:hover {
                background-color: #025075;
                transform: translateY(-2px);
            }
        
            /* 6. Animations */
            .fc-anim-el {
                opacity: 0;
                transform: translateY(30px);
                filter: blur(2px);
                transition: 
                    opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 1s cubic-bezier(0.16, 1, 0.3, 1),
                    filter 0.8s ease;
            }
        
            .fc-anim-el.fc-visible {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        
            .fc-delay-1 { transition-delay: 0.1s; }
            .fc-delay-2 { transition-delay: 0.2s; }
            .fc-delay-3 { transition-delay: 0.3s; }
        
            /* 7. Responsive Desktop */
            @media (min-width: 900px) {
                .fc-grid {
                    grid-template-columns: 1fr 0.8fr; /* FAQ wider than form */
                    align-items: start;
                    gap: 5rem;
                }
        
                .fc-form-card {
                    position: sticky;
                    top: 2rem; 
                }
            }
        </style>
        
        <section class="fc-dark-section" id="faq-section">
            <div class="services-noise"></div>
        <div class="services-bg-glow services-bg-glow-1"></div>
        <div class="services-bg-glow services-bg-glow-2"></div>
        <div class="services-bg-glow services-bg-glow-3"></div>
        <div class="services-grid-pattern"></div>
        <div class="services-gradient-line services-gradient-line-1"></div>
        <div class="services-gradient-line services-gradient-line-2"></div>
        
        <!-- Floating Particles -->
        <div class="services-particles">
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
            <div class="services-particle"></div>
        </div>
            <div class="fc-container">
                <div class="fc-grid">
                    
                    <!-- Left Column: FAQ -->
                    <div class="fc-col-left">
                        <div class="cm-header left">
                            <div class="cm-badge"><i class="fa-solid fa-cube"></i>Support</div>
                            <h2 class="cm-title mb-20">Frequently Asked <span class="cargoa-title-highlight">Questions</span></h2>
                            <p class="fc-subtitle fc-anim-el fc-delay-2">Answers to common questions about CargoVa's capabilities.</p>
                        </div>
                        <div class="fc-accordion fc-anim-el fc-delay-3">
                            
                            <!-- Q1 -->
                            <div class="fc-faq-item">
                                <button class="fc-faq-trigger" aria-expanded="true" aria-controls="faq1">
                                    How does CargoVa improve daily warehouse performance?
                                    <svg class="fc-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </button>
                                <div id="faq1" class="fc-faq-content-wrapper">
                                    <div class="fc-faq-inner">
                                        <p class="fc-faq-text">CargoVa replaces paper-driven processes with AI-guided workflows, ensuring faster receiving, cleaner GRN cycles, smarter putaway, accurate picking, and predictable dispatch. Every SKU, resource, and movement is tracked in real time, giving your team complete operational clarity.</p>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Q2 -->
                            <div class="fc-faq-item">
                                <button class="fc-faq-trigger" aria-expanded="false" aria-controls="faq2">
                                    Can CargoVa integrate with my existing ERP or TMS?
                                    <svg class="fc-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </button>
                                <div id="faq2" class="fc-faq-content-wrapper">
                                    <div class="fc-faq-inner">
                                        <p class="fc-faq-text">Yes. CargoVa’s BOT-driven integration engine connects with any ERP, WMS, TMS, transport API, or supplier system in less than a day. No coding is required — the BOT maps fields, validates data, and activates the connection automatically.</p>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Q3 -->
                            <div class="fc-faq-item">
                                <button class="fc-faq-trigger" aria-expanded="false" aria-controls="faq3">
                                    Is CargoVa suitable for 3PL, FMCG, cold storage, and distribution operations?
                                    <svg class="fc-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </button>
                                <div id="faq3" class="fc-faq-content-wrapper">
                                    <div class="fc-faq-inner">
                                        <p class="fc-faq-text">Absolutely. CargoVa is built for high-volume, multi-client, and temperature-controlled environments. It supports FEFO/FIFO handling, AI slotting, multi-zone picking, peak-load simulation, and real-time visibility across every warehouse type.</p>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                    </div>
        
                    <!-- Right Column: Contact Form -->
                    <div class="fc-col-right">
                        <div class="fc-form-card fc-anim-el fc-delay-3">
                            <h3 class="fc-form-title">Have more questions?</h3>
                            <p class="fc-form-desc">Fill out the details below and our team will get back to you shortly.</p>
                            
                            <form id="fc-dark-form">
                                <div class="fc-form-group">
                                    <label for="fc-name" class="fc-label">Name</label>
                                    <input type="text" id="fc-name" class="fc-input" placeholder="Your Name" required>
                                </div>
        
                                <div class="fc-form-group">
                                    <label for="fc-email" class="fc-label">Company Email</label>
                                    <input type="email" id="fc-email" class="fc-input" placeholder="you@company.com" required>
                                </div>
        
                                <div class="fc-form-group">
                                    <label for="fc-message" class="fc-label">How can we help?</label>
                                    <textarea id="fc-message" class="fc-textarea" placeholder="Tell us about your requirements..." required></textarea>
                                </div>
        
                                <button type="submit" class="fc-submit-btn">
                                    Get in Touch
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                </button>
                            </form>
                        </div>
                    </div>
        
                </div>
            </div>
        
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    
                    // 1. Reveal Animation
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('fc-visible');
                                observer.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.1 });
        
                    document.querySelectorAll('.fc-anim-el').forEach(el => observer.observe(el));
        
                    // 2. Accordion Logic
                    const triggers = document.querySelectorAll('.fc-faq-trigger');
                    
                    triggers.forEach(trigger => {
                        trigger.addEventListener('click', () => {
                            const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
                            // Toggle current
                            trigger.setAttribute('aria-expanded', !isExpanded);
                        });
                    });
        
                    // 3. Simple Button Feedback
                    const form = document.getElementById('fc-dark-form');
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        const btn = form.querySelector('.fc-submit-btn');
                        const originalText = btn.innerHTML;
                        
                        btn.innerHTML = 'Message Sent!';
                        btn.style.backgroundColor = '#10b981'; // Green feedback
                        
                        setTimeout(() => {
                            form.reset();
                            btn.innerHTML = originalText;
                            btn.style.backgroundColor = ''; // Revert to default
                        }, 3000);
                    });
                });
            </script>
        </section>
<?php get_footer(); ?>