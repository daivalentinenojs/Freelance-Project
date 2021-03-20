@extends('layout.default')

@section('title','Team')

@section('content')
    <br><br><br>
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Team</h2>
                <p>Check our Team</p>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{asset('assets/images/team/Bryan.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Bryan Kuo</h4>
                            <span>Chief Executive Officer</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="200">
                        <div class="member-img">
                            <img src="{{asset('assets/images/team/Kenny.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Kenny Cheng</h4>
                            <span>UI / UX Leader</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="{{asset('assets/images/team/Shawn.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Shawn Lin</h4>
                            <span>iOS Leader</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="400">
                        <div class="member-img">
                            <img src="{{asset('assets/images/team/Mark.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Mark Kao</h4>
                            <span>Android Leader</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="300">
                        <div class="member-img">
                            <img src="{{asset('assets/images/team/Daiva.jpg')}}" class="img-fluid" alt="">
                            <div class="social">
                                <a href="https://www.facebook.com/Daiva24/" target="_blank"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com/daivalentineno24/" target="_blank"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.linkedin.com/in/daivalentinenojs/" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Daivalentineno Janitra Salim</h4>
                            <span>Website Developer</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection