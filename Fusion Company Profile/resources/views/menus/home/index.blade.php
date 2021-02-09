@extends('layouts.default')

@section('title','Home')

@section('slider')
    <div class="gla_slider gla_image_bck  gla_wht_txt gla_fixed"
         data-image="{{asset('assets/images/home/header-banner.jpg')}}" data-stellar-background-ratio="0.8">

        <!-- Over -->
        <div class="gla_over" data-color="#282828" data-opacity="0.5"></div>
        <div class="container">
            <!-- Slider Texts -->
            <div class="gla_slide_txt gla_slide_center_middle text-center">
                <div class="gla_slide_midtitle">Welcome to 3Vite <br> The Stress Free Way To Plan Your Event</div>
                <h3>Solution for planning wedding event and <br> user on booking desired wedding preparation with ease
                </h3><br>

                @if (!(Auth::check()))
                    <a id="ModalRegister" class="btn">Sign Up for Free Planning Events</a>
                @endif
            </div>
            <!-- Slider Texts End -->
        </div>
        <!-- container end -->
        <!-- Slide Down -->
        <a class="gla_scroll_down gla_go" href="#gla_content">
            <b></b>
            Scroll
        </a>
    </div>
@endsection

@section('music')
    <div class="gla_music_icon">
        <i class="ti ti-music"></i>
    </div>
    <div class="gla_music_icon_cont">
        <iframe
            src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/108238095&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"
            allow="autoplay"></iframe>
    </div>
@endsection

@section('content')
    <section id="gla_content" class="gla_content">
        <!-- section -->
        <!-- <section class="gla_section gla_image_bck" data-color="#f5efe4">
            <div class="container text-center">
                <h2>Find Your Dream Wedding Venue And Suppliers</h2>
                <h3 class="gla_subtitle">3Vite is the platform displaying detailed supplier prices & availability</h3>

                <div class="row">
                    <div class="col-md-3">
                        <select name="service" class="form-control">
                            <option disabled selected value="">What are you looking for?</option>
                            <option value="wedding-venues">Venues</option>
                            <option value="wedding-dresses">Wedding Dresses</option>
                            <option value="wedding-photography">Photography</option>
                            <option value="wedding-music-and-entertainment">Music &amp; Entertainment</option>
                            <option value="wedding-planners">Wedding Planners</option>
                            <option value="wedding-accessories">Accessories</option>
                            <option value="bridesmaid-dresses">Bridesmaid Dresses</option>
                            <option value="wedding-cakes">Cakes</option>
                            <option value="wedding-caterers">Caterers</option>
                            <option value="wedding-celebrants">Celebrants</option>
                            <option value="wedding-decor-and-styling">Decor &amp; Styling</option>
                            <option value="wedding-favours">Favours</option>
                            <option value="wedding-florists">Flowers</option>
                            <option value="groomswear">Groomswear</option>
                            <option value="wedding-hair-and-beauty">Hair &amp; Beauty</option>
                            <option value="honeymoons">Honeymoons</option>
                            <option value="wedding-jewellery">Jewellery</option>
                            <option value="wedding-marquees">Marquees</option>
                            <option value="wedding-props-and-photo-booths">Photo Booths</option>
                            <option value="stag-and-hen">Stag &amp; Hen</option>
                            <option value="wedding-stationery">Stationery</option>
                            <option value="wedding-toastmasters-and-speeches">Toastmasters</option>
                            <option value="wedding-transport">Transport</option>
                            <option value="wedding-videography">Videography</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="location" class="form-control">
                            <option disabled selected value="">Where is your wedding?</option>
                            <option value="aberdeen-and-deeside">Aberdeen &amp; Deeside</option>
                            <option value="argyll">Argyll</option>
                            <option value="auvergne-rhone-alpes">Auvergne-Rh&ocirc;ne-Alpes</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="date" class="form-control date_picker" placeholder="Do you know the date?">
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-auto" value="Search">
                    </div>
                </div>

            </div>
        </section> -->
        <!-- section end -->

        <br>

        <!-- section -->
        <section class="gla_section gla_image_bck" data-color="#fff">
            <div class="container text-center">

                <h2>Power For Your Event</h2>
                <h3 class="gla_subtitle">Our suite of easy-to-use apps will help you <br> save time and stress</h3>

                <!-- icon boxes -->
                <div class="gla_icon_boxes row">

                    <!-- animation -->
                    <div data-animation="animation_blocks" data-bottom="@class:noactive"
                         data--100-bottom="@class:active">

                        <!-- item -->
                        <!-- <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-018-smartphone"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>Budget Calculator</b></h4>
                                Lorem ipsum dolor sit amet, consectetur adipisicingelit, sed do
                            </div>

                        </div> -->

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-018-smartphone"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>Online Story</b></h4>
                                Tells your family and friends <br> about your love story
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-027-wedding-invitation"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>E - Invitation Card</b></h4>
                                Create free custom invitation your way, <br> as you want
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-016-calendar"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>RSVP Service</b></h4>
                                List out your guests, gather addresses, <br> collect RSVPs, and many more
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-004-notebook"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>E - Guest Book</b></h4>
                                Track your guests, <br> thank you notes, and gifts
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-020-gift"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>Gift Guides</b></h4>
                                Tell your guests what do you still need <br> and get the to send as gifts
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-043-rings"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>Event Guides</b></h4>
                                Let your guests know <br> the latest update on your event
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-019-plate-1"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>Table Planner</b></h4>
                                Replicate your venue's layout and find <br> the perfect place to seat for your guest
                            </div>
                        </div>

                        <!-- item -->
                        <div class="gla_icon_box col-md-3 col-sm-6">
                            <i class="flaticon-010-love"></i>
                            <div class="gla_icon_box_content">
                                <h4><b>Live Streaming Event</b></h4>
                                Broadcast your event live for your guests <br> who are not able to attend on site
                            </div>
                        </div>

                    </div>
                    <!-- anmation end -->

                </div>
                <!-- icon boxes end -->

            </div>
            <!-- container end -->

        </section>
        <!-- section end -->

        <br>

        <!-- section -->
        <section class="" data-color="#fff">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2543659466614!2d106.81865621529518!3d-6.230159062749254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3918e9b1a2f%3A0x368355d4a0b67ff6!2sCentennial%20Tower!5e0!3m2!1sid!2stw!4v1608942388640!5m2!1sid!2stw"
                width="100%" height="320" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0" allowfullscreen></iframe>
        </section>
        <!-- section end -->

        <br>

        <!-- section -->
        <section class="gla_section">
            <div class="container text-center">
                <br>
                <h2>Who We Are ?</h2>
                <h3 class="gla_subtitle">We provide a platform for users to plan their dream wedding events.</h3>
                <div class="row gla_shop">
                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over" data-image="{{asset('assets/images/home/vision.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Vision</span>
                            <p class="text-justify">Be the best apps to provide wedding inspiration and to plan your
                                dream wedding event.</p>
                        </a>
                    </div>

                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over" data-image="{{asset('assets/images/home/mission.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Mission</span>
                            <p class="text-justify">Provide and Plan with our trusted partners to realize your memorable
                                wedding event, also provide 3Vite features to make it more perfect.</p>
                        </a>
                    </div>

                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over" data-image="{{asset('assets/images/home/goal.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Goal</span>
                            <p class="text-justify">Provide the best service and satisfy 3Vite clients to realize and
                                achieve 1 unforgettable wedding day on a budget.</p>
                        </a>
                    </div>
                </div>
                <!-- row end -->
            </div>
            <!-- container end -->
        </section>
        <!-- section end -->

        <br>

        <!-- section -->
        <section class="gla_section gla_image_bck" data-color="#d8e5e9">
            <div class="container text-center">
                <h2>How It Works</h2>
                <h3 class="gla_subtitle">3 Steps to plan wedding event right on your fingertips.</h3>
                <!-- boxes -->
                <div class="gla_icon_boxes row text-left">
                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over" data-image="{{asset('assets/images/home/consulting.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Consulting</span>
                            <p class="text-center">Consult to find your ideal wedding, set a wedding planning timetable,
                                and create your own most important elements (theme, food, drink, etc).</p>
                        </a>
                    </div>

                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over" data-image="{{asset('assets/images/home/budgeting.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Budgeting</span>
                            <p class="text-center">Determine the number of invitations and who will be invited, the
                                budget of each element that has been planed (theme, venue, season, dress, hampers,
                                etc).</p>
                        </a>
                    </div>

                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over" data-image="{{asset('assets/images/home/organizing.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Organizing</span>
                            <p class="text-center">Colaborate with our partners and your family members to achieve your
                                memorable wedding event. Shareable spreadsheets are your best friend here.</p>
                        </a>
                    </div>
                </div>
                <!-- boxes end -->

            </div>
            <!-- container end -->

        </section>
        <!-- section end -->


        <!-- section -->
        <section class="gla_section">
            <div class="container text-center">

                <h2>Why Us ?</h2>
                <h3 class="gla_subtitle">Using 3Vite, we will realize your dream wedding event comes true.</h3>
                <!-- boxes -->
                <div class="gla_icon_boxes row text-left">
                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over"
                                  data-image="{{asset('assets/images/home/find-what-you-want.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Find What You Want</span>
                            <p class="text-center">Get inspired and connect to our partners to realize your dream
                                event.</p>
                        </a>
                    </div>

                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over"
                                  data-image="{{asset('assets/images/home/unique-budget.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Unique Budget</span>
                            <p class="text-center">Planning your event according to your unique budget and get a
                                relatively cheap price.</p>
                        </a>
                    </div>

                    <!-- item -->
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                        <span class="gla_news_img">
                            <span class="gla_over"
                                  data-image="{{asset('assets/images/home/perfect-companion.jpg')}}"></span>
                        </span>
                            <span class="gla_news_title text-center">Perfect Companion</span>
                            <p class="text-center">We and our trusted partners can make your dream wedding event come
                                true.</p>
                        </a>
                    </div>
                </div>
                <!-- boxes end -->

            </div>
            <!-- container end -->

        </section>
        <!-- section end -->

        <!-- section -->
        <!-- <section class="gla_section gla_image_bck" data-color="#d8e5e9">



            <div class="container text-center">

                <h2>Wedding Venues & Suppliers</h2>
                <p>From wedding venues to wedding dress boutiques, wedding invitations to wedding bands, search our comprehensive supplier listings and compare by price, availability, location and reviews</p>

                <div class="row gla_shop">


                        <div class="col-md-3 gla_anim_box">
                            <div class="gla_shop_item">
                                <span class="gla_shop_item_slider">
                                    <img src="http://placehold.it/600x600" alt="">
                                </span>

                                <a href="#" class="gla_shop_item_title">
                                    Wedding Dresses
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 gla_anim_box">
                            <div class="gla_shop_item">
                                <span class="gla_shop_item_slider">
                                    <img src="http://placehold.it/600x600" alt="">
                                </span>

                                <a href="#" class="gla_shop_item_title">
                                    Photography
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 gla_anim_box">
                            <div class="gla_shop_item">
                                <span class="gla_shop_item_slider">
                                    <img src="http://placehold.it/600x600" alt="">
                                </span>

                                <a href="#" class="gla_shop_item_title">
                                    Music & Entertainment
                                </a>
                            </div>
                        </div>

                        <div class="col-md-3 gla_anim_box">
                            <div class="gla_shop_item">
                                <span class="gla_shop_item_slider">
                                    <img src="http://placehold.it/600x600" alt="">
                                </span>

                                <a href="#" class="gla_shop_item_title">
                                    Venues
                                </a>
                            </div>
                        </div>


                </div>

                <p><a href="#" class="btn">More Suppliers</a></p>

            </div>

        </section> -->
        <!-- section end -->


        <!-- section -->
        <!-- <section class="gla_section">

            <div class="container text-center">

                <h2>Get Inspired</h2>
                <h3 class="gla_subtitle">Browse our blog for tips and inspiration. From Real Weddings to the latest trends, let us inspire you!</h3>

                <div class="gla_icon_boxes row text-left">

                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                            <span class="gla_news_img">
                                <span class="gla_over" data-image="http://placehold.it/600x600"></span>
                            </span>


                            <span class="gla_news_title">James & Nicola's Elegant Woodland Barn Weddin...</span>
                            <span class="gla_news_author">Real Weddings | 10 December</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa similique porro officiis nobis nulla quidem nihil iste veniam ut sit, maiores.</p>
                        </a>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                            <span class="gla_news_img">
                                <span class="gla_over" data-image="http://placehold.it/600x600"></span>
                            </span>


                            <span class="gla_news_title">6 Charitable Ways to Give Back on Your Weddin...</span>
                            <span class="gla_news_author">Things we love | 10 December</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa similique porro officiis nobis nulla quidem nihil iste veniam ut sit, maiores.</p>
                        </a>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="gla_news_block">
                            <span class="gla_news_img">
                                <span class="gla_over" data-image="http://placehold.it/600x600"></span>
                            </span>


                            <span class="gla_news_title">Natalia & Xavier's Parisian Engagement Shoot</span>
                            <span class="gla_news_author">Real Weddings | 10 December</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa similique porro officiis nobis nulla quidem nihil iste veniam ut sit, maiores.</p>
                        </a>
                    </div>


                </div>

                <p><a href="#" class="btn">View More Inspiration</a></p>


            </div>
        </section> -->
        <!-- section end -->


        <!-- section -->
        <!-- <section class="gla_section gla_image_bck" data-color="#f5efe4">

            <div class="container text-center">

                <h2>Our happy clients</h2>


                <div class="gla_team_slider_single">
                    <div class="gla_reviews_item">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam magni aperiam perferendis quas eveniet. Aspernatur nisi debitis mollitia perspiciatis. Aspernatur fugiat velit vel excepturi explicabo dolore! Voluptatem, quo dolores accusantium.</p>
                        <div class="gla_reviews_item_img">
                            <img src="http://placehold.it/100x100" alt="">
                        </div>
                        <p>Mirabelle Noelene</p>
                    </div>
                    <div class="gla_reviews_item">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam magni aperiam perferendis quas eveniet. Aspernatur nisi debitis mollitia perspiciatis. Aspernatur fugiat velit vel excepturi explicabo dolore! Voluptatem, quo dolores accusantium.</p>
                        <div class="gla_reviews_item_img">
                            <img src="http://placehold.it/100x100" alt="">
                        </div>
                        <p>Claude Allegra</p>
                    </div>
                    <div class="gla_reviews_item">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam magni aperiam perferendis quas eveniet. Aspernatur nisi debitis mollitia perspiciatis. Aspernatur fugiat velit vel excepturi explicabo dolore! Voluptatem, quo dolores accusantium.</p>
                        <div class="gla_reviews_item_img">
                            <img src="http://placehold.it/100x100" alt="">
                        </div>
                        <p>Emmaline Cynthia</p>
                    </div>
                </div>


            </div>
        </section> -->
        <!-- section end -->

        <!-- section -->
        <!-- <section class="gla_section gla_section_sml_padding">


            <div class="container text-center">


                <div class="gla_icon_boxes gla_partners row">



                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>

                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>


                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>


                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>

                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>


                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>


                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>


                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>


                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>

                    <div class="gla_partner_box">
                        <a href="#"><img src="http://placehold.it/250x100" height="80" alt=""></a>
                    </div>

                </div>

            </div>

        </section> -->
        <!-- section end -->

    </section>
@endsection
