<div class="container d-flex align-items-center justify-content-lg-between">

   <h1 class="logo me-auto me-lg-0"><a href="{{ url('/')}}"><img src="{{asset('assets/images/logo/logo.svg')}}" alt="logo"></a></h1>
   <!-- Uncomment below if you prefer to use an image logo -->
   <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

   <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
         <li><a class="nav-link scrollto {{{ (Request::is('/') ? 'class=active' : '')}}}" href="{{ url('/')}}">Home</a></li>
         <li><a class="nav-link scrollto {{{ (Request::is('about') ? 'class=active' : '')}}}" href="{{ url('about')}}">About</a></li>
         <li><a class="nav-link scrollto {{{ (Request::is('services') ? 'class=active' : '')}}}" href="{{ url('services')}}">Services</a></li>
         <li><a class="nav-link scrollto {{{ (Request::is('portfolio') ? 'class=active' : '')}}}" href="{{ url('portfolio')}}">Portfolio</a></li>
         <li><a class="nav-link scrollto {{{ (Request::is('team') ? 'class=active' : '')}}}" href="{{ url('team')}}">Team</a></li>
         <li><a class="nav-link scrollto {{{ (Request::is('contact') ? 'class=active' : '')}}}" href="{{ url('contact')}}">Contact</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
   </nav><!-- .navbar -->

   <a href="{{ url('about')}}" class="get-started-btn scrollto">Get Started</a>

</div>
