@extends('layout.default')

@section('title','Contact Me')

@section('content')
<section id="contact-info">
  <div class="center">                
      <h2>How To Reach Me?</h2>
      <p class="lead">The following information is about me.</p>
  </div>
  <div class="gmap-area">
      <div class="container">
          <div class="row">
              <div class="col-sm-5 text-center">
                  <div class="gmap">
                    <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3615.613134830339!2d121.5383668508238!3d25.013258283903493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442aa2176c4c0ad%3A0x90db5e44ee29f455!2sNational%20Taiwan%20University%20of%20Science%20and%20Technology!5e0!3m2!1sid!2stw!4v1584729407697!5m2!1sid!2stw"></iframe>
                  </div>
              </div>

              <div class="col-sm-7 map-content">
                  <ul class="row">
                      <li class="col-sm-6">
                          <address>
                              <h5>Indonesia Office</h5>
                              <p>Bukit Palma Block D6 Number 6 <br>
                              Surabaya, Indonesia</p>
                              <p>+62 851 32320849 <br>
                              daivalentinenojs@gmail.com</p>
                          </address>

                          <address>
                              <h5>Taiwan Office</h5>
                              <p>Number 43, Section 4, Keelung Road, <br>
                              Daan District, Taipei, Taiwan</p>                                
                              <p>+886 968 750 604 <br>
                              daivalentinenojs@gmail.com</p>
                          </address>
                      </li>                      
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>  <!--/gmap_area -->

<section id="contact-page">
  <div class="container">
      <div class="center">        
          <h2>Drop Your Message</h2>
          <p class="lead">Please send a message about your needs by filling in this fields below.</p>
      </div> 
      <div class="row contact-wrap"> 
          <div class="status alert alert-success" style="display: none"></div>
          
          @if(session('status'))
            <div class="alert {{session('status')['alert']}}">
                <span aria-hidden="true" class="alert-icon icon_blocked"></span><strong>{{session('status')['status']}} </strong>{{session('status')['message']}}
            </div>
          @endif
          <form class="contact-form" name="contact-form" method="post">
              @csrf
              <div class="col-sm-5 col-sm-offset-1">
                  <div class="form-group">
                      <label>Name *</label>
                      <input type="text" name="name" class="form-control" required="required">
                  </div>
                  <div class="form-group">
                      <label>Email *</label>
                      <input type="email" name="email" class="form-control" required="required">
                  </div>
                  <div class="form-group">
                      <label>Phone</label>
                      <input type="number" name="phone" class="form-control">
                  </div>
                  <div class="form-group">
                      <label>Company Name</label>
                      <input type="text" name="company_name" class="form-control">
                  </div>                        
              </div>
              <div class="col-sm-5">
                  <div class="form-group">
                      <label>Subject *</label>
                      <input type="text" name="subject" class="form-control" required="required">
                  </div>
                  <div class="form-group">
                      <label>Message *</label>
                      <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                  </div>                        
                  
              </div>
              <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
              </div>
          </form> 
      </div><!--/.row-->
  </div><!--/.container-->
</section><!--/#contact-page-->
@endsection
