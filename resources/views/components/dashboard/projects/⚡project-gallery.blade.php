<?php

use Livewire\Component;

use App\Models\ProjectImage;
use App\Traits\UploadImageTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Spatie\LivewireFilepond\WithFilePond;

new class extends Component {

    use WithFilePond;
    use UploadImageTrait;

    public $project;
    public $images = [];
    public $video;

    public function rules()
    {
        return [
            'images' => 'nullable',
            'images.*' => 'image',
            'video' => 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg',
        ];
    }

    public function mount($project)
    {
        $this->project = $project;
    }

    #[Computed]
    #[On('refreshMedia')]
    public function media()
    {
        return $this->project->media;
    }

    public function deleteItem($id)
    {
        $media = ProjectImage::find($id);
        if (!$media) {
            return;
        }
        $media->delete();
        if (file_exists($media->path)) {
            unlink($media->path);
        }
        $this->dispatch('refreshMedia');
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
                $path = $this->saveImage($image, "storage/projects/{$this->project->id}/images");
                ProjectImage::create([
                    'project_id' => $this->project->id,
                    'path' => $path,
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                ]);
            }

            $this->dispatch('success', 'Images added successfully');
        }

        // Upload video using Storage
        if ($this->video) {
            $path = $this->video->store("projects/{$this->project->id}/videos", 'public');
            ProjectImage::create([
                'project_id' => $this->project->id,
                'path' => 'storage/' . $path,
                'mime_type' => $this->video->getMimeType(),
                'size' => $this->video->getSize(),
            ]);
            $this->dispatch('success', 'Video added successfully');
        }

        $this->reset('images', 'video');
        $this->dispatch('refreshMedia');

        return redirect()->route('dashboard.projects.gallery', $this->project->id);
    }
};
?>

<div>
    <form wire:submit.prevent='save' enctype="multipart/form-data">
        <div class="row">

            {{-- Image --}}
            <div class="col-md-6">
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
                        Uploading images...
                    </div>
                </div>
            </div>
        </div>

        {{-- submit button --}}
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                    wire:loading.class="btn-secondary" wire:target="save,images,video">
                    Upload
                </button>
            </div>
        </div>
    </form>

    <hr>
    <hr>




    <div class="row" wire:loading.remove wire:target="media">
        @forelse ($this->media as $mediaItem)
            @if (str_starts_with((string) $mediaItem->mime_type, 'image/'))
                <div class="col-6 col-md-4 " wire:key="{{ $mediaItem->id }}">
                    <div class="card">
                        <div class="card-body"
                            style="height: 150px !important; display: flex; justify-content: center; align-items: center;">
                            <img src="{{ asset($mediaItem->path) }}" class="card-img-top img-fluid h-100" alt="..."
                                style="object-fit: contain; width: 100%; height: 100%;">
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button class="btn btn-danger btn-sm" wire:click="deleteItem({{ $mediaItem->id }})"
                                wire:confirm="Are you sure you want to delete this image?" wire:loading.attr="disabled">
                                delete
                            </button>
                        </div>
                    </div>
                </div>
            @elseif (str_starts_with((string) $mediaItem->mime_type, 'video/'))
                <div class="col-6 col-md-4" wire:key="{{ $mediaItem->id }}">
                    <div class="card">
                        <div class="card-body"
                            style="height: 150px !important; display: flex; justify-content: center; align-items: center;">

                            <video src="{{ asset($mediaItem->path) }}" alt="..."
                                style="object-fit: contain; width: 100%; height: 100%;" controls>
                            </video>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button class="btn btn-danger btn-sm" wire:click="deleteItem({{ $mediaItem->id }})"
                                wire:confirm="Are you sure you want to delete this video?" wire:loading.attr="disabled">
                                delete
                            </button>
                        </div>
                    </div>
                </div>
            @endif


        @empty
            <div class="alert alert-warning">
                No media found
            </div>
        @endforelse
    </div>
</div>
