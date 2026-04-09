<?php

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required|min:3|unique:categories,title_ar')]
    public $title_ar;

    #[Validate('required|min:3|unique:categories,title_en')]
    public $title_en;

    #[Validate('required|boolean')]
    public $status = 1;

    public function getNextOrder()
    {
        $lastCategory = Category::orderBy('order', 'desc')->first();
        return $lastCategory ? $lastCategory->order + 1 : 1;
    }


    public function save()
    {
        $this->validate();
        Category::create([
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'status' => $this->status,
            'order' => $this->getNextOrder(),
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
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
                                wire:target="save,image" wire:loading.class="btn-secondary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
