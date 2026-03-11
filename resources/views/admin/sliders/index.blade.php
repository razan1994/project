@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Sliders',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Sliders',
                'url' => route('dashboard.sliders.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.sliders.create') }}" class="btn btn-primary btn-md">
                    Create
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <livewire:tables.sliders-table />
               
            </div>
        </div>
    </div>
@endsection
