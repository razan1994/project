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
                        <a class="nav-link" href="{{ route('home') }}">{{ __('frontend.navbar_home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about-us') }}">{{ __('frontend.navbar_about_us') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-expand" href="#" id="navbarService" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('frontend.navbar_services') }}
                        </a>
                        <ul class="dropdown-menu gradient-border" aria-labelledby="navbarService">
                            <li><a class="dropdown-item" href="{{ route('services') }}">{{ __('frontend.navbar_all_services') }}</a></li>
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
                        <a class="nav-link" href="{{ route('design-build-project') }}">{{ __('frontend.navbar_design_build') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects') }}">{{ __('frontend.navbar_all_projects') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact-us') }}">{{ __('frontend.navbar_contact') }}</a>
                    </li>
                </ul>


            </div>

            <!-- Right: Contact Info -->
            <div class="top-contact-info d-none d-lg-block">
                <ul class="navbar-nav mb-0 contact-info-list">
                    <li class="nav-item d-flex align-items-center">
                        @if(app()->getLocale() == 'ar')
                            <a href="https://www.google.com/maps?q=26.41349018383555,50.096695884657905" target="_blank" rel="noopener noreferrer" title="Address" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; min-height: 32px; flex-direction: row-reverse;">
                                <span style="display: inline-flex; align-items: center; gap: 8px; flex-direction: row-reverse;">
                                    <i class="bg-primary svg-icon map-point-icon"></i>
                                    <span>{{ $contact?->address ?? __('frontend.footer_add_address') }}</span>
                                </span>
                            </a>
                        @else
                            <a href="https://www.google.com/maps?q=26.41349018383555,50.096695884657905" target="_blank" rel="noopener noreferrer" title="Address" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; min-height: 32px;">
                                <span style="display: inline-flex; align-items: center; gap: 8px;flex-direction: row-reverse;">
                                    <i class="bg-primary svg-icon map-point-icon"></i>
                                    <span>{{ $contact?->address ?? __('frontend.footer_add_address') }}</span>
                                </span>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @if(app()->getLocale() == 'ar')
                            <a  href="{{ '/en' }}" class="dash" style="text-decoration:none">English</a>
                        @else
                            <a href="{{ '/ar' }}" class="dash" style="text-decoration:none;font-family: 'Tajawal', sans-serif;">عربي</a>
                        @endif
                    </li>

                </ul>
            </div>

        </div>
    </div>
</nav>

<!-- Mobile Drawer -->
<div class="dextheme-menu-drawer" id="mobileDrawer">
    <div class="drawer-inner">
        <ul class="mb-3">
            <li class="mb-1">
                <a href="{{ route('home') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_home') }}</a>
            </li>
            <li class="mb-1">
                <a href="{{ route('about-us') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_about_us') }}</a>
            </li>
            <li class="mb-1">
                <a href="{{ route('services') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_services') }}</a>
            </li>
            <li class="mb-1">
                <a href="{{ route('design-build-project') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_design_build') }}</a>
            </li>
            <li class="mb-1">
                <a href="{{ route('gallery') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_gallery') }}</a>
            </li>
            <li class="mb-1">
                <a href="{{ route('projects') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_all_projects') }}</a>
            </li>
            <li class="mb-1">
                <a href="{{ route('contact-us') }}" class="nav-link p-3 pt-0">{{ __('frontend.navbar_contact') }}</a>
            </li>
        </ul>
        <div style="border-top:1px solid #e5e7eb; margin: 16px 0 12px 0;"></div>
        <div class="mobile-contact-info" style="padding: 0 8px;">
            <div style="margin-top: 18px; margin-bottom: 18px; display: flex; justify-content: center;">
                <ul class="navbar-nav" style="flex-direction: row;">
                    <li class="nav-item d-flex align-items-center">
                        @if(app()->getLocale() == 'ar')
                            <a  href="{{ '/en' }}" class="dash" style="text-decoration:none; border-radius: 20px; background: #f1f5f9; padding: 6px 18px; font-weight: 600; color: #233658;">English</a>
                        @else
                            <a  href="{{ '/ar' }}" class="dash" style="text-decoration:none; border-radius: 20px; background: #f1f5f9; padding: 6px 18px; font-weight: 600; color: #233658; font-family: 'Tajawal', sans-serif;">عربي</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div style="border-radius: 14px; box-shadow: 0 2px 10px rgba(30,144,255,0.07); padding: 18px 14px 10px 14px; margin-bottom: 18px;">
                <div style="display: flex; align-items: center; gap: 18px; margin-top: 10px; justify-content: flex-start;">
                    @if (!empty($contact?->facebook))
                        <a href="{{ $contact->facebook }}" target="_blank" rel="noopener noreferrer" title="Facebook" style="color:#4267B2;font-size:1.4rem; border-radius: 50%; padding: 7px 10px;"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (!empty($contact?->instagram))
                        <a href="{{ $contact->instagram }}" target="_blank" rel="noopener noreferrer" title="Instagram" style="color:#E1306C;font-size:1.4rem; border-radius: 50%; padding: 7px 10px;"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (!empty($contact?->youtube))
                        <a href="{{ $contact->youtube }}" target="_blank" rel="noopener noreferrer" title="YouTube" style="color:#FF0000;font-size:1.4rem; border-radius: 50%; padding: 7px 10px;"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if (!empty($contact?->linkedin))
                        <a href="{{ $contact->linkedin }}" target="_blank" rel="noopener noreferrer" title="LinkedIn" style="color:#0077B5;font-size:1.4rem; border-radius: 50%; padding: 7px 10px;"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

