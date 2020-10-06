<div class="container">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
   </div>

   <div class="collapse navbar-collapse navbar-right">
      <ul class="nav navbar-nav">
         <li {{{ (Request::is('/') ? 'class=active' : '')}}}><a href="{{ url('/')}}">Home</a></li>
         <li class="dropdown" {{{ (Request::is('about-me') || Request::is('education') || Request::is('work-experience') ? 'active' : '')}}}>
               <a href="" class="dropdown-toggle" data-toggle="dropdown">About Me <i class="fa fa-angle-down"></i></a>
               <ul class="dropdown-menu">
                  <li {{{ (Request::is('about-me') ? 'class=active' : '')}}}><a href="{{ url('about-me')}}">About Me</a></li>
                  <li {{{ (Request::is('education') ? 'class=active' : '')}}}><a href="{{ url('education')}}">Education</a></li>
                  <li {{{ (Request::is('work-experience') ? 'class=active' : '')}}}><a href="{{ url('work-experience')}}">Work Experience</a></li>
               </ul>
         </li>         
         <li {{{ (Request::is('services') ? 'class=active' : '')}}}><a href="{{ url('services')}}">Services</a></li>
         <li {{{ (Request::is('portfolios') ? 'class=active' : '')}}}><a href="{{ url('portfolios')}}">Portfolios</a></li>
         <li {{{ (Request::is('awards') ? 'class=active' : '')}}}><a href="{{ url('awards')}}">Awards</a></li>
         <li {{{ (Request::is('contact-me') ? 'class=active' : '')}}}><a href="{{ url('contact-me')}}">Contact Me</a></li>                        
      </ul>
   </div>
</div><!--/.container-->
