@extends('layout.default')

@section('title','Work Experience')

@section('content')
<section id="feature" class="transparent-bg">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Work Experience</h2>
            <p class="lead">Before taking a master's degree, I had worked for one year first. <br>I am not only work as a permanent employee, but also work as a freelancer. <br>Here are the details of my work experience.</p>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-bullhorn"></i>
                        <h2>Private Teacher</h2>
                        <h3>Freelancer <br> 2013 - 2016</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-comments"></i>
                        <h2>Lecturer Assistant</h2>
                        <h3>University Of Surabaya <br> 2014 - 2016
                        </h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-briefcase"></i>
                        <h2>SAP Consultant</h2>
                        <h3>PT Eclectic Consulting <br> 2017 - 2018</h3>
                    </div>
                </div><!--/.col-md-4-->
            
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-desktop"></i>
                        <h2>Desktop Developer</h2>
                        <h3>Freelancer <br> 2017 - Now</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-html5"></i>
                        <h2>Website Developer</h2>
                        <h3>Freelancer <br> 2017 - Now</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-android"></i>
                        <h2>Android Developer</h2>
                        <h3>Freelancer <br> 2017 - Now</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-lightbulb-o"></i>
                        <h2>Researcher</h2>
                        <h3>Taiwan Tech <br> 2018 - Now</h3>
                    </div>
                </div><!--/.col-md-4--> 

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-cloud"></i>
                        <h2>Site Reliability Engineer</h2>
                        <h3>Data Force Pro <br> 2019 - Now</h3>
                    </div>
                </div><!--/.col-md-4-->                
            </div><!--/.services-->
        </div><!--/.row--> 

        <div class="get-started center wow fadeInDown">
            <h2>Hire Me</h2>
            <p class="lead">It is better to do business with someone because they are not only like you, but also trust you.</p>
            <div class="request">
                <h4><a href="">Daivalentineno Janitra Salim</a></h4>
            </div>
        </div><!--/.get-started-->

        <div class="clients-area center wow fadeInDown">
            <h2>What my client says</h2>
            <p class="lead">Here are some client responses regarding the results of my performance</p>
        </div>

        <div class="row">
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/client_says/phoenix.png')}}" class="img-circle" alt="">
                    <h3>The website design of my company profile created by Daiva is very good.It can help me to introduce my business.</h3>
                    <h4><span>- James Leicester /</span>  Owner of UD Phoenix Embroidery</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/client_says/mmck.png')}}" class="img-circle" alt="">
                    <h3>I made an E-Commerce website for my beauty products. Daiva has made it very interesting. Finally, the number of sales increased.</h3>
                    <h4><span>- Maria Mellysa /</span> Owner of MMCK Beauty</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/client_says/violatama.png')}}" class="img-circle" alt="">
                    <h3>Daiva made a forecasting software for our company. We were greatly helped because we were able to predict the number of shoes that will be sold in the following months.</h3>
                    <h4><span>- Rheza Vallian /</span> Software Engineer of PT Violatama Inti Sejati</h4>
                </div>
            </div>
        </div>

    </div><!--/.container-->
</section><!--/#feature-->
@endsection