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
                <div class="block-heading text-center mb-5 pt-5">
                    <p class="dextheme-sub-title text-white mb-4">Driven by Purpose</p>
                    <h2 class="dextheme-main-title text-white mb-4">Our Mission, Vision & Core Values</h2>
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


        </div>
    </div>

    <!-- Why Choose Us Section -->
    <section id="why-choose-us" class="pb-5" style="background: #fff;">
        <div class="dextheme-container">
            <div class="dextheme-row justify-content-center ">
                <div class="block-heading text-center mb-5 pt-5">
                    <p class="dextheme-sub-title text-black mb-4">Why Clients Choose Us</p>
                    <h2 class="dextheme-main-title text-black mb-4">Built on Quality, Driven by Commitment</h2>
                </div>
            </div>

            <div class="dextheme-row">
                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                            <i class="icon icon-crane2"></i>
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
                            <i class="icon icon-communication"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">Clear Communication</h4>
                        <p class="mb-0" style="color:#929292;">
                            We believe successful results start with transparency, responsiveness, and strong
                            collaboration
                            with every client.
                        </p>
                    </div>
                </div>

                <div class="dextheme-col-lg-3 dextheme-col-md-6 dextheme-col-12 dextheme-animation"
                    data-animate="animate__fadeInUp" data-delay-step="180ms">
                    <div class="why-choose-card gradient-border p-4 h-100 text-center bg-white shadow-sm rounded">
                        <div class="dextheme-column-description__icon mb-3">
                            <i class="icon icon-pencil_art"></i>
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
                            <i class="icon icon-brickwall"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color:#233658;">Trusted Partnership</h4>
                        <p class="mb-0" style="color:#929292;">
                            We build lasting relationships through honesty, accountability, and a genuine commitment to
                            our
                            clients’ success.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
