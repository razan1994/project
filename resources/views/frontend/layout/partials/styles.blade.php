<!-- Google Font -->
<link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900%7CPlayfair+Display:400,400i,700,700i%7CRoboto:400,400i,500,700"
    rel="stylesheet">


<!-- Include Files -->
@if (Config::get('app.locale') == 'en')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" /> --}}
    @vite(['resources/css/front.css'])
    @else
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" /> --}}
    @vite(['resources/css/front-rtl.css'])
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
@endif
<!-- End Include Files -->


<!-- Stylesheets -->

<link rel="stylesheet" href="{{ asset('assets/css/ekiticons3b71.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/gradient-navbar-border.css') }}" />
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/countUp.min.js') }}"></script>

<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Vite CSS -->
@vite(['resources/css/app.css'])
