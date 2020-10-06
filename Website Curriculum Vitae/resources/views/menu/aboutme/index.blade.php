@extends('layout.default')

@section('title','About Me')

@section('content')
<section id="about-us">
    <div class="container">
        <section id="recent-works">
            <div class="container">
                <div class="center wow fadeInDown">
                    <h2>Introduction</h2>
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

        <div class="center wow fadeInDown">
            <h2>About Me</h2>
            <p class="lead">My name is Daivalentineno Janitra Salim. This year, I turned 24 years old.<br>
            I am a curious, discipline, critical thinking, and hardworking person.<br>I graduated from Faculty of Engineering,
            majoring in Informatics Engineering, University of Surabaya, Indonesia.<br>
            I study at Taiwan Tech, Taiwan, majoring in Information Management, Information Technology and Application
            <br>(Big Data and Machine Learning) Laboratory.</p>
        </div>
        
        <!-- about us slider -->
        <div id="about-slider">
            <div id="carousel-slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators visible-xs">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{asset('assets/images/about_me/1.jpg')}}" class="img-responsive" alt=""> 
                    </div>
                    <div class="item">
                        <img src="{{asset('assets/images/about_me/2.jpg')}}" class="img-responsive" alt=""> 
                    </div> 
                    <div class="item">
                        <img src="{{asset('assets/images/about_me/3.jpg')}}" class="img-responsive" alt=""> 
                    </div> 
                </div>
                
                <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
                    <i class="fa fa-angle-left"></i> 
                </a>
                
                <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
                    <i class="fa fa-angle-right"></i> 
                </a>
            </div> <!--/#carousel-slider-->
        </div><!--/#about-slider-->
        
        
        <!-- Our Skill -->
        <div class="skill-wrap clearfix">        
            <div class="center wow fadeInDown">
                <h2>My Skills</h2>
                <p class="lead">During my studies and works, my hard skills' level is as follows</p>
            </div>            
            <div class="row">    
                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="desktop-skill">                                   
                            <p><em>70%</em></p>
                            <p style="font-size:12px">C++, C#, Java</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="web-skill">                                  
                            <p><em>90%</em></p>
                            <p style="font-size:12px">HTML, CSS, PHP, Javascript, Ajax, Laravel, JSon</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">
                        <div class="mobile-skill" style="color:black">                                    
                            <p><em style="color:black">50%</em></p>
                            <p style="font-size:12px">Android Studio</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms">
                        <div class="game-skill" style="color:black">
                            <p><em style="color:black">40%</em></p>
                            <p style="font-size:12px" >Unity, Flash</p>                                     
                        </div>
                    </div>
                </div>  
                
                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms">
                        <div class="machine-skill">                                  
                            <p><em>80%</em></p>
                            <p style="font-size:12px">Python</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1800ms">
                        <div class="database-skill">                                  
                            <p><em>90%</em></p>
                            <p style="font-size:12px">ERD, Mapping, Normalization, <br> MySQL</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="2100ms">
                        <div class="sap-skill">                                   
                            <p><em>60%</em></p>
                            <p style="font-size:12px">S/4 HANA (ABAPer <br> and Finance <br> Consultant), C4C</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="sinlge-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="2400ms">
                        <div class="linux-skill" style="color:black">
                            <p><em style="color:black">30%</em></p>
                            <p style="font-size:12px;">Command Line, Bash Scripting, Vim, <br> Fundamentals</p>                                     
                        </div>
                    </div>
                </div>  
            </div>
        </div><!--/.our-skill-->
        

        <!-- our-team -->
        <div class="team">
            <div class="center wow fadeInDown">
                <h2>My Partners</h2>
                <p class="lead">I have several partners who are expert in their fields to help my project. Here are some of my partners.</p>
            </div>

            <div class="row clearfix">
                <div class="col-md-4 col-sm-6">	
                    <div class="single-profile-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="media">
                            <div class="pull-left">
                                <a href=""><img class="media-object" src="{{asset('assets/images/partner/alexandra.png')}}" alt=""></a>
                            </div>
                            <div class="media-body">
                                <h4>Alexandra</h4>
                                <h5>Business Consultant</h5>
                                <ul class="tag clearfix">
                                    <li class="btn"><a>Strategic Planning</a></li>
                                    <li class="btn"><a>Marketing</a></li>
                                    <li class="btn"><a>Finance</a></li>
                                </ul>
                                
                                <ul class="social_icons">
                                    <li><a href="https://www.facebook.com/alexavannie" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--/.media -->
                        <p>Finance, Bina Nusantara University, 2013 - 2017<br>
                        Finance, Institute Francais Indonesie, 2017</p>
                    </div>
                </div><!--/.col-lg-4 -->
                
                
                <div class="col-md-4 col-sm-6 col-md-offset-2">	
                    <div class="single-profile-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="media">
                            <div class="pull-left">
                                <a href=""><img class="media-object" src="{{asset('assets/images/partner/yulius.png')}}" alt=""></a>
                            </div>
                            <div class="media-body">
                                <h4>Dian Yulius</h4>
                                <h5>Web, Mobile Developer</h5>
                                <ul class="tag clearfix">
                                    <li class="btn"><a>Laravel</a></li>
                                    <li class="btn"><a>Android Studio</a></li>
                                    <li class="btn"><a>UI</a></li>
                                </ul>
                                <ul class="social_icons">
                                    <li><a><i class="fa fa-facebook"></i></a></li>
                                    <li><a><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--/.media -->
                        <p>Computer Science, ISTTS, 2013 - 2017</p>
                    </div>
                </div><!--/.col-lg-4 -->					
            </div> <!--/.row -->
            <div class="row team-bar">
                <div class="first-one-arrow hidden-xs">
                    <hr>
                </div>
                <div class="first-arrow hidden-xs">
                    <hr> <i class="fa fa-angle-up"></i>
                </div>
                <div class="second-arrow hidden-xs">
                    <hr> <i class="fa fa-angle-down"></i>
                </div>
                <div class="third-arrow hidden-xs">
                    <hr> <i class="fa fa-angle-up"></i>
                </div>
                <div class="fourth-arrow hidden-xs">
                    <hr> <i class="fa fa-angle-down"></i>
                </div>
            </div> <!--skill_border-->       

            <div class="row clearfix">   
                <div class="col-md-4 col-sm-6 col-md-offset-2">	
                    <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="media">
                            <div class="pull-left">
                                <a href=""><img class="media-object" src="{{asset('assets/images/partner/ika.png')}}" alt=""></a>
                            </div>

                            <div class="media-body">
                                <h4>Ika Suryani</h4>
                                <h5>SAP Consultant</h5>
                                <ul class="tag clearfix">
                                    <li class="btn"><a>Accounting</a></li>
                                    <li class="btn"><a>ABAP</a></li>
                                    <li class="btn"><a>Crystal Report</a></li>
                                </ul>
                                <ul class="social_icons">
                                    <li><a href="https://www.facebook.com/suryaniika" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--/.media -->
                        <p>Computer Science, University of Surabaya, 2013 - 2017</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-md-offset-2">
                    <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="media">
                            <div class="pull-left">
                                <a href=""><img class="media-object" src="{{asset('assets/images/partner/dannes.png')}}" alt=""></a>
                            </div>
                            <div class="media-body">
                                <h4>Ferdyan Dannes</h4>
                                <h5>Electrical Engineer</h5>
                                <ul class="tag clearfix">
                                    <li class="btn"><a>Embedded System</a></li>
                                    <li class="btn"><a>Programmable Logic Control</a></li>
                                </ul>
                                <ul class="social_icons">
                                    <li><a href="https://www.facebook.com/ferdyan.dannes" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--/.media -->
                        <p>Electrical Engineering, ITS, 2014 - 2018<br>
                        Electrical Engineering, Taiwan Tech, 2018 - 2019</p>
                    </div>
                </div>
            </div>	<!--/.row-->
        </div><!--section-->
    </div><!--/.container-->
</section><!--/about-us-->
@endsection
