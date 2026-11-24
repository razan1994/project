@extends('frontend.layout.app')

@section('content')

@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => 'Blog',
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'Blog',
            ],
        ],
    ])
@endsection
<section class="section">
    <div class="container">
        <div class="row g-4">
            @forelse ($blogs as $blog)
                <x-frontend.blogs.blog-card :blog="$blog" />
            @empty
                <div class="col-12">
                    <p class="p-3 rounded bg-warning text-danger">No blogs available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
