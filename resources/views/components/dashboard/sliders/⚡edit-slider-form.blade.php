<?php

use Livewire\Component;
use App\Models\Slider;
use Livewire\Attributes\Validate;

new class extends Component {
    public $addUrl = 0;
    public $slider;
    #[Validate('required|string|min:3')]
    public $title_ar;

    #[Validate('required|string|min:3')]
    public $title_en;

    #[Validate('required|string|min:3')]
    public $description_ar;

    #[Validate('required|string|min:3')]
    public $description_en;
    #[Validate('required|boolean')]
    public $status = 1;
    #[Validate('nullable|sometimes|required_if:addUrl,==,true|string|min:2')]
    public $btn_en;
    #[Validate('nullable|sometimes|required_if:addUrl,==,true|string|min:2')]
    public $btn_ar;
    #[Validate('nullable|sometimes|required_if:addUrl,==,true|url')]
    public $url;
    public $title_color;
    public $description_color;

    public function mount($slider)
    {
        $this->slider = $slider;
        $this->title_ar = $slider->title_ar;
        $this->title_en = $slider->title_en;
        $this->description_ar = $slider->description_ar;
        $this->description_en = $slider->description_en;
        $this->btn_en = $slider->btn_en;
        $this->btn_ar = $slider->btn_ar;
        $this->url = $slider->url;
        $this->status = $slider->status;
        $this->title_color = $slider->title_color;
        $this->description_color = $slider->description_color;

        if (!is_null($slider->url) || !empty($slider->url)) {
            $this->addUrl = 1;
        }
    }

    public function rules()
    {
        return [
            'title_color' => 'nullable|sometimes|regex:/^#[0-9A-Fa-f]{6}$/',
            'description_color' => 'nullable|sometimes|regex:/^#[0-9A-Fa-f]{6}$/',
        ];
    }
    public function save()
    {
        $this->validate();
        $this->slider->update($this->only(['title_ar', 'title_en', 'description_ar', 'description_en', 'btn_en', 'btn_ar', 'url', 'status', 'title_color', 'description_color']));

        return redirect()->route('dashboard.sliders.index')->with('success', 'Slider updated successfully');
    }
};
?>

<div>
    <form wire:submit.prevent='save'>
        @csrf
        <div class="card-body">
            <div class="row">

                {{-- Title En --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title_en">Title En
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title_en')]) id="title_en" wire:model='title_en' />
                        @error('title_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Title ar --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title_ar">Title ar
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('title_ar')]) id="title_ar" wire:model='title_ar' />
                        @error('title_ar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Title Color --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title_color">Title color
                            <span class="text-danger">

                            </span>
                        </label>
                        <input type="color" class="form-control form-control-color" id="title_color"
                            wire:model='title_color' title="Choose your color">
                        @error('title_color')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <hr>


                {{-- Description En --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description_en">Description En
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <textarea @class([
                            'form-control',
                            'is-invalid' => $errors->has('description_en'),
                        ]) id="description_en" wire:model='description_en'></textarea>
                        @error('description_en')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                {{-- Description ar --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description_ar">Description ar
                            <span class="text-danger">
                                *
                            </span>
                        </label>
                        <textarea @class([
                            'form-control',
                            'is-invalid' => $errors->has('description_ar'),
                        ]) id="description_ar" wire:model='description_ar'></textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Description Color --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description_color">Description color
                            <span class="text-danger">

                            </span>
                        </label>
                        <input type="color" class="form-control form-control-color" id="description_color"
                            wire:model='description_color' title="Choose your color">
                        @error('description_color')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <hr>

                {{-- add url --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="addUrl">Add url
                            <span class="text-danger">
                            </span>
                        </label>
                        <input type="checkbox" name="addUrl" id="addUrl" value="1" wire:model.live='addUrl'
                            @checked($addUrl) />
                        {{-- <input type="checkbox" name="addUrl" @class(['form-control', 'is-invalid' => $errors->has('addUrl')]) id="addUrl" value='1'
                        wire:model='addUrl' /> --}}
                        @error('addUrl')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                @if ($addUrl == 1)
                    {{-- btn en --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="btn_en">Button en
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('btn_en')]) id="btn_en" wire:model='btn_en' />
                            @error('btn_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- btn ar --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="btn_ar">Button ar
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('btn_ar')]) id="btn_ar" wire:model='btn_ar' />
                            @error('btn_ar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- btn url --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="url">Button URL
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('url')]) id="url" wire:model='url' />
                            @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endif

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
                                wire:target="save" wire:loading.class="btn-secondary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
