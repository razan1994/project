@extends('frontend.layout.app')

@section('content')
@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => 'Privacy Policy',
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'Privacy Policy',
            ],
        ],
    ])
@endsection
<livewire:frontend.privacy-policy-page-section />
@endsection
