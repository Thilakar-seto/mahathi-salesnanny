<?php
/**
 * Template Name: Blog 2
 */
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insights — Mahathi Infotech</title>
<link rel="icon" type="image/png" href="https://www.mahathiinfotech.com/assets/images/mahathi_logo2.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- Mahathi Brand Fonts: Bebas Neue (display) + DM Mono (labels) -->
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<!-- Aptos substitute: IBM Plex Sans (closest enterprise match available on Google Fonts) -->
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">

<style>
/* ═══════════════════════════════════════════════════════════════════════
   MAHATHI INFOTECH — BRAND SYSTEM v2.0
   Colors · Typography · Components per Brand Guidelines 2026
   ═══════════════════════════════════════════════════════════════════════ */

/* ─── RESET ─────────────────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ─── BRAND TOKENS ───────────────────────────────────────────────────── */
:root {
  /* — Primary Palette — */
  --sage:    #76A379;      /* PRIMARY · LOGO · ACTIVE NAV */
  --forest:  #253830;      /* DARK BASE · SIDEBAR · HEADLINES */
  --cream:   #EEF0EC;      /* PAGE BG · CARD SURFACE */
  --mint:    #B2C7B3;      /* LABELS · BORDERS · SUPPORT */
  --pink:    #B88794;      /* HIGHLIGHTS · PARTNER ACCENTS */
  --gold:    #D2A974;      /* PREMIUM CALLOUTS · NAV ACTIVE */

  /* — Derived — */
  --sage-dim:    rgba(118,163,121,.12);
  --sage-dim2:   rgba(118,163,121,.22);
  --forest-dim:  rgba(37,56,48,.06);
  --mint-border: #C8D9C9;

  /* — Typography — */
  --font-display: 'Bebas Neue', 'Impact', sans-serif;   /* HEADLINES */
  --font-body:    'IBM Plex Sans', 'Aptos', system-ui, sans-serif; /* BODY / UI */
  --font-mono:    'DM Mono', 'Courier New', monospace;  /* LABELS / META */

  /* — Shadows (subtle, enterprise) — */
  --shadow-sm: 0 1px 4px rgba(37,56,48,.08);
  --shadow-md: 0 4px 16px rgba(37,56,48,.10);
  --shadow-lg: 0 12px 40px rgba(37,56,48,.12);

  /* — Radius — */
  --radius-sm: 6px;
  --radius:    10px;
  --radius-lg: 16px;

  /* — Transition — */
  --t: 0.22s ease;
}

html { scroll-behavior: smooth; overflow-x: hidden; }

body {
  font-family: var(--font-body);
  background: var(--cream);   /* Cream — brand page background */
  color: var(--forest);
  line-height: 1.78;          /* Brand spec: 1.65–1.8 */
  font-size: 15px;            /* Brand spec: 15–16px body */
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
}

img { display: block; max-width: 100%; }
a   { text-decoration: none; color: inherit; }

/* ─── SHARED LAYOUT ──────────────────────────────────────────────────── */
.container {
  width: 100%;
  max-width: 1380px;
  margin: 0 auto;
  padding-inline: clamp(20px, 4vw, 56px);
}

/* ─── BRAND TYPOGRAPHY HELPERS ───────────────────────────────────────── */
.label-mono {
  font-family: var(--font-mono);
  font-size: 10.5px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .12em;
  color: var(--sage);
}
.section-eyebrow {
  font-family: var(--font-mono);
  font-size: 11px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .14em;
  color: var(--sage);
  margin-bottom: 10px;
  display: block;
}

/* ─── HEADER — Mahathi Brand Style ────────────────────────────────────
   Utility bar: Spectrum gradient (Gold→Pink→Sage per brand gradient system)
   Main nav: White bg, Forest text, Bebas Neue nav labels
   ───────────────────────────────────────────────────────────────────── */

/* Top utility bar */
.utility-bar {
  width: 100%;
  background: var(--sage);
  position: sticky;
  top: 0;
  z-index: 1001;
}
.utility-inner {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 0;
  padding: 7px 0;
}
.utility-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-family: var(--font-mono);
  font-size: 11px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: #fff;
  padding: 3px 14px;
  transition: opacity var(--t);
  cursor: pointer;
  white-space: nowrap;
}
.utility-link:hover { opacity: .72; }
.utility-sep { color: rgba(255,255,255,.35); font-size: 13px; line-height: 1; user-select: none; }
.utility-link i { font-size: 10px; }

/* Locations dropdown */
.utility-dropdown-wrap { position: relative; }
.utility-dropdown {
  position: absolute;
  top: calc(100% + 10px);
  right: 0;
  min-width: 300px;
  background: var(--cream);
  border: 1px solid var(--mint-border);
  border-radius: var(--radius);
  box-shadow: var(--shadow-lg);
  padding: 20px;
  display: none;
  z-index: 2000;
  flex-direction: column;
  gap: 14px;
}
.utility-dropdown-wrap:hover .utility-dropdown { display: flex; }
.utility-dropdown-item h4 {
  font-family: var(--font-mono);
  font-size: 10px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .12em;
  color: var(--sage);
  margin-bottom: 3px;
}
.utility-dropdown-item p { font-size: 12px; color: var(--forest); line-height: 1.55; opacity: .8; }

/* Main navigation bar */
.site-header {
  width: 100%;
  background: #fff;
  position: sticky;
  top: 34px;
  z-index: 1000;
  border-bottom: 1px solid var(--mint-border);
  box-shadow: var(--shadow-sm);
}
.header-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 0;
}
.logo { display: flex; align-items: center; }
.logo img { width: 160px; height: auto; }

/* Nav links — Bebas Neue, uppercase, brand spec */
.nav-list { display: flex; list-style: none; gap: 0; align-items: center; }
.nav-link {
  display: block;
  padding: 8px 14px;
  font-family: var(--font-display);
  font-size: 14.5px;
  letter-spacing: .06em;
  color: var(--forest);
  transition: color var(--t);
  white-space: nowrap;
  cursor: pointer;
  line-height: 1;
}
.nav-link:hover { color: var(--sage); }
.nav-link.active { color: var(--sage); }

/* Mega dropdown */
.nav-item { position: relative; }
.nav-mega {
  position: absolute;
  top: calc(100% + 4px);
  left: 0;
  min-width: 520px;
  background: #fff;
  border: 1px solid var(--mint-border);
  border-radius: var(--radius);
  box-shadow: var(--shadow-lg);
  padding: 24px;
  display: none;
  z-index: 999;
  grid-template-columns: 1fr 1fr;
  gap: 18px 28px;
}
.nav-item:hover .nav-mega { display: grid; }
.mega-item h4 {
  font-family: var(--font-body);
  font-size: 13px;
  font-weight: 600;
  color: var(--forest);
  margin-bottom: 4px;
  transition: color var(--t);
}
.mega-item p  { font-size: 12px; color: var(--forest); opacity: .6; line-height: 1.5; }
.mega-item:hover h4 { color: var(--sage); }

/* Hamburger (mobile) */
.hamburger-btn { display: none; flex-direction: column; justify-content: space-around; width: 28px; height: 22px; background: none; border: none; cursor: pointer; }
.hamburger-line { width: 100%; height: 2px; background: var(--forest); border-radius: 2px; transition: all .3s; }

/* ─── FILTER BAR — Brand: DM Mono labels, Cream bg, Mint borders ─────── */
.filter-bar {
  position: sticky;
  top: 100px;
  z-index: 900;
  background: rgba(238,240,236,.97);  /* Cream with transparency */
  backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--mint-border);
}
.filter-inner {
  display: flex;
  align-items: center;
  overflow-x: auto;
  scrollbar-width: none;
  padding: 11px 0;
  gap: 4px;
}
.filter-inner::-webkit-scrollbar { display: none; }

/* Filter chips: DM Mono, all-caps per brand label rule */
.filter-chip {
  flex-shrink: 0;
  padding: 6px 16px;
  border-radius: 4px;
  font-family: var(--font-mono);
  font-size: 10.5px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: var(--forest);
  opacity: .65;
  cursor: pointer;
  white-space: nowrap;
  border: 1px solid transparent;
  background: transparent;
  transition: all var(--t);
}
.filter-chip:hover { opacity: 1; background: var(--sage-dim); border-color: var(--mint); }
.filter-chip.active {
  opacity: 1;
  color: var(--forest);
  background: var(--sage-dim2);
  border-color: var(--sage);
  font-weight: 500;
}

/* Search input — brand: Cream bg, Mint border */
.filter-search {
  margin-left: auto;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  gap: 8px;
  background: #fff;
  border: 1px solid var(--mint-border);
  border-radius: var(--radius-sm);
  padding: 7px 14px;
  transition: border-color var(--t);
}
.filter-search:focus-within { border-color: var(--sage); }
.filter-search i { color: var(--sage); font-size: 12px; }
.filter-search input {
  border: none;
  background: none;
  outline: none;
  font-family: var(--font-body);
  font-size: 13px;
  color: var(--forest);
  width: 170px;
}
.filter-search input::placeholder { color: var(--mint); }

/* ─── PAGE GRID SECTION ──────────────────────────────────────────────── */
.blog-grid-section { padding: clamp(36px, 5vw, 32px) 0; }

/* Featured + side layout */
.featured-row {
  display: grid;
  grid-template-columns: 1.55fr 1fr;
  grid-template-rows: auto auto;
  gap: 20px;
  margin-bottom: 52px;
}
.featured-card { grid-row: 1 / 3; }

/* ─── CARDS — Brand: Cream bg, Mint border, clean shadows ────────────── */
.card {
  background: #fff;
  border-radius: var(--radius);
  border: 1px solid var(--mint-border);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform var(--t), box-shadow var(--t), border-color var(--t);
  cursor: pointer;
  position: relative;
}
.card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
  border-color: var(--sage);
}

/* Thumbnail */
.card-thumb {
  position: relative;
  overflow: hidden;
  background: var(--cream);
}
.card-thumb img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform .5s ease;
}
.card:hover .card-thumb img { transform: scale(1.04); }

.featured-card .card-thumb { height: 340px; }
.side-card .card-thumb { height: 165px; }
.std-card .card-thumb { height: 200px; }

/* Category badge — DM Mono, brand tag style */
.card-cat {
  position: absolute;
  top: 12px; right: 12px;
  font-family: var(--font-mono);
  font-size: 10px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: var(--forest);
  background: #fff;
  border: 1px solid var(--mint-border);
  border-radius: 4px;
  padding: 4px 10px;
  z-index: 2;
}

/* Card body */
.card-body {
  padding: 20px 22px 22px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  flex: 1;
}
.featured-card .card-body { padding: 24px 26px 26px; gap: 14px; }

/* Card title — Bebas Neue per brand display spec */
.card-title {
  font-family: var(--font-display);
  font-size: 22px;
  letter-spacing: .02em;
  color: var(--forest);
  line-height: 1.1;
  transition: color var(--t);
  font-weight: 400;
}
.card:hover .card-title { color: var(--sage); }
.featured-card .card-title { font-size: clamp(26px, 2.8vw, 36px); line-height: 1.05; }

/* Card excerpt — Aptos 15px, 1.78 lh per brand spec */
.card-excerpt {
  font-size: 14px;
  color: var(--forest);
  opacity: .7;
  line-height: 1.75;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.featured-card .card-excerpt { -webkit-line-clamp: 3; font-size: 15px; }

/* Meta row */
.card-meta {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: auto;
  padding-top: 14px;
  border-top: 1px solid var(--cream);
}
.meta-avatar {
  width: 32px; height: 32px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--mint);
  flex-shrink: 0;
}
.meta-info { flex: 1; min-width: 0; }
.meta-author {
  font-size: 13px;
  font-weight: 600;
  color: var(--forest);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
/* Meta stats — DM Mono label style */
.meta-stats {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-mono);
  font-size: 10px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--forest);
  opacity: .55;
  margin-top: 2px;
}
.meta-stats i { font-size: 9px; color: var(--sage); }
.meta-stats .sep { opacity: .5; }

/* ─── SECTION HEADING ────────────────────────────────────────────────── */
.section-label {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 24px;
}
/* Eyebrow + title combo per brand hierarchy */
.section-label-wrap { display: flex; flex-direction: column; gap: 4px; }
.section-label h2 {
  font-family: var(--font-display);
  font-size: clamp(32px, 3.5vw, 48px);
  letter-spacing: .02em;
  color: var(--forest);
  line-height: 1;
}
.section-label .line { flex: 1; height: 1px; background: var(--mint-border); }

/* ─── 3-COL GRID ─────────────────────────────────────────────────────── */
.grid-3 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

/* ─── LOAD MORE — brand primary button style ─────────────────────────── */
.load-more-wrap { text-align: center; margin-top: 48px; }
.load-more-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 36px;
  background: var(--forest);     /* Forest fill = brand primary button */
  color: #fff;
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: .06em;
  border: 2px solid var(--forest);
  border-radius: var(--radius-sm);
  cursor: pointer;
  transition: all var(--t);
}
.load-more-btn:hover {
  background: transparent;
  color: var(--forest);
  transform: translateY(-2px);
}
.load-more-btn i { font-size: 13px; transition: transform .28s; }
.load-more-btn:hover i { transform: rotate(180deg); }

/* ─── NEWSLETTER — Forest Depth gradient per brand spec ──────────────── */
.nl-strip {
  background: linear-gradient(135deg, var(--forest) 0%, #2d4840 100%);
  padding: clamp(48px, 7vw, 80px) 0;
  position: relative;
  overflow: hidden;
  margin-top: clamp(56px, 7vw, 88px);
}
/* Subtle dot texture — premium enterprise feel */
.nl-strip::before {
  content: '';
  position: absolute; inset: 0;
  background-image: radial-gradient(circle, rgba(178,199,179,.08) 1px, transparent 1px);
  background-size: 28px 28px;
}
/* Gold spectrum accent bar at top — brand "Spectrum" gradient */
.nl-strip::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--gold), var(--pink), var(--sage));
}
.nl-inner {
  position: relative; z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap;
}
/* Section eyebrow */
.nl-eyebrow {
  font-family: var(--font-mono);
  font-size: 10.5px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: .14em;
  color: var(--gold);
  margin-bottom: 10px;
  display: block;
}
.nl-copy h2 {
  font-family: var(--font-display);
  font-size: clamp(32px, 4vw, 56px);
  letter-spacing: .02em;
  color: var(--cream);
  line-height: 1;
  margin-bottom: 12px;
}
.nl-copy p { color: var(--mint); font-size: 14px; max-width: 380px; line-height: 1.72; }

/* Newsletter form — brand input style */
.nl-form {
  display: flex;
  align-items: center;
  background: rgba(238,240,236,.08);
  border: 1px solid rgba(178,199,179,.3);
  border-radius: var(--radius-sm);
  padding: 5px;
}
.nl-form input {
  border: none; outline: none;
  padding: 11px 18px;
  font-family: var(--font-body);
  font-size: 14px;
  color: var(--cream);
  background: none;
  width: clamp(200px, 24vw, 270px);
}
.nl-form input::placeholder { color: rgba(178,199,179,.6); }
/* Primary CTA button: Sage fill */
.nl-form button {
  padding: 11px 22px;
  background: var(--sage);
  border: none;
  border-radius: 4px;
  color: #fff;
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: .06em;
  cursor: pointer;
  transition: background var(--t);
  white-space: nowrap;
}
.nl-form button:hover { background: #5f8b62; }

/* ─── FOOTER ─────────────────────────────────────────────────────────── */
.site-footer {
  background: var(--forest);
  border-top: 1px solid rgba(178,199,179,.2);
  padding: 24px 0;
}
.footer-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.footer-copy {
  font-family: var(--font-mono);
  font-size: 10.5px;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: var(--mint);
  opacity: .7;
}
.footer-links { display: flex; gap: 20px; }
.footer-links a {
  font-family: var(--font-mono);
  font-size: 10.5px;
  text-transform: uppercase;
  letter-spacing: .10em;
  color: var(--mint);
  opacity: .7;
  transition: opacity var(--t);
}
.footer-links a:hover { opacity: 1; }

/* ─── MOBILE NAV ─────────────────────────────────────────────────────── */
.mobile-nav {
  position: fixed;
  top: 0; right: -100%;
  width: 82%; max-width: 360px; height: 100%;
  background: var(--forest);
  z-index: 1100;
  transition: right .36s cubic-bezier(.68,-.55,.265,1.55);
  padding: 80px 24px 32px;
  overflow-y: auto;
  visibility: hidden;
  border-left: 1px solid rgba(178,199,179,.15);
}
.mobile-nav.open { right: 0; visibility: visible; }
.mobile-nav ul { list-style: none; display: flex; flex-direction: column; gap: 2px; }
.mobile-nav ul li a {
  display: block;
  padding: 13px 16px;
  font-family: var(--font-display);
  font-size: 20px;
  letter-spacing: .04em;
  color: var(--cream);
  border-radius: var(--radius-sm);
  transition: background var(--t), color var(--t);
}
.mobile-nav ul li a:hover { background: rgba(178,199,179,.08); color: var(--sage); }
.mobile-overlay {
  position: fixed; inset: 0;
  background: rgba(37,56,48,.6);
  z-index: 1090;
  opacity: 0; visibility: hidden;
  transition: opacity .28s;
}
.mobile-overlay.open { opacity: 1; visibility: visible; }
.mobile-close {
  position: absolute;
  top: 20px; right: 20px;
  background: rgba(178,199,179,.12);
  border: 1px solid rgba(178,199,179,.2);
  color: var(--mint);
  width: 36px; height: 36px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 16px;
  display: flex; align-items: center; justify-content: center;
  transition: background var(--t);
}
.mobile-close:hover { background: rgba(178,199,179,.2); }

/* ─── RESPONSIVE ─────────────────────────────────────────────────────── */
@media (max-width: 1100px) {
  .grid-3 { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 900px) {
  .featured-row { grid-template-columns: 1fr; grid-template-rows: auto; }
  .featured-card { grid-row: auto; }
  .featured-card .card-thumb { height: 240px; }
  .side-card .card-thumb { height: 180px; }
  .side-card { display: grid; grid-template-columns: 170px 1fr; }
  .side-card .card-thumb { height: auto; min-height: 150px; }
}

@media (max-width: 768px) {
  .utility-bar { display: none; }
  .site-header { top: 0; }
  .filter-bar { top: 68px; }
  .nav-list { display: none; }
  .hamburger-btn { display: flex; }
  .grid-3 { grid-template-columns: 1fr; }
  .side-card { grid-template-columns: 1fr; }
  .side-card .card-thumb { height: 180px; }
  .nl-inner { flex-direction: column; }
  .nl-form { width: 100%; flex-direction: column; }
  .nl-form input { width: 100%; }
  .nl-form button { width: 100%; text-align: center; }
  .filter-search { display: none; }
}

@media (max-width: 480px) {
  .featured-row { gap: 14px; }
  .grid-3 { gap: 14px; }
}

/* ─── ANIMATIONS ─────────────────────────────────────────────────────── */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
.animate { opacity: 0; }
.animate.in { animation: fadeUp .5s ease forwards; }
.grid-3 .card:nth-child(1) { animation-delay: .05s; }
.grid-3 .card:nth-child(2) { animation-delay: .11s; }
.grid-3 .card:nth-child(3) { animation-delay: .17s; }
.grid-3 .card:nth-child(4) { animation-delay: .06s; }
.grid-3 .card:nth-child(5) { animation-delay: .12s; }
.grid-3 .card:nth-child(6) { animation-delay: .18s; }
</style>
</head>
<body>

<!-- ══ UTILITY BAR (green top strip) ═══════════════════════════════════ -->
<div class="utility-bar">
  <div class="container">
    <div class="utility-inner">
      <!-- Locations with dropdown -->
      <div class="utility-dropdown-wrap">
        <span class="utility-link">Locations <i class="fa-solid fa-chevron-down"></i></span>
        <div class="utility-dropdown">
          <div class="utility-dropdown-item">
            <h4>USA – HQ</h4>
            <p>630 Freedom Business Center Drive, Floor #3, King of Prussia, PA 19406</p>
          </div>
          <div class="utility-dropdown-item">
            <h4>USA – Technology Delivery Hub</h4>
            <p>19 Mystic Lane Malvern, PA 19355</p>
          </div>
          <div class="utility-dropdown-item">
            <h4>India – GDC One</h4>
            <p>21D, 3rd Floor, Raagavis Center, Nanjunda Puram Road, Coimbatore - 641045</p>
          </div>
          <div class="utility-dropdown-item">
            <h4>UAE – Dubai Innovation Hub</h4>
            <p>FZCO Building A1, Dubai Digital Park, Dubai Silicon Oasis, Dubai</p>
          </div>
          <div class="utility-dropdown-item">
            <h4>Philippines – Automation Hub</h4>
            <p>25F, Legaspi Street, Brgy. Maybunga, Pasig City</p>
          </div>
        </div>
      </div>
      <span class="utility-sep">|</span>
      <span class="utility-link">Awards</span>
      <span class="utility-sep">|</span>
      <span class="utility-link">Certifications</span>
      <span class="utility-sep">|</span>
      <span class="utility-link">Careers</span>
      <span class="utility-sep">|</span>
      <span class="utility-link search-btn"><i class="fa-solid fa-magnifying-glass"></i> Search</span>
    </div>
  </div>
</div>

<!-- ══ MAIN HEADER ══════════════════════════════════════════════════════ -->
<header class="site-header">
  <div class="container">
    <div class="header-inner">
      <!-- Logo -->
      <a class="logo" href="https://mahathiinfotech.com/">
        <img src="https://www.mahathiinfotech.com/assets/images/mahathi_logo2.png"
             alt="Mahathi Infotech" width="160" height="36">
      </a>

      <!-- Desktop nav -->
      <ul class="nav-list">

        <li class="nav-item">
          <a class="nav-link" href="https://mahathiinfotech.com/">Insurance Solutions</a>
          <div class="nav-mega">
            <div class="mega-item"><h4>Workers Comp</h4><p>Commercial Carrier Enablement, Policy Admin, Billing, Claims Management</p></div>
            <div class="mega-item"><h4>Property &amp; Casualty</h4><p>Admitted Package Lines, Excess &amp; Surplus, Specialty Products</p></div>
            <div class="mega-item"><h4>Managed Care Organizations</h4><p>Medication Intervention, Revenue Loss Prevention, Case Management</p></div>
            <div class="mega-item"><h4>Life &amp; Annuity</h4><p>Claims Transformation, Actuarial Practice, Digital Platform Management</p></div>
            <div class="mega-item"><h4>Reinsurance</h4><p>Claims, Policy, Billing Management</p></div>
            <div class="mega-item"><h4>Compliance-as-a-Service</h4><p>Statutory Reporting and Regulatory Operations for Workers Comp &amp; P&amp;C</p></div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://mahathiinfotech.com/">Healthcare Solutions</a>
          <div class="nav-mega">
            <div class="mega-item"><h4>Core Healthcare Platforms</h4><p>Enrollment, core admin systems, and member/patient engagement</p></div>
            <div class="mega-item"><h4>Claims &amp; Revenue</h4><p>Claims processing, billing, payments, and revenue optimization</p></div>
            <div class="mega-item"><h4>Clinical &amp; Pharmacy</h4><p>Utilization management, care coordination, pharmacy operations</p></div>
            <div class="mega-item"><h4>Data, AI &amp; Compliance</h4><p>Regulatory compliance, fraud detection, analytics, AI automation</p></div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://mahathiinfotech.com/ai-enablement">AI Enablement</a>
          <div class="nav-mega">
            <div class="mega-item"><h4>AI Readiness &amp; Strategy</h4><p>Help clients assess readiness and define an AI adoption roadmap</p></div>
            <div class="mega-item"><h4>AI-Driven Automation</h4><p>Streamline routine tasks like document processing and customer service</p></div>
            <div class="mega-item"><h4>AI for Dev Productivity</h4><p>Reduce costs and speed up project timelines with AI tooling</p></div>
            <div class="mega-item"><h4>Custom AI Development</h4><p>Design and build AI-enabled software tailored to your needs</p></div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://mahathiinfotech.com/digital-services">Digital Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="https://mahathiinfotech.com/news">News</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://mahathiinfotech.com/about-us">About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="https://mahathiinfotech.com/contact-us">Contact Us</a>
        </li>

      </ul>

      <!-- Hamburger (mobile) -->
      <button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
    </div>
  </div>
</header>

<!-- Mobile nav -->
<div class="mobile-overlay" id="mobileOverlay"></div>
<nav class="mobile-nav" id="mobileNav">
  <button class="mobile-close" id="mobileClose">✕</button>
  <ul>
    <li><a href="#">Insurance Solutions</a></li>
    <li><a href="#">Healthcare Solutions</a></li>
    <li><a href="https://mahathiinfotech.com/ai-enablement">AI Enablement</a></li>
    <li><a href="https://mahathiinfotech.com/digital-services">Digital Services</a></li>
    <li><a href="https://mahathiinfotech.com/news">News</a></li>
    <li><a href="https://mahathiinfotech.com/about-us">About Us</a></li>
    <li><a href="https://mahathiinfotech.com/contact-us">Contact Us</a></li>
  </ul>
</nav>

<!-- ══ FILTER BAR ════════════════════════════════════════════════════════ -->
<div class="filter-bar">
  <div class="container">
    <div class="filter-inner">
      <button class="filter-chip active" data-cat="all">All Topics</button>
      <button class="filter-chip" data-cat="Guidewire">Guidewire</button>
      <button class="filter-chip" data-cat="Insurance Solutions">Insurance Solutions</button>
      <button class="filter-chip" data-cat="Healthcare Solutions">Healthcare Solutions</button>
      <button class="filter-chip" data-cat="Integrated Mailroom">Integrated Mailroom</button>
      <button class="filter-chip" data-cat="Workbench Solutions">Workbench Solutions</button>
      <button class="filter-chip" data-cat="Compliance">Compliance</button>
      <button class="filter-chip" data-cat="Investigative Services">Investigative Services</button>
      <button class="filter-chip" data-cat="Litigation Support">Litigation Support</button>
      <button class="filter-chip" data-cat="Quadient">Quadient</button>
      <div class="filter-search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Search articles…">
      </div>
    </div>
  </div>
</div>

<!-- ══ BLOG GRID ═════════════════════════════════════════════════════════ -->
<section class="blog-grid-section">
  <div class="container">

    <!-- Section header -->


    <div class="section-label">
      <div class="section-label-wrap">
        <span class="section-eyebrow">01 — Featured Insights</span>
        <h2>Featured Articles</h2>
      </div>
      <div class="line"></div>
    </div>

    <!-- Featured Row: Cards 1–3 -->
    <div class="featured-row" id="featuredRow">

      <!-- CARD 1 — FEATURED: Guidewire Testing -->
      <article class="card featured-card animate" data-cat="Guidewire" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Guidewire</span>
          <!-- Software testing / QA dashboard visual -->
          <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=900&auto=format&fit=crop&q=80" alt="Guidewire Testing" loading="eager">
        </div>
        <div class="card-body">
          <h2 class="card-title">Guidewire Testing: Building a Scalable QA Framework for Enterprise Insurance</h2>
          <p class="card-excerpt">Discover how automated testing across PolicyCenter, ClaimCenter, and BillingCenter reduces deployment risk by up to 80%. From CI/CD integration to AI-driven regression suites, we break down the testing strategies that keep enterprise carriers moving fast without compromising quality or compliance.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6?s=80&d=mm&r=g" alt="James Whitfield">
            <div class="meta-info">
              <div class="meta-author">James Whitfield</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 7 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 5.8K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 2 — SIDE: Guidewire Implementation -->
      <article class="card side-card animate" data-cat="Guidewire" style="animation-delay:.08s" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Guidewire</span>
          <!-- Enterprise software implementation / team collaboration -->
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=700&auto=format&fit=crop&q=80" alt="Guidewire Implementation" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Guidewire Implementation: Delivering on Time, on Budget, at Enterprise Scale</h2>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7?s=80&d=mm&r=g" alt="Sarah Callahan">
            <div class="meta-info">
              <div class="meta-author">Sarah Callahan</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 6 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 4.2K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 3 — SIDE: Insurance Solutions -->
      <article class="card side-card animate" data-cat="Insurance Solutions" style="animation-delay:.16s" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Insurance Solutions</span>
          <!-- Insurance / protection / trust visual -->
          <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=700&auto=format&fit=crop&q=80" alt="Insurance Solutions" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">End-to-End Insurance Solutions: P&amp;C, Workers' Comp, and Life &amp; Annuity</h2>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8?s=80&d=mm&r=g" alt="Daniel Torres">
            <div class="meta-info">
              <div class="meta-author">Daniel Torres</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 5 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 3.7K views
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>

    <!-- Standard Grid: Cards 4–11 -->
    <div class="section-label">
      <div class="section-label-wrap">
        <span class="section-eyebrow">02 — Latest Insights</span>
        <h2>Latest Articles</h2>
      </div>
      <div class="line"></div>
    </div>

    <div class="grid-3" id="articleGrid">

      <!-- CARD 4 — Healthcare Solutions -->
      <article class="card std-card animate" data-cat="Healthcare Solutions" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Healthcare Solutions</span>
          <!-- Healthcare / medical data / digital health -->
          <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=700&auto=format&fit=crop&q=80" alt="Healthcare Solutions" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Healthcare Solutions: Transforming Payor & PBM Operations with Intelligent Technology</h2>
          <p class="card-excerpt">From claims processing and member enrollment to care coordination and regulatory compliance, Mahathi delivers unified digital solutions that reduce cost, accelerate decisions, and improve outcomes for healthcare payors and intermediaries.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9?s=80&d=mm&r=g" alt="Megan Holloway">
            <div class="meta-info">
              <div class="meta-author">Megan Holloway</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 8 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 6.1K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 5 — Integrated Mailroom -->
      <article class="card std-card animate" data-cat="Integrated Mailroom" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Integrated Mailroom</span>
          <!-- Document processing / mail scanning / workflow -->
          <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=700&auto=format&fit=crop&q=80" alt="Integrated Mailroom" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Integrated Mailroom: How Intelligent Document Capture Eliminates Manual Bottlenecks</h2>
          <p class="card-excerpt">Physical mail is still a critical input for insurance operations. Mahathi's Integrated Mailroom digitises, classifies, and routes incoming correspondence with AI-powered accuracy — cutting processing time by 70% and eliminating costly manual triage.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6?s=80&d=mm&r=g" alt="James Whitfield">
            <div class="meta-info">
              <div class="meta-author">James Whitfield</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 6 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 4.9K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 6 — Workbench Solutions -->
      <article class="card std-card animate" data-cat="Workbench Solutions" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Workbench Solutions</span>
          <!-- Claims desk / adjuster workstation / productivity -->
          <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=700&auto=format&fit=crop&q=80" alt="Workbench Solutions" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Workbench Solutions: Empowering Claims Examiners with a Unified Digital Desk</h2>
          <p class="card-excerpt">Workbench consolidates claims data, correspondence, tasks, and approvals into a single intelligent interface for adjusters and supervisors — dramatically reducing toggle time, decision latency, and administrative overhead across the entire claims lifecycle.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7?s=80&d=mm&r=g" alt="Sarah Callahan">
            <div class="meta-info">
              <div class="meta-author">Sarah Callahan</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 5 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 3.4K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 7 — Compliance As A Service -->
      <article class="card std-card animate" data-cat="Compliance" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Compliance</span>
          <!-- Regulatory / legal / compliance documentation -->
          <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=700&auto=format&fit=crop&q=80" alt="Compliance As A Service" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Compliance As A Service: Staying Ahead of FROI, SROI, and Regulatory Obligations</h2>
          <p class="card-excerpt">Workers' Comp and P&C compliance is relentlessly complex — FROI/SROI reporting, WCPOLS, CMS coordination, and state-by-state mandates evolve constantly. Mahathi's Compliance-as-a-Service removes that burden entirely, so your teams focus on claims, not filings.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8?s=80&d=mm&r=g" alt="Daniel Torres">
            <div class="meta-info">
              <div class="meta-author">Daniel Torres</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 7 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 5.5K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 8 — SIU & Investigative Services -->
      <article class="card std-card animate" data-cat="Investigative Services" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Investigative Services</span>
          <!-- Investigation / fraud detection / analysis -->
          <img src="https://images.unsplash.com/photo-1614064641938-3bbee52942c7?w=700&auto=format&fit=crop&q=80" alt="SIU & Investigative Services" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">SIU & Investigative Services: Detecting Fraud Before It Costs Your Carrier Millions</h2>
          <p class="card-excerpt">Insurance fraud costs the U.S. industry over $40 billion annually. Mahathi's SIU specialists combine deep investigative expertise with AI-powered anomaly detection to identify suspicious patterns early — protecting your loss ratios and your policyholders.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8a9?s=80&d=mm&r=g" alt="Megan Holloway">
            <div class="meta-info">
              <div class="meta-author">Megan Holloway</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 9 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 7.2K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 9 — Litigation Support Services -->
      <article class="card std-card animate" data-cat="Litigation Support" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Litigation Support</span>
          <!-- Legal / courtroom / litigation management -->
          <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=700&auto=format&fit=crop&q=80" alt="Litigation Support Services" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Litigation Support Services: Controlling Legal Spend & Accelerating Case Resolution</h2>
          <p class="card-excerpt">Contested claims and prolonged litigation drain reserves and consume adjuster bandwidth. Mahathi's litigation support team manages discovery, documentation, vendor coordination, and case tracking — giving defense counsel everything they need, faster.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6?s=80&d=mm&r=g" alt="James Whitfield">
            <div class="meta-info">
              <div class="meta-author">James Whitfield</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 6 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 4.1K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 10 — Quadient Implementations -->
      <article class="card std-card animate" data-cat="Quadient" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Quadient</span>
          <!-- Customer communications / enterprise printing / CCM -->
          <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=700&auto=format&fit=crop&q=80" alt="Quadient Implementations" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Quadient Implementations: Modernising Insurance Customer Communications at Scale</h2>
          <p class="card-excerpt">Mahathi's Quadient Inspire implementation practice delivers end-to-end CCM transformations — from legacy migration to cloud deployment. We help carriers send personalised, compliant policy documents, EOBs, and claims correspondence across every channel policyholders prefer.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7?s=80&d=mm&r=g" alt="Sarah Callahan">
            <div class="meta-info">
              <div class="meta-author">Sarah Callahan</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 8 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 5.3K views
              </div>
            </div>
          </div>
        </div>
      </article>

      <!-- CARD 11 — Quadient Integrations -->
      <article class="card std-card animate" data-cat="Quadient" onclick="location.href='https://mahathiinfotech.com/'">
        <div class="card-thumb">
          <span class="card-cat">Quadient</span>
          <!-- System integration / API / data pipeline -->
          <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=700&auto=format&fit=crop&q=80" alt="Quadient Integrations" loading="lazy">
        </div>
        <div class="card-body">
          <h2 class="card-title">Quadient Integrations: Connecting Inspire to Guidewire, Salesforce & Legacy Core Systems</h2>
          <p class="card-excerpt">The real value of Quadient Inspire is realised when it talks fluently to your existing systems. Mahathi's integration specialists build robust connectors between Inspire and Guidewire, Salesforce, FINEOS, and legacy policy admin platforms — eliminating data silos and ensuring every communication is accurate and timely.</p>
          <div class="card-meta">
            <img class="meta-avatar" src="https://secure.gravatar.com/avatar/c3d4e5f6a7b8c9d0e1f2a3b4c5d6e7f8?s=80&d=mm&r=g" alt="Daniel Torres">
            <div class="meta-info">
              <div class="meta-author">Daniel Torres</div>
              <div class="meta-stats">
                <i class="fa-solid fa-clock"></i> 7 min read
                <span class="sep">·</span>
                <i class="fa-solid fa-eye"></i> 6.8K views
              </div>
            </div>
          </div>
        </div>
      </article>

    </div><!-- /grid-3 -->

    <!-- Load More -->
    <div class="load-more-wrap">
      <button class="load-more-btn" id="loadMoreBtn">
        <i class="fa-solid fa-rotate"></i> Load more articles
      </button>
    </div>

  </div>
</section>

<!-- ══ NEWSLETTER ════════════════════════════════════════════════════════ -->
<section class="nl-strip">
  <div class="container">
    <div class="nl-inner">
      <div class="nl-copy">
        <span class="nl-eyebrow">Stay Informed</span>
        <h2>Intelligence,<br>Delivered.</h2>
        <p>Get the latest insurance-tech insights, growth tactics, and industry analysis delivered to your inbox every week.</p>
      </div>
      <form class="nl-form" onsubmit="handleSubscribe(event)">
        <input type="email" placeholder="Your email address" required>
        <button type="submit">Subscribe →</button>
      </form>
    </div>
  </div>
</section>

<!-- ══ FOOTER ════════════════════════════════════════════════════════════ -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-inner">
      <span class="footer-copy">© 2026 Mahathi Infotech, LLC. All rights reserved.</span>
      <div class="footer-links">
        <a href="https://mahathiinfotech.com/about-us">About Mahathi</a>
        <a href="#">Legal</a>
        <a href="#">Our Code of Business Conduct</a>
        <a href="https://mahathiinfotech.com/contact-us">Contact Us</a>
      </div>
    </div>
  </div>
</footer>

<script>
/* ── Mobile nav ── */
const hamburgerBtn  = document.getElementById('hamburgerBtn');
const mobileNav     = document.getElementById('mobileNav');
const mobileOverlay = document.getElementById('mobileOverlay');
const mobileClose   = document.getElementById('mobileClose');

function openMenu()  { mobileNav.classList.add('open'); mobileOverlay.classList.add('open'); }
function closeMenu() { mobileNav.classList.remove('open'); mobileOverlay.classList.remove('open'); }

hamburgerBtn.addEventListener('click', openMenu);
mobileClose.addEventListener('click', closeMenu);
mobileOverlay.addEventListener('click', closeMenu);

/* ── Category filter ── */
const filterChips = document.querySelectorAll('.filter-chip');
const allCards    = document.querySelectorAll('.card[data-cat]');
const searchInput = document.getElementById('searchInput');

let activeCategory = 'all';
let searchQuery    = '';

function filterCards() {
  allCards.forEach(card => {
    const cat   = card.dataset.cat || '';
    const title = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
    const desc  = card.querySelector('.card-excerpt')?.textContent.toLowerCase() || '';
    const catMatch    = activeCategory === 'all' || cat === activeCategory;
    const searchMatch = searchQuery === '' || title.includes(searchQuery) || desc.includes(searchQuery) || cat.toLowerCase().includes(searchQuery);
    const visible = catMatch && searchMatch;
    if (visible) {
      card.style.display = '';
      if (!card.classList.contains('in')) card.classList.add('in');
    } else {
      card.style.display = 'none';
    }
  });
}

filterChips.forEach(chip => {
  chip.addEventListener('click', () => {
    filterChips.forEach(c => c.classList.remove('active'));
    chip.classList.add('active');
    activeCategory = chip.dataset.cat;
    filterCards();
  });
});

searchInput.addEventListener('input', e => {
  searchQuery = e.target.value.toLowerCase().trim();
  filterCards();
});

/* ── Scroll animations ── */
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('in');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.animate').forEach(el => {
  const rect = el.getBoundingClientRect();
  if (rect.top < window.innerHeight) {
    el.classList.add('in');
  } else {
    observer.observe(el);
  }
});

/* ── Load More ── */
document.getElementById('loadMoreBtn').addEventListener('click', function() {
  this.innerHTML = 'No more articles at this time.';
  this.disabled = true;
  this.style.opacity = '0.5';
  this.style.cursor = 'default';
});

/* ── Newsletter subscribe ── */
function handleSubscribe(e) {
  e.preventDefault();
  const btn = e.target.querySelector('button');
  const orig = btn.textContent;
  btn.textContent = '\u2713 Subscribed!';
  btn.style.background = '#253830';
  setTimeout(() => {
    btn.textContent = orig;
    btn.style.background = '';
  }, 3000);
}
</script>
</body>
</html>
