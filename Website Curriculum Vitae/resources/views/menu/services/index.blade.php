@extends('layout.default')

@section('title','Services')

@section('content')
<section id="feature" class="transparent-bg">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>My Services</h2>
            <p class="lead">I have several skills that can help you. <br> Currently, I accept the project as a permanent employee or contract employee. <br> I also have a reliable team to work on your project. <br> Here are some services that I can provide</p>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown"style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
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
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{asset('assets/images/hard_skill/photoshop.png')}}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Design</h3>
                            <p>Photoshop, Pro Show Producer <br><br></p>
                        </div>
                    </div>
                </div> 
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