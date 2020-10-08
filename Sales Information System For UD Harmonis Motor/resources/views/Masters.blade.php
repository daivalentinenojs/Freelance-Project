<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>@yield('judul')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('css/theme-forest.css') }}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('css/jquery.dataTables.min.css') }}"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

    <!-- Tambahan Slider -->
    <!-- Caption Style -->
    <style>
        .captionOrange, .captionBlack
        {
            color: #fff;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
        }
        .captionOrange
        {
            background: #EB5100;
            background-color: rgba(235, 81, 0, 0.6);
        }
        .captionBlack
        {
            font-size:16px;
            background: #000;
            background-color: rgba(0, 0, 0, 0.4);
        }
        a.captionOrange, A.captionOrange:active, A.captionOrange:visited
        {
            color: #ffffff;
            text-decoration: none;
        }
        a.captionOrange:hover
        {
            color: #eb5100;
            text-decoration: underline;
            background-color: #eeeeee;
            background-color: rgba(238, 238, 238, 0.7);
        }
        .bricon
        {
            background: url(img/browser-icons.png);
        }
    </style>
    <!-- it works the same with all jquery version from 1.x to 2.x -->

    <script type="text/javascript" src="{!! asset('js/jquery-1.9.1.min.js') !!}"></script>
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="{!! asset('js/jssor.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/jssor.slider.js') !!}"></script>

    <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> <strong>Keluar</strong> ?</div>
                    <div class="mb-content">
                        <p>Apakah anda yakin ingin keluar ?</p>
                        <p>Tekan Tidak jika ingin melanjutkan aktivitas. Tekan Ya untuk keluar.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ url('Auth/Logout') }}" class="btn btn-success btn-lg">Ya</a>
                            <button class="btn btn-default btn-lg mb-control-close">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END MESSAGE BOX-->

    <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
    <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery-ui.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap.min.js') !!}"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type="text/javascript" src="{!! asset('js/plugins/icheck/icheck.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/scrolltotop/scrolltopcontrol.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/morris/raphael-min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/morris/morris.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/rickshaw/d3.v3.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/rickshaw/rickshaw.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/owl/owl.carousel.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/moment.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/daterangepicker/daterangepicker.js') !!}"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{!! asset('js/plugins.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/actions.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/demo_dashboard.js') !!}"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
