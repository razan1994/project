@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update key and goal',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Keys and goals',
                'url' => route('dashboard.our-values.index'),
            ],
            [
                'name' => 'Update [ ' . $ourValue->title_en . ' ] ',
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
                        Edit Value
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.our-values.edit-our-value-form :ourValue="$ourValue" />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
