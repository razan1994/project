@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New Key and goal',
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
                'name' => 'Create New key and goal',
                'url' => route('dashboard.our-values.create'),
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
                    Create New Value
                </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <livewire:dashboard.our-values.create-our-value-form />
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
