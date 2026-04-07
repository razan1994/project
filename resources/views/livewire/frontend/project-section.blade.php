<!-- Project Section -->
<div class="dextheme-section-padding bg-line-o2 bg-line:opaque-20 bg-pos-center-center bg-white bg-line-fixed">
    <div class="dextheme-container">
        <div class="block-heading text-center mb-5">
            <p class="dextheme-sub-title mb-4">{{ __('frontend.projects_subtitle') }}</p>
            <h2 class="dextheme-main-title mb-4">{{ __('frontend.projects_title') }}</h2>
            <p class="dextheme-text-grey mx-auto">
                {{ __('frontend.projects_desc') }}
            </p>
        </div>
        <div class="dextheme-row g-4">
            @forelse ($projects as $project)
                <div class="dextheme-col-lg-6 dextheme-col-md-6 dextheme-col-12">
                    <div class="dextheme-card project-card-alt border-0 gradient-border"
                        style="height:100%;display:flex;flex-direction:column;">
                        <div class="img-wrapper">
                            <img src="{{ !empty($project->image) ? asset($project->image) : asset('assets/images/default-project.png') }}"
                                alt="{{ $project->title }}" class="dextheme-card__img-top"
                                style="width:100%;max-width:100%;height:300px;max-height:300px;object-fit:cover;aspect-ratio:1.5/1;">
                        </div>
                        <div class="dextheme-card__body p-3 mt-3"
                            style="flex:1 1 auto;display:flex;flex-direction:column;justify-content:stretch;min-height:320px;">
                            <div class="p-3">
                                <h4 class="dextheme-title-text sm mb-4">{{ $project->title }}</h4>
                                <p class="plain-text mb-4">{!! $project->sub_description !!}</p>
                                <div style="flex:1 1 auto;"></div>
                                <a href="{{ route('projects.details', $project->slug) }}" class="link mt-2"
                                    style="display:block;margin-top:auto;">
                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-plus" viewBox="0 0 448 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                                        </path>
                                    </svg>
                                    {{ __('frontend.projects_read_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-12">
                    <div class="dextheme-card project-card-alt border-0 gradient-border">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/images/default-project.png') }}" alt="Project"
                                class="dextheme-card__img-top"
                                style="width:100%;max-width:100%;height:220px;max-height:220px;object-fit:cover;aspect-ratio:1.5/1;">
                        </div>
                        <div class="dextheme-card__body p-3 mt-3">
                            <div class="p-3">
                                <h6 class="dextheme-title-uppercase mb-3">{{ __('frontend.projects_default_category') }}
                                </h6>
                                <h4 class="dextheme-title-text sm mb-4">{{ __('frontend.projects_default_title') }}
                                </h4>
                                <p class="plain-text mb-4">{{ __('frontend.projects_default_desc') }}</p>
                                <div style="flex:1 1 auto;"></div>
                                <a href="#" class="link mt-2" style="display:block;margin-top:auto;">
                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-plus" viewBox="0 0 448 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                                        </path>
                                    </svg>
                                    {{ __('frontend.projects_read_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

            <div class="d-flex justify-content-center">
                <a href="{{ route('design-build-project') }}" class="btn btn-primary btn-lg px-5 py-3 d-flex align-items-center" style="gap: 0.5rem;">
                    <i class="fas fa-drafting-compass"></i>
                    {{ __('frontend.dda_button_text') }}
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/gradient-border.css') }}">
@endpush
