<?php
/**
 * <app-solution-grid> — "Select Industry" accordion (mobile), converted from
 * src/app/sharedComponents/solution-grid/solution-grid.component.html
 *
 * Inputs:
 *   $options               tab labels ([['label' => ...], ...])
 *   $gridMap               grid items per tab (cards + images)
 *   $activeTab             tab whose cards are listed
 *   $activeAccordionIndex  open accordion (null = all closed)
 *
 * The open accordion lists the cards of the active tab. Card lists for every
 * tab are kept in <template> elements; assets/js/mahathi.js swaps them when the
 * accordion or the tab changes (the arrows of the home page change the tab only).
 */
if (!defined('ABSPATH')) { exit; }

$gridMap              = mh_list( $gridMap ?? array() );
$activeTab            = (int) ( $activeTab ?? 0 );
$activeAccordionIndex = $activeAccordionIndex ?? 0;

$mh_render_cards = static function ( array $items ): void {
	foreach ( mh_solution_grid_mobile_cards( $items ) as $card ) {
		$href = mh_solution_grid_link( $card['label'] );
		?>
              <div class="mobile-card"<?= $href ? ' data-href="' . esc_url( $href ) . '"' : '' ?>>
                <?php if ( $card['image'] ) : ?>
                  <div class="mobile-card-img" style="background-image: url(<?= esc_url( mh_asset_src( $card['image'] ) ) ?>);"></div>
                <?php endif; ?>
                <div class="mobile-card-content">
                  <h5><?= mh_e( $card['label'] ) ?></h5>
                  <p class="mobile-learn">Learn More →</p>
                </div>
              </div>
		<?php
	}
};
?>
<div class="mobile-view" data-mh-solution-grid data-active-tab="<?= (int) $activeTab ?>" data-active-acc="<?= null === $activeAccordionIndex ? '' : (int) $activeAccordionIndex ?>">
  <div class="mobile-container">
    <div class="d-flex mb-3 selectindustry"><i class="fas fa-building"></i><h4 class="mobile-title">Select Industry</h4></div>
    <?php foreach (mh_list($options) as $i => $opt) : ?>
      <div class="mobile-accordion">
        <div class="mobile-accordion-header" data-mh-accordion="<?= (int) $i ?>"><span><?= mh_e($opt['label'] ?? null) ?></span><span class="dropdown-arrow<?= ($activeAccordionIndex === $i) ? ' open' : '' ?>"></span></div>
        <?php if ($activeAccordionIndex === $i) : ?>
          <div class="mobile-accordion-body">
            <?php $mh_render_cards( mh_list( $gridMap[ $activeTab ] ?? array() ) ); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php foreach ( $gridMap as $t => $items ) : ?>
<template data-mh-cards="<?= (int) $t ?>">
<?php $mh_render_cards( mh_list( $items ) ); ?>
</template>
<?php endforeach; ?>
