<div class="dextheme-section-11 dextheme-section-padding bg-light">
    <div class="dextheme-container">
        <div class="block-heading text-center mb-4">
            <p class="dextheme-sub-title mb-4">{{ __('frontend.news_subtitle') }}</p>
            <h2 class="dextheme-main-title dextheme-w-60 mx-auto mb-4">{{ __('frontend.news_title') }}</h2>
            <p class="plain-text dextheme-w-75 mx-auto">
                {{ __('frontend.news_desc') }}
            </p>
        </div>

        <div class="dextheme-row g-4 mt-4">
            @forelse ($blogs as $blog)
                <div class="dextheme-blog-card dextheme-col-lg-4 dextheme-col-12">
                    <div class="dextheme-card border-0 border-bottom border-4 shadow-lg bg-white" style="border-image: linear-gradient(90deg, #b07f47 0%, #8b6033 100%) 1 !important; border-color: transparent;">
                        <div class="img-wrapper">
                            <img src="{{ $blog->image ? asset($blog->image) : asset('assets/images/400x350.png') }}" alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover; aspect-ratio: 16/10;">
                        </div>
                        <div class="dextheme-card__body">
                            <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                                <div class="meta-date">
                                    <i aria-hidden="true" class="icon icon-calendar3"></i>
                                    <span>{{ $blog->created_at?->locale(app()->getLocale())->translatedFormat('F d, Y') }}</span>
                                </div>
                            </div>
                            <h5 class="dextheme-card__title">{{ $blog->title }}</h5>
                            <p class="dextheme-card__text">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 150) }}
                            </p>
                            <a href="{{ route('blogs.details', $blog->slug) }}" class="dextheme-btn btn-primary hover-bg-white">
                                {{ __('frontend.news_view_more') }}
                                <i aria-hidden="true" class="icon icon-right-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="dextheme-blog-card dextheme-col-lg-4 dextheme-col-12">
                    <div class="dextheme-card border-0 border-bottom border-4 shadow-lg bg-white" style="border-image: linear-gradient(90deg, #b07f47 0%, #8b6033 100%) 1 !important; border-color: transparent;">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/images/400x350.png') }}" alt="news" style="width: 100%; height: 250px; object-fit: cover; aspect-ratio: 16/10;">
                        </div>
                        <div class="news-category bg-primary">
                            {{ __('frontend.news_default_category') }}
                        </div>
                        <div class="dextheme-card__body">
                            <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                                <div class="meta-date">
                                    <i aria-hidden="true" class="icon icon-calendar3"></i>
                                    <span>{{ __('frontend.news_default_date') }}</span>
                                </div>
                                <div class="meta-comment">
                                    <i aria-hidden="true" class="icon icon-comment"></i>
                                    <span>{{ __('frontend.news_default_comments') }}</span>
                                </div>
                            </div>
                            <h5 class="dextheme-card__title">{{ __('frontend.news_default_title') }}</h5>
                            <p class="dextheme-card__text">
                                {{ __('frontend.news_default_desc') }}
                            </p>
                            <button class="dextheme-btn btn-primary hover-bg-white">
                                {{ __('frontend.news_view_more') }}
                                <i aria-hidden="true" class="icon icon-right-arrow"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
