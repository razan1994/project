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

    #[Validate('nullable|string')]
    public $seo_title_ar;

    #[Validate('nullable|string')]
    public $seo_title_en;
    #[Validate('nullable|string')]
    public $alt_text_ar;

    #[Validate('nullable|string')]
    public $alt_text_en;
    #[Validate('nullable|string')]
    public $image_title_text_ar;

    #[Validate('nullable|string')]
    public $image_title_text_en;

    #[Validate('nullable|string')]
    public $meta_desc_ar;

    #[Validate('nullable|string')]
    public $meta_desc_en;
    #[Validate('nullable|string')]
    public $h1_val_ar;

    #[Validate('nullable|string')]
    public $h1_val_en;
    #[Validate('nullable|string')]
    public $h2_val_ar;

    #[Validate('nullable|string')]
    public $h2_val_en;

    #[Validate('nullable|string')]
    public $keywords_ar;

    #[Validate('nullable|string')]
    public $keywords_en;
    #[Validate('nullable|string')]
    public $redirect_301_ar;

    #[Validate('nullable|string')]
    public $redirect_301_en;
    #[Validate('nullable|string')]
    public $tags_en;
    #[Validate('nullable|string')]
    public $tags_ar;

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
        $this->title_ar = $blog->title_ar;
        $this->title_en = $blog->title_en;
        $this->desc_ar = $blog->desc_ar;
        $this->desc_en = $blog->desc_en;
        $this->status = $blog->status;

        $this->meta_desc_ar = $blog->meta_desc_ar;
        $this->meta_desc_en = $blog->meta_desc_en;
        $this->seo_title_ar = $blog->seo_title_ar;
        $this->seo_title_en = $blog->seo_title_en;
        $this->keywords_ar = $blog->keywords_ar;
        $this->keywords_en = $blog->keywords_en;
        $this->alt_text_ar = $blog->alt_text_ar;
        $this->alt_text_en = $blog->alt_text_en;
        $this->image_title_text_ar = $blog->image_title_text_ar;
        $this->image_title_text_en = $blog->image_title_text_en;
        $this->redirect_301_ar = $blog->redirect_301_ar;
        $this->redirect_301_en = $blog->redirect_301_en;
        $this->tags_en = $blog->tags_en;
        $this->tags_ar = $blog->tags_ar;
        $this->h1_val_ar = $blog->h1_val_ar;
        $this->h1_val_en = $blog->h1_val_en;
        $this->h2_val_ar = $blog->h2_val_ar;
        $this->h2_val_en = $blog->h2_val_en;
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
            'alias_name_en' => $this->generateUniqueSlug($this->blog, $this->title_en, 'alias_name_en'),
            'alias_name_ar' => $this->generateUniqueSlug($this->blog, $this->title_ar, 'alias_name_ar'),

            // ---------------- SEO ----------------
            'meta_desc_ar' => $this->meta_desc_ar,
            'meta_desc_en' => $this->meta_desc_en,
            'seo_title_ar' => $this->seo_title_ar,
            'seo_title_en' => $this->seo_title_en,
            'keywords_ar' => $this->keywords_ar,
            'keywords_en' => $this->keywords_en,
            'alt_text_ar' => $this->alt_text_ar,
            'alt_text_en' => $this->alt_text_en,
            'image_title_text_ar' => $this->image_title_text_ar,
            'image_title_text_en' => $this->image_title_text_en,
            'h1_val_ar' => $this->h1_val_ar,
            'h1_val_en' => $this->h1_val_en,
            'h2_val_ar' => $this->h2_val_ar,
            'h2_val_en' => $this->h2_val_en,
            'tags_ar' => $this->tags_ar,
            'tags_en' => $this->tags_en,
            'redirect_301_ar' => $this->redirect_301_ar,
            'redirect_301_en' => $this->redirect_301_en,
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

                        {{-- SEO Fields --}}
                        <hr>
                        <br>

                        <div class="mb-3 accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        SEO Fields
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        <div class="row">
                                            {{-- Meta Description En --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta_desc_en">Meta Description En</label>
                                                    <textarea @class(['form-control', 'is-invalid' => $errors->has('meta_desc_en')]) id="meta_desc_en" wire:model='meta_desc_en'></textarea>
                                                    @error('meta_desc_en')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Meta Description Ar --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta_desc_ar">Meta Description Ar</label>
                                                    <textarea @class(['form-control', 'is-invalid' => $errors->has('meta_desc_ar')]) id="meta_desc_ar" wire:model='meta_desc_ar'></textarea>
                                                    @error('meta_desc_ar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- SEO Title En --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="seo_title_en">SEO Title En</label>
                                                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('seo_title_en')]) id="seo_title_en"
                                                        wire:model='seo_title_en'>
                                                    @error('seo_title_en')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- SEO Title Ar --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="seo_title_ar">SEO Title Ar</label>
                                                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('seo_title_ar')])
                                                        id="seo_title_ar" wire:model='seo_title_ar'>
                                                    @error('seo_title_ar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- Keywords En --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="keywords_en">Keywords En</label>
                                                    <textarea @class(['form-control', 'is-invalid' => $errors->has('keywords_en')]) id="keywords_en" wire:model='keywords_en'></textarea>
                                                    @error('keywords_en')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- Keywords Ar --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="keywords_ar">Keywords Ar</label>
                                                    <textarea @class(['form-control', 'is-invalid' => $errors->has('keywords_ar')]) id="keywords_ar" wire:model='keywords_ar'></textarea>
                                                    @error('keywords_ar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- Image Title Text En --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image_title_text_en">Image Title Text En</label>
                                                    <input type="text" class="form-control"
                                                        id="image_title_text_en" wire:model='image_title_text_en'>
                                                </div>
                                            </div>

                                            {{-- Image Title Text Ar --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image_title_text_ar">Image Title Text Ar</label>
                                                    <input type="text" class="form-control"
                                                        id="image_title_text_ar" wire:model='image_title_text_ar'>
                                                </div>
                                            </div>

                                            {{-- Alt Text En --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alt_text_en">Alt Text En</label>
                                                    <input type="text" class="form-control" id="alt_text_en"
                                                        wire:model='alt_text_en'>
                                                </div>
                                            </div>

                                            {{-- Alt Text Ar --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alt_text_ar">Alt Text Ar</label>
                                                    <input type="text" class="form-control" id="alt_text_ar"
                                                        wire:model='alt_text_ar'>
                                                </div>
                                            </div>

                                            {{-- H1 Value En --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="h1_val_en">H1 Value En</label>
                                                    <input type="text" class="form-control" id="h1_val_en"
                                                        wire:model='h1_val_en'>
                                                </div>
                                            </div>

                                            {{-- H1 Value Ar --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="h1_val_ar">H1 Value Ar</label>
                                                    <input type="text" class="form-control" id="h1_val_ar"
                                                        wire:model='h1_val_ar'>
                                                </div>
                                            </div>

                                            {{-- H2 Value En --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="h2_val_en">H2 Value En</label>
                                                    <input type="text" class="form-control" id="h2_val_en"
                                                        wire:model='h2_val_en'>
                                                </div>
                                            </div>

                                            {{-- H2 Value Ar --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="h2_val_ar">H2 Value Ar</label>
                                                    <input type="text" class="form-control" id="h2_val_ar"
                                                        wire:model='h2_val_ar'>
                                                </div>
                                            </div>

                                            {{-- Redirect 301 En --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="redirect_301_en">Redirect 301 En</label>
                                                    <textarea class="form-control" id="redirect_301_en" wire:model='redirect_301_en'></textarea>
                                                </div>
                                            </div>

                                            {{-- Redirect 301 Ar --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="redirect_301_ar">Redirect 301 Ar</label>
                                                    <textarea class="form-control" id="redirect_301_ar" wire:model='redirect_301_ar'></textarea>
                                                </div>
                                            </div>

                                            {{-- Tags Ar --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tags_ar">Tags Ar</label>
                                                    <textarea class="form-control" id="tags_ar" wire:model='tags_ar'></textarea>
                                                </div>
                                            </div>


                                            {{-- Tags En --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tags_en">Tags En</label>
                                                    <textarea class="form-control" id="tags_en" wire:model='tags_en'></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

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
