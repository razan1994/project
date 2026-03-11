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
                'url' => route('dashboard.Programs.index'),
            ],
            [
                'name' => $program->title . ' gallery',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4>
                    {{ $program->title }} - Gallery
                </h4>
            </div>
        </div>
        <div class="card-body">
            <livewire:dashboard.programs.program-gallery :program="$program" />
        </div>
    </div>
@endsection
