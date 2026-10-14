<?php
/**
 * <app-section2-temp> — converted from src/app/pages/sharedComponents/section2-temp/section2-temp.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<?php
// Heading split (was ngOnChanges): text before / after the highlighted phrase.
if ( 'before' === ( $highlightOrder ?? 'after' ) ) {
	$beforeText = '';
	$afterText  = $headingText ?? '';
} else {
	$parts      = explode( (string) ( $highlightText ?? '' ), (string) ( $headingText ?? '' ) );
	$beforeText = $parts[0] ?? '';
	$afterText  = $parts[1] ?? '';
}
?>
<section class="bg-omni-grey">
  <div class="container text-center">
    <h2 class="fw-bold section-title"><?php if (($highlightPosition === 'inline')) : ?><?php if (($highlightOrder === 'before')) : ?><span class="underline_cls1"><?= mh_e($highlightText) ?></span> <?= mh_e($headingText) ?> <?php endif; ?><?php if (($highlightOrder === 'after')) : ?> <?= mh_e($beforeText) ?> <span class="underline_cls1"><?= mh_e($highlightText) ?></span> <?= mh_e($afterText) ?> <?php endif; ?><?php endif; ?><?php if (($highlightPosition === 'below')) : ?><?php if (($highlightOrder === 'before')) : ?><span class="underline_cls1 d-block mb-2"> <?= mh_e($highlightText) ?> </span> <?= mh_e($headingText) ?> <?php endif; ?><?php if (($highlightOrder === 'after')) : ?> <?= mh_e($beforeText) ?><?= mh_e($afterText) ?> <br><span class="underline_cls1 d-inline-block mt-2"> <?= mh_e($highlightText) ?> </span><?php endif; ?><?php endif; ?></h2>
  </div>
</section>
<section class="page-block-section position-relative" style="background-color:#76A379;" id="page-block-fs-panel">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 pt-0 pb-4">
        <div class="editor-text my-4 text-white">
          <h2 style="text-align: center;"><span class="big"><?= mh_e($bannerText) ?></span></h2>
        </div>
      </div>
    </div>
    <section class="py-65px mb-3">
      <div class="container">
        <div class="relative mb-60px lg:mb-80px lg:pb-30px">
          <div class="focus w-20px h-full absolute -left-10px lg:right-0 mx-auto">
            <div class="w-1px h-full border-l-[thin] lg:border-l-[1px] border-violet absolute left-1/2 lg:translate-x-[-50%]"></div>
            <div class="sticky top-1/2 bg-violet rounded-full mx-6px lg:mx-0 w-9px h-9px lg:w-20px lg:h-20px"></div>
          </div>
          <ol class="lg:counter-reset">
            <?php foreach (mh_list($steps) as $i => $step) : ?>
              <li class="mb-40px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:mb-0 lg:w-1/2<?= (($i % 2) !== 0) ? ' lg:ml-auto' : '' ?><?= (($i % 2) !== 0) ? ' lg:pl-20px' : '' ?><?= (($i % 2) === 0) ? ' lg:pr-20px' : '' ?>">
                <div class="d-none mx-20px min-w-[105px] w-1/4 md:w-1/3 lg:w-150px xl:w-200px flex-shrink-0"><svg width="100%" viewBox="0 0 200 227" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M117.713 225.665C59.8337 232.065 2.71587 210.326 0.975139 143.234
                       C-2.61513 77.5758 -0.439211 4.30363 82.3545 0
                       C146.87 0 199.092 52.9678 199.092 118.405
                       C205.729 172.697 175.701 225.334 117.713 225.665Z" fill="<?= mh_a((('url(#pattern' . $i) . ')')) ?>"></path><defs><pattern width="1" height="1" id="<?= mh_a(('pattern' . $i)) ?>"><image height="100%" href="<?= mh_asset_url($step['image'] ?? null) ?>"></image></pattern></defs></svg></div>
                <div>
                  <p class="p-3 mb-10px text-20 md:text-25 text-violet   font-bold antialiased lg:text-40 text-white"> <?= mh_e($step['title'] ?? null) ?> </p>
                  <div class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased text-white" data-mh-p><span><?= $step['description'] ?? null ?></span></div>
                </div>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </section>
  </div>
</section>
<section class="page-block-section position-relative font-dark" style="background-color:#FFFFFF;min-height:0!important;" id="page-block-ec-panel">
  <div class="container flex-column Digitalnervous">
    <h4 class="h1 text-center Digital"> <?= mh_e($bottomTitle) ?> <span class="underline_cls1 highlight-pop"> <?= mh_e($bottomHighlight) ?> </span></h4>
  </div>
</section>
<section class="page-block-section position-relative overflow-hidden" style="background-color: #fdfdfd;" id="page-block-hi-banner">
  <div class="background-layer container-fluid d-none d-md-block">
    <div class="row h-100" style="background-color: #b2c7b3;">
      <div class="col-md-6 p-0 h-100" style="<?= esc_attr(mh_styles(['background' => (('url(' . mh_asset_src($sideImage)) . ') center/cover no-repeat'), 'min-height' => '600px'])) ?>">
        <div style="position:absolute; top:0; left:0; width:100%; height:100%;
                 background: linear-gradient(to right, transparent, #fdfdfd);"></div>
      </div>
    </div>
  </div>
  <div class="container position-relative" style="z-index: 2;">
    <div class="row align-items-center sideImage">
      <div class="col-12 d-lg-none mb-4"><img class="img-fluid rounded-4 shadow" alt="Healthcare Expertise" src="<?= mh_asset_url($sideImage) ?>"></div>
      <div class="col-12 col-md-5 offset-md-7">
        <div class="why-choose-us-content mt-4">
          <?php foreach (mh_list($features) as $item) : ?>
            <div class="why-item d-flex mb-4">
              <div class="why-check"><i class="<?= mh_a($item['icon'] ?? null) ?>"></i></div>
              <p><strong> <?= mh_e($item['title'] ?? null) ?><?php if (!(mh_shouldHideColon(($item['title'] ?? null)))) : ?><span></span><?php endif; ?></strong> <?= mh_e($item['description'] ?? null) ?> </p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
