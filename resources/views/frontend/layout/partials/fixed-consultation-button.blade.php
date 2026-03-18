<!-- Fixed Consultation Button and Modal Form (Template Design) -->
<style>
.fixed-consult-wrap {
    position: fixed;
    right: 32px;
    bottom: 32px;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 10px;
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
    background: rgba(14,34,56,0.45);
    align-items: center;
    justify-content: center;
    overflow-y: auto;
}
#consultModal.active { display: flex; }
.consult-modal-content {
    background: #fff;
    border-radius: 18px;
    padding: 36px 28px 28px 28px;
    width: min(720px, 100%);
    max-width: 720px;
    max-height: calc(100vh - 48px);
    box-shadow: 0 8px 32px rgba(30,144,255,0.13);
    position: relative;
    font-family: inherit;
    margin: auto;
    overflow-y: auto;
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
.consult-modal-content .close:hover { opacity: 1; }
.consult-modal-content h4 {
    color: #0e2238;
    font-weight: 700;
    margin-bottom: 18px;
    font-size: 1.35rem;
    letter-spacing: 0.5px;
}
.consult-modal-content label { font-weight: 600; margin-top: 12px; color: #0e2238; font-size: 1rem; }
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
    box-shadow: 0 2px 8px rgba(30,144,255,0.10);
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
        left: 8px;
        bottom: 12px;
        min-width: 90px;
        height: 36px;
        font-size: 1rem;
        padding: 0 8px;

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
    <span class="consult-btn-tag">Request a Consultation</span>
    <div class="fixed-consult-btn shadow-lg" id="openConsultModal" title="Request Consultation">
        <i class="icon icon-chat"></i>
    </div>
</div>

<!-- Modal Form -->
<div id="consultModal">
    <div class="consult-modal-content dextheme-card">
        <span class="close" id="closeConsultModal">&times;</span>
        <h4>Request a Consultation</h4>
        <form id="consultForm" method="POST" action="{{ route('consultation-request.submit') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="consult-form-grid">
                <div>
                    <label for="client_name">Full Name *</label>
                    <input type="text" id="client_name" name="client_name" required>
                </div>

                <div>
                    <label for="contact_number">Contact Number *</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>

                <div>
                    <label for="preferred_time">Preferred Time for Communication</label>
                    <input type="text" id="preferred_time" name="preferred_time">
                </div>

                <div>
                    <label for="building_type">Type of Building Required *</label>
                    <select id="building_type" name="building_type" required>
                        <option value="">Select...</option>
                        <option value="Villa">Villa</option>
                        <option value="Factory">Factory</option>
                        <option value="Commercial Project">Commercial Project</option>
                    </select>
                </div>

                <div>
                    <label for="approved_design">Do you have an approved design? *</label>
                    <select id="approved_design" name="approved_design" required>
                        <option value="">Select...</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div>
                    <label for="land_area">Land Area</label>
                    <input type="text" id="land_area" name="land_area">
                </div>

                <div class="consult-form-field-full">
                    <label for="construction_area">Expected Construction Area</label>
                    <input type="text" id="construction_area" name="construction_area">
                </div>

                <div class="consult-form-field-full">
                    <label for="attachments">Attachments (optional)</label>
                    <p style="margin: 4px 0 8px; color: #475569; font-size: 0.92rem;">
                        If you wish to upload any attachments, such as a hand drawing, a survey map, a deed, or any
                        document you think you need to upload.
                    </p>
                    <input type="file" id="attachments" name="attachments" multiple
                        placeholder="If you wish to upload any attachments, such as a hand drawing, survey plan, ownership document, or any other relevant file.">
                </div>
            </div>

            <button type="submit">Send Request</button>
            @if(session('consultation_success'))
                <div id="consultSuccess" style="color:#1e90ff; margin-top:14px; font-weight:600; text-align:center;">{{ session('consultation_success') }}</div>
            @endif
        </form>
        <div id="consultSuccess" style="display:none;">Thank you! Your request has been sent.</div>
    </div>
</div>

<script>
const openBtn = document.getElementById('openConsultModal');
const modal = document.getElementById('consultModal');
const closeBtn = document.getElementById('closeConsultModal');
openBtn.onclick = () => modal.classList.add('active');
closeBtn.onclick = () => modal.classList.remove('active');
window.onclick = (e) => { if (e.target === modal) modal.classList.remove('active'); };
</script>
