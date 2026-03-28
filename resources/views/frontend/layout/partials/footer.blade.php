 <!-- Footer Section -->
 <footer class="dextheme-content-footer">
     <div class="dextheme-container">
         <div class="dextheme-content-footer__middle">
             <div class="dextheme-row">
                 <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-sm-12">
                     <div class="dextheme-flex dextheme-flex-column align-items-start h-100">
                         <img src="{{ asset('assets/images/Logo.png') }}" alt="logo" height="81" class="logo-brand">
                         <p>
                             {{ __('frontend.footer_description') }}
                         </p>
                     </div>
                 </div>
                 <div class="dextheme-col-lg-2 dextheme-col-md-6 dextheme-col-sm-12">
                     <h4>{{ __('frontend.footer_extra_links') }}</h4>
                     <ul class="extra-links">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('about-us') }}">{{ __('frontend.footer_about_us') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('blogs') }}">{{ __('frontend.footer_blogs') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('services') }}">{{ __('frontend.footer_services') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('design-build-project') }}">{{ __('frontend.footer_project') }}</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('faqs') }}">{{ __('frontend.footer_faqs') }}</a>
                         </li>
                     </ul>
                 </div>
                 <div class="dextheme-col-lg-2 dextheme-col-md-6 dextheme-col-sm-12">
                     <h4>{{ __('frontend.footer_services_title') }}</h4>
                     <ul class="services">
                         @if (isset($services) && $services->count())
                             @foreach ($services as $footerService)
                                 <li class="nav-item">
                                     <a class="nav-link" href="{{ route('services.details', $footerService->slug ?: $footerService->id) }}">
                                         <i aria-hidden="true" class="icon icon-right-arrow1"></i>
                                         {{ $footerService->title }}
                                     </a>
                                 </li>
                             @endforeach
                         @else
                             <li class="nav-item">
                                 <a class="nav-link" href="{{ route('services') }}">
                                     <i aria-hidden="true" class="icon icon-right-arrow1"></i>
                                     {{ __('frontend.footer_services') }}
                                 </a>
                             </li>
                         @endif
                     </ul>
                 </div>
                 <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-sm-12">
                     <h4>{{ __('frontend.footer_address_title') }}</h4>
                     <ul class="address">
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon map-point-icon mt-1"></i>
                                 {{ $contact?->address ?? __('frontend.footer_add_address') }}
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon email-icon mt-1"></i>
                                 {{ $contact?->email ?? __('frontend.footer_add_email') }}
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon phone-icon mt-1"></i>
                                 {{ $contact?->phone ?? __('frontend.footer_add_phone') }}
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon time-icon mt-1"></i>
                                 {{ __('frontend.footer_working_hours') }}
                             </a>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="dextheme-content-footer__bottom">
             <div class="dextheme-flex justify-content-between">
                 <ul>
                     <li>
                         <a href="{{ route('terms-and-conditions') }}">{{ __('frontend.footer_terms') }}</a>
                     </li>
                     <li>
                         <a href="{{ route('privacy-policy') }}">{{ __('frontend.footer_privacy') }}</a>
                     </li>
                     <li>
                         <a href="{{ route('contact-us') }}">{{ __('frontend.footer_help') }}</a>
                     </li>
                 </ul>
                 <p>© {{ __('frontend.footer_copyright') }} <a href="https://smartzone-jo.com" target="_blank"> <span style="color: #24395f !important; font-weight: 600;">SmartZone Co.</span></a>.</p>
             </div>
         </div>
     </div>
 </footer>
