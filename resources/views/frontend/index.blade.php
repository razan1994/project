@extends('frontend.layout.app')


@push('styles')
@endpush


@push('scripts')
@endpush
@section('content')
    <main>
        <section class="hero">
            <div class="container position-relative">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7">
                        <span class="hero-kicker"><span class="pulse-dot"></span><span data-i18n="hero_kicker">Independent
                                digital studio</span></span>
                        <h1 data-i18n="hero_title">Make your next<br><span class="gradient-text">digital move.</span></h1>
                        <p data-i18n="hero_desc">We design, build and grow digital experiences that help ambitious businesses
                            move forward with confidence.</p>
                        <div class="d-flex flex-wrap gap-3 mt-4"><a class="btn btn-armada" href="services.html"
                                data-i18n="explore">Explore what we do</a><a class="btn btn-outline-armada"
                                href="projects.html" data-i18n="nav_projects">Our work</a></div>
                    </div>
                    <div class="col-lg-5">
                        <div class="hero-visual">
                            <div class="visual-orbit">
                                <div class="visual-core"><i class="bi bi-command"></i></div>
                                <div class="float-card float-one"><i class="bi bi-stars text-warning"></i>
                                    Strategy<small>Think with purpose</small></div>
                                <div class="float-card float-two"><i class="bi bi-code-slash"></i> Technology<small>Build
                                        for tomorrow</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="section-heading reveal"><span class="eyebrow" data-i18n="eyebrow">WHAT WE DO</span>
                    <h2 data-i18n="services_title">Digital solutions, thoughtfully made.</h2>
                    <p data-i18n="services_desc">From the first idea to the final launch, we bring strategy, design and
                        technology together.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-xl-4 reveal">
                        <article class="service-card">
                            <div class="icon-box"><i class="bi bi-code-slash"></i></div>
                            <h3 data-i18n="service_web"></h3>
                            <p data-i18n="service_web_desc"></p><a class="text-link" href="service-details.html"><span
                                    data-i18n="learn_more">Learn more</span> <i class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4 reveal">
                        <article class="service-card">
                            <div class="icon-box"><i class="bi bi-diagram-3"></i></div>
                            <h3 data-i18n="service_systems"></h3>
                            <p data-i18n="service_systems_desc"></p><a class="text-link" href="service-details.html"><span
                                    data-i18n="learn_more">Learn more</span> <i class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4 reveal">
                        <article class="service-card">
                            <div class="icon-box"><i class="bi bi-bezier2"></i></div>
                            <h3 data-i18n="service_brand"></h3>
                            <p data-i18n="service_brand_desc"></p><a class="text-link" href="service-details.html"><span
                                    data-i18n="learn_more">Learn more</span> <i class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4 reveal">
                        <article class="service-card">
                            <div class="icon-box"><i class="bi bi-cloud-check"></i></div>
                            <h3 data-i18n="service_host"></h3>
                            <p data-i18n="service_host_desc"></p><a class="text-link" href="service-details.html"><span
                                    data-i18n="learn_more">Learn more</span> <i class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4 reveal">
                        <article class="service-card">
                            <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                            <h3 data-i18n="service_maint"></h3>
                            <p data-i18n="service_maint_desc"></p><a class="text-link" href="service-details.html"><span
                                    data-i18n="learn_more">Learn more</span> <i class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4 reveal">
                        <article class="service-card">
                            <div class="icon-box"><i class="bi bi-building"></i></div>
                            <h3 data-i18n="service_booth"></h3>
                            <p data-i18n="service_booth_desc"></p><a class="text-link" href="service-details.html"><span
                                    data-i18n="learn_more">Learn more</span> <i class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                </div>
                <div class="text-center mt-5"><a href="services.html" class="btn btn-outline-armada"
                        data-i18n="all_services">Explore all services</a></div>
            </div>
        </section>
        <section class="section section-soft">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 reveal">
                        <div class="cover-art"><i class="bi bi-layers"></i></div>
                    </div>
                    <div class="col-lg-6 reveal"><span class="eyebrow" data-i18n="featured">A little about Armada</span>
                        <h2 class="display-5 fw-bold mt-3" data-i18n="about_title">A digital partner built around your
                            ambition.</h2>
                        <p class="text-secondary lh-lg mt-3" data-i18n="about_desc">Armada is a web and digital solutions
                            studio.</p><a class="btn btn-armada mt-3" href="about.html" data-i18n="learn_more">Learn
                            more</a>
                    </div>
                </div>
            </div>
        </section>
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
        <section class="section">
            <div class="container">
                <div class="section-heading reveal"><span class="eyebrow">SELECTED WORK</span>
                    <h2 data-i18n="projects_title">Selected work, real-world impact.</h2>
                    <p data-i18n="projects_desc">A selection of digital experiences and solutions made with purpose.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 reveal">
                        <article class="project-card">
                            <div class="project-art"><i class="bi bi-window-stack"></i></div><span class="tag">WEB
                                EXPERIENCE</span>
                            <h3 class="fw-bold mt-3" data-i18n="project_detail_title">A digital experience designed to
                                move a brand forward</h3>
                            <p class="text-secondary" data-i18n="project_detail_desc">A strategic digital platform.</p><a
                                class="text-link" href="project-details.html" data-i18n="learn_more">Learn more</a>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal">
                        <article class="project-card">
                            <div class="project-art"><i class="bi bi-window-stack"></i></div><span class="tag">WEB
                                EXPERIENCE</span>
                            <h3 class="fw-bold mt-3" data-i18n="project_detail_title">A digital experience designed to
                                move a brand forward</h3>
                            <p class="text-secondary" data-i18n="project_detail_desc">A strategic digital platform.</p><a
                                class="text-link" href="project-details.html" data-i18n="learn_more">Learn more</a>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal">
                        <article class="project-card">
                            <div class="project-art"><i class="bi bi-window-stack"></i></div><span class="tag">WEB
                                EXPERIENCE</span>
                            <h3 class="fw-bold mt-3" data-i18n="project_detail_title">A digital experience designed to
                                move a brand forward</h3>
                            <p class="text-secondary" data-i18n="project_detail_desc">A strategic digital platform.</p><a
                                class="text-link" href="project-details.html" data-i18n="learn_more">Learn more</a>
                        </article>
                    </div>
                </div>
                <div class="text-center mt-5"><a class="btn btn-outline-armada" href="projects.html"
                        data-i18n="view_all">View all</a></div>
            </div>
        </section>
        <section class="section section-soft">
            <div class="container">
                <div class="section-heading reveal"><span class="eyebrow">FROM THE JOURNAL</span>
                    <h2 data-i18n="blog_title">Ideas for a better digital world.</h2>
                    <p data-i18n="blog_desc">Practical insights, useful guides and fresh perspectives from our team.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 reveal">
                        <article class="post-card">
                            <div class="blog-art"><i class="bi bi-journal-code"></i></div><span class="tag">DIGITAL
                                INSIGHTS</span>
                            <div class="post-meta"><span>Nov 6, 2026</span><span>5 min read</span></div>
                            <h3 data-i18n="blog_detail_title">Designing digital experiences that feel effortless</h3>
                            <p data-i18n="article_body">Great digital experiences are not created by visuals alone.</p><a
                                class="text-link" href="blog-details.html" data-i18n="read_article">Read article <i
                                    class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal">
                        <article class="post-card">
                            <div class="blog-art"><i class="bi bi-journal-code"></i></div><span class="tag">DIGITAL
                                INSIGHTS</span>
                            <div class="post-meta"><span>Nov 5, 2026</span><span>5 min read</span></div>
                            <h3 data-i18n="blog_detail_title">Designing digital experiences that feel effortless</h3>
                            <p data-i18n="article_body">Great digital experiences are not created by visuals alone.</p><a
                                class="text-link" href="blog-details.html" data-i18n="read_article">Read article <i
                                    class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-4 reveal">
                        <article class="post-card">
                            <div class="blog-art"><i class="bi bi-journal-code"></i></div><span class="tag">DIGITAL
                                INSIGHTS</span>
                            <div class="post-meta"><span>Nov 4, 2026</span><span>5 min read</span></div>
                            <h3 data-i18n="blog_detail_title">Designing digital experiences that feel effortless</h3>
                            <p data-i18n="article_body">Great digital experiences are not created by visuals alone.</p><a
                                class="text-link" href="blog-details.html" data-i18n="read_article">Read article <i
                                    class="bi bi-arrow-up-right"></i></a>
                        </article>
                    </div>
                </div>
                <div class="text-center mt-5"><a class="btn btn-outline-armada" href="blog.html"
                        data-i18n="view_all">View all</a></div>
            </div>
        </section>
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
