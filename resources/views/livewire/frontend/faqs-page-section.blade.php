<div>
    <!-- Heading -->
    <div class="dextheme-heading" data-bg="{{ asset('assets/images/breadcamp.webp') }}">
        <div class="dextheme-heading__inner">
            <h2>{{ __('frontend.faqs_title') }}</h2>
            <div class="dextheme-heading__inner__breadcrumb">
                <p><a href="{{ route('home') }}">{{ __('frontend.navbar_home') }}</a> - {{ __('frontend.faqs_title') }}</p>
            </div>
        </div>
    </div>

    <!-- FAQs Section -->
    <div class="dextheme-section-padding bg-white">
        <div class="dextheme-container">
            <div class="faqs-heading mb-5">
                <p class="dextheme-sub-title mb-4">{{ __('frontend.faqs_subtitle') }}</p>
                <h2 class="dextheme-main-title mb-4">{{ __('frontend.faqs_main_title') }}</h2>
                <p class="dextheme-text-grey">{{ __('frontend.faqs_desc') }}</p>
            </div>

            <div class="faqs-block">
                <div class="dextheme-row g-4">
                    <div class="dextheme-col-lg-6 dextheme-col-12">
                        <div class="faqs-accordion">
                            <div class="accordion accordion-flush mb-4" id="accordionExample">
                                @forelse ($leftFaqs as $faq)
                                    @php
                                        $headingId = 'faqLeftHeading' . $faq->id;
                                        $collapseId = 'faqLeftCollapse' . $faq->id;
                                    @endphp
                                    <div class="accordion-item {{ $loop->last ? 'border-bottom' : '' }}">
                                        <h2 class="accordion-header" id="{{ $headingId }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                                                <span class="fw-bold">{{ $faq->question }}</span>
                                            </button>
                                        </h2>
                                        <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-4 dextheme-text-grey mb-4 mt-2">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="accordion-item border-bottom">
                                        <h2 class="accordion-header" id="faqLeftHeadingDefault">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqLeftCollapseDefault" aria-expanded="true" aria-controls="faqLeftCollapseDefault">
                                                <span class="fw-bold">{{ __('frontend.faqs_none_found') }}</span>
                                            </button>
                                        </h2>
                                        <div id="faqLeftCollapseDefault" class="accordion-collapse collapse show" aria-labelledby="faqLeftHeadingDefault" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-4 dextheme-text-grey mb-4 mt-2">
                                                {{ __('frontend.faqs_none_dashboard') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="dextheme-col-lg-6 dextheme-col-12">
                        <div class="faqs-accordion">
                            <div class="accordion accordion-flush mb-4" id="accordionExample1">
                                @forelse ($rightFaqs as $faq)
                                    @php
                                        $headingId = 'faqRightHeading' . $faq->id;
                                        $collapseId = 'faqRightCollapse' . $faq->id;
                                    @endphp
                                    <div class="accordion-item {{ $loop->last ? 'border-bottom' : '' }}">
                                        <h2 class="accordion-header" id="{{ $headingId }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                                                <span class="fw-bold">{{ $faq->question }}</span>
                                            </button>
                                        </h2>
                                        <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionExample1">
                                            <div class="accordion-body ms-4 dextheme-text-grey mb-4 mt-2">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="accordion-item border-bottom">
                                        <h2 class="accordion-header" id="faqRightHeadingDefault">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqRightCollapseDefault" aria-expanded="true" aria-controls="faqRightCollapseDefault">
                                                <span class="fw-bold">{{ __('frontend.faqs_none_found') }}</span>
                                            </button>
                                        </h2>
                                        <div id="faqRightCollapseDefault" class="accordion-collapse collapse show" aria-labelledby="faqRightHeadingDefault" data-bs-parent="#accordionExample1">
                                            <div class="accordion-body ms-4 dextheme-text-grey mb-4 mt-2">
                                                {{ __('frontend.faqs_none_dashboard') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.layout.partials.contact-section')
</div>
