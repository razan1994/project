<?php

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

new class extends Component
{
    public ?Project $project = null;

    public ?string $h1_val_en = null;
    public ?string $h1_val_ar = null;
    public ?string $h2_val_en = null;
    public ?string $h2_val_ar = null;
    public ?string $alt_text_en = null;
    public ?string $alt_text_ar = null;
    public ?string $seo_title_en = null;
    public ?string $seo_title_ar = null;
    public ?string $meta_desc_en = null;
    public ?string $meta_desc_ar = null;

    public bool $submitting = false;

    #[On('setProjectSeo')]
    public function setProject(Project $project): void
    {
        $this->project = $project;

        $this->h1_val_en    = $project->h1_val_en;
        $this->h1_val_ar    = $project->h1_val_ar;
        $this->h2_val_en    = $project->h2_val_en;
        $this->h2_val_ar    = $project->h2_val_ar;
        $this->alt_text_en  = $project->alt_text_en;
        $this->alt_text_ar  = $project->alt_text_ar;
        $this->seo_title_en = $project->seo_title_en;
        $this->seo_title_ar = $project->seo_title_ar;
        $this->meta_desc_en = $project->meta_desc_en;
        $this->meta_desc_ar = $project->meta_desc_ar;
    }

    public function generateSeoFields(): void
    {
        $this->resetErrorBag('seo_generation');
        set_time_limit(120);

        $titleEn  = $this->project->title_en;
        $titleAr  = $this->project->title_ar;
        $siteName = config('app.name', 'Aljeel');

        try {
            $schema = new ObjectSchema(
                name: 'seo_fields',
                description: 'SEO fields for a construction company project portfolio page',
                properties: [
                    new StringSchema('h1_val_en', 'Primary English H1 heading for the project portfolio page'),
                    new StringSchema('h1_val_ar', 'Primary Arabic H1 heading for the project portfolio page, natural and fluent'),
                    new StringSchema('h2_val_en', 'Supporting English H2 that highlights the project scope or achievement'),
                    new StringSchema('h2_val_ar', 'Supporting Arabic H2 that highlights the project scope or achievement'),
                    new StringSchema('alt_text_en', 'Descriptive English alt text for the project main image'),
                    new StringSchema('alt_text_ar', 'Descriptive Arabic alt text for the project main image'),
                    new StringSchema('seo_title_en', 'English SEO meta title, concise and ideally 50-60 characters'),
                    new StringSchema('seo_title_ar', 'Arabic SEO meta title, concise and ideally 50-60 characters'),
                    new StringSchema('meta_desc_en', 'English SEO meta description, ideally 140-160 characters'),
                    new StringSchema('meta_desc_ar', 'Arabic SEO meta description, ideally 140-160 characters'),
                ],
                requiredFields: [
                    'h1_val_en', 'h1_val_ar', 'h2_val_en', 'h2_val_ar',
                    'alt_text_en', 'alt_text_ar', 'seo_title_en', 'seo_title_ar',
                    'meta_desc_en', 'meta_desc_ar',
                ]
            );

            $prompt  = "You are an expert multilingual SEO specialist for a construction and architecture company called '{$siteName}' based in Saudi Arabia.\n\n";
            $prompt .= "Generate high-quality SEO fields for a project portfolio detail page with the following details:\n";
            $prompt .= "- Project name (English): \"{$titleEn}\"\n";
            $prompt .= "- Project name (Arabic): \"{$titleAr}\"\n\n";
            $prompt .= "The company specializes in construction, architecture, and engineering projects in Saudi Arabia.\n";
            $prompt .= "This is a project showcase/portfolio page highlighting a completed or ongoing construction project.\n";
            $prompt .= "Do not invent facts or details beyond what is provided.\n";
            $prompt .= "Avoid keyword stuffing, repetition, and exaggerated marketing language.\n";
            $prompt .= "English output must be clear, professional, concise, and optimized for search intent.\n";
            $prompt .= "Arabic output must be natural, fluent, and suitable for the Saudi and Arab market.\n";
            $prompt .= "H1 should clearly present the project name and type.\n";
            $prompt .= "H2 should highlight a key aspect of the project (e.g., scale, innovation, location).\n";
            $prompt .= "SEO titles should be readable, ideally 50-60 characters, and MUST include 'in Saudi Arabia' (English) or 'في السعودية' (Arabic) for local SEO optimization (e.g., 'Luxury Villa Construction in Saudi Arabia | {$siteName}').\n";
            $prompt .= "Meta descriptions should be compelling, informative, and ideally 140-160 characters.\n";
            $prompt .= "Return clean, production-ready SEO content only.\n";

            $response = Prism::structured()
                ->using(Provider::Mistral, 'mistral-large-latest')
                ->withSchema($schema)
                ->withPrompt($prompt)
                ->withClientOptions([
                    'timeout'         => 60,
                    'connect_timeout' => 10,
                    'verify'          => ($caFile = config('prism.providers.mistral.cafile'))
                        ? base_path($caFile)
                        : storage_path('certs/cacert.pem'),
                ])
                ->asStructured();

            $seoData = $response->structured;

            $this->h1_val_en    = $seoData['h1_val_en'] ?? null;
            $this->h1_val_ar    = $seoData['h1_val_ar'] ?? null;
            $this->h2_val_en    = $seoData['h2_val_en'] ?? null;
            $this->h2_val_ar    = $seoData['h2_val_ar'] ?? null;
            $this->alt_text_en  = $seoData['alt_text_en'] ?? null;
            $this->alt_text_ar  = $seoData['alt_text_ar'] ?? null;
            $this->seo_title_en = $seoData['seo_title_en'] ?? null;
            $this->seo_title_ar = $seoData['seo_title_ar'] ?? null;
            $this->meta_desc_en = $seoData['meta_desc_en'] ?? null;
            $this->meta_desc_ar = $seoData['meta_desc_ar'] ?? null;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            logger()->error('Project SEO Generation Timeout: ' . $e->getMessage());
            $this->addError('seo_generation', 'SEO generation timed out. Please try again.');
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            logger()->error('Project SEO Generation Timeout: ' . $e->getMessage());
            $this->addError('seo_generation', 'SEO generation timed out. Please try again.');
        } catch (\Exception $e) {
            logger()->error('Project SEO Generation Error: ' . $e->getMessage());
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
            $this->project->update([
                'h1_val_en'    => $this->h1_val_en    ? trim($this->h1_val_en)    : null,
                'h1_val_ar'    => $this->h1_val_ar    ? trim($this->h1_val_ar)    : null,
                'h2_val_en'    => $this->h2_val_en    ? trim($this->h2_val_en)    : null,
                'h2_val_ar'    => $this->h2_val_ar    ? trim($this->h2_val_ar)    : null,
                'alt_text_en'  => $this->alt_text_en  ? trim($this->alt_text_en)  : null,
                'alt_text_ar'  => $this->alt_text_ar  ? trim($this->alt_text_ar)  : null,
                'seo_title_en' => $this->seo_title_en ? trim($this->seo_title_en) : null,
                'seo_title_ar' => $this->seo_title_ar ? trim($this->seo_title_ar) : null,
                'meta_desc_en' => $this->meta_desc_en ? trim($this->meta_desc_en) : null,
                'meta_desc_ar' => $this->meta_desc_ar ? trim($this->meta_desc_ar) : null,
            ]);

            DB::commit();
            $this->submitting = false;
            $this->dispatch('closeProjectSeoModal');
            session()->flash('success', 'Project SEO updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->submitting = false;
            logger()->error('Project SEO Update Error: ' . $e->getMessage());
            session()->flash('error', 'Failed to update SEO. Please try again.');
        }
    }
};
?>

<div>
    <form wire:submit.prevent="save">
        <div class="modal-body">
            @if ($project)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">SEO Fields — {{ $project->title_en }}</h6>
                    <button type="button" class="btn btn-sm btn-primary" wire:click="generateSeoFields"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="generateSeoFields">
                            <i class="fas fa-magic"></i> Generate with AI
                        </span>
                        <span wire:loading wire:target="generateSeoFields">
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                            Generating...
                        </span>
                    </button>
                </div>

                <div class="alert alert-info small">
                    <i class="fas fa-info-circle"></i> AI will generate SEO-optimized content based on the project name.
                </div>

                @error('seo_generation')
                    <div class="alert alert-danger small">{{ $message }}</div>
                @enderror

                <div class="row">
                    {{-- H1 English --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>H1 (English)</label>
                            <textarea class="form-control" wire:model="h1_val_en" rows="2"></textarea>
                        </div>
                    </div>
                    {{-- H1 Arabic --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>H1 (Arabic)</label>
                            <textarea class="form-control" wire:model="h1_val_ar" rows="2" dir="rtl"></textarea>
                        </div>
                    </div>

                    {{-- H2 English --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>H2 (English)</label>
                            <textarea class="form-control" wire:model="h2_val_en" rows="2"></textarea>
                        </div>
                    </div>
                    {{-- H2 Arabic --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>H2 (Arabic)</label>
                            <textarea class="form-control" wire:model="h2_val_ar" rows="2" dir="rtl"></textarea>
                        </div>
                    </div>

                    {{-- Alt Text English --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alt Text (English)</label>
                            <textarea class="form-control" wire:model="alt_text_en" rows="2"></textarea>
                        </div>
                    </div>
                    {{-- Alt Text Arabic --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alt Text (Arabic)</label>
                            <textarea class="form-control" wire:model="alt_text_ar" rows="2" dir="rtl"></textarea>
                        </div>
                    </div>

                    {{-- SEO Title English --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SEO Title (English) <small class="text-muted">(50-60 chars)</small></label>
                            <textarea class="form-control" wire:model="seo_title_en" rows="2" maxlength="60"></textarea>
                            <small class="text-muted">{{ strlen($seo_title_en ?? '') }} / 60</small>
                        </div>
                    </div>
                    {{-- SEO Title Arabic --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SEO Title (Arabic) <small class="text-muted">(50-60 chars)</small></label>
                            <textarea class="form-control" wire:model="seo_title_ar" rows="2" maxlength="60" dir="rtl"></textarea>
                            <small class="text-muted">{{ strlen($seo_title_ar ?? '') }} / 60</small>
                        </div>
                    </div>

                    {{-- Meta Description English --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Meta Description (English) <small class="text-muted">(140-160 chars)</small></label>
                            <textarea class="form-control" wire:model="meta_desc_en" rows="3" maxlength="160"></textarea>
                            <small class="text-muted">{{ strlen($meta_desc_en ?? '') }} / 160</small>
                        </div>
                    </div>
                    {{-- Meta Description Arabic --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Meta Description (Arabic) <small class="text-muted">(140-160 chars)</small></label>
                            <textarea class="form-control" wire:model="meta_desc_ar" rows="3" maxlength="160" dir="rtl"></textarea>
                            <small class="text-muted">{{ strlen($meta_desc_ar ?? '') }} / 160</small>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            @if ($project)
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading wire:target="save">
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                    </span>
                    <span wire:loading.remove wire:target="save">Save SEO</span>
                </button>
            @endif
        </div>
    </form>
</div>
