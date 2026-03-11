<script type="text/javascript" src="{{ asset('assets/js/countUp.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/progressbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/main.min.js') }}"></script>

@livewireScripts

<script>
    // Configure Livewire for Laravel Localization
    document.addEventListener('DOMContentLoaded', function() {
        const currentLocale = '{{ LaravelLocalization::getCurrentLocale() }}';

        // Configure Livewire when ready
        if (window.Livewire) {
            configureLivewire();
        } else {
            document.addEventListener('livewire:init', configureLivewire);
        }

        function configureLivewire() {
            if (window.Livewire && typeof window.Livewire.hook === 'function') {
                window.Livewire.hook('request', ({
                    uri,
                    options,
                    payload,
                    respond,
                    succeed,
                    fail
                }) => {
                    // Fix URI to include locale prefix
                    if (uri && typeof uri === 'string' && uri === '/livewire/update') {
                        uri = '/' + currentLocale + '/livewire/update';
                    }
                    return {
                        uri,
                        options,
                        payload,
                        respond,
                        succeed,
                        fail
                    };
                });
            }
        }
    });
</script>

<script>
    // Wait for DOM and toastr to be ready
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            // ========== Toaster Messages ==========
            // success messages
            @if (session()->has('success'))
                toastr.success('{{ session()->get('success') }}')
            @endif
            // error messages
            @if (session()->has('error'))
                toastr.error('{{ session()->get('error') }}')
            @endif

            //  error validation messages
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}')
                @endforeach
            @endif
            // ========== End Toaster Messages ==========
        }
    });

    document.addEventListener('livewire:init', () => {
        if (typeof window.Livewire !== 'undefined' && typeof toastr !== 'undefined') {
            // Success Message
            window.Livewire.on('success', (event) => {
                toastr.success(event[0]);
            });
            // Error Message
            window.Livewire.on('error', (event) => {
                toastr.error(event[0]);
            });
            // Info Message
            window.Livewire.on('info', (event) => {
                toastr.info(event[0]);
            });
            // Warning Message
            window.Livewire.on('warning', (event) => {
                toastr.warning(event[0]);
            });
        }
    });
</script>

<script>
    // Handle active state for anchor link navigation
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Function to set active link based on hash
        function setActiveLink() {
            const hash = window.location.hash;

            navLinks.forEach(link => {
                link.classList.remove('active');

                // Check if link href ends with the current hash
                if (hash && link.getAttribute('href') && link.getAttribute('href').endsWith(hash)) {
                    link.classList.add('active');
                }
            });

            // If no hash, set home as active
            if (!hash) {
                navLinks.forEach(link => {
                    if (link.getAttribute('href') === '{{ route('home') }}') {
                        link.classList.add('active');
                    }
                });
            }
        }

        // Set active on page load
        setActiveLink();

        // Update active link when hash changes
        window.addEventListener('hashchange', setActiveLink);

        // Handle smooth scroll and update active state on click
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && href.includes('#')) {
                    const hash = href.split('#')[1];
                    if (hash) {
                        const targetElement = document.getElementById(hash);
                        if (targetElement) {
                            e.preventDefault();
                            targetElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                            window.location.hash = hash;
                        }
                    }
                }
            });
        });
    });
</script>
<!-- Vite JS -->
@vite(['resources/js/app.js'])
