<?php
/**
 * <app-location> — converted from src/app/pages/location/location.component.html
 */
if (!defined('ABSPATH')) { exit; }
?>
<main>
  <section class="relative">
    <div class="absolute w-full h-full z-0"><video class="absolute max-w-[2200px] w-full max-h-full top-1/2 translate-y-[-50%] left-1/2 translate-x-[-50%] hidden lg:block object-cover" style="opacity: 1; max-height:80%" poster="<?= mh_asset_url('images/ind_bg.png') ?>" data-src="<?= mh_asset_url('images/ind_bg.png') ?>" muted playsinline preload="none" aria-label="Background Video" src="<?= mh_asset_url('images/ind_bg.png') ?>"></video><span class="absolute w-full h-full lazy-load-image-background opacity lazy-load-image-loaded" style="display:inline-block"><img class="lg:hidden w-full h-full object-contain" src="<?= mh_asset_url('images/ind_bg.png') ?>" alt="ind_bgimage"></span></div>
    <div class="flex flex-wrap items-center relative min-h-[90vh] md:min-h-[800px] md:max-h-[1200px]" style="min-height: 320px; margin-top:5%">
      <div class="container my-60px pt-40px md:my-0 md:pt-0 max-w-screen">
        <div class="grid grid-cols-6 md:grid-cols-12 sm:gap-5">
          <div class="col-span-6 top_15 relative md:col-span-9 md:col-start-2">
            <h1 class="w-full md:w-8/12 relative mb-40px   text-40 font-light text-violet antialiased md:w-full lg:text-80"><span class="mt-20px underline_cls1">Get in touch </span><span> to discuss your support needs or just to pick our brains</span></h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="py-85px pt-20px">
    <div class="container">
      <div class="mb-50px lg:mb-60px">
        <div class="mb-40px lg:mb-50px">
          <h2 class="inline-block rounded-5px py-5px px-[13px] font-semibold text-12-eyebrow lg:text-14-eyebrow tracking-widest uppercase antialiased bg-gold1 text-violet"> What will happen next?</h2>
        </div>
        <div class="text-25 lg:text-40   font-light tracking-tight antialiased text-violet lg:max-w-[1200px]">
          <p>We will respond to your request in real-time</p>
          <p>You are a step closer to building a great relationship</p>
        </div>
      </div>
      <div class="relative mb-0px lg:mb-0px lg:pb-30px">
        <div class="focus w-30px h-full absolute -left-10px lg:right-0 mx-auto">
          <div class="w-1px h-full border-l-[thin] lg:border-l-[1px] border-violet absolute left-1/2 lg:translate-x-[-50%]"></div>
          <div class="sticky top-1/2 bg-violet rounded-full mx-6px lg:mx-0 w-9px h-9px lg:w-30px lg:h-30px"></div>
        </div>
        <ol class="lg:counter-reset">
          <li class="mb-70px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:w-1 lg:pr-20px">
            <div class="mt-10px mx-20px lg:w-5/12 w-full md:w-1/3 lg:w-4\/5 xl:w-4\/5 lg:w-5/12 flex-shrink-0">
              <p class="mb-10px text-20 md:text-25 text-violet   font-light antialiased lg:text-40">Technical consultation</p>
              <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased">Detailed tech plan includes things like what tech stack to use, tech architecture, timeline, and budget for your project.</p>
            </div>
          </li>
          <li class="mb-70px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:w-1/2 lg:ml-auto lg:pl-20px">
            <div class="mt-10px mx-20px lg:w-4/5 w-full md:w-1/3 lg:w-4\/5 xl:w-4\/5 lg:w-4/5 flex-shrink-0">
              <p class="mb-10px text-20 md:text-25 text-violet   font-light antialiased lg:text-40">Connect with the tech team</p>
              <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased">Over a series of calls, our tech team discusses how different technologies and frameworks will bring your vision to life.</p>
            </div>
          </li>
          <li class="mb-20px flex md:items-center lg:items-start lg:counter-increment lg:before:counter-result lg:w-1 lg:pr-20px">
            <div class="mt-10px mx-20px lg:w-5/12 w-full  md:w-1/3 lg:w-4\/5 xl:w-4\/5 lg:w-5/12 flex-shrink-0">
              <p class="mb-10px text-20 md:text-25 text-violet   font-light antialiased lg:text-40">Onboarding the team</p>
              <p class="xl:w-4/5 text-12 md:text-18-body tracking-wide antialiased">Once you sign-off on the team, our team will seamlessly integrate with your team.</p>
            </div>
          </li>
        </ol>
      </div>
    </div>
  </section>
  <section class="py-85px" style="position: relative">
    <div class="container1">
      <div class="text-25 lg:text-40 font-light tracking-tight antialiased text-violet lg:max-w-full">
        <div class="container">
          <div class="tab"><button class="tablinks active" onclick="openCity(event, 'London')" id="defaultOpen">USA</button><button class="tablinks" onclick="openCity(event, 'Paris')">India</button><button class="tablinks" onclick="openCity(event, 'Tokyo')">Philippines</button></div>
        </div>
        <div class="tabcontent" style="display: block" id="London"><iframe style="border:0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3052.23534486916!2d-75.41399048461388!3d40.09246547940414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c694155ac00001%3A0x5ab9102179bb403b!2s630%20Freedom%20Business%20Center%20Dr%20%233rd%2C%20King%20of%20Prussia%2C%20PA%2019406%2C%20USA!5e0!3m2!1sen!2sin!4v1647952415381!5m2!1sen!2sin" width="100%" height="450" allowfullscreen loading="lazy"></iframe><div class="stm_gmap_wrapper style_2 carousel-enable" style="display: block;position: absolute;top: 25px;right: 10px;">
            <div class="gmap_addresses">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="addresses_wr">
                      <div class="addresses owl-carousel stm_owl-theme owl-loaded" id="owl_623bf8b97719a">
                        <div class="owl-stage-outer">
                          <div class="owl-stage">
                            <div class="owl-item active" style="width: 280px; margin-right: 50px;">
                              <div class="item" data-lat="40.092429" data-lng="-75.411756" data-title="MAHATHI INFOTECH, USA (1/3)">
                                <div class="title h6 no_line">MAHATHI INFOTECH, USA (1/3)</div>
                                <ul>
                                  <li>
                                    <div class="icon"><i class="fa fa-map-marker stmicon-location-2" style="font-size: 28px" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Office">
                                      <p>630 Freedom Business Center Drive, 3rd Floor, King of Prussia, PA 19406.</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-mobile stmicon-iphone" style="font-size: 30px" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Phone">
                                      <p>USA (610) 768-7762, <br> India +91 4422 4351454</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-envelope stmicon-email" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Email">
                                      <p><a href="mailto:info@mahathiinfotech.com">info@mahathiinfotech.com</a></p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-clock-o stmicon-med_time" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Open Hours">
                                      <p>Mon — Fri: 8:00am ET - 8:00pm ET<br></p>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
        <div class="tabcontent" id="Paris"><iframe style="border:0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.662320972854!2d76.99736851411807!3d10.988840658243435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba8594626c93e57%3A0x6a4930cb0a8d5e3f!2sMahathi%20Infotech!5e0!3m2!1sen!2sin!4v1647952340910!5m2!1sen!2sin" width="100%" height="450" allowfullscreen loading="lazy"></iframe><div class="stm_gmap_wrapper style_2 carousel-enable" style="display: block;position: absolute;top: 25px;right: 10px;">
            <div class="gmap_addresses">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="addresses_wr">
                      <div class="addresses owl-carousel stm_owl-theme owl-loaded" id="owl_623bf8b97719a">
                        <div class="owl-stage-outer">
                          <div class="owl-stage">
                            <div class="owl-item" style="width: 280px; margin-right: 50px;">
                              <div class="item" data-lat="11.003110" data-lng="76.951202" data-title="MAHATHI INFOTECH, INDIA (2/3)">
                                <div class="title h6 no_line">MAHATHI INFOTECH, INDIA (2/3)</div>
                                <ul>
                                  <li>
                                    <div class="icon"><i class="fa fa-map-marker stmicon-location-2" style="font-size: 28px" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Office">
                                      <p>21D, 3rd Floor, Raagavis Center, Nanjunda Puram Rd, Ramanathapuram, Coimbatore, Tamil Nadu 641045</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-mobile stmicon-iphone" style="font-size: 30px" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Phone">
                                      <p>USA (610) 768-7762, <br> India +91 4422 4351454</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-envelope stmicon-email" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Email">
                                      <p><a href="mailto:info@mahathiinfotech.com">info@mahathiinfotech.com</a></p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-clock-o stmicon-med_time" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Open Hours">
                                      <p>Mon — Fri: 10:00pm ET - 12:00pm ET<br></p>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
        <div class="tabcontent" id="Tokyo"><iframe style="border:0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.4175692912077!2d121.08932821415203!3d14.57526618160622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c7e86d9714eb%3A0x24e3288cd680217!2s25%20Francisco%20Legaspi%2C%20Pasig%2C%20Metro%20Manila%2C%20Philippines!5e0!3m2!1sen!2sin!4v1647952482065!5m2!1sen!2sin" width="100%" height="450" allowfullscreen loading="lazy"></iframe><div class="stm_gmap_wrapper style_2 carousel-enable" style="display: block;position: absolute;top: 25px;right: 10px;">
            <div class="gmap_addresses">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="addresses_wr">
                      <div class="addresses owl-carousel stm_owl-theme owl-loaded" id="owl_623bf8b97719a">
                        <div class="owl-stage-outer">
                          <div class="owl-stage">
                            <div class="owl-item" style="width: 280px; margin-right: 50px;">
                              <div class="item" data-lat="14.575379" data-lng="121.090256" data-title="MAHATHI INFOTECH, PHILIPINNES (3/3)">
                                <div class="title h6 no_line">MAHATHI INFOTECH, PHILIPINNES (3/3)</div>
                                <ul>
                                  <li>
                                    <div class="icon"><i class="fa fa-map-marker stmicon-location-2" style="font-size: 28px" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Office">
                                      <p>25 F, Legaspi Street, Brgy. <br>Maybunga, Pasig City, Philippines<br></p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-mobile stmicon-iphone" style="font-size: 30px" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Phone">
                                      <p>USA (610) 768-7762,<br> India +91 4422 4351454</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-envelope stmicon-email" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Email">
                                      <p><a href="mailto:info@mahathiinfotech.com">info@mahathiinfotech.com</a></p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="icon"><i class="fa fa-clock-o stmicon-med_time" aria-hidden="true"></i></div>
                                    <div class="text" data-title="Open Hours">
                                      <p>Mon — Fri: 8:00pm ET - 9:00am ET<br></p>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
      </div>
    </div>
  </section>
</main>
