<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    @include('include.meta')
    @stack('css')
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    @include('include.navigation')
</header><!-- End Header -->

@yield('content')

@include('include.footer')

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@include('include.script')
@yield('script')

</body>

</html>