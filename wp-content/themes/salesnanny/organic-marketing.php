<?php
   /**
    * Template Name: Organic Marketing
    */
   get_header();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
   :root {
   /* SalesNanny home.php tokens */
   --navy: #1e2154;
   --navy-mid: #1e2152;
   --red: #c22034;
   --red-light: #d9344a;
   --gold: #f5a623;
   --white: #ffffff;
   --light: #f4f5fa;
   --muted: #8890b0;
   --border: rgba(255,255,255,0.08);
   --card-bg: rgba(255,255,255,0.04);
   --ease: cubic-bezier(0.25, 0.46, 0.45, 0.94);
   }
   *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
   html { scroll-behavior: smooth; }
   body { font-family: "Inter", sans-serif; font-weight: 500; background: #fff; color: #1a1d3a; overflow-x: hidden; letter-spacing: -0.04em; }
   h1, h2, h3, h4, h5, .brand { font-family: "Inter", sans-serif; font-weight: 800; }
   .maintanence-landing .container { max-width: 1400px; width: 100%; margin-left: auto; margin-right: auto; padding-left: clamp(20px, 4vw, 48px) !important; padding-right: clamp(20px, 4vw, 48px) !important; }
   .maintanence-landing .row { --bs-gutter-x: 1.5rem; --bs-gutter-y: 0; }
   #scroll-progress { position: fixed; top: 0; left: 0; height: 3px; background: var(--red); z-index: 9999; width: 0%; transition: width 0.1s linear; }
   #preloader { position: fixed; inset: 0; background: var(--navy); z-index: 99999; display: flex; align-items: center; justify-content: center; transition: opacity 0.6s ease, visibility 0.6s ease; }
   #preloader.hide { opacity: 0; visibility: hidden; }
   .preloader-inner { text-align: center; }
   .preloader-logo { font-family: "Inter", sans-serif; font-size: 2rem; font-weight: 800; color: #fff; letter-spacing: 2px; }
   .preloader-logo span { color: var(--red); }
   .preloader-bar { width: 200px; height: 3px; background: rgba(255,255,255,0.1); margin: 16px auto 0; border-radius: 10px; overflow: hidden; }
   .preloader-bar::after { content: ''; display: block; height: 100%; background: var(--red); animation: loadbar 1.5s ease forwards; }
   @keyframes loadbar { from { width: 0 } to { width: 100% } }
   .navbar { position: fixed; top: 0; width: 100%; padding: 22px 0; z-index: 1000; transition: all 0.4s var(--ease); }
   .navbar.scrolled { background: rgba(30,33,84,0.97); backdrop-filter: blur(20px); padding: 14px 0; box-shadow: 0 4px 40px rgba(0,0,0,0.3); }
   .navbar-brand { font-family: "Inter", sans-serif; font-size: 1.5rem; font-weight: 800; color: #fff !important; letter-spacing: 1px; }
   .navbar-brand span { color: var(--red); }
   .navbar .nav-link { color: rgba(255,255,255,0.8) !important; font-weight: 500; font-size: 0.9rem; padding: 6px 16px !important; transition: color 0.3s; letter-spacing: 0.3px; }
   .navbar .nav-link:hover { color: #fff !important; }
   .site-header .nav-link, .site-header .nav-item > span.nav-link { color: #333 !important; font-size: 14px !important; font-weight: 600 !important; padding: 8px 14px !important; }
   .site-header a.nav-link:hover { color: #c22034 !important; }
   .maintanence-landing :is(.btn-nav, .btn-primary-hero, .btn-ghost-hero, .btn-price, .btn-cta-white, .outcomes-journey__go, .contact-form-wrap .cf-submit, .btn-unified) { display: inline-flex; align-items: center; justify-content: center; gap: 10px; border-radius: 12px; border: 1px solid transparent; text-decoration: none; font-family: "Inter", sans-serif; font-weight: 700; letter-spacing: 0.02em; transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease, color 0.25s ease, border-color 0.25s ease; }
   .maintanence-landing :is(.btn-nav, .btn-primary-hero, .btn-price-filled, .outcomes-journey__go, .contact-form-wrap .cf-submit, .btn-unified--primary) { background: linear-gradient(180deg, var(--red) 0%, #a11b2b 100%); color: #fff !important; box-shadow: 0 10px 28px rgba(194, 32, 52, 0.28); }
   .maintanence-landing :is(.btn-nav, .btn-primary-hero, .btn-price-filled, .outcomes-journey__go, .contact-form-wrap .cf-submit, .btn-unified--primary):hover:not(:disabled) { background: linear-gradient(180deg, #d9344a 0%, #b21f31 100%); color: #fff !important; transform: translateY(-2px); box-shadow: 0 14px 36px rgba(194, 32, 52, 0.34); }
   .maintanence-landing :is(.btn-ghost-hero, .btn-price-outline, .btn-unified--outline) { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.22); color: #fff; }
   .maintanence-landing :is(.btn-ghost-hero, .btn-price-outline, .btn-unified--outline):hover { background: rgba(255,255,255,0.16); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(10, 16, 42, 0.25); }
   .btn-nav { padding: 10px 24px !important; font-size: 0.85rem !important; }
   .hero { height: 550px; background-color: #1e2154; background-image: linear-gradient(to bottom, #1e2152, rgba(30, 33, 84, 0.69)), url("<?php echo esc_url( get_template_directory_uri() . '/assets/home1.webp' ); ?>"); background-size: cover, cover; background-position: center, 67% 35%; background-repeat: no-repeat; position: relative; overflow: hidden; display: flex; align-items: center;}
   .hero-noise { position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E"); opacity: 0.12; pointer-events: none; }
   .hero-glow-1 { position: absolute; width: 700px; height: 700px; background: radial-gradient(circle, rgba(194,32,52,0.18) 0%, transparent 70%); top: -200px; right: -200px; pointer-events: none; }
   .hero-glow-2 { position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(99, 45, 233, 0.18) 0%, transparent 70%); bottom: -100px; left: -100px; pointer-events: none; }
   .hero-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 60px 60px; opacity: 0.35; pointer-events: none; }
   .hero-badge { display: inline-flex; align-items: center; gap: 8px; background: rgba(194, 32, 52, 0.12); border: 1px solid rgba(194, 32, 52, 0.28); color: #f0a4ae; font-size: 0.8rem; font-weight: 600; padding: 6px 16px; border-radius: 50px; margin-bottom: 28px; letter-spacing: 1px; text-transform: uppercase; }
   .hero-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--red); animation: pulse-dot 1.5s ease-in-out infinite; }
   @keyframes pulse-dot { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(0.7); } }
   .hero h1 { font-size: 44px; font-weight: 700; color: #fff; line-height: 1.1; letter-spacing: -0.02em; margin-bottom: 24px; }
   .hero h1 .highlight { color: var(--red); position: relative; }
   .hero h1 .highlight::after { content: ''; position: absolute; bottom: 4px; left: 0; right: 0; height: 3px; background: var(--red); opacity: 0.4; border-radius: 2px; }
   .hero-sub { font-size: 18px; color: #dadada; line-height: 1.6; max-width: 520px; font-weight: 500; text-align: left; margin-bottom: 24px; }
   .hero-points { list-style: none; margin: 0 0 28px; padding: 0; display: grid; gap: 10px; max-width: 560px; }
   .hero-points li { color: rgba(255, 255, 255, 0.9); font-size: 0.95rem; display: flex; align-items: center; gap: 10px; }
   .hero-points li i { color: #7cf0b2; font-size: 0.9rem; }
   .hero-ctas { display: flex; gap: 16px; flex-wrap: wrap; }
   .hero-metrics { margin-top: 22px; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 10px; max-width: 560px; }
   .hero-metric { background: rgba(255, 255, 255, 0.09); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 12px; padding: 12px 10px; text-align: center; }
   .hero-metric .num { display: block; color: #fff; font-size: 1.05rem; font-weight: 800; line-height: 1.1; }
   .hero-metric .lbl { display: block; color: rgba(255, 255, 255, 0.8); font-size: 0.72rem; margin-top: 4px; letter-spacing: 0.03em; }
   .hero-proof { margin-top: 20px; display: flex; gap: 12px; flex-wrap: wrap; }
   .hero-proof-item { padding: 8px 14px; border-radius: 999px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.08); color: rgba(255, 255, 255, 0.9); font-size: 0.78rem; font-weight: 600; letter-spacing: 0.03em; }
   @media (max-width: 767px) { .hero-metrics { grid-template-columns: 1fr 1fr; } }
   .btn-primary-hero { padding: 16px 32px; font-size: 0.95rem; border: none; }
   .btn-ghost-hero { padding: 16px 32px; font-size: 0.95rem; }
   .hero-stats-row { display: flex; gap: 40px; flex-wrap: wrap; padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.1); }
   .hero-stat-item .num { font-family: "Inter", sans-serif; font-size: 2rem; font-weight: 800; color: #fff; }
   .hero-stat-item .num span { color: var(--red); }
   .hero-stat-item .lbl { font-size: 14px; color: #dadada; font-weight: 500; margin-top: 2px; }
   .hero-img-wrap { position: relative; }
   .hero-main-img { width: 100%; border-radius: 20px; box-shadow: 0 40px 80px rgba(0,0,0,0.5); position: relative; z-index: 2; }
   .hero-card-float { position: absolute; background: rgba(30,33,84,0.92); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 16px 20px; z-index: 3; animation: floatY 5s ease-in-out infinite; }
   .hero-card-float.card-1 { top: -20px; left: -30px; min-width: 180px; }
   .hero-card-float.card-2 { bottom: 30px; right: -30px; min-width: 200px; }
   .hero-card-float .card-label { font-size: 0.72rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }
   .hero-card-float .card-value { font-family: "Inter", sans-serif; font-size: 1.4rem; font-weight: 800; color: #fff; }
   .hero-card-float .card-sub { font-size: 0.78rem; color: #4ade80; margin-top: 2px; }
   .hero-card-float .mini-bar { height: 4px; background: rgba(255,255,255,0.1); border-radius: 4px; margin-top: 10px; overflow: hidden; }
   .hero-card-float .mini-bar-fill { height: 100%; background: var(--red); border-radius: 4px; }
   @keyframes floatY { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
   .maintanence-landing .partners-section { position: relative; background-color: #ffffff; width: 100%; padding: 80px 0 60px; display: flex; justify-content: center; overflow: hidden; box-sizing: border-box; border-top: 1px solid #e8eaf0; border-bottom: 1px solid #e8eaf0; }
   .maintanence-landing .partners-container { position: relative; width: 100%; display: flex; flex-direction: column; align-items: center; gap: 30px; z-index: 2; }
   .maintanence-landing .partners-header-group { display: flex; flex-direction: column; align-items: center; text-align: center; gap: 15px; }
   .maintanence-landing .partners-title { font-size: 44px; font-weight: 700; line-height: 1.2; letter-spacing: -0.03em; color: #111111; margin: 0; }
   .maintanence-landing .partners-ticker-wrapper { border-radius: 20px; box-sizing: border-box; overflow: hidden; width: 100%; }
   .maintanence-landing .partners-ticker-inner { padding: 20px 0; overflow: hidden; position: relative; }
   .maintanence-landing .partners-ticker-track { display: flex; width: max-content; --gap: 40px; gap: var(--gap); padding-right: var(--gap); animation: maintanence-ticker-scroll 80s linear infinite; will-change: transform; }
   .maintanence-landing .partner-logo-item { height: 70px; width: auto !important; max-width: none !important; flex-shrink: 0; display: block; object-fit: contain; }
   @keyframes maintanence-ticker-scroll { 0% { transform: translate3d(0, 0, 0); } 100% { transform: translate3d(-50%, 0, 0); } }
   @media (prefers-reduced-motion: reduce) { .maintanence-landing .partners-ticker-track { animation: none; } }
   .section-chip { display: inline-block; background: rgba(194,32,52,0.1); color: var(--red); font-size: 0.78rem; font-weight: 700; padding: 5px 16px; border-radius: 12px; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 16px; }
   .section-title { font-size: 44px; margin-bottom: 20px; font-weight: 800; line-height: 1.15; color: #1e2154; }
   .section-title span { color: var(--red); }
   .section-sub { font-size: 18px; color: #5a6080; line-height: 1.65; font-weight: 400; max-width: 700px; text-align: center; }
   .services-section { padding: 60px 0; background: #e4e6eb; }
   .service-card { background: #ffffff; border: 1px solid rgba(30, 33, 84, 0.14); border-radius: 20px; padding: 40px; height: 100%; position: relative; overflow: hidden; cursor: default; display: flex; flex-direction: column; box-shadow: 0 1px 0 rgba(255, 255, 255, 0.9) inset, 0 20px 45px -12px rgba(30, 33, 84, 0.12), 0 8px 16px -8px rgba(30, 33, 84, 0.08), 0 0 0 1px rgba(194, 32, 52, 0.06); transition: border-color 0.4s var(--ease), box-shadow 0.4s var(--ease), transform 0.4s var(--ease); }
   .service-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--red) 0%, rgba(194, 32, 52, 0.55) 40%, rgba(30, 33, 84, 0.35) 100%); border-radius: 20px 20px 0 0; z-index: 0; pointer-events: none; opacity: 1; transition: opacity 0.4s var(--ease); }
   .service-card::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, var(--navy) 0%, #252a6e 100%); opacity: 0; transition: opacity 0.4s var(--ease); border-radius: 20px; z-index: 0; pointer-events: none; }
   .service-card:hover { transform: translateY(-8px); border-color: rgba(194, 32, 52, 0.35); box-shadow: 0 28px 56px -14px rgba(30, 33, 84, 0.22), 0 12px 24px -10px rgba(30, 33, 84, 0.12), 0 0 0 1px rgba(194, 32, 52, 0.22); }
   .service-card:hover::before { opacity: 0; }
   .service-card:hover::after { opacity: 1; }
   .service-card > * { position: relative; z-index: 1; }
   .service-card:hover h4, .service-card:hover p, .service-card:hover .tag { color: rgba(255,255,255,0.9); }
   .service-card:hover h4 { color: #fff; }
   .service-num { font-family: "Inter", sans-serif; display: inline-flex; align-items: center; font-size: 0.68rem; color: var(--red); font-weight: 700; letter-spacing: 0.14em; margin-bottom: 20px; padding: 7px 14px; border-radius: 999px; background: rgba(194, 32, 52, 0.1); border: 1px solid rgba(194, 32, 52, 0.2); transition: color 0.4s var(--ease), background 0.4s var(--ease), border-color 0.4s var(--ease); }
   .service-card:hover .service-num { color: rgba(255, 255, 255, 0.95); background: rgba(255, 255, 255, 0.12); border-color: rgba(255, 255, 255, 0.2); }
   .service-icon-wrap { width: 72px; height: 72px; background: rgba(194, 32, 52, 0.1); border: 1px solid rgba(194, 32, 52, 0.22); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.55rem; color: var(--red); margin-bottom: 24px; box-shadow: 0 6px 20px rgba(30, 33, 84, 0.1), 0 2px 8px rgba(194, 32, 52, 0.12); transition: transform 0.4s var(--ease), background 0.4s var(--ease), color 0.4s var(--ease), border-color 0.4s var(--ease), box-shadow 0.4s var(--ease); }
   .service-card:hover .service-icon-wrap { background: rgba(255,255,255,0.15); color: #fff; border-color: rgba(255, 255, 255, 0.25); box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2); transform: scale(1.05); }
   .service-card h4 { font-size: 1.25rem; font-weight: 700; margin-bottom: 12px; color: #1e2154; transition: color 0.4s; letter-spacing: -0.02em; }
   .service-card p { font-size: 15px; color: #3d4456; line-height: 1.65; transition: color 0.4s; flex: 1; }
   .service-card .tag { display: inline-block; margin-top: 20px; font-size: 0.75rem; font-weight: 600; color: var(--red); letter-spacing: 0.08em; text-transform: uppercase; transition: color 0.4s var(--ease), opacity 0.4s var(--ease); }
   .service-card:hover .tag { opacity: 1; color: rgba(255, 255, 255, 0.95); }
   .maintanence-landing .row.services-grid-compact { --bs-gutter-x: 1.9rem; --bs-gutter-y: 2.6rem; }
   .services-grid-compact .service-card { padding: 28px; border-radius: 16px; }
   .services-grid-compact .service-icon-wrap { width: 58px; height: 58px; border-radius: 14px; font-size: 1.2rem; margin-bottom: 16px; }
   .services-grid-compact .service-card h4 { font-size: 1.08rem; margin-bottom: 8px; }
   .services-grid-compact .service-card p { font-size: 14px; line-height: 1.55; }
   .services-grid-compact .service-card .tag { margin-top: 14px; font-size: 0.7rem; }
   .service-img-wrap { border-radius: 20px; overflow: hidden; height: 260px; position: relative; }
   .service-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
   .service-img-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(30,33,84,0.7), transparent); }
   .about-section { padding: 60px 0; background: var(--navy); position: relative; overflow: hidden; }
   .about-section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px; }
   .about-img-grid { display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: auto auto; gap: 12px; }
   .about-img-grid img { border-radius: 16px; width: 100%; object-fit: cover; }
   .about-img-grid img:first-child { grid-column: 1 / -1; height: 220px; }
   .about-img-grid img:nth-child(2) { height: 160px; }
   .about-img-grid img:nth-child(3) { height: 160px; }
   .about-badge-img { position: absolute; bottom: -16px; right: -16px; background: var(--red); border-radius: 16px; padding: 20px 24px; text-align: center; z-index: 2; }
   .about-badge-img .num { font-family: "Inter", sans-serif; font-size: 2rem; font-weight: 800; color: #fff; }
   .about-badge-img .lbl { font-size: 0.75rem; color: rgba(255,255,255,0.8); }
   .about-check-item { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 20px; }
   .about-check-item .check-icon { width: 36px; height: 36px; min-width: 36px; background: rgba(194,32,52,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--red); font-size: 0.8rem; margin-top: 2px; }
   .about-check-item h6 { font-size: 0.95rem; color: #fff; margin-bottom: 4px; }
   .about-check-item p { font-size: 15px; color: var(--muted); line-height: 1.6; }
   .stats-section { background: #fff; padding: 80px 0; border-top: 1px solid #ecedf5; border-bottom: 1px solid #ecedf5; }
   .stat-box { text-align: center; padding: 30px; border-right: 1px solid #ecedf5; }
   .stat-box:last-child { border-right: none; }
   .stat-box .big-num { font-family: "Inter", sans-serif; font-size: 3.2rem; font-weight: 800; color: var(--navy); line-height: 1; }
   .stat-box .big-num span { color: var(--red); }
   .stat-box p { font-size: 0.88rem; color: var(--muted); margin-top: 8px; font-weight: 400; }
   .process-section { padding: 60px 0; background: #e4e6eb; }
   .process-line { position: relative; }
   .process-line::before { content: ''; position: absolute; top: 30px; left: calc(50% + 30px); right: 0; height: 2px; background: linear-gradient(90deg, var(--red), transparent); }
   .process-step-card { background: #fff; border: 1.5px solid #ecedf5; border-radius: 20px; padding: 36px 28px; height: 100%; position: relative; transition: all 0.35s var(--ease); box-shadow: rgb(236 128 128 / 37%) 0px 4px 12px; }
   .process-step-card:hover { border-color: var(--red); transform: translateY(-6px); box-shadow: 0 20px 40px rgba(194,32,52,0.1); }
   .step-num-big { font-family: "Inter", sans-serif; font-size: 4rem; font-weight: 800; color: rgba(30,33,84,0.06); position: absolute; top: 16px; right: 20px; line-height: 1; }
   .step-icon { width: 56px; height: 56px; background: linear-gradient(135deg, var(--red), #ff6b35); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #fff; margin-bottom: 20px; }
   .process-step-card h4 { font-size: 1.1rem; color: var(--navy); margin-bottom: 10px;height:50px; }
   .process-step-card p { font-size: 15px; color: #5a6080; line-height: 1.65; }
   .cases-section { padding: 60px 0; background: #fff; }
   .case-card { border-radius: 24px; overflow: hidden; position: relative; height: 380px; cursor: pointer; transition: transform 0.4s var(--ease); }
   .case-card:hover { transform: scale(1.02); }
   .case-card img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s var(--ease); }
   .case-card:hover img { transform: scale(1.08); }
   .case-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(30,33,84,0.92) 40%, rgba(30,33,84,0.2) 100%); }
   .case-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 32px; }
   .case-tag { display: inline-block; background: var(--red); color: #fff; font-size: 0.7rem; font-weight: 700; padding: 4px 12px; border-radius: 50px; margin-bottom: 12px; letter-spacing: 1px; text-transform: uppercase; }
   .case-content h4 { color: #fff; font-size: 1.2rem; margin-bottom: 8px; }
   .case-content p { color: rgba(255,255,255,0.75); font-size: 15px; margin-bottom: 14px; }
   .case-result { font-family: "Inter", sans-serif; font-size: 1.8rem; font-weight: 800; color: var(--gold); }
   .case-result span { font-size: 0.8rem; font-weight: 400; color: rgba(255,255,255,0.7); font-family: "Inter", sans-serif; }
   .testimonials-section { padding: 60px 0; background: var(--navy); position: relative; overflow: hidden; }
   .testimonials-section::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px; }
   .swiper { padding-bottom: 50px !important; }
   .swiper-pagination-bullet { background: rgba(255,255,255,0.3) !important; }
   .swiper-pagination-bullet-active { background: var(--red) !important; }
   .testimonial-card { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.09); border-radius: 24px; padding: 40px; }
   .testi-quote { font-size: 2.5rem; color: var(--red); line-height: 1; margin-bottom: 16px; font-family: "Inter", sans-serif; }
   .testi-text { font-size: 16px; color: rgba(255,255,255,0.75); line-height: 1.65; margin-bottom: 28px; font-style: italic; }
   .testi-stars { color: var(--gold); font-size: 0.85rem; margin-bottom: 20px; }
   .testi-author { display: flex; align-items: center; gap: 14px; }
   .testi-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255,255,255,0.15); }
   .testi-author h6 { color: #fff; font-size: 0.95rem; margin-bottom: 2px; }
   .testi-author small { color: var(--muted); font-size: 0.8rem; }
   .team-section { padding: 100px 0; background: var(--light); }
   .team-card { background: #fff; border-radius: 20px; overflow: hidden; transition: all 0.35s var(--ease); border: 1.5px solid #ecedf5; }
   .team-card:hover { transform: translateY(-8px); box-shadow: 0 24px 50px rgba(30,33,84,0.12); border-color: var(--red); }
   .team-img-wrap { height: 240px; overflow: hidden; position: relative; }
   .team-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s var(--ease); }
   .team-card:hover .team-img-wrap img { transform: scale(1.05); }
   .team-social { position: absolute; inset: 0; background: rgba(30,33,84,0.7); display: flex; align-items: center; justify-content: center; gap: 12px; opacity: 0; transition: opacity 0.35s; }
   .team-card:hover .team-social { opacity: 1; }
   .team-social a { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.85rem; text-decoration: none; transition: background 0.3s; }
   .team-social a:hover { background: var(--red); }
   .team-info { padding: 24px; }
   .team-info h5 { font-size: 1.05rem; color: var(--navy); margin-bottom: 4px; }
   .team-info small { font-size: 0.8rem; color: var(--muted); }
   .pricing-section { padding: 100px 0; background: #fff; }
   .price-card { border-radius: 28px; padding: 48px 36px; border: 2px solid #ecedf5; transition: all 0.4s var(--ease); height: 100%; display: flex; flex-direction: column; }
   .price-card.featured { background: var(--navy); border-color: var(--navy); position: relative; overflow: hidden; }
   .price-card.featured::before { content: ''; position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(194,32,52,0.25), transparent 70%); }
   .price-card:not(.featured):hover { border-color: var(--red); transform: translateY(-8px); box-shadow: 0 24px 50px rgba(194,32,52,0.1); }
   .price-badge { display: inline-block; background: var(--red); color: #fff; font-size: 0.7rem; font-weight: 700; padding: 5px 14px; border-radius: 50px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 20px; }
   .price-card h4 { font-size: 1.3rem; color: var(--navy); margin-bottom: 8px; }
   .price-card.featured h4 { color: #fff; }
   .price-amount { font-family: "Inter", sans-serif; font-size: 3rem; font-weight: 800; color: var(--navy); line-height: 1; margin: 20px 0 6px; }
   .price-card.featured .price-amount { color: #fff; }
   .price-period { font-size: 0.85rem; color: var(--muted); margin-bottom: 28px; }
   .price-features { list-style: none; margin-bottom: 36px; flex: 1; }
   .price-features li { font-size: 15px; padding: 10px 0; border-bottom: 1px solid #ecedf5; color: #3a4060; display: flex; align-items: center; gap: 10px; }
   .price-features li i { color: var(--red); font-size: 0.75rem; }
   .price-card.featured .price-features li { color: rgba(255,255,255,0.75); border-bottom-color: rgba(255,255,255,0.08); }
   .btn-price { display: block; width: 100%; padding: 14px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; text-align: center; text-decoration: none; transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease, color 0.25s ease, border-color 0.25s ease; }
   .btn-price-outline { border: 1px solid rgba(30, 33, 84, 0.3); background: #fff; color: var(--navy); }
   .btn-price-outline:hover { background: var(--navy); border-color: var(--navy); color: #fff; transform: translateY(-2px); }
   .btn-price-filled { color: #fff; }
   .btn-price-filled:hover { color: #fff; transform: translateY(-2px); }
   .purchase-benefits-section { position: relative; padding: 100px 0; overflow: hidden; background: linear-gradient(135deg, var(--navy) 0%, #252a6e 55%, #1e2152 100%); }
   .purchase-benefits-section::before { content: ''; position: absolute; top: -40%; right: -15%; width: min(520px, 90vw); height: min(520px, 90vw); background: radial-gradient(circle, rgba(194, 32, 52, 0.18) 0%, transparent 65%); pointer-events: none; }
   .purchase-benefits-section .section-chip { background: rgba(255, 255, 255, 0.1); color: #fff; border: 1px solid rgba(255, 255, 255, 0.18); }
   .purchase-benefits-section .section-title { color: #fff; }
   .purchase-benefits-section .section-title span { color: var(--red-light); }
   .purchase-benefits-section .section-sub { color: #dadada; max-width: 640px; }
   .outcomes-root { text-align: center; max-width: 720px; margin: 0 auto 28px; padding: 0 8px; }
   .outcomes-root p { margin: 0; font-size: 16px; line-height: 1.65; color: rgba(255, 255, 255, 0.88); }
   .outcomes-root__meta { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px 18px; margin-top: 14px; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: rgba(255, 255, 255, 0.55); }
   .outcomes-root__meta span { color: var(--red-light); font-weight: 800; }
   .outcomes-journey { --journey-leg: 0; position: relative; max-width: 1020px; margin: 0 auto; border-radius: 24px; overflow: hidden; isolation: isolate; background: radial-gradient(ellipse 120% 80% at 50% 0%, rgba(255, 255, 255, 0.09) 0%, transparent 55%), linear-gradient(185deg, rgba(15, 18, 50, 0.95) 0%, rgba(25, 30, 75, 0.88) 45%, rgba(18, 22, 58, 0.98) 100%); border: 1px solid rgba(255, 255, 255, 0.12); box-shadow: 0 28px 60px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.06); }
   .outcomes-journey__sky { position: relative; z-index: 1; min-height: 200px; padding: 28px 20px 20px; display: flex; flex-direction: column; align-items: center; }
   .outcomes-journey__progress { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; justify-content: center; }
   .outcomes-journey__dot { width: 9px; height: 9px; border-radius: 50%; background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.25); transition: background 0.35s ease, transform 0.35s ease, box-shadow 0.35s ease; }
   .outcomes-journey__dot.is-done { background: var(--red); border-color: rgba(255, 255, 255, 0.35); box-shadow: 0 0 12px rgba(194, 32, 52, 0.45); transform: scale(1.15); }
   .outcomes-journey__stack { width: 100%; max-width: 560px; min-height: 100px; max-height: 300px; overflow-y: auto; overflow-x: hidden; padding-right: 4px; scrollbar-color: rgba(255, 255, 255, 0.35) rgba(255, 255, 255, 0.06); position: relative; text-align: center; }
   .outcomes-journey__benefit { max-height: 0; opacity: 0; overflow: hidden; transform: translateY(16px); filter: blur(10px); transition: max-height 0.85s var(--ease), opacity 0.65s ease, transform 0.85s var(--ease), filter 0.65s ease, margin 0.35s ease; margin-bottom: 0; }
   .outcomes-journey__benefit.is-revealed { max-height: 340px; opacity: 1; transform: translateY(0); filter: blur(0); margin-bottom: 14px; }
   .outcomes-journey__benefit:last-child.is-revealed { margin-bottom: 0; }
   .outcomes-journey__eyebrow { display: block; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.22em; text-transform: uppercase; color: var(--red-light); margin-bottom: 8px; }
   .outcomes-journey__benefit h3 { font-size: clamp(1.1rem, 2.5vw, 1.35rem); font-weight: 700; color: #fff; margin: 0 0 10px; line-height: 1.25; letter-spacing: -0.02em; }
   .outcomes-journey__benefit p { font-size: 15px; line-height: 1.65; color: rgba(255, 255, 255, 0.84); margin: 0; }
   .outcomes-journey__road-wrap { position: relative; z-index: 2; perspective: 560px; padding: 0 16px 0; }
   .outcomes-journey__road { position: relative; height: 160px; margin: 0 auto; max-width: 920px; transform-style: preserve-3d; }
   .outcomes-journey__road-surface { position: absolute; left: 50%; bottom: 0; width: 88%; max-width: 720px; height: 120px; transform: translateX(-50%) rotateX(56deg); transform-origin: 50% 100%; background: linear-gradient(180deg, #2a3358 0%, #1a1f3d 40%, #12152c 100%); border-radius: 12px 12px 4px 4px; overflow: hidden; box-shadow: 0 -20px 40px rgba(0, 0, 0, 0.45), inset 0 0 0 1px rgba(255, 255, 255, 0.06); }
   .outcomes-journey__road-surface::before { content: ''; position: absolute; left: 0; right: 0; top: 0; height: 200%; background: repeating-linear-gradient(0deg, transparent 0, transparent 14px, rgba(255, 255, 255, 0.12) 14px, rgba(255, 255, 255, 0.12) 16px); background-size: 100% 32px; opacity: 0.65; }
   .outcomes-journey.is-rolling .outcomes-journey__road-surface::before { animation: journey-road-roll 0.9s linear forwards; }
   @keyframes journey-road-roll { from { transform: translateY(0); } to { transform: translateY(44px); } }
   .outcomes-journey__horizon { position: absolute; left: 8%; right: 8%; bottom: 118px; height: 2px; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent); opacity: 0.7; pointer-events: none; }
   .outcomes-journey__truck { position: absolute; left: 50%; bottom: 52px; z-index: 4; font-size: clamp(2.2rem, 6vw, 3.4rem); line-height: 1; filter: drop-shadow(0 14px 24px rgba(0, 0, 0, 0.5)) drop-shadow(0 4px 0 rgba(0, 0, 0, 0.35)); transform: translate3d(calc(-50% + var(--journey-leg) * clamp(28px, 7.5vw, 76px)), 0, 0); transition: transform 1.05s cubic-bezier(0.22, 1, 0.36, 1); will-change: transform; }
   .outcomes-journey__truck.is-bounce { animation: journey-truck-bounce 1.05s cubic-bezier(0.22, 1, 0.36, 1); }
   .outcomes-journey__truck i { display: block; color: #f0f2f8; }
   .outcomes-journey__truck-glow { position: absolute; left: 50%; bottom: -8px; width: 70%; height: 14px; transform: translateX(-50%); background: radial-gradient(ellipse, rgba(194, 32, 52, 0.45) 0%, transparent 70%); opacity: 0.85; pointer-events: none; z-index: -1; }
   @keyframes journey-truck-bounce { 0%, 100% { margin-bottom: 0; } 25% { margin-bottom: 4px; } 50% { margin-bottom: -2px; } 75% { margin-bottom: 3px; } }
   .outcomes-journey__hud { position: relative; z-index: 5; display: flex; flex-direction: column; align-items: center; gap: 10px; margin-top: 4px; padding-bottom: 24px; }
   .outcomes-journey__go { appearance: none; border: none; cursor: pointer; font-family: "Inter", sans-serif; font-weight: 600; font-size: 0.95rem; letter-spacing: 0.06em; text-transform: uppercase; color: #fff; padding: 16px 40px; border-radius: 12px; background: var(--red); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.12); transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease; }
   .outcomes-journey__go:hover:not(:disabled) { background: var(--red-light); transform: translateY(-2px); box-shadow: 0 14px 34px rgba(0, 0, 0, 0.3); }
   .outcomes-journey__go:focus-visible { outline: 2px solid #fff; outline-offset: 3px; }
   .outcomes-journey__go:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }
   .outcomes-journey__hint { margin: 0; font-size: 0.8rem; color: rgba(255, 255, 255, 0.5); max-width: 26rem; text-align: center; }
   .outcomes-journey.is-static-all .outcomes-journey__benefit { max-height: none; opacity: 1; transform: none; filter: none; margin-bottom: 16px; }
   .outcomes-journey.is-static-all .outcomes-journey__truck { transition: none; }
   @media (max-width: 576px) { .outcomes-journey__sky { min-height: 180px; padding: 22px 14px 14px; } .outcomes-journey__road { height: 140px; } }
   .demand-map-section { padding: clamp(56px, 8vw, 90px) 0; background: #1e2154; overflow: hidden; position: relative; }
   .demand-map-section::before { content: ''; position: absolute; inset: 0; pointer-events: none; background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 56px 56px; opacity: 0.35; }
   .demand-map-header { text-align: center; max-width: 840px; margin: 0 auto clamp(28px, 4vw, 42px); position: relative; z-index: 1; }
   .demand-map-title { color: #fff; font-size: 44px; line-height: 1.15; letter-spacing: -0.03em; margin: 0 0 14px; }
   .demand-map-title span { color: #ff6b7d; }
   .demand-map-desc { margin: 0 auto; color: rgba(255, 255, 255, 0.78); font-size: 18px; }
   .demand-map-layout { display: grid; grid-template-columns: 1fr minmax(280px, 360px) 1fr; align-items: center; gap: clamp(18px, 2.8vw, 34px); position: relative; z-index: 1; }
   .demand-map-column { display: grid; gap: 18px; }
   .demand-map-card { position: relative; border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 16px; background: rgba(255, 255, 255, 0.08); box-shadow: 0 14px 34px rgba(5, 8, 24, 0.28); backdrop-filter: blur(8px); padding: 22px 22px 20px; min-height: 118px; }
   .demand-map-card h4 { margin: 0 0 8px; color: #fff; font-size: clamp(1rem, 1.2vw, 1.15rem); letter-spacing: -0.02em; line-height: 1.25; }
   .demand-map-card p { margin: 0; color: rgba(240, 245, 255, 0.8); font-size: 0.92rem; line-height: 1.55; }
   .demand-map-card::after { content: ''; position: absolute; top: 50%; width: clamp(36px, 4.8vw, 64px); border-top: 2px dashed rgba(255, 255, 255, 0.42); transform: translateY(-50%); opacity: 0.95; }
   .demand-map-left .demand-map-card::after { right: calc(-1 * clamp(40px, 5.3vw, 72px)); }
   .demand-map-right .demand-map-card::after { left: calc(-1 * clamp(40px, 5.3vw, 72px)); }
   .demand-map-center { position: relative; z-index: 2; display: flex; justify-content: center; }
   .demand-phone { width: min(100%, 340px); aspect-ratio: 9 / 18; border-radius: 38px; padding: 10px; background: linear-gradient(180deg, #2f3760 0%, #141a36 100%); box-shadow: 0 26px 64px rgba(5, 8, 24, 0.52); border: 2px solid rgba(255, 255, 255, 0.2); position: relative; }
   .demand-phone::before { content: ''; position: absolute; width: 36%; height: 20px; top: 7px; left: 50%; transform: translateX(-50%); border-radius: 0 0 16px 16px; background: #11162f; }
   .demand-phone-screen { width: 100%; height: 100%; border-radius: 30px; overflow: hidden; background: #0f1329; }
   .demand-phone-screen img { width: 100%; height: 100%; object-fit: cover; display: block; }
   @media (max-width: 1199px) { .demand-map-layout { grid-template-columns: 1fr; gap: 22px; } .demand-map-header { margin-bottom: 26px; } .demand-map-column { grid-template-columns: 1fr; } .demand-map-card::after { display: none; } .demand-map-center { order: -1; } .demand-phone { max-width: 320px; } }
   @media (max-width: 767px) { .demand-map-card { min-height: auto; padding: 18px; } .demand-phone { max-width: 286px; border-radius: 30px; } .demand-phone-screen { border-radius: 24px; } }
   .faq-section.faq-section-split { position: relative; overflow: hidden; padding: clamp(80px, 11vw, 60px) 0; background: linear-gradient(168deg, #161839 0%, #1e2152 42%, #242a6b 100%); }
   .faq-section-split .faq-split-bg { pointer-events: none; position: absolute; inset: 0; z-index: 0; background-image: linear-gradient(rgba(255, 255, 255, 0.028) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.028) 1px, transparent 1px); background-size: 52px 52px; mask-image: radial-gradient(ellipse 85% 70% at 50% 40%, #000 20%, transparent 72%); }
   .faq-section-split .faq-split-bg::after { content: ''; position: absolute; width: min(520px, 90vw); height: min(520px, 90vw); top: -18%; right: -12%; border-radius: 50%; background: radial-gradient(circle, rgba(194, 32, 52, 0.22) 0%, transparent 70%); filter: blur(4px); }
   .faq-section-split .faq-split-container { position: relative; z-index: 1; }
   .faq-section-split .faq-split-row { align-items: stretch; }
   .faq-section-split .faq-split-visual { position: relative; height: 100%; min-height: 420px; }
   .faq-section-split .faq-split-visual__accent { position: absolute; left: -4px; top: 14%; bottom: 14%; width: 4px; border-radius: 4px; }
   .faq-img-wrap { border-radius: 24px; overflow: hidden; height: 100%; min-height: 400px; position: relative; box-shadow: 0 28px 70px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(255, 255, 255, 0.12); }
   .faq-section-split .faq-img-wrap img { width: 100%; height: 100%; object-fit: cover; transform: scale(1.02); }
   .faq-img-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(30, 33, 84, 0.8), rgba(194, 32, 52, 0.4)); }
   .faq-img-text { position: absolute; bottom: 32px; left: 32px; right: 32px; }
   .faq-img-text h4 { color: #fff; font-size: 1.4rem; margin-bottom: 8px; }
   .faq-img-text p { color: rgba(255, 255, 255, 0.75); font-size: 15px; }
   .faq-section-split .faq-split-caption { margin-top: 1.25rem; padding: 1rem 1.25rem; border-radius: 14px; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1); display: flex; align-items: flex-start; gap: 12px; font-size: 0.9rem; line-height: 1.55; color: rgba(255, 255, 255, 0.82); }
   .faq-section-split .faq-split-caption i { color: var(--red-light); font-size: 1.1rem; margin-top: 2px; flex-shrink: 0; }
   .faq-section-split .faq-split-content { padding: clamp(8px, 2vw, 16px) 0 0; }
   @media (min-width: 992px) { .faq-section-split .faq-split-content { padding: 12px 0 0 8px; } }
   .faq-section-split .faq-split-content .section-chip { background: rgba(194, 32, 52, 0.2); color: #ffb3be; border: 1px solid rgba(194, 32, 52, 0.35); }
   .faq-section-split .faq-split-content .section-title { color: #fff; font-size: clamp(2rem, 4.2vw, 2.75rem); letter-spacing: -0.04em; margin-bottom: 30px; }
   .faq-section-split .faq-split-lead { font-size: clamp(15px, 1.35vw, 17px); line-height: 1.65; color: rgba(255, 255, 255, 0.68); font-weight: 400; max-width: 36em; margin-bottom: 1.75rem; }
   .faq-section-split .faq-list { display: flex; flex-direction: column; gap: 14px; }
   .faq-section-split .faq-item { background: rgba(255, 255, 255, 0.06); border-radius: 12px; padding: 20px 22px; cursor: pointer; transition: background 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 8px 28px rgba(0, 0, 0, 0.18); }
   .faq-section-split .faq-item:hover { background: rgba(255, 255, 255, 0.09); border-color: rgba(255, 255, 255, 0.16); }
   .faq-section-split .faq-item.active { border-color: rgba(194, 32, 52, 0.45); box-shadow: 0 12px 36px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(194, 32, 52, 0.2); }
   .faq-section-split .faq-header { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
   .faq-section-split .faq-question { font-size: 20px; font-weight: 600; color: #fff; margin: 0; line-height: 1.35; }
   .faq-section-split .faq-icon { color: rgba(255, 255, 255, 0.85); font-size: 14px; transition: transform 0.3s ease; flex-shrink: 0; }
   .faq-section-split .faq-item.active .faq-icon { transform: rotate(180deg); color: var(--red-light); }
   .faq-section-split .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
   .faq-section-split .faq-answer p { margin: 0; padding-top: 16px; color: rgba(255, 255, 255, 0.78); font-size: 15px; line-height: 1.65; }
   @media (max-width: 991px) { .faq-section-split .faq-split-visual { min-height: 320px; } .faq-section-split .faq-split-visual__accent { display: none; } }
   .faq-section.faq-section-split.faq-section-split--light { background: #fff; }
   .faq-section-split.faq-section-split--light .faq-split-bg, .faq-section-split.faq-section-split--light .faq-split-bg::after { background: transparent; opacity: 0; }
   .faq-section-split.faq-section-split--light .faq-split-content .section-title { color: var(--navy); }
   .faq-section-split.faq-section-split--light .faq-item { background: #fff; border: 1px solid #e8ecf1; box-shadow: 0 10px 28px rgba(30, 33, 84, 0.08); }
   .faq-section-split.faq-section-split--light .faq-item:hover { background: #f8fafc; border-color: #dbe3ee; }
   .faq-section-split.faq-section-split--light .faq-question { color: var(--navy); }
   .faq-section-split.faq-section-split--light .faq-icon { color: #64748b; }
   .faq-section-split.faq-section-split--light .faq-answer p { color: #475569; }
   .contact-section { padding: 60px 0; background: var(--navy); position: relative; overflow: hidden; }
   .contact-section::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 50px 50px; }
   .contact-form-wrap { background: #fff; border: 1px solid #e8ecf1; border-radius: 28px; padding: 44px 48px; box-shadow: 0 22px 55px rgba(30, 33, 84, 0.12); }
   .contact-form-wrap .cf-header { margin-bottom: 28px; }
   .contact-form-wrap .cf-title { color: var(--navy); font-size: 1.65rem; font-weight: 800; margin: 0 0 10px; letter-spacing: -0.03em; line-height: 1.2; }
   .contact-form-wrap .cf-lead { color: #64748b; font-size: 15px; line-height: 1.65; margin: 0; }
   .contact-form-wrap .cf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 24px; margin-bottom: 20px; }
   .contact-form-wrap .cf-field { display: flex; flex-direction: column; gap: 8px; }
   .contact-form-wrap .cf-field--full { grid-column: 1 / -1; }
   .contact-form-wrap .cf-label { font-weight: 600; font-size: 14px; color: #0f172a; }
   .contact-form-wrap .cf-req { color: var(--red); margin-left: 2px; }
   .contact-form-wrap .cf-input { padding: 14px 18px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px; font-family: inherit; font-weight: 500; color: #0f172a; background: #fff; width: 100%; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
   .contact-form-wrap .cf-input::placeholder { color: #94a3b8; }
   .contact-form-wrap .cf-input:focus { outline: none; border-color: var(--red); box-shadow: 0 0 0 4px rgba(194, 32, 52, 0.12); }
   .contact-form-wrap .cf-textarea { min-height: 140px; resize: vertical; }
   .contact-form-wrap .cf-submit { width: 100%; margin-top: 8px; padding: 16px 24px; border: none; border-radius: 12px; background: linear-gradient(180deg, var(--red) 0%, #a11b2b 100%); color: #fff; font-size: 16px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 10px 30px rgba(194, 32, 52, 0.35); transition: transform 0.2s ease, box-shadow 0.2s ease; }
   .contact-form-wrap .cf-submit:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(194, 32, 52, 0.42); }
   .contact-form-wrap .cf-submit:disabled { opacity: 0.8; cursor: not-allowed; transform: none; }
   .contact-form-wrap .cf-success { display: none; margin-top: 18px; padding: 16px; border-radius: 12px; background: linear-gradient(135deg, #10b981, #059669); color: #fff; text-align: center; font-weight: 600; font-size: 15px; }
   .contact-form-wrap .cf-success.is-visible { display: block; }
   @media (max-width: 767px) { .contact-form-wrap .cf-grid { grid-template-columns: 1fr; } }
   .contact-info-item { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 28px; }
   .contact-info-item .icon-wrap { width: 48px; height: 48px; min-width: 48px; background: rgba(194,32,52,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--red); font-size: 1rem; }
   .contact-info-item h6 { color: rgba(255,255,255,0.5); font-size: 0.75rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px; }
   .contact-info-item p { color: #fff; font-size: 15px; font-weight: 500; }
   .contact-keypoints { display: flex; flex-direction: column; gap: 10px; padding-left: 0; align-items: baseline; }
   .contact-keypoints__item { display: flex; align-items: center; justify-content: center; gap: 10px; padding: 6px 0; border-top: none; }
   .contact-keypoints__item::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: #fff; flex-shrink: 0; }
   .contact-keypoints__item:first-child { padding-top: 6px; }
   .contact-keypoints__icon { width: 46px; height: 46px; min-width: 46px; background: rgba(194, 32, 52, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--red); font-size: 1rem; }
   .contact-keypoints__title { display: block; color: #fff; font-size: 0.98rem; font-weight: 700; margin-bottom: 6px; letter-spacing: -0.02em; text-align: center; }
   .contact-keypoints__text { display: block; color: rgba(255, 255, 255, 0.58); font-size: 0.88rem; font-weight: 400; line-height: 1.55; }
   .cta-section { padding: 60px 0; background: linear-gradient(135deg, var(--red) 0%, #8b1524 100%); position: relative; overflow: hidden; }
   .cta-section::before { content: ''; position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(255,255,255,0.05); border-radius: 50%; }
   .cta-section h2 { font-size: 44px; color: #fff; }
   .cta-section p { color: rgba(255,255,255,0.85); font-size: 18px; line-height: 1.6; }
   .btn-cta-white { background: #fff; color: var(--red); padding: 16px 32px; border-radius: 12px; font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: all 0.35s var(--ease); display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); }
   .btn-cta-white:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.2); color: var(--red); }
   footer { background: #070919; color: #fff; padding: 80px 0 0; }
   .footer-brand { font-family: "Inter", sans-serif; font-size: 1.5rem; font-weight: 800; margin-bottom: 16px; }
   .footer-brand span { color: var(--red); }
   .footer-desc { font-size: 0.88rem; color: rgba(255,255,255,0.5); line-height: 1.7; max-width: 280px; margin-bottom: 24px; }
   .footer-social a { width: 38px; height: 38px; border-radius: 50%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.6); font-size: 0.85rem; text-decoration: none; margin-right: 8px; transition: all 0.3s; }
   .footer-social a:hover { background: var(--red); border-color: var(--red); color: #fff; }
   .footer-heading { font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 20px; }
   .footer-link { display: block; color: rgba(255,255,255,0.6); font-size: 0.88rem; text-decoration: none; margin-bottom: 10px; transition: all 0.3s; }
   .footer-link:hover { color: #fff; padding-left: 6px; }
   .footer-bottom { border-top: 1px solid rgba(255,255,255,0.07); padding: 24px 0; margin-top: 60px; }
   .footer-bottom p { font-size: 0.82rem; color: rgba(255,255,255,0.35); margin: 0; }
   #backToTop { position: fixed; bottom: 30px; right: 30px; width: 46px; height: 46px; background: var(--red); color: #fff; border: none; border-radius: 50%; font-size: 0.9rem; cursor: pointer; display: none; box-shadow: 0 8px 20px rgba(194,32,52,0.35); transition: all 0.3s var(--ease); z-index: 999; }
   #backToTop:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(194,32,52,0.45); }
   @media (max-width: 1024px) { .services-section, .about-section, .process-section, .cases-section, .testimonials-section, .team-section, .pricing-section, .purchase-benefits-section, .faq-section, .contact-section { padding: 72px 0; } .stats-section { padding: 56px 0; } .maintanence-landing .partners-section { padding: 40px 0; } .cta-section { padding: 60px 0; } .service-card { padding: 32px; } .process-step-card { padding: 28px 22px; } .testimonial-card { padding: 32px; } .price-card { padding: 40px 28px; } .contact-form-wrap { padding: 36px 28px; } }
   @media (max-width: 991px) { .hero { text-align: center; padding: 110px 0 52px; min-height: auto; } .hero-ctas { justify-content: center; } .hero-stats-row { justify-content: center; } .hero-sub { margin-left: auto; margin-right: auto; } .hero-img-wrap { margin-top: 48px; } .hero-card-float.card-1 { left: -10px; } .hero-card-float.card-2 { right: -10px; } .stat-box { border-right: none; border-bottom: 1px solid #ecedf5; } .stat-box:last-child { border-bottom: none; } }
   @media (max-width: 768px) { .hero h1 { font-size: 30px; } .hero { padding: 104px 0 48px; min-height: auto; } .maintanence-landing .container { padding-left: 15px !important; padding-right: 15px !important; } .services-section, .about-section, .process-section, .cases-section, .testimonials-section, .team-section, .pricing-section, .purchase-benefits-section, .faq-section, .contact-section { padding: 56px 0; } .stats-section { padding: 48px 0; } .maintanence-landing .partners-ticker-track { --gap: 30px; } .maintanence-landing .partners-section { padding: 48px 0 40px; } .maintanence-landing .partners-title { font-size: 30px; } .maintanence-landing .partner-logo-item { height: 52px; } .cta-section { padding: 48px 0; } .service-card { padding: 28px 22px; } .process-step-card { padding: 24px 20px; } .case-content { padding: 24px; } .testimonial-card { padding: 28px 22px; } .price-card { padding: 32px 22px; } .contact-form-wrap { padding: 28px 20px; } .faq-img-wrap { min-height: 280px; } .faq-img-text { bottom: 24px; left: 24px; right: 24px; } .stat-box { padding: 22px 16px; } .stat-box .big-num { font-size: 2.5rem; } .team-img-wrap { height: 220px; } #backToTop { bottom: 20px; right: 15px; } }
   @media (max-width: 576px) { .hero-card-float { display: none !important; } }
   @media (prefers-reduced-motion: reduce) { .service-card, .service-card::before, .service-card::after, .service-num, .service-icon-wrap, .service-card h4, .service-card p, .service-card .tag { transition-duration: 0.01ms !important; } .service-card:hover { transform: none; } .service-card:hover .service-icon-wrap { transform: none; } .outcomes-journey__truck { transition: none !important; transform: translate3d(-50%, 0, 0) !important; } .outcomes-journey__benefit { transition: none !important; filter: none !important; max-height: none !important; opacity: 1 !important; transform: none !important; margin-bottom: 16px !important; } .outcomes-journey__road-surface::before { animation: none !important; } .outcomes-journey__go { display: none !important; } .outcomes-journey__hint { display: none !important; } .outcomes-journey__dot { background: var(--red); transform: scale(1.1); } .outcomes-journey__stack { max-height: none !important; } }
</style>
<main class="maintanence-landing">
   <div id="preloader">
      <div class="preloader-inner">
         <div class="preloader-logo"><span>Sales</span>Nanny</div>
         <div class="preloader-bar"></div>
      </div>
   </div>
   <div id="scroll-progress"></div>
   <!-- ══ HERO — OPTION D ══ -->
   <section class="hero hero-d">
      <div class="hero-d__grid" aria-hidden="true"></div>
      <div class="hero-d__stripe" aria-hidden="true"></div>
      <div class="hero-d__img" aria-hidden="true">
         <img
            src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&q=80&w=1200"
            alt=""
            width="1200" height="800"
            loading="eager" fetchpriority="high" decoding="sync">
      </div>
      <div class="container hero-d__container">
         <div class="hero-d__content" data-aos="fade-right" data-aos-duration="900">
            <h1 class="hero-d__h1">
               Get Found Online by the Right Customers  
               <span class="hero-d__h1-red">Without Spending on Ads </span>
            </h1>
            <p class="hero-d__desc">
               We help businesses grow their digital presence, rank higher on search engines, and attract consistent inbound inquiries through proven organic marketing strategies: SEO, content, social, and email. 
            </p>
            <a href="../online-meeting/" class="hero-d__btn">
               Book a Free Audit
               <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2.5"
                  stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <line x1="5" y1="12" x2="19" y2="12"/>
                  <polyline points="12 5 19 12 12 19"/>
               </svg>
            </a>
         </div>
      </div>
   </section>
   <style>
      /* ── Option D wrapper ───────────────────────────────────────── */
      .hero-d {
      height: auto !important;
      min-height: 560px;
      background: #1e2154;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
      padding: 120px 0 40px;
      }
      /* grid dots */
      .hero-d__grid {
      position: absolute;
      inset: 0;
      background-image:
      linear-gradient(rgba(255,255,255,.022) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.022) 1px, transparent 1px);
      background-size: 54px 54px;
      pointer-events: none;
      }
      /* vertical red stripe — far left */
      .hero-d__stripe {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 5px;
      background: #c22034;
      }
      /* faded image — right half */
      .hero-d__img {
      position: absolute;
      right: 0;
      top: 0;
      bottom: 0;
      width: 60%;
      pointer-events: none;
      overflow: hidden;
      }
      .hero-d__img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: .38;
      filter: grayscale(35%);
      display: block;
      }
      .hero-d__img::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, #1e2154 0%, transparent 55%);
      }
      /* content */
      .hero-d__container {
      position: relative;
      z-index: 2;
      }
      .hero-d__content {
      max-width: 900px;
      }
      /* headline */
      .hero-d__h1 {
      font-size: clamp(32px, 4.2vw, 54px);
      font-weight: 800;
      color: #ffffff;
      line-height: 1.0;
      letter-spacing: -.04em;
      margin-bottom: 22px;
      }
      .hero-d__h1-red {
      display: block;
      color: #c22034;
      }
      /* description */
      .hero-d__desc {
      font-size: 18px;
      color: rgba(255,255,255,.62);
      /* line-height: 1.72; */
      max-width: 400px;
      text-align: justify;
      margin-bottom: 36px;
      font-weight: 400;
      }
      /* ghost button */
      .hero-d__btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: transparent;
      border: 1.5px solid rgba(255,255,255,.35);
      color: #fff;
      text-decoration: none;
      padding: 14px 28px;
      border-radius: 9px;
      font-size: 15px;
      font-weight: 700;
      letter-spacing: .01em;
      transition: border-color .25s ease, background .25s ease, transform .2s ease;
      }
      .hero-d__btn svg {
      transition: transform .2s ease;
      flex-shrink: 0;
      }
      .hero-d__btn:hover {
      border-color: #fff;
      background: rgba(255,255,255,.07);
      transform: translateY(-2px);
      color: #fff;
      }
      .hero-d__btn:hover svg {
      transform: translateX(3px);
      }
      /* responsive */
      @media (max-width: 991px) {
      .hero-d { text-align: center; }
      .hero-d__content {
      max-width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      }
      .hero-d__desc { margin-left: auto; margin-right: auto; }
      .hero-d__img { width: 100%; opacity: .15; }
      .hero-d__img::after { background: linear-gradient(to bottom, #1e2154 0%, transparent 60%); }
      }
      @media (max-width: 576px) {
      .hero-d { min-height: 480px; padding: 100px 0 56px; }
      }
      @media (prefers-reduced-motion: reduce) {
      .hero-d__btn, .hero-d__btn svg { transition: none; }
      }
   </style>
   <!-- ── PARTNERS ── -->
   <section class="partners-section">
      <div class="container partners-container">
         <div class="partners-header-group">
            <h2 class="partners-title">Trusted by Growing Businesses Worldwide</h2>
         </div>
         <div class="partners-ticker-wrapper">
            <div class="partners-ticker-inner">
               <div class="partners-ticker-track" id="maintanenceLogoTicker">
                  <img class="partner-logo-item"
                     src="<?php echo esc_url( get_template_directory_uri() . '/assets/logoset.webp' ); ?>"
                     alt="<?php echo esc_attr__( 'Client Logos', 'salesnanny' ); ?>"
                     loading="lazy"
                     decoding="async">
               </div>
            </div>
         </div>
      </div>
   </section>
   <script>
      document.addEventListener('DOMContentLoaded', function () {
          const track = document.getElementById('maintanenceLogoTicker');
          if (!track) return;
          const image = track.querySelector('.partner-logo-item');
          if (!image) return;
          function buildMarquee() {
              const items = Array.from(track.children);
              track.innerHTML = '';
              track.appendChild(items[0]);
              const imageWidth = items[0].getBoundingClientRect().width;
              const screenWidth = window.innerWidth;
              if (imageWidth === 0) return;
              let totalImagesNeeded = Math.ceil(screenWidth / imageWidth) * 2;
              if (totalImagesNeeded % 2 !== 0) totalImagesNeeded += 1;
              totalImagesNeeded += 2;
              const fragment = document.createDocumentFragment();
              for (let i = 1; i < totalImagesNeeded; i++) {
                  fragment.appendChild(items[0].cloneNode(true));
              }
              track.appendChild(fragment);
          }
          if (image.complete) {
              buildMarquee();
          } else {
              image.addEventListener('load', buildMarquee);
          }
          let resizeTimer;
          window.addEventListener('resize', function () {
              clearTimeout(resizeTimer);
              resizeTimer = setTimeout(buildMarquee, 250);
          });
      });
   </script>
   <!-- ── SERVICES ── -->
   <section id="services" class="services-section">
      <div class="container">
         <div class="row align-items-end mb-5">
            <div class="col-lg-6" data-aos="fade-up">
               <h2 class="section-title">Core Organic Marketing <span>Solutions</span></h2>
            </div>
            <div class="col-lg-5 offset-lg-1" data-aos="fade-up" data-aos-delay="100">
               <p class="section-sub">We don't just promise visibility &mdash; we build a complete organic engine that turns your website into your best salesperson.</p>
            </div>
         </div>
         <div class="row g-4 mb-4">
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="50">
               <div class="service-img-wrap">
                  <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&q=80&w=900" alt="Content strategy and SEO">
                  <div class="service-img-overlay"></div>
                  <div style="position:absolute;bottom:24px;left:24px;z-index:2;">
                     <div style="font-size:0.75rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:1px;">Pillar</div>
                     <div style="font-family:'Inter',sans-serif;font-size:22px;font-weight:800;color:#fff;">Content &amp; SEO</div>
                  </div>
               </div>
            </div>
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
               <div class="service-img-wrap">
                  <img src="https://images.unsplash.com/photo-1471440671318-55bdbb772f93?auto=format&fit=crop&q=80&w=900" alt="Organic growth engine">
                  <div class="service-img-overlay"></div>
                  <div style="position:absolute;bottom:24px;left:24px;z-index:2;">
                     <div style="font-size:0.75rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:1px;">Program</div>
                     <div style="font-family:'Inter',sans-serif;font-size:22px;font-weight:800;color:#fff;">Organic Growth Engine</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row g-4 align-items-center services-grid-compact">
            <div class="col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
               <div class="service-card w-100">
                  <div class="service-icon-wrap"><i class="fas fa-search"></i></div>
                  <h4>Search Engine Optimisation (SEO)</h4>
                  <p>Rank-focused campaigns that improve your visibility on search engines through on-page, off-page, and website content optimisation &mdash; helping your business appear in relevant search results when customers search online.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="150">
               <div class="service-card w-100">
                  <div class="service-icon-wrap"><i class="fas fa-pen-fancy"></i></div>
                  <h4>Content Marketing</h4>
                  <p>Strategic blogs, guides, and articles that rank on Google and convert visitors into qualified inquiries &mdash; mapped to how your customers actually search and evaluate options.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
               <div class="service-card w-100">
                  <div class="service-icon-wrap"><i class="fas fa-share-alt"></i></div>
                  <h4>Organic Social Media Marketing</h4>
                  <p>Consistent, value-driven content that builds your brand presence and connects with the right audience &mdash; without relying on ad spend for every touchpoint.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="250">
               <div class="service-card w-100">
                  <div class="service-icon-wrap"><i class="fas fa-envelope-open-text"></i></div>
                  <h4>Email Campaign Marketing</h4>
                  <p>Segmented email sequences and newsletters that keep prospects warm and existing customers engaged &mdash; turning every touchpoint into a revenue opportunity.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
               <div class="service-card w-100">
                  <div class="service-icon-wrap"><i class="fas fa-users"></i></div>
                  <h4>Community Building &amp; Brand Authority</h4>
                  <p>Thought leadership and brand presence that position you as a trusted voice in your industry &mdash; building credibility before customers ever pick up the phone.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="350">
               <div class="service-card w-100">
                  <div class="service-icon-wrap"><i class="fas fa-funnel-dollar"></i></div>
                  <h4>Organic Lead Generation</h4>
                  <p>SEO-driven funnels and lead magnets that capture qualified inquiries on autopilot &mdash; consistent inbound demand without depending on paid advertising.</p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- ── ABOUT / WHY US ── -->
   <section id="about" class="about-section">
      <div class="container position-relative">
         <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
               <div class="position-relative">
                  <div class="about-img-grid">
                     <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&q=80&w=900" alt="Organic marketing team collaboration" style="height:220px;object-fit:cover;">
                     <img src="https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?auto=format&fit=crop&q=80&w=500" alt="SEO and content planning" style="height:160px;object-fit:cover;">
                     <img src="https://images.unsplash.com/photo-1565728744382-61accd4aa148?auto=format&fit=crop&q=80&w=500" alt="Organic growth workshop" style="height:160px;object-fit:cover;">
                  </div>
               </div>
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left">
               <h2 class="section-title" style="color:#fff;">Why Organic Marketing Matters for Your Business?</span></h2>
               <p style="color:rgba(255,255,255,0.6);font-size:1rem;line-height:1.75;margin:20px 0 36px;font-weight:300;">Your customers are searching online before they ever pick up the phone. If you're not visible, you're losing them to someone who is. </p>
               <div class="about-check-item">
                  <div class="check-icon"><i class="fas fa-check"></i></div>
                  <div>
                     <h6>Customers Search Before They Buy</h6>
                     <p>If your business is not on the first page of search results, you're not in the conversation. Organic puts you where buyers look first.</p>
                  </div>
               </div>
               <div class="about-check-item">
                  <div class="check-icon"><i class="fas fa-check"></i></div>
                  <div>
                     <h6>Paid Ads Stop the Day You Stop Paying</h6>
                     <p>Organic builds a compounding asset that keeps working long after publishing &mdash; lower cost-per-lead and sustainable growth over time.</p>
                  </div>
               </div>
               <div class="about-check-item">
                  <div class="check-icon"><i class="fas fa-check"></i></div>
                  <div>
                     <h6>Trust Is Built Before the First Enquiry</h6>
                     <p>Strong content and search presence warm up leads before they even contact you &mdash; so your sales team talks to buyers who already trust you.</p>
                  </div>
               </div>
               <a href="#contact" class="btn-primary-hero mt-4" style="margin-top:36px;">
               See How We Can Help <i class="fas fa-arrow-right"></i>
               </a>
            </div>
         </div>
      </div>
   </section>
   <!-- ── PROCESS ── -->
   <section id="process" class="process-section">
      <div class="container">
         <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">What You Can Expect in<span> 6–12 Months?</span></h2>
            <p class="section-sub mx-auto mt-3">Organic marketing isn't a quick fix, it's an investment that compounds. Here's what consistent effort delivers:</p>
         </div>
         <div class="row g-4">
            <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="50">
               <div class="process-step-card w-100">
                  <div class="step-num-big">01</div>
                  <div class="step-icon"><i class="fas fa-microscope"></i></div>
                  <h4>2x–5x More Qualified Inquiries:</h4>
                  <p>From people actively searching for your services.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="100">
               <div class="process-step-card w-100">
                  <div class="step-num-big">02</div>
                  <div class="step-icon"><i class="fas fa-map-marked-alt"></i></div>
                  <h4>Significantly Lower Cost-Per-Lead:</h4>
                  <p>Compared to relying only on paid ads.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="150">
               <div class="process-step-card w-100">
                  <div class="step-num-big">03</div>
                  <div class="step-icon"><i class="fas fa-rocket"></i></div>
                  <h4>Stronger Brand Authority:</h4>
                  <p>Better rankings, better reviews, better recognition.</p>
               </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="200">
               <div class="process-step-card w-100">
                  <div class="step-num-big">04</div>
                  <div class="step-icon"><i class="fas fa-chart-line"></i></div>
                  <h4>Sustainable, Compounding Growth:</h4>
                  <p>Content and SEO keep working long after publishing.</p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- ── CASE STUDIES ── -->
   <section id="cases" class="cases-section">
      <div class="container">
         <div class="row align-items-end mb-5">
            <div class="col-lg-6" data-aos="fade-up">
               <h2 class="section-title">Real Results for <span>Real Businesses</span></h2>
            </div>
            <div class="col-lg-4 offset-lg-2 text-lg-end" data-aos="fade-up" data-aos-delay="100">
               <a href="/case-studies" class="btn-unified btn-unified--primary" style="padding:12px 20px;font-size:0.88rem;">View All Case Studies <i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
         <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="50">
               <div class="case-card">
                  <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&q=80&w=900" alt="Case Study: E-Commerce Brand">
                  <div class="case-overlay"></div>
                  <div class="case-content">
                     <span class="case-tag">E-Commerce</span>
                     <h4>Online retailer scaled inbound inquiries through content-led SEO</h4>
                     <p>Technical fixes, topic clusters, and refreshed product pages within 90 days</p>
                     <div class="case-result">+312% <span>organic-sourced leads (6 mo.)</span></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
               <div class="row g-4" style="row-gap:20px;">
                  <div class="col-12">
                     <div class="case-card" style="height:200px;">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&fit=crop&q=80&w=900" alt="B2B Services Case Study">
                        <div class="case-overlay"></div>
                        <div class="case-content" style="padding:20px;">
                           <span class="case-tag">B2B Services</span>
                           <h4 style="font-size:1rem;">Service business expanded client base with topic authority</h4>
                           <div class="case-result" style="font-size:1.3rem;">+180% <span>organic traffic</span></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="case-card" style="height:200px;">
                        <img src="https://images.unsplash.com/photo-1616401784845-180882ba9ba8?auto=format&fit=crop&q=80&w=900" alt="Local Business Case Study">
                        <div class="case-overlay"></div>
                        <div class="case-content" style="padding:20px;">
                           <span class="case-tag">Local Business</span>
                           <h4 style="font-size:1rem;">Local brand captured high-intent customers from organic search</h4>
                           <div class="case-result" style="font-size:1.3rem;">+94% <span>organic inquiry growth</span></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <script>
      (function () {
          var journey = document.getElementById('outcomesJourney');
          var goBtn   = document.getElementById('journeyGo');
          var stack   = document.getElementById('journeyStack');
          var truck   = document.getElementById('journeyTruck');
          var hint    = document.getElementById('journeyHint');
          var progressDots = document.querySelectorAll('#journeyProgress .outcomes-journey__dot');
          if (!journey || !goBtn) return;
          var benefits = stack.querySelectorAll('.outcomes-journey__benefit');
          var total    = benefits.length;
          var current  = 0; // first already revealed
      
          function advance() {
              current++;
              if (current >= total) {
                  goBtn.disabled = true;
                  goBtn.textContent = 'Journey Complete \u2713';
                  if (hint) hint.textContent = 'Your organic programme is built to compound at every stage.';
                  journey.style.setProperty('--journey-leg', total - 1);
                  truck.classList.add('is-bounce');
                  setTimeout(function () { truck.classList.remove('is-bounce'); }, 1200);
                  journey.classList.add('is-rolling');
                  setTimeout(function () { journey.classList.remove('is-rolling'); }, 950);
                  return;
              }
              journey.style.setProperty('--journey-leg', current);
              benefits[current].classList.add('is-revealed');
              if (progressDots[current]) progressDots[current].classList.add('is-done');
              truck.classList.add('is-bounce');
              setTimeout(function () { truck.classList.remove('is-bounce'); }, 1200);
              journey.classList.add('is-rolling');
              setTimeout(function () { journey.classList.remove('is-rolling'); }, 950);
              if (hint) hint.textContent = 'Stage ' + (current + 1) + ' of ' + total + ' unlocked.';
              var lastRevealed = stack.querySelector('.outcomes-journey__benefit.is-revealed:last-of-type');
              if (lastRevealed) lastRevealed.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          }
      
          goBtn.addEventListener('click', advance);
      })();
   </script>
   <!-- ── BEFORE / AFTER ── -->
   <section class="demand-map-section">
      <div class="container">
         <div class="demand-map-header" data-aos="fade-up">
            <h2 class="demand-map-title">The Difference Organic Marketing <span>Makes for Your Business</span></h2>
            <p class="demand-map-desc">See how businesses transform when organic marketing is done right &mdash; from invisible and inconsistent, to visible, credible, and generating steady inbound inquiries.</p>
         </div>
         <div class="demand-map-layout">
            <div class="demand-map-column demand-map-left" data-aos="fade-right">
               <article class="demand-map-card">
                  <h4>Low Online Visibility</h4>
                  <p>Hard to find when customers search &mdash; losing business to competitors before you're even in the conversation.</p>
               </article>
               <article class="demand-map-card">
                  <h4>Inconsistent Inquiries</h4>
                  <p>Leads only come from referrals or cold outreach &mdash; no reliable, repeatable source of inbound demand.</p>
               </article>
               <article class="demand-map-card">
                  <h4>Weak Digital Credibility</h4>
                  <p>Customers hesitate to do business without a strong online presence &mdash; trust is lost before you even speak.</p>
               </article>
            </div>
            <div class="demand-map-center" data-aos="zoom-in" data-aos-delay="80">
               <div class="demand-phone" aria-hidden="true">
                  <div class="demand-phone-screen">
                     <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/home1.webp' ); ?>" alt="Organic marketing transformation visual">
                  </div>
               </div>
            </div>
            <div class="demand-map-column demand-map-right" data-aos="fade-left">
               <article class="demand-map-card">
                  <h4>Strong Search Presence</h4>
                  <p>Ranking on page 1 for the keywords that matter &mdash; your business is found at the moment buyers are looking.</p>
               </article>
               <article class="demand-map-card">
                  <h4>Consistent Inbound Inquiries</h4>
                  <p>Qualified leads come in steadily &mdash; a reliable organic channel that works even when you're not actively selling.</p>
               </article>
               <article class="demand-map-card">
                  <h4>Established Brand Authority</h4>
                  <p>Trust is built before the first conversation &mdash; customers already know and respect your brand by the time they reach out.</p>
               </article>
            </div>
         </div>
      </div>
   </section>
   <!-- ── FAQ ── -->
   <section class="faq-section faq-section-split faq-section-split--light">
      <div class="faq-split-bg" aria-hidden="true"></div>
      <div class="container faq-split-container">
         <div class="row g-5 align-items-stretch faq-split-row">
            <div class="col-lg-5" data-aos="fade-right">
               <div class="faq-split-visual">
                  <div class="faq-split-visual__accent" aria-hidden="true"></div>
                  <div class="faq-img-wrap">
                     <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=900" alt="Organic marketing strategy discussion">
                     <div class="faq-img-overlay"></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-7 faq-split-right" data-aos="fade-left">
               <div class="faq-split-content">
                  <h2 class="section-title">Frequently Asked Questions</h2>
                  <div class="faq-list" id="maintFaqList">
                     <div class="faq-item">
                        <div class="faq-header">
                           <p class="faq-question">What is organic marketing?</p>
                           <i class="fas fa-chevron-down faq-icon" aria-hidden="true"></i>
                        </div>
                        <div class="faq-answer">
                           <p>Organic marketing is a long-term, non-paid strategy that attracts customers naturally over time through valuable content, SEO, and social media engagement &mdash; instead of relying on paid advertising. It builds a compounding digital asset that keeps working for your business.</p>
                        </div>
                     </div>
                     <div class="faq-item">
                        <div class="faq-header">
                           <p class="faq-question">What does my business get if I implement organic marketing?</p>
                           <i class="fas fa-chevron-down faq-icon" aria-hidden="true"></i>
                        </div>
                        <div class="faq-answer">
                           <p>Organic marketing helps your business improve online visibility, attract the right audience, generate consistent enquiries, and build long-term customer trust. Over 6&ndash;12 months, most businesses see 2x&ndash;5x more qualified inquiries and a significantly lower cost-per-lead compared to paid channels.</p>
                        </div>
                     </div>
                     <div class="faq-item">
                        <div class="faq-header">
                           <p class="faq-question">What is the difference between organic and paid marketing?</p>
                           <i class="fas fa-chevron-down faq-icon" aria-hidden="true"></i>
                        </div>
                        <div class="faq-answer">
                           <p>Organic marketing builds long-term brand trust through content, SEO, and social media &mdash; it keeps working even when you're not actively spending. Paid marketing focuses on immediate visibility through advertisements that stop the moment your budget runs out. Using both together creates the strongest growth.</p>
                        </div>
                     </div>
                     <div class="faq-item">
                        <div class="faq-header">
                           <p class="faq-question">How do I start organic marketing for my business?</p>
                           <i class="fas fa-chevron-down faq-icon" aria-hidden="true"></i>
                        </div>
                        <div class="faq-answer">
                           <p>Organic marketing starts with improving your website, SEO, content, and search engine presence to help your business become more discoverable. We begin with a free audit of your current position, then build a roadmap tailored to your goals, industry, and target customers.</p>
                        </div>
                     </div>
                     <div class="faq-item">
                        <div class="faq-header">
                           <p class="faq-question">Why is organic marketing important for business growth?</p>
                           <i class="fas fa-chevron-down faq-icon" aria-hidden="true"></i>
                        </div>
                        <div class="faq-answer">
                           <p>Organic marketing helps your business stay visible where customers search online, making it easier to build trust, attract inquiries, and support long-term growth. Unlike paid channels, organic compounds over time &mdash; every piece of content and every ranking improvement continues delivering value months and years into the future.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- ── CONTACT ── -->
   <section id="contact" class="contact-section">
      <div class="container position-relative">
         <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
               <h2 class="section-title" style="color:#fff;">Why Choose Us?</h2>
               <ul class="contact-keypoints list-unstyled mb-0">
                  <li class="contact-keypoints__item">
                     <div>
                        <strong class="contact-keypoints__title">Custom Strategy, Not Templates</strong>
                     </div>
                  </li>
                  <li class="contact-keypoints__item">
                     <div>
                        <strong class="contact-keypoints__title">Transparent Monthly Reporting</strong>
                     </div>
                  </li>
                  <li class="contact-keypoints__item">
                     <div>
                        <strong class="contact-keypoints__title">One Team, One Complete Program</strong>
                     </div>
                  </li>
                  <li class="contact-keypoints__item">
                     <div>
                        <strong class="contact-keypoints__title">Dedicated Account Strategist</strong>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
               <?php
                  $_sn_maint_contact_pages = get_pages( array(
                      'meta_key'   => '_wp_page_template',
                      'meta_value' => 'contact.php',
                      'number'     => 1,
                  ) );
                  $sn_maint_contact_url = ( ! empty( $_sn_maint_contact_pages ) )
                      ? get_permalink( $_sn_maint_contact_pages[0]->ID )
                      : home_url( '/contact/' );
                  ?>
               <div class="contact-form-wrap">
                  <div class="cf-header">
                     <h4 class="cf-title">Send Us a Message</h4>
                     <p class="cf-lead">Fill out the form below and our team will get back to you within 24 hours &mdash; or visit our <a href="<?php echo esc_url( $sn_maint_contact_url ); ?>" style="color:var(--red);font-weight:600;">Contact</a> page.</p>
                  </div>
                  <form id="maintanenceContactForm" class="maintanence-contact-form" novalidate>
                     <div class="cf-grid">
                        <div class="cf-field">
                           <label for="mt_firstname" class="cf-label">Full Name <span class="cf-req" aria-hidden="true">*</span></label>
                           <input type="text" id="mt_firstname" class="cf-input" name="firstname" placeholder="John" autocomplete="name" required>
                        </div>
                        <div class="cf-field">
                           <label for="mt_email" class="cf-label">Email Address <span class="cf-req" aria-hidden="true">*</span></label>
                           <input type="email" id="mt_email" class="cf-input" name="email" placeholder="john@company.com" autocomplete="email" required>
                        </div>
                     </div>
                     <div class="cf-grid">
                        <div class="cf-field cf-field--full">
                           <label for="mt_company" class="cf-label">Company Name</label>
                           <input type="text" id="mt_company" class="cf-input" name="company" placeholder="Your company" autocomplete="organization">
                        </div>
                     </div>
                     <div class="cf-grid">
                        <div class="cf-field cf-field--full">
                           <label for="mt_message" class="cf-label">How can we help? <span class="cf-req" aria-hidden="true">*</span></label>
                           <textarea id="mt_message" class="cf-input cf-textarea" name="message" placeholder="Tell us about your business, your goals, or any questions you have&hellip;" required></textarea>
                        </div>
                     </div>
                     <button type="submit" class="cf-submit">
                     <i class="fas fa-paper-plane" aria-hidden="true"></i>
                     Send Message
                     </button>
                     <div id="maintanenceContactSuccess" class="cf-success" role="status" aria-live="polite">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        Message sent successfully! We'll be in touch soon.
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <button id="backToTop" aria-label="Back to top">
   <i class="fas fa-arrow-up"></i>
   </button>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
   <script>
      // Preloader
      window.addEventListener('load', () => {
          setTimeout(() => {
              document.getElementById('preloader').classList.add('hide');
          }, 1600);
      });
      
      // AOS
      AOS.init({ duration: 850, once: true, offset: 80 });
      
      // Scroll events
      window.addEventListener('scroll', () => {
          const nav = document.querySelector('.navbar');
          const progress = document.getElementById('scroll-progress');
          const topBtn = document.getElementById('backToTop');
          const scrollTotal = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          const scrollCurrent = window.scrollY;
          progress.style.width = (scrollCurrent / scrollTotal * 100) + '%';
          if (nav) nav.classList.toggle('scrolled', scrollCurrent > 50);
          topBtn.style.display = scrollCurrent > 300 ? 'block' : 'none';
      });
      
      // Back to top
      document.getElementById('backToTop').addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
      
      // Swiper
      new Swiper('.swiper', {
          slidesPerView: 1,
          spaceBetween: 24,
          loop: true,
          autoplay: { delay: 4500, disableOnInteraction: false },
          pagination: { el: '.swiper-pagination', clickable: true },
          breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }
      });
      
      // Counter animation
      const counterEls = document.querySelectorAll('.counter-num');
      const counterObserver = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  const el = entry.target;
                  const target = parseInt(el.dataset.target);
                  const suffix = el.innerHTML.match(/<span>(.*?)<\/span>/)?.[1] || '';
                  let count = 0;
                  const step = Math.ceil(target / 60);
                  const timer = setInterval(() => {
                      count = Math.min(count + step, target);
                      el.innerHTML = count + `<span>${suffix}</span>`;
                      if (count >= target) clearInterval(timer);
                  }, 25);
                  counterObserver.unobserve(el);
              }
          });
      }, { threshold: 0.5 });
      counterEls.forEach(el => counterObserver.observe(el));
      
      // Smooth scroll
      document.querySelectorAll('a[href^="#"]').forEach(a => {
          a.addEventListener('click', e => {
              const target = document.querySelector(a.getAttribute('href'));
              if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
          });
      });
   </script>
   <script>
      (function () {
          var form = document.getElementById('maintanenceContactForm');
          if (!form) return;
          var contactNonce = '<?php echo esc_js( wp_create_nonce( 'contactus_form' ) ); ?>';
          form.addEventListener('submit', function (e) {
              e.preventDefault();
              var btn = form.querySelector('.cf-submit');
              var successEl = document.getElementById('maintanenceContactSuccess');
              if (!btn) return;
              var originalHtml = btn.innerHTML;
              btn.disabled = true;
              btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Sending...';
      
              var firstname = document.getElementById('mt_firstname').value.trim();
              var email = document.getElementById('mt_email').value.trim();
              var company = document.getElementById('mt_company').value.trim();
              var message = document.getElementById('mt_message').value.trim();
      
              var formData = new FormData();
              formData.append('action', 'contactus_submit');
              formData.append('form-field-53ca358', firstname);
              formData.append('form-field-1f02457', '');
              formData.append('form-field-e7d1df3', email);
              formData.append('form-field-phone', '');
              formData.append('form-field-d0e86ec', company ? company : 'Organic Marketing \u2014 Contact Form');
              formData.append('form-field-72f8d88', message);
              formData.append('form_action', 'contactus_submit');
              formData.append('page_url', window.location.href);
              formData.append('nonce', contactNonce);
      
              fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
                  method: 'POST',
                  body: formData
              })
              .then(function (r) { return r.json(); })
              .then(function (data) {
                  if (data.success) {
                      successEl.classList.add('is-visible');
                      form.reset();
                      setTimeout(function () { successEl.classList.remove('is-visible'); }, 5000);
                  } else {
                      throw new Error((data && data.data) ? data.data : 'Submit failed');
                  }
              })
              .catch(function () {
                  alert('Sorry, there was an error sending your message. Please try again or use our Contact page.');
              })
              .finally(function () {
                  btn.disabled = false;
                  btn.innerHTML = originalHtml;
              });
          });
      })();
   </script>
   <script>
      document.addEventListener('DOMContentLoaded', function () {
          var list = document.getElementById('maintFaqList');
          if (!list) return;
          var faqItems = list.querySelectorAll('.faq-item');
          faqItems.forEach(function (item) {
              item.addEventListener('click', function () {
                  var isActive = item.classList.contains('active');
                  faqItems.forEach(function (otherItem) {
                      otherItem.classList.remove('active');
                      var otherAnswer = otherItem.querySelector('.faq-answer');
                      if (otherAnswer) otherAnswer.style.maxHeight = '';
                  });
                  if (!isActive) {
                      item.classList.add('active');
                      var answer = item.querySelector('.faq-answer');
                      if (answer) answer.style.maxHeight = answer.scrollHeight + 'px';
                  }
              });
          });
      });
   </script>
</main>
<?php get_footer(); ?>