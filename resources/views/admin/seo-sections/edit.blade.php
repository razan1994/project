@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Update SEO Section',
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
                'name' => 'Update [ ' . $seoSection->title_en . ' ] ',
                'url' => route('dashboard.seo-sections.edit', [
                    'id' => $seoSection->id,
                ]),
            ],
        ],
    ])
@endsection

@section('content')
    <livewire:dashboard.seo-sections.edit-seo-section-form :seo-section="$seoSection" />
@endsection
