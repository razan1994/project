@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'About Us',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'About Us',
                'url' => route('dashboard.aboutUs.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.aboutUs.edit') }}" class="btn btn-primary btn-md">
                    Edit
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex justify-content-center ">
                        <div class="pb-4 text-center">
                            <h3 class="pb-2 text-dark">Title EN</h3>
                            <p class="text-dark">
                                {!! isset($about->title_en) ? $about->title_en : "<span style='color:red;'>Undefined</span>" !!}
                            </p>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-center ">
                        <div class="pb-4 text-center">
                            <h3 class="pb-2 text-dark">Title AR</h3>
                            <p class="text-dark">
                                {!! isset($about->title_ar) ? $about->title_ar : "<span style='color:red;'>Undefined</span>" !!}
                            </p>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-center ">
                        <div class="pb-4 text-center">
                            <h3 class="pb-2 text-dark">Description EN</h3>
                            <p class="text-dark">
                                {!! isset($about->description_en) ? $about->description_en : "<span style='color:red;'>Undefined</span>" !!}
                            </p>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-center ">
                        <div class="pb-4 text-center">
                            <h3 class="pb-2 text-dark">Description AR</h3>
                            <p class="text-dark">
                                {!! isset($about->description_ar) ? $about->description_ar : "<span style='color:red;'>Undefined</span>" !!}
                            </p>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>

                <div class="col-md-4">
                    <div class="mb-4 card card-mini">
                        @if ($about->about_us_image && file_exists($about->about_us_image))
                            <img style="height: 150px" src="{{ asset($about->about_us_image) }}" width="auto">
                        @else
                            <img style="height: 150px" src="{{ asset('images/default.jpg') }}" width="auto">
                        @endif
                        <span class="p-1 text-center rounded text-light bg-danger">About Us Image</span>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
