@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update Service',
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
                'name' => 'Edit Service',
            ],
        ],
    ])
@endsection

@section('content')
    <livewire:dashboard.services.edit-service-form :service='$service' /> 
@endsection
