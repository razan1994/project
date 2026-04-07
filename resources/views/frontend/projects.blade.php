@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_projects') }}
@endsection
@section('meta_title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_projects') }}
@endsection
@section('meta_desc')
    {{ isset($seoData->metaDesc) ? $seoData->metaDesc : __('frontend.navbar_projects') }}
@endsection
@section('meta_keywords')
    {{ isset($seoData->keywords) ? $seoData->keywords : __('frontend.navbar_projects') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.projects') }}" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.projects') }}"
        hreflang="en-jo" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.projects') }}"
        hreflang="ar-jo" />
@endsection


@section('h1_val')
    {{ isset($seoData->h1) ? $seoData->h1 : __('frontend.navbar_projects') }}
@endsection
@section('h2_val')
    {{ isset($seoData->h2) ? $seoData->h2 : __('frontend.navbar_projects') }}
@endsection

@section('content')
    <livewire:frontend.projects-page-section />

    @include('frontend.layout.partials.contact-section')
@endsection
