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

@section('h1_val')
    {{ isset($seoData->h1) ? $seoData->h1 : __('frontend.navbar_home') }}
@endsection
@section('h2_val')
    {{ isset($seoData->h2) ? $seoData->h2 : __('frontend.navbar_home') }}
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
    <div style="background-color: #f5f5f5 !important;"
        class="dextheme-column-description dextheme-section-padding bg-line-o1  bg-secondary">
        <div class="dextheme-container">
            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-crane2"></i>
                        </div>
                        <h4>We're Experts</h4>
                        <p>Our engineering team brings extensive experience in construction project execution, ensuring
                            every stage is planned carefully and delivered with professional standards.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="210ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-communication"></i>
                        </div>
                        <h4>We're Collaborative</h4>
                        <p>We believe strong communication with clients and teams ensures clear understanding, smooth
                            coordination, and successful completion of every project.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="220ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-pencil_art"></i>
                        </div>
                        <h4>We're Precise</h4>
                        <p>Every project is executed with attention to detail and strict adherence to engineering
                            specifications to guarantee accurate results and reliable construction quality.</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="230ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-brickwall"></i>
                        </div>
                        <h4>We're Reliable</h4>
                        <p>We are committed to delivering durable structures, completing projects on schedule, and building
                            long-term trust with our clients and partners.</p>
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


    <!-- Why Choose Us Section -->
    <section id="why-choose-us" style="background: #fff;">
        <div class="dextheme-container">
            <div class="dextheme-row justify-content-center mb-5">
                <div class="block-heading text-center mb-5 pt-5">
                    <p class="dextheme-sub-title text-black mb-4">Where Quality Meets Innovation</p>
                    <h2 class="dextheme-main-title text-black mb-4">What Sets Us Apart</h2>
                    <p class="text-black"
                        style="text-align: justify; text-align-last: center; max-width: 900px; margin: 0 auto;">
                        {!! $feature?->description ??
                            'Our work is built on a strong foundation of quality, reliability, and long-term commitment. We focus on delivering practical solutions, maintaining clear communication, and ensuring every project reflects the standards our clients expect and trust.' !!}
                    </p>
                </div>
            </div>

            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">

                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">Professional Expertise</h4>
                        <p class="mb-0" style="color:#929292;">
                            Our experienced team brings industry knowledge, technical skill, and attention to detail to
                            every stage of the project.
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="120ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">

                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">Clear Communication</h4>
                        <p class="mb-0" style="color:#929292;">
                            We believe successful results start with transparency, responsiveness, and strong collaboration
                            with every client.
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="180ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">

                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">Consistent Quality</h4>
                        <p class="mb-0" style="color:#929292;">
                            We are committed to delivering dependable results that meet high standards of performance,
                            durability, and value.
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="240ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                           
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">Trusted Partnership</h4>
                        <p class="mb-0" style="color:#929292;">
                            We build lasting relationships through honesty, accountability, and a genuine commitment to our
                            clients’ success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Section 3 -->
    <div id="services-section">
        <livewire:frontend.service-section />
    </div>

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
