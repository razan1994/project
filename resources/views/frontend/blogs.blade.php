@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_blogs') }}
@endsection
@section('meta_title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_blogs') }}
@endsection
@section('meta_desc')
    {{ isset($seoData->metaDesc) ? $seoData->metaDesc : __('frontend.navbar_blogs') }}
@endsection
@section('meta_keywords')
    {{ isset($seoData->keywords) ? $seoData->keywords : __('frontend.navbar_blogs') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.blogs') }}" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.blogs') }}"
        hreflang="en-jo" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' . __('routes.blogs') }}"
        hreflang="ar-jo" />
@endsection


@section('h1_val')
    {{ isset($seoData->h1) ? $seoData->h1 : __('frontend.navbar_blogs') }}
@endsection
@section('h2_val')
    {{ isset($seoData->h2) ? $seoData->h2 : __('frontend.navbar_blogs') }}
@endsection

@section('content')
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ __('frontend.blogs_title') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.blogs_breadcrumb_home') }}</a> - {{ __('frontend.blogs_breadcrumb_blogs') }}</p>
            </div>
        </div>
    </div>

    <!-- Blogs Listing -->
    <div class="dextheme-section-11 dextheme-section-padding bg-light">
        <div class="dextheme-container">
            <div class="block-heading text-center mb-4">
                <p class="dextheme-sub-title mb-4">{{ __('frontend.blogs_latest_news') }}</p>
                <h2 class="dextheme-main-title dextheme-w-60 mx-auto mb-4">{{ __('frontend.blogs_main_heading') }}</h2>
            </div>

            <div class="dextheme-row g-4 mt-4">
                @forelse ($blogs as $blog)
                    <div class="dextheme-blog-card dextheme-col-lg-4 dextheme-col-12">
                        <div class="dextheme-card border-0 border-bottom border-4 shadow-lg bg-white h-100"
                            style="border-image: linear-gradient(90deg, #b07f47 0%, #8b6033 100%) 1 !important; border-color: transparent;">
                            <div class="img-wrapper">
                                <img src="{{ $blog->image ? asset($blog->image) : asset('assets/images/400x350.png') }}"
                                    alt="{{ $blog->title }}"
                                    style="width: 100%; height: 250px; object-fit: cover; aspect-ratio: 16/10;">
                            </div>
                            <div class="dextheme-card__body">
                                <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                                    <div class="meta-date">
                                        <i aria-hidden="true" class="icon icon-calendar3"></i>
                                        <span>{{ $blog->created_at?->locale(app()->getLocale())->translatedFormat('F d, Y') }}</span>
                                    </div>
                                </div>
                                <h5 class="dextheme-card__title">{{ $blog->title }}</h5>
                                <p class="dextheme-card__text">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 180) }}
                                </p>
                                <a href="{{ route('blogs.details', $blog->slug) }}"
                                    class="dextheme-btn btn-primary hover-bg-white">
                                    {{ __('frontend.blogs_view_more') }}
                                    <i aria-hidden="true" class="icon icon-right-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="dextheme-col-12 text-center py-5">
                        <p class="plain-text">{{ __('frontend.blogs_no_posts') }}</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($blogs->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>

    @include('frontend.layout.partials.contact-section')
@endsection
