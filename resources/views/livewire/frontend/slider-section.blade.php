<div class="dextheme-container">
    <!-- Jumbotron -->
    <div class="dextheme-row g-4">
        <div class="col-12 position-relative">

                <div class="overlay-slide-bg"
                style="position:absolute;top:0;left:0;width:100vw;height:100vh;z-index:0;
        overflow:hidden;padding:0;margin:0;">
                <video class="slider-video" autoplay muted loop playsinline preload="none"
                    style="width:100vw;height:100vh;object-fit:cover;position:absolute;top:0;left:0;z-index:0;margin:0;padding:0;">
                    <source src="{{ asset('assets/images/home-video.webm') }}" type="video/webm">
                    Your browser does not support the video tag.
                </video>
                <style>
                    @media (max-width: 767.98px) {
                        .slider-video {
                            transform-origin: center bottom;
                            transform: scale(1.2) translateY(-45px) ;
                        }
                    }
                        @media (min-width: 768px) {
                            .dextheme-w-65 {
                                padding-bottom: 158px;
                            }
                        }
                </style>
            </div>
            <div class="jumbotron">
                <div class="jumbotron__inner">
                    <div style="padding-bottom: 170px !important" class="dextheme-w-5">
                        <div class="d-flex-column w-50">
                            <h1 class="lh-1"
                                @if ($heroSlider?->title_color) style="color: {{ $heroSlider->title_color }};" @endif>
                                {!! $heroSlider?->title ?? '' !!}
                            </h1>
                        </div>
                        <div class="cta-desc-group mt-0">
                            <p>
                                {!! $heroSlider?->description ?? '' !!}
                            </p>
                            <div class="cta-btn">

                                    <a href="{{ route('services') }}"
                                        class="dextheme-btn btn-primary hover-bg-white border-opaque me-3">
                                        {{ $heroSlider?->btn ?? '-' }}
                                    </a>

                                <a href="{{ route('contact-us') }}" style="border: 1px solid #fff !important;"
                                    class="dextheme-btn btn-outline-white hover-outline-orange">{{ __('frontend.slider_contact_us') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
