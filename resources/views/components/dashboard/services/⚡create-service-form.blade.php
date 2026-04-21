<?php

use Livewire\Component;
use App\Models\Location;
use App\Models\Service;
use App\Traits\GenerateSlugsTrait;
use App\Traits\UploadImageTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

use Livewire\Features\SupportFileUploads\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

new class extends Component
{
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













    public function save()
    {
        $this->validate();
        $service = Service::create([
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'desc_ar' => $this->desc_ar,
            'desc_en' => $this->desc_en,
            'sub_desc_ar' => $this->sub_desc_ar ?? null,
            'sub_desc_en' => $this->sub_desc_en ?? null,
            'status' => $this->status,
        ]);

        $service->update([
            'alias_name_en' => $this->generateUniqueSlug($service, $this->title_en, 'alias_name_en'),
            'alias_name_ar' => $this->generateUniqueSlug($service, $this->title_ar, 'alias_name_ar'),
        ]);


        if ($this->image) {
            $path = $this->saveImage($this->image, 'storage/services/');
            $service->update([
                'image' => $path,
            ]);
        }

        return redirect()->route('dashboard.Services.index')->with('success', 'Service created successfully');
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
