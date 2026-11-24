<article>
    <section class="section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal visible">
                    @if (isset($about->about_us_image) && file_exists($about->about_us_image))
                    <img src="{{ asset($about->about_us_image) }}" alt="{{ $about->title }}" class="img-fluid rounded rounded-4 shadow">
                    @else
                    <div class="cover-art"><i class="bi bi-stars"></i></div>
                    @endif
                </div>
                <div class="col-lg-6 reveal visible"><span class="eyebrow" data-i18n="featured">A little about
                        Armada</span>
                    <h2 class="display-5 fw-bold mt-3">{{$about->title}}.</h2>
                    <div>{!! $about->description !!}</div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-soft">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box"><i class="bi bi-bullseye"></i></div>
                        <h3 data-i18n="page_mission">Our Mission</h3>
                        <div>{!! $mission->description !!}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box"><i class="bi bi-eye"></i></div>
                        <h3 data-i18n="page_vision">Our Vision</h3>
                        <div>{!! $vision->description !!}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box"><i class="bi bi-heart"></i></div>
                        <h3 data-i18n="page_values">Our Values</h3>
                        <div>{!! $value->description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>
