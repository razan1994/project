<div style="background-color: #f5f5f5 !important;"
    class="bg-secondary bg-line-o2 bg-line:opaque-25 bg-pos-center-center bg-line-fixed">
    <div class="dextheme-container">
        <div class="block-heading text-center mb-5 pt-5">
            <p class="dextheme-sub-title text-white mb-4">Driven by Purpose</p>
            <h2 class="dextheme-main-title text-white mb-4">Our Mission, Vision & Core Values</h2>
        </div>
        <div class="dextheme-row g-4 pb-5">
            <div class="dextheme-col-lg-6 dextheme-col-md-6 dextheme-col-12">
                <div class="dextheme-card project-card-alt border-0 border-bottom border-4 h-100"
                    style="background:#fff; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; border-image: linear-gradient(90deg, #b07f47 0%, #8b6033 100%) 1 !important; border-color: transparent;">
                    <div class="dextheme-card__body p-2 d-flex flex-column align-items-center text-center justify-content-center h-100"
                        style="min-height:220px; width: 100%;">
                        <h4 class="dextheme-title-text mb-3 w-100" style="text-align:center;">
                            {{ $vision?->title ?? 'Our Vision' }}</h4>
                        <p class="plain-text mb-4 w-100" style="text-align:center;">{!! $vision?->description ?? 'To be the leading construction company recognized for quality and trust.' !!}</p>
                    </div>
                </div>
            </div>
            <div class="dextheme-col-lg-6 dextheme-col-md-6 dextheme-col-12">
                <div class="dextheme-card project-card-alt border-0 border-bottom border-4 h-100"
                    style="background:#fff; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; border-image: linear-gradient(90deg, #b07f47 0%, #8b6033 100%) 1 !important; border-color: transparent;">
                    <div class="dextheme-card__body p-2 d-flex flex-column align-items-center text-center justify-content-center h-100"
                        style="min-height:220px; width: 100%;">
                        <h4 class="dextheme-title-text mb-3 w-100" style="text-align:center;">
                            {{ $values?->title ?? 'Our Value' }}</h4>
                        <p class="plain-text mb-4 w-100" style="text-align:center;">{!! $values?->description ?? 'Integrity, quality, and client satisfaction are at the core of everything we do.' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
