<style>
    .service-gallery-clickable {
        cursor: zoom-in;
        transition: transform 0.2s ease;
    }

    .service-gallery-clickable:hover {
        transform: scale(1.02);
    }

    .service-gallery-lightbox {
        position: fixed;
        inset: 0;
        z-index: 12000;
        background: rgba(0, 0, 0, 0.82);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }

    .service-gallery-lightbox.active {
        display: flex;
    }

    .service-gallery-lightbox img {
        max-width: min(1100px, 95vw);
        max-height: 88vh;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    .service-gallery-lightbox-close {
        position: absolute;
        top: 18px;
        right: 24px;
        color: #fff;
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
        cursor: pointer;
    }
</style>

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

                        @if ($galleryMedia->isNotEmpty())
                            <div class="mt-4">
                                <h4 class="dextheme-title-text sm mb-3">{{ __('Gallery') }}</h4>
                                <div class="dextheme-row g-3">
                                    @foreach ($galleryMedia as $mediaItem)
                                        <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                                            <div class="dextheme-card border-secondary h-100">
                                                <div class="dextheme-card__body p-2"
                                                    style="height: 220px; display: flex; align-items: center; justify-content: center;">
                                                    @if (str_starts_with((string) $mediaItem->mime_type, 'image/'))
                                                        <img src="{{ asset($mediaItem->path) }}" alt="{{ $service->title }}"
                                                            class="service-gallery-clickable"
                                                            data-gallery-image="{{ asset($mediaItem->path) }}"
                                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                    @elseif (str_starts_with((string) $mediaItem->mime_type, 'video/'))
                                                        <video controls style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                            <source src="{{ asset($mediaItem->path) }}"
                                                                type="{{ $mediaItem->mime_type }}">
                                                        </video>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
                                <p class="dextheme-title-text sm text-white py-4">{{ $contact?->phone ?? 'Add Phone' }}</p>
                                <p class="plain-text text-white mb-3">{{ $contact?->email ?? 'Add Email' }}</p>
                                <p class="plain-text text-white mb-3">{{ $contact?->address ?? 'Add Address' }}</p>
                                <a href="{{ route('contact-us') }}"
                                    class="dextheme-btn btn-primary hover-outline-secondary">{{ __('Contact Us Today') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="serviceGalleryLightbox" class="service-gallery-lightbox" aria-hidden="true">
        <span id="serviceGalleryLightboxClose" class="service-gallery-lightbox-close">&times;</span>
        <img id="serviceGalleryLightboxImage" src="" alt="Preview image">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = document.getElementById('serviceGalleryLightbox');
        const lightboxImage = document.getElementById('serviceGalleryLightboxImage');
        const closeBtn = document.getElementById('serviceGalleryLightboxClose');

        if (!lightbox || !lightboxImage || !closeBtn) {
            return;
        }

        document.addEventListener('click', function(event) {
            const image = event.target.closest('[data-gallery-image]');

            if (!image) {
                return;
            }

            lightboxImage.src = image.getAttribute('data-gallery-image');
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        const closeLightbox = function() {
            lightbox.classList.remove('active');
            lightboxImage.src = '';
            document.body.style.overflow = '';
        };

        closeBtn.addEventListener('click', closeLightbox);

        lightbox.addEventListener('click', function(event) {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });
    });
</script>
