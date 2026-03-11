<div class="widget-post clearfix">
    <div class="widget-image">
        @if (isset($blog->image) && file_exists($blog->image))

        <img class="rounded" src="{{asset($blog->image)}}" alt="" style="width: 60px; height: 51px; object-fit: cover;">
        @else
        <img class="rounded" src="{{asset('assets/images/thumbnails/01.jpg')}}" alt="">

        @endif
    </div>
    <div class="details">
        <a href="{{route('blogs.details', $blog->slug)}}">{{Str::limit($blog->title, 32)}}</a>
        <p class="date">{{ $blog->created_at->format('M d, Y') }}</p>
    </div>
</div>
