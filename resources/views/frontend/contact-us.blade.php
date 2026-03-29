@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_contact') }}
@endsection
@section('meta_title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_contact') }}
@endsection
@section('meta_desc')
    {{ isset($seoData->metaDesc) ? $seoData->metaDesc : __('frontend.navbar_contact') }}
@endsection
@section('meta_keywords')
    {{ isset($seoData->keywords) ? $seoData->keywords : __('frontend.navbar_contact') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.contact_us') }}" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.contact_us') }}"
        hreflang="en-jo" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.contact_us') }}"
        hreflang="ar-jo" />
@endsection

@section('h1_val')
    {{ isset($seoData->h1) ? $seoData->h1 : __('frontend.navbar_contact') }}
@endsection
@section('h2_val')
    {{ isset($seoData->h2) ? $seoData->h2 : __('frontend.navbar_contact') }}
@endsection

@section('content')
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ __('frontend.navbar_contact') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.navbar_home') }}</a> - {{ __('frontend.navbar_contact') }}</p>
            </div>
        </div>
    </div>

    @include('frontend.layout.partials.contact-section')

        <!-- Map Section -->
    <div class="contact-map mb-4" style="width:100%;height:350px;">
        <iframe width="100%" height="350" frameborder="0" style="border:0"
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q=26.41342292206899,50.096749528835524&hl=ar;z=16&output=embed"
            allowfullscreen>
        </iframe>
    </div>
@endsection
