<!DOCTYPE html>
<html lang="en">
<head>    
    <title>@yield('title')</title>	
    @include('include.meta')
	@stack('css')
</head><!--/head-->

<body class="homepage">
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +886 968 750 604 (TW) | +628 851 3232 0849 (ID)</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="https://www.facebook.com/Daiva24" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/daivalentineno24/?hl=id" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/daivalentineno-janitra-salim-7b1317165/" target="_blank"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="https://github.com/daivalentinenojs" target="_blank"><i class="fa fa-github"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            @include('include.navigation')
        </nav><!--/nav-->       

    </header><!--/header-->

    @yield('content')

    @include('include.footer')

    @include('include.script')
    @yield('script')

</body>
</html>
