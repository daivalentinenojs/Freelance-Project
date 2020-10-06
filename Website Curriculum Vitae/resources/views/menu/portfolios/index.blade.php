@extends('layout.default')

@section('title','Portfolios')

@section('content')
<section id="portfolio">
    <div class="container">
        <div class="center">
            <h2>My Portfolios</h2>
            <p class="lead">I have completed many projects, such as desktop, website, mobile, and game application. <br> Here are some projects that I have completed</p>
        </div>
    

        <ul class="portfolio-filter text-center">
            <li><a class="btn btn-default active" data-filter="*">All Works</a></li>
            <li><a class="btn btn-default" data-filter=".desktop">Desktop</a></li>
            <li><a class="btn btn-default" data-filter=".website">Website</a></li>
            <li><a class="btn btn-default" data-filter=".mobile">Mobile</a></li>
            <li><a class="btn btn-default" data-filter=".game">Game</a></li>
            <li><a class="btn btn-default" data-filter=".sap">SAP</a></li>
            <li><a class="btn btn-default" data-filter=".machine_learning">Machine Learning</a></li>
        </ul><!--/#portfolio-filter-->

        <div class="row">
            <div class="portfolio-items">
                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/stargan.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Star Generative Adversarial Network</a></h3>
                                                <p>StarGAN: Unified Generative Adversarial Networks for Multi-Domain Image-to-Image Translation by Yunjey Choi, Minje Choi, Munyoung Kim, Jung-Woo Ha, Sunghun Kim, Jaegul Choo</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/stargan.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Star <br>Generative Adversarial Network</h2>
                                        <p align="justify">StarGAN: Unified Generative Adversarial Networks for Multi-Domain Image-to-Image Translation by Yunjey Choi, Minje Choi, Munyoung Kim, Jung-Woo Ha, Sunghun Kim, Jaegul Choo</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>stargan</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/cyclegan.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Cycle Generative Adversarial Network</a></h3>
                                                <p>Unpaired Image-to-Image Translation using Cycle-Consistent Adversarial Networks by Jun-Yan Zhu, Taesung Park, Phillip Isola, Alexei A. Efros</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/cyclegan.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Cycle <br>Generative Adversarial Network</h2>
                                        <p align="justify">Unpaired Image-to-Image Translation using Cycle-Consistent Adversarial Networks by Jun-Yan Zhu, Taesung Park, Phillip Isola, Alexei A. Efros</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>cycegan</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/pix2pix.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Pix2Pix</a></h3>
                                                <p>Image-to-Image Translation with Conditional Adversarial Networks by Phillip Isola, Jun-Yan Zhu, Tinghui Zhou, Alexei A. Efros</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/pix2pix.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Pix2Pix</h2>
                                        <p align="justify">Image-to-Image Translation with Conditional Adversarial Networks by Phillip Isola, Jun-Yan Zhu, Tinghui Zhou, Alexei A. Efros</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>pix2pix</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/discogan.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Disco Generative Adversarial Network</a></h3>
                                                <p>Learning to Discover Cross-Domain Relations with Generative Adversarial Networks by Taeksoo Kim, Moonsu Cha, Hyunsoo Kim, Jung Kwon Lee, Jiwon Kim</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/discogan.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Disco <br>Generative Adversarial Network</h2>
                                        <p align="justify">Learning to Discover Cross-Domain Relations with Generative Adversarial Networks by Taeksoo Kim, Moonsu Cha, Hyunsoo Kim, Jung Kwon Lee, Jiwon Kim</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>discogan</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/dcgan.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Deep Convolution Generative Adversarial Network</a></h3>
                                                <p>Unsupervised Representation Learning with Deep Convolutional Generative Adversarial Networks by Alec Radford, Luke Metz, Soumith Chintala</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/dcgan.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Deep Convolution <br>Generative Adversarial Network</h2>
                                        <p align="justify">Unsupervised Representation Learning with Deep Convolutional Generative Adversarial Networks by Alec Radford, Luke Metz, Soumith Chintala</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>dcgan</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/cgan.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Conditional Generative Adversarial Network</a></h3>
                                                <p>Conditional Generative Adversarial Nets by Mehdi Mirza, Simon Osindero</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/cgan.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Conditional <br>Generative Adversarial Network</h2>
                                        <p align="justify">Conditional Generative Adversarial Nets by Mehdi Mirza, Simon Osindero</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>cgan</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/gan.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Generative Adversarial Network</a></h3>
                                                <p>Generative Adversarial Nets by Ian J. Goodfellow, Jean Pouget-Abadie, Mehdi Mirza, Bing Xu, David Warde-Farley, Sherjil Ozair, Aaron Courville, Yoshua Bengio</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/gan.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Generative Adversarial Network</h2>
                                        <p align="justify">Generative Adversarial Nets by Ian J. Goodfellow, Jean Pouget-Abadie, Mehdi Mirza, Bing Xu, David Warde-Farley, Sherjil Ozair, Aaron Courville, Yoshua Bengio</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>gan</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/faster_rcnn.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Faster RCNN</a></h3>
                                                <p>Faster R-CNN: Towards Real-Time Object Detection with Region Proposal Networks by Shaoqing Ren, Kaiming He, Ross Girshick, Jian Sun</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/faster_rcnn.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Faster RCNN</h2>
                                        <p align="justify">Faster R-CNN: Towards Real-Time Object Detection with Region Proposal Networks by Shaoqing Ren, Kaiming He, Ross Girshick, Jian Sun</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>faster_rcnn</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2020</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Image Synthesis</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->
                
                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/fractal.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Fractal Curve</a></h3>
                                                <p>This system is used to draw fractal curves. The fractal curve depicted depends on the number of polygons and the number of levels. The higher the number of polygons or the number of levels, the more complex the fractal curve.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/fractal.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Fractal Curve</h2>
                                        <p align="justify">This system is used to draw fractal curves. The fractal curve depicted depends on the number of polygons and the number of levels. The higher the number of polygons or the number of levels, the more complex the fractal curve.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>fractal_curve</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2019</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Multimedia</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item machine_learning col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/bezier.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Bezier Curve</a></h3>
                                                <p>This system is made for drawing bezier curves. The Bezier curve depicted can consist of two or three points. Thus, the formed bezier curve will have one or two midpoints.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/bezier.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Bezier Curve</h2>
                                        <p align="justify">This system is made for drawing bezier curves. The Bezier curve depicted can consist of two or three points. Thus, the formed bezier curve will have one or two midpoints.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>bezier_curve</a> / <a>machine_learning</a> / <a>deep_learning</a> / <a>image_synthesis</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2019</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Taiwan Tech</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Multimedia</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/vite.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Event Management Information System</a></h3>
                                                <p>3Vite is a startup that helps <br>to create invitations digitally.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/vite.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Event Management Information System</h2>
                                        <p align="justify">3Vite is a startup that helps to create invitations digitally. Through 3Vite, users can create wedding invitations, birthday invitations, and various invitations in digital form. 3Vite also helps event organizers to handle ongoing events, for example, arranging visitors' seats, arranging event schedules, and so on.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2019</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;3 Vite</a></span>
                                            <span><i class="fa fa-group"></i> <a>2 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Customer Relationship Management</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/konservasi.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Resources Conservation Center</a></h3>
                                                <p>This information system is used to assist the Resources Conservation Center in recording the resources of animals being cared for.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/konservasi.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Resources Conservation Center</h2>
                                        <p align="justify">This information system is used to assist the Resources Conservation Center in recording the resources of animals being cared for. In addition, this system is also able to calculate the possibility of the number of children from animals in a certain year. This system is also able to record the exchange of animals between one Resouce Conservation Center and other Resouce Conservation Center.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2018</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Surabaya Goverment</a></span>
                                            <span><i class="fa fa-group"></i> <a>2 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Forecasting</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/pendaftaran_tanah.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Handling Of Inherited Land</a></h3>
                                                <p>This system helps the government in managing disputed land. There are several rules made by the government in limiting land ownership in Indonesia.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/pendaftaran_tanah.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Handling Of Inherited Land</h2>
                                        <p align="justify">This system helps the government in managing disputed land. There are several rules made by the government in limiting land ownership in Indonesia. In addition, this system helps residents to administer land ownership legally and administer land grants as a parental inheritance.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2018</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Sidoarjo Goverment</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Customer Relatinoship Management</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item sap col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/sps.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>SAP S/4 HANA At PT Sun Paper Source</a></h3>
                                                <p>We implemented SAP S/4 HANA for Finance, Accounting, Product Planning, Material Management, and Sales modul.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/sps.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">SAP S/4 HANA At PT Sun Paper Source</h2>
                                        <p align="justify">Responsible for developing Report, Interface, Conversion, Enhancement, and Form. Making Technical Documentation and User Manual. 
                                        Support for post go live implementation. Key User Support for Customer. ABAP Dictionary and Query. Dialog Program and Recording. BDC for Data Migration. ABAP Training.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>sap</a> / <a>s4hana</a> / <a>finance</a> / <a>accounting</a> / <a>product_planning</a> / <a>material_management</a> / <a>sales</a> / <a>abaper</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2018</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;PT Sun Paper Source</a></span>
                                            <span><i class="fa fa-group"></i> <a>± 20 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;SAP S/4 HANA</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/forecasting.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Shoes Purchase Forecasting</a></h3>
                                                <p>One common problem of large companies is predicting the number of goods demand by customers in the coming month.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/forecasting.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Shoes Purchase Forecasting</h2>
                                        <p align="justify">One common problem of large companies is predicting the number of goods demand by customers in the coming month. This Forecasting System helps PT Violatama Inti Sejati to predict the number of purchases by customers in the coming month by observing data in the previous months. Finally, the company will be helped to prepare the raw materials needed to meet the needs of the customers.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2017</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;PT Violatama Inti Sejati</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Forecasting</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/harmonis.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Sales And Marketing IS For Car Spear Parts</a></h3>
                                                <p>This information system helps UD Harmonis Motor to make sales and purchase bills.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/harmonis.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Sales And Marketing IS For Car Spear Parts</h2>
                                        <p align="justify">This information system helps UD Harmonis Motor to make sales and purchase bills. Also, this system can record the number of stock car spear parts available in the warehouse. The process of finding a spear part is also made easy by storing spear part storage locations on this system.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2017</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;UD Harmonis Motor</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;E - Commerce</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item sap col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/damai_putra.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>SAP C4C At Damai Putra Group</a></h3>
                                                <p>We implemented SAP C4C for sales, service, and marketing modul.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/damai_putra.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">SAP C4C At Damai Putra Group</h2>
                                        <p align="justify"> Responsible for developing C4C Form. Making User Manual. Support for post go live implementation. Key User Support for Customer.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>sap</a> / <a>c4c</a> / <a>sales</a> / <a>service</a> / <a>marketing</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2017</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Damai Putra Group</a></span>
                                            <span><i class="fa fa-group"></i> <a>± 4 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;SAP C4C</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/mmck.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Sales IS For Korean Beauty Products</a></h3>
                                                <p>This system helps UD MMCK Beauty to sell beauty products through website pages.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/mmck.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Sales IS For Korean Beauty Products</h2>
                                        <p align="justify">This system helps UD MMCK Beauty to sell beauty products through website pages. The website created can record customers' data and make buying and selling transactions. The system is also able to display the availability of the stock of goods to customers.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2017</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;UD MMCK Beauty</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;E - Commerce</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item sap col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/sidomuncul.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>SAP S/4 HANA At PT Sidomuncul Tbk</a></h3>
                                                <p>We implemented SAP S/4 HANA for Finance, Accounting, Product Planning, Material Management, and Sales modul.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/sidomuncul.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">SAP S/4 HANA At PT Sidomuncul Tbk</h2>
                                        <p align="justify">Responsible for developing Report, Interface, Conversion, Enhancement, and Form. Making Technical Documentation and User Manual. 
                                        Support for post go live implementation. Key User Support for Customer. ABAP Dictionary and Query. Dialog Program and Recording. BDC for Data Migration.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>sap</a> / <a>s4hana</a> / <a>finance</a> / <a>accounting</a> / <a>product_planning</a> / <a>material_management</a> / <a>sales</a> / <a>abaper</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2017</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;PT Sidomuncul Tbk</a></span>
                                            <span><i class="fa fa-group"></i> <a>± 20 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;SAP S/4 HANA</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/phoenix.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Phoenix Embroidery Company Profile</a></h3>
                                                <p>This project shows the company profile of UD Phoenix Embroidery.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/phoenix.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Phoenix Embroidery Company Profile</h2>
                                        <p align="justify">This project shows the company profile of UD Phoenix Embroidery. UD Phoenix Embroidery is a trading business that accepts a large number of embroidery processes. Therefore, UD Phoenix Embroidery needs to introduce its business to customers through the digital world.</p>
                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2017</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;UD Phoenix Embroidery</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Company Profile</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item mobile col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/tesseract.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Information System To Recap Student Grades</a></h3>
                                                <p>This system needs to be made to do the value recap process automatically by reading handwriting.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/tesseract.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Information System To Recap Student Grades</h2>
                                        <p align="justify">This information system for the recap score is mobile-based. This system needs to be made to do the value recap process automatically by reading handwriting. The handwriting will be converted into digital text through the help of Tesseract. Finally, the value will be saved to the database automatically.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>android_volley</a> / <a>android_webview</a> / <a>android_studio</a> / <a>opencv</a> / <a>tesseract</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2016</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Master Data</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item website col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/recap_score.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Information System To Recap Student Grades</a></h3>
                                                <p>This information system is used to open new classes, input student grades, and calculate the final student grades automatically.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/recap_score.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Information System To Recap Student Grades</h2>
                                        <p align="justify">This information system is used to open new classes, input student grades, and calculate the final student grades automatically. This system is connected directly to the mobile application that has been created. This system also records students enrolled in a particular subject.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>html</a> / <a>php</a> / <a>laravel</a> / <a>ajax</a> / <a>json</a> / <a>mysql</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2016</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Master Data</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/indonesia_dash.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Indonesia Dash</a></h3>
                                                <p> This Indonesia Dash game is made on the mobile platform. This game was made to be included in the 2016 Machung Intelligence Battle.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/indonesia_dash.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Indonesia Dash</h2>
                                        <p align="justify">This Indonesia Dash game is made on the mobile platform. This game was made to be included in the 2016 Machung Intelligence Battle. The theme at that time was doing business through the digital world. From this theme, we make digital games to help foster a business soul for children.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>unity</a> / <a>a*</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2016</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Machung University</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Mobile Game</a></span>
                                            <span><i class="fa fa-trophy"></i><a>&nbsp;Machung Intelligence Battle</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item desktop col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/samsat.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Sequence Service Animation</a></h3>
                                                <p>This system helps customers from SAMSAT Surabaya to make the service booking process online.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/samsat.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Sequence Service Animation</h2>
                                        <p align="justify">This system helps customers from SAMSAT Surabaya to make the service booking process online. In addition, this system helps customers explain the driving license management stages at SAMSAT Surabaya.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>flash</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2015</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Surabaya Goverment</a></span>
                                            <span><i class="fa fa-group"></i> <a>4 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Customer Relationship Management</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/ksm_tekkim.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Learning Chemical Elements</a></h3>
                                                <p>This system helps children to learn to recognize the chemical elements.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/ksm_tekkim.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Learning Chemical Elements</h2>
                                        <p align="justify">This system helps children to learn to recognize the chemical elements. Learning can be given in the form of the properties of chemical elements, the function of these chemical elements, and how we can find these chemical elements. The purpose of this system is to foster children's curiosity about the chemical elements.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>flash</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2015</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Chemical Student Group</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Desktop Game</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/budaya.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Learning Indonesian Culture</a></h3>
                                                <p>Indonesia Culture Learning Game is used to introduce Indonesian culture to the community, especially children.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/budaya.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Learning Indonesian Culture</h2>
                                        <p align="justify">Indonesia Culture Learning Game is used to introduce Indonesian culture to the community, especially children. The game presented introduces traditional houses, dances, songs, food, and traditional musical instruments. In addition, this game also introduces Indonesian in a game. This game was contested in the 2015 Machung Intelligence Battle and won the title as Best Design.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c#</a> / <a>stream_reader</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2015</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Machung University</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Desktop Game</a></span>
                                            <span><i class="fa fa-trophy"></i><a>&nbsp;Machung Intelligence Battle - Best Design</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/cookie_run.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Cookie Run Computer Graphic Version</a></h3>
                                                <p>In this game, I re-created the game Cookie Run with the graphics of the game were made using characters from computer graphics.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/cookie_run.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Cookie Run Computer Graphic Version</h2>
                                        <p align="justify">Cookie Run is one of the famous mobile games at that time. In this game, I re-created the game Cookie Run with a desktop platform and the graphics of the game were made using characters from computer graphics.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c++</a> / <a>computer_graphic</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2014</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>1 Person</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Desktop Game</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item desktop col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/tak.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Automata Compiler For Reservation Module</a></h3>
                                                <p>This system applies the compiler automata algorithm to understand inputted sentences.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/tak.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Automata Compiler For Reservation Module</h2>
                                        <p align="justify">This system applies the compiler automata algorithm to understand inputted sentences. This system is able to make bots to answer automatically from order sentences entered by the customer. The ultimate goal is the system can calculate the amount of money to be paid from customer orders.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c#</a> / <a>automata_compiler</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2014</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Automata Compiler</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item desktop col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/ez_retail.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Information System For Sales And Inventory</a></h3>
                                                <p>This information system is used for the inventory process in the EZ Retail trading business.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/ez_retail.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Information System For Sales And Inventory</h2>
                                        <p align="justify">This information system is used for the inventory process in the EZ Retail trading business. The system can also print sales bills from customers and purchase bills from suppliers. The system is also capable of handling the transfer of goods from one company branch to another branch.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c#</a> / <a>sql_server</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2014</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Sales And Inventory Management</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/menanam.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Learning How To Plan A Tree</a></h3>
                                                <p>This game is made to teach children how to maintain a good environment. We introduce Trembesi trees that are able to produce oxygen in large quantities.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/menanam.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Learning How To Plan A Tree</h2>
                                        <p align="justify">This game is made to teach children how to maintain a good environment. We introduce Trembesi trees that are able to produce oxygen in large quantities. This game also teaches how to plant trees properly and how to repel pests that are detrimental to plants. This game was included in the 2014 Machung Intelligence Battle and won the Best User Experience category.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c#</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2014</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;Machung University</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Desktop Game</a></span>
                                            <span><i class="fa fa-trophy"></i><a>&nbsp;Machung Intelligence Battle - Best User Experience</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/belajar_os.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Learning About CPU Scheduling</a></h3>
                                                <p>This game teaches how the Computer Processing Unit works on a computer.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/belajar_os.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Learning About CPU Scheduling</h2>
                                        <p align="justify">This game is made on a desktop platform. This game teaches how the Computer Processing Unit works on a computer. The goal is that students can distinguish between the various scheduling processes that are run by the Computer Processing Unit.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c#</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2014</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>4 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Desktop Game</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->

                <div class="blog">
                    <div class="row">
                        <div class="portfolio-item game col-md-12">
                            <div class="blog-item">
                                <div class="row">  
                                    <div class="col-xs-12 col-sm-4 text-center recent-work-wrap">
                                        <img class="img-responsive img-blog" src="{{asset('assets/images/portfolios/monopoly_space.png')}}" width="100%" alt="" />
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <h3><a>Monopoly Space</a></h3>
                                                <p>We make monopoly games with space themes and rules that we make ourselves.</p>
                                                <a class="preview" href="{{asset('assets/images/portfolios/monopoly_space.png')}}" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 blog-content">
                                        <h2 style="font-size:25px;">Monopoly Space</h2>
                                        <p align="justify">Monopoly game is a game that can be played by several people. This game is also quite famous in the youth group. Therefore, we make monopoly games with space themes and rules that we make ourselves. The hope this game can entertain many people.</p>

                                        <div class="post-tags">
                                            <strong>Tag:</strong> <a>c#</a> / <a>stream_reader</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <div class="entry-meta">
                                            <span id="publish_date">2014</span>                                            
                                            <span><i class="fa fa-building-o"></i> <a>&nbsp;University Of Surabaya</a></span>
                                            <span><i class="fa fa-group"></i> <a>3 People</a></span>
                                            <span><i class="fa fa-desktop"><a>&nbsp;</a></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-envelope"></i><a>&nbsp;Desktop Game</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.blog-item-->
                        </div><!--/.col-md-12-->  
                    </div><!--/.row-->
                </div><!--/.blog-->
            </div>
        </div>
    </div>
</section><!--/#portfolio-item-->
@endsection