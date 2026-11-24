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
                'url' => route('dashboard.Services.index'),
            ],
            [
                'name' => $service->title . ' gallery',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4>
                    {{ $service->title }} - Gallery
                </h4>
            </div>
        </div>
        <div class="card-body">
            <livewire:dashboard.services.service-gallery :service="$service" />
        </div>
    </div>
@endsection
