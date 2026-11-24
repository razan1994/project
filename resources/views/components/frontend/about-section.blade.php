<section class="section section-soft">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                @if (isset($aboutUs->about_us_image) && file_exists($aboutUs->about_us_image))
                    <img src="{{ asset($aboutUs->about_us_image) }}" alt="{{ $aboutUs->title }}"
                        class="img-fluid rounded rounded-4 shadow">
                @else
                    <div class="cover-art"><i class="bi bi-stars"></i></div>
                @endif
            </div>
            <div class="col-lg-6 reveal"><span class="eyebrow" data-i18n="featured">A little about Armada</span>
                <h2 class="display-5 fw-bold mt-3">
                    {{ $aboutUs->title ?? 'A digital partner built around your ambition.' }}</h2>
                <div class="text-secondary lh-lg mt-3">
                    {!! $aboutUs->description ?? '' !!}</div><a class="btn btn-armada mt-3" href="{{ route('about-us') }}"
                    data-i18n="learn_more">Learn
                    more</a>
            </div>
        </div>
    </div>
</section>
