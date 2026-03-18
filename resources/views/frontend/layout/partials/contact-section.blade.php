<div id="contact-section" class="contact-form-bg dextheme-section-10 dextheme-section-padding bg-white">
    <div class="dextheme-container">
        <div class="dextheme-row g-4">
            <div class="dextheme-col-lg-6 dextheme-col-12">
                <div class="block-heading mb-4 contact-us-info">
                    <p class="dextheme-sub-title mb-4">Contact Us</p>
                    <h2 class="dextheme-main-title mb-4"> We are happy to hear from you and answer your questions.</h2>
                    <p class="plain-text">Have questions or need assistance? Our team is here to help you anytime. Reach
                        out to us through any of the options below and we’ll respond as quickly as possible.</p>
                </div>
                <div class="contact-us-card-list">
                    <div class="dextheme-card mb-4">
                        <div class="dextheme-card__body bg-white">
                            <div class="dextheme-flex gap-2 align-items-center">
                                <div class="bg-primary icon-wrapper">
                                    <i aria-hidden="true" class="icon icon-map-marker1"></i>
                                </div>
                                <div>
                                    <h5>
                                        {{ $contact?->address ?? 'Add Address' }}
                                    </h5>
                                    <p>Call support center 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dextheme-card mb-4">
                        <div class="dextheme-card__body bg-white">
                            <div class="dextheme-flex gap-2 align-items-center">
                                <div class="bg-primary icon-wrapper">
                                    <i aria-hidden="true" class="icon icon-phone1"></i>
                                </div>
                                <div>
                                    <h5>
                                        {{ $contact?->phone ?? 'Add Phone Number' }}
                                    </h5>
                                    <p>Call support center 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dextheme-card mb-4">
                        <div class="dextheme-card__body bg-white">
                            <div class="dextheme-flex gap-2 align-items-center">
                                <div class="bg-primary icon-wrapper">
                                    <i aria-hidden="true" class="icon icon-envelope3"></i>
                                </div>
                                <div>
                                    <h5>
                                        {{ $contact?->email ?? 'Add Email Address' }}
                                    </h5>
                                    <p>Call support center 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dextheme-col-lg-6 dextheme-col-12">
                <div class="contact-form">
                    <h3>Send Message</h3>

                    @if (session('contact_success') || session('contact_error'))
                        <div id="contact-form-toast"
                            class="alert {{ session('contact_success') ? 'alert-success' : 'alert-danger' }}"
                            style="position: fixed; top: 24px; right: 24px; z-index: 1060; min-width: 300px; box-shadow: 0 8px 24px rgba(0,0,0,.16);">
                            {{ session('contact_success') ?? session('contact_error') }}
                        </div>
                    @endif

                    <form action="{{ route('contact-us.submit') }}" method="POST">
                        @csrf
                        <div class="dextheme-row g-4 mb-4">
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="text" name="full_name" value="{{ old('full_name') }}"
                                    class="form-control" placeholder="* Your Name">
                                @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="* Your Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                    placeholder="* Phone Number">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                                    placeholder="Subject">
                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="dextheme-col-12">
                                <textarea name="message" class="form-control" rows="8" placeholder="Write Message...">{{ old('message') }}</textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="dextheme-btn btn-primary hover-bg-white">
                            Send Message
                            <i aria-hidden="true" class="icon icon-right-arrow"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('contact_success') || session('contact_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('contact-form-toast');

            if (!toast) {
                return;
            }

            setTimeout(function() {
                toast.style.transition = 'opacity 0.35s ease';
                toast.style.opacity = '0';

                setTimeout(function() {
                    toast.remove();
                }, 350);
            }, 3500);
        });
    </script>
@endif
