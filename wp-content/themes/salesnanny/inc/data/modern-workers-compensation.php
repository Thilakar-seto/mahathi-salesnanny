<?php
/**
 * Data for the <app-modern-workers-compensation> component (Version 1 design).
 * `sections` is rendered in order by template-parts/service-sections.php.
 */
return [
    'heroImageSrc' => '/assets/images/workers_compensation.jpg',
    'heroImageAlt' => 'Claims team reviewing a workers’ compensation claim file together',
    'hero' => [
        'eyebrow' => 'WORKERS’ COMPENSATION CLAIMS MANAGEMENT & SERVICES',
        'title' => 'Modern Workers’ Compensation, Simplified',
        'sub' => 'Mahathi helps carriers, employers, self-insured organizations, TPAs, MGAs and PEOs modernize and manage workers’ compensation across the policy and claims lifecycle, with technology, automation and insurance operations delivered together.',
        'cta' => 'Talk to a Workers’ Comp Expert',
    ],
    'sections' => [
        [
            'type' => 'numbers',
            'label' => 'Mahathi workers’ compensation proof points',
            'items' => [
                ['value' => '30', 'accent' => '+', 'title' => 'Carriers supported'],
                ['value' => '350', 'accent' => '+', 'title' => 'P&C domain experts'],
                ['value' => '96', 'accent' => '%', 'title' => 'Client satisfaction'],
                ['value' => '95', 'accent' => '%', 'title' => 'SLA performance'],
            ],
        ],
        [
            'type' => 'challenges',
            'cols' => 3,
            'title' => 'Why Workers’ Compensation Stays Difficult to Manage',
            'intro' => 'Carriers and employers both carry the cost of claims, but the information needed to manage them is spread across portals, spreadsheets, vendor systems and email.',
            'items' => [
                ['iconKey' => 'grid', 'title' => 'No single view of the program', 'desc' => 'Claims, medical, vendor and policy data sit in separate places. Basic questions about severity, stalled claims and medical spend take too long to answer.'],
                ['iconKey' => 'clock', 'title' => 'Skilled people lose time to admin', 'desc' => 'Adjusters, nurses, underwriters and risk teams spend their days finding documents, updating systems, chasing information and resolving exceptions.'],
                ['iconKey' => 'clipboard', 'title' => 'Compliance runs through every process', 'desc' => 'Reporting requirements apply from underwriting to claim closure. The hard part is often the failed submission, not the transaction itself.'],
                ['iconKey' => 'link', 'title' => 'Vendors managed without common data', 'desc' => 'Carriers and employers may use dozens or hundreds of service providers. Without one view of referrals, performance, capacity and cost, decisions become inconsistent.'],
                ['iconKey' => 'layers', 'title' => 'Business and technology work in silos', 'desc' => 'Technology programs focus on systems and BPO programs focus on people. Workers’ compensation transformation needs both working together.'],
                ['iconKey' => 'alert', 'title' => 'Employers carry the cost', 'desc' => 'Even when a carrier or TPA administers the claim, the employer still bears the financial and operational effect of injuries and lost time.'],
            ],
        ],
        [
            'type' => 'capabilities',
            'id' => 'capabilities',
            'title' => 'Mahathi Workers’ Compensation Capabilities',
            'sub' => 'We pair insurance domain expertise with technology and business operations, so the system change and the operating change land together.',
            'cards' => [
                ['iconKey' => 'doc', 'title' => 'Claims Management, FNOL to Closure', 'lead' => 'Intake, claim setup, document indexing, back-office queues, reserves and legal requests across the many parties in a claim.', 'points' => ['FNOL and state or program claim setup', 'Document intake and indexing', 'Reserve changes and payment ledgers']],
                ['iconKey' => 'users', 'title' => 'Claims Service & Vendor Orchestration', 'lead' => 'Route each claim to the right provider by jurisdiction, severity and capacity, then track turnaround, quality and spend.', 'points' => ['Assignment by jurisdiction and specialty', 'Vendor performance and utilization', 'Claims expense analytics']],
                ['iconKey' => 'pulse', 'title' => 'Medical & Pharmacy Management', 'lead' => 'Control medical cost while supporting appropriate care, with bill review, utilization review and PBM integration in one workflow.', 'points' => ['Medical bill review workflows', 'Utilization review and provider panels', 'PBM and drug-utilization monitoring']],
                ['iconKey' => 'mail', 'title' => 'Digital Mailroom & Document Intelligence', 'lead' => 'Capture, extract, classify and route incoming documents, so the time between receiving information and acting on it gets shorter.', 'points' => ['Email and fax processing', 'Automated workflow initiation', 'Full audit history']],
                ['iconKey' => 'clipboard', 'title' => 'Regulatory & Compliance Reporting', 'lead' => 'Statutory submissions with validation, correction and resubmission, including the reporting that connects employers to the system.', 'points' => ['FROI and SROI reporting', 'Employer Proof of Coverage and WCPOLS', 'Submission validation and resubmission']],
                ['iconKey' => 'home', 'title' => 'Guidewire Core Systems', 'lead' => 'Implementation, cloud migration, data conversion and integration for Guidewire ClaimCenter, PolicyCenter and BillingCenter.', 'points' => ['Core platform implementation and cloud migration', 'Data migration and PAS integration', 'Test automation and application support']],
            ],
        ],
        [
            'type' => 'solutions',
            'cols' => 4,
            'title' => 'Built for Carriers, Employers and TPAs',
            'intro' => 'The same program looks different to each participant. These are the services we deliver most often, by role.',
            'items' => [
                ['title' => 'Claims oversight', 'body' => 'Employers see open and closed claims, severity, litigation, reserves and return-to-work status in one view.'],
                ['title' => 'Carrier & TPA coordination', 'body' => 'Status requests, documents and escalations tracked across every partner in the claim.'],
                ['title' => 'Loss & claims analytics', 'body' => 'Frequency, severity, high-cost claims and provider utilization for Risk, Safety and Finance.'],
                ['title' => 'Return to work', 'body' => 'Work-status tracking, restrictions, milestones and employer follow-up to shorten claim duration.'],
                ['title' => 'Underwriting & policy', 'body' => 'Submission triage, renewals, endorsements, rerating and class code updates in one workbench.'],
                ['title' => 'Billing & premium audit', 'body' => 'Cash application, returned payments, premium adjustments, state breakdowns and EMOD worksheets.'],
                ['title' => 'Employer self-service', 'body' => 'Claim reporting, claim status, certificates of insurance and payroll reporting without a phone call.'],
                ['title' => 'Loss control', 'body' => 'Inspections, hazard identification and injury-frequency analysis that start before a claim occurs.'],
            ],
        ],
        [
            'type' => 'challenges',
            'cols' => 4,
            'title' => 'Who We Serve',
            'intro' => 'Workers’ compensation involves many organizations with different responsibilities. We support each one with the services that match its role.',
            'items' => [
                ['iconKey' => 'home', 'title' => 'Workers’ comp carriers', 'desc' => 'Core operations, claims, policy administration and compliance.'],
                ['iconKey' => 'users', 'title' => 'Employers & risk teams', 'desc' => 'Visibility and control over claims, vendors, losses and return to work.'],
                ['iconKey' => 'shield', 'title' => 'Self-insured employers', 'desc' => 'Operational, financial, claims and reporting responsibilities.'],
                ['iconKey' => 'doc', 'title' => 'TPAs & claims administrators', 'desc' => 'Claims operations, workflow efficiency and client servicing.'],
                ['iconKey' => 'grid', 'title' => 'PEOs', 'desc' => 'Policy, payroll, billing and claims complexity handled as one.'],
                ['iconKey' => 'layers', 'title' => 'MGAs & MGUs', 'desc' => 'Underwriting, policy administration, portals and integrations.'],
                ['iconKey' => 'pulse', 'title' => 'Managed care & PBMs', 'desc' => 'Medical management connected into carrier and claims workflows.'],
                ['iconKey' => 'link', 'title' => 'Claims service providers', 'desc' => 'Assignments, status, documents and performance in one connected flow.'],
            ],
        ],
        [
            'type' => 'solutions',
            'cols' => 4,
            'title' => 'Why Choose Mahathi for Workers’ Compensation',
            'intro' => 'Technology and business services from one team, built around how workers’ compensation actually operates.',
            'items' => [
                ['title' => 'Domain depth', 'body' => '350+ P&C insurance domain experts across claims administration, policy operations, compliance and core platforms.'],
                ['title' => 'Process and technology together', 'body' => 'We implement the platform, redesign the workflow and support selected business processes, so the change holds after go-live.'],
                ['title' => 'Disciplined delivery', 'body' => '95% SLA performance across technology, managed services and operational support.'],
                ['title' => 'Long-term partnerships', 'body' => '30+ carriers supported over more than a decade, with a client-centric model focused on measurable outcomes.'],
            ],
        ],
        [
            'type' => 'outcomes',
            'cols' => 2,
            'title' => 'Proven Workers’ Compensation Experience',
            'intro' => 'Two engagements that show how we work with carriers and medical-management organizations.',
            'cards' => [
                ['iconKey' => 'layers', 'tag' => 'CLAIMS TRANSFORMATION', 'title' => 'Bringing an assigned-risk book into a voluntary operation', 'paras' => ['A carrier needed to integrate a significant assigned-risk workers’ comp book, written across multiple states, into an existing voluntary operation.', 'Mahathi led configuration, integration, claims data migration and operational enablement, and set up a common ClaimCenter foundation.'], 'proof' => 'Result: one claims platform for operations that were previously separate.'],
                ['iconKey' => 'chart', 'tag' => 'PREDICTIVE ANALYTICS', 'title' => 'Predictive models built into ClaimCenter', 'paras' => ['Mahathi supported a major medical-management organization with predictive models integrated into Guidewire ClaimCenter.', 'Use cases included surgery prediction, pharmacy management, early intervention, resource allocation and cost-containment support.'], 'proof' => 'Result: earlier view of emerging claim risk and more chances to intervene.'],
            ],
        ],
        [
            'type' => 'faq',
            'title' => 'Frequently Asked Questions',
        ],
        [
            'type' => 'cta',
            'items' => [
                ['eyebrow' => 'GET IN TOUCH', 'title' => 'Speak to our Workers’ Compensation team', 'text' => 'Tell us which part of your program is hardest to manage: claims oversight, vendor coordination, billing exceptions, compliance reporting or the core system. We will come back with the questions needed to scope the work.', 'button' => 'Get in touch'],
                ['eyebrow' => 'COST. SPEED. OUTCOMES.', 'title' => 'Modernize workers’ compensation from risk to claim outcome', 'text' => 'Whether you are a carrier administering workers’ compensation, an employer managing your program, a self-insured organization taking ownership of risk, or a TPA managing claims, Mahathi connects the people, processes, data and technology behind better outcomes.', 'button' => 'Speak to our Workers’ Compensation team'],
            ],
        ],
    ],
    // FAQ items stay top-level: inc/seo.php reads them for the FAQPage schema.
    'faqs' => [
        ['question' => 'Does Mahathi work directly with employers?', 'answerParas' => ['Yes. We work with employers and Risk Management teams on claims oversight, TPA and carrier coordination, vendor management, analytics, return-to-work workflows, policy and premium administration and digital self-service. We complement your existing carrier, TPA and broker relationships.']],
        ['question' => 'Does an employer need to be self-insured to work with Mahathi?', 'answerParas' => ['No. We support traditional insured programs as well as self-insured employers. The services depend on which responsibilities sit with you, your carrier, your TPA or other partners.']],
        ['question' => 'Can Mahathi give employers better visibility into claims managed by a carrier or TPA?', 'answerParas' => ['Yes. We build portals, dashboards, analytics and integrations that give Risk teams one consolidated view, reducing reliance on multiple portals, spreadsheets and manual reports.']],
        ['question' => 'Can Mahathi help employers manage workers’ compensation vendors?', 'answerParas' => ['Yes. We support service-provider assignment, coordination, utilization management, performance measurement and spend visibility for medical management, pharmacy, investigations, transportation, translation, legal support and records.']],
        ['question' => 'Can Mahathi support both technology and operations?', 'answerParas' => ['Yes. We cover technology and business operations across underwriting, policy administration, billing, audit, compliance, claims, medical management and back-office work. You can engage us for a technology project, an operational process, or both together.']],
        ['question' => 'Can Mahathi work with our existing core insurance systems?', 'answerParas' => ['Yes. We work across Guidewire and other policy, claims, billing, rating, document and third-party platforms. The goal is to improve the whole workflow, not to force every process into one system.']],
        ['question' => 'Does Mahathi support workers’ compensation regulatory reporting?', 'answerParas' => ['Yes. We support FROI, SROI, Employer Proof of Coverage, WCPOLS, CMS, medical and billing reporting, state and bureau reporting, submission validation and exception handling.']],
    ],
];
