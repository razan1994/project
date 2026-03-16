 <!-- Footer Section -->
 <footer class="dextheme-content-footer">
     <div class="dextheme-container">
         <div class="dextheme-content-footer__middle">
             <div class="dextheme-row">
                 <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-sm-12">
                     <div class="dextheme-flex dextheme-flex-column align-items-start h-100">
                         <img src="{{ asset('assets/images/Logo.png') }}" alt="logo" height="81" class="logo-brand">
                         <p>
                             Al Jeel Contracting stands out for its extensive experience
                             and deep understanding of client requirements, making it the ideal choice for executing complex projects.
                         </p>
                     </div>
                 </div>
                 <div class="dextheme-col-lg-2 dextheme-col-md-6 dextheme-col-sm-12">
                     <h4>Extra Links</h4>
                     <ul class="extra-links">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('about-us') }}">About US</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('services') }}">Services</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('design-build-project') }}">Project</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('faqs') }}">FAQs</a>
                         </li>
                     </ul>
                 </div>
                 <div class="dextheme-col-lg-2 dextheme-col-md-6 dextheme-col-sm-12">
                     <h4>Services</h4>
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
                                     Services
                                 </a>
                             </li>
                         @endif
                     </ul>
                 </div>
                 <div class="dextheme-col-lg-4 dextheme-col-md-6 dextheme-col-sm-12">
                     <h4>Address of Kons</h4>
                     <ul class="address">
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon map-point-icon mt-1"></i>
                                 {{ $contact?->address ?? 'Add Address' }}
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon email-icon mt-1"></i>
                                 {{ $contact?->email ?? 'Add Email Address' }}
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon phone-icon mt-1"></i>
                                 {{ $contact?->phone ?? 'Add Phone Number' }}
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="#">
                                 <i class="bg-primary svg-icon time-icon mt-1"></i>
                                 Mon - Sat : 09:00 am - 17:00 pm
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
                         <a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a>
                     </li>
                     <li>
                         <a href="{{ route('privacy-policy') }}">Privacy & Policy</a>
                     </li>
                     <li>
                         <a href="{{ route('contact-us') }}">Help</a>
                     </li>
                 </ul>
                 <p>© Al-Jeel Construction. Powered by <a href="https://smartzone-jo.com" target="_blank"> <span style="color: #24395f !important; font-weight: 600;">SmartZone Co.</span></a>.</p>
             </div>
         </div>
     </div>
 </footer>
