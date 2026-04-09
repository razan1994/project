@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Categories',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Categories',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary btn-md">
                    Create New Category
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.categories-table />
        </div>
    </div>
@endsection
