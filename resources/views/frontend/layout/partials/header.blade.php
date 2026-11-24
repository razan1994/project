<nav class="navbar navbar-expand-xl fixed-top">
    <div class="container">
        <a class="brand d-flex align-items-center" href="index.html"><span
                class="brand-mark">A</span>ARMADA<span>.</span></a>
        <div class="d-flex align-items-center gap-2 order-xl-3">
            {{-- <button class="lang-btn" type="button" aria-label="Switch language">عربي</button> --}}
            <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale() == 'ar' ? 'en' : 'ar') }}"
                class="lang-btn">
                <span class="lang-text">{{ app()->getLocale() == 'ar' ? 'English' : 'عربــي' }}</span>
            </a>
            <a class="btn btn-armada d-none d-sm-inline-flex" href="get-a-quote.html" data-i18n="nav_quote">Get a
                quote</a>
            <button class="navbar-toggler border-0 shadow-none ms-1" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
        </div>
        <div class="collapse navbar-collapse order-xl-2" id="mainNav">
            <ul class="navbar-nav mx-auto align-items-xl-center">
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('about-us')}}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('blogs')}}">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('services')}}">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('projects')}}">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('contact-us')}}">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
