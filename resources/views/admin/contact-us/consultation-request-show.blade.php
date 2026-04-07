@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Consultation Request Show',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Contact Us',
                'url' => route('dashboard.contactUs.index'),
            ],
            [
                'name' => 'Consultation Requests',
                'url' => route('dashboard.contactUs.consultation-requests'),
            ],
            [
                'name' => 'Show',
                'url' => route('dashboard.contactUs.consultation-request-show', $consultationRequest->id),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Consultation Request Show</h3>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-4 border p-3">
                    <h4>Client Name:</h4>
                    <p class="text-muted">{{ $consultationRequest->client_name }}</p>
                </div>
                <div class="col-md-4 border p-3">
                    <h4>Client Phone:</h4>
                    <p class="text-muted">{{ $consultationRequest->contact_number }}</p>
                </div>
                <div class="col-md-4 border p-3">
                    <h4>Preferred Time for Communication:</h4>
                    <p class="text-muted">{{ $consultationRequest->preferred_time }}</p>
                </div>
                <div class="col-md-4 border p-3">
                    <h4>Type of Building:</h4>
                    <p class="text-muted">{{ $consultationRequest->building_type }}</p>
                </div>
                <div class="col-md-4 border p-3">
                    <h4>Approved Design:</h4>
                    <p class="text-muted">{{ $consultationRequest->approved_design }}</p>
                </div>
                <div class="col-md-4 border p-3">
                    <h4>Land Area:</h4>
                    <p class="text-muted">{{ $consultationRequest->land_area }}</p>
                </div>
                <div class="col-md-4 border p-3">
                    <h4>Construction Area:</h4>
                    <p class="text-muted">{{ $consultationRequest->construction_area }}</p>
                </div>

            </div>

        </div>
    </div>
@endsection
