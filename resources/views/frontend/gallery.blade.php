@extends('frontend.layout.app')

{{-- SEO SECTION --}}
@section('title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.gallery_title') }}
@endsection
@section('meta_title')
    {{ isset($seoData->title) ? $seoData->title : __('frontend.gallery_title') }}
@endsection
@section('meta_desc')
    {{ isset($seoData->metaDesc) ? $seoData->metaDesc : __('frontend.gallery_subtitle') }}
@endsection
@section('meta_keywords')
    {{ isset($seoData->keywords) ? $seoData->keywords : __('frontend.gallery_title') }}
@endsection
{{-- SEO SECTION --}}

@section('canonical')
    <link rel="canonical" href="{{ config('app.url') . '/' . app()->getLocale() . '/gallery' }}" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/gallery' }}"
        hreflang="en-jo" />
    <link rel="alternate" href="{{ config('app.url') . '/' . app()->getLocale() . '/gallery' }}"
        hreflang="ar-jo" />
@endsection

@section('h1_val')
    {{ isset($seoData->h1) ? $seoData->h1 : __('frontend.gallery_title') }}
@endsection
@section('h2_val')
    {{ isset($seoData->h2) ? $seoData->h2 : __('frontend.gallery_title') }}
@endsection

@push('styles')
<style>
    .gallery-section {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .gallery-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .gallery-header p {
        font-size: 1.1rem;
        color: #666;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 0;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        aspect-ratio: 4/3;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.15);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay i {
        font-size: 2rem;
        color: white;
    }

    .no-images {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-images i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #ddd;
    }

    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .gallery-section {
            padding: 50px 0;
        }

        .gallery-header h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
    <section class="gallery-section">
        <div class="container">
            <div class="gallery-header">
                <h1>{{ __('frontend.gallery_title') }}</h1>
                <p>{{ __('frontend.gallery_subtitle') }}</p>
            </div>

            @if($images && $images->count() > 0)
                <div class="gallery-grid">
                    @foreach($images as $image)
                        <div class="gallery-item">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 alt="Gallery Image {{ $loop->iteration }}"
                                 loading="lazy">
                            <div class="gallery-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-images">
                    <i class="fas fa-images"></i>
                    <h3>{{ __('frontend.gallery_no_images') }}</h3>
                    <p>{{ __('frontend.gallery_check_back') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/simple-lightbox@2.14.0/dist/simpleLightbox.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-lightbox@2.14.0/dist/simple-lightbox.min.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const galleryItems = document.querySelectorAll('.gallery-item');

        // Create lightbox gallery
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                openLightbox(img.src, index);
            });
        });

        function openLightbox(src, index) {
            // Gather all image sources
            const imageElements = Array.from(document.querySelectorAll('.gallery-item img'));
            const imageSources = imageElements.map(img => img.src);

            // Create lightbox overlay
            const overlay = document.createElement('div');
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.9);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            `;

            // Create close button
            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '&times;';
            closeBtn.style.cssText = `
                position: absolute;
                top: 20px;
                right: 30px;
                background: transparent;
                border: none;
                color: white;
                font-size: 50px;
                font-weight: bold;
                cursor: pointer;
                z-index: 10000;
                transition: color 0.3s ease;
                line-height: 1;
                padding: 0;
                width: 50px;
                height: 50px;
            `;
            closeBtn.onmouseover = function() {
                this.style.color = '#ff0000';
            };
            closeBtn.onmouseout = function() {
                this.style.color = 'white';
            };

            // Create navigation arrows
            const prevBtn = document.createElement('button');
            const nextBtn = document.createElement('button');
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            prevBtn.setAttribute('aria-label', 'Previous');
            nextBtn.setAttribute('aria-label', 'Next');
            // RTL/LTR support
            const isRTL = document.documentElement.dir === 'rtl' || document.body.dir === 'rtl';
            prevBtn.style.cssText = `
                position: absolute;
                top: 50%;
                ${isRTL ? 'right' : 'left'}: 30px;
                transform: translateY(-50%);
                background: rgba(0,0,0,0.5);
                border: none;
                color: white;
                font-size: 2.5rem;
                cursor: pointer;
                z-index: 10000;
                border-radius: 50%;
                width: 55px;
                height: 55px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.2s;
            `;
            nextBtn.style.cssText = `
                position: absolute;
                top: 50%;
                ${isRTL ? 'left' : 'right'}: 30px;
                transform: translateY(-50%);
                background: rgba(0,0,0,0.5);
                border: none;
                color: white;
                font-size: 2.5rem;
                cursor: pointer;
                z-index: 10000;
                border-radius: 50%;
                width: 55px;
                height: 55px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.2s;
            `;
            prevBtn.onmouseover = nextBtn.onmouseover = function() {
                this.style.background = 'rgba(255,255,255,0.2)';
            };
            prevBtn.onmouseout = nextBtn.onmouseout = function() {
                this.style.background = 'rgba(0,0,0,0.5)';
            };

            // Create image element
            const img = document.createElement('img');
            img.src = src;
            img.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
                cursor: default;
                transition: opacity 0.2s;
            `;

            // Prevent closing when clicking on image or arrows
            img.addEventListener('click', function(e) { e.stopPropagation(); });
            prevBtn.addEventListener('click', function(e) { e.stopPropagation(); });
            nextBtn.addEventListener('click', function(e) { e.stopPropagation(); });

            // Navigation logic
            function showImage(newIndex) {
                if (newIndex < 0) newIndex = imageSources.length - 1;
                if (newIndex >= imageSources.length) newIndex = 0;
                img.style.opacity = '0.5';
                setTimeout(() => {
                    img.src = imageSources[newIndex];
                    img.style.opacity = '1';
                }, 120);
                currentIndex = newIndex;
            }
            let currentIndex = index;
            prevBtn.addEventListener('click', function() {
                showImage(currentIndex - 1);
            });
            nextBtn.addEventListener('click', function() {
                showImage(currentIndex + 1);
            });

            // Keyboard navigation
            const keyHandler = function(e) {
                if (e.key === 'ArrowLeft') {
                    if (isRTL) showImage(currentIndex + 1); else showImage(currentIndex - 1);
                } else if (e.key === 'ArrowRight') {
                    if (isRTL) showImage(currentIndex - 1); else showImage(currentIndex + 1);
                } else if (e.key === 'Escape') {
                    closeOverlay();
                }
            };

            // Close function
            const closeOverlay = function() {
                if (document.body.contains(overlay)) {
                    document.body.removeChild(overlay);
                    document.body.style.overflow = 'auto';
                    document.removeEventListener('keydown', keyHandler);
                }
            };

            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                closeOverlay();
            });
            overlay.addEventListener('click', closeOverlay);

            // Append elements
            overlay.appendChild(closeBtn);
            overlay.appendChild(prevBtn);
            overlay.appendChild(nextBtn);
            overlay.appendChild(img);
            document.body.appendChild(overlay);
            document.body.style.overflow = 'hidden';

            document.addEventListener('keydown', keyHandler);
        }
    });
</script>
@endpush
