

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

{!! SEO::metatags()->generate() !!}
{!! SEO::opengraph()->generate() !!}
{!! SEO::twitter()->generate() !!}

@php
    $seoJsonLd = View::shared('seoJsonLd') ?? '';
@endphp
@if(!empty($seoJsonLd))
    <script type="application/ld+json">{!! $seoJsonLd !!}</script>
@else
    {!! SEO::jsonLdMulti()->generate() !!}
@endif

<meta name="author" content="{{ config('app.name') }}">
<meta http-equiv="Content-Security-Policy" content="frame-src 'self' https://www.google.com https://maps.google.com;">

{{-- Hreflang --}}
@php
    $hreflangEn = View::shared('hreflang_en') ?? LaravelLocalization::getLocalizedURL('en');
    $hreflangAr = View::shared('hreflang_ar') ?? LaravelLocalization::getLocalizedURL('ar');
@endphp
<link rel="alternate" hreflang="en" href="{{ $hreflangEn }}">
<link rel="alternate" hreflang="ar" href="{{ $hreflangAr }}">
<link rel="alternate" hreflang="x-default" href="{{ $hreflangEn }}">

<!-- Favicon -->
<link rel="shortcut icon" type="image/webp" href="{{ asset('assets/images/favicon.webp') }}">
