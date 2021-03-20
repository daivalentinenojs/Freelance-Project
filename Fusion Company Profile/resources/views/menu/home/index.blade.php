@extends('layout.default')

@section('title','Home')

@section('content')
    <section id="hero" class="d-flex align-items-center justify-content-center">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                <div class="col-xl-12 col-lg-8">
                    <h1>Mobile Application and Cloud Development <br> for Your Smart Devices</h1>
                    <h2>Easy to Develop, Easy to Connect, Easy to Manage</h2>
                </div>
            </div>

            <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="ri-brush-fill"></i>
                        <h3><a href="">UI / UX Design</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="ri-html5-fill"></i>
                        <h3><a href="">Website Development</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="ri-android-fill"></i><i class="ri-apple-fill"></i>
                        <h3><a href="">Mobile App Development</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="ri-building-4-fill"></i>
                        <h3><a href="">IOT End to End Application Development</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4">
                    <div class="icon-box">
                        <i class="ri-advertisement-fill"></i>
                        <h3><a href="">LBS Event Application Service - Doweing</a></h3>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <br><br>
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            <h1 class="text-center">Why You Should Choose Us</h1><br><br>
            <div class="row">
                <div class="image col-lg-6" style='background-image: url("/assets/images/feature/features.jpg");' data-aos="fade-right"></div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-receipt"></i>
                        <h4>Rich IC Experience</h4>
                        <p>{{date_format(now(), 'Y') - 2013}} years cooperation experience with image IC companies</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-cube-alt"></i>
                        <h4>Advanced App Functions</h4>
                        <p>Support multi-chip that helps to save time and cost providing better user experience</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-images"></i>
                        <h4>Great Tool And Reference Code</h4>
                        <p>Quick and easy verify API command, fulfill different customization requirements</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-shield"></i>
                        <h4>OTA Cloud Service</h4>
                        <p>Extend the application function and future application</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-shield"></i>
                        <h4>Quick Response Service</h4>
                        <p>To help customers time to market is our first priority</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-shield"></i>
                        <h4>Long-Rerm Roadmap</h4>
                        <p>Continuously development and cooperation</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
                        <i class="bx bx-shield"></i>
                        <h4>Rich Customer Experience</h4>
                        <p>Cooperated with world-wide over 20 ODM&Brand for app development  and over 2 million download</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <br><br>
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">
            <h1 class="text-center">Supported IC Vendors</h1><br>
            <div class="clients-slider swiper-container">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="{{asset('assets/images/vendor/vendor-1.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/vendor/vendor-2.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/vendor/vendor-3.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/vendor/vendor-4.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/vendor/vendor-5.png')}}" class="img-fluid" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <br><br>
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3>Call To Action</h3>
                <p>Hard Working, Willing to Share, Keep Creative, Insist to Dream, Advocate Integrity, Enjoy Life.</p>
                <span class="cta-btn">Bryan Kuo</span>
            </div>

        </div>
    </section>
    <br><br>
{{--    <section id="counts" class="counts">--}}
{{--        <div class="container" data-aos="fade-up">--}}

{{--            <div class="row no-gutters">--}}
{{--                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" data-aos-delay="100"></div>--}}
{{--                <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">--}}
{{--                    <div class="content d-flex flex-column justify-content-center">--}}
{{--                        <h3>Voluptatem dignissimos provident quasi</h3>--}}
{{--                        <p>--}}
{{--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit--}}
{{--                        </p>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6 d-md-flex align-items-md-stretch">--}}
{{--                                <div class="count-box">--}}
{{--                                    <i class="bi bi-emoji-smile"></i>--}}
{{--                                    <span data-purecounter-start="0" data-purecounter-end="65" data-purecounter-duration="2" class="purecounter"></span>--}}
{{--                                    <p><strong>Happy Clients</strong> consequuntur voluptas nostrum aliquid ipsam architecto ut.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 d-md-flex align-items-md-stretch">--}}
{{--                                <div class="count-box">--}}
{{--                                    <i class="bi bi-journal-richtext"></i>--}}
{{--                                    <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="2" class="purecounter"></span>--}}
{{--                                    <p><strong>Projects</strong> adipisci atque cum quia aspernatur totam laudantium et quia dere tan</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 d-md-flex align-items-md-stretch">--}}
{{--                                <div class="count-box">--}}
{{--                                    <i class="bi bi-clock"></i>--}}
{{--                                    <span data-purecounter-start="0" data-purecounter-end="4" data-purecounter-duration="4" class="purecounter"></span>--}}
{{--                                    <p><strong>Years of experience</strong> aut commodi quaerat modi aliquam nam ducimus aut voluptate non vel</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 d-md-flex align-items-md-stretch">--}}
{{--                                <div class="count-box">--}}
{{--                                    <i class="bi bi-award"></i>--}}
{{--                                    <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="4" class="purecounter"></span>--}}
{{--                                    <p><strong>Awards</strong> rerum asperiores dolor alias quo reprehenderit eum et nemo pad der</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- End .content-->--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </section>--}}
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">
            <h1 class="text-center">Our Customers</h1><br>
            <div class="clients-slider swiper-container">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><img src="{{asset('assets/images/client/customer-1.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/client/customer-2.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/client/customer-3.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/client/customer-4.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/client/customer-5.png')}}" class="img-fluid" alt=""></div>
                    <div class="swiper-slide"><img src="{{asset('assets/images/client/customer-6.png')}}" class="img-fluid" alt=""></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
{{--    <br><br>--}}
{{--    <section id="testimonials" class="testimonials">--}}
{{--        <div class="container" data-aos="zoom-in">--}}

{{--            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">--}}
{{--                <div class="swiper-wrapper">--}}

{{--                    <div class="swiper-slide">--}}
{{--                        <div class="testimonial-item">--}}
{{--                            <img src="{{asset('assets/images/testimonial/testimonials-1.jpg')}}" class="testimonial-img" alt="">--}}
{{--                            <h3>Saul Goodman</h3>--}}
{{--                            <h4>Ceo &amp; Founder</h4>--}}
{{--                            <p>--}}
{{--                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>--}}
{{--                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.--}}
{{--                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- End testimonial item -->--}}

{{--                    <div class="swiper-slide">--}}
{{--                        <div class="testimonial-item">--}}
{{--                            <img src="{{asset('assets/images/testimonial/testimonials-2.jpg')}}" class="testimonial-img" alt="">--}}
{{--                            <h3>Sara Wilsson</h3>--}}
{{--                            <h4>Designer</h4>--}}
{{--                            <p>--}}
{{--                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>--}}
{{--                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.--}}
{{--                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- End testimonial item -->--}}

{{--                    <div class="swiper-slide">--}}
{{--                        <div class="testimonial-item">--}}
{{--                            <img src="{{asset('assets/images/testimonial/testimonials-3.jpg')}}" class="testimonial-img" alt="">--}}
{{--                            <h3>Jena Karlis</h3>--}}
{{--                            <h4>Store Owner</h4>--}}
{{--                            <p>--}}
{{--                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>--}}
{{--                                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.--}}
{{--                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- End testimonial item -->--}}

{{--                    <div class="swiper-slide">--}}
{{--                        <div class="testimonial-item">--}}
{{--                            <img src="{{asset('assets/images/testimonial/testimonials-4.jpg')}}" class="testimonial-img" alt="">--}}
{{--                            <h3>Matt Brandon</h3>--}}
{{--                            <h4>Freelancer</h4>--}}
{{--                            <p>--}}
{{--                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>--}}
{{--                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.--}}
{{--                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- End testimonial item -->--}}

{{--                    <div class="swiper-slide">--}}
{{--                        <div class="testimonial-item">--}}
{{--                            <img src="{{asset('assets/images/testimonial/testimonials-5.jpg')}}" class="testimonial-img" alt="">--}}
{{--                            <h3>John Larson</h3>--}}
{{--                            <h4>Entrepreneur</h4>--}}
{{--                            <p>--}}
{{--                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>--}}
{{--                                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.--}}
{{--                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- End testimonial item -->--}}
{{--                </div>--}}
{{--                <div class="swiper-pagination"></div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </section>--}}
@endsection