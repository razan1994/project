@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Edit FAQ',
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
                'name' => 'Edit FAQ',
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
                        Edit FAQ
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <livewire:dashboard.faq.edit-faq-form :faq="$faq" />
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
