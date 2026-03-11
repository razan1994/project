@push('styles')
    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/css/intlTelInput.css">
    <!-- country-select-js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.1/css/countrySelect.min.css">

    <style>
        .iti {
            width: 100% !important;
        }

        .country-select {
            width: 100% !important;
        }
    </style>
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- intl-tel-input JS -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.14.1/build/js/utils.js"></script>

    <!-- country-select-js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.1/js/countrySelect.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector("#supplierFormContainer #phone");
            const fullPhoneInput = document.querySelector('#supplierFormContainer #full_phone');
            const countryDropdown = $('#supplierFormContainer #country_select');
            const countryCodeInput = $('#supplierFormContainer #country_code');
            const countryNameInput = $('#supplierFormContainer #country_name');
            const errorMsg = document.querySelector("#supplierFormContainer #error-phone");
            const errorCompanyName = document.querySelector("#supplierFormContainer #error-company_name");
            const errorEmail = document.querySelector("#supplierFormContainer #error-email");
            const errorCountry = document.querySelector("#supplierFormContainer #error-country");
            const errorWebsite = document.querySelector("#supplierFormContainer #error-website");
            const errorMemorandum = document.querySelector("#supplierFormContainer #error-memorandum");
            const errorLicense = document.querySelector("#supplierFormContainer #error-license");
            const form = document.querySelector("#supplierFormContainer #supplier-contact-form");
            const submitBtn = document.querySelector("#supplierFormContainer #supplier-submit-btn");

            const reset = () => {
                errorMsg.textContent = "";
                if (errorCompanyName) errorCompanyName.textContent = "";
                if (errorEmail) errorEmail.textContent = "";
                if (errorCountry) errorCountry.textContent = "";
                if (errorWebsite) errorWebsite.textContent = "";
                if (errorMemorandum) errorMemorandum.textContent = "";
                if (errorLicense) errorLicense.textContent = "";
            };

            // Form submit
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

                // Update hidden country info
                const selectedCountry = iti.getSelectedCountryData();
                countryCodeInput.value = selectedCountry.iso2;
                countryNameInput.value = selectedCountry.name;

                submitBtn.disabled = true;
                document.querySelector("#supplierFormContainer #supplier-success-message").style.display =
                    'none';

                const formData = new FormData(form);
                formData.set('phone', finalPhone);
                formData.set('country_code', selectedCountry.iso2);
                formData.set('country_name', selectedCountry.name);
                formData.set('license', form.license.files[0]);
                formData.set('memorandum', form.memorandum.files[0]);

                $.ajax({
                    url: '{{ route('contact-us.supplier-save') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#supplierFormContainer #supplier-success-message .alert').text(
                            response.message);
                        $('#supplierFormContainer #supplier-success-message').show();
                        form.reset();

                        // Reset phone input and country
                        iti.setCountry("ae");
                        countryDropdown.countrySelect("selectCountry", "ae");
                        const initial = iti.getSelectedCountryData();
                        countryCodeInput.value = initial.iso2;
                        countryNameInput.value = initial.name;
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.company_name && errorCompanyName) errorCompanyName
                                .textContent = errors.company_name[0];
                            if (errors.email && errorEmail) errorEmail.textContent = errors
                                .email[0];
                            if (errors.phone) errorMsg.textContent = errors.phone[0];
                            if (errors.country_code && errorCountry) errorCountry.textContent =
                                errors.country_code[0];
                            if (errors.website && errorWebsite) errorWebsite.textContent =
                                errors.website[0];
                            if (errors.memorandum && errorMemorandum) errorMemorandum
                                .textContent = errors.memorandum[0];
                            if (errors.license && errorLicense) errorLicense.textContent =
                                errors.license[0];
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

<form id="supplier-contact-form" class="contact-form" method="POST" action="#" enctype="multipart/form-data">
    @csrf

    <!-- Hidden inputs -->
    <input type="hidden" name="phone" id="full_phone">
    <input type="hidden" name="country_code" id="country_code">
    <input type="hidden" name="country_name" id="country_name">

    <div class="row">

        <!-- Company Name -->
        <div class="col-md-6 ">
            <label for="company_name">Company Name</label>
            <input required name="company_name" type="text" class="form-control" placeholder="Company Name">
            <span class="text-danger text-sm" id="error-company_name"></span>
        </div>

        <!-- Email -->
        <div class="col-md-6 ">
            <label for="email">E-mail</label>
            <input required name="email" type="email" class="form-control" placeholder="E-mail">
            <span class="text-danger text-sm" id="error-email"></span>
        </div>

        <!-- Phone (fixed) -->
        <div class="col-md-6 mb-3 position-relative">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone_manual" pattern="[0-9]*"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required class="form-control"
                inputmode="numeric">
            <span class="text-danger text-sm" id="error-phone"></span>
        </div>

        <!-- Country Dropdown -->
        <div class="col-md-6 mb-3">
            <label for="country_select">Country</label>
            <input type="text" id="country_select" class="form-control" placeholder="Select Country">
            <span class="text-danger text-sm" id="error-country"></span>
        </div>

        <!-- Website -->
        <div class="col-md-6 ">
            <label for="website">Website URL</label>
            <input required name="website" type="url" class="form-control" placeholder="Website URL">
            <span class="text-danger text-sm" id="error-website"></span>
        </div>

        <!-- Memorandum -->
        <div class="col-md-6 ">
            <label for="memorandum">Memorandum Of Association</label>
            <input required name="memorandum" id="memorandum" type="file" class="form-control"
                accept=".pdf,.doc,.docx,.jpg,.png">
            <span class="text-danger text-sm" id="error-memorandum"></span>
        </div>

        <!-- License -->
        <div class="col-md-6 ">
            <label for="license">Trade License</label>
            <input required name="license" id="license" type="file" class="form-control"
                accept=".pdf,.doc,.docx,.jpg,.png">
            <span class="text-danger text-sm" id="error-license"></span>
        </div>

        <!-- Submit -->
        <div class="col-md-12 d-grid">
            <button class="btn btn-dark" type="submit" id="supplier-submit-btn">Send Message</button>
        </div>

        <!-- Success message -->
        <div class="col-md-12 mt-2" id="supplier-success-message" style="display:none;">
            <div class="alert alert-success"></div>
        </div>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->default->messages() as $error)
                        <li>{{ $error[0] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</form>
