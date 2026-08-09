@extends('frontend.layout.app')


@push('styles')
    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/css/intlTelInput.css">
    <!-- country-select-js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.1/css/countrySelect.min.css">

    <style>
        .home-seo-row {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 0;
        }

        .home-seo-title-link {
            color: #233658;
            font-weight: 900;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .home-seo-title-link i {
            color: #233658;
            margin-inline-end: 4px;
            font-size: 11px;
        }

        .home-seo-title-link:hover {
            color: #929292;
            text-decoration: none;
        }

        .home-seo-title-link:hover i {
            color: #929292;
        }

        /* Modal */
        #homeSeoModal .modal-header {
            background-color: #233658;
            color: #fff;
        }

        #homeSeoModal .modal-title {
            color: #fff;
            font-weight: 700;
        }

        #homeSeoModal .modal-body {
            color: #929292;
            line-height: 1.8;
        }

        #homeSeoModal .btn-close {
            filter: brightness(0) invert(1);
        }
    </style>
@endpush


@push('scripts')
    @php
        $isArabic = app()->getLocale() === 'ar';

        $seoSectionsData = $seoSections->mapWithKeys(function ($section) use ($isArabic) {
            return [
                $section->id => [
                    'title' => $isArabic ? $section->title_ar : $section->title_en,

                    'description' => $isArabic ? $section->desc_ar : $section->desc_en,
                ],
            ];
        });
    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const seoSections = @json($seoSectionsData);

            document
                .querySelectorAll('.home-seo-title-link')
                .forEach(function(link) {

                    link.addEventListener('click', function(e) {

                        e.preventDefault();

                        const id = this.getAttribute('data-section-id');

                        const section = seoSections[id];

                        if (!section) {
                            return;
                        }

                        document.getElementById(
                            'homeSeoModalLabel'
                        ).textContent = section.title;

                        document.getElementById(
                            'homeSeoModalBody'
                        ).innerHTML = section.description;

                        const modal = new bootstrap.Modal(
                            document.getElementById(
                                'homeSeoModal'
                            )
                        );

                        modal.show();

                    });

                });

        });
    </script>
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
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_expertise_title') }}
                        </h4>
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
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_communication_title') }}
                        </h4>
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
                        <h4 class="fw-bold mb-2" style="color:#233658;">{{ __('frontend.why_choose_partnership_title') }}
                        </h4>
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

    @if ($seoSections->isNotEmpty())
        <div class="dextheme-container py-4">

            <p dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="home-seo-row">

                @foreach ($seoSections as $section)

                    <a href="#" class="home-seo-title-link" data-section-id="{{ $section->id }}">

                        <i class="fas fa-minus"></i>

                    </a>
                @endforeach

            </p>

        </div>
    @endif


    <!-- SEO Section Modal -->
    <div class="modal fade" id="homeSeoModal" tabindex="-1" aria-labelledby="homeSeoModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="homeSeoModalLabel"></h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body" id="homeSeoModalBody"></div>

            </div>

        </div>

    </div>






@endsection
