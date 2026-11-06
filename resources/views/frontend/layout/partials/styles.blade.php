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

@endif
<!-- End Include Files -->


<!-- Stylesheets -->

 <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
 <link href="assets/css/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Vite CSS -->
@vite(['resources/css/app.css'])
