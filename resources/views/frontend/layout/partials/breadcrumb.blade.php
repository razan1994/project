<section class="page-hero">
    <div class="container">
        <div class="breadcrumb">
            @foreach ($links as $link)
                @if (!$loop->last)
                    <li>
                        <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                    </li>
                    <span class="breadcrumb-separator">/</span>
                @else
                    <span>{{ $link['name'] }}</span>
                @endif
            @endforeach
        </div>
        <h1>{{ $title ?? '' }}</h1>
        <p class="text-secondary col-lg-7">{{ $intro ?? '' }}</p>
    </div>
</section>
