@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Articles',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Articles',
                'url' => route('dashboard.blogs.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary btn-md">
                    Create new
                </a>
            </div>
        </div>
        <div class="card-body">
            <livewire:tables.blog-table />
        </div>
    </div>

    {{-- Blog SEO Modal --}}
    <div class="modal fade" id="blogSeoModal" tabindex="-1" aria-labelledby="blogSeoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="blogSeoModalLabel">Article SEO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <livewire:dashboard.blogs.blog-seo />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openBlogSeoModal', (event) => {
                new bootstrap.Modal(document.getElementById('blogSeoModal')).show();
                Livewire.dispatch('setBlogSeo', event[0]);
            });

            Livewire.on('closeBlogSeoModal', () => {
                bootstrap.Modal.getInstance(document.getElementById('blogSeoModal')).hide();
            });
        });
    </script>
@endpush
