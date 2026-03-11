@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create Slider',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Sliders',
                'url' => route('dashboard.sliders.index'),
            ],
            [
                'name' => 'Create Slider',
                'url' => route('dashboard.sliders.create'),
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
                    Create New Slider
                </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <livewire:dashboard.sliders.create-slider-form />
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

