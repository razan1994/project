@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Keys and goals',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Keys and goals',
                'url' => route('dashboard.our-values.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.our-values.create') }}" class="btn btn-primary btn-md">
                    Create new
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.our-values-table />
        </div>
    </div>
@endsection
