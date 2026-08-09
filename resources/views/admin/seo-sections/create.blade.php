@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Create New SEO Section',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'SEO Sections',
                'url' => route('dashboard.seo-sections.index'),
            ],
            [
                'name' => 'Create New',
                'url' => route('dashboard.seo-sections.create'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        Create New SEO Section
                    </h3>
                </div>

                <livewire:dashboard.seo-sections.create-seo-section-form />

            </div>

        </div>
    </div>
@endsection
