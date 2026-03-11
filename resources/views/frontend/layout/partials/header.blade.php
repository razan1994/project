<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position:relative;z-index:1000;">
    <div class="dextheme-container">
        <div class="d-flex flex-column w-100">
            <div class="subnavbar-top d-flex align-items-center">
                <img src="{{ asset('assets/images/Logo.png') }}" alt="logo" class="logo-brand">
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="top-contact-info ms-auto d-none d-lg-block">
                    <ul class="navbar-nav mb-lg-0 contact-info-list">
                        <li class="nav-item">
                            <i class="bg-primary svg-icon map-point-icon"></i>
                            <span>
                                {{ $contact?->address ?? '-' }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <i class="bg-primary svg-icon email-icon"></i>
                            <span>{{ $contact?->email ?? '-' }}</span>
                        </li>
                        <li class="nav-item">
                            <i class="bg-primary svg-icon phone-icon"></i>
                            <span>{{ $contact?->phone ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="subnavbar-bottom d-flex d-none d-lg-flex">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about-us') }}">Company</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-expand" href="#" id="navbarService" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu gradient-border" aria-labelledby="navbarService">
                                <li><a class="dropdown-item" href="{{ route('services') }}">All Services</a></li>
                                @foreach(($services ?? []) as $service)
                                    @if(is_object($service))
                                        <li><a class="dropdown-item" href="{{ route('services.details', $service->slug) }}">{{ $service->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('design-build-project') }}">Design Build Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact-us') }}">Contact</a>
                        </li>
                    </ul>
                </div>
                <a style="font-family: 'Tajawal', sans-serif;" href="#" class="dextheme-btn btn-primary hover-outline-normal">عربي <i
                        class="icon icon-plus"></i></a>
            </div>
        </div>
    </div>
</nav>
<div class="dextheme-menu-drawer">
    <div class="drawer-inner">
        <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#home-collapse" aria-expanded="false">
                    Home
                </a>
                <div class="collapse submenu-drawer" id="home-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home 1</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home 2</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#company-collapse" aria-expanded="false">
                    Company
                </a>
                <div class="collapse submenu-drawer" id="company-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="{{ route('about-us') }}" class="nav-link">About Us 1</a></li>
                        <li class="nav-item"><a href="{{ route('about-us') }}" class="nav-link">About Us 2</a></li>
                        <li class="nav-item"><a href="{{ route('about-us') }}" class="nav-link">History</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#services-collapse" aria-expanded="false">
                    Services
                </a>
                <div class="collapse submenu-drawer" id="services-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services 1</a></li>
                        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services 2</a></li>
                        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Single Service 1</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Single Service 2
                                (New)</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#projects-collapse" aria-expanded="false">
                    Projects
                </a>
                <div class="collapse submenu-drawer" id="projects-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="{{ route('design-build-project') }}" class="nav-link">Project 1</a></li>
                        <li class="nav-item"><a href="{{ route('design-build-project') }}" class="nav-link">Project 2</a></li>
                        <li class="nav-item"><a href="{{ route('design-build-project') }}" class="nav-link">Single Project</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#pages-collapse" aria-expanded="false">
                    Pages
                </a>
                <div class="collapse submenu-drawer" id="pages-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Our Team 1</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Our Team 2 (New)</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Pricing 1</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Pricing 2 (New)</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Career</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Testimonials</a></li>
                        <li class="nav-item"><a href="{{ route('faqs') }}" class="nav-link">FAQs</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}#latest-news-section" class="nav-link">Blog</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">404 Page</a></li>
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Coming Soon (New)</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <a href="{{ route('contact-us') }}" class="nav-link p-3 pt-0">
                    Contact
                </a>
            </li>
        </ul>
    </div>
</div>
