<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-ae26465b-bcd7-4cd3-b5e6-81f6a6206eea"></div>

<section id="simple" class="gla_image_bck gla_section_extra_sml" data-color="#e5e5e5">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <h4>Our Company</h4>
        <ul class="list-unstyled">
          <li><a href="{{ url('/')}}">Home</a></li>
          <li><a href="{{ url('service')}}">Service</a></li>
          <li><a href="{{ url('about-us')}}">About Us</a></li>
          <li><a href="{{ url('contact-us')}}">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4>Service</h4>
        <ul class="list-unstyled">
          <li>Online Story</li>
          <li>E - Invitation Card</li>
          <li>E - Guest Book</li>
          <li>Event Guides</li>
          <li>Live Streaming Event</li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4>Social Media</h4>
        <ul class="list-unstyled">
          <li><a href=""><i class="ti ti-facebook">&nbsp;&nbsp;3Vite</i></a></li>
          <li><a href=""><i class="ti ti-youtube">&nbsp;&nbsp;3Vite</i></a></li>
          <li><a href=""><i class="ti ti-instagram">&nbsp;&nbsp;@3Vite</i></a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-3">
        <h4>Office</h4>
        <p>
          Centennial Tower Lt. 29 Unit D - E<br>
          Gatot Subroto Street Kav 24 - 25<br>
          Karet Semanggi, Setiabudi<br>
          Jakarta Selatan 12930<br>
          info@3vite.co.id
        </p>
      </div>
      <div class="col-md-3 col-sm-3">
        <!-- <h4>Latest Posts</h4>
        <ul class="list-unstyled">
          <li><a href="">Made with Love in Toronto</a></li>
          <li><a href="">Startup News & Emerging Tech</a></li>
          <li><a href="">Bitcoin Will Soon Rule The World</a></li>
          <li><a href="">Wearable Technology On The Rise</a></li>
          <li><a href="">Learn Web Design in 30 Days!</a></li>
        </ul> -->
      </div>
      <div class="col-md-3 col-sm-3">
        <!-- <h4>Our Newsletter</h4>
        <form action="">
          <input placeholder="Enter Your Email" class="form-control form-opacity no-margin newsletter_input" type="email" required/>
          <a href="" class="btn">Subscribe</a>
        </form> -->
      </div>
    </div>
  </div>
</section>

<section class="gla_section gla_image_bck gla_wht_txt gla_section_extra_sml" data-color="#292929">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <p style="color:white">© 2020 Copyright 3Vite. All Rights Reserved.</p>
            </div>
            <div class="col-md-2 col-sm-4">
            </div>
            <div class="col-md-6 col-sm-4 text-center">
                <div class="gla_social_btns">
                    <a href="{{ url('/')}}">Home</a>
                    <a href="{{ url('service')}}">Service</a>
                    <a href="{{ url('about-us')}}">About Us</a>
                    <a href="{{ url('contact-us')}}">Contact Us</a>

                    @if (!(Auth::check()))
                        <a id="Login" href="">Login</a>
                    @else
                        <a href="{{ url('profile') }}">Profile</a>
                        <a href="{{ url('logout') }}">Logout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
