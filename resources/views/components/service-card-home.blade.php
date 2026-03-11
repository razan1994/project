<div class="col-md-4 mt-30">
    <div class="feature-box f-style-2 icon-grad h-100">
        <div class="feature-box-icon">
            @if (isset($service->image) && file_exists($service->image))
                <img src="{{ asset($service->image) }}" alt=""
                    style="width: 72px; height: 72px; object-fit: cover;">
            @else
                <i class="ti-save-alt"></i>
            @endif
        </div>
        <h3 class="feature-box-title">{{ $service->title }}</h3>
        <div class="feature-box-desc">{!! Str::limit(strip_tags($service->description), 150) !!}</div>
        <a class="mt-3" href="{{ route('services.details', $service->slug) }}">Know more!</a>
    </div>
</div>
