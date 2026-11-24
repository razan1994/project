<section class="section">
    <div class="container">
        <div class="row g-4">
            @forelse ($services as $service)
                <x-frontend.services.service-card :service="$service" />
            @empty
                <div class="col-12">
                    <p class="p-3 rounded bg-warning text-danger">No service available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
