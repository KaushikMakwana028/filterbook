<style>
    /* ===== CSS Variables ===== */
    :root {
        --ord-primary: #4361ee;
        --ord-primary-dark: #3a56d4;
        --ord-primary-light: rgba(67, 97, 238, 0.08);
        --ord-secondary: #7209b7;
        --ord-success: #06d6a0;
        --ord-success-dark: #05b88a;
        --ord-warning: #ff9f1c;
        --ord-danger: #ef476f;
        --ord-dark: #1a1d2e;
        --ord-text: #2d3142;
        --ord-text-secondary: #6c7293;
        --ord-text-muted: #a0a4b8;
        --ord-border: #e6e8f0;
        --ord-bg: #f4f6fc;
        --ord-white: #ffffff;
        --ord-radius: 14px;
        --ord-radius-sm: 10px;
        --ord-radius-xs: 8px;
        --ord-shadow: 0 2px 20px rgba(26, 29, 46, 0.06);
        --ord-shadow-hover: 0 8px 32px rgba(26, 29, 46, 0.1);
        --ord-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ── Full width fix ── */
    .page-wrapper,
    .page-content {
        background: transparent !important;
    }

    /* ── Dark Theme ── */
    [data-theme="dark"] {
        --ord-text: var(--text-primary);
        --ord-text-secondary: #94a3b8;
        --ord-text-muted: #64748b;
        --ord-border: var(--border-color);
        --ord-bg: var(--bg-tertiary);
        --ord-white: var(--bg-secondary);
    }

    [data-theme="dark"] .ord-card,
    [data-theme="dark"] .ord-summary-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .ord-card-header {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .ord-card-header .header-info h5 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .ord-card-header .header-info p {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .ord-field label {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .ord-field .form-control,
    [data-theme="dark"] .ord-field .form-select {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .ord-field .form-control::placeholder {
        color: #475569 !important;
    }

    [data-theme="dark"] .ord-field .form-control:focus,
    [data-theme="dark"] .ord-field .form-select:focus {
        background: var(--bg-secondary) !important;
        border-color: var(--primary) !important;
    }

    [data-theme="dark"] .ord-field .form-control:read-only {
        background: var(--bg-primary) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .ord-field .field-icon {
        color: #475569 !important;
    }

    [data-theme="dark"] .ord-pill-toggle {
        background: var(--bg-tertiary) !important;
    }

    [data-theme="dark"] .ord-status-bar {
        background: var(--bg-tertiary) !important;
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .ord-status-bar strong {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .ord-divider span {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .ord-divider::before,
    [data-theme="dark"] .ord-divider::after {
        background: linear-gradient(90deg, transparent, var(--border-color), transparent) !important;
    }

    [data-theme="dark"] .ord-emi-panel {
        background: rgba(245, 158, 11, 0.05) !important;
        border-color: rgba(245, 158, 11, 0.2) !important;
    }

    [data-theme="dark"] .ord-emi-panel .emi-top h6 {
        color: #f59e0b !important;
    }

    [data-theme="dark"] .ord-customer-panel {
        background: rgba(99, 102, 241, 0.08) !important;
        border-color: rgba(99, 102, 241, 0.2) !important;
    }

    [data-theme="dark"] .ord-customer-panel .panel-title h6 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .ord-lookup-note {
        background: rgba(99, 102, 241, 0.08) !important;
        border-color: rgba(99, 102, 241, 0.2) !important;
        color: var(--text-secondary) !important;
    }

    /* Summary card */
    [data-theme="dark"] .ord-summary-card .sum-header {
        background: rgba(99, 102, 241, 0.1) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .ord-summary-card .sum-header h6 {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .sum-row {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .sum-row .sum-label {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .sum-row .summary-value {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .sum-row .summary-value.empty {
        color: #334155 !important;
    }

    [data-theme="dark"] .ord-field .optional-tag {
        background: var(--bg-tertiary) !important;
        color: var(--text-secondary) !important;
    }

    /* Select2 dark */
    [data-theme="dark"] .select2-container--default .select2-selection--single {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .select2-dropdown {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .select2-results__option {
        color: var(--text-primary) !important;
        background: var(--bg-secondary) !important;
    }

    [data-theme="dark"] .select2-search--dropdown .select2-search__field {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .ord-card-header {
        background: var(--bg-tertiary) !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    /* Fix card body background */
    [data-theme="dark"] .ord-card-body {
        background: var(--bg-secondary) !important;
    }

    /* Fix summary card body */
    [data-theme="dark"] .ord-summary-card .sum-body {
        background: var(--bg-secondary) !important;
    }

    /* ===== Page Header ===== */
    .ord-page-header {
        background: linear-gradient(135deg, var(--ord-primary) 0%, #560bad 100%);
        border-radius: 20px;
        padding: 36px 40px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 48px rgba(67, 97, 238, 0.25);
    }

    .ord-page-header .deco-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        pointer-events: none;
    }

    .ord-page-header .deco-circle.c1 {
        width: 420px;
        height: 420px;
        top: -55%;
        right: -12%;
    }

    .ord-page-header .deco-circle.c2 {
        width: 280px;
        height: 280px;
        bottom: -55%;
        left: 8%;
        background: rgba(255, 255, 255, 0.04);
    }

    .ord-page-header .deco-circle.c3 {
        width: 120px;
        height: 120px;
        top: 20%;
        right: 25%;
        background: rgba(255, 255, 255, 0.03);
    }

    .row.g-4 {
        --bs-gutter-x: 1.5rem !important;
        --bs-gutter-y: 1.5rem !important;
    }

    .ord-card-body {
        padding: 24px !important;
    }

    .ord-card-header {
        padding: 18px 24px !important;
    }

    .ord-page-header {
        margin-bottom: 24px !important;
    }

    .ord-page-header .header-content {
        position: relative;
        z-index: 2;
    }

    .ord-page-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 10px;
    }

    .ord-page-header .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.65);
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: var(--ord-transition);
    }

    .ord-page-header .breadcrumb-item a:hover {
        color: #fff;
    }

    .ord-page-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.85);
        font-size: 13px;
    }

    .ord-page-header .breadcrumb-item+.breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.4);
        content: "›";
        font-weight: 700;
        font-size: 14px;
    }

    .ord-page-header .page-title {
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .ord-page-header .page-desc {
        color: rgba(255, 255, 255, 0.72);
        font-size: 14px;
        margin: 0;
        font-weight: 400;
    }

    .ord-back-btn {
        padding: 11px 24px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        border: 1.5px solid rgba(255, 255, 255, 0.2);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--ord-transition);
        backdrop-filter: blur(12px);
        position: relative;
        z-index: 2;
    }

    .ord-back-btn:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
        transform: translateX(-3px);
    }

    /* ===== Main Cards ===== */
    .ord-card {
        background: var(--ord-white);
        border-radius: 18px;
        box-shadow: var(--ord-shadow);
        border: 1px solid var(--ord-border);
        overflow: hidden;
        height: 100%;
        margin-bottom: 20px;
        opacity: 0;
        transform: translateY(25px);
        animation: ordFadeUp 0.55s ease forwards;
    }

    .ord-card.delay-1 {
        animation-delay: 0.08s;
    }

    .ord-card.delay-2 {
        animation-delay: 0.16s;
    }

    .ord-card.delay-3 {
        animation-delay: 0.24s;
    }

    @keyframes ordFadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .ord-card-header {
        padding: 22px 26px;
        display: flex;
        align-items: center;
        gap: 14px;
        border-bottom: 1px solid var(--ord-border);
        background: linear-gradient(180deg, #fafbff 0%, #f8f9fe 100%);
    }

    .ord-card-header .icon-box {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .ord-card-header .icon-box.purple {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
        color: var(--ord-primary);
    }

    .ord-card-header .icon-box.green {
        background: linear-gradient(135deg, rgba(6, 214, 160, 0.1), rgba(5, 184, 138, 0.1));
        color: var(--ord-success);
    }

    .ord-card-header .header-info h5 {
        font-size: 16px;
        font-weight: 700;
        color: var(--ord-text);
        margin-bottom: 2px;
    }

    .ord-card-header .header-info p {
        font-size: 12px;
        color: var(--ord-text-muted);
        margin: 0;
    }

    .ord-card-body {
        padding: 26px;
    }

    /* ===== Toggle Pills ===== */
    .ord-pill-toggle {
        background: #eef0f8;
        border-radius: 12px;
        display: flex;
        padding: 4px;
        margin-bottom: 26px;
        position: relative;
    }

    .ord-pill-toggle input[type="radio"] {
        display: none;
    }

    .ord-pill-toggle label {
        flex: 1;
        text-align: center;
        padding: 11px 14px;
        border-radius: 9px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: var(--ord-transition);
        color: var(--ord-text-muted);
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        user-select: none;
    }

    .ord-pill-toggle label i {
        font-size: 16px;
    }

    .ord-pill-toggle input[type="radio"]:checked+label {
        background: var(--ord-primary);
        color: #fff;
        box-shadow: 0 4px 16px rgba(67, 97, 238, 0.3);
    }

    .ord-pill-toggle.green-mode input[type="radio"]:checked+label {
        background: linear-gradient(135deg, var(--ord-success) 0%, var(--ord-success-dark) 100%);
        box-shadow: 0 4px 16px rgba(6, 214, 160, 0.3);
    }

    /* ===== Form Fields ===== */
    .ord-field {
        position: relative;
        margin-bottom: 20px;
    }

    .ord-field label {
        font-size: 13px;
        font-weight: 600;
        color: var(--ord-text-secondary);
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .ord-field label .label-icon {
        font-size: 16px;
        color: var(--ord-primary);
    }

    .ord-field label .required-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--ord-danger);
        display: inline-block;
    }

    .ord-field label .optional-tag {
        font-size: 10px;
        font-weight: 500;
        color: var(--ord-text-muted);
        background: #eef0f8;
        padding: 2px 8px;
        border-radius: 4px;
        margin-left: auto;
    }

    .ord-field .input-wrap {
        position: relative;
    }

    .ord-field .input-wrap .field-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ord-text-muted);
        font-size: 18px;
        pointer-events: none;
        transition: color 0.3s;
        z-index: 2;
    }

    .ord-field .input-wrap .form-control,
    .ord-field .input-wrap .form-select {
        padding-left: 44px;
    }

    .ord-field .form-control,
    .ord-field .form-select {
        padding: 11px 16px;
        border: 2px solid var(--ord-border);
        border-radius: var(--ord-radius-sm);
        font-size: 14px;
        color: var(--ord-text);
        background: #f8f9fc;
        transition: var(--ord-transition);
        width: 100%;
        outline: none;
    }

    .ord-field .form-control:focus,
    .ord-field .form-select:focus {
        border-color: var(--ord-primary);
        background: var(--ord-white);
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.08);
    }

    .ord-field .input-wrap:focus-within .field-icon {
        color: var(--ord-primary);
    }

    .ord-field .form-control::placeholder {
        color: #b8bdd0;
    }

    .ord-field .form-control:read-only {
        background: #eef0f8;
        cursor: not-allowed;
    }

    /* ===== Validation Styles ===== */
    .ord-field .invalid-feedback {
        font-size: 12px;
        color: var(--ord-danger);
        margin-top: 6px;
        display: none;
        align-items: center;
        gap: 5px;
        font-weight: 500;
        padding-left: 2px;
    }

    .ord-field .invalid-feedback i {
        font-size: 14px;
    }

    .ord-field.is-invalid .form-control,
    .ord-field.is-invalid .form-select {
        border-color: var(--ord-danger) !important;
        background: #fff5f7 !important;
        box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.08) !important;
    }

    .ord-field.is-invalid .input-wrap .field-icon {
        color: var(--ord-danger) !important;
    }

    .ord-field.is-invalid .invalid-feedback {
        display: flex !important;
    }

    .ord-field.is-valid .form-control,
    .ord-field.is-valid .form-select {
        border-color: var(--ord-success) !important;
        background: #f2fdf9 !important;
        box-shadow: 0 0 0 4px rgba(6, 214, 160, 0.08) !important;
    }

    .ord-field.is-valid .input-wrap .field-icon {
        color: var(--ord-success) !important;
    }

    /* Shake animation for invalid fields */
    @keyframes ordShake {

        0%,
        100% {
            transform: translateX(0);
        }

        20% {
            transform: translateX(-6px);
        }

        40% {
            transform: translateX(6px);
        }

        60% {
            transform: translateX(-4px);
        }

        80% {
            transform: translateX(4px);
        }
    }

    .ord-field.is-invalid {
        animation: ordShake 0.4s ease;
    }

    /* Error count banner */
    .ord-error-banner {
        background: linear-gradient(135deg, #fff0f3, #ffe8ed);
        border: 1.5px solid #ffccd5;
        border-radius: var(--ord-radius-sm);
        padding: 14px 20px;
        margin-bottom: 22px;
        display: none;
        align-items: center;
        gap: 12px;
        animation: ordSlideDown 0.35s ease forwards;
    }

    .ord-error-banner .error-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(239, 71, 111, 0.12);
        color: var(--ord-danger);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .ord-error-banner .error-text h6 {
        font-size: 13px;
        font-weight: 700;
        color: var(--ord-danger);
        margin: 0 0 2px;
    }

    .ord-error-banner .error-text p {
        font-size: 12px;
        color: #c9184a;
        margin: 0;
        font-weight: 500;
    }

    .ord-error-banner .close-banner {
        margin-left: auto;
        background: none;
        border: none;
        color: #c9184a;
        cursor: pointer;
        font-size: 18px;
        padding: 4px;
        opacity: 0.6;
        transition: opacity 0.2s;
    }

    .ord-error-banner .close-banner:hover {
        opacity: 1;
    }

    /* ===== Customer Select Panel ===== */
    .ord-customer-panel {
        display: block;
        background: linear-gradient(135deg, #f0f3ff, #f4f0ff);
        border: 1.5px solid #d4daff;
        border-radius: var(--ord-radius);
        padding: 20px;
        margin-bottom: 22px;
        animation: ordSlideDown 0.35s ease forwards;
    }

    @keyframes ordSlideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .ord-customer-panel .panel-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 14px;
    }

    .ord-customer-panel .panel-title i {
        font-size: 19px;
        color: var(--ord-primary);
    }

    .ord-customer-panel .panel-title h6 {
        font-size: 14px;
        font-weight: 700;
        color: var(--ord-text);
        margin: 0;
    }

    /* ===== Status Bar ===== */
    .ord-status-bar {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        background: #eef0f8;
        border-radius: var(--ord-radius-xs);
        font-size: 12px;
        color: var(--ord-text-secondary);
        margin-bottom: 24px;
        font-weight: 500;
    }

    .ord-status-bar .pulse-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--ord-success);
        animation: ordPulse 2s infinite;
    }

    .ord-lookup-note {
        display: none;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 18px;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #d7dcff;
        background: linear-gradient(135deg, #f3f5ff, #f8f3ff);
        color: var(--ord-text-secondary);
        font-size: 12px;
        font-weight: 600;
    }

    .ord-lookup-note i {
        font-size: 18px;
        color: var(--ord-primary);
        margin-top: 1px;
    }

    @keyframes ordPulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.4;
            transform: scale(0.85);
        }
    }

    /* ===== Section Divider ===== */
    .ord-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 26px 0 22px;
    }

    .ord-divider::before,
    .ord-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--ord-border), transparent);
    }

    .ord-divider span {
        font-size: 11px;
        font-weight: 700;
        color: var(--ord-text-muted);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        white-space: nowrap;
    }

    /* ===== EMI Section ===== */
    .ord-emi-panel {
        display: none;
        background: linear-gradient(135deg, #fffbf0, #fff8eb);
        border: 1.5px solid #ffe0a3;
        border-radius: var(--ord-radius);
        padding: 24px;
        margin-top: 4px;
        margin-bottom: 22px;
        animation: ordSlideDown 0.4s ease forwards;
    }

    .ord-emi-panel .emi-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1.5px dashed #ffd07a;
    }

    .ord-emi-panel .emi-top .emi-badge {
        width: 36px;
        height: 36px;
        border-radius: var(--ord-radius-sm);
        background: rgba(255, 159, 28, 0.12);
        color: var(--ord-warning);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .ord-emi-panel .emi-top h6 {
        font-size: 14px;
        font-weight: 700;
        color: #c27803;
        margin: 0;
    }

    /* ===== EMI Summary ===== */
    .ord-emi-summary {
        background: linear-gradient(135deg, var(--ord-primary), var(--ord-secondary));
        border-radius: var(--ord-radius-sm);
        padding: 16px 20px;
        margin-top: 18px;
        display: none;
    }

    .ord-emi-summary .emi-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
    }

    .ord-emi-summary .emi-row:not(:last-child) {
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .ord-emi-summary .emi-lbl {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.65);
        font-weight: 500;
    }

    .ord-emi-summary .emi-val {
        font-size: 14px;
        color: #fff;
        font-weight: 700;
    }

    /* ===== Submit Button ===== */
    .ord-submit-btn {
        width: 100%;
        padding: 14px 24px;
        border-radius: var(--ord-radius);
        background: linear-gradient(135deg, var(--ord-primary) 0%, var(--ord-secondary) 100%);
        color: #fff;
        border: none;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: var(--ord-transition);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        margin-top: 10px;
    }

    .ord-submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.18), transparent);
        transition: left 0.6s;
    }

    .ord-submit-btn:hover::before {
        left: 100%;
    }

    .ord-submit-btn:hover {
        box-shadow: 0 10px 32px rgba(67, 97, 238, 0.35);
        transform: translateY(-2px);
    }

    .ord-submit-btn:active {
        transform: translateY(0);
    }

    .ord-submit-btn.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .ord-submit-btn .spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.25);
        border-top-color: #fff;
        border-radius: 50%;
        animation: ordSpin 0.75s linear infinite;
    }

    .ord-submit-btn.loading .spinner {
        display: inline-block;
    }

    .ord-submit-btn.loading .btn-label {
        display: none;
    }

    .ord-submit-btn.loading .loading-label {
        display: inline;
    }

    .ord-submit-btn .loading-label {
        display: none;
    }

    @keyframes ordSpin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ===== Summary Card ===== */
    .ord-summary-card {
        background: var(--ord-white);
        border-radius: 18px;
        box-shadow: var(--ord-shadow);
        border: 1px solid var(--ord-border);
        overflow: hidden;
        position: sticky;
        top: 100px;
        opacity: 0;
        transform: translateY(25px);
        animation: ordFadeUp 0.55s ease forwards;
        animation-delay: 0.3s;
    }

    .ord-summary-card .sum-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f0f3ff, #f4f0ff);
        border-bottom: 1px solid var(--ord-border);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ord-summary-card .sum-header i {
        font-size: 21px;
        color: var(--ord-primary);
    }

    .ord-summary-card .sum-header h6 {
        font-size: 15px;
        font-weight: 700;
        color: var(--ord-text);
        margin: 0;
    }

    .ord-summary-card .sum-body {
        padding: 22px 24px;
    }

    .sum-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 11px 0;
        border-bottom: 1px solid #f2f3f8;
    }

    .sum-row:last-child {
        border-bottom: none;
    }

    .sum-row .sum-label {
        font-size: 12px;
        color: var(--ord-text-muted);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sum-row .sum-label i {
        font-size: 15px;
        color: var(--ord-primary);
        opacity: 0.6;
    }

    .sum-row .summary-value {
        font-size: 13px;
        color: var(--ord-text);
        font-weight: 600;
        text-align: right;
        max-width: 55%;
        word-break: break-word;
    }

    .sum-row .summary-value.empty {
        color: #c4c9d8;
        font-style: italic;
        font-weight: 400;
    }

    .sum-total {
        background: linear-gradient(135deg, var(--ord-primary), var(--ord-secondary));
        border-radius: var(--ord-radius-sm);
        padding: 18px 20px;
        margin-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sum-total .total-label {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
        font-weight: 600;
    }

    .sum-total .total-value {
        font-size: 24px;
        color: #fff;
        font-weight: 800;
    }

    /* ===== Select2 Overrides ===== */
    .select2-container--default .select2-selection--single {
        height: 44px !important;
        border: 2px solid var(--ord-border) !important;
        border-radius: var(--ord-radius-sm) !important;
        background: #f8f9fc !important;
        padding-left: 34px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
        color: var(--ord-text) !important;
        font-size: 14px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
    }

    .select2-dropdown {
        border: 2px solid var(--ord-border) !important;
        border-radius: var(--ord-radius-sm) !important;
        box-shadow: var(--ord-shadow-hover) !important;
        overflow: hidden;
    }

    .select2-results__option--highlighted[aria-selected] {
        background: var(--ord-primary) !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: var(--ord-primary) !important;
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.08) !important;
    }

    .select2-search--dropdown .select2-search__field {
        border: 2px solid var(--ord-border) !important;
        border-radius: var(--ord-radius-xs) !important;
        padding: 8px 12px !important;
    }

    .select2-search--dropdown .select2-search__field:focus {
        border-color: var(--ord-primary) !important;
    }

    /* ===== Responsive ===== */
    @media (max-width: 991px) {
        .ord-summary-card {
            position: static;
            margin-top: 24px;
        }
    }

    @media (max-width: 768px) {
        .ord-page-header {
            padding: 24px 20px;
            border-radius: 16px;
        }

        .ord-page-header .page-title {
            font-size: 22px;
        }

        .ord-card-body {
            padding: 20px;
        }

        .ord-card-header {
            padding: 18px 20px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!-- ===== Page Header ===== -->
        <div class="ord-page-header">
            <div class="deco-circle c1"></div>
            <div class="deco-circle c2"></div>
            <div class="deco-circle c3"></div>
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 header-content">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2 p-0">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('dashboard'); ?>">
                                    <i class="bx bx-home-alt"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('orders'); ?>">Orders</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New Order</li>
                        </ol>
                    </nav>
                    <h1 class="page-title">Create New Order</h1>
                    <p class="page-desc">
                        <i class="bx bx-cart-add me-1"></i>
                        Fill in customer and product details to create a new order
                    </p>
                </div>
                <a href="<?= base_url('admin/orders'); ?>" class="ord-back-btn">
                    <i class="bx bx-arrow-back"></i>
                    Back to Orders
                </a>
            </div>
        </div>
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" style="padding: 15px; margin-bottom: 20px; background: #D1FAE5; border: 1px solid #34D399; border-radius: 8px; color: #065F46;">
                <i class="fas fa-check-circle"></i>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="padding: 15px; margin-bottom: 20px; background: #FEE2E2; border: 1px solid #F87171; border-radius: 8px; color: #991B1B;">
                <i class="fas fa-exclamation-circle"></i>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('warning')): ?>
            <div class="alert alert-warning" style="padding: 15px; margin-bottom: 20px; background: #FEF3C7; border: 1px solid #FBBF24; border-radius: 8px; color: #92400E;">
                <i class="fas fa-exclamation-triangle"></i>
                <?= $this->session->flashdata('warning') ?>
            </div>
        <?php endif; ?>

        <!-- ===== Main Form ===== -->
        <form id="orderForm" action="<?= site_url('admin/orders/save_order') ?>" method="post" novalidate>

            <!-- Error Banner -->
            <!-- <div class="ord-error-banner" id="errorBanner">
                <div class="error-icon">
                    <i class="bx bx-error-circle"></i>
                </div>
                <div class="error-text">
                    <h6>Please fix the errors below</h6>
                    <p id="errorCount">3 required fields are missing</p>
                </div>
                <button type="button" class="close-banner" onclick="$('#errorBanner').slideUp(300);">
                    <i class="bx bx-x"></i>
                </button>
            </div> -->

            <div class="row g-4">

                <!-- ===== LEFT: Customer Details ===== -->
                <div class="col-lg-4">
                    <div class="ord-card delay-1">
                        <div class="ord-card-header">
                            <div class="icon-box purple">
                                <i class="bx bx-user"></i>
                            </div>
                            <div class="header-info">
                                <h5>Customer Details</h5>
                                <p>New or existing customer info</p>
                            </div>
                        </div>
                        <div class="ord-card-body">
                            <div class="ord-lookup-note" id="ordLookupNote">
                                <i class="bx bx-info-circle"></i>
                                <span id="ordLookupText"></span>
                            </div>

                            <!-- Mobile -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-phone label-icon"></i>
                                    Mobile Number
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-phone field-icon"></i>
                                    <input type="tel" class="form-control" id="ordcustomerMobile" name="customerMobile"
                                        pattern="^\+?[0-9\s\-]{7,20}" placeholder="+1 234 567 8900" required>
                                    <input type="hidden" id="customer_id" name="customer_id">
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please enter a valid mobile number.
                                </div>
                            </div>

                            <!-- Customer Name -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-user label-icon"></i>
                                    Customer Name
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-user field-icon"></i>
                                    <input type="text" class="form-control" id="cust_Name" name="customerName"
                                        placeholder="Enter customer name" required>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please enter customer name.
                                </div>
                            </div>

                            <!-- Area -->


                            <!-- Address -->
                            <div class="ord-field" style="margin-bottom:0;">
                                <label>
                                    <i class="bx bx-home label-icon"></i>
                                    Full Address
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-home field-icon"></i>
                                    <input type="text" class="form-control" id="ordcustomerAddress" name="address"
                                        placeholder="Enter full address" required>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please enter address.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ===== CENTER: Order Details ===== -->
                <div class="col-lg-5">
                    <div class="ord-card delay-2">
                        <div class="ord-card-header">
                            <div class="icon-box green">
                                <i class="bx bx-package"></i>
                            </div>
                            <div class="header-info">
                                <h5>Order Details</h5>
                                <p>Product, pricing & service info</p>
                            </div>
                        </div>
                        <div class="ord-card-body">

                            <!-- Payment Type Toggle -->
                            <div class="ord-pill-toggle green-mode">
                                <input type="radio" id="radio1" name="customRadio" value="full_payment" checked>
                                <label for="radio1">
                                    <i class="bx bx-wallet"></i>
                                    Full Payment
                                </label>
                                <input type="radio" id="radio2" name="customRadio" value="installment">
                                <label for="radio2">
                                    <i class="bx bx-calendar"></i>
                                    Installment
                                </label>
                            </div>

                            <div class="ord-status-bar">
                                <div class="pulse-dot"></div>
                                <span>Payment type: <strong id="paymentTypeLabel">Full Payment</strong></span>
                            </div>

                            <!-- Product Name -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-package label-icon"></i>
                                    Product Name
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-purchase-tag field-icon"></i>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Enter product name" list="productNameList" autocomplete="off" required>
                                    <datalist id="productNameList">
                                        <?php if (!empty($products)) { ?>
                                            <?php foreach ($products as $product) { ?>
                                                <option
                                                    value="<?= htmlspecialchars($product->name) ?>"
                                                    data-id="<?= $product->id ?>">
                                                </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </datalist>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please enter product name.
                                </div>
                            </div>

                            <!-- Date of Purchase -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-calendar label-icon"></i>
                                    Date of Purchase
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-calendar field-icon"></i>
                                    <input type="date" class="form-control" id="purchasedate" name="purchasedate"
                                        value="<?= date('Y-m-d') ?>" required>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please select purchase date.
                                </div>
                            </div>

                            <!-- Sell Price -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-dollar-circle label-icon"></i>
                                    Sell Price
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-dollar field-icon"></i>
                                    <input type="number" class="form-control" name="price" id="inputProductTags" min="0"
                                        placeholder="0.00" required>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please enter sell price.
                                </div>
                            </div>

                            <div class="ord-divider">
                                <span>Service Details</span>
                            </div>

                            <!-- Total Services -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-wrench label-icon"></i>
                                    Total Services
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-hash field-icon"></i>
                                    <input type="number" class="form-control" name="total_services" id="total_services"
                                        min="0" placeholder="e.g. 4" required>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please enter total services.
                                </div>
                            </div>

                            <!-- Service Interval -->
                            <div class="ord-field">
                                <label>
                                    <i class="bx bx-time-five label-icon"></i>
                                    Service Interval
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-time-five field-icon"></i>
                                    <select class="form-select" name="service_interval" id="inputProductType" required>
                                        <option value="">Select Interval</option>
                                        <option value="1">Every 1 Month</option>
                                        <option value="2">Every 2 Months</option>
                                        <option value="3">Every 3 Months</option>
                                        <option value="4">Every 4 Months</option>
                                        <option value="5">Every 5 Months</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please select service interval.
                                </div>
                            </div>

                            <div class="ord-field" id="serviceStartDateField" style="display:none;">
                                <label>
                                    <i class="bx bx-calendar-star label-icon"></i>
                                    Service Start Date
                                    <span class="required-dot"></span>
                                </label>
                                <div class="input-wrap">
                                    <i class="bx bx-calendar field-icon"></i>
                                    <input type="date" class="form-control" name="start_service_date" id="start_service_date">
                                </div>
                                <div class="invalid-feedback">
                                    <i class="bx bx-error-circle"></i>
                                    Please select service start date.
                                </div>
                            </div>

                            <!-- ===== EMI Section ===== -->
                            <div class="ord-emi-panel" id="emiSection">
                                <div class="emi-top">
                                    <div class="emi-badge">
                                        <i class="bx bx-calendar-check"></i>
                                    </div>
                                    <h6>Installment Plan Details</h6>
                                </div>

                                <!-- Down Payment -->
                                <div class="ord-field">
                                    <label>
                                        <i class="bx bx-wallet label-icon"></i>
                                        Down Payment
                                    </label>
                                    <div class="input-wrap">
                                        <i class="bx bx-dollar field-icon"></i>
                                        <input type="text" class="form-control" name="down_payment" id="dp">
                                    </div>
                                    <div class="invalid-feedback">
                                        <i class="bx bx-error-circle"></i>
                                        Please enter a valid down payment.
                                    </div>
                                </div>

                                <!-- EMI Duration -->
                                <div class="ord-field">
                                    <label>
                                        <i class="bx bx-calendar label-icon"></i>
                                        EMI Duration (Months)
                                    </label>
                                    <div class="input-wrap">
                                        <i class="bx bx-hash field-icon"></i>
                                        <input type="number" class="form-control" name="emi_month" id="inputEmiDuration"
                                            placeholder="e.g. 12">
                                    </div>
                                    <div class="invalid-feedback">
                                        <i class="bx bx-error-circle"></i>
                                        Please enter a valid EMI duration.
                                    </div>
                                </div>

                                <!-- EMI Amount -->
                                <div class="ord-field">
                                    <label>
                                        <i class="bx bx-money label-icon"></i>
                                        EMI Amount
                                        <span class="optional-tag">Auto-calculated</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="bx bx-dollar field-icon"></i>
                                        <input type="text" class="form-control" name="emi_amount" id="inputEmiAmount"
                                            readonly placeholder="Calculated automatically">
                                    </div>
                                </div>

                                <!-- EMI Start Date -->
                                <div class="ord-field" style="margin-bottom:0;">
                                    <label>
                                        <i class="bx bx-calendar-event label-icon"></i>
                                        EMI Start Date
                                    </label>
                                    <div class="input-wrap">
                                        <i class="bx bx-calendar field-icon"></i>
                                        <input type="date" class="form-control" name="emi_date" id="emi_date">
                                    </div>
                                    <div class="invalid-feedback">
                                        <i class="bx bx-error-circle"></i>
                                        Please select EMI start date.
                                    </div>
                                </div>

                                <!-- EMI Summary -->
                                <div class="ord-emi-summary" id="emiSummary">
                                    <div class="emi-row">
                                        <span class="emi-lbl">Total Price</span>
                                        <span class="emi-val" id="emiTotalPrice">₹0.00</span>
                                    </div>
                                    <div class="emi-row">
                                        <span class="emi-lbl">Down Payment</span>
                                        <span class="emi-val" id="emiDpDisplay">₹0.00</span>
                                    </div>
                                    <div class="emi-row">
                                        <span class="emi-lbl">Monthly EMI</span>
                                        <span class="emi-val" id="emiMonthlyDisplay">₹0.00</span>
                                    </div>
                                    <div class="emi-row">
                                        <span class="emi-lbl">Duration</span>
                                        <span class="emi-val" id="emiDurationDisplay">0 months</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="ord-submit-btn saveorder">
                                <span class="spinner"></span>
                                <span class="btn-label" href="save_order">
                                    <i class="bx bx-check-circle"></i>
                                    Create Order
                                </span>
                                <span class="loading-label">Processing Order...</span>
                            </button>

                        </div>
                    </div>
                </div>

                <!-- ===== RIGHT: Order Summary ===== -->
                <div class="col-lg-3">
                    <div class="ord-summary-card">
                        <div class="sum-header">
                            <i class="bx bx-receipt"></i>
                            <h6>Order Summary</h6>
                        </div>
                        <div class="sum-body">
                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-user"></i> Customer
                                </span>
                                <span class="summary-value empty" id="sumCustomer">Not set</span>
                            </div>
                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-phone"></i> Mobile
                                </span>
                                <span class="summary-value empty" id="sumMobile">Not set</span>
                            </div>
                            <!-- <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-map"></i> Area
                                </span>
                                <span class="summary-value empty" id="sumArea">Not set</span>
                            </div> -->

                            <div class="ord-divider" style="margin:14px 0;">
                                <span>Product</span>
                            </div>

                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-package"></i> Product
                                </span>
                                <span class="summary-value empty" id="sumProduct">Not set</span>
                            </div>
                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-calendar"></i> Purchased
                                </span>
                                <span class="summary-value empty" id="sumDate">Not set</span>
                            </div>
                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-wallet"></i> Payment
                                </span>
                                <span class="summary-value" id="sumPayment">Full Payment</span>
                            </div>
                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-wrench"></i> Services
                                </span>
                                <span class="summary-value empty" id="sumServices">Not set</span>
                            </div>
                            <div class="sum-row">
                                <span class="sum-label">
                                    <i class="bx bx-time-five"></i> Interval
                                </span>
                                <span class="summary-value empty" id="sumInterval">Not set</span>
                            </div>

                            <!-- Total -->
                            <div class="sum-total">
                                <span class="total-label">Total Price</span>
                                <span class="total-value" id="sumTotal">₹0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                const productMasterMap = {
                    <?php if (!empty($products)) { ?>
                        <?php foreach ($products as $index => $product) { ?> "<?= strtolower(addslashes(trim((string) $product->name))) ?>": {
                                id: <?= (int) $product->id ?>,
                                name: "<?= addslashes((string) $product->name) ?>",
                                purchase_price: "<?= addslashes((string) $product->purchase_price) ?>",
                                sell_price: "<?= addslashes((string) ($product->sell_price !== null ? $product->sell_price : '')) ?>"
                            }
                            <?= $index < count($products) - 1 ? ',' : '' ?>
                        <?php } ?>
                    <?php } ?>
                };

                /* ===============================
                BOOTSTRAP VALIDATION
                ================================*/
                $('#orderForm').on('submit', function(e) {

                    let form = this;
                    let isValid = true;
                    let errorCount = 0;

                    // Reset all previous validation states
                    $(form).find('.ord-field').removeClass('is-invalid is-valid');

                    // Check each required field
                    $(form).find('[required]').each(function() {

                        let $field = $(this);
                        let $ordField = $field.closest('.ord-field');
                        let value = $.trim($field.val());

                        // Check if field is visible (not inside hidden EMI section)
                        if (!$field.is(':visible')) return;

                        if (!value || !this.checkValidity()) {
                            $ordField.addClass('is-invalid');
                            isValid = false;
                            errorCount++;
                        } else {
                            $ordField.addClass('is-valid');
                        }
                    });

                    // If invalid, prevent submit and show error banner
                    if (!isValid) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Show error banner
                        let fieldText = errorCount === 1 ? 'field is' : 'fields are';
                        $('#errorCount').text(errorCount + ' required ' + fieldText + ' missing');
                        $('#errorBanner').slideDown(350);

                        // Scroll to first error
                        let $firstError = $(form).find('.ord-field.is-invalid').first();
                        if ($firstError.length) {
                            $('html, body').animate({
                                scrollTop: $firstError.offset().top - 120
                            }, 500);

                            // Focus the first invalid input
                            $firstError.find('input, select, textarea').first().focus();
                        }

                        return false;
                    }

                    // If valid, hide error banner and show loader
                    $('#errorBanner').slideUp(200);
                    $('.ord-submit-btn').addClass('loading').prop('disabled', true);
                });

                // Real-time validation: clear error on input
                $(document).on('input change', '.ord-field .form-control, .ord-field .form-select', function() {

                    let $field = $(this);
                    let $ordField = $field.closest('.ord-field');
                    let value = $.trim($field.val());

                    // Only validate if form was already submitted (has any is-invalid)
                    if ($('#orderForm').find('.is-invalid').length === 0 && !$ordField.hasClass('is-invalid')) return;

                    if ($field.prop('required')) {
                        if (value && this.checkValidity()) {
                            $ordField.removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $ordField.removeClass('is-valid').addClass('is-invalid');
                        }
                    } else {
                        $ordField.removeClass('is-invalid');
                        if (value) {
                            $ordField.addClass('is-valid');
                        }
                    }

                    // Update error count in banner
                    let remaining = $('#orderForm').find('.ord-field.is-invalid').length;
                    if (remaining === 0) {
                        $('#errorBanner').slideUp(300);
                    } else {
                        let fieldText = remaining === 1 ? 'field is' : 'fields are';
                        $('#errorCount').text(remaining + ' required ' + fieldText + ' missing');
                    }
                });

                /* ===============================
                SELECT2 SEARCH
                ================================*/
                $('#cust_id').select2({
                    placeholder: "Search customer",
                    width: '100%',
                    allowClear: true,
                    minimumInputLength: 1,
                    matcher: function(params, data) {
                        if ($.trim(params.term) === '') return data;
                        if (typeof data.text === 'undefined') return null;

                        let term = params.term.toLowerCase();
                        let text = data.text.toLowerCase();

                        return text.indexOf(term) > -1 ? data : null;
                    }
                });

                let orderLookupTimer = null;
                let paymentTypeManuallyChanged = false;
                let serviceStartDateManuallyChanged = false;

                function formatRupees(amount) {
                    return '₹' + ((parseFloat(amount) || 0).toFixed(2));
                }

                function toInputDate(date) {
                    let year = date.getFullYear();
                    let month = String(date.getMonth() + 1).padStart(2, '0');
                    let day = String(date.getDate()).padStart(2, '0');
                    return year + '-' + month + '-' + day;
                }

                function getSuggestedServiceStartDate() {
                    let purchaseDate = $('#purchasedate').val();
                    let interval = parseInt($('#inputProductType').val(), 10) || 0;

                    if (!purchaseDate || interval <= 0) {
                        return '';
                    }

                    let startDate = new Date(purchaseDate + 'T00:00:00');
                    startDate.setMonth(startDate.getMonth() + interval);

                    return toInputDate(startDate);
                }

                function syncServiceStartDate(forceUpdate) {
                    let interval = parseInt($('#inputProductType').val(), 10) || 0;
                    let suggestedDate = getSuggestedServiceStartDate();

                    if (interval > 0) {
                        $('#serviceStartDateField').stop(true, true).slideDown(200);
                        $('#start_service_date').prop('required', true);

                        if (forceUpdate === true || !serviceStartDateManuallyChanged || !$('#start_service_date').val()) {
                            $('#start_service_date').val(suggestedDate);
                        }
                    } else {
                        $('#serviceStartDateField').stop(true, true).slideUp(200);
                        $('#start_service_date').prop('required', false).val('');
                        $('#serviceStartDateField').removeClass('is-invalid is-valid');
                        serviceStartDateManuallyChanged = false;
                    }
                }

                function applyPaymentType(type, options) {
                    let settings = options || {};
                    let isInstallment = type === 'installment';

                    if (settings.markManual) {
                        paymentTypeManuallyChanged = true;
                    }

                    $('#radio1').prop('checked', !isInstallment);
                    $('#radio2').prop('checked', isInstallment);

                    if (isInstallment) {
                        $('#emiSection').stop(true, true).slideDown(400);
                        $('#paymentTypeLabel').text('Installment');
                        $('#sumPayment').text('Installment');
                    } else {
                        $('#emiSection').stop(true, true).slideUp(400);
                        $('#paymentTypeLabel').text('Full Payment');
                        $('#sumPayment').text('Full Payment');
                        $('#emiSection .ord-field').removeClass('is-invalid is-valid');
                    }
                }

                function showLookupNote(message) {
                    if (!message) {
                        $('#ordLookupText').text('');
                        $('#ordLookupNote').stop(true, true).hide();
                        return;
                    }

                    $('#ordLookupText').text(message);
                    $('#ordLookupNote').stop(true, true).fadeIn(200);
                }

                function fillOrderDetails(order) {
                    if (!order) {
                        return;
                    }

                    $('#product_name').val(order.product_name || '');
                    $('#purchasedate').val(order.date_of_purchase || '');
                    $('#inputProductTags').val(order.price || '');
                    $('#total_services').val(order.total_services || '');
                    $('#inputProductType').val(order.service_interval || '');
                    serviceStartDateManuallyChanged = false;
                    $('#start_service_date').val(order.start_service_date || '');

                    if (!paymentTypeManuallyChanged && parseInt(order.payment_type, 10) === 1) {
                        applyPaymentType('installment');
                        $('#dp').val(order.down_payment || '');
                        $('#inputEmiDuration').val(order.emi_duration || '');
                        $('#emi_date').val(order.emi_date || order.date_of_purchase || '');
                    } else if (!paymentTypeManuallyChanged) {
                        applyPaymentType('full_payment');
                        $('#dp').val('');
                        $('#inputEmiDuration').val('');
                        $('#inputEmiAmount').val('');
                        $('#emi_date').val('');
                    }

                    syncServiceStartDate(!(order.start_service_date || ''));
                    $('#product_name, #purchasedate, #inputProductTags, #total_services, #inputProductType, #start_service_date, #dp, #inputEmiDuration, #emi_date').trigger('input').trigger('change');
                    calculateEMI();
                }

                function fillProductMasterDetails(product) {
                    if (!product) {
                        return;
                    }

                    if (product.name) {
                        $('#product_name').val(product.name);
                    }

                    const selectedPrice = product.sell_price !== undefined && product.sell_price !== null && product.sell_price !== '' ?
                        product.sell_price :
                        product.purchase_price;

                    if (selectedPrice !== undefined && selectedPrice !== null && selectedPrice !== '') {
                        $('#inputProductTags').val(selectedPrice);
                    }

                    $('#inputProductTags').trigger('input').trigger('change');
                    calculateEMI();
                }

                function getMatchedProductFromMaster(productName) {
                    let key = $.trim(productName || '').toLowerCase();
                    return key && productMasterMap[key] ? productMasterMap[key] : null;
                }

                function performOrderLookup() {
                    let mobile = $.trim($('#ordcustomerMobile').val());
                    let productName = $.trim($('#product_name').val());

                    if (mobile.length < 6 && productName.length < 2) {
                        showLookupNote('');
                        return;
                    }

                    $.ajax({
                        url: "<?= site_url('admin/orders/lookup_existing_order') ?>",
                        type: "POST",
                        data: {
                            mobile: mobile,
                            product_name: productName
                        },
                        dataType: "json",
                        success: function(res) {
                            let hasCustomer = !!(res && res.customer);
                            let hasOrder = !!(res && res.order);
                            let hasProduct = !!(res && res.product);

                            if (hasCustomer) {
                                $('#customer_id').val(res.customer.id || '');
                                $('#cust_Name').val(res.customer.name || '');
                                $('#ordcustomerAddress').val(res.customer.address || '');
                                $('#sumCustomer').text(res.customer.name || 'Not set').removeClass('empty');
                                $('#sumMobile').text(res.customer.mobile || mobile || 'Not set').removeClass('empty');
                                $('#cust_Name, #ordcustomerAddress').trigger('input').trigger('change');
                            } else if (mobile.length >= 6) {
                                $('#customer_id').val('');
                                $('#cust_Name').val('');
                                $('#ordcustomerAddress').val('');
                                $('#sumCustomer').text('Not set').addClass('empty');
                                $('#sumMobile').text(mobile || 'Not set').toggleClass('empty', !mobile);
                            }

                            if (hasOrder) {
                                fillOrderDetails(res.order);
                            } else if (hasProduct) {
                                fillProductMasterDetails(res.product);
                            }

                            if (hasCustomer && hasOrder) {
                                showLookupNote('Existing customer details and matching product details found. Both sections filled automatically, and you can still edit them.');
                            } else if (hasCustomer && hasProduct) {
                                showLookupNote('Existing customer found and product master matched. Customer details and product price were filled automatically.');
                            } else if (hasCustomer) {
                                showLookupNote('Existing customer found. Only customer details were filled automatically.');
                            } else if (hasOrder) {
                                showLookupNote('Matching product found. Product details were filled automatically.');
                            } else if (hasProduct) {
                                showLookupNote('Product matched from product list. Product price was filled automatically.');
                            } else {
                                showLookupNote('');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }

                function triggerOrderLookup() {
                    clearTimeout(orderLookupTimer);
                    orderLookupTimer = setTimeout(performOrderLookup, 350);
                }

                /* ===============================
                CUSTOMER MOBILE AUTO FETCH
                ================================*/
                $('#ordcustomerMobile').on('input', function() {
                    triggerOrderLookup();
                });

                /* ===============================
                CUSTOMER SELECT AUTO FILL
                ================================*/
                $('#cust_id').change(function() {

                    let option = $(this).find(':selected');
                    if (!option.val()) return;

                    let id = option.val();
                    let name = option.data('name') || '';
                    let mobile = option.data('mobile') || '';
                    // let area = option.data('area') || '';
                    let address = option.data('address') || '';

                    $('#customer_id').val(id);
                    $('#cust_Name').val(name);
                    $('#ordcustomerMobile').val(mobile);
                    // $('#ordcustomerArea').val(area);
                    $('#ordcustomerAddress').val(address);

                    // Trigger validation clear for auto-filled fields
                    $('#cust_Name, #ordcustomerMobile, #ordcustomerArea, #ordcustomerAddress').trigger('change');
                    triggerOrderLookup();
                });

                /* ===============================
                PAYMENT TYPE SWITCH
                ================================*/
                $('input[name="customRadio"]').change(function() {
                    applyPaymentType($(this).val(), {
                        markManual: true
                    });
                });

                /* ===============================
                PRODUCT NAME SUMMARY
                ================================*/
                $('#product_name').on('input', function() {
                    let val = $(this).val();
                    $('#sumProduct').text(val ? val : 'Not set').removeClass('empty');

                    let matchedProduct = getMatchedProductFromMaster(val);
                    if (matchedProduct) {
                        fillProductMasterDetails(matchedProduct);
                        showLookupNote('Existing product selected from product list. Product price was filled automatically.');
                    }

                    triggerOrderLookup();
                });

                /* ===============================
                SUMMARY FIELD UPDATES
                ================================*/
                $('#cust_Name').on('input', function() {
                    $('#sumCustomer').text($(this).val() || 'Not set');
                });

                $('#ordcustomerMobile').on('input', function() {
                    $('#sumMobile').text($(this).val() || 'Not set');
                });

                // $('#ordcustomerArea').on('input', function () {
                //     $('#sumArea').text($(this).val() || 'Not set');
                // });

                $('#total_services').on('input', function() {
                    $('#sumServices').text($(this).val() || 'Not set');
                });

                /* ===============================
                PURCHASE DATE
                ================================*/
                $('#purchasedate').change(function() {

                    let val = $(this).val();

                    if (val) {
                        let d = new Date(val);
                        let formatted = d.toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        });
                        $('#sumDate').text(formatted);
                    } else {
                        $('#sumDate').text('Not set');
                    }

                    syncServiceStartDate(true);
                });

                /* ===============================
                SERVICE INTERVAL
                ================================*/
                $('#inputProductType').change(function() {
                    let text = $(this).find('option:selected').text();
                    $('#sumInterval').text($(this).val() ? text : 'Not set');
                    syncServiceStartDate(true);
                });

                $('#start_service_date').on('input change', function() {
                    serviceStartDateManuallyChanged = !!$(this).val();
                });

                /* ===============================
                PRICE + TOTAL
                ================================*/
                $('#inputProductTags').on('input', function() {

                    let price = parseFloat($(this).val()) || 0;
                    $('#sumTotal').text(formatRupees(price));

                    calculateEMI();
                });

                /* ===============================
                EMI CALCULATION
                ================================*/
                function calculateEMI() {

                    let price = parseFloat($('#inputProductTags').val()) || 0;
                    let dp = parseFloat($('#dp').val()) || 0;
                    let months = parseInt($('#inputEmiDuration').val()) || 0;

                    if (price > 0 && months > 0) {

                        let remaining = price - dp;
                        let emi = remaining / months;

                        $('#inputEmiAmount').val(emi.toFixed(2));

                        $('#emiTotalPrice').text(formatRupees(price));
                        $('#emiDpDisplay').text(formatRupees(dp));
                        $('#emiMonthlyDisplay').text(formatRupees(emi));
                        $('#emiDurationDisplay').text(months + ' months');

                        $('#emiSummary').slideDown();

                    } else {

                        $('#inputEmiAmount').val('');
                        $('#emiSummary').hide();
                    }
                }

                $('#dp, #inputEmiDuration').on('input', calculateEMI);
                applyPaymentType($('input[name="customRadio"]:checked').val() || 'full_payment');
                syncServiceStartDate(true);
                $('#purchasedate').trigger('change');

            });
        </script>

    </div>
</div>