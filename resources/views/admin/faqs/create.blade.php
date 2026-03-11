@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New FAQs',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'FAQs',
                'url' => route('dashboard.faq.index'),
            ],
            [
                'name' => 'Create New',
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
                        Create New FAQ
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.faq.create-faq-form />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
