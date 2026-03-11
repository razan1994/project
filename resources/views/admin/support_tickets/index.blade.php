@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Support Tickets',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Support Tickets',
                'url' => '#',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="row datatable-container">
        <div class="card">
            <div class="card-body">
                <livewire:support-tickets-table />
            </div>
        </div>
    </div>
@endsection
