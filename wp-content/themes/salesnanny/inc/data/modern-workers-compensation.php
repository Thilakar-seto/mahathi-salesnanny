<?php
/**
 * Data for the <app-modern-workers-compensation> component.
 */
return [
    'heroImageSrc' => '/assets/images/workers-comp-hero.webp',
    'heroImageAlt' => 'Warehouse team moving palletized goods, representing workplace injury and workers\' compensation claims',
    'stats' => [
        ['value' => '30', 'accent' => '+', 'title' => 'Carriers Supported', 'desc' => 'Long-term partnerships across more than a decade, built around measurable outcomes.'],
        ['value' => '350', 'accent' => '+', 'title' => 'P&C Insurance Domain Experts', 'desc' => 'Practitioners across claims administration, policy operations, compliance and core platforms.'],
        ['value' => '95', 'accent' => '%', 'title' => 'SLA Performance', 'desc' => 'Across technology, managed services and operational support.'],
    ],
    'pills' => ['Claims Management', 'Vendor Orchestration', 'Medical & Pharmacy', 'Digital Mailroom', 'Compliance Reporting', 'Guidewire Core'],
    'capabilities' => [
        [
            'iconKey' => 'claims',
            'title' => 'Claims Management, FNOL to Closure',
            'lead' => 'Run intake, claim setup, document indexing, back-office queues, reserves and legal requests across every party in a claim.',
            'points' => [
                'First notice of loss (FNOL) and state or program claim setup',
                'Document intake and indexing',
                'Reserve changes and payment ledgers',
                'Back-office queue management',
                'Legal request handling',
            ],
            'proof' => 'FNOL to closure in one workflow',
        ],
        [
            'iconKey' => 'vendors',
            'title' => 'Claims Service and Vendor Orchestration',
            'lead' => 'Route each claim to the right provider by jurisdiction, severity and capacity, then track turnaround, quality and spend.',
            'points' => [
                'Assignment by jurisdiction and specialty',
                'Vendor performance and utilization',
                'Claims expense analytics',
                'Capacity-aware routing',
                'Turnaround and quality tracking',
            ],
            'proof' => 'One view of referrals, performance and spend',
        ],
        [
            'iconKey' => 'medical',
            'title' => 'Medical and Pharmacy Management',
            'lead' => 'Control medical cost while supporting appropriate care, with bill review, utilization review and pharmacy benefit manager (PBM) integration in one workflow.',
            'points' => [
                'Medical bill review workflows',
                'Utilization review and provider panels',
                'PBM and drug-utilization monitoring',
                'Nurse case management support',
                'Cost-containment reporting',
            ],
            'proof' => 'Bill review, utilization review and PBM together',
        ],
        [
            'iconKey' => 'mailroom',
            'title' => 'Digital Mailroom and Document Intelligence',
            'lead' => 'Capture, extract, classify and route incoming documents, so the time between receiving information and acting on it gets shorter.',
            'points' => [
                'Email and fax processing',
                'Document classification and extraction',
                'Automated workflow initiation',
                'Routing to the right queue',
                'Full audit history',
            ],
            'proof' => 'Shorter gap between receipt and action',
        ],
        [
            'iconKey' => 'compliance',
            'title' => 'Regulatory and Compliance Reporting',
            'lead' => 'Submit statutory reports with validation, correction and resubmission, including the reporting that connects employers to the system.',
            'points' => [
                'First and Subsequent Reports of Injury (FROI and SROI)',
                'Employer Proof of Coverage and WCPOLS',
                'Submission validation and resubmission',
                'CMS, state and bureau reporting',
                'Exception handling',
            ],
            'proof' => 'Validation and resubmission built in',
        ],
        [
            'iconKey' => 'guidewire',
            'title' => 'Guidewire Core Systems',
            'lead' => 'Implement, migrate, convert data for and integrate Guidewire ClaimCenter, PolicyCenter and BillingCenter.',
            'points' => [
                'Core platform implementation and cloud migration',
                'Data migration and policy admin integration',
                'Test automation and application support',
                'Integration with rating, mailroom and portals',
                'Release-safe configuration',
            ],
            'proof' => '80+ Guidewire-certified resources',
        ],
    ],
    'challenges' => [
        ['iconKey' => 'grid', 'title' => 'No single view of the program', 'desc' => 'Claims, medical, vendor and policy data sit in separate places. Basic questions about severity, stalled claims and medical spend take too long to answer, and the employer still bears the cost.'],
        ['iconKey' => 'clock', 'title' => 'Skilled people lose time to admin', 'desc' => 'Adjusters, nurses, underwriters and risk teams spend their days finding documents, updating systems, chasing information and resolving exceptions instead of managing claims.'],
        ['iconKey' => 'link', 'title' => 'Compliance and vendors run outside the claim record', 'desc' => 'Reporting requirements apply from underwriting to claim closure, and the hard part is often the failed submission. Dozens of vendors work without common data on referrals, performance and cost.'],
    ],
    'solutions' => [
        ['num' => '01', 'title' => 'One claims platform for operations that ran apart.', 'body' => 'A carrier needed to bring a significant assigned-risk workers\' compensation book, written across multiple states, into its voluntary operation. Mahathi led configuration, integration, claims data migration and operational enablement on a common Guidewire ClaimCenter foundation.', 'proofNum' => '1', 'proofText' => 'claims platform for operations that were previously separate'],
        ['num' => '02', 'title' => 'Earlier sight of emerging claim risk.', 'body' => 'For a major medical-management organization, Mahathi supported predictive models integrated into Guidewire ClaimCenter. Use cases included surgery prediction, pharmacy management, early intervention, resource allocation and cost containment.', 'proofNum' => '5', 'proofText' => 'predictive use cases, from surgery prediction to cost containment'],
        ['num' => '03', 'title' => 'Technology and operations from one team.', 'body' => 'Mahathi implements the platform, redesigns the workflow and supports selected business processes, so the change holds after go-live. The team covers underwriting, billing, compliance, claims and medical management.', 'proofNum' => '350+', 'proofText' => 'P&C domain experts across claims, policy, compliance and core platforms'],
    ],
    'faqs' => [
        ['question' => 'Does Mahathi work directly with employers?', 'answerParas' => ['Yes. We work with employers and Risk Management teams on claims oversight, TPA and carrier coordination, vendor management, analytics, return-to-work workflows, policy and premium administration and digital self-service. We complement your existing carrier, TPA and broker relationships.']],
        ['question' => 'Does an employer need to be self-insured to work with Mahathi?', 'answerParas' => ['No. We support traditional insured programs as well as self-insured employers. The services depend on which responsibilities sit with you, your carrier, your TPA or other partners.']],
        ['question' => 'Can Mahathi give employers better visibility into claims managed by a carrier or TPA?', 'answerParas' => ['Yes. We build portals, dashboards, analytics and integrations that give Risk teams one consolidated view, reducing reliance on multiple portals, spreadsheets and manual reports.']],
        ['question' => 'Can Mahathi help employers manage workers\' compensation vendors?', 'answerParas' => ['Yes. We support service-provider assignment, coordination, utilization management, performance measurement and spend visibility for medical management, pharmacy, investigations, transportation, translation, legal support and records.']],
        ['question' => 'Can Mahathi support both technology and operations?', 'answerParas' => ['Yes. We cover technology and business operations across underwriting, policy administration, billing, audit, compliance, claims, medical management and back-office work. You can engage us for a technology project, an operational process, or both together.']],
        ['question' => 'Can Mahathi work with our existing core insurance systems?', 'answerParas' => ['Yes. We work across Guidewire and other policy, claims, billing, rating, document and third-party platforms. The goal is to improve the whole workflow, not to force every process into one system.']],
        ['question' => 'Does Mahathi support workers\' compensation regulatory reporting?', 'answerParas' => ['Yes. We support FROI, SROI, Employer Proof of Coverage, WCPOLS, CMS, medical and billing reporting, state and bureau reporting, submission validation and exception handling.']],
    ],
];
