<?php
/**
 * Data for the <app-v2-databricks> component (Version 2 design).
 * Hero image is carried over from the earlier version; the FAQ also feeds the FAQPage schema.
 */
return [
    'heroImageSrc' => '/assets/images/databricks-hero-data.webp',
    'heroImageAlt' => 'Team reviewing analytics dashboards and performance charts on a unified data platform',
    'badgeSrc' => '/assets/images/bronze-badge.png',
    'faqs' => [
        [
            'question' => 'What is the difference between Databricks and a traditional data warehouse?',
            'answerParas' => [
                'Databricks Lakehouse brings reporting, governance and AI onto one platform. In one engagement, four operating units that each ran a separate warehouse moved to one Lakehouse, built on the Medallion architecture and governed in Unity Catalog.',
            ],
        ],
        [
            'question' => 'How long does a Databricks implementation take?',
            'answerParas' => [
                'Timelines depend on scope. A Databricks readiness assessment took 8 weeks from assessment to an approved, phased roadmap, mapping 150+ jobs and reports.',
            ],
        ],
        [
            'question' => 'How do you prove the migrated numbers match?',
            'answerParas' => [
                'We check three levels of proof on every data load: completeness, accuracy and business meaning. Every converted query must give the same answer as legacy, and business owners verify the KPIs they rely on.',
            ],
        ],
        [
            'question' => 'How does Mahathi find out why a number is off?',
            'answerParas' => [
                'AI and data lineage show why. The issue goes to its owner with full context, and only the affected data is re-run.',
            ],
        ],
        [
            'question' => 'What about data governance?',
            'answerParas' => [
                'Unity Catalog provides governance. Every table has audit-ready proof behind each sign-off, and the sign-off dashboard shows match status for every table in one live view.',
            ],
        ],
        [
            'question' => 'Can we continue using existing BI tools?',
            'answerParas' => [
                'Reports can be rebuilt on Databricks SQL and validated with business users. In one engagement, 400+ SSRS reports were rebuilt in Power BI on Databricks SQL, and refresh time dropped from hours to minutes.',
            ],
        ],
        [
            'question' => 'How much will this cost?',
            'answerParas' => [
                'Cost depends on scope. For one Fortune 500 enterprise, consolidating four operating units on one Lakehouse brought 75% lower platform cost. A readiness assessment sizes migration cost and risk before you commit.',
            ],
        ],
        [
            'question' => 'What does Mahathi bring from week one?',
            'answerParas' => [
                'The same process and tools from week one: a data match engine, an AI SQL converter, an AI root-cause finder and a sign-off dashboard, so go-live stays on track.',
            ],
        ],
    ],
];
