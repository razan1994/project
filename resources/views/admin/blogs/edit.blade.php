@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update Article',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Articles',
                'url' => route('dashboard.blogs.index'),
            ],
            [
                'name' => 'Update [ ' . $blog->title_en . ' ] ',
                'url' => route('dashboard.blogs.create'),
            ],
        ],
    ])
@endsection

@section('content')
    <livewire:dashboard.blogs.edit-blog-form :blog="$blog" />
@endsection
