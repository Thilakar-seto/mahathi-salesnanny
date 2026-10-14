<?php
/**
 * <app-faq-accordion> — converted from src/app/pages/faq/faq-accordion/faq-accordion.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<?php
// Element ids derived from the stable FAQ item id (were getters on the component).
$buttonId = 'faq-btn-' . ( $item['id'] ?? '' );
$panelId  = 'faq-panel-' . ( $item['id'] ?? '' );
?>
<div class="faq-item<?= $isOpen ? ' faq-item--open' : '' ?>"><button class="faq-question" type="button" id="<?= mh_a($buttonId) ?>" aria-expanded="<?= mh_a($isOpen) ?>" aria-controls="<?= mh_a($panelId) ?>" data-mh-action="toggle"><span class="faq-question__text"><?= mh_e($item['question'] ?? null) ?></span><span class="faq-question__icon" aria-hidden="true"> <?= mh_e(($isOpen ? '−' : '+')) ?> </span></button><div class="faq-answer" role="region" id="<?= mh_a($panelId) ?>" aria-labelledby="<?= mh_a($buttonId) ?>">
    <p class="faq-answer__text"><?= mh_e($item['answer'] ?? null) ?></p>
  </div></div>
