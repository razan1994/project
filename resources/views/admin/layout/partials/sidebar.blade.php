<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex flex-column justify-items-center align-items-center "
        style="height: 140px ;background: #f4f6f9;">
        <img src="{{ asset('assets/images/logo.png') }}" alt="" class="p-3 h-100" style="object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="info d-flex align-items-center">
                <a href="#" class="d-block">
                    {{ auth()->user()->name }}
                </a>
                <a class="py-1 ml-3 btn btn-sm btn-danger" href="{{ route('dashboard.logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- ----------------------------- --}}
                {{-- ********* DASHBOARD ********* --}}
                {{-- ----------------------------- --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" @class(['nav-link', 'active' => request()->routeIs('dashboard')])>
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                {{-- About US --}}

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
                            request()->routeIs('dashboard.Values.*'),
                    ])>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Who we are
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- About Us --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.aboutUs.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.aboutUs.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    About Us
                                </p>
                            </a>
                        </li>



                        {{-- our vision --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Vision.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.Vision.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Our Vision
                                </p>
                            </a>
                        </li>

                        {{-- our mission --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Mission.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.Mission.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Our Mission
                                </p>
                            </a>
                        </li>


                        {{-- our value --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Values.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.Values.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Our Value
                                </p>
                            </a>
                        </li>

                        {{-- our feature --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.feature.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.feature.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Our Feature
                                </p>
                            </a>
                        </li>



                    </ul>
                </li>


                {{-- contact us start --}}

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.contactUs.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.contactUs.*'),
                    ])>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Contact us
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- ===== contact us phones ===== --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.contactUs.index') }}" @class([
                                'nav-link',
                                'active' =>
                                    request()->routeIs('dashboard.contactUs.index') ||
                                    request()->routeIs('dashboard.contactUs.edit'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Contact us
                                </p>
                            </a>
                        </li>

                        {{-- ===== Contact us phones ===== --}}


                        {{-- ===== Contact us requests ===== --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.contactUs.contact-us-requests') }}"
                                @class([
                                    'nav-link',
                                    'active' => request()->routeIs('dashboard.contactUs.contact-us-requests'),
                                ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Contact us requests
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- contact us end   --}}

                {{-- services start --}}
                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.Services.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.Services.*'),
                    ])>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Services
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- ===== Services ===== --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.Services.index') }}" @class([
                                'nav-link',
                                'active' =>
                                    request()->routeIs('dashboard.Services.index') ||
                                    request()->routeIs('dashboard.Services.edit') ||
                                    request()->routeIs('dashboard.Services.create') ||
                                    request()->routeIs('dashboard.Services.gallery'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Services
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- services end   --}}

                {{-- banners start --}}

                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.sliders.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.sliders.*'),
                    ])>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Banner
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- ===== Banner sliders ===== --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.sliders.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.sliders.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Banner sliders
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- banners end   --}}


                {{-- Page Design start --}}
                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.pageDesign.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.pageDesign.*'),
                    ])>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Page Design
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        {{-- ===== Page Design ===== --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.pageDesign.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.pageDesign.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>

                                <p>
                                    Page Design
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- Page Design end --}}

                {{-- Terms And Conditions --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.termsAndConditions.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.termsAndConditions.*'),
                    ])>
                        <i class="nav-icon fas fa-th"></i>
                        <p>Terms And Conditions</p>
                    </a>
                </li>

                {{-- Privacy Policy --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.privacyPolicy.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.privacyPolicy.*'),
                    ])>
                        <i class="nav-icon fas fa-th"></i>
                        <p>Privacy Policy</p>
                    </a>
                </li>

                {{-- Faq --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.faq.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.faq.*'),
                    ])>
                        <i class="nav-icon fas fa-th"></i>
                        <p>Faq</p>
                    </a>
                </li>

                {{-- Blogs --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.blogs.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.blogs.*'),
                    ])>
                        <i class="nav-icon fas fa-th"></i>
                        <p>Blogs</p>
                    </a>
                </li>

                {{-- Settings start --}}
                <li @class([
                    'nav-item',
                    'menu-open' => request()->routeIs('dashboard.seo-pages.*'),
                ])>
                    <a href="#" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.seo-pages.*'),
                    ])>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">


                        {{-- SEO Pages --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard.seo-pages.index') }}" @class([
                                'nav-link',
                                'active' => request()->routeIs('dashboard.seo-pages.*'),
                            ])>
                                <i class="far fa-circle nav-icon"></i>
                                <p>SEO Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Settings end --}}


                {{-- ------------------ --}}
                {{-- ===== SUPPORT TICKETS  ===== --}}
                {{-- ------------------ --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.support-tickets.index') }}" @class([
                        'nav-link',
                        'active' => request()->routeIs('dashboard.support-tickets.*'),
                    ])>
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Support Tickets
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
