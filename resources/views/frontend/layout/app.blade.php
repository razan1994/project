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
    @if (!empty($contact?->facebook) || !empty($contact?->youtube) || !empty($contact?->instagram) || !empty($contact?->linkedin))
        <div class="fixed-social-bar d-none d-md-flex">
            @if (!empty($contact?->facebook))
                <a href="{{ $contact->facebook }}" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if (!empty($contact?->youtube))
                <a href="{{ $contact->youtube }}" target="_blank" rel="noopener noreferrer" title="YouTube"><i class="fab fa-youtube"></i></a>
            @endif
            @if (!empty($contact?->instagram))
                <a href="{{ $contact->instagram }}" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i></a>
            @endif
            @if (!empty($contact?->linkedin))
                <a href="{{ $contact->linkedin }}" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            @endif
        </div>
    @endif
    <!-- Floating WhatsApp Icon -->
    @if (!empty($contact?->whats_app_phone))
        <a href="https://wa.me/{{ preg_replace('/\D+/', '', (string) $contact->whats_app_phone) }}" class="floating-whatsapp" target="_blank" rel="noopener noreferrer"
            title="Contact us on WhatsApp">
            <span class="whatsapp-text">Contact us</span>
            <i class="fab fa-whatsapp"></i>
        </a>
    @endif

    <h1 style="display: hidden; opacity: 0; position: absolute; top:-1000px">@yield('h1_val')</h1>
    <h2 style="display: hidden; opacity: 0; position: absolute; top:-1000px">@yield('h2_val')</h2>

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
    @include('frontend.layout.partials.fixed-consultation-button')

    @stack('scripts')



</body>

</html>
