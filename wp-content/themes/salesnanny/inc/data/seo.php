<?php
/**
 * Per-route SEO data (title, description, share image and JSON-LD schemas).
 */
return [
    '/' => [
        'title' => 'Healthcare & Insurance IT Services',
        'description' => 'Mahathi partners with P&C insurance carriers and healthcare payers to modernize core systems and digitize claims operations. Talk to our team.',
        'image' => '/assets/images/video_thumbnail.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/#webpage',
                        'url' => 'https://www.mahathiinfotech.com',
                        'name' => 'Mahathi Infotech',
                        'description' => 'Mahathi Infotech delivers innovative digital, insurance, and healthcare solutions to drive business transformation.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => 'https://www.mahathiinfotech.com/#website',
                        'url' => 'https://www.mahathiinfotech.com',
                        'name' => 'Mahathi Infotech',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare' => [
        'title' => 'Healthcare Solutions',
        'description' => 'Comprehensive healthcare solutions including claims management, compliance, analytics, and digital transformation.',
        'image' => '/assets/images/health_baner_im.jpeg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare',
                        'name' => 'Healthcare Solutions',
                        'description' => 'Comprehensive healthcare solutions including claims management, compliance, analytics, and digital transformation.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/#service',
                        'name' => 'Healthcare Solutions',
                        'serviceType' => 'Healthcare Solutions',
                        'description' => 'Comprehensive healthcare solutions including claims management, compliance, analytics, and digital transformation.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/member-patient-administration' => [
        'title' => 'Member & Patient Administration IT Services',
        'description' => 'Mahathi streamlines member and patient administration with enrollment, eligibility, secure portals, digital engagement, and customer service support.',
        'image' => '/assets/images/hcs1.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/member-patient-administration/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/member-patient-administration',
                        'name' => 'Member & Patient Administration',
                        'description' => 'Streamline member and patient administration with efficient enrollment, eligibility, and data management solutions.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/member-patient-administration/#service',
                        'name' => 'Member & Patient Administration',
                        'serviceType' => 'Healthcare Administration',
                        'description' => 'Streamline member and patient administration with efficient enrollment, eligibility, and data management solutions.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/core-administration-platforms' => [
        'title' => 'Healthcare Core Administration Platforms',
        'description' => 'Mahathi provides implementation, integration, enhancement, and support for Facets, QNXT, HealthRules, Epic, Cerner, and other healthcare platforms.',
        'image' => '/assets/images/hcs4.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/core-administration-platforms/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/core-administration-platforms',
                        'name' => 'Core Administration Platforms',
                        'description' => 'Modern core administration platforms to manage healthcare operations efficiently and at scale.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/core-administration-platforms/#service',
                        'name' => 'Core Administration Platforms',
                        'serviceType' => 'Healthcare Administration Platforms',
                        'description' => 'Modern core administration platforms to manage healthcare operations efficiently and at scale.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/claims-management' => [
        'title' => 'Healthcare Claims Management IT Solutions',
        'description' => 'Mahathi improves healthcare claims management with AI document intake, adjudication workbenches, exception handling, analytics, and EOB automation.',
        'image' => '/assets/images/crfo1.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/claims-management/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/claims-management',
                        'name' => 'Claims Management Solutions',
                        'description' => 'Efficient claims management solutions to streamline processing, reduce errors, and improve turnaround time in healthcare operations.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/claims-management/#service',
                        'name' => 'Claims Management Solutions',
                        'serviceType' => 'Healthcare Claims Management',
                        'description' => 'Efficient claims management solutions to streamline processing, reduce errors, and improve turnaround time in healthcare operations.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/medical-management' => [
        'title' => 'Medical Management Technology for Payers',
        'description' => 'Mahathi supports utilization review, prior authorization, care management, and clinical decision support with configurable rules and AI-driven insights.',
        'image' => '/assets/images/crfo4.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/medical-management/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/medical-management',
                        'name' => 'Medical Management Solutions',
                        'description' => 'Optimize healthcare outcomes with advanced medical management solutions, including utilization review and care coordination.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/medical-management/#service',
                        'name' => 'Medical Management Solutions',
                        'serviceType' => 'Medical Management',
                        'description' => 'Optimize healthcare outcomes with advanced medical management solutions, including utilization review and care coordination.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/pharmacy-benefits-management' => [
        'title' => 'Pharmacy Benefit Management Services',
        'description' => 'Mahathi strengthens pharmacy benefits management via real-time claims processing, specialty pharmacy workflows, integrations, and utilization analytics.',
        'image' => '/assets/images/hcs6.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/pharmacy-benefits-management/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/pharmacy-benefits-management',
                        'name' => 'Pharmacy Benefits Management',
                        'description' => 'Enhance pharmacy benefits management with efficient drug utilization, cost control, and regulatory compliance solutions.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/pharmacy-benefits-management/#service',
                        'name' => 'Pharmacy Benefits Management',
                        'serviceType' => 'Pharmacy Benefits Management',
                        'description' => 'Enhance pharmacy benefits management with efficient drug utilization, cost control, and regulatory compliance solutions.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/revenue-cycle-management' => [
        'title' => 'Revenue Cycle Management Services',
        'description' => 'Mahathi supports end-to-end revenue cycle management, including coding, charge capture, claims submission, denial management, collections, and reporting.',
        'image' => '/assets/images/hcs5.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/revenue-cycle-management/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/revenue-cycle-management',
                        'name' => 'Revenue Cycle Management',
                        'description' => 'Improve financial performance with end-to-end revenue cycle management solutions for healthcare organizations.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/revenue-cycle-management/#service',
                        'name' => 'Revenue Cycle Management',
                        'serviceType' => 'Healthcare Revenue Cycle Management',
                        'description' => 'Improve financial performance with end-to-end revenue cycle management solutions for healthcare organizations.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/compliance-regulatory-services' => [
        'title' => 'Healthcare Compliance Services for Payers',
        'description' => 'Mahathi helps healthcare organizations manage HIPAA, HITECH, CMS, NCQA, URAC, EDI transaction compliance, audits, reporting, and data validation.',
        'image' => '/assets/images/dacr3.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/compliance-regulatory-services/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/compliance-regulatory-services',
                        'name' => 'Compliance & Regulatory Services',
                        'description' => 'Ensure healthcare compliance with regulatory services designed to meet industry standards and reduce risk.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/compliance-regulatory-services/#service',
                        'name' => 'Compliance & Regulatory Services',
                        'serviceType' => 'Healthcare Compliance Services',
                        'description' => 'Ensure healthcare compliance with regulatory services designed to meet industry standards and reduce risk.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/fraud-waste-abuse' => [
        'title' => 'Healthcare Fraud, Waste & Abuse Services',
        'description' => 'Mahathi helps healthcare organizations detect fraud, waste, and abuse using AI analytics, SIU case tools, investigation workflows, and data integrations.',
        'image' => '/assets/images/dacr4.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/fraud-waste-abuse/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/fraud-waste-abuse',
                        'name' => 'Fraud, Waste & Abuse Detection',
                        'description' => 'Detect and prevent fraud, waste, and abuse in healthcare systems using advanced analytics and compliance frameworks.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/fraud-waste-abuse/#service',
                        'name' => 'Fraud, Waste & Abuse Detection',
                        'serviceType' => 'Healthcare Fraud Detection',
                        'description' => 'Detect and prevent fraud, waste, and abuse in healthcare systems using advanced analytics and compliance frameworks.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/value-based-care-analytics' => [
        'title' => 'Value-Based Care Analytics for Health Plans',
        'description' => 'Mahathi enables value-based care through data platforms, predictive analytics, dashboards, population health visibility, and performance reporting.',
        'image' => '/assets/images/dacr1.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/value-based-care-analytics/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/value-based-care-analytics',
                        'name' => 'Value-Based Care Analytics',
                        'description' => 'Drive better outcomes with value-based care analytics and data-driven healthcare insights.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/value-based-care-analytics/#service',
                        'name' => 'Value-Based Care Analytics',
                        'serviceType' => 'Healthcare Analytics',
                        'description' => 'Drive better outcomes with value-based care analytics and data-driven healthcare insights.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/healthcare/digital-ai-enablement' => [
        'title' => 'Healthcare Digital & AI Enablement Services',
        'description' => 'Mahathi advances healthcare digital transformation with AI automation, FHIR and HL7 interoperability, secure cloud architecture, and identity governance.',
        'image' => '/assets/images/dacr2.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/digital-ai-enablement/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/healthcare/digital-ai-enablement',
                        'name' => 'Digital AI Enablement',
                        'description' => 'Enable digital transformation in healthcare with AI-driven solutions for smarter decision-making.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/healthcare/digital-ai-enablement/#service',
                        'name' => 'Digital AI Enablement',
                        'serviceType' => 'Healthcare AI Enablement',
                        'description' => 'Enable digital transformation in healthcare with AI-driven solutions for smarter decision-making.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/ai-enablement' => [
        'title' => 'Healthcare AI Services for Payers & Providers',
        'description' => 'Mahathi applies AI and automation to help healthcare payers and providers improve prior authorization, claims, risk adjustment, and clinical workflows.',
        'image' => '/assets/images/AIEnablement_Ban.jpeg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/ai-enablement/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/ai-enablement',
                        'name' => 'AI Enablement',
                        'description' => 'Leverage AI-driven solutions to enhance efficiency, decision-making, and business outcomes.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/ai-enablement/#service',
                        'name' => 'AI Enablement',
                        'serviceType' => 'AI Enablement',
                        'description' => 'Leverage AI-driven solutions to enhance efficiency, decision-making, and business outcomes.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/about-us' => [
        'title' => 'About Mahathi | P & C Insurance and Healthcare Technology Company',
        'description' => 'Mahathi is a niche healthcare and P&C insurance technology company, 500 people strong and a 2025 Inc. 5000 honoree. Read our story.',
        'image' => '/assets/images/About_Us_Banner.jpg',
        'rawTitle' => true,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'AboutPage',
                '@id' => 'https://www.mahathiinfotech.com/about-us/#webpage',
                'url' => 'https://www.mahathiinfotech.com/about-us',
                'name' => 'About Us',
                'description' => 'Learn more about Mahathi Infotech, our mission, vision, and leadership.',
                'publisher' => [
                    '@id' => 'https://www.mahathiinfotech.com/#organization',
                ],
            ],
        ],
    ],
    '/contact-us' => [
        'title' => 'Contact Mahathi | Insurance & Healthcare IT Team',
        'description' => 'Contact Mahathi to discuss insurance or healthcare technology modernization, AI, platform integration, operational support, or partnership opportunities.',
        'image' => '/assets/images/contsus_Banner.jpg',
        'rawTitle' => true,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'ContactPage',
                '@id' => 'https://www.mahathiinfotech.com/contact-us/#webpage',
                'url' => 'https://www.mahathiinfotech.com/contact-us',
                'name' => 'Contact Us',
                'description' => 'Get in touch with Mahathi Infotech for support, inquiries, and partnership opportunities.',
                'publisher' => [
                    '@id' => 'https://www.mahathiinfotech.com/#organization',
                ],
            ],
        ],
    ],
    '/news' => [
        'title' => 'Insurance & Healthcare IT News and Insights',
        'description' => 'Read Mahathi news and insights on insurance technology, healthcare IT, AI, partnerships, company milestones, modernization initiatives, and trends.',
        'image' => '/assets/images/news_Banner.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                '@id' => 'https://www.mahathiinfotech.com/news/#webpage',
                'url' => 'https://www.mahathiinfotech.com/news',
                'name' => 'News & Insights',
                'description' => 'Stay updated with the latest news, insights, and developments from Mahathi Infotech.',
                'publisher' => [
                    '@id' => 'https://www.mahathiinfotech.com/#organization',
                ],
            ],
        ],
    ],
    '/insurance/p-and-c-solution' => [
        'title' => 'P&C Insurance Technology Services',
        'description' => 'Implement Guidewire and Duck Creek with Mahathi\'s P&C insurance Technology services for carriers, MGAs, and TPAs. Talk to our practice lead now.',
        'image' => '/assets/images/P&C_banner.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/p-and-c-solution/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/insurance/p-and-c-solution',
                        'name' => 'P&C Insurance Solutions',
                        'description' => 'Comprehensive property and casualty insurance solutions for efficient operations and improved customer experience.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/p-and-c-solution/#service',
                        'name' => 'P&C Insurance Solutions',
                        'serviceType' => 'P&C Insurance Solutions',
                        'description' => 'Comprehensive property and casualty insurance solutions for efficient operations and improved customer experience.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/insurance' => [
        'title' => 'Workers Compensation Technology Services',
        'description' => 'Mahathi modernizes workers\' compensation operations for carriers, TPAs, MGAs, and self-insureds across policy, claims, medical, and compliance.',
        'image' => '/assets/images/Workers_Comp_banner.jpeg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/insurance',
                        'name' => 'Insurance Solutions',
                        'description' => 'Comprehensive insurance solutions designed to improve operations, compliance, and customer experience.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/#service',
                        'name' => 'Insurance Solutions',
                        'serviceType' => 'Insurance Solutions',
                        'description' => 'Comprehensive insurance solutions designed to improve operations, compliance, and customer experience.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/insurance/managed-care-organization' => [
        'title' => 'Managed Care Technology Services',
        'description' => 'Modernize Medicaid and Medicare Advantage platforms with Mahathi\'s managed care Technology services. See our approach to MCO tech.',
        'image' => '/assets/images/MCO_banner.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/managed-care-organization/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/insurance/managed-care-organization',
                        'name' => 'Managed Care Organization Services',
                        'description' => 'Enhance care coordination and reduce costs with integrated managed care solutions and analytics.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/managed-care-organization/#service',
                        'name' => 'Managed Care Organization Services',
                        'serviceType' => 'Managed Care Organization',
                        'description' => 'Enhance care coordination and reduce costs with integrated managed care solutions and analytics.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/insurance/life-and-annuity' => [
        'title' => 'Life & Annuity Insurance Technology Services',
        'description' => 'Mahathi modernizes life and annuity claims, actuarial operations, digital platforms, and policyholder experiences through automation and integration.',
        'image' => '/assets/images/LIFE_&_ANNUITY_Banner.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/life-and-annuity/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/insurance/life-and-annuity',
                        'name' => 'Life & Annuity Solutions',
                        'description' => 'Transform life and annuity operations with scalable platforms, automation, and analytics-driven insights.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/life-and-annuity/#service',
                        'name' => 'Life & Annuity Solutions',
                        'serviceType' => 'Life & Annuity',
                        'description' => 'Transform life and annuity operations with scalable platforms, automation, and analytics-driven insights.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/insurance/re-insurance' => [
        'title' => 'Reinsurance Technology Services for Carriers',
        'description' => 'Mahathi modernizes assumed and ceded reinsurance across claims, policy, billing, bordereaux, payouts, and finance with secure, connected workflows.',
        'image' => '/assets/images/reinslts.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/re-insurance/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/insurance/re-insurance',
                        'name' => 'Reinsurance Solutions',
                        'description' => 'Optimize complex risk management with advanced reinsurance solutions and data-driven insights.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/insurance/re-insurance/#service',
                        'name' => 'Reinsurance Solutions',
                        'serviceType' => 'Reinsurance',
                        'description' => 'Optimize complex risk management with advanced reinsurance solutions and data-driven insights.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/insurance/guidewire' => [
        'title' => 'Guidewire Services for P&C Insurance Carriers | Mahathi',
        'description' => 'Implement and migrate Guidewire for P&C carriers with certified experts combining Guidewire expertise and deep insurance domain knowledge. Contact us.',
        'image' => null,
        'rawTitle' => true,
        'schemas' => [],
    ],
    '/blog' => [
        'title' => 'Insurance & Healthcare Tech Insights | Mahathi',
        'description' => 'Expert insights on Guidewire migration, P&C, Workers’ Comp, healthcare claims, and AI-driven automation for insurance and healthcare enterprises.',
        'image' => null,
        'rawTitle' => true,
        'schemas' => [],
    ],
    '/pas-migration-problem-finder' => [
        'title' => 'PAS Migration Problem Finder | Mahathi',
        'description' => 'Find where your policy administration system (PAS) migration is most at risk. Select the problems you face and get a ranked plan across seven core migration areas in about two minutes.',
        'image' => null,
        'rawTitle' => true,
        'schemas' => [],
    ],
    '/databricks' => [
        'title' => 'Enterprise Databricks Implementation Services | Mahathi',
        'description' => 'Accelerate your data transformation with Mahathi\'s Databricks implementation services. Certified Bronze Partner for migration, AI, and Lakehouse solutions.',
        'image' => null,
        'rawTitle' => true,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => 'Enterprise Databricks Implementation Services',
                'description' => 'Databricks implementation and migration services for insurance carriers and healthcare payers. Mahathi is an official Databricks Bronze Partner.',
                'provider' => [
                    '@type' => 'Organization',
                    'name' => 'Mahathi Infotech',
                    'url' => 'https://mahathiinfotech.com',
                    'logo' => 'https://mahathiinfotech.com/logo.png',
                    'sameAs' => 'https://mahathiinfotech.com/databricks',
                ],
                'serviceType' => [
                    'Databricks Service',
                    'Databricks Implementation',
                    'Data Migration',
                    'Analytics Platform',
                ],
                'areaServed' => ['US', 'North America'],
                'offers' => [
                    '@type' => 'AggregateOffer',
                    'priceCurrency' => 'USD',
                    'price' => 'Contact for pricing',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        'name' => 'What is a Databricks implementation?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'A Databricks implementation is the complete deployment and configuration of the Databricks Lakehouse Platform for your organization, including data migration, governance setup, and optimization for your specific use cases.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'How long does a Databricks migration take?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Most enterprise Databricks migrations take 8-12 weeks depending on data volume and complexity. Mahathi has migrated 2.5B+ records with zero downtime.',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/digital-services' => [
        'title' => 'Digital Transformation Services',
        'description' => 'Mahathi delivers continuous insurance compliance across policy, claims, medical, and reporting with monitoring, exception intelligence, and analytics.',
        'image' => '/assets/images/ailts.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/digital-services/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/digital-services',
                        'name' => 'Digital Services',
                        'description' => 'Transform your business with scalable digital services, automation, and intelligent solutions.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/digital-services/#service',
                        'name' => 'Digital Services',
                        'serviceType' => 'Digital Services',
                        'description' => 'Transform your business with scalable digital services, automation, and intelligent solutions.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/integrated-mailroom' => [
        'title' => 'Digital Mailroom Services for Carriers',
        'description' => 'Automate inbound claims mail and document intake with Mahathi\'s digital mailroom services for carriers, TPAs, and payers. Talk to our team now.',
        'image' => '/assets/images/people-studying-peacefully-library.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/integrated-mailroom/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/integrated-mailroom',
                        'name' => 'Integrated Mailroom',
                        'description' => 'Streamline document intake and processing with intelligent integrated mailroom solutions.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/integrated-mailroom/#service',
                        'name' => 'Integrated Mailroom',
                        'serviceType' => 'Mailroom Processing Services',
                        'description' => 'Streamline document intake and processing with intelligent integrated mailroom solutions.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/workbench-solution' => [
        'title' => 'Integrated Insurance Workbench Solutions',
        'description' => 'Mahathi\'s integrated insurance workbench unifies underwriting, claims, litigation, policyholder, agent, and partner workflows on one configurable platform.',
        'image' => '/assets/images/business-person-looking-finance-graphs.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/workbench-solution/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/workbench-solution',
                        'name' => 'Workbench Solutions',
                        'description' => 'Streamline operations with our integrated insurance workbench and digital transformation solutions.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/workbench-solution/#service',
                        'name' => 'Workbench Solutions',
                        'serviceType' => 'Workflow Optimization Solutions',
                        'description' => 'Streamline operations with our integrated insurance workbench and digital transformation solutions.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/compliance' => [
        'title' => 'Insurance Regulatory Compliance for Carriers',
        'description' => 'Mahathi delivers continuous insurance compliance across policy, claims, medical, and reporting with monitoring, exception intelligence, and analytics.',
        'image' => '/assets/images/compliance-banner.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/compliance/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/compliance',
                        'name' => 'Compliance Services',
                        'description' => 'Ensure regulatory compliance with robust solutions for risk management, governance, and operational efficiency.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/compliance/#service',
                        'name' => 'Compliance Services',
                        'serviceType' => 'Compliance Services',
                        'description' => 'Ensure regulatory compliance with robust solutions for risk management, governance, and operational efficiency.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/siu-investigative' => [
        'title' => 'SIU Investigative Services for Carriers & TPAs',
        'description' => 'Mahathi offers integrated or unbundled SIU services for compliance reporting, desk and field investigations, surveillance, fraud detection, and recovery.',
        'image' => '/assets/images/siu.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/siu-investigative/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/siu-investigative',
                        'name' => 'SIU & Investigative Services',
                        'description' => 'Special investigation unit services to detect fraud, ensure compliance, and improve insurance claim outcomes.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/siu-investigative/#service',
                        'name' => 'SIU & Investigative Services',
                        'serviceType' => 'Investigative Services',
                        'description' => 'Special investigation unit services to detect fraud, ensure compliance, and improve insurance claim outcomes.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/litigation' => [
        'title' => 'Litigation Support Services for Carriers',
        'description' => 'Mahathi supports insurance litigation with records procurement, medical chronologies, document organization, case workflows, and defense coordination.',
        'image' => '/assets/images/litigation.jpeg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => 'https://www.mahathiinfotech.com/litigation/#webpage',
                        'url' => 'https://www.mahathiinfotech.com/litigation',
                        'name' => 'Litigation Support Services',
                        'description' => 'Efficient litigation support services for compliance, documentation, and case management.',
                        'publisher' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                    ],
                    [
                        '@type' => 'Service',
                        '@id' => 'https://www.mahathiinfotech.com/litigation/#service',
                        'name' => 'Litigation Support Services',
                        'serviceType' => 'Litigation Support Services',
                        'description' => 'Efficient litigation support services for compliance, documentation, and case management.',
                        'provider' => [
                            '@id' => 'https://www.mahathiinfotech.com/#organization',
                        ],
                        'areaServed' => [
                            '@type' => 'Country',
                            'name' => 'United States',
                        ],
                    ],
                ],
            ],
        ],
    ],
    '/faq-insurance-healthcare-guidewire-ai-modernization' => [
        'title' => 'Mahathi FAQ: Insurance Technology, Guidewire Services, Healthcare Technology, AI Enablement, and Modernization',
        'description' => 'Learn how Mahathi helps P&C insurers, MGAs, MGUs, healthcare payers, providers, PBMs, and service providers with Guidewire services, core systems modernization, AI enablement, digital portals, claims and underwriting workflows, healthcare technology, data exchange, and business acceleration.',
        'image' => '/assets/images/About_Us_Banner.jpg',
        'rawTitle' => false,
        'schemas' => [
            [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#faqpage',
                'name' => 'Mahathi FAQ: Insurance Technology, Guidewire Services, Healthcare Technology, AI Enablement, and Modernization',
                'url' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-001',
                        'name' => 'What does Mahathi do?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi Infotech is a technology solutions company focused on helping insurance and healthcare organizations modernize platforms, improve operational efficiency, deploy practical AI, and accelerate business outcomes.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-002',
                        'name' => 'Who does Mahathi serve?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi serves property and casualty insurers, specialty insurers, workers’ compensation carriers, MGAs, MGUs, TPAs, claims administrators, insurance ecosystem partners, healthcare payers, healthcare providers, PBMs, and healthcare technology organizations.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-003',
                        'name' => 'What makes Mahathi different from a generic IT services provider?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi combines insurance and healthcare domain expertise with strong technology delivery capability. This domain-first approach helps clients solve business problems using practical technology solutions aligned with operational goals.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-004',
                        'name' => 'Does Mahathi work with insurance companies?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi works with property and casualty insurers, specialty insurers, workers’ compensation carriers, MGAs, MGUs, TPAs, and insurance ecosystem partners on modernization, integrations, digital portals, claims and underwriting workflows, AI enablement, and operational improvement initiatives.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-005',
                        'name' => 'What insurance platforms does Mahathi work with?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi has experience across Guidewire, Duck Creek, underwriting platforms, claims systems, digital portals, workflow platforms, data platforms, and AI-enabled insurance applications.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-006',
                        'name' => 'How can Mahathi help insurance companies modernize their core systems?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps insurers modernize core systems through legacy assessment, migration support, API integration, cloud enablement, testing, workflow redesign, data conversion, and operational modernization.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-007',
                        'name' => 'What are Mahathi’s core service areas?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi’s core service areas include core systems modernization, Guidewire services, AI enablement, business acceleration, healthcare technology services, insurance digital solutions, and insurance and healthcare ecosystem integration.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-008',
                        'name' => 'What types of insurance solutions does Mahathi build?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi builds underwriting workbenches, claims workbenches, producer portals, customer self-service portals, workflow automation solutions, Guidewire extensions, compliance tools, AI-enabled productivity tools, and integration platforms.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-009',
                        'name' => 'How does Mahathi help carriers improve claims operations?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps carriers improve claims operations through electronic mailroom automation, AI-assisted summarization, claims workbenches, vendor integrations, triage workflows, compliance reporting, and Guidewire ClaimsCenter integration support.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-010',
                        'name' => 'How does Mahathi help underwriting teams?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps underwriting teams improve submission intake, risk evaluation, quoting support, document review, workflow automation, and decision-making through underwriting workbenches and AI-assisted tools.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-011',
                        'name' => 'Does Mahathi help MGAs and MGUs?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports MGAs and MGUs with underwriting workflows, portals, rating integrations, bordereaux reporting, claims workflows, policy administration extensions, and digital capabilities.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ins-012',
                        'name' => 'How can Mahathi help workers’ compensation insurers?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps workers’ compensation insurers improve claims efficiency, integrate vendor ecosystems, reduce operational backlog, support managed care integrations, and improve claims analytics and regulatory workflows.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-001',
                        'name' => 'Does Mahathi work with Guidewire?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire-related initiatives including integrations, platform extensions, testing, migration support, workflow enhancements, accelerators, and cloud readiness.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-002',
                        'name' => 'Is Mahathi a Guidewire partner?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi is actively working closely with Guidewire toward formal partnership status and has more than 80 Guidewire-certified resources with experience across 40+ Guidewire programs.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-003',
                        'name' => 'What should insurers look for in a Guidewire implementation or integration partner?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Insurers should look for Guidewire-certified expertise, insurance domain knowledge, integration capability, testing expertise, operational workflow understanding, and practical implementation experience.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-004',
                        'name' => 'Can Mahathi help insurance companies with Guidewire implementations?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire implementations across planning, configuration, testing, integrations, migration support, enhancements, and production readiness.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-005',
                        'name' => 'Does Mahathi provide Guidewire integration services?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi provides Guidewire integration services connecting Guidewire with internal systems, digital portals, document systems, claims vendors, analytics platforms, and AI-enabled workflows.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-006',
                        'name' => 'Can Mahathi support Guidewire Cloud initiatives?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire Cloud readiness, integration modernization, testing, migration preparation, operational workflow alignment, and cloud-related modernization initiatives.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-007',
                        'name' => 'Does Mahathi support Guidewire testing?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire testing across functional testing, regression testing, integration testing, automation support, and production readiness validation.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-008',
                        'name' => 'Can Mahathi support Guidewire ClaimsCenter initiatives?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire ClaimsCenter workflows, integrations, claims operations improvement, vendor integrations, document workflows, and claims productivity initiatives.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-009',
                        'name' => 'Can Mahathi support Guidewire PolicyCenter initiatives?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire PolicyCenter-related underwriting workflows, integrations, digital intake, submission processing, and operational modernization.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-010',
                        'name' => 'Can Mahathi support Guidewire BillingCenter initiatives?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire BillingCenter integrations, workflow support, operational enhancements, and modernization initiatives related to billing operations.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-011',
                        'name' => 'Can Mahathi help extend Guidewire capabilities?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help insurers extend Guidewire capabilities through digital portals, workflow tools, AI-enabled automation, integrations, reporting solutions, and operational accelerators.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-012',
                        'name' => 'Can Mahathi support Guidewire programs for specialty insurers, MGAs, and MGUs?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi supports Guidewire-related programs for specialty insurers, MGAs, and MGUs requiring tailored workflows, underwriting support, integrations, and operational flexibility.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-013',
                        'name' => 'Why should insurers consider Mahathi for Guidewire services?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi combines Guidewire-certified capability, insurance domain expertise, practical implementation experience, and focused execution support for insurers modernizing or optimizing Guidewire environments.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#gui-014',
                        'name' => 'What insurance and Guidewire problems can Mahathi help solve?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps insurers solve Guidewire implementation support, Guidewire integration, Guidewire Cloud migration readiness, Guidewire testing, ClaimsCenter workflows, PolicyCenter support, underwriting workbenches, claims workbenches, electronic mailroom solutions, AI for claims and underwriting operations, workflow automation, and business acceleration challenges.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-001',
                        'name' => 'Does Mahathi work with healthcare organizations?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi works with healthcare organizations, including healthcare payers, providers, PBMs, and healthcare ecosystem companies that need technology, operations, AI, data exchange, compliance, and digital transformation support. Mahathi’s healthcare capabilities are focused on helping organizations modernize platforms, streamline operations, improve data flow, reduce manual work, and deliver better experiences for members, patients, providers, internal teams, and business partners.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-002',
                        'name' => 'What types of healthcare clients does Mahathi support?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi supports healthcare payers, providers, PBMs, TPAs, claims administrators, and healthcare technology organizations. For healthcare payers, Mahathi can support member administration, enrollment workflows, claims-related operations, provider data, compliance, digital engagement, customer service enablement, and AI-enabled productivity. For providers and health systems, Mahathi can support patient administration, digital workflows, operational applications, integrations, reporting, and technology modernization.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-003',
                        'name' => 'How does Mahathi help healthcare payers?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps healthcare payers modernize operations across member administration, enrollment, claims support, provider engagement, customer service, compliance workflows, data exchange, and digital experience. Healthcare payers often operate across complex platforms, regulatory requirements, data formats, member populations, provider networks, and vendor ecosystems. Mahathi helps simplify this complexity through technology modernization, workflow automation, AI-enabled tools, integrations, testing, and managed support.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-004',
                        'name' => 'How does Mahathi help healthcare providers and health systems?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps healthcare providers and health systems improve digital workflows, patient administration, operational efficiency, application modernization, integrations, reporting, and support services. For providers, the challenge is often not just the core EHR, but the many surrounding processes that affect access, operations, patient experience, revenue cycle, procurement, supply chain, and administrative productivity. Mahathi can help build and integrate practical technology solutions that reduce friction and improve execution.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-005',
                        'name' => 'Does Mahathi support PBMs and pharmacy-related healthcare organizations?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can support PBMs and pharmacy-related healthcare organizations with platform modernization, workflow automation, data integration, reporting, customer service enablement, compliance support, and AI-enabled operational tools. PBMs operate in a highly complex environment involving members, payers, providers, pharmacies, formularies, claims, pricing, prior authorization, regulatory requirements, and customer service. Mahathi can help improve data exchange, process efficiency, and operational visibility across these workflows.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-006',
                        'name' => 'How is Mahathi’s healthcare capability connected to its insurance expertise?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi’s healthcare and insurance capabilities are connected by a shared focus on regulated industries, complex operations, high-volume workflows, data exchange, compliance, claims, customer service, and digital transformation. Many healthcare and insurance organizations face similar challenges: fragmented systems, manual workflows, rising administrative burden, compliance pressure, and the need to use AI safely. Mahathi’s experience across both ecosystems allows it to bring practical operating knowledge to payer, provider, PBM, claims, and insurance technology environments.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-007',
                        'name' => 'Can Mahathi help with healthcare call center and customer service transformation?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help healthcare organizations improve call center and customer service operations through knowledge management, AI-enabled agent assistance, workflow automation, digital self-service, integration with backend systems, and better reporting. For payers and providers, customer service teams often need to answer complex questions using information spread across multiple systems. Mahathi can help create tools that reduce search time, improve response consistency, and help representatives resolve issues faster.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-008',
                        'name' => 'Can Mahathi help with healthcare member and patient administration?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help healthcare organizations improve member and patient administration by supporting enrollment, eligibility, digital engagement, customer service workflows, data exchange, operational reporting, and system integration. For payers, this may include member enrollment, member service workflows, plan-related data, issue resolution, and digital self-service. For providers, this may include patient intake, administrative workflows, care-related communication, and integration with operational systems.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-009',
                        'name' => 'Can Mahathi help healthcare organizations with digital engagement?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help healthcare organizations build and modernize digital engagement capabilities for members, patients, providers, brokers, employers, care teams, and service representatives. Digital engagement may include portals, mobile-enabled workflows, self-service tools, secure communication, document intake, status tracking, knowledge assistants, and integrated service experiences. The goal is to reduce friction, improve responsiveness, and make healthcare interactions easier for users.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-010',
                        'name' => 'How does Mahathi support healthcare data exchange and interoperability?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi supports healthcare data exchange by helping organizations connect systems, improve data flow, integrate internal and external platforms, and reduce manual handoffs. Healthcare organizations often need to move data across payer platforms, provider systems, PBM systems, claims platforms, customer service tools, reporting environments, compliance systems, and third-party vendors. Mahathi can help design and implement integration approaches that improve accuracy, visibility, and operational efficiency.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-011',
                        'name' => 'Can Mahathi support healthcare compliance workflows?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can support healthcare compliance workflows by helping organizations build tools for tracking, reporting, documentation, audit trails, data validation, process control, and operational governance. Healthcare organizations operate in a highly regulated environment. Mahathi can help create technology-enabled workflows that make compliance activities more consistent, transparent, and easier to manage.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-012',
                        'name' => 'How can Mahathi help healthcare organizations reduce administrative burden?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps reduce administrative burden by automating manual workflows, improving document intake, integrating disconnected systems, applying AI to repetitive tasks, building self-service portals, and improving operational visibility. In healthcare, administrative burden often comes from fragmented systems, manual data entry, paper or email-based workflows, repetitive inquiries, incomplete information, and slow handoffs. Mahathi helps address these issues with practical technology solutions that improve daily operations.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-013',
                        'name' => 'Does Mahathi build healthcare portals?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can build healthcare portals for members, patients, providers, employers, brokers, internal operations teams, and service partners. Healthcare portals can support self-service, secure document exchange, case status tracking, enrollment workflows, provider inquiries, patient administration, customer support, and integrated access to information. Mahathi’s portal work focuses on improving user experience while connecting the portal to the systems and workflows that actually run the business.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-014',
                        'name' => 'Can Mahathi help healthcare organizations modernize legacy systems?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help healthcare organizations modernize legacy applications and surrounding workflows through assessment, system integration, API enablement, cloud modernization, user experience improvement, testing, data migration support, and phased replacement strategies. Healthcare organizations often cannot replace every legacy system at once. Mahathi can help modernize around existing systems while creating a practical path toward future-state platforms.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-015',
                        'name' => 'Can Mahathi support healthcare testing and quality assurance?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can support testing and quality assurance for healthcare applications, payer platforms, provider systems, portals, integrations, data exchange workflows, claims-related systems, and digital tools. Testing is critical in healthcare because system errors can affect member service, patient experience, provider interactions, claims processing, compliance, reporting, and operational continuity.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-016',
                        'name' => 'How does Mahathi combine healthcare domain knowledge with technology delivery?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi combines healthcare domain knowledge with technology delivery by understanding the operational context behind the system requirement. In healthcare, this means understanding payer, provider, PBM, member, patient, claims, compliance, customer service, and data exchange workflows. This domain-first approach helps Mahathi build solutions that are not just technically sound, but also practical for the healthcare users and business teams who depend on them.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-017',
                        'name' => 'Why should healthcare payers consider Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Healthcare payers should consider Mahathi when they need a partner that understands healthcare operations, technology modernization, AI enablement, data exchange, compliance complexity, and operational efficiency. Mahathi can help payers improve member administration, customer service, claims-related workflows, provider engagement, digital experience, reporting, and AI-enabled productivity.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-018',
                        'name' => 'Why should healthcare providers consider Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Healthcare providers should consider Mahathi when they need help modernizing digital workflows, improving patient administration, integrating systems, building operational applications, improving reporting, or reducing administrative friction. Mahathi can support providers by building practical technology solutions around the systems, teams, and workflows that drive day-to-day healthcare operations.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#hea-019',
                        'name' => 'What healthcare technology problems can Mahathi help solve?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps healthcare organizations solve problems related to payer operations, provider digital transformation, PBM workflows, healthcare AI implementation, member administration, patient administration, healthcare data exchange, interoperability, healthcare portals, workflow automation, compliance technology, claims-related workflows, call center productivity, healthcare document automation, and administrative burden reduction. For healthcare payers, providers, PBMs, and healthcare service organizations, Mahathi’s value is in improving operational workflows, modernizing technology, integrating systems, and applying practical AI to measurable business problems.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-001',
                        'name' => 'How does Mahathi combine Guidewire expertise with AI?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi combines Guidewire expertise with AI by identifying operational workflows around Guidewire where AI can reduce manual effort, improve speed, and support better decisions. Examples include AI-assisted claims summarization, underwriting submission intake, document classification, electronic mailroom automation, adjuster productivity tools, knowledge assistants, compliance review support, and workflow prioritization. These AI solutions can be integrated with Guidewire and surrounding systems to make them practical for business users.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-002',
                        'name' => 'What is Mahathi’s approach to AI in insurance and healthcare?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi’s approach to AI is practical, business-led, and outcome-focused. Rather than starting with a tool or platform, Mahathi starts with a business problem: backlog reduction, faster document review, improved underwriting speed, claims triage, customer service productivity, compliance support, prior authorization support, member service improvement, or operational cost reduction. Mahathi then identifies where AI can safely and measurably improve the process. This may include generative AI, document intelligence, workflow automation, rules engines, human-in-the-loop review, integration with enterprise systems, and secure deployment practices.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-003',
                        'name' => 'What types of AI use cases can Mahathi support for insurers?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can support insurance AI use cases such as claims document summarization, underwriting submission summarization, email and document intake classification, electronic mailroom automation, claims triage support, policy comparison and extraction, regulatory document review, customer service knowledge assistants, internal operations copilots, litigation file summarization, demand package review support, medical chronology support, workflow prioritization, and backlog reduction using AI-enabled automation. The key is to apply AI to specific, measurable business problems rather than broad experimentation.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-004',
                        'name' => 'What healthcare AI use cases can Mahathi support?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can support healthcare AI use cases such as member service knowledge assistants, patient service knowledge assistants, claims document summarization, prior authorization document intake support, appeals and grievances document summarization, call center productivity tools, provider inquiry support, healthcare document classification, medical record summarization support, compliance review support, operational backlog reduction, workflow routing and prioritization, and internal employee copilots. These use cases are most effective when tied to measurable business outcomes such as reduced turnaround time, improved productivity, better service quality, or lower administrative burden.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-005',
                        'name' => 'Can Mahathi help healthcare organizations with AI?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi helps healthcare organizations apply AI to practical operational challenges such as document processing, call center support, member and patient service workflows, claims-related review, prior authorization support, knowledge management, summarization, compliance review, and administrative backlog reduction. Mahathi’s approach is business-led and human-in-the-loop. The focus is not on AI experimentation alone, but on identifying high-value workflows where AI can safely improve productivity, speed, accuracy, and user experience.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-006',
                        'name' => 'Can Mahathi help organizations evaluate AI opportunities?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help organizations identify, prioritize, and implement AI opportunities based on business value, operational feasibility, data availability, integration complexity, compliance considerations, and measurable outcomes. Mahathi’s AI approach is especially useful for organizations that want to move beyond experimentation and apply AI to real business problems in claims, underwriting, customer service, compliance, healthcare administration, member service, patient service, and operations.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-007',
                        'name' => 'What is the best first AI use case for an insurance or healthcare organization?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'The best first AI use case is usually one that has high volume, clear pain, measurable impact, manageable risk, and available data. For insurers, good starting points include claims document summarization, underwriting submission intake, email classification, electronic mailroom automation, customer service knowledge assistants, and operational backlog reduction. For healthcare organizations, good starting points include member service support, patient service support, prior authorization intake support, appeals and grievances summarization, call center agent assistance, healthcare document classification, and administrative backlog reduction. The best use case is not always the flashiest one. It is the one where AI can create measurable business value quickly and safely.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-008',
                        'name' => 'How does Mahathi ensure AI solutions are practical and safe?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can design AI solutions with human-in-the-loop review, auditability, clear workflow controls, data security, role-based access, integration with approved systems, and measurable performance tracking. For insurance and healthcare companies, AI must be implemented carefully because claims, underwriting, compliance, healthcare operations, member service, patient service, and customer communications involve regulated, sensitive, and business-critical decisions. Mahathi focuses on practical AI that supports human decision-making rather than uncontrolled automation.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-009',
                        'name' => 'What role does Mahathi play in an organization’s AI strategy?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can help organizations move from AI interest to AI execution. This includes identifying practical use cases, defining business value, designing secure workflows, integrating AI with enterprise systems, building prototypes, deploying production-grade solutions, and measuring impact. Mahathi’s role is to make AI useful in the daily work of insurance and healthcare teams.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#ai-010',
                        'name' => 'How can Mahathi help organizations move from AI experimentation to measurable business value?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Many insurance and healthcare organizations are experimenting with AI but struggling to convert pilots into production-ready business outcomes. Mahathi helps clients move from experimentation to execution by identifying high-value use cases, designing practical workflows, integrating AI with existing systems, adding human-in-the-loop controls, and measuring operational impact. Rather than treating AI as a standalone technology initiative, Mahathi focuses on business problems such as claims backlog, underwriting speed, member service, patient administration, document review, compliance workflows, and customer service productivity. This makes AI more practical, measurable, and easier for business and IT teams to adopt.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-001',
                        'name' => 'What is Mahathi’s Business Acceleration approach?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi’s Business Acceleration approach is designed to help insurers and healthcare organizations solve high-value business problems quickly without waiting for large transformation programs to finish. The approach typically starts with identifying a backlog item, workflow bottleneck, or customer-facing issue that has measurable value. Mahathi then designs and builds a targeted solution in a short delivery cycle, deploys it to a limited user group, measures impact, and scales the solution if it proves value. This approach is useful when business leaders need progress now while larger modernization initiatives continue in parallel.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-002',
                        'name' => 'How is Mahathi’s Business Acceleration different from traditional IT delivery?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Traditional IT delivery often requires long planning cycles, extensive documentation, and large program structures. Mahathi’s Business Acceleration model is more focused, iterative, and outcome-driven. Instead of trying to transform an entire function at once, Mahathi helps clients identify specific pain points that can be solved in weeks rather than years. This creates visible business value, builds internal confidence, and helps IT and business teams collaborate around measurable results.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-003',
                        'name' => 'Does Mahathi replace existing insurance or healthcare platforms?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'No. Mahathi does not necessarily replace existing platforms. In many cases, Mahathi helps organizations get more value from platforms they already use. Mahathi can build extensions, integrations, digital experiences, automation layers, reporting tools, AI assistants, and workflow solutions around existing core systems. This allows clients to improve business performance without forcing unnecessary rip-and-replace decisions.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-004',
                        'name' => 'Can Mahathi work alongside an existing IT team?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi is designed to work collaboratively with existing IT, operations, claims, underwriting, healthcare operations, data, compliance, and business teams. Mahathi can support internal teams by providing domain expertise, engineering capacity, specialized platform knowledge, rapid development capability, testing support, and AI implementation experience. The model can be flexible depending on whether the client needs advisory support, delivery execution, managed services, or a focused project team.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-005',
                        'name' => 'How does Mahathi help reduce operational backlog?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps reduce operational backlog by identifying manual, repetitive, high-volume, or delayed workflows and applying a combination of process redesign, automation, AI, integrations, and targeted application development. Examples include automating document intake, summarizing large claim files, digitizing email-based workflows, creating self-service portals, reducing duplicate data entry, integrating third-party vendors, and building workbenches that allow users to complete tasks faster.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-006',
                        'name' => 'How does Mahathi help improve speed to market?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi improves speed to market by providing focused delivery teams with domain expertise and reusable solution patterns. This allows organizations to move faster on portals, workbenches, integrations, platform enhancements, AI use cases, and regulatory changes. Because Mahathi understands insurance and healthcare workflows, teams can spend less time explaining business context and more time designing and delivering usable solutions.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-007',
                        'name' => 'What kinds of business outcomes can Mahathi help clients achieve?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can help clients pursue outcomes such as faster underwriting turnaround, reduced claims handling time, improved adjuster productivity, lower operational backlog, improved member and patient experience, better digital engagement, faster vendor onboarding, improved data flow across systems, reduced manual document handling, stronger compliance support, increased value from core platform investments, improved operational efficiency, and faster delivery of business-requested technology.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-008',
                        'name' => 'How does Mahathi support digital portals?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi designs, builds, integrates, and supports digital portals for insurance and healthcare use cases. In insurance, these may include agent portals, broker portals, insured portals, TPA portals, underwriting submission portals, claims intake portals, vendor portals, and internal operations portals. In healthcare, these may include member portals, patient portals, provider portals, employer portals, broker portals, care team tools, and internal operations portals. A good portal does more than display information. It should simplify workflows, reduce manual follow-up, integrate with core systems, improve data quality, and create a better experience for users.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-009',
                        'name' => 'What is an underwriting workbench, and can Mahathi build one?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'An underwriting workbench is a digital workspace that gives underwriters the information, documents, data, tasks, and decision-support tools they need in one place. Mahathi can help build underwriting workbenches that support submission intake, document review, risk data enrichment, referral workflows, quote support, collaboration, audit trails, and integration with core policy systems or rating platforms.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-010',
                        'name' => 'What is a claims workbench, and can Mahathi build one?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'A claims workbench is a digital workspace that helps adjusters, supervisors, and claims teams manage claims more efficiently. Mahathi can build claims workbenches that bring together claim data, documents, notes, tasks, vendor updates, litigation information, medical information, AI summaries, and decision-support workflows. The goal is to reduce time spent searching across systems and increase time spent making informed claim decisions.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-011',
                        'name' => 'What is an electronic mailroom solution?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'An electronic mailroom solution digitizes and organizes inbound documents, emails, forms, attachments, and correspondence. For insurers, this can include claim documents, underwriting submissions, legal notices, medical records, policyholder communications, and vendor documentation. For healthcare organizations, this can include member documents, patient documents, prior authorization materials, appeals and grievances, provider correspondence, compliance documents, and administrative records. Mahathi can help organizations implement electronic mailroom solutions that classify documents, extract key data, route work to the right team, integrate with core systems, and reduce manual processing.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-012',
                        'name' => 'How does Mahathi support regulatory compliance?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi supports regulatory compliance by helping organizations build systems, workflows, reporting tools, and controls that align with business and jurisdictional requirements. This may include compliance tracking, audit trails, document retention support, regulatory reporting workflows, filing support, data validation, and integration with systems that manage policy, claims, billing, member, patient, provider, and customer information.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-013',
                        'name' => 'Can Mahathi help with system integrations?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi helps organizations integrate core systems, digital platforms, third-party data sources, vendor systems, document platforms, payment systems, analytics tools, AI services, regulatory tools, healthcare platforms, and operational applications. Insurance and healthcare ecosystems often depend on many specialized systems and vendors. Mahathi can help ensure data moves cleanly and securely between systems, reducing manual rekeying, operational friction, and reporting gaps.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-014',
                        'name' => 'How does Mahathi help organizations use existing data better?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps organizations improve the way data is captured, integrated, organized, and used across business functions. This may include data pipelines, reporting dashboards, analytics, operational metrics, claims insights, underwriting insights, member and patient insights, AI-ready data preparation, and data quality improvement. Better data enables better decisions, faster operations, stronger compliance, and more effective use of AI.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-015',
                        'name' => 'Does Mahathi provide managed services?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can support ongoing maintenance, enhancements, platform support, testing, application management, and operational technology support depending on the client’s needs. For organizations that do not want to build large internal teams for every platform or workflow, Mahathi can provide flexible support models that combine domain knowledge with technical execution.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-016',
                        'name' => 'How does Mahathi work with insurance and healthcare ecosystem partners?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can work with claims service providers, managed care vendors, SIU and investigation firms, litigation support providers, document intelligence companies, regulatory data providers, healthcare platforms, PBMs, provider organizations, payer systems, and other ecosystem partners. This is particularly valuable when clients want to build an integrated operating model rather than manage disconnected vendors and manual handoffs. Mahathi’s role is to help connect the technology layer with the business services layer.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-017',
                        'name' => 'Why is an end-to-end business services approach important?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Technology alone does not always create enough value. Organizations often need a combination of technology, domain expertise, operational workflow redesign, vendor integration, and business outcome ownership. An end-to-end approach helps clients address the full problem, not just the software component. For example, improving claims outcomes may require better intake, better document processing, better managed care integration, better investigation workflows, better analytics, and better user experience for adjusters. In healthcare, improving member or patient experience may require better data exchange, better digital engagement, better call center tools, better document workflows, and stronger integration across operational platforms.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-018',
                        'name' => 'How can Mahathi help reduce combined ratio for insurers?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi can help insurers address operational drivers that may influence loss adjustment expense, claims efficiency, underwriting discipline, leakage reduction, and administrative costs. Technology alone does not determine combined ratio, but better systems and workflows can help insurers reduce manual effort, improve claim handling, accelerate underwriting decisions, improve vendor coordination, strengthen compliance, and identify operational inefficiencies. These improvements can contribute to better financial and operational performance over time.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-019',
                        'name' => 'How does Mahathi approach implementation?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi’s implementation approach usually begins with understanding the business problem, current workflow, systems landscape, user pain points, data environment, and success metrics. From there, Mahathi defines a practical solution roadmap, prioritizes high-value work, designs the required technology or process change, builds and tests the solution, deploys it with business users, and measures the impact. The approach can be scaled from a focused pilot to a larger transformation program.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-020',
                        'name' => 'Does Mahathi support cloud modernization?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can support cloud modernization initiatives, including application modernization, cloud migration support, API enablement, integration modernization, data platform modernization, and cloud-native application development. For insurance and healthcare organizations, cloud modernization should be tied to business outcomes such as agility, scalability, security, resilience, speed to market, and improved integration across the enterprise ecosystem.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-021',
                        'name' => 'How does Mahathi help with legacy system modernization?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi helps organizations modernize legacy systems through assessment, rationalization, integration, migration planning, data conversion, API wrapping, user interface modernization, testing, and phased replacement strategies. Not every legacy system needs to be replaced immediately. In many cases, Mahathi can help organizations reduce risk by modernizing around the legacy environment while planning a structured path to future-state platforms.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-022',
                        'name' => 'Can Mahathi build custom applications?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can build custom applications when packaged products or existing systems do not fully address a business need. Custom applications may include internal workbenches, customer portals, member portals, patient portals, agent portals, provider portals, workflow tools, reporting applications, compliance tools, operational dashboards, and AI-enabled productivity solutions.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-023',
                        'name' => 'Does Mahathi only work on large transformation programs?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'No. Mahathi can support both large transformation programs and smaller, targeted business initiatives. Many organizations need a partner that can handle strategic modernization while also solving immediate business problems. Mahathi’s model supports both: modernization for long-term change and rapid business acceleration for near-term outcomes.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-024',
                        'name' => 'How quickly can Mahathi deliver value?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Delivery timelines depend on the complexity of the problem, the systems involved, data availability, security requirements, and stakeholder alignment. For focused business acceleration initiatives, Mahathi can often help define and build a targeted solution in a matter of weeks. Larger platform modernization, migration, or integration programs typically require a broader roadmap and phased delivery plan.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-025',
                        'name' => 'What is the typical starting point for working with Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'A typical starting point is a focused discovery conversation or assessment. Mahathi works with business and IT leaders to understand the problem, identify pain points, review current systems, prioritize opportunities, and define a practical path forward. This may lead to a pilot, proof of value, platform enhancement, AI use case, integration project, or broader modernization roadmap.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-026',
                        'name' => 'What questions should organizations ask before starting a modernization program?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Organizations should ask: What business outcome are we trying to improve? Which workflows create the most friction today? Which systems are limiting speed or flexibility? Where is manual work creating cost or delay? What data do we need to make better decisions? Which changes can create value quickly? Which changes require long-term platform modernization? How will we measure success? How will business and IT teams work together? Where can AI help safely and practically? Mahathi helps clients answer these questions and translate them into an executable plan.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-027',
                        'name' => 'How does Mahathi help business and IT teams collaborate?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Mahathi acts as a bridge between business users and technology teams. Because Mahathi understands insurance, healthcare, operations, and technology delivery, it can help translate business pain points into technical requirements and technical options into business decisions. This reduces misalignment, accelerates delivery, and helps ensure that solutions are actually used by the people they are designed to help.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-028',
                        'name' => 'Why should a P&C carrier consider Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'A P&C carrier should consider Mahathi when it needs an insurance-focused technology partner that can combine domain expertise, platform knowledge, Guidewire capability, AI capability, and practical delivery. Mahathi is particularly relevant for carriers looking to modernize core systems, improve claims or underwriting operations, build digital portals, integrate vendor ecosystems, reduce backlog, or deploy AI in a business-focused way.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-029',
                        'name' => 'Why should an MGA or MGU consider Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'An MGA or MGU should consider Mahathi when it needs scalable technology capabilities without the overhead of a large internal technology organization. Mahathi can help MGAs and MGUs improve underwriting speed, automate submission intake, integrate rating and policy systems, create producer portals, manage bordereaux reporting, improve data visibility, and support growth with flexible technology.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-030',
                        'name' => 'What kinds of buyers typically engage Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Typical buyers include CIOs, CTOs, Chief Claims Officers, Chief Underwriting Officers, Chief Operating Officers, Heads of Transformation, Heads of Digital, Claims Operations Leaders, Underwriting Operations Leaders, Healthcare Operations Leaders, Payer Operations Leaders, Provider Operations Leaders, PBM Technology Leaders, and business leaders responsible for improving operations. Mahathi is also relevant for private equity-backed insurance and healthcare businesses, insurance service providers, healthcare service providers, and ecosystem partners that need stronger technology capabilities.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-031',
                        'name' => 'Can Mahathi support insurance and healthcare service providers?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can support service providers that sell into carriers, MGAs, MGUs, TPAs, claims organizations, healthcare payers, providers, PBMs, and healthcare ecosystem companies. For service providers, Mahathi can help build portals, integrations, workflow tools, analytics, AI-enabled solutions, and platform extensions that make their services easier for clients to adopt and use.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-032',
                        'name' => 'How does Mahathi compare with large consulting or IT services firms?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Large consulting and IT services firms can bring scale, but they may also bring higher cost, broader staffing models, and less specialized attention. Mahathi offers a more focused insurance and healthcare technology approach with domain depth, agility, and practical execution. For organizations that need a partner who understands regulated industry workflows and can move quickly, Mahathi can be a strong alternative or complement to larger firms.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-033',
                        'name' => 'How does Mahathi compare with software product companies?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Software product companies typically provide a defined platform or application. Mahathi helps organizations solve business and technology problems that may span multiple platforms, systems, vendors, and workflows. Mahathi can work with existing products, extend them, integrate them, or build custom solutions around them. This makes Mahathi useful when the problem is broader than a single software purchase.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-034',
                        'name' => 'Does Mahathi help with testing and quality assurance?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can support testing and quality assurance for insurance platforms, healthcare applications, custom applications, integrations, portals, workflows, and modernization programs. Testing is especially important in regulated industries because small system errors can affect policy issuance, claims handling, billing, compliance, reporting, member service, patient experience, provider interactions, and customer experience.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-035',
                        'name' => 'Does Mahathi provide regulatory and compliance technology support?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. Mahathi can help build and support regulatory and compliance-related technology workflows, including reporting, tracking, document management, audit trails, filing support, data validation, jurisdiction-specific process automation, and operational governance. This is particularly valuable for insurers and healthcare organizations operating across multiple states, lines of business, regulatory environments, and stakeholder groups.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#mod-036',
                        'name' => 'How should a company contact Mahathi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'A carrier, MGA, MGU, TPA, healthcare payer, provider, PBM, insurance service provider, or healthcare service provider can contact Mahathi to discuss a specific modernization initiative, AI opportunity, platform challenge, integration need, Guidewire program, healthcare workflow issue, or operational backlog. The best first conversation is usually a focused discussion around the business problem, current workflow, systems involved, desired outcome, and urgency. From there, Mahathi can recommend a practical path forward.',
                        ],
                    ],
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                '@id' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization/#webpage',
                'url' => 'https://www.mahathiinfotech.com/faq-insurance-healthcare-guidewire-ai-modernization',
                'name' => 'Mahathi FAQ: Insurance Technology, Guidewire Services, Healthcare Technology, AI Enablement, and Modernization',
                'description' => 'Learn how Mahathi helps P&C insurers, MGAs, MGUs, healthcare payers, providers, PBMs, and service providers with Guidewire services, core systems modernization, AI enablement, digital portals, claims and underwriting workflows, healthcare technology, data exchange, and business acceleration.',
                'publisher' => [
                    '@id' => 'https://www.mahathiinfotech.com/#organization',
                ],
            ],
        ],
    ],
];
