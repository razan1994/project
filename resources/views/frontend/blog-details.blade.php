@extends('frontend.layout.app')

@section('content')
@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => $blog->title,
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'Blogs',
                'url' => route('blogs'),
            ],
            [
                'name' => $blog->title,
            ],
        ],
    ])
@endsection
<section class="section">
    <div class="container">
        <div class="content-wrap mx-auto">
            @if (isset($blog->image) && file_exists($blog->image))
                <div class="cover-art mb-4">
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                </div>
            @else
                <div class="cover-art mb-4"><i class="bi bi-journal-richtext"></i></div>
            @endif
            <div class="post-meta"><span>{{ $blog->created_at->format('F d, Y') }}</span><span>Web Development</span>
            </div>
            <h2 class="display-5 fw-bold">{{ $blog->title }}</h2>
            <div>{!! $blog->description !!}</div>
            <div class="p-4 rounded-4 mt-5" style="background:var(--paper)">
                <h4 class="fw-bold">Ready to improve your digital presence?</h4><a href="{{ route('contact-us') }}"
                    class="text-link">Talk to Armada <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>
    </div>
</section>
@endsection
