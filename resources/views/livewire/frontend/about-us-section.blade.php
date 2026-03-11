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

    <!-- Experience, Mission, Vision, Values, Feature Section (Unified Design) -->
    <div class="dextheme-section-padding" style="background: linear-gradient(120deg, #f8f6f2 60%, #f3e7d9 100%);">
        <div class="dextheme-container">
            <div class="block-heading mb-5">
                <p class="dextheme-sub-title mb-2"
                    style="color: #b07f47; font-weight: 700; letter-spacing: 1px; text-align:left;">{{ __('About Us') }}
                </p>
                <h2 class="dextheme-main-title mb-3" style="font-size:1rem; color: #233658; text-align:left;">
                    {{ $about?->title ?? 'Dedicated to Building Excellence.' }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:left;">
                    {!! $about?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                </p>
            </div>


            <div class="block-heading mb-5">

                <h2 class="dextheme-main-title mb-3" style="font-size:1rem; color: #233658; text-align:left;">
                    {{ $vision?->title ?? 'Our Vision' }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:left;">
                    {!! $vision?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                </p>
            </div>


            <div class="block-heading mb-5">

                <h2 class="dextheme-main-title mb-3" style="font-size:1rem; color: #233658; text-align:left;">
                    {{ $mission?->title ?? 'Our Mission' }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:left;">
                    {!! $mission?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                </p>
            </div>

            <div class="block-heading mb-5">

                <h2 class="dextheme-main-title mb-3" style="font-size:1rem; color: #233658; text-align:left;">
                    {{ $value?->title ?? 'Our Values' }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:left;">
                    {!! $value?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                </p>
            </div>

            <div class="block-heading mb-5">

                <h2 class="dextheme-main-title mb-3" style="font-size:2rem; color: #233658; text-align:left;">
                    {{ $feature?->title ?? 'Our Features' }}</h2>
                <div class="mb-4"
                    style="width: 60px; height: 4px; background: linear-gradient(90deg, #b07f47 0%, #8b6033 100%); border-radius: 2px;">
                </div>
                <p class="plain-text dextheme-w-75" style="font-size:1.1rem; color: #555; text-align:left;">
                    {!! $feature?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' !!}
                </p>
            </div>
        </div>
    </div>

    <livewire:frontend.contact-section />
</div>
