@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ $blog->seoTitle ?? $blog->title }}
@endsection
@section('meta_title')
    {{ $blog->seoTitle ?? $blog->title }}
@endsection
@section('meta_desc')
    {{ $blog->metaDesc ?? \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 160) }}
@endsection
@section('meta_keywords')
    {{ $blog->keywords ?? '' }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/blogs/' . $blog->slug }}" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/blogs/' . $blog->slug }}" hreflang="en-jo" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/blogs/' . $blog->slug }}" hreflang="ar-jo" />
@endsection

@section('content')
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ $blog->title }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p>
                    <a href="{{ route('home') }}">{{ __('frontend.blog_details_breadcrumb_home') }}</a>
                    - {{ $blog->title }}
                </p>
            </div>
        </div>
    </div>

    <!-- Blog Details Content -->
    <div class="dextheme-section-padding bg-white">
        <div class="dextheme-container">
            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-8 dextheme-col-12">
                    @if ($blog->image)
                        <div class="mb-4">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                style="width:100%; max-height:460px; object-fit:cover; border-radius:8px;">
                        </div>
                    @endif

                    <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                        <div class="meta-date">
                            <i aria-hidden="true" class="icon icon-calendar3"></i>
                            <span>{{ $blog->created_at?->format('F d, Y') }}</span>
                        </div>
                    </div>

                    <h1 class="dextheme-main-title mb-4">{{ $blog->title }}</h1>

                    <div class="plain-text blog-content">
                        {!! $blog->description !!}
                    </div>
                </div>

                <div class="dextheme-col-lg-4 dextheme-col-12">
                    <div class="dextheme-card border-0 shadow-sm p-4 mb-4">
                        <h5 class="mb-3">{{ __('frontend.blog_details_more_articles') }}</h5>
                        @php
                            $related = \App\Models\Blog::where('id', '!=', $blog->id)->latest()->take(5)->get();
                        @endphp
                        @forelse ($related as $item)
                            <div class="mb-3 pb-3 border-bottom">
                                <a href="{{ route('blogs.details', $item->slug) }}"
                                    class="d-block text-decoration-none fw-600"
                                    style="color:#233658; font-weight:600;">
                                    {{ $item->title }}
                                </a>
                                <small class="text-muted">{{ $item->created_at?->format('M d, Y') }}</small>
                            </div>
                        @empty
                            <p class="text-muted">{{ __('frontend.blog_details_no_other_articles') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
