@extends('Masters')

@section('Title','Log In')

@section('Title','Sistem Informasi')

@section('Isi')
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Log In</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>
        <div class="login-container">
            <div class="login-box animated fadeInDown" >
                <div style="text-align:center;">
                    <img src="{{asset('img/laporanKeuangan.png')}}" alt="LaporanKeuangan" style="width:200px; height:200px; margin:auto;"/>
                </div>
                
                <div style="text-align:center;">
                     <div class="login-title" style="font-size:20px; color:white;" ><strong>HARMONIS MOTOR</strong></div>
                </div>
                <br>
                <div class="login-body">
                    <div class="login-title">Selamat datang, Silahkan <i>log in</i> ...</div>
                    <!-- Awal Form Login -->
                    <form action="{{url('Auth/Login')}}" class="form-horizontal" method="POST">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach

                    {!! csrf_field() !!}

                    <div class="form-group">
                           <div class="col-md-12" id="ClassCheckErrorEmail">
                                <input type="text" name="Nama" value="" class="form-control" placeholder="Nama Pengguna" />
                           </div>
                       </div>
                       <div class="form-group">
                            <div  class="col-md-12" id="ClassCheckErrorPassword">
                                <input type="password" name="Password" value="" class="form-control" placeholder="Kata Sandi">
                            </div>
                       </div>
                    <div class="form-group">
                        <div class="col-md-12" style="text-align:center;">
                            <input type="submit" value="Masuk" data-toggle="tooltip" data-placement="bottom" title data-original-title="Klik untuk Akses Sistem" class="btn btn-primary">
                        </div>
                    </div>
                    </form>
                    <!-- Akhir Form Login -->
                </div>
                <div class="login-footer">
                    <div style="text-align:center;">
                        &copy; Juni 2017 Harmonis Motor
                    </div>
                </div>

                <div class="login-footer">
                    <div style="text-align:center;">
                        <strong style="font-size:14px;">Keterangan :</strong><br>
                        Karyawan perlu Login terlebih dahulu<br>
                        untuk dapat mengakses Sistem Informasi Harmonis Motor
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
