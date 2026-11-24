@extends('frontend.layout.app')

@section('content')
@section('breadcrumb')
    @include('frontend.layout.partials.breadcrumb', [
        'image' => null,
        'title' => $service->title,
        'links' => [
            [
                'name' => 'Home',
                'url' => route('home'),
            ],
            [
                'name' => 'Services',
                'url' => route('services'),
            ],
            [
                'name' => $service->title,
            ],
        ],
    ])
@endsection
<livewire:frontend.service-details-section :service="$service" />
@endsection
