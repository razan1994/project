<div>
       <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">

        <div class="dextheme-heading__inner">
            <h2>{{ $privacy?->title ?? __('frontend.privacy_title') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.navbar_home') }}</a> - {{ $privacy?->title ?? __('frontend.privacy_title') }}</p>
            </div>
        </div>
    </div>

    <div class="dextheme-section-padding bg-white">
        <div class="dextheme-container">
            <div class="block-heading mb-4">
                <h2 class="dextheme-main-title mb-4">{{ $privacy?->title ?? __('frontend.privacy_title') }}</h2>
            </div>

            <div class="plain-text">
                {!! $privacy?->description ?? __('frontend.privacy_content_empty') !!}
            </div>
        </div>
    </div>
</div>
