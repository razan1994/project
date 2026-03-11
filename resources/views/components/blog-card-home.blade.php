<div class="post-item">
    <div class="post-item-wrap">
        <div class="post-image">
            <a href="{{ route('blogs.details', $blog->slug) }}">
                @if (isset($blog->image) && file_exists($blog->image))
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->seo_title_en }}"
                        style="width: 418px; height: 235px; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/images/blog/grid/01.jpg') }}" alt="">
                @endif
            </a>
            {{-- <span class="post-meta-category bg-grad"><a href="#">Blog Image</a></span> --}}
        </div>
        <div class="post-item-desc">
            <span class="post-meta">{{ $blog->created_at->format('d M') }},</span>
            <span class="post-meta"><a href="javascript:(void0);">Admin,</a></span>
            {{-- <span class="post-meta"><a href=""><i class="ti-comment-alt"></i>06 Comments</a></span> --}}
            <h4><a href="{{ route('blogs.details', $blog->slug) }}">{{ $blog->title }}</a></h4>
            <p>{{ Str::limit(strip_tags($blog->description), 200) }}</p>
            <a href="{{ route('blogs.details', $blog->slug) }}" class="item-link mt-auto">Continue reading<i
                    class="ti-minus"></i></a>
        </div>
    </div>
</div>
