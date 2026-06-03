<?php
    /**
     * Template Name: Single Blog New
     * Description: Modern responsive blog detail template with hero meta sidebar, sticky TOC, and newsletter section.
     */

    if (!function_exists('sblog4_read_time')) {
        function sblog4_read_time($content)
        {
            $words = str_word_count(wp_strip_all_tags((string) $content));
            return max(1, (int) ceil($words / 200));
        }
    }
?>

<!DOCTYPE html>
<!-- saved from url=(0065)https://mahathi.salesnanny.com/blogs/lorem-ipsum-dolor-sit-amet-3 -->
<html lang="en-US"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <title>Guidewire Testing: Building a Scalable QA Framework — Mahathi Infotech</title>
    <link rel="canonical" href="https://mahathi.salesnanny.com/blogs/lorem-ipsum-dolor-sit-amet-3">
    <meta name="title" content="Guidewire Testing: Building a Scalable QA Framework — Mahathi Infotech">
    <meta name="description" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mahathi.salesnanny.com/blogs/lorem-ipsum-dolor-sit-amet-3">
    <meta property="og:title" content="Guidewire Testing: Building a Scalable QA Framework — Mahathi Infotech">
    <meta property="og:description" content="">
    <meta property="og:image" content="https://mahathi.salesnanny.com/wp-content/uploads/2026/05/C_Property_Ca.jpeg">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://mahathi.salesnanny.com/blogs/lorem-ipsum-dolor-sit-amet-3">
    <meta property="twitter:title" content="Guidewire Testing: Building a Scalable QA Framework — Mahathi Infotech">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content="https://mahathi.salesnanny.com/wp-content/uploads/2026/05/C_Property_Ca.jpeg">
    <link rel="preload" href="https://mahathi.salesnanny.com/wp-content/themes/salesnanny/assets/inter_5.2.6_latin-wght-normal.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://mahathi.salesnanny.com/wp-content/themes/salesnanny/assets/salesnanny-favi-logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://mahathi.salesnanny.com/wp-content/themes/salesnanny/assets/salesnanny-favi-logo.png">

    <!-- Mahathi Brand Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
/* ── MAHATHI BRAND TOKENS ─────────────────────────────────────────── */
:root {
  --sage:        #76A379;
  --forest:      #253830;
  --cream:       #EEF0EC;
  --mint:        #B2C7B3;
  --gold:        #D2A974;
  --pink:        #B88794;
  --mint-border: #C8D9C9;
  --font-display:'Bebas Neue', Impact, sans-serif;
  --font-body:   'IBM Plex Sans', system-ui, sans-serif;
  --font-mono:   'DM Mono', monospace;
}
/* Override article typography to brand spec */
body { font-family: var(--font-body) !important; background: var(--cream) !important; color: var(--forest) !important; font-size:15px; line-height:1.78; }
.sblog-title { font-family: var(--font-display) !important; color: var(--forest) !important; letter-spacing:.02em; }
.sblog-content h2, .sblog-content h3 { font-family: var(--font-display) !important; color: var(--forest) !important; letter-spacing:.02em; }
.sblog-content { font-family: var(--font-body) !important; font-size:15px; line-height:1.78; color: var(--forest) !important; }
.sblog-content p { color: var(--forest); }
.sblog-meta { font-family: var(--font-mono) !important; font-size:11px; text-transform:uppercase; letter-spacing:.10em; }
.sblog-meta a { color: var(--sage) !important; }
.sblog-dot { background: var(--sage) !important; }
.sblog-read { color: var(--sage) !important; }
/* Actions bar */
.sblog-actions button { background: #fff !important; border: 1px solid var(--mint-border) !important; color: var(--forest) !important; border-radius:8px !important; }
.sblog-actions button:hover { background: var(--sage) !important; color: #fff !important; border-color: var(--sage) !important; }
button.sblog-voted { background: var(--sage) !important; color: #fff !important; }
/* Hero image */
.sblog-hero { background: var(--cream) !important; border: 1px solid var(--mint-border) !important; }
/* Divider */
.sblog-divider { background: var(--mint-border) !important; }
/* Author box */
.author-wrap { background: var(--cream) !important; border: 1px solid var(--mint-border) !important; }
.author-wrap .entry-title { font-family: var(--font-display) !important; font-size:22px; color: var(--forest) !important; }
.author-wrap .author-designation { color: var(--sage) !important; font-family: var(--font-mono) !important; font-size:11px; text-transform:uppercase; letter-spacing:.10em; }
.author-wrap .author-content .entry-description { font-family: var(--font-body) !important; color: var(--forest) !important; }
.author-wrap .author-content .axil-social ul li a { border-color: var(--mint-border) !important; color: var(--forest) !important; }
.author-wrap .author-content .axil-social ul li a:hover { background: var(--sage) !important; border-color: var(--sage) !important; color:#fff !important; }
/* Post navigation */
.post-navigation { border-color: var(--mint-border) !important; }
.post-navigation .post-box .entry-title a { color: var(--forest) !important; }
.post-navigation .post-box .entry-title a:hover { color: var(--sage) !important; }
.post-navigation .post-box .text-box { color: var(--sage) !important; font-family: var(--font-mono) !important; font-size:10px; text-transform:uppercase; letter-spacing:.09em; }
.post-navigation .post-box.prev-post::before { background: var(--mint-border) !important; }
/* Comment form */
.post-comment .section-heading h3, .leave-comment .section-heading h3 { font-family: var(--font-display) !important; color: var(--forest) !important; letter-spacing:.02em; }
.main-comment-form { border-color: var(--mint-border) !important; background: #fff !important; }
.main-comment-form .input-clean, .main-comment-form .textarea-clean { background: var(--cream) !important; border-color: var(--mint-border) !important; color: var(--forest) !important; }
.main-comment-form .input-clean:focus, .main-comment-form .textarea-clean:focus { border-color: var(--sage) !important; }
.axil-btn.clean-submit { background: var(--forest) !important; border-color: var(--forest) !important; font-family: var(--font-display) !important; font-size:17px; letter-spacing:.05em; }
.axil-btn.clean-submit:hover { background: var(--sage) !important; border-color: var(--sage) !important; }
/* Right promo card */
.sblog-promo-card { border-color: var(--mint-border) !important; }
.sblog-promo-top { background: linear-gradient(135deg, var(--forest), #2d4840) !important; }
.sblog-promo-cta { border-color: var(--sage) !important; color: var(--sage) !important; font-family: var(--font-display) !important; font-size:17px; letter-spacing:.05em; }
.sblog-promo-cta:hover { background: var(--sage) !important; color:#fff !important; }
.sblog-promo-dot, .sblog-dot { background: rgba(118,163,121,.15) !important; color: var(--sage) !important; }
/* Related articles */
.sblog-related-section .title { font-family: var(--font-display) !important; color: var(--forest) !important; letter-spacing:.02em; }
.sblog-related-section .post-box .entry-title a { color: var(--forest) !important; }
.sblog-related-section .post-box .entry-title a:hover { color: var(--sage) !important; }
.sblog-related-section .post-box .entry-category ul li a { background: rgba(118,163,121,.12) !important; border-color: rgba(118,163,121,.3) !important; color: var(--forest) !important; }
/* Newsletter */
.newsletter-box { background: linear-gradient(135deg, var(--forest), #2d4840) !important; border-color: var(--mint-border) !important; }
.newsletter-box .entry-title { color: var(--cream) !important; font-family: var(--font-display) !important; font-size:32px; letter-spacing:.02em; }
.newsletter-box .entry-description { color: var(--mint) !important; }
.newsletter-form { border-color: rgba(178,199,179,.3) !important; background: rgba(238,240,236,.08) !important; }
.newsletter-form .email-input { color: var(--cream) !important; }
.newsletter-form .axil-btn { background: var(--sage) !important; border-color: var(--sage) !important; font-family: var(--font-display) !important; font-size:16px; letter-spacing:.04em; }
/* Breadcrumb */
.breadcrumb-wrap-layout1 { background: linear-gradient(180deg,rgba(118,163,121,.12),rgba(118,163,121,.06)) !important; border-color: rgba(118,163,121,.25) !important; }
.breadcrumb-layout1 .breadcrumb a { color: var(--sage) !important; }
.breadcrumb-layout1 .breadcrumb .active { color: var(--forest) !important; }
/* FAQ */
.faq-title { font-family: var(--font-display) !important; color: var(--forest) !important; letter-spacing:.02em; }
.faq-question h3 { font-family: var(--font-body) !important; }
.faq-number { color: var(--sage) !important; }
.faq-toggle { color: var(--sage) !important; }
.faq-item.active { border-color: var(--sage) !important; }
.sblog-content h2 { color: var(--forest) !important; }
.sblog-content h3 { color: var(--forest) !important; }
.sblog-meta .sblog-sep { color: var(--mint) !important; }
    </style>
</head>
<body>
<div class="advanced-grid-bg"></div>

<style>
html {
    overflow-x: hidden;
    scroll-behavior: smooth;
    filter: contrast(1.1);
}
svg { filter: contrast(1.1) !important; }

@font-face {
    font-family: 'Inter';
    src: url('https://mahathi.salesnanny.com/wp-content/themes/salesnanny/assets/inter_5.2.6_latin-wght-normal.woff2') format('woff2');
    font-weight: 100 900;
    font-style: normal;
    font-display: swap;
}
.fa-solid, .fas { font-family: "Font Awesome 6 Free" !important; font-weight: 900 !important; }
.fa-regular, .far { font-family: "Font Awesome 6 Free" !important; font-weight: 400 !important; }
.fa-brands, .fab { font-family: "Font Awesome 6 Brands" !important; font-weight: 400 !important; }
*, *::before, *::after { box-sizing: border-box; }
* { margin: 0; padding: 0; }
label, input, textarea, select, button { font-family: "Inter" !important; font-weight: 500; }
body { letter-spacing: -0.04em; color: white; overflow-y: auto; overflow-x: hidden; scroll-behavior: smooth; position: relative; }
.icon-arrow-up { width: 18px; height: 18px; stroke: currentColor; stroke-width: 2.5; }
</style>

<!-- ══ UTILITY BAR ══════════════════════════════════════════════════════ -->
<div style="width:100%;background:#76A379;position:sticky;top:0;z-index:1001;">
  <div style="max-width:1380px;margin:0 auto;padding-inline:clamp(20px,4vw,56px);display:flex;justify-content:flex-end;align-items:center;padding-top:7px;padding-bottom:7px;gap:0;">
    <span style="font-family:'DM Mono',monospace;font-size:11px;text-transform:uppercase;letter-spacing:.10em;color:#fff;padding:3px 14px;cursor:pointer;opacity:.9;">Locations</span>
    <span style="color:rgba(255,255,255,.35);padding:0 2px;">|</span>
    <span style="font-family:'DM Mono',monospace;font-size:11px;text-transform:uppercase;letter-spacing:.10em;color:#fff;padding:3px 14px;cursor:pointer;opacity:.9;">Awards</span>
    <span style="color:rgba(255,255,255,.35);padding:0 2px;">|</span>
    <span style="font-family:'DM Mono',monospace;font-size:11px;text-transform:uppercase;letter-spacing:.10em;color:#fff;padding:3px 14px;cursor:pointer;opacity:.9;">Certifications</span>
    <span style="color:rgba(255,255,255,.35);padding:0 2px;">|</span>
    <span style="font-family:'DM Mono',monospace;font-size:11px;text-transform:uppercase;letter-spacing:.10em;color:#fff;padding:3px 14px;cursor:pointer;opacity:.9;">Careers</span>
    <span style="color:rgba(255,255,255,.35);padding:0 2px;">|</span>
    <span style="font-family:'DM Mono',monospace;font-size:11px;text-transform:uppercase;letter-spacing:.10em;color:#fff;padding:3px 14px;cursor:pointer;opacity:.9;display:inline-flex;align-items:center;gap:6px;"><i class="fa-solid fa-magnifying-glass" style="font-size:10px;"></i> Search</span>
  </div>
</div>

<!-- ══ MAIN HEADER ══════════════════════════════════════════════════════ -->
<header style="width:100%;background:#fff;position:sticky;top:34px;z-index:1000;border-bottom:1px solid #C8D9C9;box-shadow:0 1px 4px rgba(37,56,48,.08);">
  <div style="max-width:1380px;margin:0 auto;padding-inline:clamp(20px,4vw,56px);display:flex;align-items:center;justify-content:space-between;padding-top:15px;padding-bottom:15px;">
    <a href="https://mahathiinfotech.com/" style="text-decoration:none;display:flex;align-items:center;">
      <img src="https://www.mahathiinfotech.com/assets/images/mahathi_logo2.png" alt="Mahathi Infotech" width="160" height="36" style="height:auto;">
    </a>
    <nav style="display:flex;list-style:none;gap:0;align-items:center;">
      <a href="https://mahathiinfotech.com/" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#253830;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#76A379'" onmouseout="this.style.color='#253830'">Insurance Solutions</a>
      <a href="https://mahathiinfotech.com/" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#253830;text-decoration:none;" onmouseover="this.style.color='#76A379'" onmouseout="this.style.color='#253830'">Healthcare Solutions</a>
      <a href="https://mahathiinfotech.com/ai-enablement" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#253830;text-decoration:none;" onmouseover="this.style.color='#76A379'" onmouseout="this.style.color='#253830'">AI Enablement</a>
      <a href="https://mahathiinfotech.com/digital-services" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#253830;text-decoration:none;" onmouseover="this.style.color='#76A379'" onmouseout="this.style.color='#253830'">Digital Services</a>
      <a href="blogs-landing.html" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#76A379;text-decoration:none;">News</a>
      <a href="https://mahathiinfotech.com/about-us" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#253830;text-decoration:none;" onmouseover="this.style.color='#76A379'" onmouseout="this.style.color='#253830'">About Us</a>
      <a href="https://mahathiinfotech.com/contact-us" style="display:block;padding:8px 13px;font-family:'Bebas Neue',Impact,sans-serif;font-size:14.5px;letter-spacing:.06em;color:#253830;text-decoration:none;" onmouseover="this.style.color='#76A379'" onmouseout="this.style.color='#253830'">Contact Us</a>
    </nav>
    <button id="mobileMenuBtn" style="display:none;flex-direction:column;justify-content:space-around;width:28px;height:22px;background:none;border:none;cursor:pointer;" aria-label="Menu">
      <span style="width:100%;height:2px;background:#253830;border-radius:2px;display:block;"></span>
      <span style="width:100%;height:2px;background:#253830;border-radius:2px;display:block;"></span>
      <span style="width:100%;height:2px;background:#253830;border-radius:2px;display:block;"></span>
    </button>
  </div>
</header>

<!-- Breadcrumb -->
<section class="breadcrumb-wrap-layout1">
  <div class="container">
    <div class="breadcrumb-layout1">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li><a href="https://mahathi.salesnanny.com/">Home</a></li>
          <li><a href="blogs-landing.html">Guidewire</a></li>
          <li class="active" aria-current="page">Guidewire Testing</li>
        </ol>
      </nav>
    </div>
  </div>
</section>

<style>
/* ========== ORIGINAL TEMPLATE STYLES — UNTOUCHED ========== */
:root{
  --bg:#fff; --text:#111; --muted:#5a6575; --soft:#f4f6f8; --soft2:#eef1f4;
  --brand:#76A379; --brand-600:#618E67; --accent:#76A379; --green:#76A379;
  --font-main:'Poppins', sans-serif; --font-secondary:'Poppins', sans-serif;
  --sage-light:#B2C7B3; --sage-muted:rgba(118, 163, 121, 0.12);
  --color-body: #494e51; --color-dark-1: #2E2E2E; --color-border-dark-1: #303030;
  --color-light-1: #ffffff; --color-light-2: #F5F5F5; --color-mimosa: #EAF2EB;
  --color-perano: #DCE9DD; --color-primary: #76A379; --color-btn-bg: #76A379;
  --color-heading-1: #B2C7B3; --color-meta-dark-1: #6b7074; --color-scandal: #DDEADF;
  --color-selago: #F1D1FC; --color-old-lace: #FDEDDD;
  --transition: all 0.3s ease-in-out;
  --shadow: 0 10px 28px rgba(16,24,40,.08);
  --line: #303030;
}
body { color: var(--color-body); font-family: var(--font-main); }
header { position: sticky !important; }
h1, h2, h3, h4 { font-weight: 600; color: #000; line-height: 1.3; font-family: var(--font-main); }
.breadcrumb-wrap-layout1, .sblog-post-container, .sblog-outer-section { font-family: var(--font-main); }

.sblog-post-container{max-width:1320px;margin:56px auto 32px auto;padding:0 20px;display:grid;gap:18px;grid-template-columns:60px minmax(0, 1fr) 320px}
.sblog-actions{position:sticky; top:180px; width:40px; height:317px; display:grid; grid-template-rows:repeat(6,40px); row-gap:20px; justify-items:center; align-items:center;}
.sblog-actions button{width:40px;height:40px;border-radius:12px;border:none;cursor:pointer; background:#f0f2f5;color:#444;font-size:18px; display:flex;align-items:center;justify-content:center; transition:background .2s,transform .05s,color .2s; box-shadow: rgba(0, 0, 0, 0.12) 0px 0px 2px 0px, rgba(0, 0, 0, 0.14) 0px 2px 4px 0px; position: relative;}
.sblog-actions button:hover{background:var(--soft2); border-radius:5px;}
.sblog-actions button:active{transform:scale(.98)}
.sblog-actions .sblog-count{position:absolute;top:-6px;right:-6px;min-width:18px;height:18px;padding:0 5px;border-radius:999px;background:var(--brand);color:#fff;font:700 11px/18px var(--font-main);text-align:center}
button.sblog-voted{background:var(--sage-muted) !important;color:var(--brand-600)}
.sblog-actions .sblog-saved{background:var(--sage-muted);color:var(--brand-600)}
@media (max-width:1024px){
  .sblog-post-container{grid-template-columns:1fr; gap:24px; padding:0 16px; margin-top:36px;}
  .sblog-right{display:none}
}
@media (max-width:1024px) and (min-width:769px){
  .sblog-actions{position:relative;top:0;width:100%;height:auto;row-gap:0;display:flex;align-items:center;justify-content:center;gap:14px;margin-bottom:8px;}
  .sblog-actions button{width:44px;height:44px;font-size:18px;}
  .sblog-actions .sblog-count{top:-8px;right:-8px;min-width:20px;height:20px;font-size:12px;line-height:20px;}
}
@media (max-width:768px){
  .sblog-post-container{grid-template-columns:1fr !important;gap:0; margin-top: 40px;}
  .sblog-actions{position:fixed !important;bottom:12px !important;left:0 !important;right:0 !important;top:auto !important;height:64px !important;width:calc(100% - 32px) !important;background:#fff;border:2px solid var(--line);display:flex !important;flex-direction:row !important;justify-content:space-around;align-items:center;z-index:999;padding:8px 10px;box-shadow:0 -4px 12px rgba(0,0,0,0.08);grid-template-rows:none !important;row-gap:0 !important;margin:0 auto;border-radius:50px;}
  .sblog-actions button{width:40px !important;height:40px !important;font-size:20px;border-radius:50% !important;flex-shrink:0;}
  .sblog-actions button:hover{background:#e0e4e8;transform:scale(1.05);}
  .sblog-actions .sblog-count{top:-4px;right:-4px;min-width:20px;height:20px;font-size:11px;line-height:20px;}
  .sblog-article{padding-bottom:100px}
}
@media (max-width:480px){
  .sblog-actions{height:65px !important;padding:6px 8px;}
  .sblog-actions button{width:45px !important;height:45px !important;font-size:18px;}
  .sblog-actions .sblog-count{min-width:18px;height:18px;font-size:10px;line-height:18px;top:-3px;right:-3px;}
}

.sblog-article{}
.sblog-title{font-size:2.3rem;line-height:1.4;margin:0 0 20px;letter-spacing:.2px; font-weight: 700;}
.sblog-meta{color:var(--muted);font-size:.95rem;margin:0 0 16px}
.sblog-meta .sblog-author a{color:#0f172a;text-decoration:underline dotted}
.sblog-meta .sblog-sep{margin:0 6px;color:#c0c4cc}
.sblog-meta .sblog-read{color:var(--brand-600)}
.sblog-meta .sblog-read .sblog-dot{display:inline-block;width:7px;height:7px;border-radius:50%;background:var(--green);margin:0 8px 2px 6px}
.sblog-divider{height:1px;background:var(--line);margin:14px 0 18px}
.sblog-hero{background:#f1f2f4;border-radius:12px;padding:14px;box-shadow:var(--shadow)}
.sblog-hero img{width:100%;height:auto;border-radius:8px;display:block}
.sblog-fig-strip{display:flex;align-items:center;gap:10px;margin-top:8px;color:#6b7280;font-size:.78rem}
.sblog-fig-strip .sblog-bullet{width:8px;height:8px;border-radius:50%;background:#cbd5e1}
.sblog-content{font-size:1rem; color: #272727;text-align: justify;}
.sblog-content p{margin:0 0 1.15em}
.sblog-content ul,.sblog-content ol{padding-left:1.2em;margin:0 0 1.1em}
.sblog-content blockquote{margin:1.4em 0;padding:14px 18px;border-left:4px solid var(--brand);background:var(--soft);border-radius:10px;color:#333}
.sblog-content h2{font-family:var(--font-secondary, inherit);font-weight:600;font-size:2rem;line-height:1.35;margin:1.2em 0 .6em;color:#74AB77;}
.sblog-content h3{font-family:var(--font-secondary, inherit);font-weight:600;font-size:1.4rem;line-height:1.45;margin:1.1em 0 .6em;color:#74AB77;}
.sblog-content h4{font-family:var(--font-secondary, inherit);font-weight:600;font-size:1.15rem;margin:1em 0 .5em;color:#000}
.sblog-content a{color:var(--brand);text-decoration:none}
.sblog-content a:hover{color:var(--color-primary)}
.sblog-content .list-style-1{list-style:none;padding:0;margin:0 0 25px}
.sblog-content .list-style-1 li{position:relative;padding-left:24px;margin:0 0 10px}
.sblog-content .list-style-1 li:before{content:"";position:absolute;left:0;top:.6em;width:8px;height:8px;border-radius:50%;background:var(--color-body)}
.sblog-content blockquote{position:relative;background:var(--color-old-lace);border-left:5px solid var(--color-perano);border-radius:8px;padding:28px 24px;margin:22px 0;color:var(--color-body)}
.sblog-content blockquote p{font-style:italic;margin:0 0 .6em}
.sblog-content blockquote cite{display:block;opacity:.85;font-size:.95em}
.sblog-content figure{margin:0 0 18px}
.sblog-content figure img{border-radius:8px;display:block;width:100%;height:auto}
.sblog-content .figure-caption, .sblog-content figcaption{margin-top:8px;color:var(--color-body);font-size:.95rem;text-align:center}
.sblog-content .wp-block-columns{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin:18px 0}
@media(max-width:768px){.sblog-content .wp-block-columns{grid-template-columns:1fr}}
.sblog-content .wp-block-gallery, .sblog-content .blocks-gallery-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
@media(max-width:640px){.sblog-content .wp-block-gallery, .sblog-content .blocks-gallery-grid{grid-template-columns:1fr}}
.sblog-content .blocks-gallery-item img{border-radius:8px}
.sblog-content .wp-block-button .wp-block-button__link{background:var(--color-btn-bg);border:1px solid var(--color-border-dark-1);color:#000;border-radius:8px;padding:10px 18px;font-weight:600}
.sblog-content .wp-block-button .wp-block-button__link:hover{background:transparent;transform:translate(-3px,-3px);box-shadow:3px 3px 0 0 var(--color-border-dark-1)}
.sblog-content table{width:100%;border-collapse:collapse;margin:16px 0;border:1px solid var(--color-border-dark-1);display:block;overflow-x:auto;white-space:nowrap}
.sblog-content th,.sblog-content td{border:1px solid var(--color-border-dark-1);padding:10px}
.sblog-content th{background:var(--color-light-2);text-align:left}
.sblog-content .wp-block-separator{border:none;height:1px;background:var(--color-border-dark-1);margin:28px 0;opacity:.6}
.sblog-content ul{list-style:none;padding-left:24px}
.sblog-content ul li{position:relative;padding-left:14px}
.sblog-content ul li::before{content:"";position:absolute;left:0;top:.7em;width:0;height:0;border-left:7px solid var(--color-body);border-top:5px solid transparent;border-bottom:5px solid transparent}
.sblog-content .box-border-dark-1{border:1px solid var(--color-border-dark-1);border-radius:8px}
.sblog-content .figure-holder{border-radius:6px;overflow:hidden}
.sblog-content .figure-holder img{border-radius:6px;display:block;width:100%;height:auto}
.breadcrumb-wrap-layout1{padding:10px 0;background:linear-gradient(180deg, rgba(118,163,121,0.16) 0%, rgba(118,163,121,0.10) 100%);border-bottom:1px solid rgba(97,142,103,0.35);position:sticky;z-index:1;top:80px}
.breadcrumb-layout1 .breadcrumb{display:flex;gap:8px;list-style:none;margin:0;padding:0;color:var(--brand-600);flex-wrap:wrap;justify-content: center;}
.breadcrumb-layout1 .breadcrumb li{display:flex;align-items:center;gap:8px}
.breadcrumb-layout1 .breadcrumb li+li:before{content:"/";color:var(--brand-600);opacity:.65}
.breadcrumb-layout1 .breadcrumb a{color:var(--brand-600);text-decoration:none;font-weight:500}
.breadcrumb-layout1 .breadcrumb a:hover{color:var(--brand)}
.breadcrumb-layout1 .breadcrumb .active{color:#253830;font-weight:600;word-break:break-word}
.sblog-right{position:sticky;top:180px;align-self:start;height:fit-content}
.sblog-promo{position:relative}
.sblog-promo-card{border-radius:16px;border:1px solid var(--line);overflow:hidden;background:#fff;box-shadow:var(--shadow)}
.sblog-promo-top{background:linear-gradient(145deg,#618E67,#253830);color:#fff;padding:16px 16px 14px}
.sblog-promo-figure{width:56px;height:56px;border-radius:12px;overflow:hidden;box-shadow:0 8px 18px rgba(0,0,0,.25);float:left;margin-right:12px}
.sblog-promo-figure img{width:100%;height:100%;object-fit:cover}
.sblog-promo-mini{opacity:.85;margin:0;font-size:.9rem}
.sblog-promo-title{font-size:1.5rem;line-height:1.25;margin:.35rem 0 0;font-weight:800; color: #fff;}
.sblog-promo-body{padding:16px}
.sblog-promo-features{display:grid;grid-template-columns:1fr;gap:10px 16px;margin:6px 0 14px}
.sblog-promo-features .sblog-feat{display:flex;align-items:center;gap:10px;color:#2a2f3a}
.sblog-promo-features .sblog-dot{width:20px;height:20px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;background:var(--sage-muted);color:var(--brand);flex:0 0 20px}
.sblog-promo-cta{display:block;text-align:center;border:2px solid var(--brand);color:var(--brand);font-weight:800;border-radius:10px;padding:12px 16px;margin-top:10px;transition:background .2s,color .2s;text-decoration: none;}
.sblog-promo-cta:hover{background:var(--brand);color:#fff}
.sblog-overlay{position:fixed;inset:0;background:rgba(0,0,0,.45);opacity:0;visibility:hidden;transition:.25s;z-index:98}
.sblog-overlay.on{opacity:1;visibility:visible}
.sblog-panel{position:fixed;top:0;right:-420px;width:100%;max-width:400px;height:100vh;background:#fff;box-shadow:-10px 0 30px rgba(0,0,0,.15);z-index:99;transition:right .35s cubic-bezier(.25,.46,.45,.94);display:flex;flex-direction:column}
.sblog-panel.on{right:0}
.sblog-panel-head{padding:12px 14px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:10px}
.sblog-ph-title{font-weight:700;font-size:1rem;margin:0}
.sblog-ph-count{font-size:.85rem;color:var(--muted)}
.sblog-x{margin-left:auto;font-size:24px;border:none;background:none;color:#666;cursor:pointer}
.sblog-panel-guide{font-size:.85rem;color:var(--muted);padding:10px 14px;border-bottom:1px solid var(--line)}
.sblog-panel-body{flex:1;overflow:auto;padding:16px}
.sblog-c-filter{margin:0 0 12px}
.sblog-c-filter select{border:1px solid var(--line);padding:8px 10px;border-radius:6px;background:#fff}
#commentform textarea,#commentform input[type=text],#commentform input[type=email]{width:100%;border:1px solid var(--line);border-radius:8px;padding:12px;font-family:inherit;font-size:1rem}
#commentform textarea{min-height:110px}
#commentform #submit{align-self:flex-end;border:none;border-radius:20px;background:var(--brand);color:#fff;padding:10px 16px;cursor:pointer}
#commentform #submit:hover{background:var(--brand-600)}
.logged-in-as{font-size:.85rem;color:var(--muted)}
.sblog-toast{position:fixed;bottom:24px;right:24px;background:#111;color:#fff;padding:10px 14px;border-radius:8px;opacity:0;transform:translateY(6px);transition:.25s;z-index:120}
.sblog-toast.show{opacity:1;transform:none}

.author-wrap { margin: 90px 0 40px; padding: 95px 30px 30px; border-radius: 8px; text-align: center; position: relative; background-color: var(--color-mimosa); }
.author-wrap .author-thumb { max-width: 120px; width: 100%; margin: 0 auto; position: absolute; top: -60px; left: 0; right: 0; border: 1px solid var(--color-border-dark-1); border-radius: 50%; }
.author-wrap .author-thumb img { border-radius: 50%; width: 100%; height: auto; display: block; }
.author-wrap .author-content .entry-title { margin: 0 0 5px; font-size: 20px; }
.author-wrap .author-content .author-designation { margin-bottom: 15px; font-size: 16px; font-weight: 500; color: #000; }
.author-wrap .author-content .entry-description { max-width: 480px; margin: 0 auto 20px; font-size: 1rem; color: var(--color-body); }
.author-wrap .author-content .axil-social ul { list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; gap: 12px; }
.author-wrap .author-content .axil-social ul li a { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; border: 1px solid var(--color-border-dark-1); color: var(--color-meta-dark-1); font-size: 14px; text-decoration: none; transition: var(--transition); }
.author-wrap .author-content .axil-social ul li a:hover { background-color: var(--color-primary); border-color: var(--color-primary); color: var(--color-light-1); }
@media (max-width: 1024px) { .author-wrap { margin: 60px 0 30px; padding: 80px 24px 24px; } }
@media (max-width: 768px) { .author-wrap { margin: 48px 0 24px; padding: 72px 18px 20px; } .author-wrap .author-thumb { max-width: 100px; top: -50px; } }

.post-navigation { display: flex; justify-content: space-between; margin: 40px 0; padding: 40px 0; border-width: 1px 0; border-style: solid; border-color: var(--line); gap: 20px; }
.post-navigation .post-box { flex: 1; display: flex; align-items: center; gap: 15px; min-width: 0; }
.post-navigation .post-box .figure-holder { flex-shrink: 0; width: 90px; height: 90px; }
.post-navigation .post-box .figure-holder img { width: 100%; height: auto; object-fit: cover; border-radius: 50%; border: 2px solid var(--color-border-dark-1); }
.post-navigation .post-box .content-holder { flex: 1; min-width: 0; }
.post-navigation .post-box .text-box { font-size: 14px; margin-bottom: 5px; display: inline-flex; align-items: center; gap: 5px; color: #000; text-decoration: none; }
.post-navigation .post-box .entry-title { margin: 0; font-size: 1.1rem; line-height: 1.4; font-weight: 600; }
.post-navigation .post-box .entry-title a { color: #000; text-decoration: none; transition: var(--transition); }
.post-navigation .post-box .entry-title a:hover { color: var(--color-primary); }
.post-navigation .post-box.prev-post { padding-right: 30px; position: relative; }
.post-navigation .post-box.prev-post::before { content: ""; height: 50px; width: 1px; background-color: var(--line); position: absolute; right: 0; top: 50%; transform: translateY(-50%); }
.post-navigation .post-box.next-post { text-align: right; flex-direction: row-reverse; }
@media (max-width: 768px) {
    .post-navigation { flex-direction: column; gap: 30px; align-items: center; text-align: center; }
    .post-navigation .post-box.prev-post::before { display: none; }
    .post-navigation .post-box.prev-post, .post-navigation .post-box.next-post { padding: 0; flex-direction: column; }
}

.sblog-outer-section { max-width: 1320px; margin: 48px auto; padding: 0 20px; }

.newsletter-box { text-align: center; padding: 48px 28px; position: relative; z-index: 1; border: 1px solid var(--color-border-dark-1); border-radius: 8px; background-color: var(--color-perano); overflow: hidden; }
.newsletter-box .entry-title { font-size: 1.5rem; font-weight: 700; color: #000; margin: 0 auto 10px; }
.newsletter-box .entry-description { max-width: 400px; margin: 0 auto 25px; color: #000; }
.newsletter-form { margin-top: 10px; display: inline-flex; align-items: center; background-color: var(--color-light-1); border: 1px solid var(--color-border-dark-1); border-radius: 8px; padding: 5px; transition: var(--transition); }
.newsletter-form:hover { transform: translateY(-3px) translateX(-3px); box-shadow: 3px 3px 0px 0px var(--color-border-dark-1); }
.newsletter-form .icon-holder { padding-left: 15px; font-size: 20px; }
.newsletter-form .email-input { background-color: transparent; border: 0; height: 40px; width: min(250px, 70vw); padding: 2px 15px; color: #000; }
.newsletter-form .email-input:focus { outline: none; }
.newsletter-form .axil-btn { height: 40px; background-color: var(--color-btn-bg); border: 1px solid var(--brand-600); border-radius: 8px; font-size: 1rem; padding: 0 20px; cursor: pointer; display: flex; align-items: center; gap: 8px; color: #fff; }
.newsletter-box .elements-wrap { list-style: none; padding: 0; margin: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.5; }
.newsletter-box .elements-wrap li { position: absolute; }
.newsletter-box .elements-wrap li:nth-child(1) { bottom: 33px; left: 27px; }
.newsletter-box .elements-wrap li:nth-child(2) { top: 0; right: 0; }
@media (max-width: 600px) {
    .newsletter-form { flex-direction: column; width: 100%; background: transparent; border: none; box-shadow: none !important; transform: none !important; }
    .newsletter-form .email-input { width: 100%; background-color: var(--color-light-1); border: 1px solid var(--color-border-dark-1); border-radius: 8px; margin-bottom: 10px; }
    .newsletter-form .axil-btn { width: 100%; justify-content: center; }
    .newsletter-box { padding: 28px 16px; }
}
@media (max-width: 575px) { .breadcrumb-layout1 .breadcrumb { font-size: 0.85rem; gap: 6px; } }

.sblog-title { font-size: clamp(1.8rem, 3.2vw, 2.45rem); line-height: 1.3; margin-bottom: 16px; color: #74AB77; }
.sblog-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; font-size: 0.98rem; line-height: 1.6; }
.sblog-content { font-size: 1.06rem; line-height: 1.8; }
.sblog-content h2 { font-size: clamp(1.45rem, 2.1vw, 2rem); margin-top: 1.55em; }
.sblog-content h3 { font-size: clamp(1.2rem, 1.7vw, 1.5rem); }
.sblog-content p, .sblog-content li { line-height: 1.75; }
@media (max-width: 1024px) { .sblog-post-container { gap: 24px; padding: 0 16px; } .sblog-content { font-size: 1.02rem; } }
@media (max-width: 768px) {
    .sblog-title { text-align: left; }
    .sblog-meta { font-size: 0.92rem; gap: 6px; }
    .sblog-content { font-size: 1rem; line-height: 1.7; }
    .breadcrumb-wrap-layout1 { top: 64px; padding: 8px 0; }
    .sblog-outer-section { margin: 36px auto; padding: 0 16px; }
    .post-navigation .post-box .figure-holder { width: 72px; height: 72px; }
    .sblog-panel { max-width: 100%; right: -100%; }
    .sblog-toast { right: 12px; left: 12px; bottom: 86px; text-align: center; }
}
</style>

<div class="sblog-post-container">
    <!-- Left actions -->
    <aside class="sblog-actions" aria-label="Quick actions">
        <button id="listenBtn" title="Listen to this article"><i class="fa-solid fa-headphones"></i></button>
        <button id="likeBtn" title="Like this article"><i class="fa-regular fa-heart"></i></button>
        <button id="shareBtn" title="Share this article"><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
        <button id="saveBtn" title="Save for later"><i class="fa-regular fa-bookmark"></i></button>
    </aside>

    <!-- Main article -->
    <article class="sblog-article" id="post-132">
        <h1 class="sblog-title">Guidewire Testing: Building a Scalable QA Framework for Enterprise Insurance</h1>
        <div class="sblog-meta">
            <span class="sblog-author">Story by <a href="https://mahathiinfotech.com/">James Whitfield</a></span>
            <span class="sblog-sep">•</span><span>June 2, 2026</span>
            <span class="sblog-sep">•</span><span class="sblog-read"><span class="sblog-dot"></span>7 min read</span>
        </div>
        <div class="sblog-divider"></div>
        <figure class="sblog-hero">
            <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=1200&auto=format&fit=crop&q=80" alt="Guidewire Testing — QA Framework for Enterprise Insurance" style="width:100%;height:auto;border-radius:8px;display:block;" loading="eager">
        </figure>
        <div class="sblog-content">
            <p class="wp-block-paragraph">By James Whitfield &nbsp;|&nbsp; June 2, 2026 &nbsp;|&nbsp; Guidewire</p>
            <hr class="wp-block-separator has-alpha-channel-opacity">
            <h3 class="wp-block-heading">Introduction</h3>
            <p class="wp-block-paragraph">Enterprise insurance platforms built on Guidewire — PolicyCenter, ClaimCenter, and BillingCenter — are mission-critical systems where defects carry significant financial and regulatory consequences. As carriers accelerate their Guidewire Cloud migrations and release cadences increase, the pressure to deliver high-quality releases without slowing down development has never been greater. A scalable, automated testing framework is no longer optional — it is the foundation of competitive insurance operations.</p>
            <hr class="wp-block-separator has-alpha-channel-opacity">
            <h3 class="wp-block-heading">Why Guidewire Testing is Uniquely Complex</h3>
            <p class="wp-block-paragraph">Guidewire applications present testing challenges that general-purpose QA frameworks are poorly equipped to handle. Business rules across PolicyCenter, ClaimCenter, and BillingCenter are deeply interconnected — a change to a coverage configuration in PolicyCenter can cascade into billing calculations and claims reserves in ways that only surface under specific data conditions. Add to this the regulatory compliance requirements that vary by state, the frequent platform updates from Guidewire's quarterly Jutro releases, and the need to validate integrations with downstream systems like document management, payment gateways, and reinsurance platforms.</p>
            <p class="wp-block-paragraph">Traditional manual testing simply cannot keep pace. Organizations that rely on large manual regression teams find themselves in a perpetual cycle of delayed releases, escaped defects, and spiraling QA costs. Automation — when implemented correctly — breaks this cycle.</p>
            <hr class="wp-block-separator has-alpha-channel-opacity">
            <h3 class="wp-block-heading">Core Pillars of a Scalable Guidewire Testing Framework</h3>
            <p class="wp-block-paragraph"><strong>Modular Page Object Architecture:</strong> A well-designed Guidewire test framework separates UI interaction logic from test logic using the Page Object Model. This means that when Guidewire's Jutro UI framework updates — as it does regularly — test maintenance is isolated to the page object layer rather than requiring updates across hundreds of individual test cases. Teams that invest in this architecture upfront consistently achieve 70–80% reduction in maintenance overhead following platform upgrades.</p>
            <p class="wp-block-paragraph"><strong>Data-Driven Test Design:</strong> Insurance is inherently data-intensive. Effective Guidewire testing requires driving test scenarios with parameterized data sets that cover the full spectrum of policy types, jurisdiction rules, coverage combinations, and claim scenarios. Hardcoded test data is the single most common reason Guidewire automation suites fail to scale — data-driven design eliminates this brittleness entirely.</p>
            <p class="wp-block-paragraph"><strong>CI/CD Integration:</strong> Embedding automated test suites into Jenkins or GitLab pipelines enables continuous validation with every code commit. Smoke suites that run in under 15 minutes catch critical regressions before they reach staging. Full regression suites run in parallel overnight, providing comprehensive coverage without blocking developer productivity. The result is a release cycle measured in days rather than weeks.</p>
            <hr class="wp-block-separator has-alpha-channel-opacity">
            <h3 class="wp-block-heading">The Mahathi Approach to Guidewire QA</h3>
            <p class="wp-block-paragraph">At Mahathi Infotech, our Guidewire testing practice is built on over a decade of hands-on delivery across 30+ carriers. We bring pre-built test accelerators for PolicyCenter, ClaimCenter, and BillingCenter that dramatically reduce framework setup time — what typically takes six to eight months to build from scratch, our teams can deploy in six to eight weeks.</p>
            <p class="wp-block-paragraph">Our AI-augmented test generation capability analyses your Guidewire configuration and business rules to automatically generate baseline test cases, identify coverage gaps, and flag high-risk areas for deeper manual exploration. This means your QA investment is always focused on the areas of highest business risk — not on test case maintenance that delivers no incremental value.</p>
            <hr class="wp-block-separator has-alpha-channel-opacity">
            <h3 class="wp-block-heading">Security and Compliance Testing</h3>
            <p class="wp-block-paragraph">Insurance platforms handle some of the most sensitive personal and financial data in any industry. Comprehensive Guidewire testing must include security validation — penetration testing, vulnerability assessments, and access control verification — to meet HIPAA, SOC 2, and state regulatory requirements. Compliance testing for FROI/SROI filings, WCPOLS reporting, and CMS coordination must be woven into regression suites, not treated as a separate initiative.</p>
            <hr class="wp-block-separator has-alpha-channel-opacity">
            <h3 class="wp-block-heading">Conclusion</h3>
            <p class="wp-block-paragraph">A scalable Guidewire testing framework is not a one-time project — it is a strategic capability that compounds in value over time. Every test case added to your automation suite reduces the cost of future releases. Every defect caught before production protects your policyholders, your loss ratios, and your regulatory standing. For carriers serious about competing on the speed and reliability of their Guidewire platform, investment in testing excellence is the highest-return investment available.</p>
            <p class="wp-block-paragraph">Mahathi Infotech partners with carriers, TPAs, and MGAs to design, build, and operate world-class Guidewire testing programs. Contact our team to discuss where your current QA capability stands and what a roadmap to testing maturity looks like for your organisation.</p>
        </div>

        <!-- Author Box -->
        <div class="author-wrap">
            <div class="author-thumb"><img alt="James Whitfield" src="https://secure.gravatar.com/avatar/a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6?s=240&d=mm&r=g" class="avatar avatar-120 photo" height="120" width="120" decoding="async"></div>
            <div class="author-content">
                <h4 class="entry-title">James Whitfield</h4>
                <div class="author-designation">Senior Insurance Technology Analyst</div>
                <p class="entry-description">James Whitfield is a senior analyst at Mahathi Infotech specialising in Guidewire implementations, QA strategy, and insurance platform modernisation. With over 12 years in the industry, he has led testing programs for carriers across Workers' Comp, P&amp;C, and Life &amp; Annuity.</p>
                <div class="axil-social">
                    <ul>
                        <li><a aria-label="LinkedIn" href="https://www.linkedin.com/company/mahathi-infotech"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a aria-label="Twitter / X" href="https://mahathiinfotech.com/"><i class="fab fa-x-twitter"></i></a></li>
                        <li><a aria-label="Email" href="mailto:info@mahathiinfotech.com"><i class="fas fa-envelope"></i></a></li>
                        <li><a aria-label="Website" href="https://mahathiinfotech.com/"><i class="fas fa-globe"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Post Navigation -->
        <div class="post-navigation">
            <div class="post-box prev-post">
                <div class="figure-holder"><a href="blogs-landing.html"><img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=150&h=150&auto=format&fit=crop&q=80" alt="Insurance Solutions" style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:2px solid #C8D9C9;" loading="lazy"></a></div>
                <div class="content-holder">
                    <a href="blogs-landing.html" class="text-box"><i class="fas fa-arrow-left"></i> Previous Post</a>
                    <h3 class="entry-title"><a href="blogs-landing.html">End-to-End Insurance Solutions: P&C, Workers' Comp, and Life &amp; Annuity</a></h3>
                </div>
            </div>
            <div class="post-box next-post">
                <div class="figure-holder"><a href="blogs-landing.html"><img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=150&h=150&auto=format&fit=crop&q=80" alt="Guidewire Implementation" style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:2px solid #C8D9C9;" loading="lazy"></a></div>
                <div class="content-holder">
                    <a href="blogs-landing.html" class="text-box">Next Post <i class="fas fa-arrow-right"></i></a>
                    <h3 class="entry-title"><a href="blogs-landing.html">Guidewire Implementation: Delivering on Time, on Budget, at Enterprise Scale</a></h3>
                </div>
            </div>
        </div>
    </article>

    <!-- Right promo card -->
    <aside class="sblog-right">
        <div class="sblog-promo">
            <div class="sblog-promo-card" id="promoCard">
                <div class="sblog-promo-top">
                    <div class="sblog-promo-figure"><img src="https://www.mahathiinfotech.com/assets/images/mahathi_logo_White.png" alt="Mahathi Infotech" style="width:100%;height:100%;object-fit:contain;padding:6px;"></div>
                    <p class="sblog-promo-mini">Enterprise Insurance Technology</p>
                    <h3 class="sblog-promo-title">Mahathi Infotech Solutions</h3>
                    <div style="clear:both"></div>
                </div>
                <div class="sblog-promo-body">
                    <div class="sblog-promo-features">
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> Guidewire Testing</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> GW Implementation</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> Integrated Mailroom</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> Compliance-as-a-Service</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> SIU & Investigations</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> Quadient CCM</div>
                    </div>
                    <a class="sblog-promo-cta" href="https://mahathiinfotech.com/contact-us">Schedule a consultation</a>
                </div>
            </div>
        </div>
    </aside>
</div>

<!-- Original inner newsletter (kept exactly as original) -->
<!-- <section class="sblog-outer-section sblog-newsletter-section">
    <div class="newsletter-box">
        <h2 class="entry-title">Stay Ahead in Insurance Technology</h2>
        <p class="entry-description">Get the latest Guidewire testing strategies, Quadient CCM updates, and insurance technology insights delivered weekly.</p>
        <form action="#" class="newsletter-form">
            <span class="icon-holder"><i class="far fa-envelope"></i></span>
            <input type="email" class="email-input" placeholder="Email Address">
            <button type="submit" class="axil-btn">Subscribe <i class="fas fa-paper-plane"></i></button>
        </form>
        <ul class="elements-wrap"></ul>
    </div>
</section> -->

<div class="sblog-toast" id="toast">Copied link</div>

<!-- ══════════════════════════════════════════════════════════════════════
     BLOG-2 NEWSLETTER STRIP + FOOTER
     Fully namespaced — zero impact on any styles above
     ══════════════════════════════════════════════════════════════════════ -->
<style>
/* ── Blog-2 newsletter + footer: all classes prefixed b2- to avoid any collision ── */
:root {
  --b2-sage:   #76A379;
  --b2-forest: #253830;
  --b2-cream:  #EEF0EC;
  --b2-mint:   #B2C7B3;
  --b2-gold:   #D2A974;
  --b2-pink:   #B88794;
  --b2-fd: 'Bebas Neue', Impact, sans-serif;
  --b2-fb: 'IBM Plex Sans', system-ui, sans-serif;
  --b2-fm: 'DM Mono', monospace;
}
.b2-container {
  width: 100%;
  max-width: 1380px;
  margin: 0 auto;
  padding-inline: clamp(20px, 4vw, 56px);
}
/* Newsletter strip */
.b2-nl-strip {
  background: linear-gradient(135deg, var(--b2-forest) 0%, #2d4840 100%);
  padding: clamp(48px, 7vw, 80px) 0;
  position: relative;
  overflow: hidden;
}
.b2-nl-strip::before {
  content: '';
  position: absolute; inset: 0;
  background-image: radial-gradient(circle, rgba(178,199,179,.08) 1px, transparent 1px);
  background-size: 28px 28px;
}
.b2-nl-strip::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--b2-gold), var(--b2-pink), var(--b2-sage));
}
.b2-nl-inner {
  position: relative; z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap;
}
.b2-nl-eyebrow {
  font-family: var(--b2-fm);
  font-size: 10.5px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .14em;
  color: var(--b2-gold);
  margin-bottom: 10px;
  display: block;
}
.b2-nl-copy h2 {
  font-family: var(--b2-fd);
  font-size: clamp(32px, 4vw, 56px);
  letter-spacing: .02em;
  color: var(--b2-cream);
  line-height: 1;
  margin-bottom: 12px;
}
.b2-nl-copy p {
  color: var(--b2-mint);
  font-size: 14px;
  max-width: 380px;
  line-height: 1.72;
  font-family: var(--b2-fb);
}
.b2-nl-form {
  display: flex;
  align-items: center;
  background: rgba(238,240,236,.08);
  border: 1px solid rgba(178,199,179,.3);
  border-radius: 6px;
  padding: 5px;
}
.b2-nl-form input {
  border: none; outline: none;
  padding: 11px 18px;
  font-family: var(--b2-fb);
  font-size: 14px;
  color: var(--b2-cream);
  background: none;
  width: clamp(200px, 24vw, 270px);
}
.b2-nl-form input::placeholder { color: rgba(178,199,179,.6); }
.b2-nl-form button {
  padding: 11px 22px;
  background: var(--b2-sage);
  border: none;
  border-radius: 4px;
  color: #fff;
  font-family: var(--b2-fd);
  font-size: 16px;
  letter-spacing: .06em;
  cursor: pointer;
  transition: background .22s ease;
  white-space: nowrap;
}
.b2-nl-form button:hover { background: #5f8b62; }
/* Footer */
.b2-site-footer {
  background: var(--b2-forest);
  border-top: 1px solid rgba(178,199,179,.2);
  padding: 24px 0;
}
.b2-footer-inner {
  max-width: 1380px;
  margin: 0 auto;
  padding-inline: clamp(20px, 4vw, 56px);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.b2-footer-copy {
  font-family: var(--b2-fm);
  font-size: 10.5px;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: var(--b2-mint);
  opacity: .7;
}
.b2-footer-links { display: flex; gap: 20px; }
.b2-footer-links a {
  font-family: var(--b2-fm);
  font-size: 10.5px;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: var(--b2-mint);
  opacity: .7;
  text-decoration: none;
  transition: opacity .22s ease;
}
.b2-footer-links a:hover { opacity: 1; }
/* Responsive */
@media (max-width: 768px) {
  .b2-nl-inner { flex-direction: column; }
  .b2-nl-form { width: 100%; flex-direction: column; }
  .b2-nl-form input { width: 100%; }
  .b2-nl-form button { width: 100%; text-align: center; }
  .b2-footer-inner { flex-direction: column; align-items: center; text-align: center; }
  .b2-footer-links { flex-wrap: wrap; justify-content: center; }
}
</style>

<!-- Newsletter Strip (Blog 2) -->
<section class="b2-nl-strip">
  <div class="b2-container">
    <div class="b2-nl-inner">
      <div class="b2-nl-copy">
        <span class="b2-nl-eyebrow">Stay Informed</span>
        <h2>Intelligence,<br>Delivered.</h2>
        <p>Get the latest insurance-tech insights, growth tactics, and industry analysis delivered to your inbox every week.</p>
      </div>
      <form class="b2-nl-form" onsubmit="handleB2Subscribe(event)">
        <input type="email" placeholder="Your email address" required>
        <button type="submit">Subscribe &rarr;</button>
      </form>
    </div>
  </div>
</section>

<!-- Footer (Blog 2) -->
<footer class="b2-site-footer">
  <div class="b2-footer-inner">
    <span class="b2-footer-copy">&copy; 2026 Mahathi Infotech, LLC. All rights reserved.</span>
    <div class="b2-footer-links">
      <a href="https://mahathiinfotech.com/about-us">About Mahathi</a>
      <a href="#">Legal</a>
      <a href="#">Our Code of Business Conduct</a>
      <a href="https://mahathiinfotech.com/contact-us">Contact Us</a>
    </div>
  </div>
</footer>

<!-- WhatsApp FAB -->
<a href="https://api.whatsapp.com/send?phone=8122346800" target="_blank" rel="noopener" id="whatsapp-icon" aria-label="Chat with us on WhatsApp">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 175.216 175.552">
    <defs>
      <linearGradient id="b" x1="85.915" x2="86.535" y1="32.567" y2="137.092" gradientUnits="userSpaceOnUse">
        <stop offset="0" stop-color="#57d163"/><stop offset="1" stop-color="#23b33a"/>
      </linearGradient>
    </defs>
    <path fill="#b3b3b3" d="m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0"/>
    <path fill="#fff" d="m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z"/>
    <path fill="url(#b)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z"/>
    <path fill="#fff" fill-rule="evenodd" d="M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647"/>
  </svg>
</a>
<style>
#whatsapp-icon { position: fixed; bottom: 25px; right: 25px; width: 65px; height: 65px; background: white; border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,.2); z-index: 1000; overflow: hidden; }
</style>

<script>
/* ── Original JS — exactly as in the source file ── */
const SBV = { postId: 132, ajax: "https://mahathi.salesnanny.com/wp-admin/admin-ajax.php", nonce: "45c18ff050", url: "https://mahathiinfotech.com/", title: "Guidewire Testing: Building a Scalable QA Framework for Enterprise Insurance", loggedIn: false, commentUrl: "https://mahathi.salesnanny.com/wp-comments-post.php" };
const $q  = (q, c=document) => c.querySelector(q);
const toast = (msg) => { const t=document.getElementById('toast'); t.textContent=msg; t.classList.add('show'); setTimeout(()=>t.classList.remove('show'),1600); };

(() => { const btn = document.getElementById('listenBtn'); if (!('speechSynthesis' in window)) { btn.disabled = true; btn.title = 'Not supported'; return; } let speaking = false; let utterance = null; const articleText = document.querySelector('.sblog-content')?.innerText || ''; btn.addEventListener('click', () => { const icon = btn.querySelector('i'); if (!speaking) { utterance = new SpeechSynthesisUtterance(articleText); utterance.lang = 'en-US'; utterance.rate = 1.0; utterance.pitch = 1.0; utterance.onend = () => { speaking=false; icon.className='fa-solid fa-headphones'; btn.title='Read this page'; }; speechSynthesis.cancel(); speechSynthesis.speak(utterance); speaking = true; icon.className='fa-solid fa-stop'; btn.title='Stop reading'; } else { speechSynthesis.cancel(); speaking=false; icon.className='fa-solid fa-headphones'; btn.title='Read this page'; } }); })();

document.getElementById('shareBtn').addEventListener('click', async () => { if (navigator.share) { try { await navigator.share({ title: SBV.title, url: SBV.url }); } catch(e){} } else { try { await navigator.clipboard.writeText(SBV.url); toast('Link copied'); } catch(e){ prompt('Copy this link:', SBV.url); } } });

document.getElementById('saveBtn').addEventListener('click', async function () { if (!SBV.loggedIn) { toast('Please log in to save'); return; } const fd = new FormData(); fd.append('action','sblog_save_toggle'); fd.append('post_id', SBV.postId); fd.append('nonce', SBV.nonce); try{ const r = await fetch(SBV.ajax,{method:'POST',body:fd}); const j = await r.json(); if (j.success) { this.classList.toggle('sblog-saved', j.data.saved); this.title = j.data.saved ? 'Saved' : 'Save for later'; } else { toast(j.data?.message || 'Error'); } }catch(e){ toast('Network error'); } });

async function votePost(type){ const fd = new FormData(); fd.append('action','sblog_post_vote'); fd.append('post_id',SBV.postId); fd.append('vote',type); fd.append('nonce',SBV.nonce); try{ const r = await fetch(SBV.ajax,{method:'POST',body:fd}); const j = await r.json(); if (j.success) { document.getElementById('likeBtn').classList.toggle('sblog-voted', j.data.voted === 'like'); toast(j.data.voted === 'like' ? 'Thanks for the like!' : 'Feedback recorded'); } else toast('Error'); }catch(e){ toast('Network error'); } }
document.getElementById('likeBtn').addEventListener('click', () => votePost('like'));

const promo = document.getElementById('promoCard'); if ('IntersectionObserver' in window && promo) { new IntersectionObserver((entries)=> { entries.forEach(e=>{ if(e.isIntersecting){ promo.style.transform='translateY(0)'; promo.style.opacity='1'; } }); },{threshold:.2}).observe(promo); promo.style.transform='translateY(6px)'; promo.style.opacity='.99'; }

/* ── Blog-2 newsletter subscribe handler ── */
function handleB2Subscribe(e) {
  e.preventDefault();
  var btn = e.target.querySelector('button');
  var orig = btn.textContent;
  btn.textContent = '\u2713 Subscribed!';
  btn.style.background = '#253830';
  setTimeout(function() { btn.textContent = orig; btn.style.background = ''; }, 3000);
}
</script>
</body></html>
