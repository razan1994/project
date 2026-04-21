@extends('frontend.layout.app')

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
                    @php
                        $isArabic = app()->getLocale() === 'ar';
                        $displayAlt = $isArabic ? ($blog->alt_text_ar ?: $blog->title) : ($blog->alt_text_en ?: $blog->title);
                        $displayH1  = $isArabic ? ($blog->h1_val_ar ?: $blog->title) : ($blog->h1_val_en ?: $blog->title);
                        $displayH2  = $isArabic ? ($blog->h2_val_ar ?? '') : ($blog->h2_val_en ?? '');
                    @endphp
                    @if ($blog->image)
                        <div class="mb-4">
                            <img src="{{ asset($blog->image) }}" alt="{{ $displayAlt }}"
                                style="width:100%; max-height:460px; object-fit:cover; border-radius:8px;">
                        </div>
                    @endif

                    <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                        <div class="meta-date">
                            <i aria-hidden="true" class="icon icon-calendar3"></i>
                           <span>{{ $blog->created_at?->locale(app()->getLocale())->translatedFormat('F d, Y') }}</span>
                        </div>
                    </div>

                    <h1 class="dextheme-main-title mb-4">{{ $displayH1 }}</h1>
                    @if($displayH2)
                        <h2 class="dextheme-title-text sm mb-3">{{ $displayH2 }}</h2>
                    @endif

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
