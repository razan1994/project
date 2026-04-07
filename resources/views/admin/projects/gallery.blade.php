@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Projects',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Projects',
                'url' => route('dashboard.projects.index'),
            ],
            [
                'name' => $project->title . ' gallery',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4>
                    {{ $project->title }} - Gallery
                </h4>
            </div>
        </div>
        <div class="card-body">
            <livewire:dashboard.projects.project-gallery :project="$project" />
        </div>
    </div>
@endsection
