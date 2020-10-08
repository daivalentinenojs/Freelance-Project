<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
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
		<script type="text/javascript" src="{!! asset('js/jquery-1.9.1.min.js') !!}"></script>
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
				<div class="row">
					<div class="col-sm-8">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#" style="font-size:11px;"><i class="fa fa-home"></i>&nbsp;@yield('Address')</a></li>
								<li><a href="#" style="font-size:11px;"><i class="fa fa-phone"></i>&nbsp;@yield('Phone')</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href=""><i class="fa fa-facebook"></i></a></li> -->
								<li><a target="_blank" href="{{url('http://instagram.com/phoenixembroiderysurabaya')}}"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

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
						<div class="col-sm-6">
							<!-- <h1><span>PHOENIX</span>-EMBROIDERY</h1> -->
							<img src="{{url('foto/logo/logo.jpg')}}" width="200px" height="200px" alt="" />
							</div>
						<div class="mainmenu pull-right">
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
							<p>@yield('Address'), @yield('City') <br/> @yield('Phone') <br/> @yield('Email')</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2017 @yield('CompanyNameII') Inc. All Rights Reserved.</p>
					<p class="pull-right">Designed by <span><a href="">James Leicester</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->

	@yield('Script')
		<!-- <script type="text/javascript"  src="{!! asset('js/shop/jquery.js') !!} "></script> -->
		<!-- <script type="text/javascript"  src="{!! asset('js/shop/price-range.js') !!} "></script> -->
		<!-- <script type="text/javascript"  src="{!! asset('js/shop/jquery.scrollUp.min.js') !!} "></script> -->
		<!-- <script type="text/javascript"  src="{!! asset('js/shop/bootstrap.min.js') !!} "></script> -->
		<!-- <script type="text/javascript"  src="{!! asset('js/shop/jquery.prettyPhoto.js') !!} "></script> -->
		<!-- <script type="text/javascript"  src="{!! asset('js/shop/main.js') !!} "></script> -->

		<!-- <script type="text/javascript" src="{!! asset('js/jquery-1.9.1.min.js') !!}"></script> -->
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <!-- <script type="text/javascript" src="{!! asset('js/jssor.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jssor.slider.js') !!}"></script> -->

		<!-- START SCRIPTS -->
	        <!-- START PLUGINS -->
	        <!-- <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery.min.js') !!}"></script> -->
	        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery-ui.min.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap.min.js') !!}"></script>
	        <!-- <script type="text/javascript" src="{!! asset('js/jquery-2.2.4.min.js') !!}"></script> -->
	        <!-- END PLUGINS -->

	        <!-- START THIS PAGE PLUGINS-->
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

	        <!-- <script type="text/javascript" src="{!! asset('css/alertifyjs/alertify.js') !!}"></script> -->

	        <script type="text/javascript" src="{!! asset('js/plugins/morris/raphael-min.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/morris/morris.min.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/rickshaw/d3.v3.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/owl/owl.carousel.min.js') !!}"></script>

	        <script type="text/javascript" src="{!! asset('js/plugins/moment.min.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/daterangepicker/daterangepicker.js') !!}"></script>
	        <!-- <script type="text/javascript" src="{!! asset('js/settings.js') !!}"></script> -->
	        <!-- <script type="text/javascript" src="{!! asset('js/plugins.js') !!}"></script> -->
	        <!-- <script type="text/javascript" src="{!! asset('js/actions.js') !!}"></script> -->
	        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-select.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/button/js/dataTables.buttons.js') !!}"></script>
	        <script type="text/javascript" src="{!! asset('js/plugins/datatables/dataTables.buttons.min.js') !!}"></script>

	        <!-- <script type="text/javascript" src="{!! asset('css/select2/select2.css') !!}"></script>
	        <script type="text/javascript" src="{!! asset('css/select2/select2.min.css') !!}"></script> -->
	        <!-- END TEMPLATE -->

	    <!-- END SCRIPTS -->
</body>
</html>
