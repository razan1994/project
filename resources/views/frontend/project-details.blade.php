@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($project->seoTitle) ? $project->seoTitle : __('frontend.navbar_projects') }}
@endsection
@section('meta_title')
    {{ isset($project->seoTitle) ? $project->seoTitle : __('frontend.navbar_projects') }}
@endsection
@section('meta_desc')
    {{ isset($project->metaDesc) ? $project->metaDesc : __('frontend.navbar_projects') }}
@endsection
@section('meta_keywords')
    {{ isset($project->keywords) ? $project->keywords : __('frontend.navbar_projects') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical"
        href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.projects') . '/' . $project->slug }}" />
    <link rel="alternate"
        href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.projects') . '/' . $project->slug }}"
        hreflang="en-jo" />
    <link rel="alternate"
        href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.projects') . '/' . $project->slug }}"
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
    <livewire:frontend.project-details-section :project="$project" />
@endsection
