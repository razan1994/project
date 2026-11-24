@extends('frontend.layout.app')

@section('content')
@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => 'About Us',
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'About Us',
            ],
        ],
    ])
@endsection
<livewire:frontend.about-us-section />
@endsection
