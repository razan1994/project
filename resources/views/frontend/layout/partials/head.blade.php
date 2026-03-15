<!--=== Meta Tags ===-->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- seo --}}

<title>@yield('title', 'Jeel')</title>

<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="@yield('robot')">
<meta name="title" content="@yield('meta_title')">
<meta name="description" content="@yield('meta_desc')">
<meta name="keywords" content="@yield('meta_keywords')">
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image:width" content="200" />
<meta property="og:image:height" content="200" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@sawaed" />
<meta name="twitter:creator" content="@sawaed" />
<meta name="twitter:title" content="@yield('meta_title')">
<meta name="twitter:description" content="@yield('meta_desc')" />
<meta name="author" content="sawaed">
<meta property="og:title" content="@yield('meta_title')">
<meta property="og:description" content="@yield('meta_desc')">
<meta propert="og:keywords" content="@yield('meta_keywords')">

{{-- end seo --}}
<meta http-equiv="Content-Security-Policy" content="frame-src 'self' https://www.google.com https://maps.google.com;">



@yield('canonical')

<!-- Favicon -->
<link rel="shortcut icon" type="image/webp" href="{{ asset('assets/images/favicon.webp') }}">
