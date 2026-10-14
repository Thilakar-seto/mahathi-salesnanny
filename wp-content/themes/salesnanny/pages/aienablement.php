<?php
/**
 * <app-aienablement> — converted from src/app/aienablement/aienablement.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<app-ai-banner><?php mh_component('ai-banner', ['pageData' => $aiData]); ?></app-ai-banner><div class="row no-gutters">
  <div class="col-12 py-0">
    <div>
      <section class="um-section  bg-sec-um">
        <div class="ai-cards-wrapper">
          <div class="ai-info-card">
            <div class="ai-info-image"><img src="<?= mh_asset_url('images/691ed6ca59edf1f17c2014ca_686670b6f9a6b572d19fee66_computer-8037838_1280-p-800 (1).jpg') ?>" alt="Opportunity"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Opportunity</h1>
              <p> Utilization management teams must manually review authorization (PA) requests daily. </p>
              <ul>
                <li>Long turnaround times (TAT)</li>
                <li>Provider dissatisfaction</li>
                <li>High nurse reviewer workload</li>
                <li>Inconsistent policy interpretation</li>
              </ul>
            </div>
          </div>
          <div class="ai-info-card">
            <div class="ai-info-image"><img src="<?= mh_asset_url('images/shutterstock_1472633513-scaled.jpg') ?>" alt="Solution"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Solution / Implementation</h1>
              <ul>
                <li>Deployed AI ingestion pipeline using NLP to convert fax, PDF, and FHIR data into structured clinical fields.</li>
                <li>Built LLM-based medical necessity engine using CMS + internal policy rules.</li>
                <li>Integrated AI with Core UM platform for auto-decisioning.</li>
                <li>Implemented human-in-the-loop review for feedback learning.</li>
              </ul>
            </div>
          </div>
          <div class="ai-info-card">
            <div class="ai-info-image"><img src="<?= mh_asset_url('images/AI-Hand-1.jpg') ?>" alt="Benefits"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Benefits / Outcome</h1>
              <ul>
                <li>65-75% reduction in PA turnaround time.</li>
                <li>Improved provider satisfaction (NPS +18).</li>
                <li>$8-12M annual savings.</li>
                <li>Consistent, auditable decisions.</li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="ai-risk-section bg-sec-risk-1">
        <h1 class="main-title">AI for Risk Adjustment &amp; Suspect Detection</h1>
        <div class="ai-risk-cards">
          <div class="ai-risk-card">
            <div class="ai-risk-image"><img src="<?= mh_asset_url('images/AI-in-Usability-Testing.jpg') ?>" alt="Risk Opportunity"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Opportunity</h1>
              <p>ACA populations require accurate HCC coding for RAF scoring. Manual chart reviews:</p>
              <ul class="main-list">
                <li>Miss high-value risk conditions</li>
                <li>Are expensive and slow</li>
                <li>Create CMS audit exposure</li>
              </ul>
            </div>
          </div>
          <div class="ai-risk-card">
            <div class="ai-risk-image"><img src="<?= mh_asset_url('images/Payment-Integrity_thumbnail-1.png') ?>" alt="Risk Solution"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Solution / Implementation</h1>
              <ul class="main-list">
                <li>Built AI-powered chart review engine: NLP models extract diagnoses from: <ul class="sub-list">
                    <li>Clinical notes</li>
                    <li>Hospital discharge summaries</li>
                    <li>Lab reports</li>
                  </ul></li>
                <li>ML model predicts: <ul class="sub-list">
                    <li>Suspect HCCs</li>
                    <li>Documentation gaps</li>
                  </ul></li>
                <li>Integrated with: <ul class="sub-list">
                    <li>Risk adjustment workflows</li>
                    <li>Provider coding validation portals</li>
                  </ul></li>
                <li>Embedded explainable AI (XAI) for CMS audit defense</li>
              </ul>
            </div>
          </div>
          <div class="ai-risk-card">
            <div class="ai-risk-image"><img src="<?= mh_asset_url('images/blog-image-api-enablement-de-en.webp') ?>" alt="Risk Benefits"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Benefits / Outcome</h1>
              <ul class="main-list">
                <li>RAF score improvement: <strong>+6-10%</strong></li>
                <li><strong>$45-70 PMPY</strong> revenue uplift</li>
                <li><strong>60% reduction</strong> in manual chart abstraction</li>
                <li>Improved CMS audit defensibility</li>
                <li>Higher first-pass coding accuracy</li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="ai-risk-section bg-sec-risk-2">
        <h1 class="main-title">AI-Based Claims &amp; Payment Integrity</h1>
        <div class="ai-risk-cards">
          <div class="ai-risk-card">
            <div class="ai-risk-image"><img src="<?= mh_asset_url('images/DALL·E-2024-02-22-19.10.07-A-wide-banner-image-showcasing-the-theme-_AI-in-Software-Development_-Trends-Stats-and-Growth._-The-image-should-feature-futuristic-artificial-intel-1024x585.webp') ?>" alt="Claims Opportunity"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Opportunity</h1>
              <p>Traditional rules-based claims editing:</p>
              <ul class="main-list">
                <li>Misses complex fraud schemes</li>
                <li>Flags too many false positives</li>
                <li>Delays claim payments</li>
                <li>Loses recovery dollars</li>
              </ul>
            </div>
          </div>
          <div class="ai-risk-card">
            <div class="ai-risk-image"><img src="<?= mh_asset_url('images/Enablement-vs.-Adoption_Two-Pillars-of-AI-Success-blog-imag.jpeg') ?>" alt="Claims Solution"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Solution / Implementation</h1>
              <ul class="main-list">
                <li>Deployed ML anomaly detection models across: <ul class="sub-list">
                    <li>CPT utilization</li>
                    <li>Provider billing patterns</li>
                    <li>Network leakage</li>
                  </ul></li>
                <li>Built graph AI to uncover: <ul class="sub-list">
                    <li>Provider collusion</li>
                    <li>Upcoding networks</li>
                  </ul></li>
              </ul>
            </div>
          </div>
          <div class="ai-risk-card">
            <div class="ai-risk-image"><img src="<?= mh_asset_url('images/Future-of-AI.jpg') ?>" alt="Claims Benefits"></div>
            <div class="ai-info-content">
              <h1 class="ai-info-title" style="font-size: 1.25rem;">Benefits / Outcome</h1>
              <ul class="main-list">
                <li>2.-4.5% claims leakage reduction</li>
                <li>50% improvement in fraud detection accuracy</li>
                <li>30-40% faster SIU investigations</li>
                <li>Lower provider abrasion</li>
                <li>Reduced false positives by ~35%</li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="automation-section"><h1 class="main-title2">AI-Driven automation services</h1><br><div class="process-grid">
          <div class="process-card">
            <div class="step-title">Process Assessment</div>
            <div class="step-connector"></div>
            <div class="step-body">Identify repetitive, rules-based tasks suitable for AI/ML</div>
          </div>
          <div class="process-card">
            <div class="step-title">Tool &amp; Tech Evaluation</div>
            <div class="step-connector"></div>
            <div class="step-body">Recommend platforms (UiPath, Power Automate, Azure Cognitive Services, etc.)</div>
          </div>
          <div class="process-card">
            <div class="step-title">Model selection/ training</div>
            <div class="step-connector"></div>
            <div class="step-body">If custom models are needed, gather data and train models (e.g., NLP for invoice extraction).</div>
          </div>
          <div class="process-card">
            <div class="step-title">Integration &amp; Testing</div>
            <div class="step-connector"></div>
            <div class="step-body">Deploy bots/models into existing workflows and systems.</div>
          </div>
          <div class="process-card">
            <div class="step-title">Monitoring &amp; Optimization</div>
            <div class="step-connector"></div>
            <div class="step-body">Set up performance dashboards and retraining</div>
          </div>
        </div></section>
      <section class="ai-dev-section bg-sec-dev">
        <div class="ai-dev-container">
          <h1 class="ai-dev-main-title">AI for Software Development &amp; Maintenance</h1>
          <p class="ai-dev-subtitle"> Deploying AI to <strong>improve internal efficiency and delivery productivity</strong> can generate significant impact — reducing costs, speeding up project timelines, and improving quality. </p>
          <div class="ai-dev-grid">
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/Intelligent-Process-Auto.jpg') ?>" alt="Code Generation"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Code Generation and Completion</h1>
                <p><strong>Tools:</strong> GitHub Copilot, AWS Code Whisperer, Tab Nine, or custom fine-tuned LLMs.</p>
                <p><strong>Use Case:</strong> Assist developers with boilerplate code, syntax, API usage, test case generation, and documentation.</p>
                <p><strong>Benefit:</strong> Faster development cycles, fewer syntax bugs, quicker onboarding of junior developers.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/istockphoto-1594284610-2048x2048-1.jpg') ?>" alt="Code Review"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Code Review and Quality Analysis</h1>
                <p><strong>Tools:</strong> Codacy, DeepCode, or AI-driven linters and static code analyzers.</p>
                <p><strong>Use Case:</strong> Pre-pull-request checks, bug pattern detection, security vulnerabilities. </p>
                <p><strong>Benefit:</strong> Consistent code quality, reduced manual effort in code reviews.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/knowledge-management.jpg') ?>" alt="Test Case Generation"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Test Case Generation</h1>
                <p><strong>Tools:</strong> Testim, Applitools, Functionize, or use GPT-based custom scripts.</p>
                <p><strong>Use Case:</strong> Automatically generate test cases from user stories or code changes.</p>
                <p><strong>Benefit:</strong> Increased test coverage with less manual effort.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/linkedIN-1920x1080-1.jpg') ?>" alt="Test Optimization"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Smart Test Execution &amp; Optimization</h1>
                <p><strong>Use Case:</strong> Use ML models to prioritize test cases based on historical failure patterns, code changes, or risk.</p>
                <p><strong>Benefit:</strong> Reduces regression testing time while maintaining coverage.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/unnamed.jpg') ?>" alt="Visual UX Testing"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Visual &amp; UX Testing</h1>
                <p><strong>Tools:</strong> Applitools Eyes, Percy.</p>
                <p><strong>Use Case:</strong> AI detects UI changes visually across builds or environments.</p>
                <p><strong>Benefit:</strong> Faster and more accurate than manual pixel-to-pixel checks.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/More-Intelligent-Choices.jpg') ?>" alt="Incident Triage"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Incident Triage and Root Cause Analysis</h1>
                <p><strong>Use Case:</strong> NLP models analyze logs, user reports, and past tickets to suggest fixes. </p>
                <p><strong>Benefit:</strong> Faster issue resolution and reduced L1/L2 loads.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/Open-Source-AI_1284e396-db73-4d27-9205-24be65d4c95.jpeg') ?>" alt="Chatbot Support"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Chatbot for Client Support</h1>
                <p><strong>Use Case:</strong> Integrate AI agents with your helpdesk or CRM for 24/7 Tier 1 support.</p>
                <p><strong>Benefit:</strong> Reduces human load and increases response speed.</p>
              </div>
            </div>
            <div class="ai-risk-card">
              <div class="ai-risk-image"><img src="<?= mh_asset_url('images/partner-enablement-revolution-by-ai.jpg') ?>" alt="Knowledge Management"></div>
              <div class="ai-info-content">
                <h1 class="ai-info-title" style="font-size: 1.25rem;">Knowledge Management &amp; Onboarding</h1>
                <p><strong>Use Case:</strong> AI trained on your internal documentation, APIs, runbooks, technical specs and change logs.</p>
                <p><strong>Benefit:</strong> Saves manual effort and improves maintainability.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="cust-ai-container">
          <h1 class="cust-ai-main-title">Custom AI Application Development</h1>
          <p class="cust-ai-subtitle">Design and build AI-enabled software products or features tailored to client needs.</p>
          <div class="cust-ai-grid">
            <div class="cust-ai-column">
              <div class="cust-ai-header">Requirements Gathering</div>
              <div class="cust-ai-body">Understand functional needs and desired AI capabilities (e.g., chatbots, recommendations, fraud detection).</div>
            </div>
            <div class="cust-ai-column">
              <div class="cust-ai-header">Model Dev &amp; Selection</div>
              <div class="cust-ai-body">Build or fine-tune models using client or third-party data.</div>
            </div>
            <div class="cust-ai-column">
              <div class="cust-ai-header">Full stack development</div>
              <div class="cust-ai-body">Develop front-end and back-end components with integrated AI models.</div>
            </div>
            <div class="cust-ai-column">
              <div class="cust-ai-header">Deployment</div>
              <div class="cust-ai-body">Host on-prem or cloud (AWS, Azure, GCP) with CI/CD pipelines. </div>
            </div>
            <div class="cust-ai-column">
              <div class="cust-ai-header">Support &amp; Scaling</div>
              <div class="cust-ai-body">Provide post-launch monitoring, updates, and model retraining support.</div>
            </div>
          </div>
          <div class="cust-ai-deliverables-container">
            <div class="cust-ai-deliverables-pill deliverables-v2-title"> Key deliverables </div>
            <div class="deliverables-v2-grid">
              <ul class="deliverables-v2-item"> Functional &amp; Tech Spec Doc </ul>
              <ul class="deliverables-v2-item"> Custom AI Models (hosted or on-device) </ul>
              <ul class="deliverables-v2-item"> End-to-End Application (web/mobile/backend) </ul>
              <ul class="deliverables-v2-item"> DevOps / Monitoring Setup &amp; Support SLAs </ul>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
