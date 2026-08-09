<?php

use App\Models\SeoSection;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public $seoSection;

    #[Validate('required|min:3')]
    public $title_ar;

    #[Validate('required|min:3')]
    public $title_en;

    #[Validate('required|min:3')]
    public $desc_ar;

    #[Validate('required|min:3')]
    public $desc_en;

    #[Validate('required|boolean')]
    public $status;

    public function mount(SeoSection $seoSection)
    {
        $this->seoSection = $seoSection;

        $this->title_ar = $seoSection->title_ar;
        $this->title_en = $seoSection->title_en;

        $this->desc_ar = $seoSection->desc_ar;
        $this->desc_en = $seoSection->desc_en;

        $this->status = $seoSection->status;
    }

    public function save()
    {
        $this->validate();

        $this->seoSection->update([
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'desc_ar' => $this->desc_ar,
            'desc_en' => $this->desc_en,
            'status' => $this->status,
        ]);

        return redirect()->route('dashboard.seo-sections.index')->with('success', 'SEO Section updated successfully');
    }
};

?>

<div>

    <div class="row justify-content-center">

        <div class="col-md-8">

            <form wire:submit.prevent='save' class="card card-primary">

                <div class="card-header">

                    <h4 class="card-title">

                        Edit SEO Section "{{ $seoSection->title_en }}"

                    </h4>

                </div>


                <div class="card-body">

                    <div class="row">


                        {{-- Title En --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="title_en">
                                    Title En

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

                                <label for="title_ar">
                                    Title Ar

                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>

                                <input type="text" dir="rtl" @class(['form-control', 'is-invalid' => $errors->has('title_ar')]) id="title_ar"
                                    wire:model='title_ar'>

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

                                <label for="desc_en">
                                    Description En

                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>

                                <textarea @class(['form-control', 'is-invalid' => $errors->has('desc_en')]) id="desc_en" wire:model='desc_en'>{{ $desc_en }}</textarea>

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

                                <label for="desc_ar">
                                    Description Ar

                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>

                                <textarea dir="rtl" @class(['form-control', 'is-invalid' => $errors->has('desc_ar')]) id="desc_ar" wire:model='desc_ar'>{{ $desc_ar }}</textarea>

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

                                <label for="status">
                                    Status

                                    <span class="text-danger">
                                        *
                                    </span>
                                </label>

                                <select @class(['form-control', 'is-invalid' => $errors->has('status')]) id="status" wire:model='status'>

                                    <option value="1">
                                        Active
                                    </option>

                                    <option value="0">
                                        Inactive
                                    </option>

                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- Errors --}}
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

                            <div class="col-md-12">

                                <div class="form-group">

                                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                        wire:target="save" wire:loading.class="btn-secondary">

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

                if (descAr) {

                    ClassicEditor
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

                if (descEn) {

                    ClassicEditor
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
