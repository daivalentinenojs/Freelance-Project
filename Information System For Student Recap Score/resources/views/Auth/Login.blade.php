@extends('Masters')

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
                    <img width="150px" height="150px" src="{{asset('img/logoUbaya.png')}}"/>
                </div>
                <br><br>
                <div style="text-align:center;">
                     <div class="login-title" style="font-size:20px; color:white;" ><strong>Sistem Informasi Rekap Nilai</strong></div>
                </div>
                <br>
                <div class="login-body">
                    <div class="login-title">Selamat datang, Silahkan <i>log in</i> ...</div>
                    <!-- Awal Form Login -->
                    <form action="{{url('auth/login')}}" class="form-horizontal" method="POST">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <div class="col-md-5" id="ClassCheckErrorEmail">
                            <input type="text" required name="email" data-toggle="tooltip" data-placement="top" title="Inputkan email Anda" class="form-control" value="{{ old('email') }}" placeholder="Nama Pengguna"/>
                        </div>
                        <div class="col-md-7">
                            <select name="domain" class="form-control select" data-toggle="tooltip" data-placement="top" title="Pilih domain Anda">
                                <option value="@staff.ubaya.ac.id" style="color:black;">@staff.ubaya.ac.id</option>
                                <option value="@student.ubaya.ac.id" style="color:black;">@student.ubaya.ac.id</option>
                            </select>
                        </div>
                    </div>
                    <div id="ClassCheckErrorPassword" class="form-group">
                        <div class="col-md-12">
                            <input type="password" required name="password" class="form-control" placeholder="Kata Sandi" data-toggle="tooltip" data-placement="top" title="Inputkan password Anda"/>
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
                        &copy; 2016 Sistem Informasi Rekap Nilai Universitas Surabaya
                    </div>
                </div>

                <div class="login-footer">
                    <div style="text-align:center;">
                        <strong style="font-size:14px;">Keterangan :</strong><br>
                        Mahasiswa : Nama Pengguna (sNRP), Gunakan @student.ubaya.ac.id, dan Kata Sandi WiFi <br>
                        Karyawan : Nama Pengguna, Gunakan @staff.ubaya.ac.id, dan Kata Sandi Ubaya Anda
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
