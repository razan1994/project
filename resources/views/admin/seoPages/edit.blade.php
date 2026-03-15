@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Edit SEO Page - '.$seoPage->name,
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'SEO Pages',
                'url' => route('dashboard.seo-pages.index'),
            ],
            [
                'name' => 'Edit SEO Page - '.$seoPage->name,
                'url' => route('dashboard.seo-pages.edit', $seoPage->id),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <livewire:dashboard.seo-pages.edit-seo-page-form :seoPage="$seoPage" />
        </div>
    </div>
@endsection