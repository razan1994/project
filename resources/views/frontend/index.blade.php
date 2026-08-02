@extends('frontend.layout.app')


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
                        <h4>{{ __('frontend.section1_experts_title') }}</h4>
                        <p>{{ __('frontend.section1_experts_desc') }}</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="210ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-communication"></i>
                        </div>
                        <h4>{{ __('frontend.section1_collaborative_title') }}</h4>
                        <p>{{ __('frontend.section1_collaborative_desc') }}</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="220ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-pencil_art"></i>
                        </div>
                        <h4>{{ __('frontend.section1_precise_title') }}</h4>
                        <p>{{ __('frontend.section1_precise_desc') }}</p>
                    </div>
                    <div class="dextheme-column-description__divider"></div>
                </div>
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__slideInUp" data-delay-step="230ms">
                    <div>
                        <div class="dextheme-column-description__icon">
                            <i aria-hidden="true" class="icon icon-brickwall"></i>
                        </div>
                        <h4>{{ __('frontend.section1_reliable_title') }}</h4>
                        <p>{{ __('frontend.section1_reliable_desc') }}</p>
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
    <section id="why-choose-us" class="pb-5" style="background: #fff;">
        <div class="dextheme-container">
            <div class="dextheme-row justify-content-center ">
                <div class="block-heading text-center mb-5 pt-5">
                    <p class="dextheme-sub-title text-black mb-4">{{ __('frontend.why_choose_subtitle') }}</p>
                    <h2 class="dextheme-main-title text-black mb-4">{{ __('frontend.why_choose_title') }}</h2>
                </div>
            </div>

            <div class="dextheme-row">
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                            <i class="icon icon-crane2"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_expertise_title') }}</h4>
                        <p class="mb-0" style="color:#929292;">
                            {{ __('frontend.why_choose_expertise_desc') }}
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="120ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                            <i class="icon icon-communication"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_communication_title') }}</h4>
                        <p class="mb-0" style="color:#929292;">
                            {{ __('frontend.why_choose_communication_desc') }}
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="180ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                            <i class="icon icon-pencil_art"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_quality_title') }}</h4>
                        <p class="mb-0" style="color:#929292;">
                            {{ __('frontend.why_choose_quality_desc') }}
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="240ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                            <i class="icon icon-brickwall"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_partnership_title') }}</h4>
                        <p class="mb-0" style="color:#929292;">
                            {{ __('frontend.why_choose_partnership_desc') }}
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




    <!-- Section 10 -->

    @include('frontend.layout.partials.contact-section')

    <!-- Section 12 -->
    <div id="latest-news-section">
        <livewire:frontend.latest-news-section />
    </div>
@endsection
