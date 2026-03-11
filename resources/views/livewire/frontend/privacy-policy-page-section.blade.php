<div>
    <div class="dextheme-heading" data-bg="{{ asset('images/1280x300.png') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ $privacy?->title ?? __('Privacy & Policy') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('Home') }}</a> - {{ $privacy?->title ?? __('Privacy & Policy') }}</p>
            </div>
        </div>
    </div>

    <div class="dextheme-section-padding bg-white">
        <div class="dextheme-container">
            <div class="block-heading mb-4">
                <p class="dextheme-sub-title mb-4">{{ __('Legal') }}</p>
                <h2 class="dextheme-main-title mb-4">{{ $privacy?->title ?? __('Privacy & Policy') }}</h2>
            </div>

            <div class="plain-text">
                {!! $privacy?->description ?? __('Privacy policy content has not been added yet.') !!}
            </div>
        </div>
    </div>
</div>
