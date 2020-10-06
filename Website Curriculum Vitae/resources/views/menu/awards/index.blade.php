@extends('layout.default')

@section('title','Awards')

@section('content')
<section id="portfolio">
    <div class="container">
        <div class="center">
            <h2>My Awards</h2>
            <p class="lead">During my studies and work, I received several awards and certifications. <br> Some of my achievements are as follows</p>
        </div>    

        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" data-filter="*">All Awards</a></li>
            <li><a class="btn btn-default" data-filter=".english">English</a></li>
            <li><a class="btn btn-default" data-filter=".mandarin">中文</a></li>
            <li><a class="btn btn-default" data-filter=".math">Mathematics</a></li>
            <li><a class="btn btn-default" data-filter=".science">Science</a></li>
            <li><a class="btn btn-default" data-filter=".informatics">Informatics</a></li>
            <li><a class="btn btn-default" data-filter=".hobbies">Hobbies</a></li>
            <li><a class="btn btn-default" data-filter=".organization">Organization</a></li>
            <li><a class="btn btn-default" data-filter=".certification">Certification</a></li>            
        </ul><!--/#portfolio-filter-->

        <div class="row">
            <div class="portfolio-items">
                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/18.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Summa Cumlauda</a></h3>
                                <p>GPA 4.00 / 4.00 <br> University Of Surabaya <br> Computer Science <br> 25th March 2017</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/18.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/19.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Summa Cumlauda</a></h3>
                                <p>GPA 4.00 / 4.00 <br> University Of Surabaya <br> Computer Science <br> 25th March 2017</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/19.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/20.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">The Best Graduate In Computer Science 2013 - 2017</a></h3>
                                <p>GPA 4.00 / 4.00 <br> University Of Surabaya <br> Computer Science <br> 25th March 2017</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/20.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/24.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">The Best Graduate In Computer Science 2013 - 2017</a></h3>
                                <p>GPA 4.00 / 4.00 <br> University Of Surabaya <br> Computer Science <br> 25th March 2017</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/24.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/25.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Best User Experience</a></h3>
                                <p>Ma Chung University <br> 13rd - 14th June 2014</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/25.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/26.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Best Design</a></h3>
                                <p>Ma Chung University <br> 09th - 10th May 2014</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/26.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item hobbies col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/hobbies/5.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Place Of Recycle Competition</a></h3>
                                <p>Mater Amabilis <br> 16th February 2008</p>
                                <a class="preview" href="{{asset('assets/images/awards/hobbies/5.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/8.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Science Competition</a></h3>
                                <p>Saint Agnes Junior High School <br> 21st January 2006</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/8.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item math col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/math/5.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Place Of Mathematics Competition</a></h3>
                                <p>Angelus Custos Junior High School <br> 03rd February 2007</p>
                                <a class="preview" href="{{asset('assets/images/awards/math/5.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item math col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/math/6.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Mathematics Competition</a></h3>
                                <p>Stela Maris Senior High School <br> 19th - 26th October 2009</p>
                                <a class="preview" href="{{asset('assets/images/awards/math/6.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/9.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Academic Report</a></h3>
                                <p>Saint Agnes Junior High School <br> 22nd May 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/9.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/10.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Academic Report</a></h3>
                                <p>Saint Agnes Junior High School <br> 22nd May 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/10.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/11.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">3rd Place Of Science Competition</a></h3>
                                <p>Johannes Gabriel Elementary School <br> 02nd May 2005</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/11.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->
            </div>
        </div>

        <div class="row">
            <div class="portfolio-items">
            <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/7.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Outstanding Group Presentation</a></h3>
                                <p>Harbin Institue Of Technology <br> 11th January 2020</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/7.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item certification col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/certification/1.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Linux Essentials Certification</a></h3>
                                <p>Linux Academy <br> 21st August 2019</p>
                                <a class="preview" href="{{asset('assets/images/awards/certification/1.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item certification col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/certification/2.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Linux OS Fundamentals</a></h3>
                                <p>Linux Academy <br> 17th June 2019</p>
                                <a class="preview" href="{{asset('assets/images/awards/certification/2.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item certification col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/certification/3.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Vim - The Improved Editor</a></h3>
                                <p>Linux Academy <br> 10th September 2019</p>
                                <a class="preview" href="{{asset('assets/images/awards/certification/3.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item certification col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/certification/4.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">The System Administrator's Guide</a></h3>
                                <p>Linux Academy <br> 15th September 2019</p>
                                <a class="preview" href="{{asset('assets/images/awards/certification/4.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item certification col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/certification/5.png')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Mastering Linux Command Line</a></h3>
                                <p>Linux Academy <br> 17th June 2019</p>
                                <a class="preview" href="{{asset('assets/images/awards/certification/5.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/13.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Fiftieth Place </a></h3>
                                <p>ACM ICPC Asia Singapore <br> National University Of Singapore <br> 2015</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/13.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->
                
                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/14.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Best User Experience Winner</a></h3>
                                <p>Ma Chung University <br> 13th - 14th June 2014</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/14.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/15.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Best Design Winner</a></h3>
                                <p>Ma Chung University <br> 09th - 10th May 2015</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/15.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/16.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">The Best Graduate</a></h3>
                                <p>University Of Surabaya <br> Computer Science <br> 24th March 2017</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/16.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/21.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Graphiquest</a></h3>
                                <p>University Of Surabaya <br> Computer Science <br> 10th January 2015</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/21.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/22.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">HTML 5</a></h3>
                                <p>University Of Surabaya <br> Computer Science <br> 2015</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/22.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/23.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Workshop Sponsorship</a></h3>
                                <p>University Of Surabaya <br> Computer Science <br> 30th May 2015</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/23.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Typing Skill</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/2.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Introduction To Windows</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/3.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Word Processing</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/3.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/4.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Level 5 Phase 1 Pascal Programming</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/4.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->
                
                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/5.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Level 5 Phase 2 Pascal Programming</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/5.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/6.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Spreadsheet</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/6.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/7.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Introduction To HTML</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/7.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/8.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">3D Animation</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/8.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/9.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Borland Delphi</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/9.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/10.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Adobe Director</a></h3>
                                <p>Intelkidz</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/10.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->                

                <div class="portfolio-item math col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/math/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Math Competition</a></h3>
                                <p>Stela Maris Senior High School <br> 22nd May 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/math/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item math col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;" >
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/math/2.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Place Of Math Competition</a></h3>
                                <p>Angelus Custos Junior High School <br> 03rd February 2007</p>
                                <a class="preview" href="{{asset('assets/images/awards/math/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item math col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;" >
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/math/4.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Semi Finalis Of Mathematics Olimpiade</a></h3>
                                <p>Airlangga University <br> 15th And 22nd February 2009</p>
                                <a class="preview" href="{{asset('assets/images/awards/math/4.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/2.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Academic Report</a></h3>
                                <p>Saint Agnes Junior High School <br> 22nd May 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/3.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Academic Report</a></h3>
                                <p>Saint Agnes Junior High School <br> 22nd May 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/3.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/4.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Semi Finalis Of Science Competition</a></h3>
                                <p>Saint Louis Senior High School <br> 25th - 26th September 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/4.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/5.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Selection Of Science Competition</a></h3>
                                <p>Saint Louis Senior High School <br> 07th - 11th October 2009</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/5.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/6.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Quarter Final Of Math Competition</a></h3>
                                <p>5th National Senior High School <br> 17th , 18th , And 24th April 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/6.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item mandarin col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/mandarin/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">中文報告</a></h3>
                                <p>Saint Louis Senior High School <br> 01st June 2013</p>
                                <a class="preview" href="{{asset('assets/images/awards/mandarin/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item hobbies col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/hobbies/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">4th Place OF Choir Competition</a></h3>
                                <p>Johannes Gabriel <br> 01st October 2005</p>
                                <a class="preview" href="{{asset('assets/images/awards/hobbies/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item hobbies col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/hobbies/2.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Gamelan</a></h3>
                                <p>Surabaya Goverment <br> 18th - 22nd June 2008</p>
                                <a class="preview" href="{{asset('assets/images/awards/hobbies/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item hobbies col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/hobbies/3.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Place Of Recycle Competition</a></h3>
                                <p>Mater Amabilis <br> 16th February 2008</p>
                                <a class="preview" href="{{asset('assets/images/awards/hobbies/3.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item organization col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/organization/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Vice Chairman And Secretary 1</a></h3>
                                <p>Saint Agnes Junior High School <br> 13th June 2009</p>
                                <a class="preview" href="{{asset('assets/images/awards/organization/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item organization col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/organization/2.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Documentation Team</a></h3>
                                <p>Saint Louis Senior High School <br> 24th September 2010</p>
                                <a class="preview" href="{{asset('assets/images/awards/organization/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->
            </div>
        </div>

        <div class="row">
            <div class="portfolio-items">
                <div class="portfolio-item informatics col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/informatics/17.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Excellent Grade Of Information Technology</a></h3>
                                <p>Alfa Omega <br> 11th June 2007</p>
                                <a class="preview" href="{{asset('assets/images/awards/informatics/17.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item math col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/math/3.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Mathematics Competition</a></h3>
                                <p>Stela Maris Senior High School <br> 19th - 26th October 2009</p>
                                <a class="preview" href="{{asset('assets/images/awards/math/3.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->

                <div class="portfolio-item science col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/science/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">1st Place Of Science Competition</a></h3>
                                <p>Saint Agnes Junior High School <br> 21st January 2006</p>
                                <a class="preview" href="{{asset('assets/images/awards/science/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item--> 

                <div class="portfolio-item english col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/english/1.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Top Scored In Vocabulary II Test</a></h3>
                                <p>Ignatius Layola <br> 31st January 2006</p>
                                <a class="preview" href="{{asset('assets/images/awards/english/1.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->     
                
                <div class="portfolio-item english col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/english/2.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Top Scored In Vocabulary I Test</a></h3>
                                <p>Ignatius Layola <br> 01st December 2004</p>
                                <a class="preview" href="{{asset('assets/images/awards/english/2.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item--> 

                <div class="portfolio-item english col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/english/3.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">English Writing Competition</a></h3>
                                <p>James Cook University <br> 19th March 2012</p>
                                <a class="preview" href="{{asset('assets/images/awards/english/3.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item--> 

                <div class="portfolio-item english col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/english/4.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">Academic Achievement</a></h3>
                                <p>Ignatius Layola <br> 27th January 2004</p>
                                <a class="preview" href="{{asset('assets/images/awards/english/4.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item--> 
                
                <div class="portfolio-item hobbies col-xs-12 col-sm-4 col-md-3" style="border-style: solid; border-width: 2px;">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="{{asset('assets/images/awards/hobbies/4.jpg')}}" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><a style="font-size:20px">2nd Winner Of Coloring Picture</a></h3>
                                <p>Ignatius Layola <br> 18th December 2005</p>
                                <a class="preview" href="{{asset('assets/images/awards/hobbies/4.jpg')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                            </div> 
                        </div>
                    </div>
                </div><!--/.portfolio-item-->
            </div>
        </div>

        
    </div>
</section><!--/#portfolio-item-->
@endsection