<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/bootstrap/bootstrap.min.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-table.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}" />

    <!-- EOF CSS INCLUDE -->
    @yield('css')
</head>
<body>
@yield('content')
</body>
</html>