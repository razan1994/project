<div class="dextheme-section-9 dextheme-section-padding bg-secondary">
    <div class="dextheme-container">
        <div class="dextheme-row g-4">
            <div class="dextheme-col-lg-12 dextheme-col-12">
                <div class="dextheme-flex align-items-center h-100">
                    <div class="faq-block">
                        <div class="block-heading mb-4">
                            <p class="dextheme-sub-title text-white mb-4">FAQ</p>
                            <h2 class="dextheme-main-title text-white mb-4">Answers to Your Construction Queries.</h2>
                        </div>

                        <div class="accordion accordion-flush mb-4" id="faqAccordion">
                            @forelse ($faqs as $faq)
                                @php
                                    $headingId = 'faqHeading' . $faq->id;
                                    $collapseId = 'faqCollapse' . $faq->id;
                                @endphp
                                <div class="accordion-item {{ $loop->first ? 'border-top' : '' }} {{ $loop->last ? 'border-bottom' : '' }}">
                                    <h2 class="accordion-header" id="{{ $headingId }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                                            <span class="ms-4 fw-bold">{{ $faq->question }}</span>
                                        </button>
                                    </h2>
                                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body ms-4">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="accordion-item border-top border-bottom">
                                    <h2 class="accordion-header" id="faqHeadingDefault">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseDefault" aria-expanded="true" aria-controls="faqCollapseDefault">
                                            <span class="ms-4 fw-bold">How long does construction take?</span>
                                        </button>
                                    </h2>
                                    <div id="faqCollapseDefault" class="accordion-collapse collapse show" aria-labelledby="faqHeadingDefault" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body ms-4">
                                            Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <p class="text-white mb-4">
                            Donec elementum, sapien vel viverra scelerisque, mauris urna rutrum odio, sed mollis metus
                            lectus vitae ex. Suspendisse a enim pharetra.
                        </p>
                        <button class="dextheme-btn btn-primary hover-bg-white">
                            <i aria-hidden="true" class="icon icon-right-arrow"></i>
                            Explore More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
