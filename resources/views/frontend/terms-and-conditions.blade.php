@extends('frontend.layout.app')

@section('content')
@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => 'Terms and Conditions',
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'Terms and Conditions',
            ],
        ],
    ])
@endsection
<livewire:frontend.terms-and-conditions-page-section />
@endsection
