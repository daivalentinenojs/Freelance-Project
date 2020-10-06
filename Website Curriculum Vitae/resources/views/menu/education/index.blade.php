@extends('layout.default')

@section('title','Education')

@section('content')
<section id="feature" class="transparent-bg">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>My Education</h2>
            <p class="lead">I decided to learn more about Computer Science during my Bachelor Degree and <br>Information Management during Master Degree. Here is my education.</p>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="media-body" style="text-align:center">
                            <img class="img-responsive" style="margin:auto" width="50%" height="50%" src="{{asset('assets/images/education/1.png')}}">
                            <h3 class="media-heading">Johanes Gabriel, Surabaya, Indonesia</h3>                        
                            <p>2001 - 2007<br>1st - 3rd Rank</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="media-body" style="text-align:center">
                            <img class="img-responsive" style="margin:auto" width="50%" height="50%" src="{{asset('assets/images/education/2.png')}}">
                            <h3 class="media-heading">Saint Agnes Junior High School, Surabaya, Indonesia</h3>                        
                            <p>2007 - 2010<br>1st Rank (Parallel)</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="media-body" style="text-align:center">
                            <img class="img-responsive" style="margin:auto" width="50%" height="50%" src="{{asset('assets/images/education/3.png')}}">
                            <h3 class="media-heading">Saint Louis 1 Senior High School, Surabaya, Indonesia</h3>                        
                            <p>2010 - 2013<br>1st - 5th Rank</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="media-body" style="text-align:center">
                            <img class="img-responsive" style="margin:auto" width="50%" height="50%" src="{{asset('assets/images/education/4.png')}}">
                            <h3 class="media-heading">University Of Surabaya, Surabaya, Indonesia</h3>                        
                            <p>2013 - 2017 <br> 1st Rank Parallel <br> GPA 4.00 / 4.00 <br> 149 credits <br> Points 525</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="media-body" style="text-align:center">
                            <img class="img-responsive" style="margin:auto" width="50%" height="50%" src="{{asset('assets/images/education/5.png')}}">
                            <h3 class="media-heading">National Taiwan University Of Science And Technology, Taipei, Taiwan</h3>                        
                            <p>2018 - 2020 <br> GPA 4.20 / 4.30 <br> 36 credits <br> <br></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown" style="background:rgb(250,250,250)">
                        <div class="media-body" style="text-align:center">
                            <img class="img-responsive" style="margin:auto" width="50%" height="50%" src="{{asset('assets/images/education/6.png')}}">
                            <h3 class="media-heading">Harbin Institute Of Technology, Harbin, China</h3>                        
                            <p>2020 - 2020<br>Winter School 2020<br><br><br><br></p>
                        </div>
                    </div>
                </div>
            </div><!--/.services-->
        </div><!--/.row-->         

        <div class="clients-area center wow fadeInDown">
            <h2>Organization</h2>
            <p class="lead">During my study, I was also active in committee activities. <br>Here are some of the organizations I have participated in.</p>
        </div>

        <div class="row">
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/education/1.png')}}" class="img-circle" alt="">
                    <h3><b>Science Olympic Team</b></h3>
                    <h4><span>- Johanes Garbriel /</span>  2005 - 2007</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/education/2.png')}}" class="img-circle" alt="">
                    <h3><b>Mathematics And <br>Physics Olympic Team</b></h3>
                    <h4><span>- Saint Agnes JHS /</span> 2007 - 2010</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/education/2.png')}}" class="img-circle" alt="">
                    <h3><b>2nd Vice Chairman And <br>1st Secretary</b></h3>
                    <h4><span>- Saint Agnes JHS /</span> 2008 - 2009</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/education/3.png')}}" class="img-circle" alt="">
                    <h3><b>Mathematics Olympic Team</b></h3>
                    <h4><span>- Saint Louis 1 SHS /</span> 2010 - 2011</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/education/3.png')}}" class="img-circle" alt="">
                    <h3><b>Junior RedCross Youth</b></h3>
                    <h4><span>- Saint Louis 1 SHS /</span> 2011 - 2013</h4>
                </div>
            </div>
            <div class="col-md-4 wow fadeInDown">
                <div class="clients-comments text-center">
                    <img src="{{asset('assets/images/education/4.png')}}" class="img-circle" alt="">
                    <h3><b>Informatics Student Group</b></h3>
                    <h4><span>- University Of Surabaya /</span> 2013 - 2015</h4>
                </div>
            </div>
        </div>

    </div><!--/.container-->
</section><!--/#feature-->
@endsection