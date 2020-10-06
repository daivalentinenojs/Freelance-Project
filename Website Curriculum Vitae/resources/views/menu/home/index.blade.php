@extends('layout.default')

@section('title','Home')

@section('content')
<section id="main-slider" class="no-margin">
    <div class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
            <li data-target="#main-slider" data-slide-to="2"></li>
            <li data-target="#main-slider" data-slide-to="3"></li>
            <li data-target="#main-slider" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">

            <div class="item active" style="background-image: url({{asset('assets/images/slider/slider_1.png)')}}">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-7">
                            <div class="carousel-content" style="background:black; padding:5px; opacity: 0.8;">
                                <h1 class="animation animated-item-1">Daivalentineno Janitra Salim</h1>
                                <h1 class="animation animated-item-1">林 嘉 清</h1>
                                <h2 class="animation animated-item-2">Computer Science - Univeristy of Surabaya GPA 4.00 / 4.00</h2>
                                <h2 class="animation animated-item-3">Information Management - Taiwan Tech GPA 4.20 / 4.30</h2>
                                <h2 class="animation animated-item-4">Polar Researcher - Harbin Institute and Technology</h2>
                                <!-- <a class="btn-slide animation animated-item-3" href="">Read More</a> -->
                            </div>
                        </div>

                        <div class="col-sm-5 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="{{asset('assets/images/slider/img1.png')}}" class="img-responsive">
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

            <div class="item" style="background-image: url({{asset('assets/images/slider/slider_2.png)')}}">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-7">
                            <div class="carousel-content" style="background:black; padding:5px; opacity: 0.8;">
                                <h1 class="animation animated-item-1">Site Reliability Engineer</h1>
                                <h1 class="animation animated-item-1">Data Force Pro</h1>
                                <h2 class="animation animated-item-2">Tivoli, Mattermost, Jira, Rev IP Checker, IP Look Up, Sumo Logic,</h2>
                                <h2 class="animation animated-item-3">IP Subnetting, Linux, ADP, Confluence, SQL Alter Table Statement,</h2>
                                <h2 class="animation animated-item-4">Grafana, DB Cluster Look Up, DNS Checker</h2>
                                <!-- <a class="btn-slide animation animated-item-3" href="">Read More</a> -->
                            </div>
                        </div>

                        <div class="col-sm-5 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="{{asset('assets/images/slider/img2.png')}}" class="img-responsive">
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

            <div class="item" style="background-image: url({{asset('assets/images/slider/slider_3.png)')}}">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-7">
                            <div class="carousel-content" style="background:black; padding:5px; opacity: 0.8;">
                                <h1 class="animation animated-item-1">SAP Consultant</h1>
                                <h1 class="animation animated-item-1">PT Eclectic Consulting</h1>
                                <h2 class="animation animated-item-2">SAP S/4 HANA (ABAPer and Finance Consultant),</h2>
                                <h2 class="animation animated-item-3">SAP C4C</h2>
                                <!-- <a class="btn-slide animation animated-item-3" href="">Read More</a> -->
                            </div>
                        </div>
                        <div class="col-sm-5 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="{{asset('assets/images/slider/img3.png')}}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->

            <div class="item" style="background-image: url({{asset('assets/images/slider/slider_4.png)')}}">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-7">
                            <div class="carousel-content" style="background:black; padding:5px; opacity: 0.8;">
                                <h1 class="animation animated-item-1">Desktop, Website, Mobile, and Game Developer</h1>
                                <h1 class="animation animated-item-1">Freelance</h1>
                                <h2 class="animation animated-item-2">C++, C#, Java, HTML, CSS, PHP, Javascript, Ajax, Laravel, JSon,</h2>
                                <h2 class="animation animated-item-3">Android Studio, Unity, Flash, Python, Linux</h2>
                                <h2 class="animation animated-item-4">ERD, Mapping, Normalization, MySQL</h2>
                                <!-- <a class="btn-slide animation animated-item-3" href="">Read More</a> -->
                            </div>
                        </div>
                        <div class="col-sm-5 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="{{asset('assets/images/slider/img4.png')}}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->            

            <div class="item" style="background-image: url({{asset('assets/images/slider/slider_5.png)')}}">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-7">
                            <div class="carousel-content" style="background:black; padding:5px; opacity: 0.8;">
                                <h1 class="animation animated-item-1">Designer</h1>
                                <h1 class="animation animated-item-1">Freelance</h1>
                                <h2 class="animation animated-item-2">Photoshop, Pro Show Producer</h2>
                                <!-- <a class="btn-slide animation animated-item-3" href="">Read More</a> -->
                            </div>
                        </div>
                        <div class="col-sm-5 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="{{asset('assets/images/slider/img5.png')}}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section><!--/#main-slider-->

<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>About Me</h2>
            <p class="lead">Are you interested to know me? Kindly check this short introduction video.</p>
        </div>

        <div class="row">  
            <div class="col-xs-12 col-sm-8 col-md-12" style="text-align:center">
                <div class="recent-work-wrap">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/YA8iEU8FDlA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>   
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#recent-works-->

<section id="feature" >
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>My Soft Skills</h2>
            <p class="lead">Study and work have developed my soft skills. Some soft skills that I have are</p>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-bullhorn"></i>
                        <h2>Leadership</h2>
                        <h3>Take the action to build the best group of people</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-briefcase"></i>
                        <h2>Dicipline</h2>
                        <h3>Obey the rules or behaviour, able to control myself</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-comments"></i>
                        <h2>Discussion</h2>
                        <h3>Dare to give my ideas and accept suggestions </h3>
                    </div>
                </div><!--/.col-md-4-->
            
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-group"></i>
                        <h2>Teamwork</h2>
                        <h3>Work in a team and accept team's opinion</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-clock-o"></i>
                        <h2>Time Management</h2>
                        <h3>Complete the project on time and give satisfying results</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-bar-chart-o"></i>
                        <h2>Analytical Thinking</h2>
                        <h3>Develop core analytical capabilities using advanced statistical techniques</h3>
                    </div>
                </div><!--/.col-md-4-->

            </div><!--/.services-->
        </div><!--/.row-->    
    </div><!--/.container-->
</section><!--/#feature-->

<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Recent Works</h2>
            <p class="lead">Learn to balance between my dream and my job. The following are some of my activities during my study and work</p>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/1.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">Machung Intelligence Battle</a></h3>
                            <p>Best User Experience - 2014 - Ma Chung University, Indonesia</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div>   

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/2.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">Machung Intelligence Battle</a></h3>
                            <p>Best Design - 2015 - Ma Chung University, Indonesia</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div> 

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/3.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">Machung Intelligence Battle</a></h3>
                            <p>2016 - Ma Chung University, Indonesia</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/3.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div>   

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/4.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">Hackathon</a></h3>
                            <p>20th Champion of Hackathon II - 2015 - Telkom Indonesia, Indonesia</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/4.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div>   
            
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/5.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">Summa Cumlauda GPA 4.00 / 4.00</a></h3>
                            <p>Best Graduates  - 2017 - University of Surabaya, Indonesia</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/5.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div>   

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/6.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">SAP Consultant - Finance ABAPer</a></h3>
                            <p>PT Sun Paper Source - 2018 - PT Eclectic Consulting, Indonesia</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/6.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div> 

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/7.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">GPA 4.20 / 4.30 </a></h3>
                            <p>Graduates from Information Management - 2020 - Taiwan Tech, Taiwan</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/7.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div>   

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="{{asset('assets/images/recent_work/8.jpg')}}" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="">Outstanding Group Presentation of IAS</a></h3>
                            <p>Researcher - 2020 - Harbin Institute Technology</p>
                            <a class="preview" href="{{asset('assets/images/recent_work/8.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div> 
                    </div>
                </div>
            </div>   
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#recent-works-->

<section id="services" class="service-item">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>My Hard Skills</h2>
            <p class="lead">During my studies and work, I had the opportunity to develop my hard skills. Here are some hard skills that I have</p>
        </div>

        <div class="row">

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/java.png')}}">
                    </div>
                    <div class="media-body">                        
                        
                        <h3 class="media-heading">Desktop Developer</h3>                        
                        <p>C++, C#, Java <br><br></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/laravel.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Website Developer</h3>
                        <p>HTML, CSS, PHP, Javascript, Ajax, Laravel, JSon</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/android_studio.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Mobile Developer</h3>
                        <p>Android Studio <br><br></p>
                    </div>
                </div>
            </div>  

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/unity.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Game Developer</h3>
                        <p>Unity, Flash <br><br></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/python.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Machine Learning</h3>
                        <p>Python <br><br></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/mysql.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Database</h3>
                        <p>ERD, Mapping, Normalization, MySQL </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/sap.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">SAP</h3>
                        <p>S/4 HANA (ABAPer and Finance Consultant), C4C <br><br></p>
                    </div>
                </div>
            </div> 

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/linux.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Linux</h3>
                        <p>Command Line, Bash Scripting, Vim, Fundamentals</p><br>
                    </div>
                </div>
            </div> 

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="{{asset('assets/images/hard_skill/photoshop.png')}}">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">Design</h3>
                        <p>Photoshop, Pro Show Producer <br><br></p>
                    </div>
                </div>
            </div>                                                
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#services-->

<section id="middle">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 wow fadeInDown">
                <div class="skill">
                    <h2>My Hard Skills Percentages</h2>
                    <p>During my studies and works, my hard skills' level is as follows</p>

                    <div class="progress-wrap">
                        <h3>Desktop Developer</h3>
                        <div class="progress">
                            <div class="progress-bar  color2" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            <span class="bar-width">70%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Website Developer</h3>
                        <div class="progress">
                            <div class="progress-bar  color1" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                            <span class="bar-width">90%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Mobile Developer</h3>
                        <div class="progress">
                            <div class="progress-bar  color3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                            <span class="bar-width">50%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Game Developer</h3>
                        <div class="progress">
                            <div class="progress-bar color4" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="bar-width">40%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Machine Learning</h3>
                        <div class="progress">
                            <div class="progress-bar color1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                            <span class="bar-width">80%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Database</h3>
                        <div class="progress">
                            <div class="progress-bar color1" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                            <span class="bar-width">90%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>SAP</h3>
                        <div class="progress">
                            <div class="progress-bar color2" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                            <span class="bar-width">60%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Linux</h3>
                        <div class="progress">
                            <div class="progress-bar color4" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                            <span class="bar-width">30%</span>
                            </div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <h3>Design</h3>
                        <div class="progress">
                            <div class="progress-bar color3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                            <span class="bar-width">50%</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--/.col-sm-6-->

            <div class="col-sm-6 wow fadeInDown">
                <div class="accordion">
                    <h2>My Recent Projects</h2>
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <div class="panel-heading active">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                    Site Reliability Engineer - Data Force Pro
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseOne1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/srt.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Jul 2019 – Now</h4>
                                                <p>Tivoli, Mattermost, Jira, Rev IP Checker, IP Look Up, Sumo Logic, IP Subnetting, Linux, ADP, Confluence, SQL Alter Table Statement, Grafana, DB Cluster Look Up, DNS Checker</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                    Event Management Information System - 3Vite
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/vite.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Jan 2018 – Oct 2018</h4>
                                                <p><b>Web Development : </b> Laravel, PHP, HTML, JSon
                                                <br><b>Database : </b> MySQL
                                                <br><b>Mobile Development : </b> Android Studio</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                    SAP S/4 HANA - PT Sun Paper Source
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/sps.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Jul 2017 – Sep 2018</h4>
                                                <ul>
                                                    <li> Responsible for developing Report, Interface, Conversion, Enhancement, and Form.
                                                    <li> Making Technical Documentation and User Manual.
                                                    <li> Support for post go live implementation.
                                                    <li> Key User Support for Customer.
                                                    <li> ABAP Dictionary and Query.
                                                    <li> Dialog Program and Recording.
                                                    <li> BDC for Data Migration.
                                                    <li> ABAP Training.
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                    Forecasting Information System -  PT Violatama Inti Sejati
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/loggo.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Apr 2017 – Des 2017</h4>
                                                <p><b>Web Development : </b> Laravel, PHP, HTML, JSon
                                                <br><b>Database : </b> MySQL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFive1">
                                    E Commerce -  UD MMCK Beauty (Korean Cosmetic)
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseFive1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/mmck.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Aug 2017 – Oct 2017</h4>
                                                <p><b>Web Development : </b> Laravel, PHP, HTML, JSon
                                                <br><b>Database : </b> MySQL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseSix1">
                                    SAP C4C - Damai Putra Group
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseSix1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/damai_putra.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Jun 2017 – Jul 2017</h4>
                                                <ul>
                                                    <li> Responsible for developing C4C Form.
                                                    <li> Making User Manual.
                                                    <li> Support for post go live implementation.
                                                    <li> Key User Support for Customer.
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseSeven1">
                                    E Commerce -  UD Harmonis Motor
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseSeven1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/harmonis.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>May 2017 – Jul 2017</h4>
                                                <p><b>Web Development : </b> Laravel, PHP, HTML, JSon
                                                <br><b>Database : </b> MySQL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseEight1">
                                    SAP S/4 HANA - PT Sidomuncul Tbk
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseEight1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/sidomuncul.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Mar 2017 – Jun 2017</h4>
                                                <ul>
                                                    <li> Responsible for developing Report, Interface, Conversion, Enhancement, and Form.
                                                    <li> Making Technical Documentation and User Manual.
                                                    <li> Support for post go live implementation.
                                                    <li> Key User Support for Customer.
                                                    <li> ABAP Dictionary and Query.
                                                    <li> Dialog Program and Recording.
                                                    <li> BDC for Data Migration.
                                                </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseNine1">
                                    Company Profile -  UD Phoenix Embroidery
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseNine1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/phoenix.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Feb 2017 – Apr 2017</h4>
                                                <p><b>Web Development : </b> Laravel, PHP, HTML, JSon
                                                <br><b>Database : </b> MySQL</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTen1">
                                    Student Report Information System - University of Surabaya
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                                </h3>
                            </div>
                            <div id="collapseTen1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/recent_project/ubaya.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h4>Sep 2016 – Jan 2017</h4>
                                                <p><b>Web Development : </b> Laravel, PHP, HTML, JSon
                                                <br><b>Database : </b> MySQL
                                                <br><b>Mobile Development : </b> Android Studio (Volley, WebView)
                                                <br><b>Image Processing : </b> Open CV, Tesseract</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/#accordion1-->
                </div>
            </div>

        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#middle-->

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 wow fadeInDown">
                <div class="tab-wrap"> 
                    <div class="media">
                        <div class="parrent pull-left">
                            <ul class="nav nav-tabs nav-stacked">
                                <li class="active"><a href="#tab1" data-toggle="tab" class="analistic-01">Johanes Gabriel Elementary School</a></li>
                                <li class=""><a href="#tab2" data-toggle="tab" class="analistic-02">Saint Agnes Junior High School</a></li>
                                <li class=""><a href="#tab3" data-toggle="tab" class="analistic-03">Saint Louis Senior High School</a></li>
                                <li class=""><a href="#tab4" data-toggle="tab" class="analistic-04">University of Surabaya</a></li>
                                <li class=""><a href="#tab5" data-toggle="tab" class="analistic-05">Taiwan Tech</a></li>
                                <li class=""><a href="#tab6" data-toggle="tab" class="analistic-06">Harbin Institute Technology</a></li>
                            </ul>
                        </div>

                        <div class="parrent media-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab1">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/education/1.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h2>Johanes Gabriel Elementary School</h2>
                                                <p>2001 - 2007</p>
                                                <p>1st – 3rd Rank</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab2">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/education/2.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h2>Saint Agnes Junior High School</h2>
                                                <p>2007 - 2010</p>
                                                <p>1st Rank (Parallel)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab3">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/education/3.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h2>Saint Louis Senior High School</h2>
                                                <p>2010 - 2013</p>
                                                <p>1st - 5th Rank</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab4">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/education/4.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h2>University of Surabaya</h2>
                                                <p>2013 - 2017</p>
                                                <p>Bachelor Degree of Informatic Engineering</p>
                                                <p>1st Rank (Parallel)</p>
                                                <p>GPA 4.00 / 4.00 Credits 149 Points 525</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab5">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/education/5.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h2>Taiwan Tech</h2>
                                                <p>2018 - Present</p>
                                                <p>Master Degree of Information Management</p>
                                                <p>GPA 4.20 / 4.30 Credits 36</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab6">
                                    <div class="media">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="{{asset('assets/images/education/6.png')}}">
                                        </div>
                                        <div class="media-body">
                                                <h2>Harbin Institute Technology</h2>
                                                <p>2020 - 2020</p>
                                                <p>Winter Camp 2020</p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!--/.tab-content-->  
                        </div> <!--/.media-body--> 
                    </div> <!--/.media-->     
                </div><!--/.tab-wrap-->               
            </div><!--/.col-sm-6-->

            <div class="col-xs-12 col-sm-4 wow fadeInDown">
                <div class="testimonial">
                    <h2>Testimonials</h2>
                        <div class="media testimonial-inner">
                        <div class="pull-left">
                            <img class="img-responsive img-circle" src="{{asset('assets/images/testimonial/1.png')}}">
                        </div>
                        <div class="media-body">
                            <p>Daiva is a diligent and responsible student. He has critical thinking and good in time management.</p>
                            <span><strong>- Ferdyan Dannes</strong> Electrical Engineer</span>
                        </div>
                        </div>

                        <div class="media testimonial-inner">
                        <div class="pull-left">
                            <img class="img-responsive img-circle" src="{{asset('assets/images/testimonial/2.png')}}">
                        </div>
                        <div class="media-body">
                            <p>During the study, Daiva is a student who is able to manage time well, such as did research, learnt Mandarin, and worked as SRT.</p>
                            <span><strong>- Jeff L Gaol </strong> Biomechanical Engineer</span>
                        </div>
                        </div>

                </div>
            </div>

        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#content-->

<section id="partner">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>My Clients</h2>
            <p class="lead">I made software for large and small companies. <br> Here are some companies that have hired me.</p>
        </div>    

        <div class="partners">
            <ul>
                <li> <a href=""><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="{{asset('assets/images/client/mmck.png')}}"></a></li>
                <li> <a href=""><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="{{asset('assets/images/client/harmonis.png')}}"></a></li>
                <li> <a href=""><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="{{asset('assets/images/client/loggo.png')}}"></a></li>
                <li> <a href=""><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="{{asset('assets/images/client/phoenix.png')}}"></a></li>
                <li> <a href=""><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="{{asset('assets/images/client/vite.png')}}"></a></li>
                </ul>
        </div>        
    </div><!--/.container-->
</section><!--/#partner-->

<section id="conatcat-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="pull-left">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="media-body">
                        <h2>Are you interested in hiring me ?</h2>
                        <p>Contact me at +886 968 750 604 (TW), 0851 3232 0849 (ID)</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.container-->    
</section><!--/#conatcat-info-->
@endsection