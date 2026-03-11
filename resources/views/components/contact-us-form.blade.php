@props(['merchantTypes', 'servicesAll'])

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/css/intlTelInput.css">

    <style>
        .iti {
            width: 100% !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/js/intlTelInput.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/js/utils.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector("#contactUsFormContainer #phone");
            const errorMsg = document.querySelector("#contactUsFormContainer #error-phone");
            const form = document.querySelector("#contactUsFormContainer #contact-us-contact-form");
            const submitBtn = document.querySelector("#contactUsFormContainer #contact-us-submit-btn");
            const serviceSelect = document.querySelector("#contactUsFormContainer #service");
            const merchantSelect = document.querySelector("#contactUsFormContainer #merchant_type");
            const customMessageContainer = document.querySelector(
                "#contactUsFormContainer #custom-message-container");
            const customMerchantContainer = document.querySelector(
                "#contactUsFormContainer #custom-merchant-container");
            const messageTextarea = document.querySelector("#contactUsFormContainer #message");
            const otherMerchantInput = document.querySelector("#contactUsFormContainer #other_merchant_type");
            const fullPhoneInput = document.querySelector('#contactUsFormContainer #full_phone');

            const reset = () => {
                errorMsg.textContent = "";
                document.querySelector("#contactUsFormContainer #error-name").textContent = "";
                document.querySelector("#contactUsFormContainer #error-email").textContent = "";
                document.querySelector("#contactUsFormContainer #error-merchant_type").textContent = "";
                document.querySelector("#contactUsFormContainer #error-service").textContent = "";
                document.querySelector("#contactUsFormContainer #error-message").textContent = "";
                document.querySelector("#contactUsFormContainer #error-other_merchant_type").textContent = "";
            };

            /* serviceSelect.addEventListener('change', function() {
                if (this.value === '1000') {
                    customMessageContainer.style.display = 'block';
                    messageTextarea.required = true;
                } else {
                    customMessageContainer.style.display = 'none';
                    messageTextarea.required = false;
                    messageTextarea.value = '';
                }
            }); */

            merchantSelect.addEventListener('change', function() {
                if (this.value === '1000') {
                    customMerchantContainer.style.display = 'block';
                    otherMerchantInput.required = true;
                } else {
                    customMerchantContainer.style.display = 'none';
                    otherMerchantInput.required = false;
                    otherMerchantInput.value = '';
                }
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                reset();

                // Get the stored iti instance
                const iti = input._iti;
                if (!iti) return;

                const rawNumber = input.value.trim();
                if (!rawNumber) {
                    errorMsg.textContent = "Phone number is required.";
                    return;
                }

                const dialCode = iti.getSelectedCountryData().dialCode;
                const finalPhone = `+${dialCode}${rawNumber}`;

                fullPhoneInput.value = finalPhone;
                submitBtn.disabled = true;
                document.querySelector("#contactUsFormContainer #contact-us-success-message").style
                    .display = 'none';

                $.ajax({
                    url: '{{ route('contact-us.save') }}',
                    type: 'POST',
                    data: {
                        name: document.querySelector("#con-name").value,
                        email: document.querySelector("#con-email").value,
                        phone: finalPhone,
                        merchant_type: document.querySelector("#merchant_type").value,
                        service: document.querySelector("#service").value,
                        message: messageTextarea.value,
                        other_merchant_type: otherMerchantInput.value,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        document.querySelector(
                                "#contactUsFormContainer #contact-us-success-message .alert")
                            .textContent = response
                            .message;
                        document.querySelector(
                                "#contactUsFormContainer #contact-us-success-message").style
                            .display = 'block';
                        form.reset();
                        input.value = '';
                        customMessageContainer.style.display = 'none';
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.name) document.querySelector(
                                    "#contactUsFormContainer #error-name").textContent = errors
                                .name[0];
                            if (errors.email) document.querySelector(
                                    "#contactUsFormContainer #error-email").textContent = errors
                                .email[0];
                            if (errors.phone) errorMsg.textContent = errors.phone[0];
                            if (errors.merchant_type) document.querySelector(
                                    "#contactUsFormContainer #error-merchant_type")
                                .textContent = errors.merchant_type[0];
                            if (errors.service) document.querySelector(
                                    "#contactUsFormContainer #error-service").textContent =
                                errors.service[0];
                            if (errors.message) document.querySelector(
                                    "#contactUsFormContainer #error-message").textContent =
                                errors.message[0];
                            if (errors.other_merchant_type) document.querySelector(
                                    "#contactUsFormContainer #error-other_merchant_type")
                                .textContent = errors.other_merchant_type[0];
                        }
                    },
                    complete: function() {
                        submitBtn.disabled = false;
                    }
                });
            });

            input.addEventListener('input', reset);
        });
    </script>
@endpush

<form id="contact-us-contact-form" class="contact-form" method="POST" action="#" {{-- needs-validation --}}>
    <div class="row">
        <!-- Name -->
        <div class="col-md-6">
            <div class="mb-3 position-relative">
                <label for="con-name">Name</label>
                <input required id="con-name" name="name" type="text" class="form-control" placeholder="Name">
                <span class="text-danger text-sm" id="error-name"></span>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <div class="mb-3 position-relative">
                <label for="con-email">E-mail</label>
                <input required id="con-email" name="email" type="email" class="form-control" placeholder="E-mail">
                <span class="text-danger text-sm" id="error-email"></span>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-md-6">
            <div class="mb-3 position-relative">
                {{-- <input type="tel" id="phone" name="phone" class="form-control">
                 --}}
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone_manual" pattern="[0-9]*"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required class="form-control"
                    inputmode="numeric">
                <input type="hidden" name="phone" id="full_phone">
                <span class="text-danger text-sm" id="error-phone"></span>
            </div>
        </div>

        <!-- Merchant Type -->
        <div class="col-md-12">
            <div class="form-group">
                <label>Select Merchant Type</label>
                <select class="form-select" id="merchant_type" name="merchant_type">
                    <option selected value="" disabled>Select Merchant Type</option>
                    @foreach ($merchantTypes as $merchantType)
                        <option value="{{ $merchantType->id }}">{{ $merchantType->name }}</option>
                    @endforeach
                    <option value="1000">Other Merchant Type</option>

                </select>
                <span class="text-danger text-sm" id="error-merchant_type"></span>
            </div>
        </div>

        <!-- Other merchant (only if other type) -->
        <div class="col-md-12" id="custom-merchant-container" style="display: none;">
            <div class="mb-3 position-relative">
                <input type="text" id="other_merchant_type" name="other_merchant_type" class="form-control"
                    placeholder="Please specify your merchant type">
                <span class="text-danger text-sm" id="error-other_merchant_type"></span>
            </div>
        </div>

        <!-- Service -->
        <div class="col-md-12">
            <div class="form-group">
                <label>Select Service</label>
                <select class="form-select" id="service" name="service">
                    <option selected value="" disabled>Select Service</option>
                    @foreach ($servicesAll as $serv)
                        <option value="{{ $serv->id }}">{{ $serv->title }}</option>
                    @endforeach
                    <option value="1000">Other sourcing & Trade support services</option>
                </select>
                <span class="text-danger text-sm" id="error-service"></span>
            </div>
        </div>

        <!-- Notes (only if custom) -->
        <div class="col-md-12" id="custom-message-container" style="display: block;">
            <div class="mb-3 position-relative">
                <label for="message">Extra notes</label>
                <textarea id="message" name="message" cols="40" rows="6" class="form-control"
                    placeholder="Tell us more..."></textarea>
                <span class="text-danger text-sm" id="error-message"></span>
            </div>
        </div>

        <!-- Submit -->
        <div class="col-md-12 d-grid">
            <button class="btn btn-dark" type="submit" id="contact-us-submit-btn">Send Message</button>
        </div>

        <!-- Success message -->
        <div class="col-md-12 mt-2" id="contact-us-success-message" style="display: none;">
            <div class="alert alert-success"></div>
        </div>
    </div>
</form>
