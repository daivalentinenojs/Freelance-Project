@extends('layout.default')

@section('title','Home')

@section('content')
    <br><br><br>
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>Check our Services</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-1.png')}}" class="img-fluid" alt="">
                        <img src="{{asset('assets/images/service/service-2.png')}}" class="img-fluid" alt="">
                        <h4><a href="">Application Development</a></h4>
                        <p>Our released mobile applications are stable, have high quality and rich user experience. Many customers have been shipped them to markets.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-3.png')}}" class="img-fluid" alt="">
                        <h4><a href="">Customization Service</a></h4>
                        <p>We can help you to change application logo or splash screen in order to publish it to application's store quickly.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-4.png')}}" class="img-fluid" alt="">
                        <h4><a href="">SDK</a></h4>
                        <p>Our SDK includes rich API that can be used as the foundation to develop a great iOS, Android application with the secure control and ability to manage devices.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-5.png')}}" class="img-fluid" alt="">
                        <h4><a href="">UI Customization Kit</a></h4>
                        <p>Our customization kit helps developers to change company logo, splash screen, text strings or even customize UI without a big effort, which makes iOS and Android applications well recognizable and competitive.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-6.png')}}" class="img-fluid" alt="">
                        <h4><a href="">Customer Project Service</a></h4>
                        <p>We are ready to work in closer cooperation with you developing the new application that requires a lot of different specifications. We make sure the quality and stability, and provide maintain service.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-7.png')}}" class="img-fluid" alt="">
                        <h4><a href="">OTA Service</a></h4>
                        <p>Our cloud service is completely managed service that provides a full suite of operational, firmware and software OTA upgrade and analytic services to manage connected deployment throughout its lifecycle.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                        <img src="{{asset('assets/images/service/service-8.png')}}" class="img-fluid" alt="">
                        <h4><a href="">Device Management Service</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                </div>

            </div>

        </div>
    </section>
@endsection