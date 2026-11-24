<section class="section">
    <div class="container">
        <div class="section-heading reveal"><span class="eyebrow" data-i18n="eyebrow">WHAT WE DO</span>
            <h2 data-i18n="services_title">Digital solutions, thoughtfully made.</h2>
            <p data-i18n="services_desc">From the first idea to the final launch, we bring strategy, design and
                technology together.</p>
        </div>
        <div class="row g-4">
            @forelse ($services as $service)
                <x-frontend.services.service-card :service="$service" />
            @empty
                <div class="col-12">
                    <p class="p-3 rounded bg-warning text-danger">No services available at the moment.</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-5"><a href="{{ route('services') }}" class="btn btn-outline-armada">Explore all
                services</a></div>
    </div>
</section>
