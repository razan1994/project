    <!-- Social Media Floating Bar -->
    <div class="social-float-bar">
        <a href="https://facebook.com/yourpage" target="_blank" class="social-float-icon facebook" title="Facebook">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>
        </a>
        <a href="https://instagram.com/yourprofile" target="_blank" class="social-float-icon instagram" title="Instagram">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.974.974 1.246 2.241 1.308 3.608.058 1.266.069 1.646.069 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.974.974-2.241 1.246-3.608 1.308-1.266.058-1.646.069-4.85.069s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.974-.974-1.246-2.241-1.308-3.608C2.175 15.647 2.163 15.267 2.163 12s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608C4.515 2.497 5.782 2.225 7.148 2.163 8.414 2.105 8.794 2.094 12 2.094m0-2.163C8.741 0 8.332.012 7.052.07 5.771.128 4.659.334 3.678 1.315c-.98.98-1.187 2.092-1.245 3.373C2.012 5.668 2 6.077 2 12c0 5.923.012 6.332.07 7.612.058 1.281.265 2.393 1.245 3.373.98.98 2.092 1.187 3.373 1.245C8.332 23.988 8.741 24 12 24s3.668-.012 4.948-.07c1.281-.058 2.393-.265 3.373-1.245.98-.98 1.187-2.092 1.245-3.373.058-1.28.07-1.689.07-7.612 0-5.923-.012-6.332-.07-7.612-.058-1.281-.265-2.393-1.245-3.373-.98-.98-2.092-1.187-3.373-1.245C15.668.012 15.259 0 12 0z"/><path d="M12 5.838A6.162 6.162 0 0 0 5.838 12 6.162 6.162 0 0 0 12 18.162 6.162 6.162 0 0 0 18.162 12 6.162 6.162 0 0 0 12 5.838zm0 10.162A3.999 3.999 0 1 1 12 8a3.999 3.999 0 0 1 0 7.999zm6.406-11.845a1.44 1.44 0 1 0 0 2.88 1.44 1.44 0 0 0 0-2.88z"/></svg>
        </a>
        <a href="tel:1234567890" class="social-float-icon call" title="Call">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 0 0 6.59 6.59l2.2-2.2a1.003 1.003 0 0 1 1.01-.24c1.12.37 2.33.57 3.59.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.07 21 3 13.93 3 5c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.26.2 2.47.57 3.59.11.32.03.68-.24 1.01l-2.2 2.19z"/></svg>
        </a>
    </div>
    <style>
    .social-float-bar {
        position: absolute;
        top: 50%;
        right: 24px;
        transform: translateY(-50%);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 16px;
        animation: fadeInUp 1s;
    }
    .social-float-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: #3b5998;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        font-size: 22px;
        transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
        text-decoration: none;
        opacity: 0.95;
        animation: bounceIn 0.8s;
    }
    .social-float-icon.facebook { background: #3b5998; }
    .social-float-icon.instagram { background: radial-gradient(circle at 30% 110%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); }
    .social-float-icon.call { background: #25d366; }
    .social-float-icon:hover {
        transform: scale(1.12) rotate(-6deg);
        box-shadow: 0 4px 16px rgba(0,0,0,0.18);
        opacity: 1;
    }
    @keyframes bounceIn {
        0% { transform: scale(0.5) translateY(40px); opacity: 0; }
        60% { transform: scale(1.1) translateY(-10px); opacity: 1; }
        100% { transform: scale(1) translateY(0); opacity: 0.95; }
    }
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    </style>
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- ======================= head Start-->
    @include('frontend.layout.partials.head')
    <!-- ======================= head End-->

    <!-- ======================= styles Start-->
    @include('frontend.layout.partials.styles')
    <!-- ======================= styles End-->

    @stack('styles')

</head>

<body data-update-uri="/{{ LaravelLocalization::getCurrentLocale() }}/livewire/update">

    <h1 class="hidden-h1">@yield('h1_val')</h1>
    <h2 class="hidden-h2">@yield('h2_val')</h2>

    <!-- ======================= header Start-->
    @include('frontend.layout.partials.header')
    <!-- ======================= header End-->

    <!-- ======================= breadcrumb Start-->
    @yield('breadcrumb')
    <!-- ======================= breadcrumb End-->

    <!-- ======================= content Start-->
    @yield('content')
    <!-- ======================= content End-->

    <!-- ======================= footer Start  -->
    @include('frontend.layout.partials.footer')
    <!-- ======================= footer End  -->


    <!-- Back to top -->
    <div> <a href="#" class="back-top btn btn-grad"><i class="ti-angle-up"></i></a> </div>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/1234567890" target="_blank" class="whatsapp-float animated-bounce" style="position:fixed;bottom:24px;left:24px;z-index:9999;background:#25d366;color:#fff;border-radius:50%;width:60px;height:60px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,0.15);text-decoration:none;">
            <style>
            .animated-bounce {
                animation: whatsapp-bounce 1.2s infinite alternate;
            }
            @keyframes whatsapp-bounce {
                0% { transform: scale(1) translateY(0); box-shadow: 0 2px 8px rgba(0,0,0,0.15); }
                30% { transform: scale(1.08) translateY(-6px); box-shadow: 0 6px 16px rgba(0,0,0,0.18); }
                60% { transform: scale(0.98) translateY(2px); }
                100% { transform: scale(1.04) translateY(-2px); }
            }
            </style>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.031-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.151-.174.2-.298.3-.497.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51-.173-.007-.372-.009-.571-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.363.709.306 1.262.489 1.694.626.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.617h-.001a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.455 4.436-9.89 9.893-9.89 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.896 6.994c-.003 5.456-4.438 9.891-9.897 9.891m8.413-18.306A11.815 11.815 0 0 0 12.05 0C5.495 0 .057 5.437.053 12.092c0 2.137.56 4.223 1.623 6.067L0 24l6.064-1.591a11.888 11.888 0 0 0 5.978 1.527h.005c6.554 0 11.993-5.437 11.997-12.092a11.86 11.86 0 0 0-3.489-8.486"/>
        </svg>
    </a>

    <!-- ======================= scripts Start -->
    @include('frontend.layout.partials.scripts')
    <!-- ======================= scripts end-->
    @stack('scripts')



</body>

</html>
