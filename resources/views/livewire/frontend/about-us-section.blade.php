<div>
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ $about?->title ?? __('frontend.aboutus_default_title') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.aboutus_home') }}</a> - {{ $about?->title ?? __('frontend.aboutus_default_title') }}</p>
            </div>
        </div>
    </div>

    <div class="dextheme-section-2 bg-white">
        <div class="dextheme-container">
            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-6 dextheme-col-md-12 d-none d-md-block">
                    <div class="img-wrapper">
                        <div class="top-child-img dextheme-animation" data-animate="animate__slideInDown">
                            <img src="{{ asset('assets/images/about.webp') }}" alt="about us">
                        </div>
                        <img src="{{ $about?->about_us_image ? asset($about->about_us_image) : asset('images/500x700.png') }}"
                            alt="about us">
                        <div class="experience dextheme-animation" data-animate="animate__slideInLeft"
                            data-delay-step="210ms">
                            <div class="bg-primary experience-body">
                                <h4 class="counter" data-count="25" data-suffix="">0</h4>
                                <p>{{ __('frontend.aboutus_years_exp') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dextheme-col-lg-6 dextheme-col-md-12">
                    <div class="block-heading mb-4">
                        <p class="dextheme-sub-title mb-4">{{ __('frontend.aboutus_who_we_are') }}</p>
                        <h2 class="dextheme-main-title mb-4">{{ $about?->title ?? __('frontend.aboutus_default_heading') }}
                        </h2>
                        <p class="plain-text">{!! $about?->description ?? __('frontend.aboutus_default_desc') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission, Vision, Values, Feature Section -->
    <div class="dextheme-section-padding"
        style="background: linear-gradient(145deg, #f8f6f2 0%, #f5ecdf 55%, #efe2d0 100%);">
        <div class="dextheme-container">
            <div class="block-heading mb-5">
                <div class="block-heading text-center mb-5 pt-5">
                    <p class="dextheme-sub-title text-white mb-4">{{ __('frontend.aboutus_purpose_subtitle') }}</p>
                    <h2 class="dextheme-main-title text-white mb-4">{{ __('frontend.aboutus_purpose_title') }}</h2>
                </div>
            </div>

            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                    <div class="dextheme-animation" data-animate="animate__fadeInUp" data-delay-step="120ms"
                        style="height: 100%; padding: 1px; border-radius: 18px; background: linear-gradient(135deg, #b07f47 0%, #8b6033 100%); box-shadow: 0 16px 32px rgba(35, 54, 88, 0.08);">
                        <div
                            style="height: 100%; border-radius: 17px; background: #fff; padding: 30px 28px; transition: transform .25s ease, box-shadow .25s ease;">
                            <div class="d-flex align-items-center mb-3" style="gap: 12px;">

                                <h3 class="mb-0" style="font-size: 1.25rem; color: #233658;">
                                    {{ $vision?->title ?? __('frontend.aboutus_vision_title') }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $vision?->description ?? __('frontend.aboutus_default_desc') !!}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                    <div class="dextheme-animation" data-animate="animate__fadeInUp" data-delay-step="180ms"
                        style="height: 100%; padding: 1px; border-radius: 18px; background: linear-gradient(135deg, #233658 0%, #314a77 100%); box-shadow: 0 16px 32px rgba(35, 54, 88, 0.08);">
                        <div
                            style="height: 100%; border-radius: 17px; background: #fff; padding: 30px 28px; transition: transform .25s ease, box-shadow .25s ease;">
                            <div class="d-flex align-items-center mb-3" style="gap: 12px;">

                                <h3 class="mb-0" style="font-size: 1.25rem; color: #233658;">
                                    {{ $mission?->title ?? __('frontend.aboutus_mission_title') }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #233658 0%, #314a77 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $mission?->description ?? __('frontend.aboutus_default_desc') !!}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                    <div class="dextheme-animation" data-animate="animate__fadeInUp" data-delay-step="240ms"
                        style="height: 100%; padding: 1px; border-radius: 18px; background: linear-gradient(135deg, #b07f47 0%, #8b6033 100%); box-shadow: 0 16px 32px rgba(35, 54, 88, 0.08);">
                        <div
                            style="height: 100%; border-radius: 17px; background: #fff; padding: 30px 28px; transition: transform .25s ease, box-shadow .25s ease;">
                            <div class="d-flex align-items-center mb-3" style="gap: 12px;">

                                <h3 class="mb-0" style="font-size: 1.25rem; color: #233658;">
                                    {{ $value?->title ?? __('frontend.aboutus_values_title') }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $value?->description ?? __('frontend.aboutus_default_desc') !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
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
</div>
