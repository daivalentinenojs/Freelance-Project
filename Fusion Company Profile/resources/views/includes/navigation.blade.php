<nav class="gla_light_nav gla_transp_nav">
    <div class="container">

        <div class="gla_logo_container clearfix">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="" class="gla_logo_rev">
            <div class="gla_logo_txt">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="gla_logo">3Vite</a>

                <!-- Text Logo -->
                <div class="gla_logo_und">Your Perfect Event Planner</div>
            </div>
        </div>

        <!-- Menu -->
        <div class="gla_main_menu gla_main_menu_mobile">
            <div class="gla_main_menu_icon">
                <i></i><i></i><i></i><i></i>
                <b>Menu</b>
                <b class="gla_main_menu_icon_b">Back</b>
            </div>
        </div>

        <!-- Menu Content -->
        <div class="gla_main_menu_content gla_image_bck" data-color="rgba(0,0,0,0.9)"
             data-image="{{asset('assets/images/home/header-banner.jpg')}}">
            <!-- Over -->
            <div class="gla_over" data-color="#000" data-opacity="0.7"></div>
        </div>

        <div class="gla_main_menu_content_menu gla_bck_txt text-right">
            <div class="container">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('template') }}">Template</a></li>

                    @if ((Auth::check()))
                        <li class="gla_parent"><a href="">Wedding Website</a>
                            <ul>
                                <li><a href="{{ url('new-event') }}">Create A New Website</a></li>
                                <li><a href="{{ url('my-event') }}">Manage My Website</a></li>
                            </ul>
                        </li>
                    @endif

                <!-- <li class="gla_parent"><a href="">Invitation</a>
                         <ul>
                               <li><a href="">Invitation 1</a></li>
                               <li><a href="">Invitation 2</a></li>
                               <li><a href="">Invitation 3</a></li>
                         </ul>
                    </li> -->

                    @if (Auth::check())
                        @if (Auth::user()->role_id == 1)
                            <li class="gla_parent"><a href="">Master Data</a>
                                <ul>
                                    <li><a href="{{ url('master-data/dress-code') }}">Dress Code</a></li>
                                    <li><a href="{{ url('master-data/event-category') }}">Event Category</a></li>
                                    <li><a href="{{ url('master-data/event-place-category') }}">Event Place Category</a></li>
                                    <li><a href="{{ url('master-data/gallery-category') }}">Gallery Category</a></li>
                                    <li><a href="{{ url('master-data/guest-category') }}">Guest Category</a></li>
                                    <li><a href="{{ url('master-data/meal-preference') }}">Meal Preference</a></li>
                                    <li><a href="{{ url('master-data/role') }}">Role</a></li>
                                    <li><a href="{{ url('master-data/rsvp-status') }}">RSVP Status</a></li>
                                    <li><a href="{{ url('master-data/template') }}">Template</a></li>
                                </ul>
                            </li>
                        @endif
                    @endif

                    <li class="gla_parent"><a href="#">Our Company</a>
                        <ul>
                            <li><a href="{{ url('service') }}">Service</a></li>
                            <li><a href="{{ url('about-us') }}">About Us</a></li>
                            <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                        </ul>
                    </li>

                    @if (!(Auth::check()))
                        <li><a id="Login" href="">Log In</a></li>
                    @else
                        <li class="gla_parent"><a href="">Profile</a>
                            <ul>
                                <li><a href="{{ url('profile') }}">Personal Details</a></li>
                                <li><a href="{{ url('account') }}">Account Management</a></li>
                                <li><a href="{{ url('logout') }}">Log Out</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <div class="gla_main_menu_content_menu_copy">
                    <!-- <form>
                       <input type="text" class="form-control" placeholder="Enter Your Keywords">
                       <button type="submit" class="btn">
                          Search
                       </button>
                    </form> -->
                    <br>
                    <p>© 3Vite 2020</p>

                    <!-- Social Buttons -->
                    <!-- <div class="gla_footer_social">
                       <a href=""><i class="ti ti-facebook gla_icon_box"></i></a>
                       <a href=""><i class="ti ti-instagram gla_icon_box"></i></a>
                       <a href=""><i class="ti ti-google gla_icon_box"></i></a>
                       <a href=""><i class="ti ti-youtube gla_icon_box"></i></a>
                    </div> -->
                    <!-- End Social Buttons -->

                </div>
            </div>
            <!-- container end -->
        </div>
        <!-- menu content end -->

        <!-- Search Block -->
        <!-- <div class="gla_search_block">
           <div class="gla_search_block_link gla_search_parent"><i class="ti ti-search"></i>
              <ul>
                    <li>
                       <form>
                          <input type="text" class="form-control" placeholder="Enter Your Keywords">
                          <button type="submit" class="btn">
                             <i class="ti ti-search"></i>
                          </button>
                       </form>
                    </li>
              </ul>
           </div>
        </div> -->
        <!-- Search Block End -->

        <!-- Top Menu -->
        <div class="gla_default_menu">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('template') }}">Template</a></li>

                @if ((Auth::check()))
                    <li class="gla_parent"><a href="">Wedding Website</a>
                        <ul>
                            <li><a href="{{ url('new-event') }}">Create A New Website</a></li>
                            <li><a href="{{ url('my-event') }}">Manage My Website</a></li>
                        <!-- <li><a href="">Find A Couple's Wedding Wesbite</a></li> -->
                        </ul>
                    </li>
                @endif

            <!-- <li class="gla_parent"><a href="">Invitation</a>
                         <ul>
                               <li><a href="">Invitation 1</a></li>
                               <li><a href="">Invitation 2</a></li>
                               <li><a href="">Invitation 3</a></li>
                         </ul>
                    </li> -->

                @if (Auth::check())
                    @if (Auth::user()->role_id == 1)
                        <li class="gla_parent"><a href="">Master Data</a>
                            <ul>
                                <li><a href="{{ url('master-data/dress-code') }}">Dress Code</a></li>
                                <li><a href="{{ url('master-data/event-category') }}">Event Category</a></li>
                                <li><a href="{{ url('master-data/event-place-category') }}">Event Place Category</a>
                                </li>
                                <li><a href="{{ url('master-data/gallery-category') }}">Gallery Category</a></li>
                                <li><a href="{{ url('master-data/guest-category') }}">Guest Category</a></li>
                                <li><a href="{{ url('master-data/meal-preference') }}">Meal Preference</a></li>
                                <li><a href="{{ url('master-data/role') }}">Role</a></li>
                                <li><a href="{{ url('master-data/rsvp-status') }}">RSVP Status</a></li>
                                <li><a href="{{ url('master-data/template') }}">Template</a></li>
                            </ul>
                        </li>
                    @endif
                @endif

                <li class="gla_parent"><a href="#">Our Company</a>
                    <ul>
                        <li><a href="{{ url('service') }}">Service</a></li>
                        <li><a href="{{ url('about-us') }}">About Us</a></li>
                        <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                    </ul>
                </li>

                @if (!(Auth::check()))
                    <li><a id="Login" href="">Log In</a></li>
                @else
                    <li class="gla_parent"><a href="">Profile</a>
                        <ul>
                            <li><a href="{{ url('profile') }}">Personal Details</a></li>
                            <li><a href="{{ url('account') }}">Account Management</a></li>
                            <li><a href="{{ url('logout') }}">Log Out</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Top Menu End -->

    </div>
    <!-- container end -->
</nav>

<div class="modal fade" id="MyModalLogin" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="color: #777777">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Log into <span
                        style="color: rgb(255 195 19 / 1); font-size: 30px; font-family: 'marsha'">3Vite</span></h4>
            </div>
            <div class="modal-body">
                <form id="FormLogIn" action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <label>Email*</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control form-opacity"
                                   required
                                   data-parsley-maxlength="85"
                                   data-parsley-minlength="5">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <label>Password*</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   value="{{ old('password') }}"
                                   class="form-control form-opacity form-masked"
                                   required
                                   data-parsley-minlength="5">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            <input id="BtnLogIn" type="button" class="btn btn-vite" value="Login"
                                   style="background-color: rgb(255 195 19 / 1) !important;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            <a href="{{ url('reset-password') }}" style="color: #777777 !important;"><u>Forgot
                                    password?</u></a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            Not a member yet? <a href="" id="ModalRegister" style="color: #777777 !important;"><u>Join
                                    now!</u></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="MyModalRegister" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="color: #777777">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Your wedding plan starts now using <span
                        style="color: rgb(255 195 19 / 1); font-size: 30px; font-family: 'marsha'">3Vite</span></h4>
            </div>
            <div class="modal-body">
                <form id="FormSignUp" action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <label>Email*</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control form-opacity"
                                   required
                                   data-parsley-maxlength="85"
                                   data-parsley-minlength="5">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <label>Password*</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   value="{{ old('password') }}"
                                   class="form-control form-opacity form-masked"
                                   required
                                   data-parsley-minlength="5">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            <span style="color: #777777 !important; font-size: 10px !important;">By clicking ‘Sign Up’, I agree to 3Vite's Privacy Policy and Terms of Use.</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            <input id="BtnSignUp" type="button" class="btn btn-vite" value="Sign Up"
                                   style="background-color: rgb(255 195 19 / 1) !important;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 text-center">
                            Already a member of 3Vite? <a href="" id="ModalLogin" style="color: #777777 !important;"><u>Log
                                    In</u></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', '#Login', function (e) {
                e.preventDefault();
                $("#MyModalLogin").modal('show');
            });
        });

        $(function () {
            $(document).on('click', '#ModalLogin', function (e) {
                e.preventDefault();
                $("#MyModalLogin").modal('show');
                $("#MyModalRegister").modal('hide');
            });
        });

        $(function () {
            $(document).on('click', '#ModalRegister', function (e) {
                e.preventDefault();
                $("#MyModalRegister").modal('show');
                $("#MyModalLogin").modal('hide');
            });
        });

        $(function () {
            $(document).on('click', '#BtnLogIn', function (e) {
                e.preventDefault();
                $('#FormLogIn').attr('action', "login").submit();
            });
        });

        $(function () {
            $(document).on('click', '#BtnSignUp', function (e) {
                e.preventDefault();
                $('#FormSignUp').attr('action', "register").submit();
            });
        });
    </script>
@endpush

