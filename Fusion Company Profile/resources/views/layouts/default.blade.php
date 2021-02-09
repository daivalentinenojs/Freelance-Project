<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('includes.css')
    @stack('css')
</head>

<!-- Body -->
<body class="gla_middle_titles">

<!-- Page -->
<div class="gla_page" id="gla_page">

    <!-- To Top -->
    <a href="#gla_page" class="gla_top ti ti-angle-up gla_go"></a>

    <!-- Music -->
@yield('music')
<!-- Music End -->

    <!-- Header -->
    <header>
        <nav class="gla_light_nav gla_transp_nav">
            <!-- Container -->
        @include('includes.navigation')
        <!-- Container end -->
        </nav>
    </header>
    <!-- Header End -->

    <!-- Slider -->
@yield('slider')
<!-- Slider End -->

    <!-- Section -->
    <section id="gla_content" class="gla_content">

        <!-- Content -->
    @yield('content')
    <!-- Content End -->

        <!-- Footer -->
    @include('includes.footer-complete')
    <!-- Footer End -->

    </section>
    <!-- Section End -->

</div>
<!-- Page End -->

@include('includes.script')
@stack('script')

</body>
</html>
