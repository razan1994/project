@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'SEO Sections',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'SEO Sections',
                'url' => route('dashboard.seo-sections.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.seo-sections.create') }}" class="btn btn-primary btn-md">
                    Create new
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.seo-sections-table />
        </div>
    </div>


@endsection
