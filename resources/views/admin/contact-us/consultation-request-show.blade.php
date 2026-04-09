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
            <div class="row g-0">

                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Client Name:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->client_name }}</p>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Client Phone:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->contact_number }}</p>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Preferred Time for Communication:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->preferred_time }}</p>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Type of Building:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->building_type }}</p>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Approved Design:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->approved_design }}</p>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Land Area:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->land_area }}</p>
                </div>
                <div class="col-md-4 border p-3 d-flex flex-column">
                    <h4>Construction Area:</h4>
                    <p class="text-muted mb-0 mt-auto">{{ $consultationRequest->construction_area }}</p>
                </div>

                {{-- Attachments Section --}}
                <div class="col-12 border p-3">
                    <h4>Attachments:</h4>
                    @php
                        $attachments = json_decode($consultationRequest->attachments, true) ?? [];
                    @endphp
                    @if(count($attachments) > 0)
                        <div class="row g-3 mt-2">
                            @foreach($attachments as $index => $attachment)
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column">
                                            @php
                                                $filePath = storage_path('app/public/' . $attachment);
                                                $fileExists = file_exists($filePath);
                                                $fileName = basename($attachment);
                                                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                            @endphp

                                            @if($fileExists && $isImage)
                                                <div class="text-center mb-3">
                                                    <img src="{{ asset('storage/' . $attachment) }}"
                                                         alt="Attachment {{ $index + 1 }}"
                                                         class="img-fluid rounded"
                                                         style="max-height: 150px; object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="text-center mb-3">
                                                    <i class="fas fa-file fa-3x text-muted"></i>
                                                </div>
                                            @endif

                                            <p class="text-muted small text-truncate mb-2" title="{{ $fileName }}">
                                                {{ $fileName }}
                                            </p>

                                            <div class="mt-auto">
                                                @if($fileExists)
                                                    <a href="{{ asset('storage/' . $attachment) }}"
                                                       download="{{ $fileName }}"
                                                       class="btn btn-primary btn-sm w-100">
                                                        <i class="fas fa-download me-1"></i> Download
                                                    </a>
                                                @else
                                                    <button class="btn btn-secondary btn-sm w-100" disabled>
                                                        <i class="fas fa-exclamation-triangle me-1"></i> File Not Found
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No attachments available.</p>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection
