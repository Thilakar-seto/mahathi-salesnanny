<?php
/**
 * Data for the <app-databricks> component (Version 1 design).
 * `sections` is rendered in order by template-parts/service-sections.php.
 */
return [
    'badgeSrc' => '/assets/images/bronze-badge.png',
    'heroImageSrc' => '/assets/images/databricks-hero-data.webp',
    'heroImageAlt' => 'Team reviewing analytics dashboards and performance charts on a unified data platform',
    'hero' => [
        'eyebrow' => 'DATABRICKS BRONZE PARTNER',
        'title' => 'Enterprise Databricks Implementation & Migration Services',
        'sub' => 'Transform fragmented legacy data infrastructure into a unified, AI-ready Lakehouse. Mahathi delivers Databricks migration, reconciliation and AI-assisted reporting for enterprise data teams. Multiple enterprise engagements delivered on Databricks.',
        'cta' => 'Talk to a Databricks Expert',
    ],
    'sections' => [
        [
            'type' => 'numbers',
            'label' => 'Mahathi Databricks proof points',
            'items' => [
                ['value' => '4→1', 'accent' => '', 'title' => 'Operating units on one platform'],
                ['value' => '1,200', 'accent' => '+', 'title' => 'Queries tested against legacy'],
                ['value' => '35', 'accent' => '+', 'title' => 'Sources reconciled on every load'],
                ['value' => '75', 'accent' => '%', 'title' => 'Lower platform cost (Fortune 500 case)'],
            ],
        ],
        [
            'type' => 'challenges',
            'cols' => 3,
            'title' => 'Industry Challenges That Databricks Solves',
            'intro' => 'Enterprises face critical data infrastructure gaps. Legacy warehouses create operational silos, slow decision-making, and escalate costs. Databricks transforms these challenges into competitive advantage through a unified Lakehouse architecture.',
            'items' => [
                ['iconKey' => 'database', 'title' => 'Fragmented Data Silos', 'desc' => 'Separate warehouses fed by many source systems, each reporting different numbers. No unified source of truth. Manual data reconciliation wastes time and creates inconsistencies.'],
                ['iconKey' => 'clock', 'title' => 'Slow Reporting', 'desc' => 'Hundreds of legacy reports take hours to refresh. Teams spend much of their week preparing and checking data by hand.'],
                ['iconKey' => 'chart', 'title' => 'Unknown Migration Risk', 'desc' => 'An aging platform holds large volumes of data, with no clear view of what runs where. Migration cost and risk cannot be sized.'],
                ['iconKey' => 'grid', 'title' => 'Rising Data Costs', 'desc' => 'Each operating unit runs its own warehouse. Platform cost and data duplication grow across units.'],
                ['iconKey' => 'shield', 'title' => 'Numbers That Do Not Match', 'desc' => 'Rounding, blank fields, dates, converted logic, late corrections and mismatched codes change the answer. Every mismatch becomes a debate, sign-off stalls and go-live dates slip.'],
                ['iconKey' => 'chip', 'title' => 'Manual Information Requests', 'desc' => 'Hundreds of information requests a year arrive by email. Each one is researched and answered by hand, often over several days.'],
            ],
        ],
        [
            'type' => 'capabilities',
            'id' => 'capabilities',
            'title' => 'Mahathi Core Databricks Capabilities',
            'plainLead' => true,
            'cards' => [
                ['iconKey' => 'database', 'title' => 'Data Migration to the Lakehouse', 'lead' => 'Consolidate separate warehouses on one Lakehouse, built on the Medallion architecture and governed in Unity Catalog. Legacy SQL is converted with AI and every load is reconciled.', 'points' => ['4 operating units moved to one platform', '75% lower platform cost for a Fortune 500 enterprise']],
                ['iconKey' => 'chart', 'title' => 'Reporting & Analytics on Databricks SQL', 'lead' => 'Curated Gold tables on Delta Lake become one source for reporting. Reports are rebuilt in Power BI on Databricks SQL and validated with business users.', 'points' => ['Report refresh from hours to minutes', '60% less manual effort']],
                ['iconKey' => 'chip', 'title' => 'AI & Query Intelligence', 'lead' => 'AI converts legacy SQL into Databricks SQL, and a query goes live only when it matches legacy output. AI also reads each email request and matches it to the right query, and an analyst reviews the output before it is sent.', 'points' => ['70% of requests matched automatically', 'Request turnaround from days to same day']],
                ['iconKey' => 'shield', 'title' => 'Governance & Audit-Ready Proof', 'lead' => 'Unity Catalog provides unified data governance. Every table carries audit-ready proof from three levels of checks: completeness, accuracy and business meaning.', 'points' => ['Governed in Unity Catalog', 'Audit-ready proof for every table']],
                ['iconKey' => 'link', 'title' => 'Source Integration & Reconciliation', 'lead' => 'Reconcile 35+ source systems on every data load. Record counts, one-to-one ID matching and key-total checks catch missing, extra or changed records the same day, not at go-live.', 'points' => ['35+ sources reconciled on every load', 'Mismatches caught the same day']],
                ['iconKey' => 'server', 'title' => 'Databricks Readiness Assessment', 'lead' => 'Inventory every source, map dependencies across jobs and reports, and build a risk-ranked, phased roadmap, so migration cost and risk can be sized.', 'points' => ['8 weeks from assessment to approved roadmap', '150+ jobs and reports mapped']],
            ],
        ],
        [
            'type' => 'challenges',
            'cols' => 4,
            'title' => 'Why Databricks for Enterprise Data',
            'intro' => 'Databricks Lakehouse Platform addresses the data infrastructure needs of large enterprises, delivering unified architecture, governed data, and AI-assisted reporting.',
            'items' => [
                ['iconKey' => 'layers', 'title' => 'Unified Architecture', 'desc' => 'Single platform for reporting, governance and AI-assisted conversion. Four operating units now run on one Lakehouse instead of four separate warehouses.'],
                ['iconKey' => 'server', 'title' => 'Enterprise Scale', 'desc' => '5M+ transactions a year feed curated Gold tables on Delta Lake, one source for reporting across the business.'],
                ['iconKey' => 'pulse', 'title' => 'Faster Reporting', 'desc' => '400+ SSRS reports rebuilt in Power BI on Databricks SQL. Refresh time dropped from hours to minutes.'],
                ['iconKey' => 'chip', 'title' => 'AI-Assisted Conversion', 'desc' => 'Legacy SQL is converted with AI and tested against legacy output. AI also finds why a number is off, and the owner fixes it.'],
                ['iconKey' => 'chart', 'title' => 'Cost Efficiency', 'desc' => '75% lower platform cost for a Fortune 500 enterprise that moved four operating units onto one Lakehouse.'],
                ['iconKey' => 'shield', 'title' => 'Governance by Design', 'desc' => 'Unity Catalog provides governance across the platform. Every table has audit-ready proof behind sign-off.'],
                ['iconKey' => 'clock', 'title' => 'Evidence-Based Go-Live', 'desc' => 'Reconciliation runs after every data load, so go-live is decided on evidence, not opinion.'],
                ['iconKey' => 'clipboard', 'title' => 'Bronze Partnership', 'desc' => 'Mahathi is an official Databricks Bronze Partner. Multiple enterprise engagements delivered on Databricks, and 40+ practitioners in our Databricks talent pipeline.'],
            ],
        ],
        [
            'type' => 'solutions',
            'cols' => 4,
            'title' => 'Why Choose Mahathi for Databricks Implementation',
            'items' => [
                ['title' => 'Databricks Bronze Partner', 'body' => 'Official Databricks Bronze Partner.'],
                ['title' => 'Multiple Enterprise Engagements', 'body' => 'Delivered on Databricks for a Fortune 500 enterprise, a business division, a public-sector enterprise and a regional segment.'],
                ['title' => 'Reusable Accelerators', 'body' => 'Data match engine, AI SQL converter, AI root-cause finder and sign-off dashboard, reused on every Databricks migration.'],
                ['title' => 'Data and Reporting Expertise', 'body' => '40+ practitioners in our Databricks talent pipeline. Legal and enterprise data and reporting expertise.'],
            ],
        ],
        [
            'type' => 'outcomes',
            'cols' => 2,
            'title' => 'Proven Customer Outcomes',
            'cards' => [
                ['iconKey' => 'layers', 'title' => 'Four Warehouses, One Lakehouse', 'paras' => ['Fortune 500 enterprise, $10B+ annual revenue. Four operating units each ran a separate warehouse, fed by 35+ source systems and 1,200+ legacy queries, and each reported different numbers. Consolidated on one Lakehouse built on the Medallion architecture and governed in Unity Catalog. Result: 4 operating units on 1 platform and 75% lower platform cost.']],
                ['iconKey' => 'chart', 'title' => 'Hours to Minutes Report Refresh', 'paras' => ['Business division, $1B+ annual revenue. 5M+ transactions a year fed 400+ SSRS reports that took hours to refresh. Built curated Gold tables on Delta Lake and rebuilt the reports in Power BI on Databricks SQL. Result: refresh in minutes and 60% less manual effort.']],
                ['iconKey' => 'clock', 'title' => '8 Weeks to an Approved Roadmap', 'paras' => ['Public-sector enterprise, $1B+ annual revenue. An aging platform held 12 TB of data for 500K+ customers. A Databricks readiness assessment mapped 150+ jobs and reports. Result: leadership approved a phased plan in 8 weeks.']],
                ['iconKey' => 'mail', 'title' => 'Days to Same-Day Turnaround', 'paras' => ['Regional segment, 5 companies, $5B+ revenue. 200+ information requests a year were answered by hand over several days. AI matches each email request to a validated query, and an analyst reviews it. Result: same-day turnaround and 70% of requests matched automatically.']],
            ],
        ],
        [
            'type' => 'cta',
            'items' => [
                ['eyebrow' => 'GET IN TOUCH', 'title' => 'Speak to our team', 'text' => 'Interested in learning more about our offerings? Our solutions specialists are ready to help.', 'button' => 'Get in Touch'],
            ],
        ],
        [
            'type' => 'faq',
            'title' => 'Frequently Asked Questions',
            'intro' => 'Common questions about Databricks implementation, migration, and platform capabilities.',
        ],
    ],
    // FAQ items stay top-level: inc/seo.php reads them for the FAQPage schema.
    'faqs' => [
        ['question' => 'What is the difference between Databricks and a traditional data warehouse?', 'answerParas' => ['Databricks Lakehouse brings reporting, governance and AI onto one platform. In one engagement, four operating units that each ran a separate warehouse moved to one Lakehouse, built on the Medallion architecture and governed in Unity Catalog.']],
        ['question' => 'How long does a Databricks implementation take?', 'answerParas' => ['Timelines depend on scope. A Databricks readiness assessment took 8 weeks from assessment to an approved, phased roadmap, mapping 150+ jobs and reports.']],
        ['question' => 'How do you prove the migrated numbers match?', 'answerParas' => ['We check three levels of proof on every data load: completeness, accuracy and business meaning. Every converted query must give the same answer as legacy, and business owners verify the KPIs they rely on.']],
        ['question' => 'How does Mahathi find out why a number is off?', 'answerParas' => ['AI and data lineage show why. The issue goes to its owner with full context, and only the affected data is re-run.']],
        ['question' => 'What about data governance?', 'answerParas' => ['Unity Catalog provides governance. Every table has audit-ready proof behind each sign-off, and the sign-off dashboard shows match status for every table in one live view.']],
        ['question' => 'Can we continue using existing BI tools?', 'answerParas' => ['Reports can be rebuilt on Databricks SQL and validated with business users. In one engagement, 400+ SSRS reports were rebuilt in Power BI on Databricks SQL, and refresh time dropped from hours to minutes.']],
        ['question' => 'How much will this cost?', 'answerParas' => ['Cost depends on scope. For one Fortune 500 enterprise, consolidating four operating units on one Lakehouse brought 75% lower platform cost. A readiness assessment sizes migration cost and risk before you commit.']],
        ['question' => 'What does Mahathi bring from week one?', 'answerParas' => ['The same process and tools from week one: a data match engine, an AI SQL converter, an AI root-cause finder and a sign-off dashboard, so go-live stays on track.']],
    ],
];
