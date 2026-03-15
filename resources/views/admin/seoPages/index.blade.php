@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'SEO Pages',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'SEO Pages',
                'url' => route('dashboard.seo-pages.index')
            ],
        ],
    ])
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center">
            {{-- <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary btn-md"> --}}
                SEO Pages
            {{-- </a> --}}
        </div>
    </div>
    <div class="card-body">
        <livewire:tables.seo-pages-table />
    </div>
</div>
@endsection
