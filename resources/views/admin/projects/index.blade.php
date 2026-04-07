@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Projects',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Projects',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary btn-md">
                    Create New Project
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.projects-table />
        </div>
    </div>
@endsection
