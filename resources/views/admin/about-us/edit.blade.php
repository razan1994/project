@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Edit About Us',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'About Us',
                'url' => route('dashboard.aboutUs.index'),
            ],
            [
                'name' => 'Edit About Us',
                'url' => route('dashboard.aboutUs.edit'),
            ],
        ],
    ])
@endsection

@section('content')
    <form action="{{ route('dashboard.aboutUs.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            {{-- Title AR --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title Ar
                                        <span class="text-danger">
                                            *
                                            @error('title_ar')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>

                                    <input type="text" class="form-control" name="title_ar" required
                                        value="{{ old('title_ar', $about->title_ar) }}">

                                </div>
                            </div>


                            {{-- Title EN --}}
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Title En
                                        <span class="text-danger">
                                            *
                                            @error('title_en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>

                                    <input type="text" class="form-control" name="title_en" required
                                        value="{{ old('title_en', $about->title_en) }}">

                                </div>
                            </div>


                            {{-- Description AR --}}
                            <div class="col-12">
                                <div class="form-group">

                                    <label>About Us Ar

                                        <span class="text-danger">
                                            @error('description_ar')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </span>

                                    </label>

                                    <textarea class="form-control" name="description_ar" id="description_ar" rows="5">{{ old('description_ar', $about->description_ar) }}</textarea>

                                </div>
                            </div>


                            {{-- Description EN --}}
                            <div class="col-12">
                                <div class="form-group">

                                    <label>About Us En

                                        <span class="text-danger">
                                            @error('description_en')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </span>

                                    </label>

                                    <textarea class="form-control" name="description_en" id="description_en" rows="5">{{ old('description_en', $about->description_en) }}</textarea>

                                </div>
                            </div>

                            <hr>


                            {{-- Image / Video --}}
                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>About Us Image / Video

                                        <span class="text-danger">
                                            @error('about_us_image')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </span>

                                    </label>

                                    <input type="file" class="form-control" name="about_us_image"
                                        accept="image/*,video/mp4">

                                </div>

                                @if ($about->about_us_image)
                                    <img src="{{ asset($about->about_us_image) }}" class="img-fluid"
                                        style="height:200px;width:200px;margin-top:10px;">
                                @endif

                            </div>

                        </div>
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>

                </div>

            </div>
        </div>

    </form>
@endsection


@push('scripts')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description_ar'), {
                language: 'ar'
            })
            .catch(error => {
                console.error(error);
            });


        ClassicEditor
            .create(document.querySelector('#description_en'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
