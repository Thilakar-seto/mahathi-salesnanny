<?php
/**
 * <app-header> — converted from src/app/sharedComponents/header/header.component.html
 */
if (!defined('ABSPATH')) { exit; }

// "Resources" menu (desktop dropdown + mobile accordion). Blog is the company blog the site already links to
// (the articles are listed on our own /blog page); Tools is the PAS Migration Problem Finder, the site's first tool.
$mh_resources = array(
    array('label' => 'News',  'url' => mh_url('/news'),                          'desc' => 'Company announcements, awards and milestones.',                                   'external' => false, 'active' => mh_active('/news', true)),
    array('label' => 'Blog',  'url' => mh_url('/blog'),                          'desc' => 'Insights and perspectives on insurance, healthcare and technology.',               'external' => false, 'active' => mh_active('/blog', true)),
    array('label' => 'Tools', 'url' => mh_url('/pas-migration-problem-finder'),  'desc' => 'Interactive assessments, starting with the PAS Migration Problem Finder.',        'external' => false, 'active' => mh_active('/pas-migration-problem-finder', true)),
);
?>
<section class="page-block-section page-header<?= mh_cls($headerClass) ?>" id="page-block-header">
  <div class="mobile-header-top d-lg-none">
    <div class="container-fluid px-lg-5 head">
      <div class="row h-100 align-items-center">
        <div class="col d-flex align-items-center"><button class="hamburger-menu" type="button" aria-label="Toggle navigation" id="headerToggler" data-mh-action="toggleMobileMenu"><span class="hamburger-icon"></span><span class="hamburger-icon"></span><span class="hamburger-icon"></span></button><img data-href="<?= esc_url(mh_url('/')) ?>" class="header-logo mobile-logo" src="<?= mh_asset_url('images/mahathi_logo_White.png') ?>" alt="Mahathi Infotech Logo"></div>
      </div>
    </div>
  </div>
  <div class="page-header-head">
    <div class="page-header-nav1 d-none d-lg-flex align-items-stretch" style="min-height: 35px;" id="page-header-nav1">
      <div class="container-fluid px-lg-5 px-5 head">
        <div class="row h-100 align-items-stretch flex-nowrap">
          <div class="col navbar-col">
            <nav class="navbar pb-0 pt-0 px-0 navbar-expand-md h-100 w-100">
              <div class="d-md-none d-md-block h-100 w-100">
                <ul class="navbar-nav mr-auto w-100 h-100 d-flex align-items-stretch flex-column flex-md-row header-links" style="justify-content:end;">
                  <li class="location nav-item ct-mega-dropdown mob-none"><a class="nav-link location" href="javascript:void(0)" data-mh-action="toggleLocationsMenu">
                      <p style="font-weight: 200; color: white !important;"> Locations </p>
                    </a><div class="dropdown-menu ct-mega-menu px-0 py-4 py-lg-5" id="locationMenu">
                      <div class="container align-items-stretch">
                        <div class="row">
                          <div class="col-lg-4 border-right">
                            <div class="item-details-container-title text-left"><div class="custom-award-card" data-href="<?= esc_url(mh_url('/contact-us?location=usa')) ?>">
                                <h2> USA - HQ </h2>
                                <p> 630 Freedom Business Center Drive, <br> Floor #3,<br> King of Prussia, PA 19406 </p>
                              </div><br><div class="custom-award-card" data-href="<?= esc_url(mh_url('/contact-us?location=usa')) ?>">
                                <h2> USA - Technology Delivery Hub </h2>
                                <p><br>19 Mystic Lane<br> Malvern, PA 19355 <br></p>
                              </div></div>
                          </div>
                          <div class="col-lg-4 border-right">
                            <div class="item-details-container-title text-left"><div class="custom-award-card" data-href="<?= esc_url(mh_url('/contact-us?location=india')) ?>">
                                <h2> India - GDC One </h2>
                                <p> 21D, 3rd Floor, Raagavis Center,<br> Nanjunda Puram Road,<br>Ramanathapuram, Coimbatore - 641045 </p>
                              </div><br><div class="custom-award-card" data-href="<?= esc_url(mh_url('/contact-us?location=india')) ?>">
                                <h2> India - GDC Managed Services Hub </h2>
                                <p> 2nd Floor, Rakavis Square,<br> Palaniappa Nagar, Sowripalayam Pririvu,<br> Ramanathapuram, Coimbatore - 641045 </p>
                              </div></div>
                          </div>
                          <div class="col-lg-4 border-right">
                            <div class="item-details-container-title text-left"><div class="custom-award-card" data-href="<?= esc_url(mh_url('/contact-us?location=uae')) ?>">
                                <h2> UAE - Dubai Innovation Hub </h2>
                                <p> FZCO Building A1,<br> Dubai Digital Park, Dubai Silicon Oasis, <br> Dubai </p>
                              </div><br><div class="custom-award-card" data-href="<?= esc_url(mh_url('/contact-us?location=philippines')) ?>">
                                <h2> Philippines - Automation Hub </h2>
                                <p><br> 25 F, Legaspi Street, Brgy. <br> Maybunga, Pasig City </p>
                              </div></div>
                          </div>
                        </div>
                      </div>
                    </div></li>
                  <li class="location nav-item  ct-mega-dropdown mob-none" id="megaMenuToggler" data-toggle="collapse" data-target="#awardsmenu"><a class="nav-link" href="#">
                      <p style="font-weight: 200;color: white !important;">Awards</p>
                    </a><div class="dropdown-menu ct-mega-menu px-0" id="awardsmenu">
                      <div class="container py-4">
                        <div class="row justify-content-center" style="margin-bottom: 30px;">
                          <div class="col-lg-4 mb-3">
                            <div class="custom-award-card"><h2 class="award-title">INC. 5000</h2><div class="award-divider"></div><span> 2023 - 2025</span><p s> Fastest growing privately held company</p></div>
                          </div>
                          <div class="col-lg-4 mb-3">
                            <div class="custom-award-card"><h2 class="award-title">Philadelphia100</h2><div class="award-divider"></div><span> 2023 - 2025</span><p class="award-desc"> Fastest growing privately held company</p><span> 2020 - 2021</span><p class="award-desc"> Fastest growing privately held company</p></div>
                          </div>
                          <div class="col-lg-4 mb-3">
                            <div class="custom-award-card"><h2 class="award-title">PBJ Fast 50</h2><div class="award-divider"></div><span> 2025</span><p class="award-desc">Philadelphia Business Journal 50 fastest growing companies</p></div>
                          </div>
                          <div class="col-lg-3 border-right d-none">
                            <div class="item-details-container-title text-left">
                              <h2 class="textcolor_orange">PBJ Fast 50</h2>
                              <p> Philadelphia Business Journal 50 fastest growing companies </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div></li>
                  <li class="location nav-item  ct-mega-dropdown mob-none" id="megaMenuToggler" data-toggle="collapse" data-target="#certificationsmenu"><a class="nav-link" href="#">
                      <p style="font-weight: 200;color: white !important;">Certifications</p>
                    </a><div class="dropdown-menu ct-mega-menu px-0" id="certificationsmenu">
                      <div class="container py-4">
                        <div class="row justify-content-center" style="margin-bottom: 60px;">
                          <div class="col-lg-4 border-center">
                            <div class="item-details-container-title text-left">
                              <div class="custom-award-card"><h2 style="color: #6d9b73;">MBE</h2><div class="award-divider"></div><p> NMSDC certified Minority Business Enterprise </p><br></div>
                            </div>
                          </div>
                          <div class="col-lg-4 border-right">
                            <div class="item-details-container-title text-left">
                              <div class="custom-award-card">
                                <h2 style="color: #6d9b73;">PA - SBE</h2>
                                <div class="award-divider"></div>
                                <p style="padding-bottom: 7px !important;"> Commonwealth of Pennsylvania certified Small Business Enterprise </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div></li>
                  <li class="location nav-item mob-none"><a class="nav-link" href="https://blog.mahathiinfotech.com/" target="_blank" rel="noopener noreferrer">
                      <p style="font-weight: 200;color: white !important;">Blogs</p>
                    </a></li>
                  <li class="location nav-item mob-none"><a class="nav-link" href="javascript:void(0)" data-href="https://www.linkedin.com/company/mahathiinfo/jobs/" data-target="_blank">
                      <p style="font-weight: 200;color: white !important;">Careers</p>
                    </a></li>
                  <li class="location nav-item"><div class="header-search-toggle d-none d-md-block mt-1"><button class="search-toggle" type="button" data-toggle="collapse" data-target="#page-header-search" aria-expanded="false" aria-controls="page-header-search" title="Search"><span class="mr-3">Search</span><i class="fas fa-search"></i></button></div><button class="navbar-toggler d-inline-block d-md-none mt-1" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-header-search collapse" id="page-header-search">
    <div class="container px-6">
      <div class="row">
        <div class="col">
          <form class="form-inline my-2 my-lg-0" action="javascript:void(0)"><input type="text" placeholder="Enter your search..." aria-label="Search"><ul class="search-results" hidden></ul><div class="search-buttons"><button class="submit-search" type="submit"><i class="fas fa-search"></i></button><button class="search-toggle" type="button" data-toggle="collapse" data-target="#page-header-search" aria-expanded="false" aria-controls="page-header-search" title="Search"><i class="fas fa-times"></i></button></div></form>
        </div>
      </div>
    </div>
  </div>
  <div class="page-header-nav d-none d-md-flex align-items-stretch<?= mh_cls(['scrolled' => ($headerClass === 'inner')]) ?>" style="min-height: 85px;" id="page-header-nav">
    <div class="container-fluid">
      <div class="row h-100 align-items-stretch flex-nowrap">
        <div class="col-auto d-flex align-items-center py-0"><img data-href="<?= esc_url(mh_url('/')) ?>" class="header-logo normal-logo" src="<?= mh_asset_url('images/mahathi_logo_White.png') ?>" alt="Mahathi Infotech Logo"><img data-href="<?= esc_url(mh_url('/')) ?>" class="header-logo scrolled-logo" src="<?= mh_asset_url('images/mahathi_logo2.png') ?>" alt="Mahathi Infotech Logo"><img data-href="<?= esc_url(mh_url('/')) ?>" class="header-logo mobile-logo" src="<?= mh_asset_url('images/mahathi_logo_White.png') ?>" alt="Mahathi Infotech Logo"></div>
        <div class="col navbar-col">
          <nav class="navbar pb-0 pt-0 px-0 navbar-expand-md h-100 w-100">
            <div class="d-none d-md-block h-100 w-100">
              <ul class="navbar-nav mr-auto w-100 h-100 d-flex align-items-stretch flex-column flex-md-row" style="justify-content:end;">
                <li class="nav-item  ct-mega-dropdown<?= mh_isParentMenuActive('InsuranceMenu') ? ' active' : '' ?>" style="cursor:pointer;" id="megaMenuToggler" data-toggle="collapse" data-target="#InsuranceMenu"><a class="nav-link">
                    <p>INSURANCE Solutions</p>
                  </a><div class="dropdown-menu ct-mega-menu px-0 py-0 py-lg-0 smart-mega-animate" style="cursor:pointer;opacity: 0.95;" id="InsuranceMenu">
                    <div class="container mb-5 smart-mega-inner" style="min-height: auto;">
                      <div class="row">
                        <div class="col-md-8 col-lg-8 text-left py-0 border-right">
                          <div class="row">
                            <div class="col-md-8 col-lg-8 py-3">
                              <h2 class="text-left" data-href="<?= esc_url(mh_url('/insurance')) ?>" style="cursor:pointer;"><strong>Our Solutions:</strong></h2>
                              <p class="text-left">Achieve your business goals with our comprehensive solution portfolio.</p>
                            </div>
                          </div>
                          <div class="row">
                            <div data-href="<?= esc_url(mh_url('/insurance/workers-compensation')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>Workers Comp</b></h4>
                              <p class="text-left"> Commercial Carrier Enablement, Policy Admin, Billing, Claims Management, Medical &amp; Pharmacy Management, Investigative Services, Litigation Management, Regulator &amp; Compliance, and Loss Control Services</p>
                            </div>
                            <div data-href="<?= esc_url(mh_url('/insurance/p-and-c-solution')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>Property &amp; Casualty </b></h4>
                              <p class="text-left"> Admitted Package Lines, Excess &amp; Surplus, Specialty Products, Service Center Enablement, Claims, Policy, Billing Management, Litigation Management </p>
                            </div>
                          </div>
                          <div class="row">
                            <div data-href="<?= esc_url(mh_url('/insurance/managed-care-organization')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>​Managed Care Organizations</b></h4>
                              <p class="text-left"> Medication Intervention, Revenue Loss Prevention, Case Management Optimization, PBM Accelerators </p>
                            </div>
                            <div data-href="<?= esc_url(mh_url('/insurance/life-and-annuity')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>Life &amp; Annuity</b></h4>
                              <p class="text-left"> Claims Transformation, Actuarial Practice Transformation,Digital Platform Management, Insurance Modernization ​ </p>
                            </div>
                          </div>
                          <div class="row">
                            <div data-href="<?= esc_url(mh_url('/insurance/re-insurance')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>Reinsurance</b></h4>
                              <p class="text-left"> Claims, Policy, Billing Management </p>
                            </div>
                            <div data-href="<?= esc_url(mh_url('/insurance/guidewire')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>Guidewire</b></h4>
                              <p class="text-left"> ClaimCenter &amp; PolicyCenter Implementation, Cloud Migration &amp; Modernization, Integration &amp; Legacy Data Conversion, Application Managed Services </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-lg-4 py-3 text-left">
                          <div class="row">
                            <div class="col-lg-12 py-0"><img class="mb-2" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;" src="<?= mh_asset_url('images/healthcare_Solutio.jpeg') ?>" alt="Healthcare solutions icon"><h4 style="color: #76A379;"><b>Compliance-as-a-Service providing comprehensive Statutory Reporting and Regulatory Operations</b></h4><p class="text-left">WorkersComp and P&amp;C compliance services covering FROI/SROI Employer Proof of Coverage, WCPOLS, CMS, Medical Data Reporting, Medical Billing reporting, analytics, automation, regulatory support, and multi-state statutory data operations.</p><span data-href="<?= esc_url(mh_url('/compliance')) ?>" class="px-4 py-2 inline-block border rounded-full duration-300 ease py-15px lg:py-20px px-25px lg:px-50px text-violet border-violet hover:bg-violet hover:text-white group" style="background-color: #76A379; color: #F4F4F2;">
                                <div class="flex items-center lg:text-20"><span class="order-1">Learn more</span><svg class="w-15px order-2 ml-5px ml-3" width="100%" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51724 0.947642L9.46354 0.892566L9.40984 0.947643L8.85971 1.51188L8.80892 1.56397L8.85944 1.61632L12.8416 5.74271H1H0.925V5.81771V6.59896V6.67396H1H12.8416L8.85944 10.8004L8.80892 10.8527L8.85971 10.9048L9.40984 11.469L9.46354 11.5241L9.51724 11.469L14.5954 6.26069L14.6464 6.20833L14.5954 6.15598L9.51724 0.947642Z" fill="currentColor" stroke="currentColor" stroke-width="0.15"></path></svg></div>
                              </span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></li>
                <li class="nav-item  ct-mega-dropdown<?= mh_isParentMenuActive('HealthcareMenu') ? ' active' : '' ?>" style="cursor:pointer;opacity: 0.95;" id="megaMenuToggler" data-toggle="collapse" data-target="#HealthcareMenu"><a class="nav-link">
                    <p>HEALTHCARE SOLUTIONS</p>
                  </a><div class="dropdown-menu ct-mega-menu px-0 py-0 py-lg-0 smart-mega-animate" id="HealthcareMenu">
                    <div class="container mb-5 smart-mega-inner" style="min-height: auto;">
                      <div class="row">
                        <div class="col-md-8 col-lg-8 text-left py-0 border-right">
                          <div class="row">
                            <div class="col-md-8 col-lg-8 py-3">
                              <h2 class="text-left"><strong>Our Solutions:</strong></h2>
                              <p class="text-left">Achieve your business goals with our comprehensive solution portfolio.</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <div data-href="<?= esc_url(mh_url('/healthcare')) ?>" class="summary">
                                <h4 style="color: #76A379;"><b>Core Healthcare Platforms &amp; Digital Experience</b></h4>
                                <p class="text-left">Enrollment, core administration systems, and member/patient engagement platforms. </p>
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-6 py-3 our_solution_box" data-href="<?= esc_url(mh_url('/healthcare?tab=1#healthcare-tabs')) ?>">
                              <div class="summary">
                                <h4 style="color: #76A379;"><b>Claims, Revenue &amp; Financial Operations</b></h4>
                                <p class="text-left">Claims processing, billing, payments, and revenue optimization across the healthcare lifecycle.</p>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-lg-6 py-3 our_solution_box" data-href="<?= esc_url(mh_url('/healthcare?tab=2#healthcare-tabs')) ?>">
                              <div class="summary">
                                <h4 style="color: #76A379;"><b>Clinical, Pharmacy &amp; Care Management</b></h4>
                                <p class="text-left">Utilization management, care coordination, pharmacy operations, and value-based care enablement.</p>
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-6 py-3 our_solution_box" data-href="<?= esc_url(mh_url('/healthcare?tab=3#healthcare-tabs')) ?>">
                              <div class="summary">
                                <h4 style="color: #76A379;"><b>Data, AI, Compliance &amp; Risk</b></h4>
                                <p class="text-left">Regulatory compliance, fraud detection, analytics, AI-driven automation, and secure interoperability.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-lg-4 py-3 text-left">
                          <div class="row">
                            <div class="col-lg-12 py-0"><img class="mb-4" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;" src="<?= mh_asset_url('images/pic_2.png') ?>" alt="Healthcare solutions illustration"><h4 style="color: #76A379;"><b>The trusted digital evolution and interoperability partner for Health Systems, Payers, and HealthTech Innovators</b></h4><p class="text-left">By uniting clinical insight with deep technical mastery across the healthcare continuum, we deliver transformative digital outcomes. With over a decade of experience, we help our partners navigate complex regulatory landscapes while enhancing patient-centric care through modern technology.</p><a class="px-4 py-2 inline-block border rounded-full duration-300 ease" style="background-color: #6d9b73; color:#F4F4F2;" data-href="<?= esc_url(mh_url('/healthcare?tab=4')) ?>">
                                <div class="flex items-center lg:text-20"><span class="order-1">Learn more</span><svg class="w-15px order-2 ml-5px ml-3" width="100%" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51724 0.947642L9.46354 0.892566L9.40984 0.947643L8.85971 1.51188L8.80892 1.56397L8.85944 1.61632L12.8416 5.74271H1H0.925V5.81771V6.59896V6.67396H1H12.8416L8.85944 10.8004L8.80892 10.8527L8.85971 10.9048L9.40984 11.469L9.46354 11.5241L9.51724 11.469L14.5954 6.26069L14.6464 6.20833L14.5954 6.15598L9.51724 0.947642Z" fill="currentColor" stroke="currentColor" stroke-width="0.15"></path></svg></div>
                              </a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></li>
                <li class="nav-item ct-mega-dropdown<?= mh_isParentMenuActive('AIMenu') ? ' active' : '' ?>" style="cursor:pointer;opacity: 0.95;" id="megaMenuToggler" data-toggle="collapse" data-target="#AIMenu"><a class="nav-link">
                    <p>AI ENABLEMENT</p>
                  </a><div class="dropdown-menu ct-mega-menu px-0 py-0 py-lg-0 smart-mega-animate" id="AIMenu">
                    <div class="container mb-5 smart-mega-inner" style="min-height: auto;">
                      <div class="row">
                        <div class="col-md-8 col-lg-8 text-left py-0 border-right">
                          <div class="row">
                            <div class="col-md-8 col-lg-8 py-3">
                              <h2 class="text-left"><strong>Our Services:</strong></h2>
                              <p class="text-left">Transform your organization with intelligent AI solutions tailored to your business needs.</p>
                            </div>
                          </div>
                          <div class="row">
                            <div data-href="<?= esc_url(mh_url('/ai-enablement')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 class="text-left" style="color: #76A379;"><b>AI readiness &amp; strategy consulting</b></h4>
                              <p class="text-left">Help clients assess their readiness and define a roadmap for adopting AI in their business.</p>
                            </div>
                            <div data-href="<?= esc_url(mh_url('/ai-enablement')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 class="text-left" style="color: #76A379;"><b>AI-Driven automation services</b></h4>
                              <p class="text-left">Implement AI to streamline and automate routine tasks like document processing and customer service.</p>
                            </div>
                          </div>
                          <div class="row">
                            <div data-href="<?= esc_url(mh_url('/ai-enablement')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 class="text-left" style="color: #76A379;"><b>AI for software development productivity</b></h4>
                              <p class="text-left">Deploy AI to improve internal efficiency — reducing costs and speeding up project timelines.</p>
                            </div>
                            <div data-href="<?= esc_url(mh_url('/ai-enablement')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 class="text-left" style="color: #76A379;"><b>Custom AI application development</b></h4>
                              <p class="text-left">Design and build AI-enabled software products or features tailored to your specific needs. </p>
                            </div>
                          </div>
                          <div class="row">
                            <div data-href="<?= esc_url(mh_url('/databricks')) ?>" class="col-md-6 col-lg-6 py-3 our_solution_box">
                              <h4 style="color: #76A379;"><b>Databricks</b></h4>
                              <p class="text-left"> Lakehouse Implementation, Zero-Downtime Migration, Real-Time Analytics, AI/ML &amp; Governance for Insurance &amp; Healthcare </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-lg-4 py-3 text-left">
                          <div class="row">
                            <div class="col-lg-12 py-0"><img class="mb-4" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;" src="<?= mh_asset_url('images/Ai_Services.jpeg') ?>" alt="AI services illustration"><h4 class="text-left" style="color: #76A379;"><b>Transform with Intelligent AI Solutions</b></h4><p class="text-left">From strategy to implementation, we provide end-to-end AI enablement that drives measurable business impact and operational efficiency.</p><a href="<?= esc_url(mh_url('/ai-enablement')) ?>" class="px-4 py-2 inline-block border rounded-full duration-300 ease py-15px lg:py-20px px-25px lg:px-50px text-violet border-violet hover:bg-violet hover:text-white group" style="background-color: #6d9b73; color:#F4F4F2;">
                                <div class="flex items-center lg:text-20"><span class="order-1">Learn more</span><svg class="w-15px order-2 ml-5px ml-3" width="100%" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51724 0.947642L9.46354 0.892566L9.40984 0.947643L8.85971 1.51188L8.80892 1.56397L8.85944 1.61632L12.8416 5.74271H1H0.925V5.81771V6.59896V6.67396H1H12.8416L8.85944 10.8004L8.80892 10.8527L8.85971 10.9048L9.40984 11.469L9.46354 11.5241L9.51724 11.469L14.5954 6.26069L14.6464 6.20833L14.5954 6.15598L9.51724 0.947642Z" fill="currentColor" stroke="currentColor" stroke-width="0.15"></path></svg></div>
                              </a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></li>
                <li class="nav-item"><a href="<?= esc_url(mh_url('/digital-services')) ?>" class="nav-link<?= mh_active('/digital-services', true) ? ' active' : '' ?>">
                    <p>DIGITAL SERVICES</p>
                  </a></li>
                <li class="nav-item ct-mega-dropdown d-none<?= mh_isParentMenuActive('DigitalServicesMenu') ? ' active' : '' ?>" style="cursor:pointer;opacity: 0.95;" id="megaMenuToggler" data-toggle="collapse" data-target="#DigitalServicesMenu"><a class="nav-link">
                    <p>DIGITAL SERVICES</p>
                  </a><div class="dropdown-menu ct-mega-menu px-0 py-0 py-lg-0 smart-mega-animate" id="DigitalServicesMenu">
                    <div class="container mb-5 smart-mega-inner" style="min-height: auto;">
                      <div class="row">
                        <div class="col-md-8 col-lg-8 text-left py-0 border-right">
                          <div class="row">
                            <div class="col-md-8 col-lg-8 py-3">
                              <h2 class="text-left"><strong>Our Services:</strong></h2>
                              <p class="text-left">Achieve your business goals with our comprehensive services portfolio.</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4 col-lg-4 py-3 our_digital_box border-right">
                              <h4 style="color: #76A379;"><b>Application Services</b></h4>
                              <h4 style="color: #76A379;"><b>Business Consulting</b></h4>
                              <h4 style="color: #76A379;"><b>Business Process Services</b></h4>
                              <h4 style="color: #76A379;"><b>Infrastructure Services</b></h4>
                              <h4 style="color: #76A379;"><b>Managed Services</b></h4>
                            </div>
                            <div class="col-md-4 col-lg-4 py-3 our_digital_box border-right">
                              <h4 style="color: #76A379;"><b>Artificial Intelligence</b></h4>
                              <h4 style="color: #76A379;"><b>Cloud</b></h4>
                              <h4 style="color: #76A379;"><b>Data Analytics</b></h4>
                              <h4 style="color: #76A379;"><b>Digital Transformation</b></h4>
                              <h4 style="color: #76A379;"><b>IT Modernization</b></h4>
                            </div>
                            <div class="col-md-4 col-lg-4 py-3 our_digital_box">
                              <h4 style="color: #76A379;"><b>Cybersecurity</b></h4>
                              <h4 style="color: #76A379;"><b>Data Management &amp; Modernization</b></h4>
                              <h4 style="color: #76A379;"><b>IT-Enabled Business Process Services</b></h4>
                              <h4 style="color: #76A379;"><b>Systems Integration &amp; Modernization</b></h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-lg-4 py-3 text-left">
                          <div class="row">
                            <div class="col-lg-12 py-0"><img class="mb-4" style="width: 100%; height: 180px;" src="<?= mh_asset_url('images/pic_3.png') ?>" alt="Insurance solutions illustration"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></li>
                <li class="nav-item ct-mega-dropdown" style="cursor:pointer;opacity: 0.95;" id="megaMenuToggler" data-toggle="collapse" data-target="#ResourcesMenu"><a class="nav-link">
                    <p>Resources</p>
                  </a><div class="dropdown-menu ct-mega-menu px-0 py-0 py-lg-0 smart-mega-animate" id="ResourcesMenu">
                    <div class="container mb-5 smart-mega-inner" style="min-height: auto;">
                      <div class="row">
                        <div class="col-md-8 col-lg-8 text-left py-0 border-right">
                          <div class="row">
                            <div class="col-md-8 col-lg-8 py-3">
                              <h2 class="text-left"><strong>Resources:</strong></h2>
                              <p class="text-left">News, insights and tools from Mahathi to help you plan with confidence.</p>
                            </div>
                          </div>
                          <div class="row">
                            <?php foreach ($mh_resources as $item) : ?>
                              <div data-href="<?= esc_url($item['url']) ?>"<?= $item['external'] ? ' data-target="_blank"' : '' ?> class="col-md-6 col-lg-6 py-3 our_solution_box">
                                <h4 class="text-left" style="color: #76A379;"><b><a href="<?= esc_url($item['url']) ?>"<?= $item['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?> style="color: inherit; text-decoration: none;"><?= esc_html($item['label']) ?><?php if ($item['external']) : ?><span class="mh-res-sr"> (opens in a new tab)</span><?php endif; ?></a></b></h4>
                                <p class="text-left"><?= esc_html($item['desc']) ?></p>
                              </div>
                            <?php endforeach; ?>
                          </div>
                        </div>
                        <div class="col-md-4 col-lg-4 py-3 text-left">
                          <div class="row">
                            <div class="col-lg-12 py-0"><img class="mb-4" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;" src="<?= mh_asset_url('images/news_Banner.jpg') ?>" alt="Mahathi team at work"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></li>
                <li class="nav-item"><a href="<?= esc_url(mh_url('/about-us')) ?>" class="nav-link<?= mh_active('/about-us', false) ? ' active' : '' ?>">
                    <p>About us</p>
                  </a></li>
                <li class="nav-item"><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="nav-link<?= mh_active('/contact-us', false) ? ' active' : '' ?>">
                    <p>Contact us</p>
                  </a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="page-header-head">
    <div class="page-header-nav-mobile d-lg-none">
      <nav class="navbar navbar-expand-lg px-3">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav w-100">
            <li class="nav-item level-1-nav">
              <div class="container mobile-main" data-mh-action="toggleMobileSub" data-mh-args="<?= esc_attr(wp_json_encode(['panda'])) ?>"><a class="nav-link">Product &amp; Accelerators</a><i class="fas fa-chevron-down"></i></div>
              <div class="mobile-submenu" data-mh-submenu="panda" hidden><a href="<?= esc_url(mh_url('/integrated-mailroom')) ?>">Integrated Mailroom</a><a href="<?= esc_url(mh_url('/workbench-solution')) ?>">WorkBench Solutions</a><a href="<?= esc_url(mh_url('/compliance')) ?>">Compliance As a Service</a><a href="<?= esc_url(mh_url('/siu-investigative')) ?>">SIU &amp; Investigations Services</a><a href="<?= esc_url(mh_url('/litigation')) ?>">Litigation Support Services</a></div>
            </li>
            <li class="nav-item level-1-nav">
              <div class="container mobile-main" data-mh-action="toggleMobileSub" data-mh-args="<?= esc_attr(wp_json_encode(['insurance'])) ?>"><a class="nav-link">INSURANCE Solutions</a><i class="fas fa-chevron-down"></i></div>
              <div class="mobile-submenu" data-mh-submenu="insurance" hidden><a href="<?= esc_url(mh_url('/insurance/workers-compensation')) ?>">Workers Comp</a><a href="<?= esc_url(mh_url('/insurance/p-and-c-solution')) ?>">Property &amp; Casualty</a><a href="<?= esc_url(mh_url('/insurance/managed-care-organization')) ?>">​Managed Care Organizations</a><a href="<?= esc_url(mh_url('/insurance/life-and-annuity')) ?>">Life &amp; Annuity</a><a href="<?= esc_url(mh_url('/insurance/re-insurance')) ?>">Reinsurance</a><a href="<?= esc_url(mh_url('/insurance/guidewire')) ?>">Guidewire</a></div>
            </li>
            <li class="nav-item level-1-nav">
              <div class="container mobile-main" data-mh-action="toggleMobileSub" data-mh-args="<?= esc_attr(wp_json_encode(['healthcare'])) ?>"><a class="nav-link">HEALTHCARE Solutions</a><i class="fas fa-chevron-down"></i></div>
              <div class="mobile-submenu" data-mh-submenu="healthcare" hidden><a href="<?= esc_url(mh_url_q(mh_url('/healthcare'), ['tab' => 0])) ?>"> Core Healthcare Platforms &amp; Digital Experience </a><a href="<?= esc_url(mh_url_q(mh_url('/healthcare'), ['tab' => 1])) ?>"> Claims, Revenue &amp; Financial Operations </a><a href="<?= esc_url(mh_url_q(mh_url('/healthcare'), ['tab' => 2])) ?>"> Clinical, Pharmacy &amp; Care Management </a><a href="<?= esc_url(mh_url_q(mh_url('/healthcare'), ['tab' => 3])) ?>"> Data, AI, Compliance &amp; Risk </a></div>
            </li>
            <li class="nav-item level-1-nav">
              <div class="container mobile-main" data-mh-action="toggleMobileSub" data-mh-args="<?= esc_attr(wp_json_encode(['ai'])) ?>"><a class="nav-link">AI ENABLEMENT</a><i class="fas fa-chevron-down"></i></div>
              <div class="mobile-submenu" data-mh-submenu="ai" hidden><a href="<?= esc_url(mh_url('/ai-enablement')) ?>">AI readiness &amp; strategy consulting</a><a href="<?= esc_url(mh_url('/ai-enablement')) ?>">AI-Driven automation services</a><a href="<?= esc_url(mh_url('/ai-enablement')) ?>">AI for software development productivity</a><a href="<?= esc_url(mh_url('/ai-enablement')) ?>">Custom AI application development</a><a href="<?= esc_url(mh_url('/databricks')) ?>">Databricks</a></div>
            </li>
            <li class="nav-item level-1-nav">
              <div class="container"><a href="<?= esc_url(mh_url('/digital-services')) ?>" class="nav-link"> DIGITAL SERVICES </a></div>
            </li>
            <?php /* No "active" class here: the site's active style is green text, which is invisible on the green mobile menu. */ ?>
            <li class="nav-item level-1-nav">
              <div class="container mobile-main" data-mh-action="toggleMobileSub" data-mh-args="<?= esc_attr(wp_json_encode(['resources'])) ?>"><a class="nav-link">Resources</a><i class="fas fa-chevron-down"></i></div>
              <div class="mobile-submenu" data-mh-submenu="resources" hidden><?php foreach ($mh_resources as $item) : ?><a href="<?= esc_url($item['url']) ?>"<?= $item['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>><?= esc_html($item['label']) ?></a><?php endforeach; ?></div>
            </li>
            <li class="nav-item level-1-nav">
              <div class="container"><a href="<?= esc_url(mh_url('/about-us')) ?>" class="nav-link"> About us </a></div>
            </li>
            <li class="nav-item level-1-nav">
              <div class="container"><a href="<?= esc_url(mh_url('/contact-us')) ?>" class="nav-link"> Contact us </a></div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</section>
