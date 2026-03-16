<div>
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ $about?->title ?? 'About Us' }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">Home</a> - {{ $about?->title ?? 'About Us' }}</p>
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
                                <h4 class="counter" data-count="40" data-suffix="">0</h4>
                                <p>Years of Experience</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dextheme-col-lg-6 dextheme-col-md-12">
                    <div class="block-heading mb-4">
                        <p class="dextheme-sub-title mb-4">WHO WE ARE</p>
                        <h2 class="dextheme-main-title mb-4">{{ $about?->title ?? 'Dedicated to Building Excellence.' }}
                        </h2>
                        <p class="plain-text">{!! $about?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}</p>
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
                <p class="dextheme-sub-title mb-3" style="letter-spacing: 1.4px;">Leading the Way</p>
                <h2 class="dextheme-main-title mb-3" style="color: #233658;">What Sets Us Apart</h2>
                <p class="plain-text dextheme-w-75" style="color: #5f646d;">
                    The principles that guide how we think, build, and deliver value.
                </p>
            </div>

            <div class="dextheme-row g-4">
                <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                    <div class="dextheme-animation" data-animate="animate__fadeInUp" data-delay-step="120ms"
                        style="height: 100%; padding: 1px; border-radius: 18px; background: linear-gradient(135deg, #b07f47 0%, #8b6033 100%); box-shadow: 0 16px 32px rgba(35, 54, 88, 0.08);">
                        <div
                            style="height: 100%; border-radius: 17px; background: #fff; padding: 30px 28px; transition: transform .25s ease, box-shadow .25s ease;">
                            <div class="d-flex align-items-center mb-3" style="gap: 12px;">

                                <h3 class="mb-0" style="font-size: 1.25rem; color: #233658;">
                                    {{ $vision?->title ?? 'Our Vision' }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $vision?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
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
                                    {{ $mission?->title ?? 'Our Mission' }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #233658 0%, #314a77 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $mission?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
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
                                    {{ $value?->title ?? 'Our Values' }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $value?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dextheme-row g-4 mt-2">
                <div class="dextheme-col-12">
                    <div class="dextheme-animation" data-animate="animate__fadeInUp" data-delay-step="300ms"
                        style="height: 100%; padding: 1px; border-radius: 18px; background: linear-gradient(135deg, #233658 0%, #314a77 100%); box-shadow: 0 16px 32px rgba(35, 54, 88, 0.08);">
                        <div
                            style="height: 100%; border-radius: 17px; background: #fff; padding: 30px 28px; transition: transform .25s ease, box-shadow .25s ease;">
                            <div class="d-flex align-items-center mb-3" style="gap: 12px;">
                                <h3 class="mb-0" style="font-size: 1.25rem; color: #233658;">
                                    {{ $feature?->title ?? 'Our Features' }}</h3>
                            </div>
                            <div
                                style="width: 52px; height: 3px; border-radius: 2px; background: linear-gradient(90deg, #233658 0%, #314a77 100%);">
                            </div>
                            <p class="plain-text mt-3 mb-0" style="color: #565d66; line-height: 1.9;">
                                {!! $feature?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.layout.partials.contact-section')
</div>
