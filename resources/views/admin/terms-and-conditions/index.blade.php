@extends('admin.layout.app')

@section('breadcrumb')
@include('admin.layout.partials.page-header', [
    'title' => 'Terms and Conditions',
    'links' => [
        [
            'name' => 'Dashboard',
            'url' => route('dashboard'),
        ],
    ],
])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard.termsAndConditions.edit') }}" class="btn btn-primary btn-md">
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
                                {!! isset($terms->title_en) ? $terms->title_en : "<span style='color:red;'>Undefined</span>" !!}
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
                                {!! isset($terms->title_ar) ? $terms->title_ar : "<span style='color:red;'>Undefined</span>" !!}
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
                                {!! isset($terms->description_en) ? $terms->description_en : "<span style='color:red;'>Undefined</span>" !!}
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
                                {!! isset($terms->description_ar) ? $terms->description_ar : "<span style='color:red;'>Undefined</span>" !!}
                            </p>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>
            </div>
        </div>
    </div>
@endsection
