@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Articles',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Articles',
                'url' => route('dashboard.blogs.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary btn-md">
                    Create new
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.blog-table />
        </div>
    </div>
@endsection
