<?php
/**
 * Single Blog Template (FINAL, UNIFIED VERSION)
 * - Combines the original template's structure and JS interactivity.
 * - Integrates the pixel-perfect styles and sections from the BlogXpress design.
 * - Fully responsive and matches the provided screenshots exactly.
 */
get_header();

function sblog_read_time($content) {
    $words = str_word_count(wp_strip_all_tags($content));
    return max(1, ceil($words / 200)) . ' min read';
}

// Custom comment callback to match the BlogXpress design
function sblog_display_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class('each-comment'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-figure">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        </div>
        <div class="comment-content">
            <h4 class="comment-title"><?php echo get_comment_author_link(); ?></h4>
            <div class="comment-meta">
                <span class="post-date"><?php echo get_comment_date('F j, Y'); ?></span>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="comment-awaiting-moderation">
                    <em><?php _e('Your comment is awaiting moderation.'); ?></em>
                </div>
            <?php endif; ?>
            <div class="comment-text">
                <?php comment_text(); ?>
            </div>
            <?php 
            if (comments_open() && $depth < $args['max_depth']) {
                comment_reply_link(array_merge($args, [
                    'add_below'  => 'comment',
                    'depth'      => $depth,
                    'max_depth'  => $args['max_depth'],
                    'before'     => '<div class="comment-reply-btn">',
                    'after'      => '</div>',
                    'reply_text' => __('Reply'),
                    'class'      => 'item-btn'
                ])); 
            }
            ?>
        </div>
    </li>
    <?php
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
 <!-- Breadcrumb banner (BlogXpress style) -->
 <section class="breadcrumb-wrap-layout1">
             <div class="container">
                 <div class="breadcrumb-layout1">
                     <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                             <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                             <?php 
                             $cat = get_the_category();
                             if (!empty($cat)) {
                                 $primary = $cat[0];
                                 echo '<li><a href="' . esc_url(get_category_link($primary->term_id)) . '">' . esc_html($primary->name) . '</a></li>';
                             }
                             ?>
                             <li class="active" aria-current="page"><?php echo esc_html(get_the_title()); ?></li>
                         </ol>
                     </nav>
                 </div>
             </div>
</section>
<style>
/* ========== ORIGINAL TEMPLATE STYLES (Keep These) ========== */
:root{
  --bg:#fff; --text:#111; --muted:#5a6575; --soft:#f4f6f8; --soft2:#eef1f4;
  --brand:#76A379; --brand-600:#618E67; --accent:#76A379; --green:#76A379;
  --font-main:'Poppins', sans-serif; --font-secondary:'Poppins', sans-serif;
  --sage-light:#B2C7B3; --sage-muted:rgba(118, 163, 121, 0.12);

  /* BlogXpress Variables for consistency */
  --color-body: #494e51; --color-dark-1: #2E2E2E; --color-border-dark-1: #303030;
  --color-light-1: #ffffff; --color-light-2: #F5F5F5; --color-mimosa: #EAF2EB;
  --color-perano: #DCE9DD; --color-primary: #76A379; --color-btn-bg: #76A379;
  --color-heading-1: #B2C7B3; --color-meta-dark-1: #6b7074; --color-scandal: #DDEADF;
  --color-selago: #F1D1FC; --color-old-lace: #FDEDDD;
  --transition: all 0.3s ease-in-out;
  --shadow: 0 10px 28px rgba(16,24,40,.08);
  --line: #303030;
}

body {
    color: var(--color-body);
    font-family: var(--font-main);
}

header {
    position: sticky !important;
}

h1, h2, h3, h4 {
    font-weight: 600;
    color: #000;
    line-height: 1.3;
    font-family: var(--font-main);
}

.breadcrumb-wrap-layout1,
.sblog-post-container,
.sblog-outer-section {
    font-family: var(--font-main);
}

/* Grid layout */
.sblog-post-container{max-width:1320px;margin:56px auto 32px auto;padding:0 20px;display:grid;gap:48px;grid-template-columns:60px minmax(0, 1fr) 320px}

/* Left action bar - DESKTOP DEFAULT */
.sblog-actions{position:sticky; top:180px; width:40px; height:317px; display:grid; grid-template-rows:repeat(6,40px); row-gap:20px; justify-items:center; align-items:center;}
.sblog-actions button{width:40px;height:40px;border-radius:12px;border:none;cursor:pointer; background:#f0f2f5;color:#444;font-size:18px; display:flex;align-items:center;justify-content:center; transition:background .2s,transform .05s,color .2s; box-shadow: rgba(0, 0, 0, 0.12) 0px 0px 2px 0px, rgba(0, 0, 0, 0.14) 0px 2px 4px 0px; position: relative;}
.sblog-actions button:hover{background:var(--soft2); border-radius:5px;}
.sblog-actions button:active{transform:scale(.98)}
.sblog-actions .sblog-count{position:absolute;top:-6px;right:-6px;min-width:18px;height:18px;padding:0 5px;border-radius:999px;background:var(--brand);color:#fff;font:700 11px/18px var(--font-main);text-align:center}
button.sblog-voted{background:var(--sage-muted) !important;color:var(--brand-600)}
.sblog-actions .sblog-saved{background:var(--sage-muted);color:var(--brand-600)}

/* RESPONSIVE BREAKPOINTS */
@media (max-width:1024px){
  .sblog-post-container{grid-template-columns:1fr; gap:24px; padding:0 16px; margin-top:36px;}
  .sblog-right{display:none}
}

/* Tablet Responsive (769px - 1024px) */
@media (max-width:1024px) and (min-width:769px){
  .sblog-actions{position:relative;top:0;width:100%;height:auto;row-gap:0;display:flex;align-items:center;justify-content:center;gap:14px;margin-bottom:8px;}
  .sblog-actions button{width:44px;height:44px;font-size:18px;}
  .sblog-actions .sblog-count{top:-8px;right:-8px;min-width:20px;height:20px;font-size:12px;line-height:20px;}
}

/* Mobile Responsive (max-width: 768px) */
@media (max-width:768px){
  .sblog-post-container{grid-template-columns:1fr !important;gap:0; margin-top: 40px;}
  .sblog-actions {
    position: fixed !important;
    bottom: 12px !important;
    left: 0 !important;
    right: 0 !important;
    top: auto !important;
    height: 64px !important;
    width: calc(100% - 32px) !important;
    background: #fff;
    border: 2px solid var(--line);
    display: flex !important;
    flex-direction: row !important;
    justify-content: space-around;
    align-items: center;
    z-index: 999;
    padding: 8px 10px;
    box-shadow: 0 -4px 12px rgba(0,0,0,0.08);
    grid-template-rows: none !important;
    row-gap: 0 !important;
    margin: 0 auto;
    border-radius: 50px;
}
  .sblog-actions button{
    width:40px !important;
    height:40px !important;
    font-size:20px;
    border-radius:50% !important;
    flex-shrink:0;
  }
  .sblog-actions button:hover{
    background:#e0e4e8;
    transform:scale(1.05);
  }
  .sblog-actions .sblog-count{
    top:-4px;
    right:-4px;
    min-width:20px;
    height:20px;
    font-size:11px;
    line-height:20px;
  }
  .sblog-article{padding-bottom:100px}
}

/* Small Mobile (max-width: 480px) */
@media (max-width:480px){
  .sblog-actions{
    height:65px !important;
    padding:6px 8px;
  }
  .sblog-actions button{
    width:45px !important;
    height:45px !important;
    font-size:18px;
  }
  .sblog-actions .sblog-count{
    min-width:18px;
    height:18px;
    font-size:10px;
    line-height:18px;
    top:-3px;
    right:-3px;
  }
}

/* Article */
.sblog-article{max-width: 90ch}
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
.sblog-content ul,.sblog-content ol{padding-left:   1.2em;margin:0 0 1.1em}
.sblog-content blockquote{margin:1.4em 0;padding:14px 18px;border-left:4px solid var(--brand);background:var(--soft);border-radius:10px;color:#333}

/* Gutenberg blocks and widget-like content (BlogXpress look) */
.sblog-content h2{font-family:var(--font-secondary, inherit);font-weight:600;font-size:2rem;line-height:1.35;margin:1.2em 0 .6em;color:#74AB77;}
.sblog-content h3{font-family:var(--font-secondary, inherit);font-weight:600;font-size:1.4rem;line-height:1.45;margin:1.1em 0 .6em;color:#74AB77;}
.sblog-content h4{font-family:var(--font-secondary, inherit);font-weight:600;font-size:1.15rem;margin:1em 0 .5em;color:#000}
.sblog-content a{color:var(--brand);text-decoration:none}
.sblog-content a:hover{color:var(--color-primary)}

/* Lists – styled bullets like BlogXpress */
.sblog-content .list-style-1{list-style:none;padding:0;margin:0 0 25px}
.sblog-content .list-style-1 li{position:relative;padding-left:24px;margin:0 0 10px}
.sblog-content .list-style-1 li:before{content:"";position:absolute;left:0;top:.6em;width:8px;height:8px;border-radius:50%;background:var(--color-body)}

/* Blockquote (accent bar + subtle quote) */
.sblog-content blockquote{position:relative;background:var(--color-old-lace);border-left:5px solid var(--color-perano);border-radius:8px;padding:28px 24px;margin:22px 0;color:var(--color-body)}
.sblog-content blockquote p{font-style:italic;margin:0 0 .6em}
.sblog-content blockquote cite{display:block;opacity:.85;font-size:.95em}

/* Images / figures */
.sblog-content figure{margin:0 0 18px}
.sblog-content figure img{border-radius:8px;display:block;width:100%;height:auto}
.sblog-content .figure-caption, .sblog-content figcaption{margin-top:8px;color:var(--color-body);font-size:.95rem;text-align:center}

/* WP Columns */
.sblog-content .wp-block-columns{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin:18px 0}
@media(max-width:768px){.sblog-content .wp-block-columns{grid-template-columns:1fr}}

/* Galleries */
.sblog-content .wp-block-gallery, .sblog-content .blocks-gallery-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
@media(max-width:640px){.sblog-content .wp-block-gallery, .sblog-content .blocks-gallery-grid{grid-template-columns:1fr}}
.sblog-content .blocks-gallery-item img{border-radius:8px}

/* Buttons */
.sblog-content .wp-block-button .wp-block-button__link{background:var(--color-btn-bg);border:1px solid var(--color-border-dark-1);color:#000;border-radius:8px;padding:10px 18px;font-weight:600}
.sblog-content .wp-block-button .wp-block-button__link:hover{background:transparent;transform:translate(-3px,-3px);box-shadow:3px 3px 0 0 var(--color-border-dark-1)}

/* Tables */
.sblog-content table{width:100%;border-collapse:collapse;margin:16px 0;border:1px solid var(--color-border-dark-1);display:block;overflow-x:auto;white-space:nowrap}
.sblog-content th,.sblog-content td{border:1px solid var(--color-border-dark-1);padding:10px}
.sblog-content th{background:var(--color-light-2);text-align:left}

/* Separators */
.sblog-content .wp-block-separator{border:none;height:1px;background:var(--color-border-dark-1);margin:28px 0;opacity:.6}

/* Triangular list bullets for any UL inside content */
.sblog-content ul{list-style:none;padding-left:24px}
.sblog-content ul li{position:relative;padding-left:14px}
.sblog-content ul li::before{content:"";position:absolute;left:0;top:.7em;width:0;height:0;border-left:7px solid var(--color-body);border-top:5px solid transparent;border-bottom:5px solid transparent}

/* Figure/image card style like reference */
.sblog-content .box-border-dark-1{border:1px solid var(--color-border-dark-1);border-radius:8px}
.sblog-content .figure-holder{border-radius:6px;overflow:hidden}
.sblog-content .figure-holder img{border-radius:6px;display:block;width:100%;height:auto}

/* Breadcrumb banner */
.breadcrumb-wrap-layout1{padding:10px 0;background:linear-gradient(180deg, rgba(118,163,121,0.16) 0%, rgba(118,163,121,0.10) 100%);border-bottom:1px solid rgba(97,142,103,0.35);position:sticky;z-index:1;top:80px}
.breadcrumb-layout1 .breadcrumb{display:flex;gap:8px;list-style:none;margin:0;padding:0;color:var(--brand-600);flex-wrap:wrap;justify-content: center;}
.breadcrumb-layout1 .breadcrumb li{display:flex;align-items:center;gap:8px}
.breadcrumb-layout1 .breadcrumb li+li:before{content:"/";color:var(--brand-600);opacity:.65}
.breadcrumb-layout1 .breadcrumb a{color:var(--brand-600);text-decoration:none;font-weight:500}
.breadcrumb-layout1 .breadcrumb a:hover{color:var(--brand)}
.breadcrumb-layout1 .breadcrumb .active{color:#253830;font-weight:600;word-break:break-word}

/* Right promo card */
.sblog-right{position:sticky;top:180px;align-self:start;height:fit-content}
.sblog-promo{position:relative}
.sblog-promo-card{border-radius:16px;border:1px solid var(--line);overflow:hidden;background:#fff;box-shadow:var(--shadow)}
.sblog-promo-top{background:linear-gradient(145deg,#618E67,#253830);color:#fff;padding:16px 16px 14px}
.sblog-promo-figure{width:56px;height:56px;border-radius:12px;overflow:hidden;box-shadow:0 8px 18px rgba(0,0,0,.25);float:left;margin-right:12px}
.sblog-promo-figure img{width:100%;height:100%;object-fit:cover}
.sblog-promo-mini{opacity:.85;margin:0;font-size:.9rem}
.sblog-promo-title{font-size:1.5rem;line-height:1.25;margin:.35rem 0 0;font-weight:800; color: #fff;}
.sblog-promo-body{padding:16px}
.sblog-promo-features{display:grid;grid-template-columns:1fr 1fr;gap:10px 16px;margin:6px 0 14px}
.sblog-promo-features .sblog-feat{display:flex;align-items:center;gap:10px;color:#2a2f3a}
.sblog-promo-features .sblog-dot{width:20px;height:20px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;background:var(--sage-muted);color:var(--brand);flex:0 0 20px}
.sblog-promo-cta{display:block;text-align:center;border:2px solid var(--brand);color:var(--brand);font-weight:800;border-radius:10px;padding:12px 16px;margin-top:10px;transition:background .2s,color .2s;text-decoration: none;}
.sblog-promo-cta:hover{background:var(--brand);color:#fff}

/* Comments panel */
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

/* ========== NEW PIXEL-PERFECT STYLES (Add/Replace These) ========== */

/* Author Box (Replaces .sblog-author-box) */
.author-wrap { margin: 90px 0 40px; padding: 95px 30px 30px; border-radius: 8px; text-align: center; position: relative; background-color: var(--color-mimosa); }
.author-wrap .author-thumb { max-width: 120px; width: 100%; margin: 0 auto; position: absolute; top: -60px; left: 0; right: 0; border: 1px solid var(--color-border-dark-1); border-radius: 50%; }
.author-wrap .author-thumb img { border-radius: 50%; width: 100%; height: auto; display: block; }
.author-wrap .author-content .entry-title { margin: 0 0 5px; font-size: 20px; }
.author-wrap .author-content .author-designation { margin-bottom: 15px; font-size: 16px; font-weight: 500; color: #000; }
.author-wrap .author-content .entry-description { max-width: 480px; margin: 0 auto 20px; font-size: 1rem; color: var(--color-body); }
.author-wrap .author-content .axil-social ul { list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; gap: 12px; }
.author-wrap .author-content .axil-social ul li a { display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 50%; border: 1px solid var(--color-border-dark-1); color: var(--color-meta-dark-1); font-size: 14px; text-decoration: none; transition: var(--transition); }
.author-wrap .author-content .axil-social ul li a:hover { background-color: var(--color-primary); border-color: var(--color-primary); color: var(--color-light-1); }
@media (max-width: 1024px) {
  .author-wrap { margin: 60px 0 30px; padding: 80px 24px 24px; }
}
@media (max-width: 768px) {
  .author-wrap { margin: 48px 0 24px; padding: 72px 18px 20px; }
  .author-wrap .author-thumb { max-width: 100px; top: -50px; }
}

/* Post Navigation */
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
    .post-navigation .post-box.prev-post,
    .post-navigation .post-box.next-post { padding: 0; flex-direction: column; }
}

/* Comments - Simple Clean Design */
.post-comment { margin: 40px 0; }
.post-comment .section-heading h3 { font-size: 1.75rem; margin: 0 0 30px; font-weight: 700; }
.post-comment .comment-list { list-style: none; padding: 0; margin: 0; }
/* Initially show only the first 3 top-level comments; JS reveals the rest */
#comment-list > li:nth-child(n+4) { display: none; }
.post-comment .comment-wrapper { list-style: none; }
.post-comment .each-comment { display: flex; gap: 20px; background: #fff;  position: relative; margin: 0 0 20px; }
.post-comment .comment-figure { flex-shrink: 0; }
.post-comment .comment-figure img { border-radius: 50%; width: 60px; height: 60px; object-fit: cover; }
.post-comment .comment-content { flex: 1; min-width: 0; }
.post-comment .comment-title { margin: 0 0 8px; font-size: 20px; font-weight: 700; color: #2E2E2E; }
.post-comment .comment-title a { color: #2E2E2E; text-decoration: none; }
.post-comment .comment-meta { margin-bottom: 15px; font-size: 16px; color: #6b7074; }
.post-comment .comment-text { color: #494e51; font-size: 1rem; line-height: 1.7; margin-bottom: 0; }
.post-comment .comment-text p { margin: 0 0 10px; }
.post-comment .comment-text p:last-child { margin-bottom: 0; }
.post-comment .comment-awaiting-moderation { margin-bottom: 10px; padding: 8px 12px; background-color: #fff3cd; border-left: 3px solid #ffc107; border-radius: 4px; }
.post-comment .comment-awaiting-moderation em { font-style: normal; color: #856404; font-size: 14px; }
.post-comment .comment-reply-btn { position: absolute; top: 30px; right: 30px; }
.post-comment .item-btn { background-color: transparent; color: #6b7074; padding: 6px 20px; border-radius: 4px; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.2s; border: none; cursor: pointer; display: inline-block; }
.post-comment .item-btn:hover { color: var(--brand); }
.post-comment .children { padding-left: 30px; list-style: none; margin-top: 20px; }
.post-comment .no-comments { text-align: center; padding: 40px 20px; color: var(--color-meta-dark-1); font-size: 1.1rem; background-color: var(--color-light-2); border-radius: 8px; margin: 20px 0; }
.post-comment .pending-comments-notice { text-align: center; padding: 30px 20px; background-color: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; margin: 20px 0; }
.post-comment .pending-comments-notice p { margin: 0 0 10px; color: #856404; }
.post-comment .pending-comments-notice p:last-child { margin-bottom: 0; }
.post-comment .pending-comments-notice .approve-link { color: var(--brand); text-decoration: none; font-weight: 600; }
.post-comment .pending-comments-notice .approve-link:hover { text-decoration: underline; }

/* Load More Comments Button - Clean Design */
.load-more-comments-wrapper { text-align: center; margin: 30px 0; position: relative; }
.load-more-comments-wrapper::before { content: ""; position: absolute; top: -50px; left: 0; right: 0; height: 100px; background: linear-gradient(to bottom, transparent 0%, rgba(255,255,255,0.98) 50%, rgba(255,255,255,1) 100%); pointer-events: none; z-index: 1; }
.load-more-btn { background-color: var(--brand); color: #fff; border: 2px solid var(--brand-600); padding: 12px 30px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; position: relative; z-index: 2; }
.load-more-btn:hover { background-color: var(--brand-600); border-color: var(--brand-600); transform: translateY(-2px); }
.load-more-btn .load-more-count { color: rgba(255,255,255,0.8); font-size: 14px; }

/* Fade-in animation for comments */
.comment-wrapper { opacity: 1; animation: fadeIn 0.5s ease-in; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

/* Inline Reply Form - Clean Design */
.comment-reply-form { margin-top: 20px; padding: 20px; background-color: #f9f9f9; border: 2px solid #303030; border-radius: 12px; }
.comment-reply-form .comment-reply-title { font-size: 16px; font-weight: 600; margin: 0 0 15px; display: flex; justify-content: space-between; align-items: center; color: #2E2E2E; }
.comment-reply-form .cancel-reply { color: var(--brand); text-decoration: none; font-size: 14px; font-weight: 500; }
.comment-reply-form .cancel-reply:hover { text-decoration: underline; }
.comment-reply-form textarea { width: 100%; border: 2px solid #e0e0e0; border-radius: 8px; padding: 15px; font-family: inherit; font-size: 15px; min-height: 100px; background-color: #fff; color: #2E2E2E; resize: vertical; }
.comment-reply-form textarea:focus { outline: none; border-color: var(--brand); }
.comment-reply-form .form-submit { margin: 15px 0 0; text-align: right; }
.comment-reply-form input[type="submit"] { background-color: var(--brand); color: #fff; border: 2px solid var(--brand-600); padding: 10px 30px; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
.comment-reply-form input[type="submit"]:hover { background-color: var(--brand-600); border-color: var(--brand-600); }
.main-comment-form { border: 2px solid #303030; border-radius: 16px; padding: 20px; background: #fff; }
.main-comment-form .input-clean, .main-comment-form .textarea-clean { width: 100%; border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px 14px; font-size: 16px; background: #fff; color: #2E2E2E; }
.main-comment-form .input-clean:focus, .main-comment-form .textarea-clean:focus { outline: none; border-color: var(--brand); }
.main-comment-form .textarea-clean { min-height: 140px; resize: vertical; }
.main-comment-form .clean-submit { background: var(--brand); color: #fff; border: 2px solid var(--brand-600); border-radius: 10px; padding: 12px 24px; font-weight: 700; }
.main-comment-form .clean-submit:hover { background: var(--brand-600); border-color: var(--brand-600); }
.post-comment .comment-navigation { margin: 30px 0; padding: 20px 0; text-align: center; border-top: 1px solid var(--line); }
.post-comment .comment-navigation .nav-links { display: flex; justify-content: center; gap: 20px; }
.post-comment .comment-navigation a { color: #000; text-decoration: none; padding: 10px 20px; background-color: var(--color-light-2); border-radius: 4px; transition: var(--transition); }
.post-comment .comment-navigation a:hover { background-color: var(--color-primary); color: var(--color-light-1); }
@media (max-width: 768px) {
    .post-comment .each-comment { padding: 20px; gap: 15px; }
    .post-comment .comment-figure img { width: 80px; height: 80px; }
    .post-comment .comment-reply-btn { top: 20px; right: 20px; }
    .load-more-btn { padding: 10px 20px; font-size: 14px; }
}
@media (max-width: 575px) {
    .post-comment .each-comment { flex-direction: column; align-items: flex-start; text-align: left; padding: 20px; }
    .post-comment .comment-figure { width: 100%; display: flex; justify-content: center; margin-bottom: 15px; }
    .post-comment .comment-figure img { width: 80px; height: 80px; }
    .post-comment .comment-content { width: 100%; }
    .post-comment .comment-reply-btn { position: static; margin-top: 15px; text-align: center; }
    .post-comment .item-btn { display: inline-block; }
    .post-comment .children { padding-left: 0; margin-top: 15px; }
    .load-more-comments-wrapper::before { height: 80px; top: -40px; }
    .load-more-btn { flex-direction: column; gap: 4px; font-size: 14px; padding: 12px 25px; }
    .comment-reply-form { padding: 15px; }
    .comment-reply-form .comment-reply-title { flex-direction: column; align-items: flex-start; gap: 10px; }
    .comment-reply-form textarea { min-height: 80px; font-size: 14px; padding: 12px; }
    .comment-reply-form input[type="submit"] { width: 100%; }
}

/* Comment Form */
.leave-comment { margin: 40px 0; }
.leave-comment .section-heading h3 { font-size: 1.75rem; margin: 0 0 8px; }
.leave-comment > p { font-size: 15px; color: var(--color-meta-dark-1); margin-bottom: 24px; }
.leave-comment .leave-form-box .row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.leave-comment .form-group { margin-bottom: 12px; }
.leave-comment .form-control { width: 100%; height: 50px; padding: 10px 20px; border: 1px solid var(--color-border-dark-1); border-radius: 8px; background-color: var(--color-light-2); color: #000; transition: var(--transition); }
.leave-comment .form-control:focus { outline: none; border-color: var(--brand); background-color: var(--color-light-1); }
.leave-comment textarea.form-control { height: 180px; padding-top: 15px; }
.leave-comment .show-message-label { display: flex; align-items: center; color: var(--color-meta-dark-1); font-size: 15px; cursor: pointer; }
.leave-comment input[type=checkbox] { margin-right: 8px; }
.leave-comment .axil-btn { min-height: 50px; padding: 5px 30px; border: 1px solid var(--brand-600); border-radius: 8px; background-color: var(--color-btn-bg); color: #fff; font-size: 16px; font-weight: 500; cursor: pointer; transition: var(--transition); display: inline-flex; align-items: center; justify-content: center; }
.leave-comment .axil-btn:hover { background-color: var(--brand-600); transform: translateX(-3px) translateY(-3px); box-shadow: 3px 3px 0px 0px rgba(97, 142, 103, 0.25); }
@media (max-width: 600px) { .leave-comment .leave-form-box .row { grid-template-columns: 1fr; } }

/* Sections outside main column */
.sblog-outer-section { max-width: 1320px; margin: 48px auto; padding: 0 20px; }

/* Related Articles (Replaces .sblog-section) */
.sblog-related-section .section-heading { margin-bottom: 28px; display: flex; align-items: baseline; justify-content: space-between; gap: 14px; }
.sblog-related-section .section-heading .title { position: relative; z-index: 1; display: inline-block; margin-bottom: 0; font-size: clamp(1.45rem, 2.3vw, 2rem); line-height: 1.2; font-weight: 700; color: var(--color-dark-1); font-family: var(--font-secondary); }
.sblog-related-section .section-heading .title::before { content: ""; width: 100%; position: absolute; z-index: -1; bottom: 1px; left: 0; background-color: var(--sage-muted); height: 12px; border-radius: 12px; }
.sblog-related-section .position-relative { position: relative; padding-inline: clamp(40px, 5vw, 60px); }
.sblog-related-section .post-slider .slick-slide { padding: 0 12px 8px; }
.sblog-related-section .post-slider .post-box { border: 1px solid rgba(97, 142, 103, 0.28); border-radius: 12px; padding: 16px; transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease; }
.sblog-related-section .post-slider .post-box:hover { transform: translateY(-4px); border-color: var(--brand-600); box-shadow: 0 10px 20px rgba(37, 56, 48, 0.08); }
.sblog-related-section .post-box.bg-color-scandal { background-color: var(--color-scandal); }
.sblog-related-section .post-box.bg-color-selago { background-color: var(--color-perano); }
.sblog-related-section .post-box.bg-color-old-lace { background-color: var(--color-old-lace); }
.sblog-related-section .post-box .figure-holder { margin-bottom: 12px; border-radius: 10px; overflow: hidden; }
.sblog-related-section .post-box .figure-holder img { border-radius: 10px; width: 100%; height: auto; object-fit: cover; transition: transform 0.28s ease; }
.sblog-related-section .post-slider .post-box:hover .figure-holder img { transform: scale(1.03); }
.sblog-related-section .post-box .entry-category { margin-bottom: 8px; }
.sblog-related-section .post-box .entry-category ul { list-style: none; padding: 0; margin: 0; }
.sblog-related-section .post-box .entry-category ul li a { font-size: 12px; font-weight: 600; display: inline-block; padding: 3px 10px; border: 1px solid rgba(97, 142, 103, 0.45); border-radius: 27px; color: var(--brand-600); background-color: var(--sage-muted); text-decoration: none; transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease; }
.sblog-related-section .post-box .entry-category ul li a:hover { background-color: var(--brand); border-color: var(--brand); color: #fff; }
.sblog-related-section .post-box .entry-title { margin-bottom: 10px; font-size: 1.12rem; line-height: 1.4; font-weight: 600; }
.sblog-related-section .post-box .entry-title a { color: var(--color-dark-1); text-decoration: none; transition: color 0.2s ease; }
.sblog-related-section .post-box .entry-title a:hover { color: var(--brand); }
.sblog-related-section .post-box .entry-meta { list-style: none; padding: 0; margin: 0; display: flex; align-items: center; flex-wrap: wrap; gap: 12px; font-size: 13px; color: var(--color-meta-dark-1); }
.sblog-related-section .post-box .entry-meta li { display: flex; align-items: center; gap: 6px; }
.sblog-related-section .post-box .entry-meta li img { border-radius: 50%; width: 28px; height: 28px; }
.sblog-related-section .post-box .entry-meta a { color: inherit; text-decoration: none; transition: color 0.2s ease; }
.sblog-related-section .post-box .entry-meta a:hover { color: var(--brand-600); }
.sblog-related-section .post-box .entry-meta i { color: var(--brand-600); font-size: 0.85rem; }
.sblog-related-section .slider-navigation { list-style: none; padding: 0; margin: 0; position: absolute; top: 50%; transform: translateY(-50%); width: 100%; pointer-events: none; z-index: 2; }
.sblog-related-section .slider-navigation li { position: absolute; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 19px; border: 1px solid rgba(97, 142, 103, 0.45); background-color: var(--color-light-1); color: var(--brand-600); transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease; pointer-events: all; }
.sblog-related-section .slider-navigation li.prev { left: 0; }
.sblog-related-section .slider-navigation li.next { right: 0; }
.sblog-related-section .slider-navigation li:hover,
.sblog-related-section .slider-navigation li:focus-visible { background-color: var(--brand); border-color: var(--brand); color: #fff; transform: translateY(-2px); outline: none; }
.sblog-related-section .slider-navigation li.slick-disabled { opacity: 0.35; pointer-events: none; transform: none; }
@media(max-width: 1300px) {
    .sblog-related-section .position-relative { padding-inline: 36px; }
}
@media (max-width: 992px) {
    .sblog-related-section .post-slider .slick-slide { padding: 0 10px 8px; }
    .sblog-related-section .post-box .entry-title { font-size: 1.05rem; }
}
@media (max-width: 768px) {
    .sblog-related-section .position-relative { padding-inline: 0; }
    .sblog-related-section .post-slider .slick-slide { padding: 0 8px 8px; }
    .sblog-related-section .slider-navigation li.prev { left: -2px; }
    .sblog-related-section .slider-navigation li.next { right: -2px; }
}
@media (max-width: 575px) {
    .sblog-related-section .section-heading { margin-bottom: 20px; }
    .sblog-related-section .post-slider .post-box { padding: 14px; border-radius: 10px; }
    .sblog-related-section .post-box .entry-title { font-size: 1rem; line-height: 1.35; }
    .sblog-related-section .post-box .entry-meta { gap: 10px; font-size: 12px; }
    .sblog-related-section .slider-navigation li { width: 40px; height: 40px; font-size: 16px; }
}

/* Newsletter (Replaces .sblog-cta) */
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
@media (max-width: 575px) {
    .breadcrumb-layout1 .breadcrumb { font-size: 0.85rem; gap: 6px; }
}

/* FAQ Section Styles */
.faq-section { margin: 60px 0; background: #fff; border-radius: 12px;  }
.faq-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 30px;
    color: #333;
    font-size: 1.8rem;
    font-weight: 700;
    align-content: center;
    justify-content: center;
}
.faq-title svg { color: var(--brand); flex-shrink: 0; }
.faq-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 10px 40px 60px 40px;
}
.faq-item { border: 1px solid #eee; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; }
.faq-item.active { border-color: var(--brand); box-shadow: 0 2px 12px rgba(118,163,121,0.25); }
.faq-question { padding: 20px 24px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; background: #fff; transition: background-color 0.3s ease; }
.faq-question:hover { background-color: #f8f9fa; }
.faq-question-content { display: flex; align-items: center; gap: 12px; flex: 1; }
.faq-number { color: var(--brand); font-weight: 700; font-size: 1.1rem; flex-shrink: 0; }
.faq-question h3 { margin: 0; font-size: 1.05rem; font-weight: 600; color: #333; line-height: 1.5; }
.faq-toggle { display: flex; align-items: center; justify-content: center; color: var(--brand); flex-shrink: 0; }
.faq-toggle svg { transition: transform 0.3s ease; }
.faq-answer { max-height: 0; opacity: 0; overflow: hidden; transition: all 0.3s ease-in-out; }
.faq-answer-content { padding: 0 24px 20px 48px; color: #666; line-height: 1.7; }
.faq-answer-content p { margin: 0 0 10px; }
.faq-answer-content p:last-child { margin-bottom: 0; }
.faq-item.active .faq-answer { opacity: 1; }

@media (max-width: 768px) {
    .faq-section { margin: 40px 0; padding: 30px 20px; }
    .faq-title { font-size: 1.5rem; gap: 10px; }
    .faq-question { padding: 18px 20px; }
    .faq-number { font-size: 1rem; }
    .faq-question h3 { font-size: 0.95rem; }
    .faq-answer-content { padding: 0 20px 18px 40px; font-size: 0.95rem; }
}

@media (max-width: 575px) {
    .faq-section { margin: 30px 0; padding: 25px 15px; border-radius: 8px; }
    .faq-title { font-size: 1.3rem; gap: 8px; }
    .faq-question { padding: 16px 18px; flex-wrap: wrap; }
    .faq-question-content { gap: 8px; }
    .faq-number { font-size: 0.9rem; }
    .faq-question h3 { font-size: 0.9rem; }
    .faq-toggle svg { width: 18px; height: 18px; }
    .faq-answer-content { padding: 0 18px 16px 18px; font-size: 0.9rem; }
}

/* Final visual alignment refinement */
.sblog-article {
    margin: 0 auto;
}

.sblog-title {
    font-size: clamp(1.8rem, 3.2vw, 2.45rem);
    line-height: 1.3;
    margin-bottom: 16px;
    color: #74AB77;
}

.sblog-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    font-size: 0.98rem;
    line-height: 1.6;
}

.sblog-content {
    font-size: 1.06rem;
    line-height: 1.8;
}

.sblog-content h2 {
    font-size: clamp(1.45rem, 2.1vw, 2rem);
    margin-top: 1.55em;
}

.sblog-content h3 {
    font-size: clamp(1.2rem, 1.7vw, 1.5rem);
}

.sblog-content p,
.sblog-content li,
.faq-answer-content,
.author-wrap .author-content .entry-description {
    line-height: 1.75;
}

.post-comment .section-heading h3,
.leave-comment .section-heading h3 {
    font-size: clamp(1.35rem, 2.2vw, 1.75rem);
}

.post-comment .each-comment {
    align-items: flex-start;
    padding: 20px 0;
    border-bottom: 1px solid #eceef1;
}

.post-comment .comment-title {
    font-size: 1.1rem;
    line-height: 1.35;
}

.post-comment .comment-meta {
    font-size: 0.92rem;
    line-height: 1.5;
    margin-bottom: 10px;
}

@media (max-width: 1024px) {
    .sblog-post-container {
        gap: 24px;
        padding: 0 16px;
    }

    .sblog-content {
        font-size: 1.02rem;
    }
}

@media (max-width: 768px) {
    .sblog-title {
        text-align: left;
    }

    .sblog-meta {
        font-size: 0.92rem;
        gap: 6px;
    }

    .sblog-content {
        font-size: 1rem;
        line-height: 1.7;
    }

    .faq-container {
        padding: 10px 16px 28px;
    }

    .breadcrumb-wrap-layout1 {
        top: 64px;
        padding: 8px 0;
    }

    .sblog-outer-section {
        margin: 36px auto;
        padding: 0 16px;
    }

    .post-navigation .post-box .figure-holder {
        width: 72px;
        height: 72px;
    }

    .sblog-panel {
        max-width: 100%;
        right: -100%;
    }

    .sblog-toast {
        right: 12px;
        left: 12px;
        bottom: 86px;
        text-align: center;
    }
}

</style>

<?php if (have_posts()) : while (have_posts()) : the_post();
    $post_id  = get_the_ID();
    $likes    = (int) get_post_meta($post_id, '_sblog_like_count', true);
    $dislikes = (int) get_post_meta($post_id, '_sblog_dislike_count', true);
    $saved = false;
    if (is_user_logged_in()) {
        $saved_posts = get_user_meta(get_current_user_id(), '_sblog_saved_posts', true);
        $saved = is_array($saved_posts) && in_array($post_id, $saved_posts, true);
    }
    $nonce     = wp_create_nonce('sblog_nonce');
    $ajax_url  = admin_url('admin-ajax.php');
    $author_id = get_the_author_meta('ID');
    $time_ago  = human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
?>
<div class="sblog-post-container">
    <!-- Left actions -->
    <aside class="sblog-actions" aria-label="Quick actions">
        <button id="listenBtn" title="Read this page"><i class="fa-solid fa-headphones"></i></button>
        <button id="likeBtn" title="Like this post"><i class="fa-regular fa-thumbs-up"></i></button>
        <button id="dislikeBtn" title="Dislike this post"><i class="fa-regular fa-thumbs-down"></i></button>
        <!-- <button id="commentsBtn" title="Comments">
            <i class="fa-regular fa-comment"></i>
            <?php if (($cc = get_comments_number()) > 0) : ?><span class="sblog-count"><?php echo (int) $cc; ?></span><?php endif; ?>
        </button> -->
        <button id="shareBtn" title="Share"><i class="fa-solid fa-share-nodes"></i></button>
        <!-- <button id="saveBtn" class="<?php echo $saved ? 'sblog-saved' : ''; ?>" title="<?php echo $saved ? 'Saved' : 'Save for later'; ?>"><i class="fa-regular fa-bookmark"></i></button> -->
    </aside>

    <!-- Main article -->
    <article class="sblog-article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="sblog-title"><?php the_title(); ?></h1>
        <div class="sblog-meta">
            <span class="sblog-author">Story by <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php the_author(); ?></a></span>
            <span class="sblog-sep">•</span><span><?php echo esc_html($time_ago); ?></span>
            <span class="sblog-sep">•</span><span class="sblog-read"><span class="sblog-dot"></span><?php echo sblog_read_time(get_the_content()); ?></span>
        </div>
        <div class="sblog-divider"></div>
        <?php if (has_post_thumbnail()) : ?>
            <figure class="sblog-hero">
                <?php the_post_thumbnail('large'); ?>
                <?php if ($cap = get_the_post_thumbnail_caption()): ?>
                <figcaption class="sblog-fig-strip">
                    <span class="sblog-bullet"></span>
                    <span><?php echo esc_html($cap); ?></span>
                </figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>
        <div class="sblog-content"><?php the_content(); ?></div>

        <?php
        // Get FAQs from post meta (using existing implementation)
        $faq_data = get_post_meta(get_the_ID(), '_blog_faq_data', true);
        if (!empty($faq_data) && is_array($faq_data)) :
        ?>
        <!-- FAQ Section -->
        <div class="faq-section">
            <h2 class="faq-title">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                </svg>
                Frequently Asked Questions
            </h2>
            
            <div class="faq-container">
                <?php foreach ($faq_data as $index => $faq) : ?>
                    <div class="faq-item" data-faq="<?php echo $index; ?>">
                        <div class="faq-question" onclick="toggleFaq(<?php echo $index; ?>)">
                            <div class="faq-question-content">
                                <span class="faq-number"><?php echo ($index + 1); ?>.</span>
                                <h3><?php echo esc_html($faq['question']); ?></h3>
                            </div>
                            <span class="faq-toggle">
                                <svg class="faq-icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                                <svg class="faq-icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                                    <path d="M19 13H5v-2h14v2z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p><?php echo nl2br(esc_html($faq['answer'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- NEW SECTIONS INSERTED HERE -->
        <!-- Author Box -->
        <div class="author-wrap">
            <div class="author-thumb"><?php echo get_avatar($author_id, 120); ?></div>
            <div class="author-content">
                <h4 class="entry-title"><?php the_author(); ?></h4>
                <div class="author-designation">Lead Designer</div>
                <p class="entry-description">While the law might seem obvious, designers often engage in creative work where they try to reinvent the wheel for the sake of novelty.</p>
                <div class="axil-social">
                    <ul>
                        <li><a aria-label="Pinterest" href="#"><i class="fab fa-pinterest-p"></i></a></li>
                        <li><a aria-label="Instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a aria-label="Twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a aria-label="Mail" href="#"><i class="fas fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Post Navigation -->
        <div class="post-navigation">
            <div class="post-box prev-post">
                <?php if ($prev_post = get_previous_post()) : ?>
                    <div class="figure-holder"><a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?></a></div>
                    <div class="content-holder">
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="text-box"><i class="fas fa-arrow-left"></i> Previous Post</a>
                        <h3 class="entry-title"><a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo esc_html($prev_post->post_title); ?></a></h3>
                    </div>
                <?php endif; ?>
            </div>
            <div class="post-box next-post">
                <?php if ($next_post = get_next_post()) : ?>
                    <div class="figure-holder"><a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?></a></div>
                    <div class="content-holder">
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="text-box">Next Post <i class="fas fa-arrow-right"></i></a>
                        <h3 class="entry-title"><a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo esc_html($next_post->post_title); ?></a></h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Comments -->
        <?php if (comments_open() || get_comments_number()) : ?>
        <div class="post-comment" id="comments">
            <div class="section-heading">
                <h3><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></h3>
            </div>
            
            <?php if (get_comments_number() > 0) : ?>
                <?php 
                // Fetch approved comments for this post (all levels)
                $all_comments = get_comments([
                    'post_id' => get_the_ID(),
                    'status'  => 'approve',
                    'orderby' => 'comment_date_gmt',
                    'order'   => 'ASC',
                ]);
                ?>
                <?php if (!empty($all_comments)) : ?>
                <ul class="comment-list" id="comment-list">
                    <?php 
                    // Render with WP walker (handles hierarchy) using our callback
                    wp_list_comments([
                        'style'       => 'ul',
                        'callback'    => 'sblog_display_comment',
                        'avatar_size' => 100,
                        'short_ping'  => true,
                    ], $all_comments);
                    ?>
                </ul>
                <?php endif; ?>
                <?php 
                // Determine top-level approved comments count to decide if we render View All
                $top_count = get_comments([
                    'post_id' => get_the_ID(),
                    'status'  => 'approve',
                    'parent'  => 0,
                    'count'   => true,
                ]);
                if ($top_count > 3) : ?>
                    <div class="load-more-comments-wrapper">
                        <button id="load-more-comments" class="load-more-btn" data-total="<?php echo (int) $top_count; ?>" data-showing="3">
                            <span class="load-more-text">View All Comments</span>
                            <span class="load-more-count">(<?php echo (int) ($top_count - 3); ?> more)</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php 
                // Pagination for comments
                if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                ?>
                    <nav class="comment-navigation">
                        <div class="nav-links">
                            <?php 
                            if (get_previous_comments_link()) {
                                previous_comments_link('← Older Comments');
                            }
                            if (get_next_comments_link()) {
                                next_comments_link('Newer Comments →');
                            }
                            ?>
                        </div>
                    </nav>
                <?php endif; ?>
            <?php elseif (get_comments_number() > 0) : ?>
                <div class="pending-comments-notice">
                    <p><strong>There are <?php echo get_comments_number(); ?> comments pending approval.</strong></p>
                    <?php if (current_user_can('moderate_comments')) : ?>
                        <p><a href="<?php echo admin_url('edit-comments.php?p=' . get_the_ID()); ?>" class="approve-link">Go to WordPress Dashboard to approve comments →</a></p>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <p class="no-comments">No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Comment Form -->
        <div class="leave-comment">
            <?php comment_form([
                'class_form'           => 'leave-form-box main-comment-form',
                'title_reply'          => 'Post A Comment',
                'title_reply_before'   => '<div class="section-heading"><h3>',
                'title_reply_after'    => '</h3></div>',
                'comment_notes_before' => '<p>Your email address will not be published. Required fields are marked *</p>',
                'comment_notes_after'  => '',
                'fields' => [
                    'author' => '<div class="row"><div class="form-group col-md-6"><input name="author" type="text" class="form-control input-clean" placeholder="Your name*" required></div>',
                    'email'  => '<div class="form-group col-md-6"><input name="email" type="email" class="form-control input-clean" placeholder="Your email*" required></div></div>',
                    'cookies' => '<div class="form-group"><label class="show-message-label"><input type="checkbox" name="wp-comment-cookies-consent"> Remember my details for next time</label></div>',
                ],
                'comment_field' => '<div class="form-group"><textarea name="comment" class="form-control textarea-clean" placeholder="Write your comment..." required></textarea></div>',
                'submit_button' => '<button type="submit" class="axil-btn clean-submit">Post Comment</button>',
                'submit_field'  => '<div class="form-group">%1$s %2$s</div>',
            ]); ?>
        </div>
    </article>

    <!-- Right promo card -->
    <aside class="sblog-right">
        <div class="sblog-promo">
            <div class="sblog-promo-card" id="promoCard">
                <div class="sblog-promo-top">
                    <div class="sblog-promo-figure"><img src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d?q=80&w=400&auto=format&fit=crop" alt="Customer"></div>
                    <p class="sblog-promo-mini">Looking for</p>
                    <h3 class="sblog-promo-title">Scalable Headless eCommerce Solution</h3>
                    <div style="clear:both"></div>
                </div>
                <div class="sblog-promo-body">
                    <div class="sblog-promo-features">
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> 100% Customizable</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> 20+ Free Themes</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> 1000+ Features</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> 100+ API Integrations</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> Any Hosting Options</div>
                        <div class="sblog-feat"><span class="sblog-dot"><i class="fa-solid fa-check"></i></span> 100% SEO Friendly</div>
                    </div>
                    <a class="sblog-promo-cta" href="<?php echo esc_url(home_url('/start')); ?>">Launch your online store now</a>
                </div>
            </div>
        </div>
    </aside>
</div>

<!-- SECTIONS BELOW MAIN GRID -->

<!-- Related Articles Section (Replaces Recent Posts) -->
<section class="sblog-outer-section sblog-related-section">
    <div class="section-heading"><h2 class="title">Recent Articles</h2></div>
    <div class="position-relative">
        <div class="post-slider" style="display: flex; gap: 30px; grid-template-columns: repeat(2, 1fr);">
            <?php
            $colors = ['bg-color-scandal', 'bg-color-old-lace', 'bg-color-selago'];
            $color_index = 0;
            $q = new WP_Query(['post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => [get_the_ID()]]);
            if ($q->have_posts()): while ($q->have_posts()): $q->the_post(); $author_id = get_the_author_meta('ID'); ?>
            <div>
                <div class="post-box <?php echo $colors[$color_index % count($colors)]; ?>">
                    <div class="figure-holder"><a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('medium_large'); } ?></a></div>
                    <div class="content-holder">
                        <div class="entry-category"><ul><?php $category = get_the_category(); if (!empty($category)) : ?><li><a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>"><?php echo esc_html($category[0]->name); ?></a></li><?php endif; ?></ul></div>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <ul class="entry-meta">
                            <li class="post-author"><?php echo get_avatar($author_id, 30); ?><a href="<?php echo get_author_posts_url($author_id); ?>"><?php the_author(); ?></a></li>
                            <li><i class="fas fa-clock"></i> <?php echo sblog_read_time(get_the_content()); ?></li>
                            <li><i class="fas fa-eye"></i> 9k</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php $color_index++; endwhile; wp_reset_postdata(); endif; ?>
        </div>
        <!-- <ul class="slider-navigation">
            <li class="prev slick-arrow" aria-label="Previous articles"><i class="fas fa-arrow-left"></i></li>
            <li class="next slick-arrow" aria-label="Next articles"><i class="fas fa-arrow-right"></i></li>
        </ul> -->
    </div>
</section>

<!-- Newsletter Section (Replaces CTA) -->
<section class="sblog-outer-section sblog-newsletter-section">
    <div class="newsletter-box">
        <h2 class="entry-title">Subscribe to Our Newsletter — Never Miss an Update</h2>
        <p class="entry-description">Get fresh insights, feature launches, and shipment-tracking tips delivered straight to your inbox.</p>
        <form action="#" class="newsletter-form">
            <span class="icon-holder"><i class="far fa-envelope"></i></span>
            <input type="email" class="email-input" placeholder="Email Address">
            <button type="submit" class="axil-btn">Subscribe <i class="fas fa-paper-plane"></i></button>
        </form>
        <ul class="elements-wrap">
            <li><img width="57" height="53" src="https://new.axilthemes.com/demo/template/blogxpress/demo/assets/media/elements/element1.webp" alt="Element"></li>
            <li><img width="120" height="186" src="https://new.axilthemes.com/demo/template/blogxpress/demo/assets/media/elements/element2.webp" alt="Element"></li>
        </ul>
    </div>
</section>

<!-- Slide-out Comments Panel (Keep As Is) -->
<div class="sblog-overlay" id="cOverlay"></div>
<aside class="sblog-panel" id="cPanel">
    <div class="sblog-panel-head">
        <div style="display:flex;align-items:center;gap:10px">
            <?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail', ['style'=>'width:36px;height:36px;border-radius:6px;object-fit:cover']); ?>
            <div>
                <p class="sblog-ph-title"><?php the_title(); ?></p>
                <div class="sblog-ph-count"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></div>
            </div>
        </div>
        <button class="sblog-x" id="cClose" aria-label="Close">&times;</button>
    </div>
    <div class="sblog-panel-guide">By commenting you agree to our Community Guidelines, Terms and Privacy.</div>
    <div class="sblog-panel-body">
        <div class="sblog-c-filter">
            <select><option>Top comments</option><option>Newest first</option><option>Oldest first</option></select>
        </div>
        <!-- Panel Comment Form and List -->
        <?php
        $commenter = wp_get_current_commenter();
        $req       = get_option('require_name_email');
        comment_form([
            'title_reply'    => '',
            'comment_field'  => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Join the discussion..." aria-required="true"></textarea></p>',
            'fields'         => [
                'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="Name' . ($req ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author']) . '"></p>',
                'email'  => '<p class="comment-form-email"><input id="email" name="email" type="email" placeholder="Email' . ($req ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '"></p>',
            ],
            'label_submit'   => 'Submit',
            'class_submit'   => 'button',
        ]);
        ?>
        <ol class="comment-list" id="cList">
            <?php wp_list_comments(['style'=>'ol','avatar_size'=>40,'callback'=>'sblog_display_comment','short_ping'=>true]); ?>
        </ol>
        <?php paginate_comments_links(); ?>
    </div>
</aside>

<div class="sblog-toast" id="toast">Copied link</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
// Original JS for interactivity (Keep As Is)
const SBV = { postId: <?php echo (int) $post_id; ?>, ajax: "<?php echo esc_url($ajax_url); ?>", nonce: "<?php echo esc_js($nonce); ?>", url: "<?php echo esc_url(get_permalink()); ?>", title: "<?php echo esc_js(get_the_title()); ?>", loggedIn: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>, commentUrl: "<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" };
const $  = (q, c=document) => c.querySelector(q);
const $$ = (q, c=document) => [...c.querySelectorAll(q)];
const toast = (msg) => { const t=$("#toast"); t.textContent=msg; t.classList.add('show'); setTimeout(()=>t.classList.remove('show'),1600); };
const cPanel  = $("#cPanel"), cOverlay = $("#cOverlay"), cOpen = $("#commentsBtn"), cClose = $("#cClose");
const openPanel  = (e)=>{ e && e.preventDefault(); cPanel.classList.add("on"); cOverlay.classList.add("on"); document.body.style.overflow='hidden'; };
const closePanel = ()=>{ cPanel.classList.remove("on"); cOverlay.classList.remove("on"); document.body.style.overflow=''; };
cOpen.addEventListener('click', openPanel);
cClose.addEventListener('click', closePanel);
cOverlay.addEventListener('click', closePanel);
document.addEventListener('keydown', e => { if(e.key === 'Escape' && cPanel.classList.contains('on')) closePanel(); });
(() => { const btn = $("#listenBtn"); if (!('speechSynthesis' in window)) { btn.disabled = true; btn.title = 'Not supported'; return; } let speaking = false; let utterance = null; const articleText = document.querySelector('.sblog-content')?.innerText || ''; btn.addEventListener('click', () => { const icon = btn.querySelector('i'); if (!speaking) { utterance = new SpeechSynthesisUtterance(articleText); utterance.lang = 'en-US'; utterance.rate = 1.0; utterance.pitch = 1.0; utterance.onend = () => { speaking=false; icon.className='fa-solid fa-headphones'; btn.title='Read this page'; }; speechSynthesis.cancel(); speechSynthesis.speak(utterance); speaking = true; icon.className='fa-solid fa-stop'; btn.title='Stop reading'; } else { speechSynthesis.cancel(); speaking=false; icon.className='fa-solid fa-headphones'; btn.title='Read this page'; } }); })();
$("#shareBtn").addEventListener('click', async () => { if (navigator.share) { try { await navigator.share({ title: SBV.title, url: SBV.url }); } catch(e){} } else { try { await navigator.clipboard.writeText(SBV.url); toast('Link copied'); } catch(e){ prompt('Copy this link:', SBV.url); } } });
$("#saveBtn").addEventListener('click', async function () { if (!SBV.loggedIn) { toast('Please log in to save'); return; } const fd = new FormData(); fd.append('action','sblog_save_toggle'); fd.append('post_id', SBV.postId); fd.append('nonce', SBV.nonce); try{ const r = await fetch(SBV.ajax,{method:'POST',body:fd}); const j = await r.json(); if (j.success) { this.classList.toggle('sblog-saved', j.data.saved); this.title = j.data.saved ? 'Saved' : 'Save for later'; } else { toast(j.data?.message || 'Error'); } }catch(e){ toast('Network error'); } });
async function votePost(type){ const fd = new FormData(); fd.append('action','sblog_post_vote'); fd.append('post_id',SBV.postId); fd.append('vote',type); fd.append('nonce',SBV.nonce); try{ const r = await fetch(SBV.ajax,{method:'POST',body:fd}); const j = await r.json(); if (j.success) { $("#likeBtn").classList.toggle('sblog-voted', j.data.voted === 'like'); $("#dislikeBtn").classList.toggle('sblog-voted', j.data.voted === 'dislike'); toast(j.data.voted === 'like' ? 'Thanks for the like!' : 'Feedback recorded'); } else toast('Error'); }catch(e){ toast('Network error'); } }
$("#likeBtn").addEventListener('click', () => votePost('like'));
$("#dislikeBtn").addEventListener('click', () => votePost('dislike'));
document.querySelector('.sblog-panel-body').addEventListener('click', async (e) => { const likeBtn = e.target.closest('.sblog-c-like'); const disBtn  = e.target.closest('.sblog-c-dislike'); if (!likeBtn && !disBtn) return; const wrap = e.target.closest('.sblog-comment-actions'); const cid  = wrap?.dataset.comment; const vote = likeBtn ? 'like' : 'dislike'; const fd = new FormData(); fd.append('action','sblog_comment_vote'); fd.append('comment_id', cid); fd.append('vote', vote); fd.append('nonce', SBV.nonce); try{ const r = await fetch(SBV.ajax,{method:'POST',body:fd}); const j = await r.json(); if (j.success) { wrap.querySelector('.sblog-c-like .sblog-c-n').textContent    = j.data.like; wrap.querySelector('.sblog-c-dislike .sblog-c-n').textContent = j.data.dislike; likeBtn?.classList.toggle('sblog-voted', vote==='like'); disBtn?.classList.toggle('sblog-voted', vote==='dislike'); } }catch(err){ toast('Network error'); } });
const promo = document.getElementById('promoCard'); if ('IntersectionObserver' in window && promo) { new IntersectionObserver((entries)=> { entries.forEach(e=>{ if(e.isIntersecting){ promo.style.transform='translateY(0)'; promo.style.opacity='1'; } }); },{threshold:.2}).observe(promo); promo.style.transform='translateY(6px)'; promo.style.opacity='.99'; }

// JS for Slick Slider
jQuery(document).ready(function($){
    $('.post-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: true,
        prevArrow: '.slider-navigation .prev',
        nextArrow: '.slider-navigation .next',
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 2 } },
            { breakpoint: 768, settings: { slidesToShow: 1 } }
        ]
    });
    
    // Load More Comments Functionality
    $(document).on('click', '#load-more-comments', function() {
        const $btn = $(this);
        // Reveal next hidden top-level comments (if any were hidden by server-side limit)
        const $allTop = $('#comment-list > li');
        // If no hidden items because WP rendered all, just hide the button
        if ($allTop.length <= 3) {
            $('.load-more-comments-wrapper').fadeOut(200);
            return;
        }
        // Show all after click (simple UX)
        $allTop.slice(3).each(function(index){
            const $el = $(this);
            setTimeout(()=>{ $el.fadeIn(300); }, index*80);
        });
        setTimeout(()=>{ $('.load-more-comments-wrapper').fadeOut(200); }, ($allTop.length-3)*80+350);
    });
    
    // Inline Reply Form Handling - NO URL CHANGES
    $(document).on('click', '.item-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Prevent URL change by stopping the default link behavior
        const $replyLink = $(this);
        const href = $replyLink.attr('href');
        
        // Don't change URL or add hash
        if (window.history && window.history.pushState) {
            // Keep the URL clean - don't change it
            history.replaceState(null, null, window.location.pathname);
        }
        
        const $commentWrapper = $replyLink.closest('.each-comment');
        const commentId = href ? href.match(/replytocom=(\d+)/) : null;
        
        // Remove any existing inline reply forms
        $('.comment-reply-form').slideUp(200, function() {
            $(this).remove();
        });
        
        if (commentId && commentId[1]) {
            // Wait a bit for the removal animation
            setTimeout(function() {
                // Create inline reply form
                const $replyForm = $('<div>', {
                    'class': 'comment-reply-form',
                    'style': 'display: none;'
                });
                
                const authorName = $commentWrapper.find('.comment-title').first().text().trim();
                
                const formHtml = `
                    <h3 class="comment-reply-title">
                        <span>Reply to ${authorName}</span>
                        <a href="#" class="cancel-reply">Cancel reply</a>
                    </h3>
                    <form action="${SBV.url}" method="post" class="inline-comment-form">
                        <textarea name="comment" placeholder="Write your reply..." required></textarea>
                        <input type="hidden" name="comment_post_ID" value="${SBV.postId}">
                        <input type="hidden" name="comment_parent" value="${commentId[1]}">
                        <div class="form-submit">
                            <input type="submit" value="Post Reply">
                        </div>
                    </form>
                `;
                
                $replyForm.html(formHtml);
                $commentWrapper.append($replyForm);
                
                // Slide down animation
                $replyForm.slideDown(300);
                
                // Scroll to reply form smoothly
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $replyForm.offset().top - 100
                    }, 400, function() {
                        // Focus on textarea after scroll
                        $replyForm.find('textarea').focus();
                    });
                }, 100);
            }, 200);
        }
        
        // Always return false to prevent any navigation
        return false;
    });
    
    // Cancel Reply
    $(document).on('click', '.cancel-reply', function(e) {
        e.preventDefault();
        $(this).closest('.comment-reply-form').fadeOut(300, function() {
            $(this).remove();
        });
    });
    
    // AJAX submit for inline reply form (no refresh)
    $(document).on('submit', '.comment-reply-form form', function(e) {
        e.preventDefault();
        const $form = $(this);
        const $submitBtn = $form.find('input[type="submit"]');
        $submitBtn.val('Posting...').prop('disabled', true);
        
        const formData = $form.serialize();
        fetch(SBV.commentUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
            body: formData
        }).then(() => {
            // Reload comments area without full page refresh
            fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
            .then(r => r.text())
            .then(html => {
                const temp = document.createElement('div');
                temp.innerHTML = html;
                const newComments = temp.querySelector('#comment-list') || temp.querySelector('.post-comment');
                const curComments = document.querySelector('#comment-list') || document.querySelector('.post-comment');
                if (newComments && curComments) {
                    curComments.innerHTML = newComments.innerHTML;
                }
                toast('Reply posted');
                $('.comment-reply-form').remove();
            }).catch(()=>{ toast('Posted. Refresh to see your reply.'); });
        }).catch(()=>{ toast('Error posting reply'); })
        .finally(()=>{ $submitBtn.val('Post Reply').prop('disabled', false); });
    });
    
    // AJAX submit for main comment form
    $(document).on('submit', '.main-comment-form', function(e){
        e.preventDefault();
        const $form = $(this);
        const $btn = $form.find('button[type="submit"]');
        $btn.text('Posting...').prop('disabled', true);
        const formData = $form.serialize();
        fetch(SBV.commentUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
            body: formData
        }).then(()=>{
            // Refresh comments list fragment
            fetch(window.location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
            .then(r=>r.text()).then(html=>{
                const temp = document.createElement('div'); temp.innerHTML = html;
                const newComments = temp.querySelector('#comment-list') || temp.querySelector('.post-comment');
                const curComments = document.querySelector('#comment-list') || document.querySelector('.post-comment');
                if (newComments && curComments) curComments.innerHTML = newComments.innerHTML;
                toast('Comment posted');
                // Clear textarea
                $form.find('textarea[name="comment"]').val('');
            }).catch(()=>{ toast('Posted. Refresh to see your comment.'); });
        }).catch(()=>{ toast('Error posting comment'); })
        .finally(()=>{ $btn.text('Post Comment').prop('disabled', false); });
    });
    
    // FAQ Toggle Functionality (Vanilla JS)
    window.toggleFaq = function(index) {
        const faqItem = document.querySelector(`[data-faq="${index}"]`);
        const answer = faqItem.querySelector('.faq-answer');
        const plusIcon = faqItem.querySelector('.faq-icon-plus');
        const minusIcon = faqItem.querySelector('.faq-icon-minus');
        
        if (answer.style.maxHeight) {
            // Close FAQ
            answer.style.maxHeight = null;
            answer.style.opacity = '0';
            faqItem.classList.remove('active');
            plusIcon.style.display = 'block';
            minusIcon.style.display = 'none';
        } else {
            // Close all other FAQs first
            document.querySelectorAll('.faq-item').forEach(item => {
                const otherAnswer = item.querySelector('.faq-answer');
                const otherPlus = item.querySelector('.faq-icon-plus');
                const otherMinus = item.querySelector('.faq-icon-minus');
                
                otherAnswer.style.maxHeight = null;
                otherAnswer.style.opacity = '0';
                item.classList.remove('active');
                otherPlus.style.display = 'block';
                otherMinus.style.display = 'none';
            });
            
            // Open current FAQ
            answer.style.maxHeight = answer.scrollHeight + 'px';
            answer.style.opacity = '1';
            faqItem.classList.add('active');
            plusIcon.style.display = 'none';
            minusIcon.style.display = 'block';
        }
    };
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const SBV = { 
        postId: <?php echo (int) $post_id; ?>, 
        ajax: "<?php echo esc_url(admin_url('admin-ajax.php')); ?>", 
        nonce: "<?php echo esc_js($nonce); ?>", 
        url: "<?php echo esc_url(get_permalink()); ?>", 
        title: "<?php echo esc_js(get_the_title()); ?>",
        loggedIn: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>
    };

    const $  = (q) => document.querySelector(q);
    const toast = (msg) => { 
        const t=$("#toast"); t.textContent=msg; t.classList.add('show'); 
        setTimeout(()=>t.classList.remove('show'), 1600); 
    };

    // --- NEW: Central function to track interactions ---
    async function trackInteraction(type) {
        const fd = new FormData();
        fd.append('action', 'sblog_track_interaction');
        fd.append('post_id', SBV.postId);
        fd.append('type', type);
        fd.append('nonce', SBV.nonce);
        try {
            // Fire and forget, no need to wait for response
            fetch(SBV.ajax, { method: 'POST', body: fd });
        } catch (e) {
            console.error('Tracking error:', e);
        }
    }

    // --- Add tracking to existing button listeners ---
    
    // 1. Audio Button
    (() => { 
        const btn = $("#listenBtn"); 
        if (!('speechSynthesis' in window)) { 
            btn.disabled = true; btn.title = 'Not supported'; return; 
        } 
        let speaking = false; 
        let utterance = null; 
        const articleText = $('.sblog-content')?.innerText || ''; 
        btn.addEventListener('click', () => {
            trackInteraction('audio'); // <-- TRACKING
            const icon = btn.querySelector('i'); 
            if (!speaking) { 
                utterance = new SpeechSynthesisUtterance(articleText); 
                utterance.onend = () => { speaking=false; icon.className='fa-solid fa-headphones'; }; 
                speechSynthesis.cancel(); 
                speechSynthesis.speak(utterance); 
                speaking = true; icon.className='fa-solid fa-stop'; 
            } else { 
                speechSynthesis.cancel(); 
                speaking=false; icon.className='fa-solid fa-headphones';
            } 
        }); 
    })();

    // 2. Share Button
    $("#shareBtn").addEventListener('click', async () => { 
        trackInteraction('share'); // <-- TRACKING
        if (navigator.share) { 
            try { await navigator.share({ title: SBV.title, url: SBV.url }); } catch(e){} 
        } else { 
            try { await navigator.clipboard.writeText(SBV.url); toast('Link copied'); } catch(e){ prompt('Copy this link:', SBV.url); } 
        } 
    });

    // 3. Save Button
    $("#saveBtn").addEventListener('click', async function () { 
        trackInteraction('save'); // <-- TRACKING
        if (!SBV.loggedIn) { toast('Please log in to save'); return; } 
        const fd = new FormData(); 
        fd.append('action','sblog_save_toggle'); 
        fd.append('post_id', SBV.postId); 
        fd.append('nonce', SBV.nonce); 
        try{ 
            const r = await fetch(SBV.ajax,{method:'POST',body:fd}); 
            const j = await r.json(); 
            if (j.success) { 
                this.classList.toggle('sblog-saved', j.data.saved); 
                this.title = j.data.saved ? 'Saved' : 'Save for later'; 
            } else { 
                toast(j.data?.message || 'Error'); 
            } 
        }catch(e){ toast('Network error'); } 
    });

    // 4. Like/Dislike Buttons
    async function votePost(type){ 
        trackInteraction(type); // <-- TRACKING (works for both 'like' and 'dislike')
        const fd = new FormData(); 
        fd.append('action','sblog_post_vote'); 
        fd.append('post_id',SBV.postId); 
        fd.append('vote',type); 
        fd.append('nonce',SBV.nonce); 
        try{ 
            const r = await fetch(SBV.ajax,{method:'POST',body:fd}); 
            const j = await r.json(); 
            if (j.success) { 
                $("#likeBtn").classList.toggle('sblog-voted', j.data.voted === 'like'); 
                $("#dislikeBtn").classList.toggle('sblog-voted', j.data.voted === 'dislike'); 
            } else toast('Error'); 
        }catch(e){ toast('Network error'); } 
    }
    $("#likeBtn").addEventListener('click', () => votePost('like'));
    $("#dislikeBtn").addEventListener('click', () => votePost('dislike'));

    // 5. Comments Button
    $("#commentsBtn").addEventListener('click', () => {
        trackInteraction('comment'); // <-- TRACKING
    });
});
</script>

<?php endwhile; endif; ?>
<?php get_footer(); ?>

<!-- TrackIQ Blog Theme -->