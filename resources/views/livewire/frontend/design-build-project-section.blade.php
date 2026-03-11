<div>
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ __('Design Build Project') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('Home') }}</a> - {{ __('Design Build Project') }}</p>
            </div>
        </div>
    </div>


    <div class="dextheme-section-padding" style="background: linear-gradient(120deg, #f8f6f2 60%, #f3e7d9 100%);">
        <div class="dextheme-container">
            <div class="ratio ratio-16x9">
                <iframe src="{{ asset('assets/images/design-build-project.webm') }}" title="YouTube video"
                    allow="autoplay; fullscreen" allowfullscreen>
                </iframe>
            </div>
            <div class="block-heading mb-5 mt-5">

                <h2 class="dextheme-main-title mb-3" style="font-size:1rem; color: #233658; text-align:left;">
                    {{ $featuredDesign?->title ?? __('Design Build Project') }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:left;">
                    {!! $featuredDesign?->description ?? __('Explore our latest project designs.') !!}
                </p>
            </div>
        </div>
    </div>
