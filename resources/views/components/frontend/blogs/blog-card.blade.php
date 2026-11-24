<div class="col-md-6 col-lg-4 reveal visible">
    <article class="post-card">
        @if (isset($blog->image) && file_exists($blog->image))
            <div class="blog-art">
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 345px; height: 190px; object-fit: cover;" class="rounded rounded-5">
            </div>
        @else
            <div class="blog-art"><i class="bi bi-journal-code"></i></div>
        @endif
        <span class="tag">DIGITAL
            INSIGHTS</span>
        <div class="post-meta"><span>{{ $blog->created_at->format('M d, Y') }}</span></div>
        <h3 data-i18n="blog_detail_title">{{ $blog->title }}</h3>
        <div>{!! $blog->description !!}</div>
        <a class="text-link" href="{{ route('blogs.details', $blog->slug) }}">Read article</a>
    </article>
</div>
