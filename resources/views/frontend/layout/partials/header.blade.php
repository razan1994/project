<!-- Navbar -->
<nav style="background-color: #000" class="navbar navbar-expand-lg custom-navbar">
    <div class="dextheme-container w-100">
        <div class="navbar-layout">

            <!-- Left: Logo -->
            <a href="{{ url('/') }}" class="navbar-brand navbar-brand-custom m-0">
                <img src="{{ asset('assets/images/Logo.png') }}" alt="logo" class="logo-brand">
            </a>

            <!-- Mobile Toggler -->
            <button class="navbar-toggler d-lg-none ms-auto" type="button" id="mobileMenuToggle"
                aria-label="Toggle navigation" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Center: Desktop Navigation -->
            <div class="navbar-center d-none d-lg-flex">

                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
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
                            @foreach ($services ?? [] as $service)
                                @if (is_object($service))
                                    <li><a class="dropdown-item"
                                            href="{{ route('services.details', $service->slug) }}">{{ $service->title }}</a>
                                    </li>
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

            <!-- Right: Contact Info -->
            <div class="top-contact-info d-none d-lg-block">
                <ul class="navbar-nav mb-0 contact-info-list">
                    <li class="nav-item d-flex align-items-center">
                        <i class="bg-primary svg-icon map-point-icon me-1"></i>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <i class="bg-primary svg-icon email-icon me-1"></i>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <i class="bg-primary svg-icon phone-icon me-1"></i>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <span
                            style="margin-left: 8px; border-left: 1px solid #ccc; padding-left: 12px; font-family: 'Tajawal', sans-serif; color: #FFF;font-weight: bold;">عربي</span>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</nav>

<!-- Mobile Drawer -->
<div class="dextheme-menu-drawer" id="mobileDrawer">
    <div class="drawer-inner">
        <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse" data-bs-target="#home-collapse"
                    aria-expanded="false">
                    Home
                </a>
                <div class="collapse submenu-drawer" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="./index.html" class="nav-link">Home 1</a></li>
                        <li class="nav-item"><a href="./home-2.html" class="nav-link">Home 2</a></li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse" data-bs-target="#company-collapse"
                    aria-expanded="false">
                    Company
                </a>
                <div class="collapse submenu-drawer" id="company-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="./about-us-1.html" class="nav-link">About Us 1</a></li>
                        <li class="nav-item"><a href="./about-us-2.html" class="nav-link">About Us 2</a></li>
                        <li class="nav-item"><a href="./history.html" class="nav-link">History</a></li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#services-collapse" aria-expanded="false">
                    Services
                </a>
                <div class="collapse submenu-drawer" id="services-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="./services-1.html" class="nav-link">Services 1</a></li>
                        <li class="nav-item"><a href="./services-2.html" class="nav-link">Services 2</a></li>
                        <li class="nav-item"><a href="./single-service-1.html" class="nav-link">Single Service 1</a>
                        </li>
                        <li class="nav-item"><a href="./single-service-2.html" class="nav-link">Single Service 2
                                (New)</a></li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#projects-collapse" aria-expanded="false">
                    Projects
                </a>
                <div class="collapse submenu-drawer" id="projects-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="./project-1.html" class="nav-link">Project 1</a></li>
                        <li class="nav-item"><a href="./project-2.html" class="nav-link">Project 2</a></li>
                        <li class="nav-item"><a href="./single-project.html" class="nav-link">Single Project</a></li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <a href="#" class="nav-link p-3 pt-0" data-bs-toggle="collapse"
                    data-bs-target="#pages-collapse" aria-expanded="false">
                    Pages
                </a>
                <div class="collapse submenu-drawer" id="pages-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li class="nav-item"><a href="./our-team-1.html" class="nav-link">Our Team 1</a></li>
                        <li class="nav-item"><a href="./our-team-2.html" class="nav-link">Our Team 2 (New)</a></li>
                        <li class="nav-item"><a href="./pricing-1.html" class="nav-link">Pricing 1</a></li>
                        <li class="nav-item"><a href="./pricing-2.html" class="nav-link">Pricing 2 (New)</a></li>
                        <li class="nav-item"><a href="./career.html" class="nav-link">Career</a></li>
                        <li class="nav-item"><a href="./testimonials.html" class="nav-link">Testimonials</a></li>
                        <li class="nav-item"><a href="./faqs.html" class="nav-link">FAQs</a></li>
                        <li class="nav-item"><a href="./blog.html" class="nav-link">Blog</a></li>
                        <li class="nav-item"><a href="./404-page.html" class="nav-link">404 Page</a></li>
                        <li class="nav-item"><a href="./coming-soon.html" class="nav-link">Coming Soon (New)</a></li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <a href="./contact.html" class="nav-link p-3 pt-0">Contact</a>
            </li>
        </ul>
    </div>
</div>

<div class="backdrop" id="drawerBackdrop"></div>
