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
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.projects.create') }}" class="btn btn-primary btn-md">
                    Create New Project
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.projects-table />
        </div>
    </div>

    {{-- Project SEO Modal --}}
    <div class="modal fade" id="projectSeoModal" tabindex="-1" aria-labelledby="projectSeoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="projectSeoModalLabel">Project SEO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <livewire:dashboard.projects.project-seo />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openProjectSeoModal', (event) => {
                new bootstrap.Modal(document.getElementById('projectSeoModal')).show();
                Livewire.dispatch('setProjectSeo', event[0]);
            });

            Livewire.on('closeProjectSeoModal', () => {
                bootstrap.Modal.getInstance(document.getElementById('projectSeoModal')).hide();
            });
        });
    </script>
@endpush
