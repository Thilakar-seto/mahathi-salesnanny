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
                'Databricks Lakehouse combines the reliability and governance of data warehouses with the scale and cost-efficiency of data lakes. You get ACID transactions, schema enforcement, and SQL analytics at petabyte scale without the cost of traditional warehouses like Redshift or Snowflake.',
            ],
        ],
        [
            'question' => 'How long does a Databricks implementation take?',
            'answerParas' => [
                'Typical implementations span 8-12 weeks depending on data volume, complexity, and integrations needed. Discovery: 2-3 weeks. Architecture & pilot: 3-4 weeks. Migration: 2-3 weeks. Hardening & go-live: 1-2 weeks. Mahathi has migrated 2.5B+ records with zero downtime.',
            ],
        ],
        [
            'question' => 'Is there downtime during data migration?',
            'answerParas' => [
                'No. Mahathi uses Change Data Capture (CDC) for bi-directional sync during the migration window. You continue processing claims and eligibility requests. We synchronize at cutover, typically a 30-60 minute validation window, not hours or days.',
            ],
        ],
        [
            'question' => 'How does Databricks handle compliance (HIPAA, SOC 2)?',
            'answerParas' => [
                'Databricks has inherent HIPAA and SOC 2 compliance. We layer on additional security: VPC isolation, CMK encryption, audit logging for all data access, PII masking, and row/column-level access control. Your security and compliance teams remain in control.',
            ],
        ],
        [
            'question' => 'What about data governance and PII protection?',
            'answerParas' => [
                'Unity Catalog provides comprehensive governance. Automated PII detection and masking. Sensitive data tags. Access control by role, department, or individual. Complete audit trails for all queries and data access. Lineage tracking from source to destination.',
            ],
        ],
        [
            'question' => 'Can we continue using existing BI tools?',
            'answerParas' => [
                'Yes. Databricks connects natively to Tableau, Power BI, Looker, QlikView, and other tools via standard SQL connectors. No tool replacement needed. Your analysts continue using familiar interfaces on faster, cheaper infrastructure.',
            ],
        ],
        [
            'question' => 'How much will this cost?',
            'answerParas' => [
                'Databricks typically costs 60-70% less than legacy data warehouses like Redshift or Snowflake due to shared compute, storage optimization, and auto-scaling. Implementation varies by scope: $200K-$500K for enterprise deployments. We provide detailed cost modeling during discovery.',
            ],
        ],
        [
            'question' => 'What happens after go-live? Does Mahathi stick around?',
            'answerParas' => [
                'Yes. We offer managed services (24/7 support, monitoring, optimization), training, and ongoing optimization. Most clients retain us post-implementation for performance tuning, new feature adoption, and quarterly health checks.',
            ],
        ],
    ],
];
