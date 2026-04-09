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
                <h2>{{ __('frontend.projectdetails_projects') }}</h2>
                <div class="dextheme-heading__inner__breadcrumb">
                    <p><a href="{{ route('home') }}">{{ __('frontend.projectdetails_home') }}</a> - {{ $project->title }}</p>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="dextheme-section-padding bg-white">
            <div class="dextheme-container">
                <div class="dextheme-row gy-3">
                    <div class="dextheme-col-lg-8 dextheme-col-md-12">


                        <div class="mb-4">
                            <img src="{{ $project->image ? asset($project->image) : asset('images/800x300.png') }}"
                                alt="{{ $project->alt_text ?? $project->title }}" width="100%">
                        </div>
                        <h2 class="dextheme-title-text xl mb-3">{{ $project->title }}</h2>
                        <p class="plain-text mb-3">{!! $project->description !!}</p>

                        @if ($galleryMedia->isNotEmpty())
                            <div class="mt-4">
                                <h4 class="dextheme-title-text sm mb-3">{{ __('frontend.projectdetails_gallery') }}</h4>
                                <div class="dextheme-row g-3">
                                    @foreach ($galleryMedia as $mediaItem)
                                        <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                                            <div class="dextheme-card border-secondary h-100">
                                                <div class="dextheme-card__body p-2"
                                                    style="height: 220px; display: flex; align-items: center; justify-content: center;">
                                                    @if (str_starts_with((string) $mediaItem->mime_type, 'image/'))
                                                        <img src="{{ asset($mediaItem->path) }}"
                                                            alt="{{ $project->title }}"
                                                            class="service-gallery-clickable"
                                                            data-gallery-image="{{ asset($mediaItem->path) }}"
                                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                    @elseif (str_starts_with((string) $mediaItem->mime_type, 'video/'))
                                                        <video controls
                                                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
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
                            <h4 class="dextheme-title-text sm text-white">{{ __('frontend.projectdetails_our_projects') }}</h4>
                        </div>
                        <div class="dextheme-card border-secondary mb-3">
                            <div class="dextheme-card__body px-4">
                                <ul class="services-list">
                                    @foreach ($projects as $item)
                                        <li>
                                            <a
                                                href="{{ route('projects.details', $item->slug ?: $item->id) }}">{{ $item->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="contact-us-widget p-0 overflow-hidden" style="background: #f8f9fa !important;">
                            <div class="contact-us-desc text-center py-5 px-3">
                                <h5 class="dextheme-title-text xl mb-3" style="color:#fff; font-weight:700;">
                                    {{ __('frontend.projectdetails_start_project_title') }}</h5>
                                <p class="lead mb-4" style="color:#fff; font-size:1.1rem;">{{ __('frontend.projectdetails_start_project_desc') }}</p>
                                <a href="{{ route('design-build-project') }}"
                                    class="dextheme-btn fw-bold shadow-lg px-4 py-3 mt-2"
                                    style="background:#0e2238; color:#fff; font-size:1.1rem; border-radius: 0.5rem; letter-spacing:0.5px; transition: box-shadow 0.2s; border:none;">
                                    <i class="fa-solid fa-building-columns me-2"></i>
                                    {{ __('frontend.projectdetails_start_now') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="projectGalleryLightbox" class="service-gallery-lightbox" aria-hidden="true">
        <span id="projectGalleryLightboxClose" class="service-gallery-lightbox-close">&times;</span>
        <img id="projectGalleryLightboxImage" src="" alt="Preview image">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = document.getElementById('projectGalleryLightbox');
        const lightboxImage = document.getElementById('projectGalleryLightboxImage');
        const closeBtn = document.getElementById('projectGalleryLightboxClose');

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
