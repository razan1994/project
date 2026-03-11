@props(['merchantTypes', 'servicesAll'])

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

        .contact-us-wrapper {
            padding: 20px 0;
        }

        .step-container {
            display: none;
        }

        .step-container.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .selector-button {
            padding: 12px 28px;
            font-size: 15px;
            margin: 8px 8px 8px 0;
            border: 2px solid #202945;
            border-radius: 25px;
            cursor: pointer;
            background-color: white;
            color: #202945;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .selector-button:hover {
            background-color: #202945;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(34, 78, 106, 0.3);
        }

        .selector-button.primary {
            background-color: #202945;
            color: white;
            border-color: #202945;
        }

        .selector-button.primary:hover {
            background-color: #1a3d52;
            border-color: #1a3d52;
            box-shadow: 0 4px 12px rgba(26, 61, 82, 0.3);
        }

        .back-button {
            background-color: #f8f9fa;
            color: #202945;
            border-color: #202945;
        }

        .back-button:hover {
            background-color: #0056b3;
            color: white;
            border-color: #adb5bd;
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.15);
        }

        #stepUserType h3,
        #stepSupplierType h3 {
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
            font-size: 20px;
        }

        #stepForms {
            padding: 20px 0;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-top: 20px;
        }

        #supplierFormContainer,
        #buyerOutsourceFormContainer,
        #contactUsFormContainer,
        #supplierDistributorFormContainer,
        #supplierPrivateLabelFormContainer,
        #supplierOtherServicesFormContainer {
            display: none;
        }

        #supplierFormContainer.active,
        #buyerOutsourceFormContainer.active,
        #contactUsFormContainer.active,
        #supplierDistributorFormContainer.active,
        #supplierPrivateLabelFormContainer.active,
        #supplierOtherServicesFormContainer.active {
            display: block;
        }

        .button-group {
            margin-bottom: 20px;
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
        let currentUserType = null;
        let currentBuyerType = null;

        // Single initialization function for all forms
        function initializePhoneAndCountry(formType) {
            // Map formType to container ID
            let containerId;
            /* if (formType === 'supplier') {
                containerId = 'supplierFormContainer';
            } else if (formType === 'outsourcing') {
                containerId = 'buyerOutsourceFormContainer';
            } else if (formType === 'direct-contact') {
                containerId = 'contactUsFormContainer';
            } */

            switch (formType) {
                case 'supplierDistributor':
                    containerId = 'supplierDistributorFormContainer';
                    break;
                case 'supplierPrivateLabel':
                    containerId = 'supplierPrivateLabelFormContainer';
                    break;
                case 'supplierOtherServices':
                    containerId = 'supplierOtherServicesFormContainer';
                    break;
                case 'direct-contact':
                    containerId = 'contactUsFormContainer';
                    break;
                default:
                    containerId = 'contactUsFormContainer';
                    break;
            }

            const container = document.getElementById(containerId);
            if (!container) return;

            const input = container.querySelector("#phone");
            if (!input) return;

            // Initialize intl-tel-input
            const iti = window.intlTelInput(input, {
                initialCountry: "ae",
                separateDialCode: true,
                placeholderNumberType: "MOBILE",
            });

            // Initialize country select (only for supplier and buyer-outsource)
            const countryDropdown = $(container).find("#country_select");
            if (countryDropdown.length) {
                const countryCodeInput = $(container).find("#country_code");
                const countryNameInput = $(container).find("#country_name");

                countryDropdown.countrySelect({
                    defaultCountry: 'ae',
                    preferredCountries: ['ae', 'sa', 'jo'],
                    responsiveDropdown: true
                });

                // Sync country dropdown -> phone input
                countryDropdown.on('countrychange', function(e, countryData) {
                    // Clear the input value FIRST to prevent overlap
                    input.value = '';

                    // Change the country
                    iti.setCountry(countryData.iso2);

                    // Update hidden fields
                    countryCodeInput.val(countryData.iso2);
                    countryNameInput.val(countryData.name);
                });

                // Set initial hidden values
                const initialCountry = iti.getSelectedCountryData();
                countryCodeInput.val(initialCountry.iso2);
                countryNameInput.val(initialCountry.name);
                countryDropdown.countrySelect("selectCountry", initialCountry.iso2);
            }

            // Store iti instance on the input for form submission
            input._iti = iti;
        }

        function showBuyerOrSupplier(type) {
            currentUserType = type;

            if (type === 'supplier') {
                // Show supplier type selection
                document.getElementById('stepUserType').classList.remove('active');
                document.getElementById('stepSupplierType').classList.add('active');
            } else if (type === 'buyer') {
                // Go directly to contact-us-form for buyers
                document.getElementById('stepUserType').classList.remove('active');
                document.getElementById('stepForms').classList.add('active');
                showForm('direct-contact');
                initializePhoneAndCountry('direct-contact');
            }
        }

        function showForm(type) {
            // Hide all form containers completely
            const supplierContainer = document.getElementById('supplierFormContainer');
            const supplierDistributorContainer = document.getElementById('supplierDistributorFormContainer');
            const supplierPrivateLabelContainer = document.getElementById('supplierPrivateLabelFormContainer');
            const supplierOtherServicesContainer = document.getElementById('supplierOtherServicesFormContainer');
            const buyerOutsourceContainer = document.getElementById('buyerOutsourceFormContainer');
            const contactUsContainer = document.getElementById('contactUsFormContainer');

            if (supplierContainer) supplierContainer.classList.remove('active');
            if (supplierDistributorContainer) supplierDistributorContainer.classList.remove('active');
            if (supplierPrivateLabelContainer) supplierPrivateLabelContainer.classList.remove('active');
            if (supplierOtherServicesContainer) supplierOtherServicesContainer.classList.remove('active');
            if (buyerOutsourceContainer) buyerOutsourceContainer.classList.remove('active');
            if (contactUsContainer) contactUsContainer.classList.remove('active');

            // Show selected form based on type
            switch (type) {
                case 'supplierDistributor':
                    supplierDistributorContainer.classList.add('active');
                    break;
                case 'supplierPrivateLabel':
                    supplierPrivateLabelContainer.classList.add('active');
                    break;
                case 'supplierOtherServices':
                    supplierOtherServicesContainer.classList.add('active');
                    break;
                case 'direct-contact':
                    contactUsContainer.classList.add('active');
                    break;
                default:
                    contactUsContainer.classList.add('active');
                    break;
            }

            // Hide steps and show forms
            document.getElementById('stepUserType').classList.remove('active');
            const stepSupplierType = document.getElementById('stepSupplierType');
            if (stepSupplierType) stepSupplierType.classList.remove('active');
            document.getElementById('stepForms').classList.add('active');

            // Initialize phone and country for selected form
            setTimeout(() => {
                initializePhoneAndCountry(type);
            }, 100);
        }

        function goBack() {
            const stepForms = document.getElementById('stepForms');
            const stepSupplierType = document.getElementById('stepSupplierType');
            const stepUserType = document.getElementById('stepUserType');

            if (stepForms.classList.contains('active')) {
                stepForms.classList.remove('active');
                if (currentUserType === 'supplier') {
                    stepSupplierType.classList.add('active');
                } else if (currentUserType === 'buyer') {
                    stepUserType.classList.add('active');
                } else {
                    stepUserType.classList.add('active');
                }
            } else if (stepSupplierType.classList.contains('active')) {
                stepSupplierType.classList.remove('active');
                stepUserType.classList.add('active');
                currentUserType = null;
            }
        }
    </script>
@endpush

<div class="contact-us-wrapper">
    <!-- Step 1: Choose User Type -->
    <div id="stepUserType" class="step-container active">
        <h3>What brings you here?</h3>
        <div class="button-group">
            <button class="selector-button primary" onclick="showBuyerOrSupplier('buyer')">I'm a buyer</button>
            <button class="selector-button primary" onclick="showBuyerOrSupplier('supplier')">I'm a supplier</button>
        </div>
    </div>

    <!-- Step 2: Choose Supplier Type -->
    <div id="stepSupplierType" class="step-container">
        <h3>How can we assist you?</h3>
        <div class="button-group">
            <button class="selector-button primary" onclick="showForm('supplierDistributor')">Looking for distributor
                for my products in these countries</button>
            <button class="selector-button primary" onclick="showForm('supplierPrivateLabel')">I can do private label
                for these products</button>
            <button class="selector-button primary" onclick="showForm('supplierOtherServices')">I can do other
                services</button>
        </div>
        <button class="selector-button back-button" onclick="goBack()">← Back</button>
    </div>

    <!-- Step 3: Display Forms -->
    <div id="stepForms" class="step-container">
        <button class="selector-button back-button" onclick="goBack()" style="margin-bottom: 20px;">← Back</button>

        <!-- Supplier Form -->
        <div id="supplierFormContainer" class="form-container">
            <x-supplier-form />
        </div>

        <!-- Supplier Distributor Form -->
        <div id="supplierDistributorFormContainer" class="form-container">
            <x-supplier-distributor-form />
        </div>

        <!-- Supplier Private Label Form -->
        <div id="supplierPrivateLabelFormContainer" class="form-container">
            <x-supplier-private-label-form />
        </div>

        <!-- Supplier Other Services Form -->
        <div id="supplierOtherServicesFormContainer" class="form-container">
            <x-supplier-other-services-form />
        </div>

        <!-- Buyer Outsource Form -->
        <div id="buyerOutsourceFormContainer" class="form-container">
            <x-buyer-outsource-form />
        </div>

        <!-- Contact Us Form -->
        <div id="contactUsFormContainer" class="form-container">
            <x-contact-us-form :merchantTypes="$merchantTypes" :servicesAll="$servicesAll" />
        </div>
    </div>
</div>
