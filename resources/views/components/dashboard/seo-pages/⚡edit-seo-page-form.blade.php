<?php

use App\Models\SeoPage;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

new class extends Component {
    public SeoPage $seoPage;

    public ?string $seo_title_en = null;
    public ?string $seo_title_ar = null;
    public ?string $meta_desc_en = null;
    public ?string $meta_desc_ar = null;
    public ?string $h1_val_en = null;
    public ?string $h1_val_ar = null;
    public ?string $h2_val_en = null;
    public ?string $h2_val_ar = null;
    public ?string $alt_text_en = null;
    public ?string $alt_text_ar = null;
    public ?string $image_title_text_en = null;
    public ?string $image_title_text_ar = null;

    public bool $submitting = false;

    public function mount(SeoPage $seoPage): void
    {
        $this->seoPage = $seoPage;
        $this->seo_title_en = $seoPage->seo_title_en;
        $this->seo_title_ar = $seoPage->seo_title_ar;
        $this->meta_desc_en = $seoPage->meta_desc_en;
        $this->meta_desc_ar = $seoPage->meta_desc_ar;
        $this->h1_val_en = $seoPage->h1_val_en;
        $this->h1_val_ar = $seoPage->h1_val_ar;
        $this->h2_val_en = $seoPage->h2_val_en;
        $this->h2_val_ar = $seoPage->h2_val_ar;
        $this->alt_text_en = $seoPage->alt_text_en;
        $this->alt_text_ar = $seoPage->alt_text_ar;
        $this->image_title_text_en = $seoPage->image_title_text_en;
        $this->image_title_text_ar = $seoPage->image_title_text_ar;
    }

    public function generateSeoFields(): void
    {
        $this->resetErrorBag('seo_generation');
        set_time_limit(120);

        $pageName = $this->seoPage->name;

        try {
            $schema = new ObjectSchema(
                name: 'seo_fields',
                description: 'SEO fields for a static page',
                properties: [
                    new StringSchema('seo_title_en', 'English SEO meta title, concise, ideally 50-60 characters'),
                    new StringSchema('seo_title_ar', 'Arabic SEO meta title, concise, ideally 50-60 characters'),
                    new StringSchema('meta_desc_en', 'English SEO meta description, ideally 140-160 characters'),
                    new StringSchema('meta_desc_ar', 'Arabic SEO meta description, ideally 140-160 characters'),
                    new StringSchema('h1_val_en', 'Primary English H1 for the page, clearly describing the page purpose'),
                    new StringSchema('h1_val_ar', 'Primary Arabic H1 for the page, natural and clearly describing the page purpose'),
                    new StringSchema('h2_val_en', 'Supporting English H2 that reinforces the page topic'),
                    new StringSchema('h2_val_ar', 'Supporting Arabic H2 that reinforces the page topic'),
                    new StringSchema('alt_text_en', 'Descriptive English alt text for the page main image'),
                    new StringSchema('alt_text_ar', 'Descriptive Arabic alt text for the page main image'),
                    new StringSchema('image_title_text_en', 'English image title attribute text'),
                    new StringSchema('image_title_text_ar', 'Arabic image title attribute text'),
                ],
                requiredFields: [
                    'seo_title_en', 'seo_title_ar',
                    'meta_desc_en', 'meta_desc_ar',
                    'h1_val_en', 'h1_val_ar',
                    'h2_val_en', 'h2_val_ar',
                    'alt_text_en', 'alt_text_ar',
                    'image_title_text_en', 'image_title_text_ar',
                ]
            );

            $prompt = "You are an expert multilingual SEO specialist for a construction and architecture company called 'Al Jeel Contracting' based in Saudi Arabia.\n\n";
            $prompt .= "Company description: Al Jeel Contracting is a Saudi-based company specialized in construction, architecture, and engineering works. The company operates primarily in Saudi Arabia and India, executing projects based on a modern engineering methodology that combines high-quality execution, meticulous attention to detail, and strict adherence to approved specifications and standards.\n\n";
            $prompt .= "Generate high-quality SEO fields for the '{$pageName}' page in both English and Arabic.\n\n";
            $prompt .= "Guidelines:\n";
            $prompt .= "- Do not invent facts or fabricate details about the company.\n";
            $prompt .= "- Avoid keyword stuffing, filler phrases, and exaggerated marketing language.\n";
            $prompt .= "- English output must be clear, professional, concise, and optimized for search intent.\n";
            $prompt .= "- Arabic output must be natural, fluent Modern Standard Arabic suitable for the Saudi and Arab market.\n";
            $prompt .= "- H1 must clearly and directly describe the page purpose.\n";
            $prompt .= "- H2 must support and complement the H1.\n";
            $prompt .= "- SEO titles should be readable, ideally 50-60 characters, and where relevant should reference Saudi Arabia (English) or 'السعودية' (Arabic) for local SEO.\n";
            $prompt .= "- Meta descriptions must be informative, compelling, and strictly 140-160 characters.\n";
            $prompt .= "- Alt text and image titles must be descriptive and relevant to the page content and the company's construction/architecture focus.\n";
            $prompt .= "- Return clean, production-ready SEO content only.\n";

            $response = Prism::structured()
                ->using(Provider::Mistral, 'mistral-large-latest')
                ->withSchema($schema)
                ->withPrompt($prompt)
                ->withClientOptions(array_filter([
                    'timeout'         => 60,
                    'connect_timeout' => 10,
                    'verify'          => ($caFile = config('prism.providers.mistral.cafile'))
                        ? base_path($caFile)
                        : null,
                ]))
                ->asStructured();

            $seoData = $response->structured;

            $this->seo_title_en = $seoData['seo_title_en'] ?? null;
            $this->seo_title_ar = $seoData['seo_title_ar'] ?? null;
            $this->meta_desc_en = $seoData['meta_desc_en'] ?? null;
            $this->meta_desc_ar = $seoData['meta_desc_ar'] ?? null;
            $this->h1_val_en = $seoData['h1_val_en'] ?? null;
            $this->h1_val_ar = $seoData['h1_val_ar'] ?? null;
            $this->h2_val_en = $seoData['h2_val_en'] ?? null;
            $this->h2_val_ar = $seoData['h2_val_ar'] ?? null;
            $this->alt_text_en = $seoData['alt_text_en'] ?? null;
            $this->alt_text_ar = $seoData['alt_text_ar'] ?? null;
            $this->image_title_text_en = $seoData['image_title_text_en'] ?? null;
            $this->image_title_text_ar = $seoData['image_title_text_ar'] ?? null;

            session()->flash('success', 'SEO fields generated successfully!');
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            logger()->error('SEO Generation Timeout: ' . $e->getMessage());
            $this->addError('seo_generation', 'SEO generation timed out. Please try again.');
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            logger()->error('SEO Generation Timeout: ' . $e->getMessage());
            $this->addError('seo_generation', 'SEO generation timed out. Please try again.');
        } catch (\Exception $e) {
            logger()->error('SEO Generation Error: ' . $e->getMessage());
            $this->addError('seo_generation', 'Failed to generate SEO fields. Please try again.');
        }
    }

    public function save(): void
    {
        if ($this->submitting) {
            return;
        }
        $this->submitting = true;

        DB::beginTransaction();
        try {
            $this->seoPage->update([
                'seo_title_en' => $this->seo_title_en ? trim($this->seo_title_en) : null,
                'seo_title_ar' => $this->seo_title_ar ? trim($this->seo_title_ar) : null,
                'meta_desc_en' => $this->meta_desc_en ? trim($this->meta_desc_en) : null,
                'meta_desc_ar' => $this->meta_desc_ar ? trim($this->meta_desc_ar) : null,
                'h1_val_en' => $this->h1_val_en ? trim($this->h1_val_en) : null,
                'h1_val_ar' => $this->h1_val_ar ? trim($this->h1_val_ar) : null,
                'h2_val_en' => $this->h2_val_en ? trim($this->h2_val_en) : null,
                'h2_val_ar' => $this->h2_val_ar ? trim($this->h2_val_ar) : null,
                'alt_text_en' => $this->alt_text_en ? trim($this->alt_text_en) : null,
                'alt_text_ar' => $this->alt_text_ar ? trim($this->alt_text_ar) : null,
                'image_title_text_en' => $this->image_title_text_en ? trim($this->image_title_text_en) : null,
                'image_title_text_ar' => $this->image_title_text_ar ? trim($this->image_title_text_ar) : null,
            ]);

            DB::commit();

            redirect()->route('dashboard.seo-pages.index')->with('success', 'SEO page updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->submitting = false;
            logger()->error('SEO Page Update Error: ' . $e->getMessage());
            session()->flash('error', 'Failed to update. Please try again.');
        }
    }
};
?>

<div>
    <form wire:submit.prevent='save'>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">SEO Fields — {{ $seoPage->display_name }}</h6>
                        <button type="button" class="btn btn-sm btn-primary" wire:click="generateSeoFields"
                            wire:loading.attr="disabled" wire:target="generateSeoFields">
                            <span wire:loading.remove wire:target="generateSeoFields">
                                <i class="fas fa-magic"></i> Generate with AI
                            </span>
                            <span wire:loading wire:target="generateSeoFields">
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                Generating...
                            </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info small mb-3">
                            <i class="fas fa-info-circle"></i> AI will generate SEO-optimized content for Al Jeel Contracting based on the page type.
                        </div>

                        @error('seo_generation')
                            <div class="alert alert-danger small">{{ $message }}</div>
                        @enderror

                        @if (session('success'))
                            <div class="alert alert-success small">{{ session('success') }}</div>
                        @endif

                        <div class="row">
                            {{-- SEO Title English --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seo_title_en">SEO Title (English) <small class="text-muted">(50–60 chars)</small></label>
                                    <textarea class="form-control" id="seo_title_en" wire:model='seo_title_en' rows="2" maxlength="60"></textarea>
                                    <small class="text-muted">{{ strlen($seo_title_en ?? '') }} / 60</small>
                                </div>
                            </div>

                            {{-- SEO Title Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="seo_title_ar">SEO Title (Arabic) <small class="text-muted">(50–60 chars)</small></label>
                                    <textarea class="form-control" id="seo_title_ar" wire:model='seo_title_ar' rows="2" maxlength="60" dir="rtl"></textarea>
                                    <small class="text-muted">{{ strlen($seo_title_ar ?? '') }} / 60</small>
                                </div>
                            </div>

                            {{-- Meta Description English --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta_desc_en">Meta Description (English) <small class="text-muted">(140–160 chars)</small></label>
                                    <textarea class="form-control" id="meta_desc_en" wire:model='meta_desc_en' rows="3" maxlength="160"></textarea>
                                    <small class="text-muted">{{ strlen($meta_desc_en ?? '') }} / 160</small>
                                </div>
                            </div>

                            {{-- Meta Description Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta_desc_ar">Meta Description (Arabic) <small class="text-muted">(140–160 chars)</small></label>
                                    <textarea class="form-control" id="meta_desc_ar" wire:model='meta_desc_ar' rows="3" maxlength="160" dir="rtl"></textarea>
                                    <small class="text-muted">{{ strlen($meta_desc_ar ?? '') }} / 160</small>
                                </div>
                            </div>

                            {{-- H1 English --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="h1_val_en">H1 (English)</label>
                                    <textarea class="form-control" id="h1_val_en" wire:model='h1_val_en' rows="2"></textarea>
                                </div>
                            </div>

                            {{-- H1 Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="h1_val_ar">H1 (Arabic)</label>
                                    <textarea class="form-control" id="h1_val_ar" wire:model='h1_val_ar' rows="2" dir="rtl"></textarea>
                                </div>
                            </div>

                            {{-- H2 English --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="h2_val_en">H2 (English)</label>
                                    <textarea class="form-control" id="h2_val_en" wire:model='h2_val_en' rows="2"></textarea>
                                </div>
                            </div>

                            {{-- H2 Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="h2_val_ar">H2 (Arabic)</label>
                                    <textarea class="form-control" id="h2_val_ar" wire:model='h2_val_ar' rows="2" dir="rtl"></textarea>
                                </div>
                            </div>

                            {{-- Alt Text English --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alt_text_en">Alt Text (English)</label>
                                    <input type="text" class="form-control" id="alt_text_en" wire:model='alt_text_en'>
                                </div>
                            </div>

                            {{-- Alt Text Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alt_text_ar">Alt Text (Arabic)</label>
                                    <input type="text" class="form-control" id="alt_text_ar" wire:model='alt_text_ar' dir="rtl">
                                </div>
                            </div>

                            {{-- Image Title English --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image_title_text_en">Image Title (English)</label>
                                    <input type="text" class="form-control" id="image_title_text_en" wire:model='image_title_text_en'>
                                </div>
                            </div>

                            {{-- Image Title Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image_title_text_ar">Image Title (Arabic)</label>
                                    <input type="text" class="form-control" id="image_title_text_ar" wire:model='image_title_text_ar' dir="rtl">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                                wire:target="save" wire:loading.class="btn-secondary">
                                <span wire:loading wire:target="save">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </span>
                                <span wire:loading.remove wire:target="save">
                                    Save
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
