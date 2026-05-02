<?php

use App\Models\Blog;
use App\Traits\GenerateSlugsTrait;
use App\Traits\UploadImageTrait;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;
    use UploadImageTrait;
    use GenerateSlugsTrait;

    public $blog;

    #[Validate('required|min:3')]
    public $title_ar;

    #[Validate('required|min:3')]
    public $title_en;

    #[Validate('required|min:3')]
    public $desc_ar;

    #[Validate('required|min:3')]
    public $desc_en;

    #[Validate('nullable|min:3')]
    public $alias_name_ar;

    #[Validate('nullable|min:3')]
    public $alias_name_en;

    #[Validate('required|boolean')]
    public $status;

    #[Validate('nullable|sometimes|image|mimes:jpg,jpeg,png,gif,svg')]
    public $image;












    public function mount(Blog $blog)
    {
        $this->blog = $blog;
        $this->title_ar = $blog->title_ar;
        $this->title_en = $blog->title_en;
        $this->desc_ar = $blog->desc_ar;
        $this->desc_en = $blog->desc_en;
        $this->status = $blog->status;
        $this->alias_name_en = $blog->alias_name_en;
        $this->alias_name_ar = $blog->alias_name_ar;

    }

    public function save()
    {
        $this->validate();

        $old_image = $this->blog->image;

        $this->blog->update([
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'desc_ar' => $this->desc_ar,
            'desc_en' => $this->desc_en,
            'status' => $this->status,
            'alias_name_en' => trim($this->alias_name_en) ?: $this->generateUniqueSlug($this->blog, $this->title_en, 'alias_name_en'),
            'alias_name_ar' => trim($this->alias_name_ar) ?: $this->generateUniqueSlug($this->blog, $this->title_ar, 'alias_name_ar'),
        ]);

        if ($this->image) {
            $path = $this->saveImage($this->image, 'storage/blogs/');
            $this->blog->update([
                'image' => $path,
            ]);

            if ($old_image && file_exists($old_image)) {
                unlink($old_image);
            }
        }

        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog updated successfully');
    }
};
?>

<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form wire:submit.prevent='save' class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title">
                        Edit Blog "{{ $blog->title_en }}"
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Title En --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title_en">Title En
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title_en')]) id="title_en" wire:model='title_en'>
                                @error('title_en')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Title Ar --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title_ar">Title Ar
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title_ar')]) id="title_ar" wire:model='title_ar'>
                                @error('title_ar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Slug En --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alias_name_en">Slug (en)
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea @class(['form-control', 'is-invalid' => $errors->has('alias_name_en')]) id="alias_name_en" wire:model='alias_name_en'></textarea>
                                @error('alias_name_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Slug Ar --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alias_name_ar">Slug (ar)
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea dir="rtl" @class(['form-control', 'is-invalid' => $errors->has('alias_name_ar')]) id="alias_name_ar" wire:model='alias_name_ar'></textarea>
                                @error('alias_name_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- Description En --}}
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label for="desc_en">Description En
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <textarea @class(['form-control', 'is-invalid' => $errors->has('desc_en')]) id="desc_en" wire:model='desc_en'></textarea>
                                @error('desc_en')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        {{-- Description Ar --}}
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label for="desc_ar">Description Ar
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <textarea @class(['form-control', 'is-invalid' => $errors->has('desc_ar')]) id="desc_ar" wire:model='desc_ar'></textarea>
                                @error('desc_ar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        {{-- Status --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status
                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>
                                <select @class(['form-control', 'is-invalid' => $errors->has('status')]) id="status" wire:model='status'>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        {{-- Image --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image
                                </label>
                                <input type="file" @class(['form-control', 'is-invalid' => $errors->has('image')]) id="image" wire:model='image'
                                    accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror



                                @if ($blog->image && !$image)
                                    <img src="{{ asset($blog->image) }}" alt="Image"
                                        class="mt-2 img-fluid img-thumbnail" width="100" height="100">
                                @endif
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="Image"
                                        class="mt-2 img-fluid img-thumbnail" width="100" height="100">
                                @endif
                            </div>
                        </div>


                        @if ($errors->any())
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif


                        <div class="row">
                            {{-- Submit Button --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                        wire:target="save,image" wire:loading.class="btn-secondary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @script
        <script>
            $(document).ready(function() {
                // ------ Description ar ------
                let descAr = document.querySelector('#desc_ar');
                // console.log('loaded');
                if (descAr) {
                    let textEditor = ClassicEditor
                        .create(descAr)
                        .then((editor) => {
                            editor.model.document.on('change:data', () => {
                                const data = editor.getData();
                                @this.set('desc_ar', data);
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }

                // ------ Description en ------
                let descEn = document.querySelector('#desc_en');
                // console.log('loaded');
                if (descEn) {
                    let textEditor = ClassicEditor
                        .create(descEn)
                        .then((editor) => {
                            editor.model.document.on('change:data', () => {
                                const data = editor.getData();
                                @this.set('desc_en', data);
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        </script>
    @endscript

</div>
