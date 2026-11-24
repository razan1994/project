@extends('frontend.layout.app')

@section('content')
@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => 'Services',
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'Services',
            ],
        ],
    ])
@endsection
<livewire:frontend.services-page-section />

@endsection
