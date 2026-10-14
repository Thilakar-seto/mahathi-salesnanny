<?php
/**
 * PAS Migration Problem Finder content — GENERATED from assets/js/pas-finder/engine.js (v3.1.0).
 * The browser (engine.js) and the server (inc/pas-finder.php) must score identically, so if engine.js
 * changes, regenerate this file (node export of MHEngine.AREAS / IMPACT / BANDS) rather than editing it by hand.
 */
return array (
  'version' => '3.1.0',
  'impact' => 
  array (
    'low' => 
    array (
      'label' => 'Low',
      'w' => 1,
    ),
    'medium' => 
    array (
      'label' => 'Medium',
      'w' => 2,
    ),
    'high' => 
    array (
      'label' => 'High',
      'w' => 3,
    ),
  ),
  'areas' => 
  array (
    0 => 
    array (
      'id' => 'product',
      'name' => 'Product Setup',
      'sub' => 'Coverage & inference',
      'cost' => '$110 – $125 per form',
      'costUnit' => 'form',
      'costDriver' => 'Effort grows with each form and product artifact that has to be reverse-engineered, externalized and validated.',
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p1',
          'text' => 'Our product rules (coverages, rating and forms) are hard to see, costly to maintain and buried in legacy code',
        ),
        1 => 
        array (
          'id' => 'p2',
          'text' => 'The same products are set up again in each line of business and business unit',
        ),
      ),
      'approach' => 
      array (
        0 => 'Reverse-engineered and externalized product requirements from legacy systems',
        1 => 'Exposed custom coverage and rating logic by breaking pricing into standard, traceable components',
      ),
      'accelerators' => 
      array (
        0 => 'Product Discovery Accelerator',
        1 => 'Product Catalog',
      ),
      'outcomes' => 
      array (
        0 => '40% reduction in implementation and maintenance cost',
        1 => 'Faster new product rollout and state launches',
      ),
    ),
    1 => 
    array (
      'id' => 'forms',
      'name' => 'Forms Rationalization & Creation',
      'sub' => 'Templates and forms logic',
      'cost' => '$20K – $30K per line of business',
      'costUnit' => 'line of business',
      'costDriver' => 'Templates and state-specific forms logic are organized and rationalized line by line.',
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p3',
          'text' => 'Form templates are duplicated across lines of business and business units',
        ),
        1 => 
        array (
          'id' => 'p4',
          'text' => 'Complex, state-specific forms logic drives questions and rules',
        ),
      ),
      'approach' => 
      array (
        0 => 'Hybrid PAS + Manuscript approach',
        1 => 'Product Catalog that rationalizes templates across lines and business units',
        2 => 'AI-driven document comparison for forms',
      ),
      'accelerators' => 
      array (
        0 => 'Product Catalog',
        1 => 'Forms Intelligence & Comparison',
      ),
      'outcomes' => 
      array (
        0 => '55% reduction in implementation and maintenance cost',
        1 => 'More product flexibility and visibility, with faster build and maintenance',
      ),
    ),
    2 => 
    array (
      'id' => 'producer',
      'name' => 'Producer Clean-up & Onboarding',
      'sub' => 'Agents, hierarchies and licenses',
      'cost' => '$80K – $90K per business unit',
      'costUnit' => 'business unit',
      'costDriver' => 'Producer hierarchies, licensing checks and de-duplication run once for each business unit\'s distribution channel.',
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p5',
          'text' => 'Shared agents create duplicate records and inconsistent producer hierarchies',
        ),
        1 => 
        array (
          'id' => 'p6',
          'text' => 'Invalid or expired agency licenses are not caught consistently',
        ),
      ),
      'approach' => 
      array (
        0 => 'Producer onboarding integrity checks that define and validate hierarchies and remove duplicates',
        1 => 'Real-time license validation through API integration with agency licensing portals',
      ),
      'accelerators' => 
      array (
        0 => 'Producer Onboarding Integrity Checker',
        1 => 'Real-Time License Validator',
      ),
      'outcomes' => 
      array (
        0 => '70% less rework in policy ingestion and producer onboarding',
        1 => '50% faster quote-to-bind and straight-through processing',
      ),
    ),
    3 => 
    array (
      'id' => 'digital',
      'name' => 'Unified Digital Engagement',
      'sub' => 'Portals and user experience',
      'cost' => '$20K – $30K per line of business',
      'costUnit' => 'line of business',
      'costDriver' => 'Quote, bind and service journeys are configured and tested for each line of business.',
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p7',
          'text' => 'We run separate portals for different business units and user groups',
        ),
        1 => 
        array (
          'id' => 'p8',
          'text' => 'Agents, underwriters and customers get an inconsistent experience and fragmented workflows',
        ),
      ),
      'approach' => 
      array (
        0 => 'One digital platform with a consistent experience for underwriters, agents and customers',
        1 => 'API and orchestration layer on a canonical policy model for retrieving and updating policy data',
      ),
      'accelerators' => 
      array (
        0 => 'Unified Digital Workbench',
      ),
      'outcomes' => 
      array (
        0 => '30% faster business user adoption',
        1 => 'A consistent, scalable digital experience across channels',
      ),
    ),
    4 => 
    array (
      'id' => 'ams',
      'name' => 'Agency Management System Integration',
      'sub' => 'Distribution feeds such as IVANS',
      'cost' => '$30K – $40K per line of business',
      'costUnit' => 'line of business',
      'costDriver' => 'Agency download and feed mappings (for example ACORD AL3) are built and certified for each line of business.',
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p9',
          'text' => 'We will have to recertify policy data feeds to agencies and distribution platforms such as IVANS',
        ),
        1 => 
        array (
          'id' => 'p10',
          'text' => 'Moving to a cloud-hosted PAS puts our agency and distribution feeds at risk during cutover',
        ),
      ),
      'approach' => 
      array (
        0 => 'Data translation layer that converts new PAS data into the legacy format',
        1 => 'Avoids recertification and keeps the transition in step with the cloud migration timeline',
      ),
      'accelerators' => 
      array (
        0 => 'AMS Data Translator',
      ),
      'outcomes' => 
      array (
        0 => 'Stable, uninterrupted operations through a phased PAS modernization',
        1 => 'External dependencies decoupled from the PAS',
      ),
    ),
    5 => 
    array (
      'id' => 'compliance',
      'name' => 'Compliance & Regulatory Reporting',
      'sub' => 'State and statistical reporting',
      'cost' => '$80K – $90K per business unit',
      'costUnit' => 'business unit',
      'costDriver' => 'Bureau and state certification, filings and golden baselines are managed for each business unit.',
      'regulatory' => true,
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p11',
          'text' => 'Adding lines of business or business units changes the data behind state and statistical reports',
        ),
        1 => 
        array (
          'id' => 'p12',
          'text' => 'We risk late or rejected bureau and state filings (for example WCPOLS) after the move',
        ),
      ),
      'approach' => 
      array (
        0 => 'Compliance built into line and state configuration, with certification and re-certification managed (for example WCPOLS)',
        1 => 'Certified regulatory and statistical feeds protected with golden-submission baselines',
      ),
      'accelerators' => 
      array (
        0 => 'Compliance Workbench',
        1 => 'Reg Report Guardian',
      ),
      'outcomes' => 
      array (
        0 => '80% reduction in regulatory and statistical compliance risk',
        1 => 'Faster onboarding of new lines and states',
      ),
    ),
    6 => 
    array (
      'id' => 'hypercare',
      'name' => 'Hypercare & Utilization Enablement',
      'sub' => 'Go-live, pricing and renewals',
      'cost' => '$80K – $90K per business unit',
      'costUnit' => 'business unit',
      'costDriver' => 'Neutrality testing and go-live support are run for each business unit as it moves to the new PAS.',
      'problems' => 
      array (
        0 => 
        array (
          'id' => 'p13',
          'text' => 'Pricing and eligibility may differ in the new PAS, which hurts business confidence',
        ),
        1 => 
        array (
          'id' => 'p14',
          'text' => 'Creating renewals in the new PAS takes too long and risks missed SLAs',
        ),
      ),
      'approach' => 
      array (
        0 => 'Neutrality testing using future renewal policies',
        1 => 'Continuous validation of PAS interactions across the wider P&C ecosystem',
        2 => 'Automated policy renewal migration',
      ),
      'accelerators' => 
      array (
        0 => 'AI-driven Rating & Forms Comparison',
        1 => 'Hypercare Framework',
      ),
      'outcomes' => 
      array (
        0 => 'Business confidence built by validating underwriting outcomes',
        1 => 'Operational continuity protected at go-live',
      ),
    ),
  ),
  'bands' => 
  array (
    0 => 
    array (
      'min' => 60,
      'key' => 'critical',
      'label' => 'Critical',
      'note' => 'Several areas are likely to delay go-live or add cost. Plan remediation before the build starts.',
    ),
    1 => 
    array (
      'min' => 35,
      'key' => 'high',
      'label' => 'High',
      'note' => 'More than one area needs a clear plan before the build starts.',
    ),
    2 => 
    array (
      'min' => 15,
      'key' => 'moderate',
      'label' => 'Moderate',
      'note' => 'A few focused fixes will remove most of the risk.',
    ),
    3 => 
    array (
      'min' => 0,
      'key' => 'low',
      'label' => 'Low',
      'note' => 'Few known problems. Confirm with side-by-side testing before go-live.',
    ),
  ),
);
