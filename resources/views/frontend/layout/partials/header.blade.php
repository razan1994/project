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
                <a href="{{ route('home') }}" class="nav-link p-3 pt-0">Home</a>
            </li>

            <li class="mb-1">
                <a href="{{ route('about-us') }}" class="nav-link p-3 pt-0">Company</a>
            </li>

            <li class="mb-1">
                <a href="{{ route('services') }}" class="nav-link p-3 pt-0">Services</a>
            </li>

            <li class="mb-1">
                <a href="{{ route('design-build-project') }}" class="nav-link p-3 pt-0">Design Build Projects</a>
            </li>


            <li class="mb-1">
                <a href="{{ route('contact-us') }}" class="nav-link p-3 pt-0">Contact</a>
            </li>
        </ul>
    </div>
</div>

<div class="backdrop" id="drawerBackdrop"></div>
