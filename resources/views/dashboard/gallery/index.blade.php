@extends('admin.layout.app')

@section('breadcrumb')
    @include('admin.layout.partials.page-header', [
        'title' => '',
        'links' => [
            [
                'name' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            [
                'name' => 'Gallery',
                'url' => route('dashboard.gallery.index'),
            ],
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Gallery - Upload Images</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Upload Form -->
            <form action="{{ route('dashboard.gallery.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="images" class="form-label">Images <span class="text-danger">*</span></label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" required>
                    <small class="text-muted">You can select multiple images at once</small>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>

            <hr class="my-4">

            <!-- Display Images -->
            <div class="row g-3">
                @forelse($images as $image)
                    <div class="col-md-4 col-lg-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <form action="{{ route('dashboard.gallery.delete-image', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">No images uploaded yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
