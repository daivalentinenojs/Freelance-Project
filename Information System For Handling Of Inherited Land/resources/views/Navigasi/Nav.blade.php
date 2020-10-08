<li class="xn-title">Navigasi</li>
<li {{{ (Request::is('/') ? 'class=active' : '')}}}><a href="{{ url('/')}}"><span class="fa fa-dashboard"></span><span class="xn-text">Beranda</span></a></li>
<li {{{ (Request::is('TentangKami') ? 'class=active' : '')}}}><a href="{{ url('/TentangKami')}}"><span class="fa fa-building"></span><span class="xn-text">Tentang Kami</span></a></li>
<li {{{ (Request::is('Login') || Request::is('Daftar') ? 'class=active' : '')}}}><a href="{{ url('/Login')}}"><span class="glyphicon glyphicon-log-in"></span><span class="xn-text">Login</span></a></li>
