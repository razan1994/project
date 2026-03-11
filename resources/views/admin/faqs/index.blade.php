@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'FAQs',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'FAQs',
                'url' => route('dashboard.faq.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.faq.create') }}" class="btn btn-primary btn-md">
                    Create new
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.faq-table />
        </div>
    </div>
@endsection
