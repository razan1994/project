<!-- Fixed Consultation Button and Modal Form (Template Design) -->
<style>
    .consult-error-message {
        color: #e3342f;
        font-size: 0.97em;
        margin-top: 2px;
        margin-bottom: 8px;
        font-weight: 600;
        display: block;
        letter-spacing: 0.1px;
        /* Optional: add icon */
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
        font-size: 0.85em;
        position: absolute;
        left: 0;
        top: 2px;
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
        letter-spacing: 0.2px;
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
        /* to prevent double scrollbars */
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
        max-width: 100vw;
        max-height: calc(100vh - 48px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
        position: relative;
        font-family: inherit;
        margin: auto;
        overflow-y: auto;
        overflow-x: hidden;
        box-sizing: border-box;
        /* Show scrollbar when needed */
        scrollbar-width: auto;
        scrollbar-color: #b0b0b0 #f8fafc;
    }

    /* For Chrome, Safari and Opera */
    .consult-modal-content::-webkit-scrollbar {
        width: 10px;
    }

    .consult-modal-content::-webkit-scrollbar-thumb {
        background: #b0b0b0;
        border-radius: 6px;
    }

    .consult-modal-content::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 6px;
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

    .consult-modal-content .close:hover {
        opacity: 1;
    }

    .consult-modal-content h4 {
        color: #0e2238;
        font-weight: 700;
        margin-bottom: 18px;
        font-size: 1.35rem;
        letter-spacing: 0.5px;
    }

    .consult-modal-content label {
        font-weight: 600;
        margin-top: 12px;
        color: #0e2238;
        font-size: 1rem;
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
        transition: border 0.2s;
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
        letter-spacing: 0.5px;
        transition: background 0.2s;
    }

    .consult-modal-content button[type="submit"]:hover {
        background: linear-gradient(90deg, #1e90ff 0%, #0e2238 100%);
    }

    .consult-modal-content input[type="file"] {
        background: #f8fafc;
        border: 1px dashed #1e90ff;
        padding: 14px 10px;
        color: #0e2238;
        font-size: 0.98rem;
    }

    .consult-modal-content #consultSuccess {
        color: #1e90ff;
        margin-top: 14px;
        font-weight: 600;
        text-align: center;
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

<!-- Fixed Button -->
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

<!-- Modal Form -->
<div id="consultModal">
    <div class="consult-modal-content dextheme-card">
        <span class="close" id="closeConsultModal">&times;</span>
        <h4>{{ __('frontend.consult_btn_tag') }}</h4>


        <form id="consultForm" method="POST" action="{{ route('consultation-request.submit') }}"
            enctype="multipart/form-data" autocomplete="off">
            @csrf

            <div class="consult-form-grid">

                <!-- Honeypot -->
                <input type="text" name="website" value="" autocomplete="off" tabindex="-1"
                    style="position: absolute; left: -9999px; opacity: 0; pointer-events: none;">

                <!-- Name -->
                <div>
                    <label for="client_name">{{ __('frontend.consult_label_name') }}</label>
                    <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" >
                    @error('client_name')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contact -->
                <div>
                    <label for="contact_number">{{ __('frontend.consult_label_contact') }}</label>
                    <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                        >
                    @error('contact_number')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Preferred Time -->
                <div>
                    <label for="preferred_time">{{ __('frontend.consult_label_time') }}</label>
                    <input type="text" id="preferred_time" name="preferred_time"
                        value="{{ old('preferred_time') }}">
                    @error('preferred_time')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Building Type -->
                <div>
                    <label for="building_type">{{ __('frontend.consult_label_building') }}</label>
                    <select id="building_type" name="building_type" >
                        <option value="">{{ __('frontend.consult_option_select') }}</option>
                        <option value="Villa" {{ old('building_type') == 'Villa' ? 'selected' : '' }}>
                            {{ __('frontend.consult_option_villa') }}
                        </option>
                        <option value="Factory" {{ old('building_type') == 'Factory' ? 'selected' : '' }}>
                            {{ __('frontend.consult_option_factory') }}
                        </option>
                        <option value="Commercial Project"
                            {{ old('building_type') == 'Commercial Project' ? 'selected' : '' }}>
                            {{ __('frontend.consult_option_commercial') }}
                        </option>
                    </select>
                    @error('building_type')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Approved Design -->
                <div>
                    <label for="approved_design">{{ __('frontend.consult_label_design') }}</label>
                    <select id="approved_design" name="approved_design" >
                        <option value="">{{ __('frontend.consult_option_select') }}</option>
                        <option value="Yes" {{ old('approved_design') == 'Yes' ? 'selected' : '' }}>
                            {{ __('frontend.consult_option_yes') }}
                        </option>
                        <option value="No" {{ old('approved_design') == 'No' ? 'selected' : '' }}>
                            {{ __('frontend.consult_option_no') }}
                        </option>
                    </select>
                    @error('approved_design')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Land Area -->
                <div>
                    <label for="land_area">{{ __('frontend.consult_label_land') }}</label>
                    <input type="text" id="land_area" name="land_area" value="{{ old('land_area') }}">
                    @error('land_area')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Construction Area -->
                <div class="consult-form-field-full">
                    <label for="construction_area">{{ __('frontend.consult_label_construction') }}</label>
                    <input type="text" id="construction_area" name="construction_area"
                        value="{{ old('construction_area') }}">
                    @error('construction_area')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Attachments -->
                <div class="consult-form-field-full">
                    <label for="attachments">{{ __('frontend.consult_label_attachments') }}</label>

                    <p style="margin: 4px 0 8px; color: #475569; font-size: 0.92rem;">
                        {{ __('frontend.consult_attachments_note') }}
                    </p>

                    <input type="file" id="attachments" name="attachments[]" multiple>

                    @error('attachments.*')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <button type="submit">{{ __('frontend.consult_btn_send') }}</button>

            @if (session('consultation_success'))
                <div style="color:#1e90ff; margin-top:14px; font-weight:600; text-align:center;">
                    {{ session('consultation_success') }}
                </div>
            @endif

        </form>
        <div id="consultSuccess" style="display:none;">{{ __('frontend.consult_btn_success') }}</div>
    </div>
</div>

<script>
    const openBtn = document.getElementById('openConsultModal');
    const modal = document.getElementById('consultModal');
    const closeBtn = document.getElementById('closeConsultModal');
    if (openBtn) openBtn.onclick = () => modal.classList.add('active');
    if (closeBtn) closeBtn.onclick = () => modal.classList.remove('active');
    window.onclick = (e) => {
        if (e.target === modal) modal.classList.remove('active');
    };

    // Auto-open modal only if consultation_error session flag is set
    @if (session('consultation_error'))
        window.addEventListener('DOMContentLoaded', function() {
            modal.classList.add('active');
        });
    @endif
</script>
