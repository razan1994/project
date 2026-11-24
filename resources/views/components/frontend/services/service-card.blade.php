<div class="col-md-6 col-xl-4 reveal">
    <article class="service-card">
        <div class="icon-box"><i class="bi bi-code-slash"></i></div>
        <h3>{{ $service->title }}</h3>
        <p>{!! $service->description !!}</p>
        <a class="text-link" href="{{ route('services.details', $service->slug) }}"><span data-i18n="learn_more">Learn
                more</span> <i class="bi bi-arrow-up-right"></i></a>
    </article>
</div>
