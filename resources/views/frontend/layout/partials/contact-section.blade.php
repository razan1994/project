<style>
    .contact-error-message {
        color: #e3342f;
        font-size: 0.97em;
        margin-top: 2px;
        margin-bottom: 8px;
        font-weight: 600;
        display: block;
        letter-spacing: 0.1px;
        padding-left: 20px;
        position: relative;
    }
</style>
<div id="contact-section" class="contact-form-bg dextheme-section-10 dextheme-section-padding bg-white">
    <div class="dextheme-container">
        <div class="dextheme-row g-4">
            <div class="dextheme-col-lg-6 dextheme-col-12">
                <div class="block-heading mb-4 contact-us-info">
                    <p class="dextheme-sub-title mb-4">{{ __('frontend.contact_subtitle') }}</p>
                    <h2 class="dextheme-main-title mb-4">{{ __('frontend.contact_title') }}</h2>
                    <p class="plain-text">{{ __('frontend.contact_desc') }}</p>
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
                                        {{ $contact?->address ?? __('frontend.contact_placeholder_address') }}
                                    </h5>
                                    <p>{{ __('frontend.contact_support_247') }}</p>
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
                                        {{ $contact?->phone ?? __('frontend.contact_placeholder_phone') }}
                                    </h5>
                                    <p>{{ __('frontend.contact_support_247') }}</p>
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
                                        {{ $contact?->email ?? __('frontend.contact_placeholder_email') }}
                                    </h5>
                                    <p>{{ __('frontend.contact_support_247') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dextheme-col-lg-6 dextheme-col-12">
                <div class="contact-form">
                    <h3>{{ __('frontend.contact_send_message') }}</h3>

                    @if (session('contact_success') || session('contact_error'))
                        <div id="contact-form-toast"
                            class="alert {{ session('contact_success') ? 'alert-success' : 'alert-danger' }}"
                            style="position: fixed; top: 24px; right: 24px; z-index: 1060; min-width: 300px; box-shadow: 0 8px 24px rgba(0,0,0,.16);">
                            {{ session('contact_success') ?? session('contact_error') }}
                        </div>
                    @endif

                    <form action="{{ route('contact-us.submit') }}" method="POST">
                        @csrf

                        <input type="text" name="website" value="" autocomplete="off" tabindex="-1"
                            style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;">

                        <div class="dextheme-row g-4 mb-4">
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="text" name="full_name" value="{{ old('full_name') }}"
                                    class="form-control" placeholder="{{ __('frontend.contact_form_name') }}">
                                @error('full_name')
                                    <span class="contact-error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="{{ __('frontend.contact_form_email') }}">
                                @error('email')
                                    <span class="contact-error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                    placeholder="{{ __('frontend.contact_form_phone') }}">
                                @error('phone')
                                    <span class="contact-error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="dextheme-col-12 dextheme-col-md-6">
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                                    placeholder="{{ __('frontend.contact_form_subject') }}">
                                @error('subject')
                                    <span class="contact-error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="dextheme-col-12">
                                <textarea name="message" class="form-control" rows="8" placeholder="{{ __('frontend.contact_form_message') }}">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="contact-error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="dextheme-btn btn-primary hover-bg-white">
                            {{ __('frontend.contact_send_message') }}
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
