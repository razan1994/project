@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Consultation Requests',
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
                'name' => 'Consultation Requests',
                'url' => route('dashboard.contactUs.consultation-requests'),
            ],
        ],
    ])
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Consultation Requests</h3>
    </div>
    <div class="card-body">
        <div class="row">

            <livewire:tables.consultations-table />

        </div>
    </div>
</div>
@endsection
