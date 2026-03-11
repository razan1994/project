<div class="dextheme-section-2 bg-white">
    <div class="dextheme-container">
        <div class="dextheme-row g-4">
            <div class="dextheme-col-lg-6 dextheme-col-md-12 d-none d-md-block">
                <div class="img-wrapper">
                    <div class="top-child-img dextheme-animation" data-animate="animate__slideInDown">
                        <img src="{{ asset('assets/images/about.webp') }}" alt="about us">
                    </div>
                    <img src="{{ $about?->about_us_image ? asset($about->about_us_image) : asset('images/500x700.png') }}" alt="about us">
                    <div class="experience dextheme-animation" data-animate="animate__slideInLeft" data-delay-step="210ms">
                        <div class="bg-primary experience-body">
                            <h4 class="counter" data-count="40" data-suffix="">0</h4>
                            <p>Years of Experience</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dextheme-col-lg-6 dextheme-col-md-12">
                <div class="block-heading mb-4">
                    <p class="dextheme-sub-title mb-4">WHO WE ARE</p>
                    <h2 class="dextheme-main-title mb-4">{{ $about?->title ?? 'Dedicated to Building Excellence.' }}</h2>
                    <p class="plain-text">{!! $about?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}</p>
                </div>

                <a href="/about-us" class="dextheme-btn btn-secondary hover-outline-orange" style="display: inline-block; text-decoration: none;">
                    <i aria-hidden="true" class="icon icon-right-arrow"></i>
                    Learn More
                </a>
            </div>
        </div>
    </div>
</div>
