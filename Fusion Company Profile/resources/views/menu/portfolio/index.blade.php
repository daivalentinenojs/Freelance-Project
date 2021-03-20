@extends('layout.default')

@section('title','Portfolio')

@section('content')
    <br><br><br>
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Portfolio</h2>
                <p>Check our Portfolio</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-android">Android</li>
                        <li data-filter=".filter-ios">IOS</li>
                        <li data-filter=".filter-website">Website</li>
                        <li data-filter=".filter-award">Award</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/drive_hd.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Drive HD by Cobra</h4>
                            <p>Note: This app works with the Cobra Road Scout only. For the CDR, DASH, or CCDC Series dash cameras, please download the Cobra iRadar App.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/drive_hd.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.DriveHD.cam&hl=en_US&gl=US')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/escort_m1.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Escort M1 Dash Cam</h4>
                            <p>The M1 Dash Cam app gives you full control of your Escort M1 Dash Camera directly from your smartphone. Start/stop videos, change settings, edit footage, and share your videos/photos with ease</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/escort_m1.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.fusionnextinc.ceder&hl=en_US&gl=US')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/kenwood.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Street Tracker Mobile</h4>
                            <p>The video recorded in 360 degree omnidirection can be viewed in various angles by selecting from 5 types of view modes such as "Panorama", "2-in-1", "4-in-1", or "Cutout". Compatible model:  DRV-CW560</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/kenwood.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.jvckenwood.android.stm')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/yupiteru.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>DRY Remote TypeC</h4>
                            <p>You can wirelessly control camera shooting, album management, and device settings from your smartphone.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/yupiteru.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=jp.co.yupiteru.dryremotetypec')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/gotrec.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Gotrec Pro</h4>
                            <p>Perfectly combined with Doweing Social map that provide Transportation, Travel, Outdoor Activity, Food and more super features.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/gotrec.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.doweing.gotrec&hl=en_NZ&gl=US')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/px_motor_group.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>PX Motor Group</h4>
                            <p>PX MotorGroup supports Chase high-end locomotive recorder GX2-PRO. Users can quickly connect to the locomotive recorder via Android Phone or Android Pad via WiFi.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/px_motor_group.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=tw.com.px.gx2&hl=en_NZ&gl=US')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/pentacon.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>PT Camera</h4>
                            <p>PTCamera is a Wi-Fi controler which can control Pentacon camera. Key Features : Remote control, 360 degree video recording, playback type, and more.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/pentacon.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.fusionnextinc.ptcamera&hl=en_NZ&gl=US')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-android">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/ot_cam_360.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>OT Cam 360</h4>
                            <p>OTCam360 is a Wi-Fi controller which can remotely control 360 panorama camera using OTUS solution.  Support VR (virtual reality) playback using finger gesture or mobile phone gyro sensor</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/ot_cam_360.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.fusionnextinc.otcam360&hl=en_NZ&gl=US')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-ios">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/ijoyer.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>IJOYER</h4>
                            <p>IJOYER 360Camera is an application to control the panoramic camera through the WiFi connection of iPhone or iPad. It can be freely controlled: real-time monitoring, online playback, etc.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/ijoyer.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://apps.apple.com/tw/app/ijoyer/id1255798527')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-2 portfolio-item filter-ios">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/hl_360_cam.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>HL Cam</h4>
                            <p>HL360Cam can operate your driving recorder via Wifi. Through a simple operation interface, you can freely: real-time streaming, online previewing files, setting the driving recorder.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/hl_360_cam.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://apps.apple.com/tw/app/hl360cam/id1184822580')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-2 portfolio-item filter-ios">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/ott.jpg')}}"  class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>OT Talk</h4>
                            <p>"YJT OTTalk" is a product aimed at remote speech transmission. "YJT OT Talk" uses WiFi to connect to the mobile phone dedicated APP to achieve the two-way intercom function.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/ott.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://apps.apple.com/tw/app/ottalk-%E4%BC%8A%E9%8D%B5%E9%80%9A%E5%B1%85%E5%AE%B6%E7%85%A7%E8%AD%B7%E9%88%B4/id1500249007')}}" target="_blank" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-award">
                    <div class="portfolio-wrap text-center">
                        <img src="{{asset('assets/images/portfolio/doweing.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Doweing</h4>
                            <p>Doweing (Do : activity ,We: group ,Ing: real-time ) would like to become your best partner for your outing.</p>
                            <div class="portfolio-links">
                                <a href="{{asset('assets/images/portfolio/doweing.png')}}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="{{url('https://play.google.com/store/apps/details?id=com.fusionnextinc.doweing&utm_source=downing.com&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1')}}" target="_blank"  title="More Details"><i class="bx bx-link"></i></a>
                                <a href="{{url('https://nb.aotter.net/post/5ede7e2899798c3f82421625')}}" target="_blank"  title="Award Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection