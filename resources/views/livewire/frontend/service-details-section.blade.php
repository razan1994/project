@php
    $contact = \App\Models\ContactUs::query()->first();
@endphp
<div>
    <div>
        <!-- Heading -->
        <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
            <div class="dextheme-heading__inner">
                <h2>Services</h2>
                <div class="dextheme-heading__inner__breadcrumb">
                    <p><a href="{{ route('home') }}">{{ __('Home') }}</a> - {{ $service->title }}</p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="dextheme-section-padding bg-white">
            <div class="dextheme-container">
                <div class="dextheme-row gy-3">
                    <div class="dextheme-col-lg-8 dextheme-col-md-12">


                        <div class="mb-4">
                            <img src="{{ $service->image ? asset($service->image) : asset('images/800x300.png') }}"
                                alt="{{ $service->alt_text ?? $service->title }}" width="100%">
                        </div>
                        <h2 class="dextheme-title-text xl mb-3">{{ $service->title }}</h2>
                        <p class="plain-text mb-3">{!! $service->description !!}</p>
                    </div>

                    <div class="sidebar-one dextheme-col-lg-4 dextheme-col-md-12">
                        <div class="title-tag bg-secondary mb-3">
                            <h4 class="dextheme-title-text sm text-white">{{ __('Our Services') }}</h4>
                        </div>
                        <div class="dextheme-card border-secondary mb-3">
                            <div class="dextheme-card__body px-4">
                                <ul class="services-list">
                                    @foreach ($services as $item)
                                        <li>
                                            <a
                                                href="{{ route('services.details', $item->slug ?: $item->id) }}">{{ $item->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="contact-us-widget bg-light" data-bg="{{ asset('images/350x250.png') }}">
                            <div class="contact-us-desc">
                                <h5>{{ __('Ready to Build? Contact Us Today!') }}</h5>
                                <p class="dextheme-title-text sm text-white py-4">{{ $contact?->phone ?? '-' }}</p>
                                <p class="plain-text text-white mb-3">{{ $contact?->email ?? '-' }}</p>
                                <p class="plain-text text-white mb-3">{{ $contact?->address ?? '-' }}</p>
                                <a href="{{ route('home') }}#contact-section"
                                    class="dextheme-btn btn-primary hover-outline-secondary">{{ __('Contact Us Today') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
