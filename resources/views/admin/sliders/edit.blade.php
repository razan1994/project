@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Edit Slider',
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
                'name' => 'Edit Slider',
                'url' => route('dashboard.sliders.edit', $slider->id),
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
                        Edit Slider
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.sliders.edit-slider-form :slider="$slider" />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
