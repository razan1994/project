<?php

use Livewire\Component;
use App\Models\GalleryImage;
use App\Traits\UploadImageTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Spatie\LivewireFilepond\WithFilePond;

new class extends Component {

    use WithFilePond;
    use UploadImageTrait;

    public $gallery;
    public $images = [];
    public $caption = '';

    public function rules()
    {
        return [
            'images' => 'nullable',
            'images.*' => 'image|max:10240', // 10MB max per image
            'caption' => 'nullable|string|max:255',
        ];
    }

    public function mount($gallery)
    {
        $this->gallery = $gallery;
    }

    #[Computed]
    #[On('refreshGalleryImages')]
    public function galleryImages()
    {
        return $this->gallery->images;
    }

    public function deleteImage($id)
    {
        $image = GalleryImage::find($id);
        if (!$image || $image->gallery_id != $this->gallery->id) {
            return;
        }

        // Delete the physical file
        $fullPath = public_path('storage/' . $image->image_path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        $image->delete();
        $this->dispatch('refreshGalleryImages');
        $this->dispatch('success', 'Image deleted successfully');
    }

    public function save()
    {
        $this->validate($this->rules());

        $images = is_array($this->images)
            ? array_values(array_filter($this->images))
            : ($this->images ? [$this->images] : []);

        // =======================================
        // ---------- save images ------------
        if (!empty($images)) {
            foreach ($images as $image) {
                $path = $this->saveImage($image, "storage/gallery/{$this->gallery->id}");

                GalleryImage::create([
                    'gallery_id' => $this->gallery->id,
                    'image_path' => str_replace('storage/', '', $path),
                    'caption' => $this->caption,
                ]);
            }

            $this->dispatch('success', 'Images added successfully');
        }

        $this->reset('images', 'caption');
        $this->dispatch('refreshGalleryImages');

        return redirect()->route('dashboard.gallery.edit', $this->gallery->id);
    }
};
?>

<div>
    <form wire:submit.prevent='save' enctype="multipart/form-data">
        <div class="row">

            {{-- Image --}}
            <div class="col-md-8">
                <div class="form-group">
                    <label for="images">Images
                        <span class="text-danger">*</span>
                    </label>
                    <input type="file" id="images" class="form-control" wire:model="images" accept="image/*"
                        multiple>
                    @error('images')
                        <div class="text-danger" style="font-size: 12px">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('images.*')
                        <div class="text-danger" style="font-size: 12px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div wire:loading wire:target="images">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Uploading images...
                    </div>
                </div>
            </div>

            {{-- Caption --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="caption">Caption (Optional)</label>
                    <input type="text" id="caption" class="form-control" wire:model="caption"
                        placeholder="Enter image caption">
                    @error('caption')
                        <div class="text-danger" style="font-size: 12px">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- submit button --}}
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                    wire:loading.class="btn-secondary" wire:target="save,images">
                    <span wire:loading.remove wire:target="save,images">Upload</span>
                    <span wire:loading wire:target="save,images">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Uploading...
                    </span>
                </button>
            </div>
        </div>
    </form>

    <hr class="my-4">

    {{-- Gallery Images Grid --}}
    <div class="row" wire:loading.remove wire:target="galleryImages">
        @forelse ($this->galleryImages as $image)
            <div class="col-6 col-md-4 col-lg-3 mb-4" wire:key="{{ $image->id }}">
                <div class="card h-100">
                    <div class="card-body p-2"
                        style="height: 200px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            class="img-fluid"
                            alt="{{ $image->caption ?? 'Gallery image' }}"
                            style="object-fit: cover; width: 100%; height: 100%; cursor: pointer;"
                            onclick="window.open('{{ asset('storage/' . $image->image_path) }}', '_blank')">
                    </div>
                    @if($image->caption)
                        <div class="card-body py-2 px-3">
                            <p class="card-text mb-0 text-muted" style="font-size: 12px;">{{ $image->caption }}</p>
                        </div>
                    @endif
                    <div class="card-footer p-2 d-flex justify-content-center">
                        <button class="btn btn-danger btn-sm" wire:click="deleteImage({{ $image->id }})"
                            wire:confirm="Are you sure you want to delete this image?" wire:loading.attr="disabled">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-images fa-3x mb-3"></i>
                    <p class="mb-0">No images in this gallery yet. Upload some images to get started!</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Loading State --}}
    <div wire:loading wire:target="galleryImages" class="text-center py-5">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p class="mt-2">Loading gallery images...</p>
    </div>
</div>
