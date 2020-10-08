<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/bootstrap/bootstrap.min.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-table.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}"/>

    @yield('css')
</head>
<body>
<div style="width:100%;border-bottom:4px solid black;height:2.8cm;display:block">

        <img src="{{ url('foto/Logo/logo.png') }}"
             style="display:inline-block;position:relative;top:0px;left:0px;width:140px;height:100px;float:left">

    <div style="text-align:center;width:90%">
        <span style="font-weight:bold;font-size:18">BADAN PERTANAHAN NASIONAL</span>
        <br>
        <span style="font-weight:bold;font-size:11">KANTOR PERTANAHAN KABUPATEN SIDOARJO</span>
        <BR>
        Jl. Jaksa Agung Raya Suprapto No. 7 Sidoarjo
        <br>
        Telp. 0341-570048
    </div>
</div>
@yield('lampiran')
@yield('content')
</body>
</html>