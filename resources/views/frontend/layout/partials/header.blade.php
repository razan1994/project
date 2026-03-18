<!-- Navbar -->
<nav class="navbar navbar-expand-lg custom-navbar">
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
                        <a class="nav-link" href="{{ route('about-us') }}">About us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-expand" href="#" id="navbarService" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu gradient-border" aria-labelledby="navbarService">
                            <li><a class="dropdown-item" href="{{ route('services') }}">All Services</a></li>
                            @foreach ($services as $service)
                                <li>
                                    <a class="dropdown-item" href="{{ route('services.details', $service->slug) }}">
                                        {{ $service->title }}
                                    </a>
                                </li>
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
                        @if (!empty($contact?->address))
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($contact->address) }}"
                                target="_blank" rel="noopener noreferrer" title="Address">
                                <i class="bg-primary svg-icon map-point-icon me-1"></i>
                            </a>
                        @else
                            <i class="bg-primary svg-icon map-point-icon me-1"></i>
                        @endif
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @if (!empty($contact?->email))
                            <a href="mailto:{{ $contact->email }}" title="Email">
                                <i class="bg-primary svg-icon email-icon me-1"></i>
                            </a>
                        @else
                            <i class="bg-primary svg-icon email-icon me-1"></i>
                        @endif
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @if (!empty($contact?->phone))
                            <a href="tel:{{ preg_replace('/\D+/', '', (string) $contact->phone) }}" title="Phone">
                                <i class="bg-primary svg-icon phone-icon me-1"></i>
                            </a>
                        @else
                            <i class="bg-primary svg-icon phone-icon me-1"></i>
                        @endif
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <span
                            style="margin-left: 8px; border-left: 1px solid #233658 ; padding-left: 12px; font-family: 'Tajawal', sans-serif; color: #233658 ;font-weight: bold;">عربي</span>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</nav>

<!-- Mobile Drawer -->
<div class="dextheme-menu-drawer" id="mobileDrawer">
    <div class="drawer-inner">
        <ul class="">
            <li class="mb-1">
                <a href="{{ route('home') }}" class="nav-link p-3 pt-0">Home</a>
            </li>

            <li class="mb-1">
                <a href="{{ route('about-us') }}" class="nav-link p-3 pt-0">About us</a>
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

