<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if (isset($service->image) && file_exists($service->image))
                    <div class="cover-art mb-4">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                    </div>
                @else
                    <div class="cover-art mb-4"><i class="bi bi-code-slash"></i></div>
                @endif
                <span class="tag">DIGITAL
                    SOLUTIONS</span>
                <h2 class="display-5 fw-bold mt-3">{{ $service->title }}</h2>
                <div>{!! $service->description !!}</div>
                <a href="{{ route('contact-us') }}" class="btn btn-armada mt-3">Get a quote</a>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <h4 class="fw-bold">Need this service?</h4>
                    <p class="text-secondary">Tell us about your goals and get a tailored proposal.</p><a
                        href="{{ route('contact-us') }}" class="btn btn-armada w-100">Request a quote</a>
                </div>
            </div>
        </div>
    </div>
</section>
