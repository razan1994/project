@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update Sub Service',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Sub Services',
                'url' => route('dashboard.sub-services.index'),
            ],
            [
                'name' => 'Edit Sub Service',
            ],
        ],
    ])
@endsection

@section('content')
    <livewire:dashboard.sub-services.edit-service-form :sub-service='$subService' />
@endsection
