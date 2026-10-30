<?php
/**
 * Data for the <app-databricks> component.
 */
return [
    'badgeSrc' => '/assets/images/bronze-badge.png',
    'heroImageSrc' => '/assets/images/databricks-hero-data.webp',
    'heroImageAlt' => 'Team reviewing analytics dashboards and performance charts on a unified data platform',
    'stats' => [
        ['value' => 'Bronze', 'accent' => '', 'title' => 'Databricks partner tier', 'desc' => 'Recognized in 2026 as a Databricks Bronze partner, the first tier of the Brickbuilder Partner Network.'],
        ['value' => '350', 'accent' => '+', 'title' => 'P&C Insurance Domain Experts', 'desc' => 'Practitioners across claims, policy, billing, underwriting, compliance and TPA programs who shape the data model.'],
        ['value' => '40', 'accent' => '+', 'title' => 'Guidewire Programs Delivered', 'desc' => 'Guidewire ClaimCenter, PolicyCenter and BillingCenter data knowledge goes into every Lakehouse design.'],
    ],
    'pills' => ['Lakehouse Implementation', 'Data Migration', 'Analytics', 'AI & ML', 'Governance', 'Managed Operations'],
    'capabilities' => [
        [
            'iconKey' => 'lakehouse',
            'title' => 'Lakehouse Implementation',
            'lead' => 'Stand up a governed Databricks Lakehouse for claims, policy, billing and member data.',
            'points' => [
                'Layered data model from raw to curated tables',
                'Delta Lake tables for claims, policy and billing',
                'Ingestion from core systems, vendors and files',
                'Workspace, cluster and cost-control setup',
                'Handover with runbooks and documentation',
            ],
            'proof' => 'Data model shaped by insurance practitioners',
        ],
        [
            'iconKey' => 'migration',
            'title' => 'Data Migration',
            'lead' => 'Move legacy warehouse and data mart workloads to Databricks without stopping daily operations.',
            'points' => [
                'Warehouse and ETL assessment',
                'Phased migration by business domain',
                'Parallel runs with reconciliation',
                'Cutover planning and rollback plan',
                'Retirement of legacy jobs',
            ],
            'proof' => 'Reconciliation built into every phase',
        ],
        [
            'iconKey' => 'analytics',
            'title' => 'Claims and Underwriting Analytics',
            'lead' => 'Give adjusters, underwriters and claims leaders current data instead of last night\'s batch.',
            'points' => [
                'Cycle time, leakage and reserve dashboards',
                'Referral and quote-to-bind views for underwriting',
                'Streaming ingestion from claim and policy events',
                'Loss and severity analytics',
                'Connection to Power BI, Tableau and Looker',
            ],
            'proof' => 'Built for claims, underwriting and risk teams',
        ],
        [
            'iconKey' => 'ai',
            'title' => 'Agentic AI and Machine Learning',
            'lead' => 'Apply machine learning and generative AI to claims, SIU and underwriting where the data already sits.',
            'points' => [
                'Fraud and SIU referral scoring',
                'Claims triage and severity models',
                'Summaries of documents and correspondence',
                'Copilots for adjusters and underwriters',
                'Model monitoring with human review steps',
            ],
            'proof' => 'Human review stays in the loop',
        ],
        [
            'iconKey' => 'governance',
            'title' => 'Governance and Compliance',
            'lead' => 'Control who sees what, and show auditors where every number came from.',
            'points' => [
                'Unity Catalog access control',
                'Row-level and column-level security',
                'PII tagging and masking',
                'Audit logs and data lineage',
                'Alignment to HIPAA, SOC 2 and state data rules',
            ],
            'proof' => 'Audit-ready from the first release',
        ],
        [
            'iconKey' => 'managed',
            'title' => 'Managed Databricks Operations',
            'lead' => 'Run the Lakehouse after go-live, with monitoring, tuning and cost control.',
            'points' => [
                'Job and pipeline monitoring',
                'Performance and cluster tuning',
                'Cost and usage reporting',
                'Release and platform change management',
                'Support under agreed service levels',
            ],
            'proof' => 'Run by the team that built it',
        ],
    ],
    'challenges' => [
        ['iconKey' => 'lock', 'title' => 'Core data stays locked in the core', 'desc' => 'Claims, policy and billing data sit inside Guidewire, Duck Creek and legacy systems. Reports come from nightly extracts, and every team keeps its own version of the numbers.'],
        ['iconKey' => 'clock', 'title' => 'Claims and underwriting run on yesterday\'s data', 'desc' => 'Adjusters and underwriters wait for batch reports. Severity changes, referrals and reserve movement show up after the decision window has closed.'],
        ['iconKey' => 'warning', 'title' => 'AI pilots stall on governance', 'desc' => 'Models get built in notebooks outside a controlled platform. Carriers then cannot show regulators where data came from or who used it, so pilots never reach production.'],
    ],
    'solutions' => [
        ['num' => '01', 'title' => 'Unify core data without disrupting the core.', 'body' => 'Mahathi maps claims, policy and billing data from the core platforms, lands it on the Lakehouse in layers, and reconciles every phase against source. Daily operations keep running while the new platform takes over reporting.', 'proofNum' => '40+', 'proofText' => 'Guidewire programs delivered, with ClaimCenter, PolicyCenter and BillingCenter data knowledge'],
        ['num' => '02', 'title' => 'Put current data in front of claims and underwriting.', 'body' => 'Streaming ingestion and curated tables give adjusters, underwriters and claims leaders a live view of cycle time, leakage and referrals, in the BI tools they already use.', 'proofNum' => '1', 'proofText' => 'governed source for claims, policy and billing reporting'],
        ['num' => '03', 'title' => 'Take AI from pilot to production, with controls.', 'body' => 'Models, prompts and data stay inside one governed platform, with access control, lineage and human review steps. Insurance practitioners check the rules and outputs before anything reaches a claim file.', 'proofNum' => '350+', 'proofText' => 'P&C domain experts available to review models, rules and outputs'],
    ],
    'faqs' => [
        [
            'question' => 'What does Databricks Bronze partner status mean for Mahathi?',
            'answerParas' => [
                'Mahathi was recognized as a Databricks Bronze partner in 2026. Bronze is the first tier of the Databricks Brickbuilder Partner Network, which now runs four tiers: Bronze, Silver, Gold and Platinum.',
                'A tier shows active partnership with Databricks. It does not replace a delivery check, so Mahathi shares the named practitioners and relevant insurance experience for your project during scoping.',
            ],
        ],
        [
            'question' => 'Can Mahathi migrate our data warehouse to Databricks without stopping claims operations?',
            'answerParas' => [
                'Mahathi plans migrations in phases by business domain, runs old and new platforms in parallel, and reconciles results before each cutover.',
                'Timelines and any cutover window depend on data volume, source systems and your release calendar. Mahathi sets both during discovery instead of promising a fixed number up front.',
            ],
        ],
        [
            'question' => 'How long does a Databricks implementation take?',
            'answerParas' => [
                'Most programs start with one domain, such as claims or underwriting reporting, and expand in releases. The first release is scoped in discovery based on source systems, data quality and governance needs.',
                'Mahathi gives a plan with milestones and named owners before build starts, so your team knows what arrives and when.',
            ],
        ],
        [
            'question' => 'Does Mahathi connect Databricks to Guidewire and other core systems?',
            'answerParas' => [
                'Yes. Mahathi connects Databricks to Guidewire ClaimCenter, PolicyCenter and BillingCenter, and to Duck Creek, Fiserv, TPA platforms, mailroom feeds and vendor files.',
                'Ingestion uses the pattern that fits each source, such as APIs, events or scheduled files, with quality checks at every step.',
            ],
        ],
        [
            'question' => 'How does Mahathi handle governance and sensitive data on Databricks?',
            'answerParas' => [
                'Mahathi uses Unity Catalog for access control, row-level and column-level security, PII tagging and masking, audit logs and lineage. Sensitive claim and member data stays inside your cloud environment.',
                'Mahathi works with your security and compliance teams to align the design with HIPAA, SOC 2 and the state and NAIC requirements that apply to you.',
            ],
        ],
        [
            'question' => 'What happens after go-live?',
            'answerParas' => [
                'Mahathi offers managed Databricks operations, including pipeline monitoring, performance tuning, cost reporting and release management under agreed service levels.',
                'Many carriers keep the same team for the next release, so each new use case builds on the data model already in place.',
            ],
        ],
    ],
];
