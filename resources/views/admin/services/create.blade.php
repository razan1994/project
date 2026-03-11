@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New Service',
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
                'name' => 'Create New',
                'url' => route('dashboard.Services.create'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Create New Service
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.services.create-service-form />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
