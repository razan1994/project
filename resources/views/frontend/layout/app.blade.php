<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- ======================= head Start-->
    @include('frontend.layout.partials.head')
    <!-- ======================= head End-->

    <!-- ======================= styles Start-->
    @include('frontend.layout.partials.styles')
    <!-- ======================= styles End-->

    @stack('styles')

</head>

<body data-update-uri="/{{ LaravelLocalization::getCurrentLocale() }}/livewire/update">

    <!-- Fixed Social Media Bar -->
    <div class="fixed-social-bar">
        <a href="https://facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
    </div>
    <!-- Floating WhatsApp Icon -->
    <a href="https://wa.me/" class="floating-whatsapp" target="_blank" title="Contact us on WhatsApp">
        <span class="whatsapp-text">Contact us</span>
        <i class="fab fa-whatsapp"></i>
    </a>

    <h1 class="hidden-h1">@yield('h1_val')</h1>
    <h2 class="hidden-h2">@yield('h2_val')</h2>

    <!-- ======================= header Start-->
    @include('frontend.layout.partials.header')
    <!-- ======================= header End-->

    <!-- ======================= breadcrumb Start-->
    @yield('breadcrumb')
    <!-- ======================= breadcrumb End-->

    <!-- ======================= content Start-->
    @yield('content')
    <!-- ======================= content End-->

    <!-- ======================= footer Start  -->
    @include('frontend.layout.partials.footer')
    <!-- ======================= footer End  -->


    <!-- Back to top -->
    <div> <a href="#" class="back-top btn btn-grad"><i class="ti-angle-up"></i></a> </div>

    <!-- ======================= scripts Start -->
    @include('frontend.layout.partials.scripts')
    <!-- ======================= scripts end-->
    @stack('scripts')



</body>

</html>
