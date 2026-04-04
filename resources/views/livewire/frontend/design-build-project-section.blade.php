<div>
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ __('frontend.designbuild_title') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.designbuild_home') }}</a> -
                    {{ __('frontend.designbuild_title') }}</p>
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
                <video src="{{ $videoSrc }}" controls autoplay loop style="width:100%; height:100%; border-radius: 8px; background: #000;">
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
