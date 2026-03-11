@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Services',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Services',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.Services.create') }}" class="btn btn-primary btn-md">
                    Create New Service
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.service-table />
        </div>
    </div>
@endsection
