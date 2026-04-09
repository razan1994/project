@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update Category',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Categories',
                'url' => route('dashboard.categories.index'),
            ],
            [
                'name' => 'Edit Category',
            ],
        ],
    ])
@endsection

@section('content')
    <livewire:dashboard.categories.edit-category-form :category='$category' />
@endsection
