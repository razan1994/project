@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => 'Edit Page Design',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Page Design',
                'url' => route('dashboard.pageDesign.index'),
            ],
            [
                'name' => 'Edit Page Design',
                'url' => route('dashboard.pageDesign.edit'),
            ],
        ],
    ])
@endsection

@section('content')
    <form action="{{ route('dashboard.pageDesign.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{-- Name AR --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_ar">Title Ar
                                        <span class="text-danger">
                                            *
                                            @error('title_ar')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" id="title_ar" name="title_ar" required
                                        value="{{ old('title_ar', $pageDesign->title_ar) }}">
                                </div>
                            </div>


                            {{-- Name En --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en">Title En
                                        <span class="text-danger">
                                            *
                                            @error('title_en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="title_en" class="form-control" id="title_en" name="title_en" required
                                        value="{{ old('title_en', $pageDesign->title_en) }}">
                                </div>
                            </div>


                            {{-- Description Ar --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description_ar">Description Ar
                                        <span class="text-danger">
                                            @error('description_ar')
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </span>
                                    </label>
                                    <textarea class="form-control editor" name="description_ar" id="description_ar" rows="3">{{ old('description_ar', $pageDesign->description_ar) }}</textarea>
                                </div>
                            </div>

                            {{-- Description En --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description_en">Description En
                                        <span class="text-danger">
                                            @error('description_en')
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </span>
                                    </label>
                                    <textarea class="form-control editor" name="description_en" id="description_en" rows="3">{{ old('description_en', $pageDesign->description_en) }}</textarea>
                                </div>
                            </div>

                            <hr>

                            {{-- Page Design Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page_design_image"> Image/Video
                                        <span class="text-danger">
                                            @error('image')
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*,video/mp4, video/webm, video/ogg">
                                </div>

                                @if ($pageDesign->image && file_exists($pageDesign->image))
                                    <img src="{{ asset($pageDesign->image) }}" alt="Page Design Image" class="img-fluid"
                                        style="height: 200px; width: 200px; margin-top: 10px;">
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
