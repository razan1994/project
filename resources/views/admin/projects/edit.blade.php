@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update Project',
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
                'name' => 'Edit Project',
            ],
        ],
    ])
@endsection

@section('content')
    <livewire:dashboard.projects.edit-project-form :project='$project' />
@endsection
