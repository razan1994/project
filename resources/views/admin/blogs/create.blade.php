@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New Article',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Articles',
                'url' => route('dashboard.blogs.index'),
            ],
            [
                'name' => 'Create New',
                'url' => route('dashboard.blogs.create'),
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
                    Create New Blog
                </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <livewire:dashboard.blogs.create-blog-form />
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
