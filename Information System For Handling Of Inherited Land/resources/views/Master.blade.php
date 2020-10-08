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
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('css/theme-default.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/alertifyjs/alertify.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('js/plugins/datatables/jquery.dataTables.min.css') !!}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-table.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}" />

        <!-- EOF CSS INCLUDE -->
    </head>
    <body>
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

      <script type="text/javascript" src="{!! asset('js/jquery-1.9.1.min.js') !!}"></script>
      <!-- <script type="text/javascript" src="{!! asset('js/bootstrap-select.js') !!}></script> -->
      <!-- use jssor.slider.mini.js (40KB) instead for release -->
      <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
      <script type="text/javascript" src="{!! asset('js/jssor.js') !!}"></script>
      <script type="text/javascript" src="{!! asset('js/jssor.slider.js') !!}"></script>
    <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="">Sistem Informasi Kepengurusan Pajak Surabaya</a>
                        <a href="" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="" class="profile-mini">
                            <img height="120px" width="250px" src="@yield('Foto')" alt="Foto User"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                 <img height="120px" width="250px"  src="@yield('Foto')" alt="Foto User"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">@yield('ID')</div>
                                <div class="profile-data-title">@yield('Nama')</div>
                            </div>
                        </div>
                    </li>
                    @yield('Navigasi')
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content" style="background:white;">
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap" >
                    <div class="row scRow">
                            <br>
                            @yield('Isi')
                    </div>
                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->

        </div>
    <!-- END PAGE CONTAINER -->

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
                            <a href="{{ url('Logout') }}" class="btn btn-success btn-lg">Ya</a>
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

        <script type="text/javascript" src="{!! asset('css/alertifyjs/alertify.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/morris/raphael-min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/morris/morris.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/rickshaw/d3.v3.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/owl/owl.carousel.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/moment.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/daterangepicker/daterangepicker.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/actions.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-select.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap-datepicker.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/button/js/dataTables.buttons.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/datatables/dataTables.buttons.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/bootstrap-table.js') !!}"></script>
        @yield('Script')

        <!-- <script type="text/javascript" src="{!! asset('css/select2/select2.css') !!}"></script>
        <script type="text/javascript" src="{!! asset('css/select2/select2.min.css') !!}"></script> -->
        <!-- END TEMPLATE -->

    <!-- END SCRIPTS -->
    </body>
</html>
