<?php
/**
 * <app-workbenchsolution> — converted from src/app/pages/workbenchsolution/workbenchsolution.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<app-health-top-banner><?php mh_component('health-top-banner', ['pageData' => $healthcareData]); ?></app-health-top-banner><app-section2-temp><?php mh_component('section2-temp', ['highlightOrder' => 'before', 'highlightPosition' => 'inline', 'highlightText' => 'One platform. Multiple workbenches.', 'headingText' => 'Powered by a single data and workflow engine​', 'bannerText' => 'Platform uses a common core and ​delivers role-specific workbenches on top of it ​', 'bottomTitle' => 'Single, shared platform chassis,', 'bottomHighlight' => 'many Workbenches', 'sideImage' => 'assets/images/wrkbenchsoltion.jpeg', 'steps' => $processSteps, 'features' => $insuranceFeatures]); ?></app-section2-temp><app-section41-temp><?php mh_component('section4.1-temp', ['sectionHeaderTitle' => $omniTitle, 'sectionHeaderSubtitle' => $omniSubtitle, 'features' => $omniFeatures]); ?></app-section41-temp><app-section3-temp><?php mh_component('section3-temp', ['title' => $aiRiskTitle, 'cards' => $aiRiskCards]); ?></app-section3-temp><app-section4-temp><?php mh_component('section4-temp', ['headerTitle' => $healthcareHeader, 'ctaButtons' => $ctaButtons]); ?></app-section4-temp>
