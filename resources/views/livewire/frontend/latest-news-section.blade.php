<div class="dextheme-section-11 dextheme-section-padding bg-light">
    <div class="dextheme-container">
        <div class="block-heading text-center mb-4">
            <p class="dextheme-sub-title mb-4">Latest News</p>
            <h2 class="dextheme-main-title dextheme-w-60 mx-auto mb-4">Breaking Ground with the Latest Updates.</h2>
            <p class="plain-text dextheme-w-75 mx-auto">
                Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam euismod, risus non molestie elementum,
                metus urna ullamcorper justo, quis vulputate nulla ante condimentum.
            </p>
        </div>

        <div class="dextheme-row g-4 mt-4">
            @forelse ($blogs as $blog)
                <div class="dextheme-blog-card dextheme-col-lg-4 dextheme-col-12">
                    <div class="dextheme-card border-0 shadow-lg bg-white">
                        <div class="img-wrapper">
                            <img src="{{ $blog->image ? asset($blog->image) : asset('assets/images/400x350.png') }}" alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover; aspect-ratio: 16/10;">
                        </div>
                        <div class="dextheme-card__body">
                            <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                                <div class="meta-date">
                                    <i aria-hidden="true" class="icon icon-calendar3"></i>
                                    <span>{{ $blog->created_at?->format('F d, Y') }}</span>
                                </div>
                            </div>
                            <h5 class="dextheme-card__title">{{ $blog->title }}</h5>
                            <p class="dextheme-card__text">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 180) }}
                            </p>
                            <button class="dextheme-btn btn-primary hover-bg-white">
                                View More
                                <i aria-hidden="true" class="icon icon-right-arrow"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="dextheme-blog-card dextheme-col-lg-4 dextheme-col-12">
                    <div class="dextheme-card border-0 shadow-lg bg-white">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/images/400x350.png') }}" alt="news" style="width: 100%; height: 250px; object-fit: cover; aspect-ratio: 16/10;">
                        </div>
                        <div class="news-category bg-primary">
                            Construction Site Safety and Process
                        </div>
                        <div class="dextheme-card__body">
                            <div class="dextheme-flex gap-3 align-items-center mb-3 meta-news">
                                <div class="meta-date">
                                    <i aria-hidden="true" class="icon icon-calendar3"></i>
                                    <span>February 17, 2024</span>
                                </div>
                                <div class="meta-comment">
                                    <i aria-hidden="true" class="icon icon-comment"></i>
                                    <span>0</span>
                                </div>
                            </div>
                            <h5 class="dextheme-card__title">From Blueprint to Reality: Exploring the Construction...</h5>
                            <p class="dextheme-card__text">
                                Praesent tellus arcu, hendrerit id est sed, pellentesque euismod nunc. Nullam sed ante fringilla.
                            </p>
                            <button class="dextheme-btn btn-primary hover-bg-white">
                                View More
                                <i aria-hidden="true" class="icon icon-right-arrow"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
