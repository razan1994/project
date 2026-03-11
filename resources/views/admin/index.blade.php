@extends('admin.layout.app')

@push('styles')
    <style>
        .dashboard-card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            opacity: 0.7;
        }

        .stats-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
    </style>
@endpush

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => ' Welcome, ' . auth()->user()->name,
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
        ],
    ])
@endsection

@section('content')
    Holla Back
@endsection
