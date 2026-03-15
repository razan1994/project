@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_home') }}
@endsection
@section('meta_title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.navbar_home') }}
@endsection
@section('meta_desc')
    {{ isset($seoData->metaDesc) ? $seoData->metaDesc : __('frontend.navbar_home') }}
@endsection
@section('meta_keywords')
    {{ isset($seoData->keywords) ? $seoData->keywords : __('frontend.navbar_home') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    @if (Config::get('app.locale') == 'en')
        <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/' }}" />
        <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' }}" hreflang="en-jo" />
        <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' }}" hreflang="ar-jo" />
    @else
        <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/' }}" />
        <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' }}" hreflang="ar-jo" />
        <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/' }}" hreflang="en-jo" />
    @endif
@endsection

@push('styles')
    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/css/intlTelInput.css">
    <!-- country-select-js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.1/css/countrySelect.min.css">
@endpush


@push('scripts')
@endpush

@section('content')
    <!-- Content Section -->
    <livewire:frontend.slider-section />



    <!-- Section 1 -->
    <div style="background-color: #f5f5f5 !important;" class="dextheme-column-description dextheme-section-padding bg-line-o1  bg-secondary">
        <div class="dextheme-container">
            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-crane2"></i>
                        </div>
                        <h4>We're Experts</h4>
                        <p>Suspendisse accumsan quis nulla eget cursus. Nulla est mi, rhoncus eu nulla sed, placerat
                            placerat neque.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="210ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-communication"></i>
                        </div>
                        <h4>We're Friendly</h4>
                        <p>Suspendisse accumsan quis nulla eget cursus. Nulla est mi, rhoncus eu nulla sed, placerat
                            placerat neque.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="220ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-pencil_art"></i>
                        </div>
                        <h4>We're Accurate</h4>
                        <p>Suspendisse accumsan quis nulla eget cursus. Nulla est mi, rhoncus eu nulla sed, placerat
                            placerat neque.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="230ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-brickwall"></i>
                        </div>
                        <h4>We're Trusted</h4>
                        <p>Suspendisse accumsan quis nulla eget cursus. Nulla est mi, rhoncus eu nulla sed, placerat
                            placerat neque.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Section 2 -->
    <div id="about-section">
        <livewire:frontend.about-section />
    </div>


    <!-- Section 3 -->
    <div id="services-section">
        <livewire:frontend.service-section />
    </div>

    <!-- Section 5 -->
    <livewire:frontend.feature-section />



    <!-- Section 9 -->
    {{-- <div id="faq-section">
        <livewire:frontend.faq-section />
    </div> --}}


    <!-- Section 10 -->
    @include('frontend.layout.partials.contact-section')
    <!-- Section 11 -->
    <div id="latest-news-section">
        <livewire:frontend.latest-news-section />
    </div>
@endsection
