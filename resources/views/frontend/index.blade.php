@extends('frontend.layout.app')


@push('styles')
@endpush


@push('scripts')
@endpush
@section('content')
    <main>
        <x-frontend.hero-section />
        <x-frontend.services.services-section :services="$services" />
        <x-frontend.about-section :aboutUs="$aboutUs" />
        <section class="section">
            <div class="container">
                <div class="stats-band reveal">
                    <div class="row g-4 text-center">
                        <div class="col-6 col-lg-3">
                            <div class="stat-number">40+</div>
                            <div class="stat-label" data-i18n="stat_projects">Projects delivered</div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="stat-number">30+</div>
                            <div class="stat-label" data-i18n="stat_clients">Happy partnerships</div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="stat-number">5+</div>
                            <div class="stat-label" data-i18n="stat_years">Years of experience</div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label" data-i18n="stat_support">Committed support</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-soft">
            <div class="container">
                <div class="section-heading reveal"><span class="eyebrow" data-i18n="process_eyebrow">HOW WE WORK</span>
                    <h2 data-i18n="process_title">Good work follows a clear process.</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3 reveal">
                        <div class="feature-card">
                            <div class="icon-box"><i class="bi bi-compass"></i></div>
                            <h3 data-i18n="process1"></h3>
                            <p data-i18n="process1d"></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 reveal">
                        <div class="feature-card">
                            <div class="icon-box"><i class="bi bi-lightbulb"></i></div>
                            <h3 data-i18n="process2"></h3>
                            <p data-i18n="process2d"></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 reveal">
                        <div class="feature-card">
                            <div class="icon-box"><i class="bi bi-code-square"></i></div>
                            <h3 data-i18n="process3"></h3>
                            <p data-i18n="process3d"></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 reveal">
                        <div class="feature-card">
                            <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                            <h3 data-i18n="process4"></h3>
                            <p data-i18n="process4d"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <x-frontend.projects.projects-section :projects="$projects" />
        <x-frontend.blogs.blogs-section :blogs="$blogs" />
        <section class="section">
            <div class="container">
                <div class="cta reveal">
                    <div class="row align-items-center position-relative" style="z-index:1">
                        <div class="col-lg-8">
                            <h2 class="display-5 fw-bold" data-i18n="cta_title">Have a project in mind?</h2>
                            <p class="mb-0" data-i18n="cta_desc">Tell us where you want to go.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0"><a
                                class="btn btn-light rounded-pill px-4 py-3 fw-bold" href="get-a-quote.html"
                                data-i18n="cta_button">Let's talk</a></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
