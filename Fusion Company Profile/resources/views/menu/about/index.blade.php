@extends('layout.default')

@section('title','About')

@section('content')
    <br><br><br>
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{asset('assets/images/about/about.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
                    <br><br>
                    <h3>About Us</h3>
                    <p class="font-italic" style="text-align: justify">
                        Fusion Next Inc. focus on mobile application development and cloud platform. Our goal is to build a world class IoT platform to enable device’s connectivity,
                        to extend people's experience and make life more convenient. Currently we cooperate with global image IC vendors and provide wifi applications cloud service for
                        Automotive, Sports, Wearable, Drone device and VR360 cam.
                    </p>
                    <br><br>
                    <h3>Goal</h3>
                    <p class="font-italic" style="text-align: justify">
                        Our goal is build up a social activity & car application to provide whole new experience for the commute and outing.
                    </p>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{asset('assets/images/about/about.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-1 order-lg-2 content" data-aos="fade-left" data-aos-delay="100">
                    <br><br>
                    <h3>Vision</h3>
                    <p class="font-italic" style="text-align: justify">
                        Our vision is to build up a end to end location base software platform to enable the people & IOT can seamless colloabrate for various apllication and service.
                    </p>
                    <br><br>
                    <h3>Mission</h3>
                    <p class="font-italic" style="text-align: justify">
                        Our mission is to combine the diffterent technology and domain experience :
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> To build up a reference popular application</li>
                        <li><i class="ri-check-double-line"></i> To give services on our platform</li>
                        <li><i class="ri-check-double-line"></i> To encourage for various application development.</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
@endsection