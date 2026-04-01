<div>
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ __('frontend.servicespage_title') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.servicespage_home') }}</a> - {{ __('frontend.servicespage_title') }}</p>
            </div>
        </div>
    </div>

    <!-- Services Section (Homepage Style) -->
    <div class="dextheme-section-padding bg-white">
        <div class="dextheme-container">
            <div class="block-heading text-center mb-5">
                <p class="dextheme-sub-title mb-4">{{ __('frontend.services_subtitle') }}</p>
                <h2 class="dextheme-main-title mb-4">{{ __('frontend.services_title') }}</h2>
                <p class="dextheme-text-grey dextheme-w-65 mx-auto">
                    {!! $featuredService?->sub_description ?? __('frontend.servicespage_default_desc') !!}
                </p>
            </div>
            <div class="dextheme-row g-4">
                @forelse ($services as $service)
                    <div class="dextheme-col-lg-6 dextheme-col-md-6 dextheme-col-12">
                        <div class="dextheme-card project-card-alt border-0 gradient-border" style="height:100%;display:flex;flex-direction:column;">
                            <div class="img-wrapper">
                                <img src="{{ !empty($service->image) ? asset($service->image) : asset('assets/images/default-service.png') }}"
                                    alt="{{ $service->title }}" class="dextheme-card__img-top"
                                    style="width:100%;max-width:100%;height:300px;max-height:300px;object-fit:cover;aspect-ratio:1.5/1;">
                            </div>
                            <div class="dextheme-card__body p-3 mt-3" style="flex:1 1 auto;display:flex;flex-direction:column;justify-content:stretch;min-height:320px;">
                                <div class="p-3">
                                    <h4 class="dextheme-title-text sm mb-4">{{ $service->title }}</h4>
                                    <p class="plain-text mb-4">{!! $service->sub_description !!}</p>
                                    <div style="flex:1 1 auto;"></div>
                                    <a href="{{ route('services.details', $service->slug) }}" class="link mt-2" style="display:block;margin-top:auto;">
                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                        </svg>
                                        {{ __('frontend.services_read_more') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                        <div class="dextheme-card project-card-alt border-0 gradient-border">
                            <div class="img-wrapper">
                                <img src="{{ asset('assets/images/default-service.png') }}" alt="Service" class="dextheme-card__img-top"
                                    style="width:100%;max-width:100%;height:220px;max-height:220px;object-fit:cover;aspect-ratio:1.5/1;">
                            </div>
                            <div class="dextheme-card__body p-3 mt-3">
                                <div class="p-3">
                                    <h6 class="dextheme-title-uppercase mb-3">{{ __('frontend.services_default_category') }}</h6>
                                    <h4 class="dextheme-title-text sm mb-4">{{ __('frontend.services_default_title') }}</h4>
                                    <p class="plain-text mb-4">{{ __('frontend.services_default_desc') }}</p>
                                    <div style="flex:1 1 auto;"></div>
                                    <a href="#" class="link mt-2" style="display:block;margin-top:auto;">
                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                        </svg>
                                        {{ __('frontend.services_read_more') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


    <div class="dextheme-section-padding" style="background: linear-gradient(120deg, #f8f6f2 60%, #f3e7d9 100%);">
        <div class="dextheme-container">
            <div class="design-build-title" style="text-align:{{ app()->getLocale() === 'ar' ? 'right' : 'left' }};padding-bottom:24px;">
                <h2
                    style="color:#233658;font-size:1.5rem;font-weight:800;margin-bottom:0.5rem;letter-spacing:-1px;line-height:1.1;">
                    {{ __('frontend.designbuild_main_title') }}
                </h2>
                <div
                    style="width:80px;height:5px;background:linear-gradient(90deg,#b07f47 0%,#8b6033 100%);border-radius:3px;margin-bottom:0.75rem;">
                </div>
                <div style="font-size:1rem;color:#7a5c2e;font-weight:500;opacity:0.85;">
                    {{ __('frontend.designbuild_subtitle') }}</div>
            </div>
            <div class="ratio ratio-16x9 mt-5">
                @php
                    $videoSrc = app()->getLocale() === 'ar'
                        ? asset('assets/images/design-build-project-ar.webm')
                        : asset('assets/images/design-build-project.webm');
                @endphp
                <video src="{{ $videoSrc }}" controls style="width:100%; height:100%; border-radius: 8px; background: #000;">
                    {{ __('frontend.designbuild_video_not_supported') }}
                </video>
            </div>
            <div class="block-heading mb-5 mt-5">

                <h2 class="dextheme-main-title mb-3" style="font-size:1rem; color: #233658; text-align:{{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">
                    {{ $featuredDesign?->title ?? __('frontend.designbuild_title') }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:{{ app()->getLocale() === 'ar' ? 'right' : 'left' }};">
                    {!! $featuredDesign?->description ?? __('frontend.designbuild_default_desc') !!}
                </p>
            </div>
        </div>
    </div>
</div>
