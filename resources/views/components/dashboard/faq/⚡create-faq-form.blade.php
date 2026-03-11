<?php

use App\Models\Faq;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|min:3')]
    public $question_ar;

    #[Validate('required|min:3')]
    public $question_en;

    #[Validate('required|min:3')]
    public $answer_ar;

    #[Validate('required|min:3')]
    public $answer_en;

    #[Validate('required|integer|min:1')]
    public $order = 1;

    #[Validate('required|boolean')]
    public $status = 1;


    public function save()
    {
        $this->validate();
        Faq::create($this->only(['question_ar', 'question_en', 'answer_ar', 'answer_en', 'order', 'status']));

        return redirect()->route('dashboard.faq.index')->with('success', 'Faq created successfully');
    }

};
?>

<div>
    <form wire:submit.prevent='save'>
    @csrf
    <div class="card-body">
        <div class="row">

            {{-- Question En --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="question_en">Question En
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <textarea @class(['form-control', 'is-invalid' => $errors->has('question_en')]) id="question_en" wire:model='question_en'></textarea>
                    @error('question_en')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Answer En --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="answer_en">Answer En
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <textarea @class(['form-control', 'is-invalid' => $errors->has('answer_en')]) id="answer_en" wire:model='answer_en'></textarea>
                    @error('answer_en')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <hr>


            {{-- Question En --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="question_ar">Question Ar
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <textarea @class(['form-control', 'is-invalid' => $errors->has('question_ar')]) id="question_ar" wire:model='question_ar'></textarea>
                    @error('question_ar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>




            {{-- Answer Ar --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="answer_ar">Answer Ar
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <textarea @class(['form-control', 'is-invalid' => $errors->has('answer_ar')]) id="answer_ar" wire:model='answer_ar'></textarea>
                    @error('answer_ar')
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

            {{-- Order --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="order">Order
                        <span class="text-danger">
                            *
                        </span>
                    </label>
                    <input @class(['form-control', 'is-invalid' => $errors->has('order')]) id="order" type="number" wire:model='order'>
                    @error('order')
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
