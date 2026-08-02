<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}"
        class="brand-link d-flex align-items-center justify-content-center"
        style="height: 140px; background: #f4f6f9;">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Smart Zone" class="p-3 h-100" style="object-fit: contain;">
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center justify-content-between px-3">
            <div class="info d-flex align-items-center">
                <div class="mr-2 rounded-circle bg-light text-dark d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fas fa-user"></i>
                </div>
                <a href="#" class="d-block text-white text-sm font-weight-bold">
                    {{ auth()->user()->name }}
                </a>
            </div>
            <a class="btn btn-sm btn-danger" href="{{ route('dashboard.logout') }}" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-uppercase text-xs text-secondary px-3 mt-2 mb-2">Main</li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" @class(['nav-link', 'active' => request()->routeIs('dashboard')])>
                        <i class="nav-icon fas fa-home"></i>
                        <p class="mb-0">Home</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase text-xs text-secondary px-3 mt-3 mb-2">Content</li>

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.projects.*') || request()->routeIs('dashboard.categories.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.projects.*') || request()->routeIs('dashboard.categories.*'),
                    ])>
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p class="mb-0">
                            Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.categories.index') }}" @class([
                                'nav-link',
                                'active' =>
                                    request()->routeIs('dashboard.categories.index') ||
                                    request()->routeIs('dashboard.categories.edit') ||
                                    request()->routeIs('dashboard.categories.create'),
                            ])>
                                <i class="far fa-folder nav-icon"></i>
                                <p class="mb-0">Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.projects.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.projects.index') || request()->routeIs('dashboard.projects.edit') || request()->routeIs('dashboard.projects.create') || request()->routeIs('dashboard.projects.gallery'),
                            ])>
                                <i class="far fa-images nav-icon"></i>
                                <p class="mb-0">Projects</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li @class([
                    'nav-item',
                    'menu-open' =>
                        request()->routeIs('dashboard.aboutUs.*') ||
                        request()->routeIs('dashboard.Vision.*') ||
                        request()->routeIs('dashboard.Mission.*') ||
                        request()->routeIs('dashboard.Values.*') ||
                        request()->routeIs('dashboard.feature.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' =>
                            request()->routeIs('dashboard.aboutUs.*') ||
                            request()->routeIs('dashboard.Vision.*') ||
                            request()->routeIs('dashboard.Mission.*') ||
                            request()->routeIs('dashboard.Values.*') ||
                            request()->routeIs('dashboard.feature.*'),
                    ])>
                        <i class="nav-icon fas fa-users"></i>
                        <p class="mb-0">
                            Who we are
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.aboutUs.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.aboutUs.*'),
                            ])>
                                <i class="far fa-info-circle nav-icon"></i>
                                <p class="mb-0">About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Vision.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.Vision.*'),
                            ])>
                                <i class="far fa-eye nav-icon"></i>
                                <p class="mb-0">Our Vision</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Mission.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.Mission.*'),
                            ])>
                                <i class="far fa-bullseye nav-icon"></i>
                                <p class="mb-0">Our Mission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Values.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.Values.*'),
                            ])>
                                <i class="fas fa-gem nav-icon"></i>
                                <p class="mb-0">Our Value</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.feature.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.feature.*'),
                            ])>
                                <i class="fas fa-star nav-icon"></i>
                                <p class="mb-0">Our Feature</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.contactUs.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.contactUs.*'),
                    ])>
                        <i class="nav-icon fas fa-envelope"></i>
                        <p class="mb-0">
                            Contact us
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.contactUs.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.contactUs.index') || request()->routeIs('dashboard.contactUs.edit'),
                            ])>
                                <i class="far fa-address-card nav-icon"></i>
                                <p class="mb-0">Contact us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.contactUs.contact-us-requests') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.contactUs.contact-us-requests'),
                            ])>
                                <i class="fas fa-inbox nav-icon"></i>
                                <p class="mb-0">Contact us requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.contactUs.consultation-requests') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.contactUs.consultation-requests') || request()->routeIs('dashboard.contactUs.consultation-request-show'),
                            ])>
                                <i class="fas fa-comment-medical nav-icon"></i>
                                <p class="mb-0">Consultation Requests</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.Services.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.Services.*'),
                    ])>
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p class="mb-0">
                            Services
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Services.index') }}" @class([
                                'nav-link',
                                'active' =>
                                    request()->routeIs('dashboard.Services.index') ||
                                    request()->routeIs('dashboard.Services.edit') ||
                                    request()->routeIs('dashboard.Services.create') ||
                                    request()->routeIs('dashboard.Services.gallery'),
                            ])>
                                <i class="fas fa-tools nav-icon"></i>
                                <p class="mb-0">Services</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.sliders.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.sliders.*'),
                    ])>
                        <i class="nav-icon fas fa-images"></i>
                        <p class="mb-0">
                            Banner
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.sliders.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.sliders.*'),
                            ])>
                                <i class="fas fa-photo-video nav-icon"></i>
                                <p class="mb-0">Banner sliders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.pageDesign.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.pageDesign.*'),
                    ])>
                        <i class="nav-icon fas fa-palette"></i>
                        <p class="mb-0">
                            Page Design
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.pageDesign.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.pageDesign.*'),
                            ])>
                                <i class="fas fa-object-group nav-icon"></i>
                                <p class="mb-0">Page Design</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.termsAndConditions.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.termsAndConditions.*'),
                    ])>
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p class="mb-0">Terms And Conditions</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.privacyPolicy.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.privacyPolicy.*'),
                    ])>
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p class="mb-0">Privacy Policy</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.faq.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.faq.*'),
                    ])>
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p class="mb-0">Faq</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.blogs.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.blogs.*'),
                    ])>
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p class="mb-0">Blogs</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase text-xs text-secondary px-3 mt-3 mb-2">Administration</li>

                @if(auth()->user()?->email === 'seo-admin@smartzone.com')
                    <li @class([
                        'nav-item',
                        'menu-open' => request()->routeIs('dashboard.seo-pages.*'),
                    ])>
                        <a href="#" @class([
                            'nav-link',
                            'active' => request()->routeIs('dashboard.seo-pages.*'),
                        ])>
                            <i class="nav-icon fas fa-cog"></i>
                            <p class="mb-0">
                                Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.seo-pages.index') }}" @class([
                                    'nav-link',
                                    'active' => request()->routeIs('dashboard.seo-pages.*'),
                                ])>
                                    <i class="fas fa-search nav-icon"></i>
                                    <p class="mb-0">SEO Pages</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('dashboard.support-tickets.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.support-tickets.*'),
                    ])>
                        <i class="nav-icon fas fa-life-ring"></i>
                        <p class="mb-0">Support Tickets</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
