<?php
/**
 * <app-healthcare> — converted from src/app/pages/healthcare/healthcare.component.html
 */
if (!defined('ABSPATH')) { exit; }

// Selected tab (?tab=N), as set by the original setTab() on load.
$currentTabIndex = mh_query_tab( count( $healthcareTabs ) );
?>
<div class="row no-gutters">
  <div class="col-12 py-0">
    <div><app-health-top-banner><?php mh_component('health-top-banner', ['pageData' => $healthcareData]); ?></app-health-top-banner><section class="page-block-section position-relative font-dark" style="background-color:#fff;  min-height:0 !important;" id="healthcare-capabilities-header">
        <div class="">
          <div class="row flex-grow-1 justify-content-center">
            <div class="position-relative sec-1">
              <div class="">
                <div class="row justify-content-between">
                  <div class="col col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 align-self-center editor-column">
                    <div class="editor-text align-items-center">
                      <h2 class="h1" style="text-align: center;"><span class="big"> Driving innovation across the care continuum with <span class="underline_cls1 highlight-pop" id="healthcare-tabs"> specialized technology and operational Expertise.</span></span></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><section class="dg-home-intro d-none d-sm-block" id="home-intro">
        <div class="healthcare-tab-wrapper">
          <h2 class="vg-section-title">OUR SOLUTIONS</h2>
          <div class="hc-grid">
            <?php foreach (mh_list($healthcareSectionCards) as $card) : ?>
              <div class="hc-card" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_healthcare_link') + ['tab' => $card['tabIndex'] ?? 0]])) ?>"><img class="hc-card__img" src="<?= mh_asset_url($card['imageUrl'] ?? null) ?>" alt="<?= mh_a($card['title'] ?? null) ?>"><div class="hc-card__overlay"></div><div class="hc-card__label"><div class="hc-card__text"><span class="hc-card__title"><?= mh_e($card['title'] ?? null) ?></span><p class="hc-card__desc"><?= mh_e($card['description'] ?? null) ?></p></div><button class="hc-card__btn" aria-label="View details" data-mh-action="openSidebar" data-mh-args="<?= esc_attr(wp_json_encode([mh_sidebar_payload($card, 'mh_healthcare_link') + ['tab' => $card['tabIndex'] ?? 0]])) ?>" data-mh-stop="1"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"></path></svg></button></div></div>
            <?php endforeach; ?>
          </div>
        </div>
      </section><section class="dg-home-intro d-block d-sm-none" id="home-intro">
        <div class="healthcare-tab-wrapper"><app-solution-grid><?php mh_component('solution-grid', ['options' => $healthcareTabs, 'gridMap' => $healthcareGridMap, 'activeTab' => $currentTabIndex, 'activeAccordionIndex' => $currentTabIndex]); ?></app-solution-grid></div>
      </section><aside class="hc-sidebar" role="dialog" aria-modal="true" data-mh-sidebar="hc"></aside><section class="page-block-section position-relative font-dark" style="background-color: #FFFFFF;  min-height:0 !important;" id="page-block-ec-panel">
        <div class="container flex-column">
          <div class="row flex-grow-1 justify-content-center">
            <div class="col-12 position-relative pb-0">
              <div class="row justify-content-center">
                <div class="col col-10 editor-col">
                  <div class="editor-text">
                    <h4 class="h1 txth4" style="text-align: center;"><span> We deliver healthcare solutions <span class="underline_cls1 highlight-pop"> across the ecosystem </span></span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><section class="page-block-section py-1" style="background-color: #FFFFFF;" id="page-block-ec-panel">
        <div class="container">
          <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
              <div class="image-wrapper position-relative"><img class="img-fluid rounded-4 shadow-sm" src="<?= mh_asset_url('images/hc_2.jpg') ?>" alt="Healthcare Solutions"><div class="accent-box d-none d-md-block"></div></div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="healthcare-features">
                <div class="feature-item d-flex mb-4">
                  <div class="feature-icon"><i class="fas fa-hand-holding-medical"></i></div>
                  <div class="feature-content"><strong class="htxt23">Health Plans &amp; Payers</strong><p>Commercial, Medicare, Medicaid, and Managed Care organizations.</p></div>
                </div>
                <div class="feature-item d-flex mb-4">
                  <div class="feature-icon"><i class="fas fa-hospital-user"></i></div>
                  <div class="feature-content"><strong class="htxt23">Providers &amp; Health Systems</strong><p>Hospitals, physician groups, specialty and ambulatory care.</p></div>
                </div>
                <div class="feature-item d-flex mb-4">
                  <div class="feature-icon"><i class="fas fa-laptop-medical"></i></div>
                  <div class="feature-content"><strong class="htxt23">TPAs &amp; Employer Health Platforms</strong><p>Claims administration, utilization management, and analytics.</p></div>
                </div>
                <div class="feature-item d-flex">
                  <div class="feature-icon"><i class="fas fa-microchip"></i></div>
                  <div class="feature-content"><strong class="htxt23">Digital Health &amp; Healthtech Companies</strong><p>Platform modernization, interoperability, and AI enablement.</p></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><section class="page-block-section position-relative overflow-hidden" style="background-color: #fdfdfd;" id="page-block-hi-banner">
        <div class="background-layer container-fluid d-none d-md-block">
          <div class="row h-100" style="background-color: #b2c7b3;">
            <div class="col-md-6 p-0 h-100" style="background: url('<?= esc_url( mh_asset( 'images/hc_3.jpg' ) ) ?>') center/cover no-repeat; min-height: 600px;">
              <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to right, transparent, #fdfdfd);"></div>
            </div>
          </div>
        </div>
        <div class="container position-relative" style="z-index: 2;">
          <div class="row align-items-center py-5">
            <div class="col-12 d-lg-none mb-4"><img class="img-fluid rounded-4 shadow" src="<?= mh_asset_url('images/hc_3.jpg') ?>" alt="Healthcare Expertise"></div>
            <div class="offset-md-7">
              <div class="why-choose-us-content mt-4">
                <div class="why-item d-flex mb-4">
                  <div class="why-check"><i class="fas fa-check-circle"></i></div>
                  <p><strong>Deep healthcare domain knowledge:</strong> Specialized understanding of payer/provider workflows.</p>
                </div>
                <div class="why-item d-flex mb-4">
                  <div class="why-check"><i class="fas fa-check-circle"></i></div>
                  <p><strong>Engineering excellence:</strong> Strong focus on complex system integration and interoperability.</p>
                </div>
                <div class="why-item d-flex mb-4">
                  <div class="why-check"><i class="fas fa-check-circle"></i></div>
                  <p><strong>AI-First delivery:</strong> Automation-driven models that reduce technical debt and manual errors.</p>
                </div>
                <div class="why-item d-flex mb-4">
                  <div class="why-check"><i class="fas fa-check-circle"></i></div>
                  <p><strong>Global scale, boutique agility:</strong> The rigor of an enterprise with the speed of a startup.</p>
                </div>
                <div class="why-item d-flex">
                  <div class="why-check"><i class="fas fa-check-circle"></i></div>
                  <p><strong>Flexible engagement:</strong> Tailored delivery models to fit your specific cloud or on-prem needs.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><section style="background-color: #ddd">
        <div class="container mt-5">
          <div class="row">
            <div class="col editor-col">
              <div class="editor-text htxte1"><span> Ready to modernize your healthcare operations? </span><p style="text-align: center;padding: 8px 0 0 0;"> Let's talk about how Mahathi Infotech can help. </p></div>
              <div class="text-center"><span data-href="<?= esc_url(mh_url('/contact-us')) ?>" class="bg-white inline-block border rounded-full cntctbtn hover:bg-violet hover:text-white">
                  <div class="flex items-center text-center text-black"><span class="order-1 text-black">Contact Us</span><svg class="ml-2" style="display: none;" width="15" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.51724 0.947642L14.5954 6.15598L9.51724 11.469" fill="currentColor"></path></svg></div>
                </span></div>
              <div class="pb-sm-4 spacer d-none d-md-block"></div>
            </div>
          </div>
        </div>
      </section></div>
  </div>
</div>
