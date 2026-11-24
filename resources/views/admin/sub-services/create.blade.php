@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New Sub Service',
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
                'name' => 'Create New',
                'url' => route('dashboard.sub-services.create'),
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
                        Create New Sub Service
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.sub-services.create-sub-service-form />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
