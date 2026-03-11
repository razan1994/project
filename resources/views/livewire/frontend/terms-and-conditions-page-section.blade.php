<div>
    <div class="dextheme-heading" data-bg="{{ asset('images/1280x300.png') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ $terms?->title ?? __('Terms & Conditions') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('Home') }}</a> - {{ $terms?->title ?? __('Terms & Conditions') }}</p>
            </div>
        </div>
    </div>

    <div class="dextheme-section-padding bg-white">
        <div class="dextheme-container">
            <div class="block-heading mb-4">
                <p class="dextheme-sub-title mb-4">{{ __('Legal') }}</p>
                <h2 class="dextheme-main-title mb-4">{{ $terms?->title ?? __('Terms & Conditions') }}</h2>
            </div>

            <div class="plain-text">
                {!! $terms?->description ?? __('Terms and conditions content has not been added yet.') !!}
            </div>
        </div>
    </div>
</div>
