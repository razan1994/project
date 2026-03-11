@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($service->seoTitle) ? $service->seoTitle : __('frontend.navbar_services') }}
@endsection
@section('meta_title')
    {{ isset($service->seoTitle) ? $service->seoTitle : __('frontend.navbar_services') }}
@endsection
@section('meta_desc')
    {{ isset($service->metaDesc) ? $service->metaDesc : __('frontend.navbar_services') }}
@endsection
@section('meta_keywords')
    {{ isset($service->keywords) ? $service->keywords : __('frontend.navbar_services') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical"
        href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.services') . '/' . $service->slug }}" />
    <link rel="alternate"
        href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.services') . '/' . $service->slug }}"
        hreflang="en-jo" />
    <link rel="alternate"
        href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.services') . '/' . $service->slug }}"
        hreflang="ar-jo" />
@endsection


{{-- @section('h1_val')
    {{ isset($service->h1) ? $service->h1 : __('frontend.navbar_services') }}
@endsection
@section('h2_val')
    {{ isset($service->h2) ? $service->h2 : __('frontend.navbar_services') }}
@endsection
@section('altText')
    {{ isset($service->altText) ? $service->altText : __('frontend.navbar_services') }}
@endsection
@section('imageText')
    {{ isset($service->imageText) ? $service->imageText : __('frontend.navbar_services') }}
@endsection --}}


@section('content')
    <livewire:frontend.service-details-section :service="$service" />
@endsection
