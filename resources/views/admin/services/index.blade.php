@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Services',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Services',
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.Services.create') }}" class="btn btn-primary btn-md">
                    Create New Service
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.service-table />
        </div>
    </div>

    {{-- Service SEO Modal --}}
    <div class="modal fade" id="serviceSeoModal" tabindex="-1" aria-labelledby="serviceSeoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="serviceSeoModalLabel">Service SEO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <livewire:dashboard.services.service-seo />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openServiceSeoModal', (event) => {
                new bootstrap.Modal(document.getElementById('serviceSeoModal')).show();
                Livewire.dispatch('setServiceSeo', event[0]);
            });

            Livewire.on('closeServiceSeoModal', () => {
                bootstrap.Modal.getInstance(document.getElementById('serviceSeoModal')).hide();
            });
        });
    </script>
@endpush
