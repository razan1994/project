@extends('admin.layout.app')

@section('breadcrumb')
@include('admin.layout.partials.page-header', [
    'title' => 'Edit Our Values',
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
                <a href="{{ route('dashboard.Values.edit') }}" class="btn btn-primary btn-md">
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
                                {!! isset($values->title_en) ? $values->title_en : "<span style='color:red;'>Undefined</span>" !!}
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
                                {!! isset($values->title_ar) ? $values->title_ar : "<span style='color:red;'>Undefined</span>" !!}
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
                                {!! isset($values->description_en) ? $values->description_en : "<span style='color:red;'>Undefined</span>" !!}
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
                                {!! isset($values->description_ar) ? $values->description_ar : "<span style='color:red;'>Undefined</span>" !!}
                            </p>
                        </div>
                    </div>
                    <hr class="w-100">
                </div>

                <div class="col-md-4">
                    <div class="mb-4 card card-mini">
                        @if ($values->values_image && file_exists($values->values_image))
                            <img style="height: 150px" src="{{ asset($values->values_image) }}" width="auto">
                        @else
                            <img style="height: 150px" src="{{ asset('images/default.jpg') }}" width="auto">
                        @endif
                        <span class="p-1 text-center rounded text-light bg-danger">Image</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
