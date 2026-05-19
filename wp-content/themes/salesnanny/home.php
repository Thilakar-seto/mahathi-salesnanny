<?php
/**
 * Template Name: Home
 *
 * PERFORMANCE FIXES APPLIED (Mobile PageSpeed: 82 → target 92+)
 * ─────────────────────────────────────────────────────────────
 * FIX 1 — RENDER BLOCKING (saves ~2,070 ms)
 *   • Font Awesome loaded async via preload/onload swap (was render-blocking)
 *   • All third-party CSS deferred with the same pattern
 *
 * FIX 2 — LCP IMAGE (3.7 s → target <2.5 s)
 *   • Added <link rel="preconnect"> + dns-prefetch for i.ytimg.com
 *   • Self-host facade thumbnail recommendation added (see inline comment)
 *   • LCP <img> keeps fetchpriority="high" + loading="eager"
 *   • Added explicit <link rel="preload"> for the facade thumbnail
 *
 * FIX 3 — CACHE TTL
 *   • Noted: extend server cache to 1 year for static assets (see .htaccess snippet)
 *
 * FIX 4 — FONT AWESOME ICONS
 *   • Replaced <i class="fas/fab"> with inline SVG equivalents so Font Awesome
 *     is needed only for the submit button spinner — which is deferred anyway.
 *
 * FIX 5 — SCRIPT DEFER
 *   • All inline JS already at bottom — no change needed there.
 *   • Added 'defer' note for functions.php wp_enqueue_script calls.
 *
 * NO VISUAL CHANGES — all CSS classes and markup structure preserved.
 */
get_header();

/*
 * ─── SELF-HOST THUMBNAIL (recommended) ────────────────────────────────────────
 * Download once and place in your theme assets:
 *   curl -o wp-content/themes/YOUR_THEME/assets/yt-facade-1xczQ_CsKRk.jpg \
 *        https://i.ytimg.com/vi/1xczQ_CsKRk/hqdefault.jpg
 * Then change $yt_thumb below to use get_template_directory_uri().
 * Until then, preconnect + dns-prefetch below minimises the cross-origin cost.
 */
$yt_video_id   = '1xczQ_CsKRk';
$yt_thumb_self = get_template_directory_uri() . '/assets/yt-facade-' . $yt_video_id . '.jpg';
// Fallback to YouTube CDN if self-hosted file doesn't exist yet:
$yt_thumb_cdn  = 'https://i.ytimg.com/vi/' . $yt_video_id . '/hqdefault.jpg';
// Use self-hosted if file exists, otherwise CDN
$yt_thumb      = file_exists( get_template_directory() . '/assets/yt-facade-' . $yt_video_id . '.jpg' )
                 ? $yt_thumb_self
                 : $yt_thumb_cdn;
$is_self_hosted = ( $yt_thumb === $yt_thumb_self );
?>

<?php /* ── FIX 2: Preconnect to YouTube image CDN (only needed until self-hosted) ── */ ?>
<?php if ( ! $is_self_hosted ) : ?>
<link rel="preconnect" href="https://i.ytimg.com" crossorigin>
<link rel="dns-prefetch" href="https://i.ytimg.com">
<?php endif; ?>

<?php /* ── FIX 2: Preload the LCP image so browser discovers it immediately ── */ ?>
<link rel="preload" as="image"
      href="<?php echo esc_url( $yt_thumb ); ?>"
      fetchpriority="high">

<?php /* ── FIX 1: Load Font Awesome ASYNC — removes the 2,070 ms render block ── */ ?>
<link rel="preload"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      as="style"
      onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</noscript>

<?php /* ── Unused CSS deferred (already present — keeping as-is) ── */ ?>
<link rel="preload"
      href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/home.unused.css"
      as="style"
      onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet"
        href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/home.unused.css">
</noscript>

<style>
/* ═══════════════════════════════════════════════════════
   HERO SECTION — RESPONSIVE FIXES
   Key changes vs original:
   • hero-title: fixed 42px → clamp(26px, 4.5vw, 42px)
   • hero-stats: 3-col down to 1-col at 400px
   • hero-actions: flex-wrap added; buttons nowrap
   • video-card-container: explicit aspect-ratio 16/9
   • btn-primary: padding reduced at 400px
═══════════════════════════════════════════════════════ */

/*
 * FIX 1: Provide fallback icon styles so icons render before Font Awesome loads.
 * The async-loaded FA CSS will override these once available.
 */
.fa-solid,.fas{font-family:"Font Awesome 6 Free",sans-serif;font-weight:900}
.fa-brands,.fab{font-family:"Font Awesome 6 Brands",sans-serif;font-weight:400}

body{margin:0;padding:0}
*,*::before,*::after{box-sizing:border-box}

.hero-section-wrapper{
    background-color:#1e2154;
    background:linear-gradient(to bottom,#1e2152,#1e2154b0),url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/home1.webp);
    color:#111;
    width:100%;
    overflow-x:hidden;
    padding:60px 0 0;
    background-size:cover;
    min-height:100vh;
    background-position:67% 35%;
}
.hero-container{
    width:100%;
    max-width:1400px;
    padding-inline:clamp(20px,4vw,48px);
    margin:0 auto;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:clamp(32px,4vw,60px);
    align-items:center;
    position:relative;
}
.hero-content{display:flex;flex-direction:column;align-items:flex-start;gap:15px;z-index:2}
.hero-title{
    font-size:clamp(26px,4.5vw,42px);
    font-weight:700;
    line-height:1.1;
    letter-spacing:-.02em;
    margin:0;
    color:#fff;
}
.hero-description{
    font-size:clamp(15px,1.15vw,18px);
    line-height:1.6;
    color:#dadada;
    margin:0;
}
.hero-actions{
    display:flex;
    align-items:center;
    gap:20px;
    margin-top:10px;
    flex-wrap:wrap;
}
.btn-primary{
    background-color:#c22034;
    color:#fff;
    text-decoration:none;
    padding:16px 32px;
    border-radius:12px;
    font-weight:500;
    display:flex;
    align-items:center;
    gap:12px;
    transition:all .3s cubic-bezier(.25,.8,.25,1);
    box-shadow:0 10px 30px rgba(0,0,0,.2);
    white-space:nowrap;
}
.icon-arrow-up{width:18px;height:18px;stroke:currentColor;stroke-width:2.5}
.hero-stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
    width:100%;
    padding-top:20px;
}
.stat-item{display:flex;flex-direction:column;gap:4px}
.stat-number{font-size:clamp(20px,3vw,25px);font-weight:700;color:#fff}
.stat-label{font-size:14px;color:#dadada;font-weight:500}
.hero-visuals{
    position:relative;
    height:600px;
    display:flex;
    justify-content:center;
    align-items:center;
    perspective:1000px;
}
.blob-purple{
    position:absolute;
    top:50%;left:50%;
    transform:translate(-50%,-50%);
    width:500px;height:500px;
    background:radial-gradient(circle,rgba(99,45,233,.3) 0%,rgba(30,33,84,0) 70%);
    border-radius:50%;
    filter:blur(60px);
    z-index:0;
    animation:pulseBlob 6s infinite alternate;
}
@keyframes pulseBlob{0%{transform:translate(-50%,-50%) scale(1);opacity:.5}100%{transform:translate(-50%,-50%) scale(1.1);opacity:.8}}
.video-card-container{
    position:relative;
    width:550px;
    aspect-ratio:16/9;
    z-index:10;
    animation:floatCard 6s ease-in-out infinite;
}
@keyframes floatCard{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}
.video-wrapper{
    width:100%;height:100%;
    background:rgba(20,20,20,.6);
    border-radius:24px;
    padding:8px;
    border:1px solid rgba(255,255,255,.15);
    box-shadow:0 20px 50px -10px rgba(0,0,0,.5),0 0 0 1px rgba(255,255,255,.05);
    backdrop-filter:blur(10px);
    overflow:hidden;
    position:relative;
}
.yt-facade{
    width:100%;height:100%;
    border-radius:16px;
    cursor:pointer;
    position:relative;
    display:block;
    background:#000;
    border:none;
    padding:0;
}
.yt-facade img{
    width:100%;height:100%;
    object-fit:cover;
    border-radius:16px;
    display:block;
}
.yt-play-btn{
    position:absolute;
    top:50%;left:50%;
    transform:translate(-50%,-50%);
    width:72px;height:72px;
    background:rgba(194,32,52,.9);
    border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    transition:transform .2s,background .2s;
    pointer-events:none;
}
.yt-facade:hover .yt-play-btn{background:#c22034;transform:translate(-50%,-50%) scale(1.1)}
.yt-play-btn svg{width:28px;height:28px;fill:#fff;margin-left:4px}
.hero-video{
    width:100%;height:100%;
    border-radius:16px;
    display:block;
    background:#000;
    border:none;
    position:absolute;top:0;left:0;
}
.yt-iframe-active .yt-facade{display:none}
.floating-badge{
    position:absolute;
    padding:10px 20px;
    background:#fff;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,.2);
    display:flex;align-items:center;gap:10px;
    font-weight:600;font-size:14px;color:#111;z-index:20;
}
.badge-top-left{top:-20px;left:-30px;animation:floatBadge 5s ease-in-out infinite reverse}
.badge-bottom-right{bottom:-20px;right:-30px;background:#c22034;color:#fff;animation:floatBadge 7s ease-in-out infinite}
@keyframes floatBadge{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@media(max-width:1024px){
    .hero-title{font-size:clamp(28px,5vw,42px)}
    .hero-container{grid-template-columns:1fr;gap:60px;text-align:center;padding:120px 30px 60px}
    .hero-content{align-items:center}
    .hero-actions{justify-content:center}
    .hero-visuals{height:auto;margin-top:40px}
    .video-card-container{width:100%;max-width:600px;animation:none}
    .floating-badge{display:none}
}
@media(max-width:768px){
    .blob-purple{display:none}
    .hero-title{font-size:clamp(24px,7vw,32px)}
}
@media(max-width:400px){
    .hero-stats{grid-template-columns:1fr;gap:24px}
    .stat-item{align-items:center}
    .btn-primary{padding:13px 22px;font-size:14px}
}

/* ── PARTNERS ──────────────────────────────── */
.partners-section{position:relative;background-color:#fff;width:100%;padding:80px 0 60px;display:flex;justify-content:center;overflow:hidden;box-sizing:border-box}
.partners-container{position:relative;width:100%;display:flex;flex-direction:column;align-items:center;gap:30px;z-index:2}
.partners-header-group{display:flex;flex-direction:column;align-items:center;text-align:center;gap:15px}
.partners-title{font-size:32px;font-weight:700;line-height:1.2;letter-spacing:-.03em;color:#111;margin:0}
.partners-ticker-wrapper{border-radius:20px;box-sizing:border-box;overflow:hidden;width:100%}
.partners-ticker-inner{padding:20px 0;overflow:hidden;position:relative}
.partners-ticker-track{display:flex;width:max-content;--gap:40px;gap:var(--gap);padding-right:var(--gap);animation:ticker-scroll 80s linear infinite;will-change:transform}
.partner-logo-item{height:70px;width:auto!important;max-width:none!important;flex-shrink:0;display:block;object-fit:contain}
@keyframes ticker-scroll{0%{transform:translate3d(0,0,0)}100%{transform:translate3d(-50%,0,0)}}
@media(max-width:768px){.partners-ticker-track{--gap:30px}.partners-section{padding:60px 20px}.partners-title{font-size:30px}}

/* ── FEATURES ──────────────────────────────── */
.features-wrapper{width:100%;background-color:#fff;display:flex;flex-direction:column;align-items:center;padding:40px 20px 60px;gap:80px;box-sizing:border-box}
.feature-row{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto;display:flex;flex-direction:row;align-items:center;justify-content:center;gap:80px}
.feature-row.feature-reverse{flex-direction:row-reverse}
.feature-image-col{flex:1;position:relative;display:flex;justify-content:center;width:100%;max-width:550px;background:rgba(255,207,207,.3);border:1px solid #ffeaec;box-shadow:0 4px 20px -4px rgba(218,13,32,.1)}
.feature-main-img{width:100%;height:auto;border-radius:20px;object-fit:cover;display:block}
.feature-content-col{flex:1;display:flex;flex-direction:column;align-items:flex-start;gap:20px;max-width:550px}
.feature-heading{font-size:32px;font-weight:700;line-height:1.1;color:#111;margin:0;letter-spacing:-.04em}
.feature-heading-highlight{color:#c22034}
.feature-divider{width:100%;height:1px;background-color:#ccc}
.feature-list-group{display:flex;flex-direction:column;gap:25px;width:100%}
.feature-list-item{display:flex;flex-direction:row;gap:16px;align-items:flex-start}
.feature-icon-wrapper{width:30px;height:30px;flex-shrink:0;color:#c22034;fill:#c22034}
.feature-text-wrapper{display:flex;flex-direction:column;gap:8px}
.feature-item-title{font-size:18px;font-weight:600;color:#252525;margin:0;line-height:1.4}
.feature-item-desc{font-size:16px;font-weight:400;color:#222;margin:0;line-height:1.5}
@media(max-width:1024px){.feature-row{gap:50px}.feature-heading{font-size:32px}}
@media(max-width:768px){.features-wrapper{padding:60px 20px;gap:80px}.feature-row,.feature-row.feature-reverse{flex-direction:column;text-align:left}.feature-image-col{max-width:100%;margin-bottom:20px}.feature-heading{font-size:28px}.feature-content-col{gap:25px}}

/* ── TESTIMONIAL ───────────────────────────── */
.ts-section{width:100%;padding:80px 50px 60px;background:#1e2152;display:flex;flex-direction:column;align-items:center;gap:50px;color:#151515}
.ts-card{position:relative;background-color:#fff;border-radius:24px;height:400px;display:grid;grid-template-columns:1fr .8fr;overflow:hidden;box-shadow:rgba(0,0,0,.06) 0 .72px 2.17px -1px,rgba(0,0,0,.06) 0 2.75px 8.24px -2px,rgba(0,0,0,.04) 0 12px 36px -3px;transition:transform .3s ease,box-shadow .3s ease}
.ts-content-col{padding:80px 80px 80px 90px;display:flex;flex-direction:column;justify-content:space-between;gap:40px}
.ts-quote-text{font-size:17px;line-height:1.5;font-weight:500;color:#151515;margin:0}
.ts-author-info{display:flex;flex-direction:column;gap:4px}
.ts-author-name{font-size:18px;font-weight:700;margin:0;color:#151515}
.ts-author-role{font-size:14px;font-weight:400;margin:0;color:#666}
.ts-image-col{position:relative;width:100%;height:100%;min-height:400px;overflow:hidden}
.ts-image{width:100%;height:100%;object-fit:contain;transition:transform .7s cubic-bezier(.25,.46,.45,.94)}
.ts-nav-btn{position:absolute;top:50%;transform:translateY(-50%);width:56px;height:56px;border:none;border-radius:50%;background-color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(0,0,0,.1);z-index:10;transition:all .3s cubic-bezier(.4,0,.2,1)}
.ts-nav-prev{left:20px}.ts-nav-next{right:20px}
.ts-nav-icon{width:20px;height:20px;fill:none;stroke:#151515;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;transition:stroke .3s}
.ts-proof-wrapper{display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:20px}
.ts-fade-up{animation:fadeUp .6s forwards}
@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
@media(max-width:900px){.ts-card{grid-template-columns:1fr;height:unset}.ts-image-col{order:1;height:250px;min-height:auto}.ts-content-col{order:2;padding:60px 40px 40px}.ts-nav-btn{top:auto;bottom:25px;transform:none;width:44px;height:44px}.ts-nav-prev{left:auto;right:70px}.ts-nav-next{right:20px}}

/* ── SOCIAL PROOF ──────────────────────────── */
.social-proof-section{position:relative;overflow:hidden}
.social-proof-container{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto;position:relative;z-index:2}
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;position:relative}
.stat-card{border-radius:12px;padding:20px 28px;display:flex;align-items:center;justify-content:space-between;gap:20px;position:relative;transition:all .4s cubic-bezier(.4,0,.2,1);cursor:default;background:#fff}
.card-left{flex-shrink:0}.platform-logo-wrapper{height:24px;display:flex;align-items:center;justify-content:center}.platform-logo{height:100%;max-width:100px;object-fit:contain;transition:all .5s cubic-bezier(.4,0,.2,1)}
.card-center{display:flex;flex-direction:column;align-items:center;gap:8px;flex-shrink:0}
.rating-wrapper{display:flex;align-items:baseline;gap:3px}.rating-number{font-size:36px;font-weight:700;color:#000;letter-spacing:-.03em;line-height:1}.rating-max{font-size:16px;font-weight:500;color:#94a3b8}
.stars-wrapper{display:flex;gap:3px;justify-content:center}.star-icon{width:16px;height:16px;fill:currentColor;transition:transform .3s}
.stars-g2{color:#ff492c}.stars-capterra{color:#faa922}.stars-trustpilot{color:#00b67a}
.card-right{flex-grow:1;text-align:right}.review-texts{font-size:13px;font-weight:500;color:#000;margin:0;white-space:nowrap}
@media(max-width:1024px){.stats-grid{grid-template-columns:1fr 1fr;gap:16px}.stat-card{padding:20px 24px}}
@media(max-width:768px){.stat-card{flex-direction:column;text-align:center;padding:24px 20px;gap:16px}.card-left,.card-center,.card-right{width:100%}.card-right{text-align:center}.rating-number{font-size:32px}}

/* ── SALES FEATURE ─────────────────────────── */
.sales-feature-section{background-color:#fff;color:#111;padding:80px 20px 60px;width:100%;box-sizing:border-box;display:flex;justify-content:center}
.sales-feature-container{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto;display:flex;flex-direction:column;align-items:center;gap:60px}
.sales-header{text-align:center;max-width:660px;margin:0 auto;display:flex;flex-direction:column;gap:16px}
.sales-headline{font-size:48px;font-weight:700;line-height:1.1;letter-spacing:-.04em;margin:0;color:#000}
.sales-headline.light{color:#fff}.sales-headline-highlight{color:#c22034}.sales-headline-highlight-white{color:#fff}
.sales-subheadline{font-size:18px;font-weight:400;line-height:1.5;color:#000;margin:0}
.sales-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;width:100%}
.sales-card{background-color:rgba(255,255,255,.85);border-radius:12px;padding:14px 14px 24px;display:flex;flex-direction:column;gap:20px;box-shadow:0 2px 10px rgba(0,0,0,.2);transition:transform .2s,box-shadow .2s}
.card-image-wrapper{width:100%;aspect-ratio:1.67;border-radius:10px;overflow:hidden;background-color:#eee}
.card-image{width:100%;height:100%;object-fit:cover;display:block}
.card-text-content{padding:0 4px;display:flex;flex-direction:column;gap:10px}
.card-title{font-size:18px;font-weight:700;margin:0;color:#111}
.card-description{font-size:16px;line-height:1.4;color:#444;margin:0 0 10px}
.card-feature-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px}
.feature-item{display:flex;align-items:center;gap:10px;font-size:14px;font-weight:600;color:#222}
.feature-icon{width:15px;height:15px;background-color:#c22034;border:3px solid #fff;box-shadow:0 0 0 1px #c22034;border-radius:50%;flex-shrink:0}
@media(max-width:1024px){.sales-headline{font-size:32px}.sales-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){.sales-header{max-width:340px}.sales-headline{font-size:32px}.sales-grid{grid-template-columns:1fr;gap:32px}.sales-feature-section{padding:60px 20px}}

/* ── HUB ───────────────────────────────────── */
.hub-section{background-color:#fff;padding:40px 20px 60px;position:relative;overflow:hidden;box-sizing:border-box}
.hub-container{max-width:1240px;margin:0 auto;position:relative;display:flex;justify-content:space-between;align-items:center;min-height:600px}
.hub-connections{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:100%;height:100%;max-width:1200px;z-index:0;pointer-events:none}
.connection-line{fill:none;stroke:#1e2152;stroke-width:1.5;stroke-dasharray:6;opacity:.6}
.hub-column-side{width:32%;display:flex;flex-direction:column;gap:60px;z-index:2}
.service-card{background:rgba(255,255,255,.85);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid #c2203469;border-radius:16px;padding:24px;position:relative;box-shadow:0 20px 25px -5px rgba(0,0,0,.1),0 10px 10px -5px rgba(0,0,0,.04);transition:transform .3s cubic-bezier(.4,0,.2,1),box-shadow .3s}
.left-side .service-card{text-align:right;padding-right:70px}.right-side .service-card{text-align:left;padding-left:70px}
.service-title{margin:0 0 8px;font-size:1.125rem;font-weight:700;color:#0F172A;line-height:1.2}
.service-desc{margin:0;font-size:.8rem;color:#64748B;line-height:1.5}
.service-icon-wrapper{position:absolute;top:50%;transform:translateY(-50%);width:50px;height:50px;background:#fff;border-radius:50%;display:flex;justify-content:center;align-items:center;font-size:20px;color:#c22034;box-shadow:0 4px 6px -1px rgba(0,0,0,.39);border:1px solid #E2E8F0;transition:all .3s}
.left-side .service-icon-wrapper{right:-25px}.right-side .service-icon-wrapper{left:-25px}
.image-center{margin:0 auto;text-align:center}.image-center img{width:100%;height:auto;}
@media(max-width:1024px){.hub-container{flex-direction:column;gap:50px}.hub-column-side{width:100%;max-width:500px}.hub-connections{display:none}.left-side .service-card,.right-side .service-card{text-align:left;padding:24px;padding-left:70px}.left-side .service-icon-wrapper,.right-side .service-icon-wrapper{right:auto;left:15px}}

/* ── TABS ──────────────────────────────────── */
.framer-section{background:#1e2152;color:#fff;padding:80px 20px 60px;box-sizing:border-box;width:100%;overflow:hidden;position:relative}
.framer-container{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto;position:relative;z-index:1}
.tabs-nav-wrapper{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;margin-top:40px;margin-bottom:60px;background:#fff;padding:8px;border-radius:16px;width:fit-content;margin-left:auto;margin-right:auto;box-shadow:0 4px 6px -1px rgba(0,0,0,.05),0 2px 4px -1px rgba(0,0,0,.03),0 0 0 1px rgba(0,0,0,.05)}
.tab-button{background:transparent;border:none;padding:12px 24px;font-size:15px;font-weight:600;color:#64748b;cursor:pointer;border-radius:12px;transition:all .3s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden}
.tab-button.active-tab{background:#c22034;color:#fff;box-shadow:0 10px 15px -3px rgba(99,102,241,.3),0 4px 6px -2px rgba(99,102,241,.15)}
.tab-button.active-tab:hover{color:#fff}
.tab-content-wrapper{position:relative;min-height:600px;overflow:hidden}
.tab-pane{position:absolute;top:0;left:0;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:stretch;opacity:0;transform:translateX(100px);transition:opacity .5s cubic-bezier(.4,0,.2,1),transform .5s cubic-bezier(.4,0,.2,1);pointer-events:none}
.tab-pane.visible-pane{position:relative;opacity:1;transform:translateX(0);pointer-events:auto;z-index:2}
.content-left{display:flex;flex-direction:column;gap:28px;height:100%}
.content-title{font-size:42px;font-weight:800;letter-spacing:-.03em;margin:0;line-height:1.2;color:#fff}
.content-desc{font-size:17px;line-height:1.7;color:#fff;margin:0;font-weight:500}
.tabs-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin:8px 0 12px;flex:1}
.tabs-grid>.tabs-item{display:flex;flex-direction:column;align-items:flex-start;justify-content:flex-start;gap:12px;padding:20px;background:#fff;border-radius:16px;border:1px solid #e2e8f0;transition:all .4s cubic-bezier(.4,0,.2,1);cursor:pointer}
.tabs-icon-box{width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#f1f5f9,#e2e8f0);display:flex;align-items:center;justify-content:center;color:#c22034;font-size:20px;transition:all .4s cubic-bezier(.4,0,.2,1);flex-shrink:0}
.tabs-label{font-size:14px;font-weight:700;color:#1e293b;letter-spacing:-.01em}
.content-right{position:relative;height:100%;min-height:600px;width:100%;overflow:hidden;border-radius:24px;box-shadow:0 25px 50px -12px rgba(0,0,0,.15),0 0 0 1px rgba(0,0,0,.05)}
.tab-image{width:100%;object-fit:contain;display:block;transition:transform .7s cubic-bezier(.4,0,.2,1)}
@media(max-width:968px){.tab-content-wrapper{min-height:800px}.tab-pane,.tab-pane.visible-pane{grid-template-columns:1fr;gap:48px}.tab-pane{transform:translateY(50px)}.tab-pane.visible-pane{transform:translateY(0)}.content-right{order:-1;height:350px;min-height:350px}.tabs-nav-wrapper{justify-content:flex-start;overflow-x:auto;max-width:100%;white-space:nowrap;border-radius:12px;-ms-overflow-style:none;scrollbar-width:none;padding:6px}.tab-button{padding:10px 20px;font-size:14px}.content-title{font-size:32px}.tabs-grid{gap:16px}}
@media(max-width:600px){.content-right,.tab-image{height:unset}.content-title{font-size:26px}.content-desc{font-size:15px}.tabs-grid{grid-template-columns:repeat(2,1fr);gap:12px}.tabs-grid>.tabs-item{padding:16px}.tabs-icon-box{width:42px;height:42px;font-size:18px}.tabs-label{font-size:13px}}

/* ── BOOST / CTA ───────────────────────────── */
.section-boost-wrapper{background-color:#dcdcdc;padding:80px 20px 60px;display:flex;justify-content:center;overflow:hidden}
.section-boost-container{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto}
.boost-card{background-color:#fff;border-radius:20px;max-width:1250px;width:100%;display:grid;grid-template-columns:1fr;gap:40px;padding:50px 40px;box-shadow:0 4px 36px -2px rgba(0,0,0,.02),0 1px 8px -1px rgba(0,0,0,.03);position:relative;align-items:center}
@media(min-width:1024px){.boost-card{grid-template-columns:1fr 1fr;padding:0 80px}}
.boost-content{display:flex;flex-direction:column;gap:25px;position:relative;z-index:2}
.boost-header-group{position:relative;width:fit-content}
.boost-title{font-size:28px;font-weight:700;line-height:1.1;letter-spacing:-.04em;color:#111;margin:0;position:relative;z-index:2}
@media(min-width:768px){.boost-title{font-size:38px}}
.boost-scribble{position:absolute;bottom:-10px;left:0;width:190px;height:15px;transform:rotate(-3deg);z-index:1;pointer-events:none}
.boost-scribble path{stroke:rgb(194,32,52);fill:transparent;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.boost-description{font-size:16px;line-height:1.5;color:#444;margin:0;max-width:480px}
@media(min-width:768px){.boost-description{font-size:18px}}
.boost-cta-btn{display:inline-flex;align-items:center;gap:10px;background-color:#1e2152;color:#fff;text-decoration:none;padding:14px 24px;border-radius:12px;font-weight:600;font-size:16px;width:fit-content;transition:transform .2s,box-shadow .2s;box-shadow:0 10px 18px -2px rgba(0,0,0,.13)}
.boost-cta-icon{width:18px;height:18px;stroke:#fff;stroke-width:2}
.boost-visual-wrapper{position:relative;display:flex;justify-content:center;align-items:center;min-height:400px}
.boost-main-image{width:100%;max-width:330px;height:432px;object-fit:cover;position:relative;z-index:2;object-position:top}
.boost-bg-lines{position:absolute;top:0;right:-100px;width:120%;max-width:800px;height:auto;opacity:.8;z-index:0;pointer-events:none;mask-image:radial-gradient(circle,black 40%,transparent 90%);-webkit-mask-image:radial-gradient(circle,black 40%,transparent 90%);filter:hue-rotate(92deg)}
.boost-float-card{position:absolute;background-color:#fff;padding:8px 16px 8px 10px;border-radius:50px;display:flex;align-items:center;gap:8px;box-shadow:0 5px 24px -2px rgba(0,0,0,.05);z-index:3;white-space:nowrap;animation:floatAnimation 4s ease-in-out infinite}
.boost-card-left{left:0;bottom:25%}.boost-card-right{right:0;top:35%;animation-delay:2s}
.boost-float-icon{width:16px;height:16px;fill:rgb(99,45,233)}.boost-float-text{font-size:12px;font-weight:700;color:#444;margin:0}
@keyframes floatAnimation{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
@media(max-width:600px){.boost-float-card{transform:scale(.9)}.boost-card-left{left:-10px;bottom:15%}.boost-card-right{right:-10px;top:25%}.boost-visual-wrapper{min-height:unset}.boost-main-image{height:auto}}

/* ── TOOLS ─────────────────────────────────── */
.tools-section{padding:80px 0 60px;background-color:#fff;overflow:hidden}
.tools-container{width:100%;max-width:1300px;margin:0 auto;padding:0 24px;box-sizing:border-box}
.tools-header{text-align:center;margin-bottom:64px}
.tools-highlight-text{color:#c22034}
.tools-slider-wrapper{position:relative;width:100%;overflow:hidden}
.tools-track{display:inline-flex;align-items:center;white-space:nowrap;animation:scroll-left 30s linear infinite}
.tools-item{margin:0 15px;display:flex;align-items:center;justify-content:center}
.tools-image{height:48px;width:auto;padding:4px;border-radius:4px;background-color:#fff;transition:filter .3s;display:block}
@keyframes scroll-left{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
@media(max-width:768px){.tools-container{padding:0 16px}.tools-image{height:40px}}

/* ── FAQ ───────────────────────────────────── */
.faq-section{padding:100px 24px;background-color:#1e2152;background-repeat:no-repeat;display:flex;justify-content:center;box-sizing:border-box;position:relative;overflow:hidden}
.faq-bg{position:absolute;inset:0;z-index:0}.faq-bg img{width:100%;height:100%;object-fit:cover;display:block}
.faq-container{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto;display:flex;gap:60px;align-items:flex-start;z-index:2}
.faq-content-col{flex:1;display:flex;flex-direction:column}
.faq-title{font-size:48px;font-weight:700;line-height:1.1;letter-spacing:-.04em;margin:0 0 40px;color:#fff;max-width:15ch}
.faq-list{display:flex;flex-direction:column;gap:16px}
.faq-item{background-color:rgba(255,255,255,.05);border-radius:10px;padding:20px 24px;cursor:pointer;transition:all .2s;border:1px solid transparent;box-shadow:0 4px 6px -1px rgba(0,0,0,.1)}
.faq-header{display:flex;justify-content:space-between;align-items:center;gap:10px}
.faq-question{font-size:1.05rem;font-weight:600;color:#fff;margin:0;line-height:1.3}
.faq-icon{color:#fff;font-size:14px;transition:transform .3s}
.faq-answer{max-height:0;overflow:hidden;transition:max-height .3s ease-out}
.faq-answer p{margin:0;padding-top:16px;color:rgba(255,255,255,.8);font-size:.95rem;line-height:1.6}
.faq-feature-col{width:400px;flex-shrink:0;align-content:center}
@media(max-width:968px){.faq-container{flex-direction:column;gap:40px}.faq-feature-col{width:100%}.faq-title{font-size:2.25rem}}

/* ── CONTACT FORM ──────────────────────────── */
.contact-form-wrapper{background:#fff;padding:30px;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,.1);display:flex;flex-direction:column;justify-content:center}
.contact-form-title{margin-top:0;margin-bottom:20px;font-size:24px;color:#1e2152;font-weight:700}
.form-grid-home{display:grid;grid-template-columns:1fr;gap:16px;margin-bottom:16px}
@media(min-width:450px){.form-grid-home{grid-template-columns:1fr 1fr}}
.form-field-home{display:flex;flex-direction:column}
.form-field-home.full{grid-column:span 1;margin-bottom:16px}
@media(min-width:450px){.form-field-home.full{grid-column:span 2}}
.form-field-home label{font-weight:600;color:#0f172a;margin-bottom:8px;font-size:13px}
.form-field-home label .required{color:#C22034;margin-left:3px}
.input-field-home{padding:12px 14px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;transition:all .3s;background:#fff;width:100%}
textarea.input-field-home{min-height:70px;resize:vertical}
.submit-btn-home{width:100%;padding:14px;background:linear-gradient(180deg,#C22034,#A11B2B);border:none;border-radius:8px;color:#fff;font-size:15px;font-weight:600;cursor:pointer;transition:all .3s;box-shadow:0 4px 12px rgba(194,32,52,.3)}
.success-message-home{display:none;background:#10b981;color:#fff;padding:15px;border-radius:8px;text-align:center;margin-top:15px;font-size:14px}
.success-message-home.show{display:block}

/* ── BLOG ──────────────────────────────────── */
.blog-section{padding:80px 20px 60px;background-color:#fff;box-sizing:border-box}
.blog-container{width:100%;max-width:1400px;padding-inline:clamp(20px,4vw,48px);margin:0 auto}
.blog-header{text-align:center;margin-bottom:60px;display:flex;flex-direction:column;align-items:center;gap:16px}
.blog-title{font-size:42px;font-weight:700;color:#111;margin:0;letter-spacing:-.02em;line-height:1.1}
.blog-subtitle{font-size:18px;color:#555;max-width:600px;margin:0;line-height:1.5}
.blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:32px}
.blog-card{background:#fff;border-radius:16px;overflow:hidden;border:1px solid #eaeaea;transition:transform .3s,box-shadow .3s;display:flex;flex-direction:column}
.blog-img-wrapper{position:relative;width:100%;padding-top:60%;overflow:hidden;background-color:#f0f0f0}
.blog-img{position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;transition:transform .5s}
.blog-content{padding:24px;display:flex;flex-direction:column;flex-grow:1}
.blog-meta{display:flex;align-items:center;gap:12px;margin-bottom:12px;font-size:14px}
.blog-category{background-color:rgba(194,32,52,.1);color:#c22034;padding:4px 10px;border-radius:4px;font-weight:600;text-transform:uppercase;font-size:12px;letter-spacing:.02em}
.blog-date{color:#888}
.blog-card-title{font-size:20px;font-weight:700;color:#111;margin:0 0 12px;line-height:1.4}
.blog-excerpt{font-size:16px;color:#555;line-height:1.6;margin:0 0 20px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;flex-grow:1}
.blog-link{text-decoration:none;color:#111;font-weight:600;display:inline-flex;align-items:center;gap:8px;margin-top:auto;transition:color .2s}
.blog-link svg{width:18px;height:18px;transition:transform .2s;stroke:#c22034}
@media(max-width:1024px){.blog-grid{grid-template-columns:repeat(2,1fr)}.blog-title{font-size:36px}}
@media(max-width:768px){.blog-grid{grid-template-columns:1fr;gap:40px}.blog-title{font-size:30px}.blog-header{margin-bottom:40px}}

/* FIX 1: Spinner shown while Font Awesome loads asynchronously */
@keyframes fa-spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
.submit-btn-home .btn-spinner{
    display:inline-block;
    width:14px;height:14px;
    border:2px solid rgba(255,255,255,.4);
    border-top-color:#fff;
    border-radius:50%;
    animation:fa-spin .6s linear infinite;
    margin-right:8px;
    vertical-align:middle;
}
</style>

<!-- ═══════════════════════════════════════ HERO ═══════════════════════════════════════ -->
<section class="hero-section-wrapper" aria-label="Hero section">
    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title">You Know Logistics. <br><span class="feature-heading-highlight" style="color:#ff5f73;">We Know How to Market It.</span></h1>
            <p class="hero-description">Behind every logistics contract is a buyer looking for certainty. Clear communication. Proven capability. Reliable partners. We help logistics businesses translate their operational strength into digital visibility that attracts the right customers and supports long-term growth.</p>
            <div class="hero-actions">
                <a href="/online-meeting" class="btn-primary" aria-label="Schedule a call with SalesNanny">
                    Schedule a Call
                    <svg class="icon-arrow-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline>
                    </svg>
                </a>
            </div>
            <div class="hero-stats" role="list" aria-label="Key statistics">
                <div class="stat-item" role="listitem">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Years of Marketing &amp; Domain Expertise</div>
                </div>
                <div class="stat-item" role="listitem">
                    <div class="stat-number">80+</div>
                    <div class="stat-label">Accounts Successfully Managed</div>
                </div>
                <div class="stat-item" role="listitem">
                    <div class="stat-number">100K+</div>
                    <div class="stat-label">Inbound Leads Generated</div>
                </div>
            </div>
        </div>

        <!-- Right Column: YouTube FACADE -->
        <div class="hero-visuals">
            <div class="blob-purple" aria-hidden="true"></div>
            <div class="video-card-container" id="videoCardContainer">
                <div class="floating-badge badge-top-left" aria-hidden="true"><span>⚡ Instant Analysis</span></div>
                <div class="video-wrapper" id="videoWrapper">
                    <?php /* FIX 2: LCP image — self-hosted thumb preferred; explicit dimensions, fetchpriority=high, loading=eager */ ?>
                    <button class="yt-facade" id="ytFacade"
                            data-videoid="<?php echo esc_attr( $yt_video_id ); ?>"
                            aria-label="Play SalesNanny introduction video">
                        <img
                            src="<?php echo esc_url( $yt_thumb ); ?>"
                            alt="SalesNanny – Digital Marketing for Logistics"
                            width="480" height="360"
                            loading="eager"
                            fetchpriority="high"
                            decoding="sync">
                        <div class="yt-play-btn" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </button>
                </div>
                <div class="floating-badge badge-bottom-right" aria-hidden="true"><span>📈 +124% Growth</span></div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ PARTNERS ═══════════════════════════════════════ -->
<section class="partners-section" aria-label="Trusted by logistics companies worldwide">
    <div class="partners-container">
        <div class="partners-header-group">
            <h2 class="partners-title">Trusted by Logistics Companies Worldwide</h2>
        </div>
        <div class="partners-ticker-wrapper">
            <div class="partners-ticker-inner">
                <div class="partners-ticker-track" id="tickerTrack">
                    <img class="partner-logo-item"
                         src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/logoset.webp"
                         alt="Client Logos"
                         width="1200" height="70"
                         loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ FEATURES ═══════════════════════════════════════ -->
<section class="features-wrapper" aria-label="How we build demand for logistics businesses">
    <div style="text-align:center;max-width:900px;margin:0 auto 30px;">
        <h2 class="feature-heading">How We Build Demand for <span class="feature-heading-highlight">Logistics Businesses?</span></h2>
    </div>

    <?php
    $feature_rows = [
        [
            'reverse' => false,
            'img' => 'home3.webp',
            'img_alt' => 'Business strategy for logistics clarity',
            'heading' => 'Clarity Before <span class="feature-heading-highlight">Visibility</span>',
            'sub' => 'Your Logistics buyers engage only when services are clearly understood.',
            'items' => [
                [ 'Service & Market Clarity', 'We break down complex logistics services into clear, buyer-friendly messaging based on routes, cargo types, and industries served.' ],
                [ 'Search Intent Mapping', 'We identify how logistics buyers actually search - by service, location, urgency, and use case - not generic keywords.' ],
                [ 'Consistent Industry Language', 'Your messaging stays operational, credible, and aligned across your website, content, and campaigns.' ],
            ],
        ],
        [
            'reverse' => true,
            'img' => 'home4.webp',
            'img_alt' => 'Turning logistics capability into demand',
            'heading' => 'Turning Logistics Capability into <span class="feature-heading-highlight">Demand</span>',
            'sub' => "Visibility means nothing if it doesn't reach the right buyers.",
            'items' => [
                [ 'Demand-Focused Visibility', 'We focus on channels where logistics decision-makers are active — search, LinkedIn, and industry-relevant platforms.' ],
                [ 'Buyer-Stage Content Planning', 'Content is mapped to how logistics deals progress — awareness, evaluation, and final vendor selection.' ],
                [ 'Platform-Specific Positioning', 'Messaging is adapted for each platform without losing clarity or operational credibility.' ],
            ],
        ],
        [
            'reverse' => false,
            'img' => 'home5.webp',
            'img_alt' => 'Measuring what actually matters in logistics marketing',
            'heading' => 'Measuring What Actually <span class="feature-heading-highlight">Matters</span>',
            'sub' => 'Your Logistics growth is measured in enquiries, not impressions.',
            'items' => [
                [ 'Lead Flow Optimization', 'We ensure enquiries move smoothly from website to sales teams without friction or loss of intent.' ],
                [ 'Campaign-to-Enquiry Visibility', 'Every lead is tracked back to the channel and message that generated it - no guesswork.' ],
                [ 'Continuous Performance Review', 'Campaigns are refined based on lead quality, buyer response, and real sales feedback.' ],
            ],
        ],
    ];

    $icon_svg = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M8.81202 26.392C7.16102 27.34 5.30002 27.68 4.19802 27.802C4.32002 26.7 4.66002 24.839 5.60702 23.187C5.85502 22.756 5.70602 22.206 5.27502 21.958C4.84002 21.709 4.29302 21.86 4.04602 22.291C2.35002 25.249 2.33002 28.627 2.33002 28.77C2.33002 29.267 2.73302 29.67 3.23002 29.67C3.37302 29.67 6.75102 29.65 9.70902 27.954C10.14 27.706 10.289 27.157 10.041 26.725C9.79502 26.294 9.24602 26.144 8.81202 26.392Z" fill="black"/><path d="M30.909 3.27509C30.92 2.68409 30.697 2.13009 30.281 1.71509C29.866 1.30009 29.266 1.09509 28.724 1.09009C26.232 1.13709 19.51 1.85209 13.15 7.56109C12.016 7.12009 10.307 6.46509 9.01 6.63209C7.102 6.87709 4.283 9.47309 1.522 12.2431C1.156 12.6101 1.01 13.1301 1.133 13.6341C1.255 14.1401 1.625 14.5371 2.121 14.6961L6.511 16.1061C6.18 16.7101 5.854 17.3281 5.539 17.9801C5.143 18.8001 5.311 19.7851 5.957 20.4291L11.57 26.0421C11.982 26.4551 12.534 26.6731 13.091 26.6731C13.406 26.6731 13.724 26.6041 14.02 26.4611C14.672 26.1461 15.29 25.8201 15.892 25.4901L17.303 29.8791C17.462 30.3751 17.859 30.7451 18.366 30.8681C18.483 30.8961 18.601 30.9101 18.719 30.9101C19.104 30.9101 19.475 30.7591 19.757 30.4781C22.527 27.7171 25.123 24.8991 25.367 22.9921C25.536 21.6831 24.879 19.9841 24.438 18.8501C30.146 12.4901 30.862 5.76809 30.909 3.27509Z" fill="black"/><path d="M24.128 13.214C25.6 11.741 25.6 9.34499 24.128 7.87199C22.7 6.44599 20.212 6.44599 18.786 7.87199C18.073 8.58499 17.68 9.53399 17.68 10.543C17.68 11.552 18.074 12.501 18.786 13.214C19.499 13.927 20.448 14.32 21.457 14.32C22.466 14.32 23.414 13.927 24.128 13.214ZM22.854 11.941C22.107 12.689 20.804 12.689 20.059 11.941C19.685 11.568 19.479 11.071 19.479 10.543C19.479 10.015 19.685 9.51899 20.059 9.14499C20.432 8.77199 20.928 8.56599 21.456 8.56599C21.983 8.56599 22.48 8.77199 22.853 9.14499C23.625 9.91599 23.625 11.17 22.854 11.941Z" fill="black"/></svg>';

    foreach ( $feature_rows as $row ) :
    ?>
    <div class="feature-row <?php echo $row['reverse'] ? 'feature-reverse' : ''; ?>">
        <div class="feature-image-col">
            <img class="feature-main-img"
                 src="<?php echo esc_url( get_template_directory_uri() . '/assets/' . $row['img'] ); ?>"
                 alt="<?php echo esc_attr( $row['img_alt'] ); ?>"
                 width="550" height="400"
                 loading="lazy" decoding="async">
        </div>
        <div class="feature-content-col">
            <h2 class="feature-heading"><?php echo $row['heading']; ?></h2>
            <p class="feature-item-desc" style="font-size:16px;color:#666;"><?php echo esc_html( $row['sub'] ); ?></p>
            <div class="feature-divider"></div>
            <div class="feature-list-group">
                <?php foreach ( $row['items'] as $item ) : ?>
                <div class="feature-list-item">
                    <div class="feature-icon-wrapper"><?php echo $icon_svg; ?></div>
                    <div class="feature-text-wrapper">
                        <h3 class="feature-item-title"><?php echo esc_html( $item[0] ); ?></h3>
                        <p class="feature-item-desc"><?php echo esc_html( $item[1] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<!-- ═══════════════════════════════════════ TESTIMONIAL ═══════════════════════════════════════ -->
<svg style="width:0" viewBox="0 0 122 122" id="svg12453579485" aria-hidden="true"><g transform="translate(0 3.955)"><path d="M 70.279 67.962 C 66.057 46.397 46.14 36.597 25.813 40.416 C 28.143 28.316 39.564 18.423 46.985 9.227 C 48.037 7.923 48.579 5.629 46.985 4.401 C 43.073 1.386 39.421 0.448 36.058 0.923 C 35.825 0.29 35.207 -0.182 34.405 0.068 C 22.466 3.797 14.735 16.446 9.562 26.929 C 2.737 40.765 -0.687 56.782 0.115 72.157 C 1.38 96.396 23.198 119.508 49.18 112.779 C 68.148 107.867 73.531 84.578 70.279 67.962 Z" fill="#c22034"/><path d="M 74.238 36.516 C 76.535 27.311 82.802 20.957 87.354 12.655 C 88.095 11.305 87.804 9.206 86.254 8.492 C 83.42 7.186 80.873 5.737 78.04 4.662 C 77.183 2.848 74.593 1.657 72.611 3.429 C 69.106 6.562 65.279 10.58 62.222 15.07 C 58.167 20.003 55.256 25.99 54.289 31.75 C 54.174 32.432 54.293 33.123 54.562 33.754 C 54.416 34.005 54.27 34.254 54.123 34.506 C 53.383 35.778 53.805 37.488 55.106 38.224 C 70.538 46.952 76.922 61.163 76.468 76.136 C 75.686 78.32 75.488 80.68 75.786 83.052 C 74.537 90.587 71.676 98.131 67.452 105.099 C 66.502 106.665 66.856 108.13 67.783 109.123 C 68.026 109.908 68.664 110.57 69.81 110.827 C 94.413 116.339 119.165 104.661 121.835 78.036 C 124.319 53.26 98.298 32.381 74.238 36.516 Z" fill="#c22034"/></g></svg>

<section class="ts-section" aria-label="Client testimonials">
    <section class="sales-header">
        <h2 class="sales-headline light">See How Our Work Made a Real Difference in Logistics Business Growth</h2>
    </section>
    <div class="ts-card" role="region" aria-label="Testimonial carousel">
        <button class="ts-nav-btn ts-nav-prev" onclick="changeSlide('prev')" aria-label="Previous testimonial">
            <svg class="ts-nav-icon" viewBox="0 0 24 24" aria-hidden="true"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button class="ts-nav-btn ts-nav-next" onclick="changeSlide('next')" aria-label="Next testimonial">
            <svg class="ts-nav-icon" viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
        <div class="ts-content-col">
            <div class="ts-quote-wrapper">
                <div class="svgContainer" style="width:122px;height:122px;position:absolute;top:40px;left:50px;overflow:hidden;opacity:.3" aria-hidden="true">
                    <svg style="width:100%;height:100%"><use href="#svg12453579485"></use></svg>
                </div>
                <p class="ts-quote-text ts-fade-up" id="ts-quote">
                    "Working with SalesNanny brought real structure to our digital outreach. Within the first few weeks, we began receiving consistent, relevant inquiries through their DM strategies. What stood out was their clarity of strategy and disciplined follow-up process. They focused on building genuine conversations, not just sending messages. I would confidently recommend them to any business looking to improve its lead generation."
                </p>
            </div>
            <div class="ts-author-info ts-fade-up" style="animation-delay:.1s">
                <p class="ts-author-name" id="ts-name">Sugie Govender</p>
                <p class="ts-author-role" id="ts-role">CEO / Transglobal</p>
            </div>
        </div>
        <div class="ts-image-col">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/ceo1.webp"
                 alt="Sugie Govender – CEO at Transglobal"
                 class="ts-image" id="ts-image"
                 width="500" height="400"
                 loading="lazy" decoding="async">
        </div>
    </div>

    <!-- Social proof badges -->
    <div class="ts-proof-wrapper">
        <section class="social-proof-section" aria-label="Review platform ratings">
            <div class="social-proof-container">
                <div class="stats-grid">
                    <?php
                    $review_platforms = [
                        [ 'logo' => 'https://cdn.worldvectorlogo.com/logos/g2-reviews.svg',        'alt' => 'G2',         'score' => '4.8', 'color' => '#ff492c', 'text' => 'Based on 850+ reviews' ],
                        [ 'logo' => 'https://cdn.worldvectorlogo.com/logos/capterra-wordmark.svg', 'alt' => 'Capterra',   'score' => '4.9', 'color' => '#faa922', 'text' => 'Highest Performer 2024' ],
                        [ 'logo' => 'https://cdn.worldvectorlogo.com/logos/trustpilot-1.svg',      'alt' => 'Trustpilot', 'score' => '4.9', 'color' => '#00b67a', 'text' => 'Rated "Excellent"' ],
                    ];
                    foreach ( $review_platforms as $p ) : ?>
                    <div class="stat-card">
                        <div class="card-left">
                            <div class="platform-logo-wrapper">
                                <img class="platform-logo"
                                     src="<?php echo esc_url( $p['logo'] ); ?>"
                                     alt="<?php echo esc_attr( $p['alt'] ); ?>"
                                     width="100" height="24"
                                     loading="lazy">
                            </div>
                        </div>
                        <div class="card-center">
                            <div class="rating-wrapper">
                                <span class="rating-number"><?php echo esc_html( $p['score'] ); ?></span>
                                <span class="rating-max">/5</span>
                            </div>
                            <div class="stars-wrapper" style="color:<?php echo esc_attr( $p['color'] ); ?>"
                                 aria-label="<?php echo esc_attr( $p['score'] ); ?> out of 5 stars">
                                <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                                <svg class="star-icon" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="card-right">
                            <p class="review-texts"><?php echo esc_html( $p['text'] ); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</section>

<!-- ═══════════════════════════════════════ LONG-TERM PARTNER ═══════════════════════════════════════ -->
<section class="sales-feature-section" aria-label="Your long-term digital growth partner">
    <div class="sales-feature-container">
        <section class="sales-header">
            <h2 class="sales-headline">Your Long-Term Digital <span class="sales-headline-highlight">Growth Partner in Logistics</span></h2>
            <p class="sales-subheadline">Marketing in Logistics Requires Industry Understanding</p>
        </section>
        <div class="sales-grid">
            <?php
            $partner_cards = [
                [
                    'img' => 'home6.webp', 'alt' => 'Logistics-focused onboarding and strategy',
                    'title' => 'Logistics-Focused Onboarding &amp; Strategy',
                    'desc' => 'We start by understanding your logistics services, routes, target industries, and sales process. Based on this, we build a clear digital strategy that reflects how your business actually operates – not a generic marketing plan.',
                    'items' => [ 'Operations-first', 'No one-size-fits-all', 'Strategy before execution' ],
                ],
                [
                    'img' => 'home7.webp', 'alt' => 'Dedicated support that understands logistics',
                    'title' => 'Dedicated Support That Understands Logistics',
                    'desc' => 'You work with a team that understands freight, transport, and supply chain businesses. From campaign changes to performance discussions, support is practical, responsive, and aligned with real business needs.',
                    'items' => [ 'Fewer explanations', 'Faster alignment', 'Business-aware conversations' ],
                ],
                [
                    'img' => 'home8.webp', 'alt' => 'Secure, measured and result-driven execution',
                    'title' => 'Secure, Measured &amp; Result-Driven Execution',
                    'desc' => 'We focus on outcomes that matter to logistics businesses – enquiry quality, consistency, and sales alignment. Your data, leads, and insights are handled securely, with full transparency at every stage.',
                    'items' => [ 'No vanity metrics', 'Clear accountability', 'Trust-first approach' ],
                ],
            ];
            foreach ( $partner_cards as $card ) : ?>
            <article class="sales-card">
                <div class="card-image-wrapper">
                    <img class="card-image"
                         src="<?php echo esc_url( get_template_directory_uri() . '/assets/' . $card['img'] ); ?>"
                         alt="<?php echo esc_attr( $card['alt'] ); ?>"
                         width="400" height="240"
                         loading="lazy" decoding="async">
                </div>
                <div class="card-text-content">
                    <h3 class="card-title"><?php echo $card['title']; ?></h3>
                    <p class="card-description"><?php echo esc_html( $card['desc'] ); ?></p>
                    <ul class="card-feature-list">
                        <?php foreach ( $card['items'] as $item ) : ?>
                        <li class="feature-item">
                            <span class="feature-icon" aria-hidden="true"></span><?php echo esc_html( $item ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ HUB ═══════════════════════════════════════ -->
<section class="hub" aria-label="Digital marketing in logistics decision-making">
    <section class="sales-header">
        <h2 class="sales-headline">Digital Marketing is Now Part of <span class="sales-headline-highlight">Logistics Decision-Making</span></h2>
        <p class="sales-subheadline">Because buyers research, compare, and shortlist partners online.</p>
    </section>
    <section class="hub-section">
        <svg class="hub-connections" viewBox="0 0 1200 600" preserveAspectRatio="none" aria-hidden="true">
            <path class="connection-line" d="M 380 100 C 500 100, 500 300, 600 300"/>
            <path class="connection-line" d="M 380 300 C 480 300, 500 300, 600 300"/>
            <path class="connection-line" d="M 380 500 C 500 500, 500 300, 600 300"/>
            <path class="connection-line" d="M 820 100 C 700 100, 700 300, 600 300"/>
            <path class="connection-line" d="M 820 300 C 720 300, 700 300, 600 300"/>
            <path class="connection-line" d="M 820 500 C 700 500, 700 300, 600 300"/>
        </svg>
        <div class="hub-container">
            <div class="hub-column-side left-side">
                <?php
                $left_cards = [
                    [ 'title' => 'Early Shortlisting',  'desc' => 'Logistics buyers shortlist vendors online before making first contact.',   'sub' => 'Being visible at this stage determines who gets considered.' ],
                    [ 'title' => 'Complex Offerings',   'desc' => 'Routes, modes, timelines, and constraints are difficult to explain quickly.', 'sub' => 'Digital platforms help buyers understand capability before discussions begin.' ],
                    [ 'title' => 'Credibility Checks',  'desc' => 'Buyers review websites and online presence before engaging.',              'sub' => 'Clear, professional visibility builds confidence early.' ],
                ];
                foreach ( $left_cards as $c ) : ?>
                <div class="service-card">
                    <div class="service-icon-wrapper" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="10" stroke="#c22034" stroke-width="2"/><circle cx="14" cy="14" r="5" fill="#c22034"/></svg>
                    </div>
                    <h3 class="service-title"><?php echo esc_html( $c['title'] ); ?></h3>
                    <p class="service-desc"><?php echo esc_html( $c['desc'] ); ?><br><span style="opacity:.75;"><?php echo esc_html( $c['sub'] ); ?></span></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="image-center">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/home.gif"
                     alt="Logistics digital marketing hub diagram"
                     width="400" height="400"
                     loading="lazy" decoding="async">
            </div>
            <div class="hub-column-side right-side">
                <?php
                $right_cards = [
                    [ 'title' => 'Inbound Demand',         'desc' => 'Digital visibility brings enquiries from buyers already searching for logistics solutions.', 'sub' => 'This reduces reliance on cold outreach.' ],
                    [ 'title' => 'Qualified Enquiries',    'desc' => 'Clear positioning attracts buyers who understand scope and expectations.',                   'sub' => 'This improves conversation quality for sales teams.' ],
                    [ 'title' => 'Sustained Consideration','desc' => 'Logistics decisions take time and multiple evaluations.',                                    'sub' => 'Consistent visibility keeps your business in consideration throughout the cycle.' ],
                ];
                foreach ( $right_cards as $c ) : ?>
                <div class="service-card">
                    <div class="service-icon-wrapper" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="10" stroke="#c22034" stroke-width="2"/><circle cx="14" cy="14" r="5" fill="#c22034"/></svg>
                    </div>
                    <h3 class="service-title"><?php echo esc_html( $c['title'] ); ?></h3>
                    <p class="service-desc"><?php echo esc_html( $c['desc'] ); ?><br><span style="opacity:.75;"><?php echo esc_html( $c['sub'] ); ?></span></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══ TABS ═══ -->
    <section class="framer-section" aria-label="One integrated solution for your business growth">
        <div class="framer-container">
            <section class="sales-header">
                <h2 class="sales-headline light">One Integrated Solution for <span class="sales-headline-highlight-white">Your Business Growth</span></h2>
            </section>
            <div class="tabs-nav-wrapper" role="tablist" aria-label="Service tabs">
                <button class="tab-button active-tab" onclick="openTab(event,'web')"       role="tab" aria-selected="true"  aria-controls="web">Web Development</button>
                <button class="tab-button"             onclick="openTab(event,'earned')"   role="tab" aria-selected="false" aria-controls="earned">Organic Reach</button>
                <button class="tab-button"             onclick="openTab(event,'paid')"     role="tab" aria-selected="false" aria-controls="paid">Paid Media</button>
                <button class="tab-button"             onclick="openTab(event,'creatives')"role="tab" aria-selected="false" aria-controls="creatives">Creatives</button>
                <button class="tab-button"             onclick="openTab(event,'data')"     role="tab" aria-selected="false" aria-controls="data">Web Analytics</button>
                <button class="tab-button"             onclick="openTab(event,'sales')"    role="tab" aria-selected="false" aria-controls="sales">Pre Sales</button>
            </div>
            <div class="tab-content-wrapper">
                <?php
                $tabs = [
                    'web' => [
                        'title' => 'Web Experiences That Support Growth',
                        'desc'  => 'A website is more than a digital presence—it is a decision-making environment. We focus on building websites that communicate clearly, perform reliably, and support measurable outcomes.',
                        'items' => [ 'Website Strategy', 'UI / UX Design', 'Performance Optimisation', 'Conversion Design', 'Scalable Architecture', 'Ongoing Improvements' ],
                        'img' => 'home10.webp', 'img_alt' => 'Web development for logistics',
                    ],
                    'earned' => [
                        'title' => 'Organic Marketing Excellence',
                        'desc'  => 'Sustainable growth comes from being consistently discoverable and credible over time. Organic Reach focuses on building long-term authority across search, content, and owned channels.',
                        'items' => [ 'SEO Audit', 'Content Strategy', 'Social Presence', 'Public Relations', 'Community Building', 'Sustainable Growth' ],
                        'img' => 'home11.webp', 'img_alt' => 'Organic marketing for logistics',
                    ],
                    'paid' => [
                        'title' => 'Targeted Growth Through Paid Channels',
                        'desc'  => 'Paid media accelerates growth when it is intentional, controlled, and aligned with business objectives. Our approach focuses on capturing demand efficiently while continuously improving performance.',
                        'items' => [ 'Search Advertising', 'Social Advertising', 'Campaign Structuring', 'Budget Optimisation', 'Landing Page Alignment', 'Performance Monitoring' ],
                        'img' => 'home12.webp', 'img_alt' => 'Paid media for logistics',
                    ],
                    'creatives' => [
                        'title' => 'Creative That Supports Strategy',
                        'desc'  => 'Creative is most effective when it supports understanding and consistency. Our approach prioritises clarity, alignment, and adaptability across channels.',
                        'items' => [ 'Brand Identity', 'Messaging Frameworks', 'Campaign Creative', 'Content Design', 'Platform Adaptation', 'Consistency Management' ],
                        'img' => 'home13.webp', 'img_alt' => 'Creative services for logistics',
                    ],
                    'data' => [
                        'title' => 'Data That Drives Better Decisions',
                        'desc'  => 'Data should clarify decisions, not complicate them. We focus on creating a clean, connected data foundation that supports insight, accountability, and continuous improvement.',
                        'items' => [ 'Analytics Setup', 'Data Integration', 'Reporting Dashboards', 'Insight Analysis', 'Attribution Tracking', 'Data Governance' ],
                        'img' => 'home14.webp', 'img_alt' => 'Web analytics for logistics',
                    ],
                    'sales' => [
                        'title' => 'Aligning Marketing with Sales Execution',
                        'desc'  => 'Growth accelerates when marketing activity translates smoothly into sales conversations. We focus on alignment, clarity, and feedback between teams.',
                        'items' => [ 'Lead Qualification', 'CRM Alignment', 'Process Optimisation', 'Sales Enablement', 'Feedback Loops', 'Conversion Improvement' ],
                        'img' => 'home15.webp', 'img_alt' => 'Pre-sales for logistics',
                    ],
                ];
                foreach ( $tabs as $id => $tab ) : ?>
                <div id="<?php echo esc_attr( $id ); ?>"
                     class="tab-pane <?php echo $id === 'web' ? 'visible-pane' : ''; ?>"
                     role="tabpanel">
                    <div class="content-left">
                        <h2 class="content-title"><?php echo esc_html( $tab['title'] ); ?></h2>
                        <p class="content-desc"><?php echo esc_html( $tab['desc'] ); ?></p>
                        <div class="tabs-grid">
                            <?php foreach ( $tab['items'] as $item ) : ?>
                            <div class="tabs-item">
                                <div class="tabs-icon-box" aria-hidden="true">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 8 12 12 14 14"/></svg>
                                </div>
                                <span class="tabs-label"><?php echo esc_html( $item ); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="content-right">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/' . $tab['img'] ); ?>"
                             alt="<?php echo esc_attr( $tab['img_alt'] ); ?>"
                             class="tab-image"
                             width="600" height="500"
                             loading="lazy" decoding="async">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</section>

<!-- ═══════════════════════════════════════ BOOST / CTA ═══════════════════════════════════════ -->
<section class="section-boost-wrapper" aria-label="Call to action">
    <div class="section-boost-container">
        <div class="boost-card">
            <div class="boost-content">
                <div class="boost-header-group">
                    <h2 class="boost-title">Your Operations Are Strong. Your Visibility Should Match.</h2>
                    <svg class="boost-scribble" viewBox="0 0 190 15" aria-hidden="true"><path d="M 1.5 1.5 L 188.5 13.5 L 1.5 11.5"></path></svg>
                </div>
                <p class="boost-description">You already deliver reliability on the ground.<br><br>Our role is to translate that strength into digital visibility that brings the right conversations to your sales team.</p>
                <a href="/online-meeting" class="boost-cta-btn" aria-label="Book a call to discuss your logistics growth">
                    <span>Book a Call to Discuss Your Logistics Growth</span>
                    <svg class="boost-cta-icon" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <div class="boost-visual-wrapper">
                <img class="boost-bg-lines"
                     src="https://framerusercontent.com/images/E1OZmkJ1Awt8SfFFx3SpWiledc.png"
                     alt="" width="750" height="480"
                     loading="lazy" aria-hidden="true">
                <img class="boost-main-image"
                     src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/home16.webp"
                     alt="Marketing strategy team"
                     width="330" height="432"
                     loading="lazy" decoding="async">
                <div class="boost-float-card boost-card-left" aria-hidden="true"><p class="boost-float-text">Target Audiences</p></div>
                <div class="boost-float-card boost-card-right" aria-hidden="true"><p class="boost-float-text">Sales Growth</p></div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ TOOLS ═══════════════════════════════════════ -->
<section class="tools-section" aria-label="Tools we use to deliver precise results">
    <div class="tools-container">
        <div class="tools-header">
            <section class="sales-header">
                <h2 class="sales-headline">Tools We Use to Deliver <span class="tools-highlight-text">Precise Results</span></h2>
                <p class="sales-subheadline">We leverage industry-leading tools to drive visibility, precision, and performance across your logistics marketing strategy.</p>
            </section>
        </div>
        <div class="tools-slider-wrapper">
            <div class="tools-track" aria-label="Tools carousel">
                <?php
                $tools = [
                    [ 'google-ads.png',      'Google Ads' ],
                    [ 'open-ai.png',         'Open AI' ],
                    [ 'semrush.png',         'Semrush' ],
                    [ 'google-analytics.png','Google Analytics' ],
                    [ 'figma.png',           'Figma' ],
                    [ 'ahref.png',           'Ahrefs' ],
                    [ 'zapier.png',          'Zapier' ],
                    [ 'lovable-ai.png',      'Lovable AI' ],
                ];
                for ( $rep = 0; $rep < 2; $rep++ ) :
                    foreach ( $tools as $t ) : ?>
                    <div class="tools-item">
                        <img class="tools-image"
                             src="<?php echo esc_url( get_template_directory_uri() . '/assets/' . $t[0] ); ?>"
                             alt="<?php echo esc_attr( $t[1] ); ?>"
                             width="120" height="48"
                             loading="lazy" decoding="async">
                    </div>
                    <?php endforeach;
                endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ FAQ ═══════════════════════════════════════ -->
<section class="faq-section" aria-label="Frequently asked questions">
    <div class="faq-container">
        <div class="faq-content-col">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq-list">
                <?php
                $faqs = [
                    [
                        'q' => 'How does digital marketing help logistics businesses grow?',
                        'a' => 'Digital marketing helps logistics companies get discovered early in the buying process. It builds visibility, explains complex services clearly, and establishes trust long before a buyer makes contact – which is critical in long sales cycles.',
                    ],
                    [
                        'q' => 'We already get business through referrals. Why do we need digital marketing?',
                        'a' => 'Referrals are strong, but they are not predictable. Today, even referred buyers research you online before contacting you. Digital presence supports referrals by reinforcing trust and credibility.',
                    ],
                    [
                        'q' => 'How long does digital marketing take to show results in logistics?',
                        'a' => "Logistics growth is gradual. You'll typically see early visibility improvements first, followed by better enquiry quality and stronger sales conversations over time. This is not an overnight channel.",
                    ],
                    [
                        'q' => 'What is your Team-as-a-Service (TaaS) model?',
                        'a' => 'Our TaaS model gives you access to a complete digital growth team without hiring one internally. Instead of managing multiple full-time roles, you work with a coordinated team covering strategy, execution, and delivery – under one plan and one predictable cost.',
                    ],
                    [
                        'q' => 'How is TaaS different from hiring an in-house marketer or agency?',
                        'a' => 'An in-house hire brings one skillset. Traditional agencies work in silos. With TaaS, you get multiple specialists – marketing strategy, content, performance, design, development, and coordination – working together as an extension of your business, without hiring overhead.',
                    ],
                ];
                foreach ( $faqs as $faq ) : ?>
                <div class="faq-item">
                    <div class="faq-header">
                        <p class="faq-question"><?php echo esc_html( $faq['q'] ); ?></p>
                        <?php /* FIX 1: Inline SVG chevron — no Font Awesome dependency for FAQ toggle */ ?>
                        <svg class="faq-icon" viewBox="0 0 24 24" width="16" height="16"
                             fill="none" stroke="currentColor" stroke-width="2.5"
                             stroke-linecap="round" stroke-linejoin="round"
                             style="flex-shrink:0;transition:transform .3s" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div class="faq-answer"><p><?php echo esc_html( $faq['a'] ); ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="faq-feature-col">
            <div class="contact-form-wrapper">
                <h3 class="contact-form-title">Get in Touch</h3>
                <form id="contactFormHome" novalidate aria-label="Contact form">
                    <div class="form-grid-home">
                        <div class="form-field-home full">
                            <label for="firstname_home">Full Name <span class="required" aria-label="required">*</span></label>
                            <input type="text" id="firstname_home" class="input-field-home" placeholder="John" required autocomplete="name">
                        </div>
                        <div class="form-field-home full">
                            <label for="email_home">Email Address <span class="required" aria-label="required">*</span></label>
                            <input type="email" id="email_home" class="input-field-home" placeholder="john@company.com" required autocomplete="email">
                        </div>
                    </div>
                    <div class="form-field-home full">
                        <label for="company_home">Company Name</label>
                        <input type="text" id="company_home" class="input-field-home" placeholder="Your Company Inc." autocomplete="organization">
                    </div>
                    <div class="form-field-home full">
                        <label for="message_home">How can we help? <span class="required" aria-label="required">*</span></label>
                        <textarea id="message_home" class="input-field-home" placeholder="Tell us about your project..." required></textarea>
                    </div>
                    <?php /* FIX 1: Send icon is inline SVG — no FA dependency for submit button */ ?>
                    <button type="submit" class="submit-btn-home" id="submitBtnHome">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" style="margin-right:8px;vertical-align:middle" aria-hidden="true">
                            <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        Send Message
                    </button>
                    <div id="successMsgHome" class="success-message-home" role="alert" aria-live="polite">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                             stroke-linejoin="round" style="margin-right:8px;vertical-align:middle" aria-hidden="true">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Message sent successfully!
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════ BLOG ═══════════════════════════════════════ -->
<section class="blog-section" aria-label="Recent insights and updates">
    <div class="blog-container">
        <div class="blog-header">
            <h2 class="blog-title">Recent Insights &amp; <span style="color:#c22034">Updates</span></h2>
            <p class="blog-subtitle">Stay ahead of the curve with our latest articles on logistics marketing, digital transformation, and growth strategies.</p>
        </div>
        <div class="blog-grid">
            <?php
            $blog_query = new WP_Query( [
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            ] );
            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) : $blog_query->the_post();
                    $categories    = get_the_category();
                    $category_name = ! empty( $categories ) ? $categories[0]->name : 'Uncategorized';
                    $featured_img  = has_post_thumbnail()
                        ? get_the_post_thumbnail_url( get_the_ID(), 'large' )
                        : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
            ?>
            <article class="blog-card">
                <div class="blog-img-wrapper">
                    <img src="<?php echo esc_url( $featured_img ); ?>"
                         alt="<?php echo esc_attr( get_the_title() ); ?>"
                         class="blog-img"
                         width="800" height="480"
                         loading="lazy" decoding="async">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="blog-category"><?php echo esc_html( $category_name ); ?></span>
                        <span class="blog-date"><?php echo get_the_date( 'M j, Y' ); ?></span>
                    </div>
                    <h3 class="blog-card-title"><?php the_title(); ?></h3>
                    <p class="blog-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="blog-link"
                       aria-label="Read article: <?php echo esc_attr( get_the_title() ); ?>">
                        Read Article
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                </div>
            </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No recent insights found.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
/*
 * ═══════════════════════════════════════════════════════════════════
 * ALL JS CONSOLIDATED AT BOTTOM — no render-blocking scripts
 * ═══════════════════════════════════════════════════════════════════
 *
 * ADDITIONAL SERVER-SIDE RECOMMENDATION (add to .htaccess):
 * ──────────────────────────────────────────────────────────
 * <IfModule mod_expires.c>
 *   ExpiresActive On
 *   ExpiresByType image/webp   "access plus 1 year"
 *   ExpiresByType image/jpeg   "access plus 1 year"
 *   ExpiresByType image/png    "access plus 1 year"
 *   ExpiresByType image/gif    "access plus 1 year"
 *   ExpiresByType image/svg+xml "access plus 1 year"
 *   ExpiresByType font/woff2   "access plus 1 year"
 *   ExpiresByType font/woff    "access plus 1 year"
 *   ExpiresByType text/css     "access plus 1 month"
 *   ExpiresByType application/javascript "access plus 1 month"
 * </IfModule>
 *
 * FUNCTIONS.PHP RECOMMENDATION:
 * ──────────────────────────────
 * Ensure all wp_enqueue_script() calls use 'true' as the $in_footer
 * parameter, and add 'defer' via the script_loader_tag filter:
 *
 * add_filter('script_loader_tag', function($tag, $handle, $src) {
 *     $defer_handles = ['jquery', 'your-theme-script', 'slick-slider'];
 *     if (in_array($handle, $defer_handles)) {
 *         return '<script src="' . esc_url($src) . '" defer></script>';
 *     }
 *     return $tag;
 * }, 10, 3);
 */
?>
<script>
/* ── YouTube Facade ────────────────────────────────────────────── */
(function(){
    var btn = document.getElementById('ytFacade');
    if(!btn) return;
    btn.addEventListener('click', function(){
        var wrapper  = document.getElementById('videoWrapper');
        var videoId  = btn.getAttribute('data-videoid');
        var iframe   = document.createElement('iframe');
        iframe.className       = 'hero-video';
        iframe.src             = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0&modestbranding=1';
        iframe.title           = 'SalesNanny introduction video';
        iframe.allow           = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowFullscreen = true;
        wrapper.classList.add('yt-iframe-active');
        wrapper.appendChild(iframe);
    }, {once:true});
})();

/* ── Partners ticker ───────────────────────────────────────────── */
(function(){
    var track = document.getElementById('tickerTrack');
    if(!track) return;
    var image = track.querySelector('.partner-logo-item');
    function buildMarquee(){
        var items = Array.from(track.children);
        track.innerHTML = '';
        track.appendChild(items[0]);
        var imgW = items[0].getBoundingClientRect().width;
        var sw   = window.innerWidth;
        if(imgW === 0) return;
        var needed = Math.ceil(sw / imgW) * 2;
        if(needed % 2 !== 0) needed++;
        needed += 2;
        var frag = document.createDocumentFragment();
        for(var i = 1; i < needed; i++){
            frag.appendChild(items[0].cloneNode(true));
        }
        track.appendChild(frag);
    }
    if(image.complete){ buildMarquee(); } else { image.addEventListener('load', buildMarquee); }
    var t;
    window.addEventListener('resize', function(){ clearTimeout(t); t = setTimeout(buildMarquee, 250); });
})();

/* ── Testimonial slider ────────────────────────────────────────── */
var testimonials = [
    {
        quote: "Working with SalesNanny brought real structure to our digital outreach. Within the first few weeks, we began receiving consistent, relevant inquiries through their DM strategies.\n\nWhat stood out was their clarity of strategy and disciplined follow-up process. They focused on building genuine conversations, not just sending messages.\n\nI would confidently recommend them to any business looking to improve its lead generation.",
        name: "Sugie Govender", role: "CEO / Transglobal",
        img: "<?php echo esc_js( get_template_directory_uri() ); ?>/assets/ceo1.webp"
    },
    {
        quote: "We approached SalesNanny to strengthen our online presence and lead-generation process. Their team quickly understood our industry and developed an outreach plan that aligned with our goals.\n\nWe saw a clear improvement in response quality and engagement compared with what we had been doing.\n\nThey are proactive, reliable, and easy to work with.",
        name: "Thanigaivel. M", role: "CEO / FOSDesk",
        img: "<?php echo esc_js( get_template_directory_uri() ); ?>/assets/ceo2.webp"
    }
];
testimonials.forEach(function(d){ (new Image()).src = d.img; });
var currentIndex = 0;
function changeSlide(dir){
    currentIndex = dir === 'next'
        ? (currentIndex + 1) % testimonials.length
        : (currentIndex - 1 + testimonials.length) % testimonials.length;
    var q = document.getElementById('ts-quote');
    var n = document.getElementById('ts-name');
    var r = document.getElementById('ts-role');
    var i = document.getElementById('ts-image');
    var a = document.querySelector('.ts-author-info');
    if(!q) return;
    q.style.animation = 'none'; a.style.animation = 'none';
    i.style.opacity = '0.7'; i.style.transform = 'scale(0.98)';
    void q.offsetWidth;
    setTimeout(function(){
        var d = testimonials[currentIndex];
        q.textContent = d.quote;
        n.textContent = d.name;
        r.textContent = d.role;
        i.src = d.img;
        i.alt = d.name + ' – ' + d.role;
        q.style.animation = 'fadeUp 0.6s forwards';
        a.style.animation = 'fadeUp 0.6s 0.1s forwards';
        i.style.opacity = '1'; i.style.transform = 'scale(1)';
    }, 200);
}

/* ── Tabs ──────────────────────────────────────────────────────── */
var currentTab = 'web';
function openTab(evt, tabId){
    if(currentTab === tabId) return;
    var old = document.getElementById(currentTab);
    if(old){ old.classList.remove('visible-pane'); }
    document.querySelectorAll('.tab-button').forEach(function(b){
        b.classList.remove('active-tab');
        b.setAttribute('aria-selected','false');
    });
    setTimeout(function(){
        var pane = document.getElementById(tabId);
        if(pane){ pane.classList.add('visible-pane'); }
    }, 50);
    evt.currentTarget.classList.add('active-tab');
    evt.currentTarget.setAttribute('aria-selected','true');
    currentTab = tabId;
}

/* ── FAQ accordion ─────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.faq-item').forEach(function(item){
        item.addEventListener('click', function(){
            var isActive = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(function(o){
                o.classList.remove('active');
                var a = o.querySelector('.faq-answer');
                if(a) a.style.maxHeight = null;
                /* FIX 1: target inline SVG icon, not FA <i> */
                var ico = o.querySelector('.faq-icon');
                if(ico) ico.style.transform = '';
            });
            if(!isActive){
                item.classList.add('active');
                var ans = item.querySelector('.faq-answer');
                if(ans) ans.style.maxHeight = ans.scrollHeight + 'px';
                var ico = item.querySelector('.faq-icon');
                if(ico) ico.style.transform = 'rotate(180deg)';
            }
        });
    });

    /* ── Contact form ────────────────────────────────────────────── */
    var form = document.getElementById('contactFormHome');
    if(form){
        form.addEventListener('submit', function(e){
            e.preventDefault();
            var btn  = document.getElementById('submitBtnHome');
            var orig = btn.innerHTML;
            btn.disabled = true;
            /* FIX 1: CSS spinner — no Font Awesome dependency */
            btn.innerHTML = '<span class="btn-spinner" aria-hidden="true"></span>Sending…';

            var formData = new FormData();
            formData.append('action',             'contactus_submit');
            formData.append('form-field-53ca358', document.getElementById('firstname_home').value);
            formData.append('form-field-e7d1df3',  document.getElementById('email_home').value);
            formData.append('form-field-d0e86ec',  document.getElementById('company_home').value || 'Home FAQ Contact');
            formData.append('form-field-72f8d88',  document.getElementById('message_home').value);
            formData.append('form_action',         'contactus_submit');
            formData.append('page_url',            window.location.href);

            var nonce = (window.ajax_object && (window.ajax_object.nonce || window.ajax_object.contactus_nonce)) || '';
            if(nonce) formData.append('nonce', nonce);

            var ajaxUrl = (window.ajax_object && window.ajax_object.ajax_url) || '/wp-admin/admin-ajax.php';
            fetch(ajaxUrl, { method: 'POST', body: formData })
                .then(function(r){ return r.json(); })
                .then(function(data){
                    if(data.success){
                        var msg = document.getElementById('successMsgHome');
                        msg.classList.add('show');
                        form.reset();
                        setTimeout(function(){ msg.classList.remove('show'); }, 5000);
                    } else {
                        alert('Error: ' + ((data.data && data.data.message) || 'Failed to submit'));
                    }
                })
                .catch(function(err){ console.error(err); alert('An error occurred. Please try again.'); })
                .finally(function(){ btn.disabled = false; btn.innerHTML = orig; });
        });
    }
});
</script>

<?php get_footer(); ?>
