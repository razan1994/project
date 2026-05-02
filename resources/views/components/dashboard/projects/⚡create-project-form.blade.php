<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Category;
use App\Models\Project;
use App\Traits\GenerateSlugsTrait;
use App\Traits\UploadImageTrait;
use Livewire\Attributes\Validate;

use Livewire\Features\SupportFileUploads\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

new class extends Component {
    use WithFileUploads;
    use UploadImageTrait;
    use GenerateSlugsTrait;

    #[Validate('required|min:3')]
    public $title_ar;

    #[Validate('required|min:3')]
    public $title_en;

    #[Validate('required|min:3')]
    public $desc_ar;

    #[Validate('required|min:3')]
    public $desc_en;

    #[Validate('required|min:3')]
    public $sub_desc_ar;

    #[Validate('required|min:3')]
    public $sub_desc_en;

    #[Validate('required|boolean')]
    public $status = 1;
    #[Validate('required|image')]
    public $image;
    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    public $alias_name_en;
    public $alias_name_ar;

    public function updated($name, $value)
    {
        if ($name === 'title_en') {
            $this->alias_name_en = $this->generateUniqueSlug(new Project(), $value, 'alias_name_en');
        }
        if ($name === 'title_ar') {
            $this->alias_name_ar = $this->generateUniqueSlug(new Project(), $value, 'alias_name_ar');
        }
    }












    #[Computed]
    public function categories()
    {
        return Category::where('status', 1)->get();
    }

    public function getNextOrder()
    {
        $lastProject = Project::orderBy('order', 'desc')->first();
        return $lastProject ? $lastProject->order + 1 : 1;
    }
    public function save()
    {
        $this->validate();
        $project = Project::create([
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'desc_ar' => $this->desc_ar,
            'desc_en' => $this->desc_en,
            'sub_desc_ar' => $this->sub_desc_ar ?? null,
            'sub_desc_en' => $this->sub_desc_en ?? null,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'order' => $this->getNextOrder(),
            'alias_name_en' => trim($this->alias_name_en) ?: $this->generateUniqueSlug(new Project(), $this->title_en, 'alias_name_en'),
            'alias_name_ar' => trim($this->alias_name_ar) ?: $this->generateUniqueSlug(new Project(), $this->title_ar, 'alias_name_ar'),
            'image' => $this->image ? $this->saveImage($this->image, 'storage/projects/') : null,
        ]);

        return redirect()->route('dashboard.projects.index')->with('success', 'Project created successfully');
    }
};
?>

<div>
    <form wire:submit.prevent='save'>
        @csrf
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
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title_en')]) id="title_en" wire:model.live='title_en'>
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
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title_ar')]) id="title_ar" wire:model.live='title_ar'>
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


                {{-- Sub Description En --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sub_desc_en">Sub Description En
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <textarea @class(['form-control', 'is-invalid' => $errors->has('sub_desc_en')]) id="sub_desc_en" wire:model='sub_desc_en'></textarea>
                        @error('sub_desc_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Sub Description Ar --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sub_desc_ar">Sub Description Ar
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <textarea @class(['form-control', 'is-invalid' => $errors->has('sub_desc_ar')]) id="sub_desc_ar" wire:model='sub_desc_ar'></textarea>
                        @error('sub_desc_ar')
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

                {{-- Category --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Category
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <select @class(['form-control', 'is-invalid' => $errors->has('category_id')]) id="category_id" wire:model='category_id'>
                            <option value="" disabled>Select a category</option>
                            @forelse ($this->categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title_en }}</option>
                            @empty
                                <option value="" disabled>No categories found</option>
                            @endforelse
                        </select>
                        @error('category_id')
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
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="file" @class(['form-control', 'is-invalid' => $errors->has('image')]) id="image" wire:model='image' required
                            accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="Image" class="mt-2 img-fluid img-thumbnail"
                                width="100" height="100">
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
                                wire:target="save,image" wire:loading.class="btn-secondary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
