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
    <form action="{{ route('dashboard.Values.update') }}" method="POST" enctype="multipart/form-data">
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
                                        value="{{ old('title_ar', $values->title_ar) }}">
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
                                        value="{{ old('title_en', $values->title_en) }}">
                                </div>
                            </div>


                            {{-- AboutUs Ar --}}
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
                                    <textarea class="form-control editor" name="description_ar" id="description_ar" rows="3">{{ old('description_ar', $values->description_ar) }}</textarea>
                                </div>
                            </div>

                            {{-- AboutUs En --}}
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
                                    <textarea class="form-control editor" name="description_en" id="description_en" rows="3">{{ old('description_en', $values->description_en) }}</textarea>
                                </div>
                            </div>

                            <hr>

                            {{-- AboutUs Image --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="values_image">Image
                                        <span class="text-danger">
                                            @error('values_image')
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </span>
                                    </label>
                                    <input type="file" class="form-control" id="values_image" name="values_image"
                                        accept="image/*">
                                </div>

                                @if ($values->values_image && file_exists($values->values_image))
                                    <img src="{{ asset($values->values_image) }}" alt=" Image" class="img-fluid"
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
    <script>
        ClassicEditor
            .create(document.querySelector('#description_ar'))
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
