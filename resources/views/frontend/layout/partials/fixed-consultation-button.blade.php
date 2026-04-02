<style>
    .consult-error-message {
        color: #e3342f;
        font-size: 0.95em;
        margin-top: -8px;
        margin-bottom: 10px;
        font-weight: 600;
        display: none;
        padding-left: 20px;
        position: relative;
    }

    .consult-error-message::before {
        content: "!";
        color: #fff;
        background: #e3342f;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8em;
        position: absolute;
        left: 0;
        top: 2px;
    }

    .consult-success-message {
        display: none;
        color: #0f766e;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 8px;
        padding: 12px 14px;
        margin-top: 16px;
        text-align: center;
        font-weight: 700;
    }

    .consult-general-error {
        display: none;
        color: #b91c1c;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 14px;
        text-align: center;
        font-weight: 700;
    }

    .input-error {
        border: 1.5px solid #e3342f !important;
        background: #fff5f5 !important;
    }

    .fixed-consult-wrap {
        position: fixed;
        right: 32px;
        left: auto;
        bottom: 32px;
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    html[dir="rtl"] .fixed-consult-wrap,
    body[dir="rtl"] .fixed-consult-wrap,
    .rtl .fixed-consult-wrap {
        right: auto;
        left: 32px;
        flex-direction: row-reverse;
    }

    .consult-btn-tag {
        background: #fff;
        color: #0e2238;
        border: 1px solid rgba(14, 34, 56, 0.14);
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 0.86rem;
        font-weight: 700;
        line-height: 1;
        box-shadow: 0 6px 18px rgba(14, 34, 56, 0.14);
        white-space: nowrap;
    }

    .fixed-consult-btn {
        background: linear-gradient(90deg, #0e2238 0%, #1e90ff 100%);
        color: #fff;
        border-radius: 50%;
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.2);
        cursor: pointer;
        transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        border: 3px solid #fff;
        font-size: 1.65rem;
    }

    .fixed-consult-wrap:hover .fixed-consult-btn {
        background: linear-gradient(90deg, #1e90ff 0%, #0e2238 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(30, 144, 255, 0.24);
    }

    .fixed-consult-wrap:hover .consult-btn-tag {
        box-shadow: 0 10px 24px rgba(14, 34, 56, 0.2);
    }

    #consultModal {
        display: none;
        position: fixed;
        z-index: 10000;
        inset: 0;
        width: 100vw;
        height: 100vh;
        padding: 24px;
        background: rgba(14, 34, 56, 0.45);
        align-items: center;
        justify-content: center;
        overflow-y: auto;
        overflow-x: hidden;
    }

    #consultModal.active {
        display: flex;
    }

    .consult-modal-content {
        background: #fff;
        border-radius: 18px;
        padding: 36px 28px 28px 28px;
        width: min(720px, 100%);
        max-width: 720px;
        max-height: calc(100vh - 48px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
        position: relative;
        margin: auto;
        overflow-y: auto;
        overflow-x: hidden;
        box-sizing: border-box;
    }

    .consult-modal-content .close {
        position: absolute;
        top: 12px;
        right: 16px;
        font-size: 2rem;
        color: #1e90ff;
        cursor: pointer;
        font-weight: bold;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    html[dir="rtl"] .consult-modal-content .close,
    body[dir="rtl"] .consult-modal-content .close,
    .rtl .consult-modal-content .close {
        right: auto;
        left: 16px;
    }

    .consult-modal-content .close:hover {
        opacity: 1;
    }

    .consult-modal-content h4 {
        color: #0e2238;
        font-weight: 700;
        margin-bottom: 18px;
        font-size: 1.35rem;
    }

    .consult-modal-content label {
        font-weight: 600;
        margin-top: 12px;
        color: #0e2238;
        font-size: 1rem;
        display: block;
    }

    .consult-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 16px;
    }

    .consult-form-field-full {
        grid-column: 1 / -1;
    }

    .consult-modal-content input,
    .consult-modal-content select,
    .consult-modal-content textarea {
        width: 100%;
        margin-top: 4px;
        margin-bottom: 14px;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #dbeafe;
        background: #f8fafc;
        font-size: 1rem;
        color: #0e2238;
        transition: border 0.2s, background 0.2s;
        box-sizing: border-box;
    }

    .consult-modal-content input:focus,
    .consult-modal-content select:focus,
    .consult-modal-content textarea:focus {
        border: 1.5px solid #1e90ff;
        outline: none;
    }

    .consult-modal-content button[type="submit"] {
        background: linear-gradient(90deg, #0e2238 0%, #1e90ff 100%);
        color: #fff;
        border: none;
        padding: 12px 28px;
        border-radius: 6px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        font-size: 1.08rem;
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
        transition: opacity 0.2s;
    }

    .consult-modal-content button[type="submit"]:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .consult-modal-content input[type="file"] {
        background: #f8fafc;
        border: 1px dashed #1e90ff;
        padding: 14px 10px;
        color: #0e2238;
        font-size: 0.98rem;
    }

    @media (max-width: 767px) {
        .fixed-consult-wrap {
            right: 16px;
            left: auto;
            bottom: 22px;
            gap: 8px;
        }

        html[dir="rtl"] .fixed-consult-wrap,
        body[dir="rtl"] .fixed-consult-wrap,
        .rtl .fixed-consult-wrap {
            right: auto;
            left: 16px;
            flex-direction: row-reverse;
        }

        .fixed-consult-btn {
            width: 58px;
            height: 58px;
            font-size: 1.45rem;
        }

        .consult-btn-tag {
            display: none;
        }

        #consultModal {
            padding: 16px;
        }

        .consult-modal-content {
            width: 100%;
            max-height: calc(100vh - 32px);
            padding: 24px 18px 20px 18px;
            border-radius: 14px;
        }

        .consult-form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .consult-form-field-full {
            grid-column: auto;
        }
    }
</style>

<div class="fixed-consult-wrap">
    @if (app()->getLocale() == 'ar')
        <div class="fixed-consult-btn shadow-lg" id="openConsultModal" title="{{ __('frontend.consult_btn_title') }}">
            <i class="icon icon-chat"></i>
        </div>
        <span class="consult-btn-tag">{{ __('frontend.consult_btn_tag') }}</span>
    @else
        <span class="consult-btn-tag">{{ __('frontend.consult_btn_tag') }}</span>
        <div class="fixed-consult-btn shadow-lg" id="openConsultModal" title="{{ __('frontend.consult_btn_title') }}">
            <i class="icon icon-chat"></i>
        </div>
    @endif
</div>

<div id="consultModal">
    <div class="consult-modal-content dextheme-card">
        <span class="close" id="closeConsultModal">&times;</span>
        <h4>{{ __('frontend.consult_btn_tag') }}</h4>

        <div id="consultGeneralError" class="consult-general-error"></div>

        <form id="consultForm" method="POST" action="{{ route('consultation-request.submit') }}"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div id="consultSuccessMessage" class="consult-success-message"></div>

            <div class="consult-form-grid">

                <input type="text" name="website" value="" autocomplete="off" tabindex="-1"
                    style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;">

                <div>
                    <label for="client_name">
                        {{ __('frontend.consult_label_name') }} <span style="color: #e3342f">*</span>
                    </label>
                    <input type="text" id="client_name" name="client_name">
                    <span class="consult-error-message" id="error-client_name"></span>
                </div>

                <div>
                    <label for="contact_number">
                        {{ __('frontend.consult_label_contact') }} <span style="color: #e3342f">*</span>
                    </label>
                    <input type="text" id="contact_number" name="contact_number">
                    <span class="consult-error-message" id="error-contact_number"></span>
                </div>

                <div>
                    <label for="preferred_time">
                        {{ __('frontend.consult_label_time') }} <span style="color: #e3342f">*</span>
                    </label>
                    <input type="text" id="preferred_time" name="preferred_time">
                    <span class="consult-error-message" id="error-preferred_time"></span>
                </div>

                <div>
                    <label for="building_type">
                        {{ __('frontend.consult_label_building') }} <span style="color: #e3342f">*</span>
                    </label>
                    <select id="building_type" name="building_type">
                        <option value="">{{ __('frontend.consult_option_select') }}</option>
                        <option value="Villa">{{ __('frontend.consult_option_villa') }}</option>
                        <option value="Factory">{{ __('frontend.consult_option_factory') }}</option>
                        <option value="Commercial Project">{{ __('frontend.consult_option_commercial') }}</option>
                    </select>
                    <span class="consult-error-message" id="error-building_type"></span>
                </div>

                <div>
                    <label for="approved_design">
                        {{ __('frontend.consult_label_design') }} <span style="color: #e3342f">*</span>
                    </label>
                    <select id="approved_design" name="approved_design">
                        <option value="">{{ __('frontend.consult_option_select') }}</option>
                        <option value="Yes">{{ __('frontend.consult_option_yes') }}</option>
                        <option value="No">{{ __('frontend.consult_option_no') }}</option>
                    </select>
                    <span class="consult-error-message" id="error-approved_design"></span>
                </div>

                <div>
                    <label for="land_area">
                        {{ __('frontend.consult_label_land') }} <span style="color: #e3342f">*</span>
                    </label>
                    <input type="text" id="land_area" name="land_area">
                    <span class="consult-error-message" id="error-land_area"></span>
                </div>

                <div class="consult-form-field-full">
                    <label for="construction_area">
                        {{ __('frontend.consult_label_construction') }} <span style="color: #e3342f">*</span>
                    </label>
                    <input type="text" id="construction_area" name="construction_area">
                    <span class="consult-error-message" id="error-construction_area"></span>
                </div>

                <div class="consult-form-field-full">
                    <label for="attachments">{{ __('frontend.consult_label_attachments') }}</label>

                    <p style="margin: 4px 0 8px; color: #475569; font-size: 0.92rem;">
                        {{ __('frontend.consult_attachments_note') }}
                    </p>

                    <input type="file" id="attachments" name="attachments[]" multiple>
                    <span class="consult-error-message" id="error-attachments"></span>
                </div>

            </div>

            <button type="submit" id="consultSubmitBtn">
                {{ __('frontend.consult_btn_send') }}
            </button>


        </form>
    </div>
</div>

<script>
    const openBtn = document.getElementById('openConsultModal');
    const modal = document.getElementById('consultModal');
    const closeBtn = document.getElementById('closeConsultModal');
    const consultForm = document.getElementById('consultForm');
    const consultSubmitBtn = document.getElementById('consultSubmitBtn');
    const successBox = document.getElementById('consultSuccessMessage');
    const generalErrorBox = document.getElementById('consultGeneralError');

    if (openBtn) {
        openBtn.addEventListener('click', function() {
            modal.classList.add('active');
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.classList.remove('active');
        });
    }

    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });

    function clearValidationErrors() {
        document.querySelectorAll('.consult-error-message').forEach(function(el) {
            el.textContent = '';
            el.style.display = 'none';
        });

        document.querySelectorAll('#consultForm input, #consultForm select, #consultForm textarea').forEach(function(
        el) {
            el.classList.remove('input-error');
        });

        generalErrorBox.textContent = '';
        generalErrorBox.style.display = 'none';
    }

    function clearSuccessMessage() {
        successBox.textContent = '';
        successBox.style.display = 'none';
    }

    function showFieldError(fieldName, message) {
        let errorElement = document.getElementById('error-' + fieldName);
        let inputElement = document.getElementById(fieldName);

        if (fieldName.startsWith('attachments')) {
            errorElement = document.getElementById('error-attachments');
            inputElement = document.getElementById('attachments');
        }

        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }

        if (inputElement) {
            inputElement.classList.add('input-error');
        }
    }

    if (consultForm) {
        consultForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            clearValidationErrors();
            clearSuccessMessage();

            consultSubmitBtn.disabled = true;

            const formData = new FormData(consultForm);

            try {
                const response = await fetch(consultForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    successBox.textContent = data.message || 'Submitted successfully';
                    successBox.style.display = 'block';

                    consultForm.reset();
                    modal.classList.add('active');
                    consultSubmitBtn.disabled = false;
                    return;
                }

                if (response.status === 422) {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(function(field) {
                            if (Array.isArray(data.errors[field]) && data.errors[field].length >
                                0) {
                                showFieldError(field, data.errors[field][0]);
                            }
                        });
                    } else if (data.message) {
                        generalErrorBox.textContent = data.message;
                        generalErrorBox.style.display = 'block';
                    }

                    modal.classList.add('active');
                    consultSubmitBtn.disabled = false;
                    return;
                }

                generalErrorBox.textContent = data.message || 'Something went wrong. Please try again.';
                generalErrorBox.style.display = 'block';
                modal.classList.add('active');
                consultSubmitBtn.disabled = false;

            } catch (error) {
                generalErrorBox.textContent = 'Something went wrong. Please try again.';
                generalErrorBox.style.display = 'block';
                modal.classList.add('active');
                consultSubmitBtn.disabled = false;
            }
        });

        document.querySelectorAll('#consultForm input, #consultForm select, #consultForm textarea').forEach(function(
            field) {
            field.addEventListener('input', function() {
                field.classList.remove('input-error');

                const errorElement = document.getElementById('error-' + field.name);
                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                }

                if (field.name === 'attachments[]') {
                    const attachError = document.getElementById('error-attachments');
                    if (attachError) {
                        attachError.textContent = '';
                        attachError.style.display = 'none';
                    }
                }
            });

            field.addEventListener('change', function() {
                field.classList.remove('input-error');

                const errorElement = document.getElementById('error-' + field.name);
                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                }

                if (field.name === 'attachments[]') {
                    const attachError = document.getElementById('error-attachments');
                    if (attachError) {
                        attachError.textContent = '';
                        attachError.style.display = 'none';
                    }
                }
            });
        });
    }
</script>
