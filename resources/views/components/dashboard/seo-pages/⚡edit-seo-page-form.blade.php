<?php

use Livewire\Component;
use App\Models\SeoPage;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;

new class extends Component {
    public $seoPage;

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

    public function mount(SeoPage $seoPage)
    {
        $this->seoPage = $seoPage;
        $this->meta_desc_ar = $seoPage->meta_desc_ar;
        $this->meta_desc_en = $seoPage->meta_desc_en;
        $this->seo_title_ar = $seoPage->seo_title_ar;
        $this->seo_title_en = $seoPage->seo_title_en;
        $this->keywords_ar = $seoPage->keywords_ar;
        $this->keywords_en = $seoPage->keywords_en;
        $this->alt_text_ar = $seoPage->alt_text_ar;
        $this->alt_text_en = $seoPage->alt_text_en;
        $this->image_title_text_ar = $seoPage->image_title_text_ar;
        $this->image_title_text_en = $seoPage->image_title_text_en;
        $this->redirect_301_ar = $seoPage->redirect_301_ar;
        $this->redirect_301_en = $seoPage->redirect_301_en;
        $this->tags_en = $seoPage->tags_en;
        $this->tags_ar = $seoPage->tags_ar;
        $this->h1_val_ar = $seoPage->h1_val_ar;
        $this->h1_val_en = $seoPage->h1_val_en;
        $this->h2_val_ar = $seoPage->h2_val_ar;
        $this->h2_val_en = $seoPage->h2_val_en;
    }

    public function save()
    {
        $validatedData = $this->validate();

        DB::beginTransaction();
        try {
            $this->seoPage->update($validatedData);
            DB::commit();

            return redirect()->route('dashboard.seo-pages.index')->with('success', 'SEO updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('dashboard.seo-pages.edit', $this->seoPage->id)
                ->with('error', 'Something went wrong - ' . $e->getMessage());
        }
    }
};
?>

<div>
    <form wire:submit.prevent='save'>

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
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('seo_title_en')]) id="seo_title_en" wire:model='seo_title_en'>
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
                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('seo_title_ar')]) id="seo_title_ar" wire:model='seo_title_ar'>
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
                    <input type="text" class="form-control" id="image_title_text_en"
                        wire:model='image_title_text_en'>
                </div>
            </div>

            {{-- Image Title Text Ar --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image_title_text_ar">Image Title Text Ar</label>
                    <input type="text" class="form-control" id="image_title_text_ar"
                        wire:model='image_title_text_ar'>
                </div>
            </div>

            {{-- Alt Text En --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="alt_text_en">Alt Text En</label>
                    <input type="text" class="form-control" id="alt_text_en" wire:model='alt_text_en'>
                </div>
            </div>

            {{-- Alt Text Ar --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="alt_text_ar">Alt Text Ar</label>
                    <input type="text" class="form-control" id="alt_text_ar" wire:model='alt_text_ar'>
                </div>
            </div>

            {{-- H1 Value En --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="h1_val_en">H1 Value En</label>
                    <input type="text" class="form-control" id="h1_val_en" wire:model='h1_val_en'>
                </div>
            </div>

            {{-- H1 Value Ar --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="h1_val_ar">H1 Value Ar</label>
                    <input type="text" class="form-control" id="h1_val_ar" wire:model='h1_val_ar'>
                </div>
            </div>

            {{-- H2 Value En --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="h2_val_en">H2 Value En</label>
                    <input type="text" class="form-control" id="h2_val_en" wire:model='h2_val_en'>
                </div>
            </div>

            {{-- H2 Value Ar --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="h2_val_ar">H2 Value Ar</label>
                    <input type="text" class="form-control" id="h2_val_ar" wire:model='h2_val_ar'>
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

            <div>
                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="row">
                {{-- Submit Button --}}
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
    </form>
</div>
