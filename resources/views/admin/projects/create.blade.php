@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New Project',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Projects',
                'url' => route('dashboard.projects.index'),
            ],
            [
                'name' => 'Create New',
                'url' => route('dashboard.projects.create'),
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
                        Create New Project
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.projects.create-project-form />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
