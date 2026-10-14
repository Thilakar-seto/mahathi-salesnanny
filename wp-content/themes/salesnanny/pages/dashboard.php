<?php
/**
 * <app-dashboard> — converted from src/app/dashboard/dashboard.component.html
 */
if (!defined('ABSPATH')) { exit; }

// Selected tab (?tab=N), as set by the original setTab() on load.
$currentTabIndex = mh_query_tab( count( $dashboardTabs ) );
?>
<div class="row no-gutters">
  <div class="col-12 py-0">
    <div><section class="page-block-section banner-carousel position-relative tall-banner" id="page-block-banner-carousel">
        <div class="banner-carousel-container w-100">
          <div class="banner-carousel-item position-relative"><video class="bg-video banner-video" muted loop playsinline poster="<?= mh_asset_url('images/video_thumnail.jpg') ?>"><source src="<?= mh_asset_url('videos/bg_video.mp4') ?>" type="video/mp4"></video><div class="container-fluid h-100">
              <div class="row h-100">
                <div class="col-12   py-0 h-100">
                  <div class="banner-carousel-item-inner d-flex align-items-center h-100 text-slider px-2">
                    <div class="slide active">
                      <div class="banner-carousel-item-inner-title text-white">
                        <h4><strong><span class="font-weight-light banner_h4"> BUILT FOR WORKERS' COMP </span></strong></h4>
                      </div>
                      <div class="banner-carousel-item-inner-content text-white mt-3">
                        <h1 class="banner_h1"> Forging the Future With Deep Business and Technology Expertise.</h1>
                      </div>
                    </div>
                    <div class="slide">
                      <div class="banner-carousel-item-inner-title text-white">
                        <h4><strong><span class="font-weight-light banner_h4"> REINVENTING P&amp;C SOLUTIONS </span></strong></h4>
                      </div>
                      <div class="banner-carousel-item-inner-content text-white mt-3">
                        <h1 class="banner_h1"> DESIGNING FOR IMPACT. ENGINEERING FOR SCALE.</h1>
                      </div>
                    </div>
                    <div class="slide">
                      <div class="banner-carousel-item-inner-title text-white">
                        <h4><strong><span class="font-weight-light banner_h4"> INSURANCE​ EXPERTISE WITH A PURPOSE </span></strong></h4>
                      </div>
                      <div class="banner-carousel-item-inner-content text-white mt-3">
                        <h1 class="banner_h1"> Delivering Meaningful, Measurable Outcomes.</h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="slick-slider__category-menu-container">
                <ul class="slick-slider__category-menu-container__list px-5">
                  <li class="slick-slider__category-menu-container__category-menu-item__video-item mt-1 menu-item-hover" data-related-slide-index="0"><svg width="38" height="38" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 40C31.9411 40 40 31.9411 40 22C40 12.0589 31.9411 4 22 4C12.0589 4 4 12.0589 4 22C4 31.9411 12.0589 40 22 40ZM22 44C34.1503 44 44 34.1503 44 22C44 9.84974 34.1503 0 22 0C9.84974 0 0 9.84974 0 22C0 34.1503 9.84974 44 22 44Z" fill=" #B55A6B"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M14 19C12.9 19 12 19.9 12 21C12 22.1 12.9 23 14 23H25.17L20.58 27.59C19.8 28.37 19.8 29.63 20.58 30.41C21.37 31.2 22.63 31.2 23.41 30.41L31.41 22.41C32.2 21.63 32.2 20.37 31.41 19.59L23.41 11.59C22.63 10.8 21.37 10.8 20.58 11.59C19.8 12.37 19.8 13.63 20.58 14.41L25.17 19H14Z" fill=" #B55A6B"></path></svg></li>
                  <li data-href="<?= esc_url(mh_url('/integrated-mailroom')) ?>" class="slick-slider__category-menu-container__category-menu-item__text-item menu-item-hover" data-related-slide-index="4">INTEGRATED <br> MAILROOM ​ </li>
                  <li class="slick-slider__category-menu-container__category-menu-item__menu_seperator menu-separator"> ∣</li>
                  <li data-href="<?= esc_url(mh_url('/workbench-solution')) ?>" class="slick-slider__category-menu-container__category-menu-item__text-item menu-item-hover" data-related-slide-index="5">WORKBENCH <br> SOLUTIONS </li>
                  <li class="slick-slider__category-menu-container__category-menu-item__menu_seperator menu-separator"> ∣</li>
                  <li data-href="<?= esc_url(mh_url('/compliance')) ?>" class="slick-slider__category-menu-container__category-menu-item__text-item menu-item-hover" data-related-slide-index="5">COMPLIANCE​ <br> AS A SERVICE ​</li>
                  <li class="slick-slider__category-menu-container__category-menu-item__menu_seperator menu-separator"> ∣</li>
                  <li data-href="<?= esc_url(mh_url('/siu-investigative')) ?>" class="slick-slider__category-menu-container__category-menu-item__text-item menu-item-hover" data-related-slide-index="5">SIU &amp; INVESTIGATIVE<br>SERVICES​</li>
                  <li class="slick-slider__category-menu-container__category-menu-item__menu_seperator menu-separator"> ∣</li>
                  <li data-href="<?= esc_url(mh_url('/litigation')) ?>" class="slick-slider__category-menu-container__category-menu-item__text-item menu-item-hover" data-related-slide-index="1">LITIGATION SUPPORT <br> SERVICES </li>
                </ul>
              </div>
            </div></div>
        </div>
      </section><section class="page-block-section position-relative font-dark dashboard-white-section" id="page-block-ec-panel">
        <div class="container flex-column">
          <div class="row flex-grow-1 justify-content-center">
            <div class="col-12 position-relative sec-1">
              <div class="container">
                <div class="row justify-content-between">
                  <div class="col-12 editor-col">
                    <div class="editor-text align-items-center">
                      <h2 class="h1 margins_mahathi dashboard-heading"><span class="big"> Mahathi helps <span class="underline_cls1 highlight-pop"> Fortune 500 insurance &amp; healthcare clients </span><span id="dashboard-tabs"> solve their toughest business challenges </span></span></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><app-dashboard-our-solutions class="d-none d-sm-block"><?php mh_component('dashboard-our-solutions', []); ?></app-dashboard-our-solutions><section class="dg-home-intro dashboard-grid-layout d-block d-sm-none" id="home-intro">
        <div class="dashboard-tab-wrapper"><button class="arrow-button" data-mh-tab-step="-1">
            <div class="arrow-icon-wrapper"><svg width="38" height="38" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 40C31.9411 40 40 31.9411 40 22C40 12.0589 31.9411 4 22 4C12.0589 4 4 12.0589 4 22C4 31.9411 12.0589 40 22 40ZM22 44C34.1503 44 44 34.1503 44 22C44 9.84974 34.1503 0 22 0C9.84974 0 0 9.84974 0 22C0 34.1503 9.84974 44 22 44Z" fill="#76A379"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M30 19C31.1 19 32 19.9 32 21C32 22.1 31.1 23 30 23H18.83L23.42 27.59C24.2 28.37 24.2 29.63 23.42 30.41C22.63 31.2 21.37 31.2 20.59 30.41L12.59 22.41C11.8 21.63 11.8 20.37 12.59 19.59L20.59 11.59C21.37 10.8 22.63 10.8 23.42 11.59C24.2 12.37 24.2 13.63 23.42 14.41L18.83 19H30Z" fill="#76A379"></path></svg></div>
          </button><app-solution-grid><?php mh_component('solution-grid', ['options' => $dashboardTabs, 'gridMap' => $dashboardGridMap, 'activeTab' => $currentTabIndex, 'activeAccordionIndex' => 0]); ?></app-solution-grid><button class="arrow-button" data-mh-tab-step="1">
            <div class="arrow-icon-wrapper"><svg width="38" height="38" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 40C31.9411 40 40 31.9411 40 22C40 12.0589 31.9411 4 22 4C12.0589 4 4 12.0589 4 22C4 31.9411 12.0589 40 22 40ZM22 44C34.1503 44 44 34.1503 44 22C44 9.84974 34.1503 0 22 0C9.84974 0 0 9.84974 0 22C0 34.1503 9.84974 44 22 44Z" fill="#76A379"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M14 19C12.9 19 12 19.9 12 21C12 22.1 12.9 23 14 23H25.17L20.58 27.59C19.8 28.37 19.8 29.63 20.58 30.41C21.37 31.2 22.63 31.2 23.41 30.41L31.41 22.41C32.2 21.63 32.2 20.37 31.41 19.59L23.41 11.59C22.63 10.8 21.37 10.8 20.58 11.59C19.8 12.37 19.8 13.63 20.58 14.41L25.17 19H14Z" fill="#76A379"></path></svg></div>
          </button></div>
      </section><section class="page-block-section position-relative font-dark impact-outer" style="background-color:#F4F4F2; min-height:0;" id="page-block-ec-panel">
        <div class="container flex-column">
          <div class="row flex-grow-1 justify-content-center">
            <div class="col-12 position-relative py-0">
              <div class="container">
                <div class="row">
                  <div class="col-12 wedeliver">
                    <div class="editor-text">
                      <h2 style="text-align: center;"><span class="big"><span class="underline_cls1"> We deliver change where it's most impactful,</span><span> when it's most needed. We're known for:</span></span></h2>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center impact-cards-row impact-mobile-carousel">
                  <div class="col-12 col-sm-10 col-md-6 col-lg-4 impact-card-col">
                    <section class="page-block-section position-relative font-dark impact-card-wrapper mt-4">
                      <div class="impact-card-container">
                        <div class="impact-card-row">
                          <div class="col-12 position-relative">
                            <div class="container">
                              <div class="container-fluid text-center Guidewire"><div class="editor-text text-center mb-3">
                                  <h1 class="h2 py-3"><span class="big impact-title"> Guidewire <br> Implementations </span></h1>
                                </div><img src="<?= mh_asset_url('images/GW_img.png') ?>" alt="Guidewire implementation partnership logo"><div class="editor-text text-center">
                                  <h1 class="h2 text-green1 my-3"><span class="big impact-subtitle"> Enterprise &amp; Cloud </span></h1>
                                </div></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                  <div class="col-12 col-sm-10 col-md-6 col-lg-4 mt-4 impact-card-col">
                    <section class="page-block-section position-relative font-dark impact-card-wrapper mb-5">
                      <div class="impact-card-container">
                        <div class="impact-card-row">
                          <div class="col-12 position-relative">
                            <div class="container">
                              <div class="container-fluid text-center mt-5"><div class="editor-text text-center mb-3">
                                  <h1 class="h2 py-3"><span class="big impact-title"> CCM Implementations <br> &amp; Integrations </span></h1>
                                </div><img src="<?= mh_asset_url('images/Quadient_img.png') ?>" alt="Quadient CCM implementation partnership logo"><div class="editor-text text-center">
                                  <h1 class="h2 text-green1 my-3"><span class="big impact-subtitle"> Inspire &amp; Impress </span></h1>
                                </div></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                  <div class="col-12 col-sm-10 col-md-6 col-lg-4 mt-4 impact-card-col">
                    <section class="page-block-section position-relative font-dark impact-card-wrapper">
                      <div class="impact-card-container">
                        <div class="impact-card-row">
                          <div class="col-12 position-relative">
                            <div class="container">
                              <div class="container-fluid text-center mt-5"><div class="editor-text text-center mb-3">
                                  <h1 class="h2 py-3"><span class="big impact-title"> 5 Star <br> Client Rating </span></h1>
                                </div><img src="<?= mh_asset_url('images/5star.png') ?>" alt="5-star client rating — 96% CSAT"><div class="editor-text text-center">
                                  <h1 class="h2 text-green1 my-3"><span class="big impact-subtitle"> 96% CSAT </span></h1>
                                </div></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><section class="page-block-section position-relative" style="background-color:#76A379;" id="page-block-fs-panel">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 pt-0 pb-4">
              <div class="editor-text my-4 drive text-white">
                <h2 style="text-align: center;"><span class="big"> Helping our clients stay ahead and drive value</span></h2>
              </div>
            </div>
          </div>
          <section class="py-65px mb-3">
            <div class="container">
              <div class="relative lg:mb-80px lg:pb-30px">
                <div class="focus w-20px h-full absolute -left-10px lg:right-0 mx-auto">
                  <div class="w-1px h-full border-l-[thin] lg:border-l-[1px] border-violet absolute left-1/2 lg:translate-x-[-50%]"></div>
                  <div class="sticky top-1/2 bg-violet rounded-full mx-6px lg:mx-0 w-9px h-9px lg:w-20px lg:h-20px"></div>
                </div>
                <ol class="lg:counter-reset">
                  <li class="mb-40px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:mb-0 lg:w-1/2 lg:pr-20px">
                    <div class="mx-20px min-w-[105px] w-1/4 md:w-1/3 lg:w-150px xl:w-200px flex-shrink-0"><svg width="100%" viewBox="0 0 200 227" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Mahathi How We Work</title><path d="M117.713 225.665C59.8337 232.065 2.71587 210.326 0.975139 143.234C-2.61513 77.5758 -0.439211 4.30363 82.3545 0C146.87 0 199.092 52.9678 199.092 118.405C205.729 172.697 175.701 225.334 117.713 225.665Z" fill="url(#0988083927)"></path><defs><pattern id="0988083927" patternContentUnits="userSpaceOnUse" width="1" height="1"><image id="6714001568" height="100%" href="<?= mh_asset_url('images/01.jpg') ?>"></image></pattern></defs></svg></div>
                    <div class="custom-caption">
                      <p class="mb-10px text-20 md:text-25 text-violet   font-bold antialiased lg:text-40 text-white" style="color: #302d42;">Deep Insurance Expertise</p>
                      <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased text-white"> Leading industry advisors and experts from P&amp;C, L&amp;A and Healthcare enabling profound impact to </p>
                    </div>
                  </li>
                  <li class="mb-40px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:mb-0 lg:w-1/2 lg:ml-auto lg:pl-20px">
                    <div class="mx-20px min-w-[105px] w-1/4 md:w-1/3 lg:w-150px xl:w-200px flex-shrink-0"><svg width="100%" viewBox="0 0 200 227" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Mahathi How We Work </title><path d="M117.713 225.665C59.8337 232.065 2.71587 210.326 0.975139 143.234C-2.61513 77.5758 -0.439211 4.30363 82.3545 0C146.87 0 199.092 52.9678 199.092 118.405C205.729 172.697 175.701 225.334 117.713 225.665Z" fill="url(#3360491863)"></path><defs><pattern id="3360491863" patternContentUnits="userSpaceOnUse" width="1" height="1"><image id="0100576875" height="100%" href="<?= mh_asset_url('images/02.jpg') ?>"></image></pattern></defs></svg></div>
                    <div>
                      <p class="mb-10px text-20 md:text-25 text-violet   font-bold antialiased lg:text-40 text-white"> Differentiated Engagement Models</p>
                      <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased text-white"> Client centric engagement models placing your interests in front of all our actions </p>
                    </div>
                  </li>
                  <li class="mb-40px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:mb-0 lg:w-1/2 lg:pr-20px">
                    <div class="mx-20px min-w-[105px] w-1/4 md:w-1/3 lg:w-150px xl:w-200px flex-shrink-0"><svg width="100%" viewBox="0 0 200 227" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Mahahti How We Work</title><path d="M117.713 225.665C59.8337 232.065 2.71587 210.326 0.975139 143.234C-2.61513 77.5758 -0.439211 4.30363 82.3545 0C146.87 0 199.092 52.9678 199.092 118.405C205.729 172.697 175.701 225.334 117.713 225.665Z" fill="url(#1207145799)"></path><defs><pattern id="1207145799" width="1" height="1"><image id="5567842214" height="100%" href="<?= mh_asset_url('images/03.jpg') ?>"></image></pattern></defs></svg></div>
                    <div>
                      <p class="mb-10px text-20 md:text-25 text-violet   font-bold antialiased lg:text-40 text-white"> Transparent Costing and Execution</p>
                      <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased text-white"> Costing models made fully available to you bring full transparency and strong governance for all </p>
                    </div>
                  </li>
                  <li class="mb-40px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:mb-0 lg:w-1/2 lg:ml-auto lg:pl-20px">
                    <div class="mx-20px min-w-[105px] w-1/4 md:w-1/3 lg:w-150px xl:w-200px flex-shrink-0"><svg width="100%" viewBox="0 0 200 227" fill="none" xmlns="http://www.w3.org/2000/svg"><title>Mahathi How We Work </title><path d="M117.713 225.665C59.8337 232.065 2.71587 210.326 0.975139 143.234C-2.61513 77.5758 -0.439211 4.30363 82.3545 0C146.87 0 199.092 52.9678 199.092 118.405C205.729 172.697 175.701 225.334 117.713 225.665Z" fill="url(#3360491866)"></path><defs><pattern id="3360491866" width="1" height="1"><image id="0100576876" height="100%" href="<?= mh_asset_url('images/04.jpg') ?>"></image></pattern></defs></svg></div>
                    <div>
                      <p class="mb-10px text-20 md:text-25 text-violet   font-bold antialiased lg:text-40 text-white"> Process &amp; Automation over Headcount</p>
                      <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased text-white"> Ensuring Automation and AI tools take precedence to resolve every business problem instead of adding headcount </p>
                    </div>
                  </li>
                </ol>
              </div>
              <div class="lg:text-center pb-5">
                <div class="md:flex lg:justify-center">
                  <div class="mb-20px first:ml-0 last:mr-0 md:mx-10px md:mb-0"><span data-href="<?= esc_url(mh_url('/about-us')) ?>" class="bg-white px-5 py-4 inline-block border rounded-full duration-300 ease py-15px lg:py-20px px-25px lg:px-50px text-violet border-violet hover:bg-violet hover:text-white group">
                      <div class="flex items-center lg:text-20"><span class="order-1" style="font-size: 12px !important;">learn more about us</span><svg class="w-15px order-2 ml-5px ml-3" width="100%" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51724 0.947642L9.46354 0.892566L9.40984 0.947643L8.85971 1.51188L8.80892 1.56397L8.85944 1.61632L12.8416 5.74271H1H0.925V5.81771V6.59896V6.67396H1H12.8416L8.85944 10.8004L8.80892 10.8527L8.85971 10.9048L9.40984 11.469L9.46354 11.5241L9.51724 11.469L14.5954 6.26069L14.6464 6.20833L14.5954 6.15598L9.51724 0.947642Z" fill="currentColor" stroke="currentColor" stroke-width="0.15"></path></svg></div>
                    </span></div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </section><section class="page-block-section position-relative font-dark dashboard-white-section" id="page-block-ec-panel">
        <div class="container flex-column sec-1">
          <div class="row flex-grow-1 justify-content-center">
            <div class="dashboard-bottom-spacing">
              <div class="container">
                <div class="row justify-content-between mt-5">
                  <div class="editor-text align-items-center">
                    <h2 class="h1 weare dashboard-heading"><span class="big"> We are a <span class="underline_cls1 highlight-pop"> people first </span> organization that strongly believes in a Client Centric approach &amp; creating measurable value. </span></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section></div>
  </div>
</div>
