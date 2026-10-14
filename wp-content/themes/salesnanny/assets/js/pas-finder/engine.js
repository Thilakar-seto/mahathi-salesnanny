/* Mahathi PAS Migration Problem Finder: matching engine.
   The visitor ticks the problems they face and rates the impact of each.
   The engine ranks the 7 core migration areas by how strongly they match, and gives
   an overall risk exposure score. Areas, problems, approach, accelerators, outcomes and
   average costs are taken from Mahathi's "Assessment Tools" slide (Core Migration Areas).
   Shared by the browser and the Node server so on-screen and emailed results always match. */
(function (root, factory) {
  if (typeof module === 'object' && module.exports) module.exports = factory();
  else root.MHEngine = factory();
})(typeof self !== 'undefined' ? self : this, function () {
  'use strict';

  var VERSION = '3.1.0';
  var IMPACT = { low: { label: 'Low', w: 1 }, medium: { label: 'Medium', w: 2 }, high: { label: 'High', w: 3 } };

  var AREAS = [
    {
      id: 'product', name: 'Product Setup', sub: 'Coverage & inference',
      cost: '$110 \u2013 $125 per form',
      costUnit: 'form', costDriver: 'Effort grows with each form and product artifact that has to be reverse-engineered, externalized and validated.',
      problems: [
        { id: 'p1', text: 'Our product rules (coverages, rating and forms) are hard to see, costly to maintain and buried in legacy code' },
        { id: 'p2', text: 'The same products are set up again in each line of business and business unit' }
      ],
      approach: ['Reverse-engineered and externalized product requirements from legacy systems', 'Exposed custom coverage and rating logic by breaking pricing into standard, traceable components'],
      accelerators: ['Product Discovery Accelerator', 'Product Catalog'],
      outcomes: ['40% reduction in implementation and maintenance cost', 'Faster new product rollout and state launches']
    },
    {
      id: 'forms', name: 'Forms Rationalization & Creation', sub: 'Templates and forms logic',
      cost: '$20K \u2013 $30K per line of business',
      costUnit: 'line of business', costDriver: 'Templates and state-specific forms logic are organized and rationalized line by line.',
      problems: [
        { id: 'p3', text: 'Form templates are duplicated across lines of business and business units' },
        { id: 'p4', text: 'Complex, state-specific forms logic drives questions and rules' }
      ],
      approach: ['Hybrid PAS + Manuscript approach', 'Product Catalog that rationalizes templates across lines and business units', 'AI-driven document comparison for forms'],
      accelerators: ['Product Catalog', 'Forms Intelligence & Comparison'],
      outcomes: ['55% reduction in implementation and maintenance cost', 'More product flexibility and visibility, with faster build and maintenance']
    },
    {
      id: 'producer', name: 'Producer Clean-up & Onboarding', sub: 'Agents, hierarchies and licenses',
      cost: '$80K \u2013 $90K per business unit',
      costUnit: 'business unit', costDriver: "Producer hierarchies, licensing checks and de-duplication run once for each business unit's distribution channel.",
      problems: [
        { id: 'p5', text: 'Shared agents create duplicate records and inconsistent producer hierarchies' },
        { id: 'p6', text: 'Invalid or expired agency licenses are not caught consistently' }
      ],
      approach: ['Producer onboarding integrity checks that define and validate hierarchies and remove duplicates', 'Real-time license validation through API integration with agency licensing portals'],
      accelerators: ['Producer Onboarding Integrity Checker', 'Real-Time License Validator'],
      outcomes: ['70% less rework in policy ingestion and producer onboarding', '50% faster quote-to-bind and straight-through processing']
    },
    {
      id: 'digital', name: 'Unified Digital Engagement', sub: 'Portals and user experience',
      cost: '$20K \u2013 $30K per line of business',
      costUnit: 'line of business', costDriver: 'Quote, bind and service journeys are configured and tested for each line of business.',
      problems: [
        { id: 'p7', text: 'We run separate portals for different business units and user groups' },
        { id: 'p8', text: 'Agents, underwriters and customers get an inconsistent experience and fragmented workflows' }
      ],
      approach: ['One digital platform with a consistent experience for underwriters, agents and customers', 'API and orchestration layer on a canonical policy model for retrieving and updating policy data'],
      accelerators: ['Unified Digital Workbench'],
      outcomes: ['30% faster business user adoption', 'A consistent, scalable digital experience across channels']
    },
    {
      id: 'ams', name: 'Agency Management System Integration', sub: 'Distribution feeds such as IVANS',
      cost: '$30K \u2013 $40K per line of business',
      costUnit: 'line of business', costDriver: 'Agency download and feed mappings (for example ACORD AL3) are built and certified for each line of business.',
      problems: [
        { id: 'p9', text: 'We will have to recertify policy data feeds to agencies and distribution platforms such as IVANS' },
        { id: 'p10', text: 'Moving to a cloud-hosted PAS puts our agency and distribution feeds at risk during cutover' }
      ],
      approach: ['Data translation layer that converts new PAS data into the legacy format', 'Avoids recertification and keeps the transition in step with the cloud migration timeline'],
      accelerators: ['AMS Data Translator'],
      outcomes: ['Stable, uninterrupted operations through a phased PAS modernization', 'External dependencies decoupled from the PAS']
    },
    {
      id: 'compliance', name: 'Compliance & Regulatory Reporting', sub: 'State and statistical reporting',
      cost: '$80K \u2013 $90K per business unit',
      costUnit: 'business unit', costDriver: 'Bureau and state certification, filings and golden baselines are managed for each business unit.',
      regulatory: true,
      problems: [
        { id: 'p11', text: 'Adding lines of business or business units changes the data behind state and statistical reports' },
        { id: 'p12', text: 'We risk late or rejected bureau and state filings (for example WCPOLS) after the move' }
      ],
      approach: ['Compliance built into line and state configuration, with certification and re-certification managed (for example WCPOLS)', 'Certified regulatory and statistical feeds protected with golden-submission baselines'],
      accelerators: ['Compliance Workbench', 'Reg Report Guardian'],
      outcomes: ['80% reduction in regulatory and statistical compliance risk', 'Faster onboarding of new lines and states']
    },
    {
      id: 'hypercare', name: 'Hypercare & Utilization Enablement', sub: 'Go-live, pricing and renewals',
      cost: '$80K \u2013 $90K per business unit',
      costUnit: 'business unit', costDriver: 'Neutrality testing and go-live support are run for each business unit as it moves to the new PAS.',
      problems: [
        { id: 'p13', text: 'Pricing and eligibility may differ in the new PAS, which hurts business confidence' },
        { id: 'p14', text: 'Creating renewals in the new PAS takes too long and risks missed SLAs' }
      ],
      approach: ['Neutrality testing using future renewal policies', 'Continuous validation of PAS interactions across the wider P&C ecosystem', 'Automated policy renewal migration'],
      accelerators: ['AI-driven Rating & Forms Comparison', 'Hypercare Framework'],
      outcomes: ['Business confidence built by validating underwriting outcomes', 'Operational continuity protected at go-live']
    }
  ];

  var PROBLEMS = [];
  AREAS.forEach(function (a) { a.problems.forEach(function (p) { PROBLEMS.push({ id: p.id, area: a.id, text: p.text }); }); });
  var MAX_AREA = 2 * IMPACT.high.w;                 // 6
  var MAX_TOTAL = PROBLEMS.length * IMPACT.high.w;  // 42

  // Overall risk exposure bands (0-100).
  var BANDS = [
    { min: 60, key: 'critical', label: 'Critical', note: 'Several areas are likely to delay go-live or add cost. Plan remediation before the build starts.' },
    { min: 35, key: 'high', label: 'High', note: 'More than one area needs a clear plan before the build starts.' },
    { min: 15, key: 'moderate', label: 'Moderate', note: 'A few focused fixes will remove most of the risk.' },
    { min: 0, key: 'low', label: 'Low', note: 'Few known problems. Confirm with side-by-side testing before go-live.' }
  ];
  function bandFor(s) { for (var i = 0; i < BANDS.length; i++) if (s >= BANDS[i].min) return BANDS[i]; }

  // Area match strength.
  function fitFor(s) {
    if (s >= 67) return { key: 'strong', label: 'High priority' };
    if (s >= 34) return { key: 'good', label: 'Medium priority' };
    if (s > 0) return { key: 'partial', label: 'Low priority' };
    return { key: 'none', label: 'Not selected' };
  }

  /* selections: { p1: 'low'|'medium'|'high', ... }  Missing or invalid = not selected. */
  function match(selections) {
    selections = selections || {};
    var order = AREAS.map(function (a) { return a.id; });
    var selected = 0, total = 0;
    var areas = AREAS.map(function (a) {
      var pts = 0, hits = [];
      a.problems.forEach(function (p) {
        var lv = selections[p.id];
        if (!IMPACT[lv]) return;
        pts += IMPACT[lv].w; selected++; hits.push({ id: p.id, text: p.text, impact: lv, impactLabel: IMPACT[lv].label });
      });
      total += pts;
      var s = Math.round(pts / MAX_AREA * 100);
      return {
        id: a.id, name: a.name, sub: a.sub, score: s, points: pts, fit: fitFor(s), hits: hits,
        cost: a.cost, costUnit: a.costUnit, costDriver: a.costDriver, regulatory: !!a.regulatory, approach: a.approach, accelerators: a.accelerators, outcomes: a.outcomes
      };
    });
    var ranked = areas.slice().sort(function (x, y) {
      return y.score - x.score || y.hits.length - x.hits.length || order.indexOf(x.id) - order.indexOf(y.id);
    }).map(function (a, i) { return Object.assign({}, a, { rank: i + 1 }); });
    var exposure = Math.round(total / MAX_TOTAL * 100);
    // Severity floor: a single severe problem must not be averaged away.
    // Any High-impact regulatory problem = at least High band; any other High-impact problem = at least Moderate.
    var band = bandFor(exposure), floor = null;
    var regHigh = PROBLEMS.some(function (p) { return selections[p.id] === 'high' && AREAS.filter(function (a) { return a.id === p.area; })[0].regulatory; });
    var anyHigh = PROBLEMS.some(function (p) { return selections[p.id] === 'high'; });
    var rank = function (b) { return ['low', 'moderate', 'high', 'critical'].indexOf(b.key); };
    var byKey = function (k) { return BANDS.filter(function (b) { return b.key === k; })[0]; };
    if (regHigh && rank(band) < rank(byKey('high'))) {
      floor = 'regulatory';
      band = Object.assign({}, byKey('high'), { note: 'A high-impact regulatory reporting problem can delay go-live on its own. Plan for it before the build starts.' });
    } else if (anyHigh && rank(band) < rank(byKey('moderate'))) {
      floor = 'severe';
      band = Object.assign({}, byKey('moderate'), { note: 'You have at least one high-impact problem. A focused fix for it will remove most of the risk.' });
    }
    var matched = ranked.filter(function (a) { return a.score > 0; });
    return {
      version: VERSION, selected: selected, totalProblems: PROBLEMS.length,
      exposure: exposure, band: band, floor: floor,
      floorNote: floor === 'regulatory' ? 'Raised to High because you rated a regulatory reporting problem as high impact.' : floor === 'severe' ? 'Raised to Moderate because you rated at least one problem as high impact.' : '',
      areas: areas, ranked: ranked, matched: matched, top: matched.slice(0, 3),
      highImpact: PROBLEMS.filter(function (p) { return selections[p.id] === 'high'; }).length
    };
  }

  return { VERSION: VERSION, IMPACT: IMPACT, AREAS: AREAS, PROBLEMS: PROBLEMS, BANDS: BANDS, match: match };
});
