@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Contact Us Requests',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Contact Us',
                'url' => route('dashboard.contactUs.index'),
            ],
            [
                'name' => 'Phones',
                'url' => route('dashboard.contactUs.contact-us-requests'),
            ],
        ],
    ])
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard.contactUs.edit') }}" class="btn btn-primary btn-md">
                Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">

            <livewire:tables.contact-us-requests-table/>

        </div>
    </div>
</div>
@endsection
