<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
		<meta name="csrf-token" content="{{csrf_token()}}" />
    <title>@yield('Judul')</title>
		<link rel="stylesheet" type="text/css" href="{!! asset('css/animate.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/font-awesome.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/jquery.dataTables.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/main.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/prettyPhoto.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/price-range.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/responsive.css') !!}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/alertifyjs/alertify.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard_theme_arrows.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard_theme_arrows.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard_theme_circles.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard_theme_circles.min.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard_theme_dots.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/smartwizard/smart_wizard_theme_dots.min.css') }}"/>
		<script type="text/javascript" src="{!! asset('js/jquery-2.2.4.min.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('js/jquery-2.0.0.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('js/jquery.steps.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('js/jquery.steps.min.js') !!}"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<!-- <div class="row">
					<div class="col-sm-8">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#" style="font-size:11px;"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;@yield('Address')</a></li>
								<li><a href="#" style="font-size:11px;"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;@yield('Phone')</a></li>
								<li><a href="#" style="font-size:11px;"><i class="fa fa-mobile-phone"></i>&nbsp;&nbsp;&nbsp;@yield('Handphone')</a></li>
								<li><a href="#" style="font-size:11px;"><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;@yield('Email')</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a target="_blank" href="{{url($DataSocialMedia[3]['Link'])}}"><i class="fa fa-facebook"></i></a></li>
								<li><a target="_blank" href="{{url($DataSocialMedia[4]['Link'])}}"><i class="fa fa-google-plus"></i></a></li>
								<li><a target="_blank" href="{{url($DataSocialMedia[0]['Link'])}}"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div> -->
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="shop-menu">
							<ul class="nav navbar-nav">
								<li><a href=""><h5>@if(Auth::check())Welcome, {{$Nama}}@endif</h5></a></li>
								@if(Auth::check())
									@if($Role == 0)
									<li><a href="{{ url('/UpdateCustomer')}}"><i class="fa fa-user"></i> Profile</a></li>
									@else
									<li><a href="{{ url('/UpdateEmployee')}}"><i class="fa fa-user"></i> Profile</a></li>
									@endif
									<li><a href="{{ url('/Logout')}}"><i class="fa fa-lock"></i> Logout</a></li>
								@else
									<li><a href="{{ url('/RegisterCustomer')}}"><i class="fa fa-star"></i> Register</a></li>
									<li><a href="{{ url('/Login')}}"><i class="fa fa-lock"></i> Login</a></li>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="" style="text-align:center">
							<a href="{{ url('/')}}"><img src="{{url('foto/logo/Logo.jpg')}}" width="150px" height="55px" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@if(Auth::check())
									@if($Role == 0)
									<li><a href="{{ url('/ShoppingCart')}}"><i class="fa fa-shopping-cart"></i> Cart (
									@if(Session::has('JumlahBarang'))
									{{ Session::get('JumlahBarang') }}
									@else
									0
									@endif
									)</a></li>
									@else
									<li><a href="{{ url('/UpdateEmployee')}}"><i class="fa fa-user"></i> Profile</a></li>
									@endif
								@else
									<li><a href="{{ url('/Logins')}}"><i class="fa fa-shopping-cart"></i> Cart ( 0 )</a></li>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="search_box pull-right">
						<form class="" name="FormSearch" id="FormSearch" action="{{ url('/SearchProduct')}}" method="POST">
								<input type="text" id="ScriptBox" name="ScriptBox" placeholder="Search" onkeypress="return RunScript(event)"/>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu">
								@yield('Navigasi')
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	@yield('Isi')

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="companyinfo">
							<h2>@yield('CompanyName')</h2>
							<p>@yield('Address'), @yield('City'), @yield('Country') <br/> @yield('Phone'), @yield('Handphone') <br/> @yield('Email')</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="single-widget">
							<h2>Follow us on</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a target="_blank" href="{{url($DataSocialMedia[0]['Link'])}}"><img src="{{url('foto/socialmedia/instagram.png')}}" style="width:15px; height:15px;" alt="" /><i class=""></i>{{$DataSocialMedia[0]['SocialMediaName']}} : {{$DataSocialMedia[0]['Description']}}</a></li>
								<li><a target="_blank" href="{{url($DataSocialMedia[1]['Link'])}}"><img src="{{url('foto/socialmedia/line.png')}}" style="width:15px; height:15px;" alt="" /><i class=""></i>{{$DataSocialMedia[1]['SocialMediaName']}} : {{$DataSocialMedia[1]['Description']}}</a></li>
								<li><a target="_blank" href="{{url($DataSocialMedia[3]['Link'])}}"><img src="{{url('foto/socialmedia/facebook.png')}}" style="width:15px; height:15px;" alt="" /><i class=""></i>{{$DataSocialMedia[3]['SocialMediaName']}} : {{$DataSocialMedia[3]['Description']}}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2></h2>
							<ul class="nav nav-pills nav-stacked">
								<li></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Working Hour</h2>
							<ul class="nav nav-pills nav-stacked">
								<li>Monday - Friday : <br>10 - 5 pm</li><br>
								<li>Saturday : <br>10 - 2 pm</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Policies</h2>
							<form action="#" class="searchform">
								<p style='text-align:justify'>Your package will be shipped on that day if you have paid and confirm the payment before 5 pm (Monday - Friday) or before 2 pm (Saturday)</p>
								<p style='text-align:justify'>We will update the Tracking Number within 1 x 24 hour after the package has been shipped.</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2017 @yield('CompanyNameII') Inc. All Rights Reserved.</p>
					<p class="pull-right">Designed by <span><a href="">Daivalentineno J S, S. Kom.</a></a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->

	@yield('Script')

	<script type="text/javascript">
	function RunScript(e) {
    if (e.keyCode == 13) {
        $('#FormSearch').submit();
    }
	}
	</script>
	<!-- START SCRIPTS -->
        <!-- START TEMPLATE-->
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery-ui.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/tableexport/tableExport.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/tableexport/jquery.base64.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/tableexport/html2canvas.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/tableexport/jspdf/libs/sprintf.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/tableexport/jspdf/jspdf.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/tableexport/jspdf/libs/base64.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/icheck/icheck.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/scrolltotop/scrolltopcontrol.js') !!}"></script>

        <script type='text/javascript' src="{!! asset('js/plugins/noty/jquery.noty.js') !!}"></script>
        <script type='text/javascript' src="{!! asset('js/plugins/noty/layouts/topCenter.js') !!}"></script>
        <script type='text/javascript' src="{!! asset('js/plugins/noty/layouts/topLeft.js') !!}"></script>
        <script type='text/javascript' src="{!! asset('js/plugins/noty/layouts/topRight.js') !!}"></script>
        <script type='text/javascript' src="{!! asset('js/plugins/noty/themes/default.js') !!}"></script>

        <script type='text/javascript' src="{!! asset('js/plugins/smartwizard/jquery.smartWizard-2.0.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jquery-validation/jquery.validate.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/fileinput/fileinput.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/morris/raphael-min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/morris/morris.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/rickshaw/d3.v3.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/owl/owl.carousel.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/moment.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/daterangepicker/daterangepicker.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-select.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/button/js/dataTables.buttons.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/datatables/dataTables.buttons.min.js') !!}"></script>
				<script type="text/javascript" src="{!! asset('css/alertifyjs/alertify.js') !!}"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
</body>
</html>
