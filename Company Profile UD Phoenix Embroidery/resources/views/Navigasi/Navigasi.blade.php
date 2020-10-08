<ul class="nav navbar-nav collapse navbar-collapse">
   <li><a href="{{ url('/')}}" {{{ (Request::is('/') ? 'class=active' : '')}}}>Home</a></li>
   <li class="dropdown"><a href="#" {{{ (Request::is('Fashion') || Request::is('HomeDecoration') || Request::is('Embroidery')? 'class=active' : '')}}}>Product<i class="fa fa-angle-down"></i></a>
         <ul role="menu" class="sub-menu">
               <li><a href="{{ url('/Fashion')}}" {{{ (Request::is('Fashion') ? 'class=active' : '')}}}>Fashion</a></li>
               <li><a href="{{ url('/HomeDecoration')}}" {{{ (Request::is('HomeDecoration') ? 'class=active' : '')}}}>Home Decoration</a></li>
               <li><a href="{{ url('/Embroidery')}}" {{{ (Request::is('Embroidery') ? 'class=active' : '')}}}>3D Embroidery</a></li>
               <li><a href="{{ url('/Souvenir')}}" {{{ (Request::is('Souvenir') ? 'class=active' : '')}}}>Souvenir</a></li>
         </ul>
   </li>
   @if (session()->has('NIP'))
      <li class="dropdown"><a href="#" {{{ (Request::is('Product') || Request::is('Slider') || Request::is('Category') || Request::is('CompanyDescription') || Request::is('Employee') ? 'class=active' : '')}}}>Master Data<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                  <li><a href="{{ url('/Product')}}" {{{ (Request::is('Product') ? 'class=active' : '')}}}>Product</a></li>
                  <li><a href="{{ url('/Category')}}" {{{ (Request::is('Category') ? 'class=active' : '')}}}>Category</a></li>
                  <li><a href="{{ url('/Employee')}}" {{{ (Request::is('Employee') ? 'class=active' : '')}}}>Employee</a></li>
                  <li><a href="{{ url('/Slider')}}" {{{ (Request::is('Slider') ? 'class=active' : '')}}}>Slider</a></li>
                  <li><a href="{{ url('/CompanyDescription')}}" {{{ (Request::is('CompanyDescription') ? 'class=active' : '')}}}>Company Description</a></li>
            </ul>
       </li>
   @endif
   <li><a href="{{ url('/AboutUs')}}" {{{ (Request::is('AboutUs') ? 'class=active' : '')}}}>About Us</a></li>
   @if (!(session()->has('NIP')))
      <li><a href="{{ url('/Login')}}" {{{ (Request::is('Login') ? 'class=active' : '')}}}>Login</a></li>
   @else
      <li><a href="{{ url('/Logout')}}" {{{ (Request::is('Logout') ? 'class=active' : '')}}}>Logout</a></li>
   @endif
</ul>

@section('Address', $Content[0]['Address'])
@section('Phone',$Content[0]['Phone'])

@section('CompanyName')
   <?php
      $Nama = $Content[0]['CompanyName'];
      $ArrayNama = explode(" ",$Nama);

      echo '<span><strong style="font-size:40px;">'.$ArrayNama[0][0].'</strong>'.substr($ArrayNama[0],1).' <strong style="font-size:40px;">'.$ArrayNama[1][0].'</strong>'.substr($ArrayNama[1],1).'</span> <strong style="font-size:40px;">'.$ArrayNama[2][0].'</strong>'.substr($ArrayNama[2],1);
   ?>
@endsection

@section('AddressII',$Content[0]['Address'])
@section('City',$Content[0]['City'])
@section('PhoneII',$Content[0]['Phone'])
@section('Email',$Content[0]['Email'])
@section('CompanyNameII',$Content[0]['CompanyName'])
