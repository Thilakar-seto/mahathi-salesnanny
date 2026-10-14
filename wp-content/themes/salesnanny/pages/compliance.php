<?php
/**
 * <app-compliance> — converted from src/app/pages/compliance/compliance.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<app-health-top-banner><?php mh_component('health-top-banner', ['pageData' => $healthcareData]); ?></app-health-top-banner><app-section2-temp><?php mh_component('section2-temp', ['headingText' => 'Replace fragmented, manual, and reactive compliance processes with a', 'highlightText' => 'proactive, KPI-driven, audit-ready operating model', 'highlightOrder' => 'after', 'highlightPosition' => 'below', 'bannerText' => 'A phased end-to-end compliance model​​', 'bottomTitle' => 'Compliance Operations as a​', 'bottomHighlight' => 'Managed Service​', 'sideImage' => 'assets/images/cmplince.jpeg', 'steps' => $processSteps, 'features' => $insuranceFeatures]); ?></app-section2-temp><app-section41-temp><?php mh_component('section4.1-temp', ['sectionHeaderTitle' => $omniTitle, 'sectionHeaderSubtitle' => $omniSubtitle, 'features' => $omniFeatures]); ?></app-section41-temp><app-section3-temp><?php mh_component('section3-temp', ['title' => $aiRiskTitle, 'cards' => $aiRiskCards]); ?></app-section3-temp><app-section4-temp><?php mh_component('section4-temp', ['headerTitle' => $healthcareHeader, 'ctaButtons' => $ctaButtons]); ?></app-section4-temp>
