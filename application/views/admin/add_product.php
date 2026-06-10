<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            .ap-wrap {
                max-width: 900px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* ── Top Bar ── */
            .ap-topbar {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                flex-wrap: wrap;
            }

            .ap-topbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 18px;
                font-weight: 700;
                color: #1e293b;
                margin-right: auto;
            }

            .ap-topbar-title i {
                font-size: 22px;
                color: #6366f1;
            }

            .ap-top-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                border: 1px solid #e2e8f0;
                background: #fff;
                color: #475569;
                cursor: pointer;
                transition: all 0.15s ease;
            }

            .ap-top-btn:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
                color: #334155;
                text-decoration: none;
            }

            .ap-top-btn i {
                font-size: 16px;
            }

            /* ── Flash Messages ── */
            .ap-alert {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 18px;
                border-radius: 10px;
                margin-bottom: 16px;
                font-size: 13px;
                font-weight: 500;
            }

            .ap-alert i {
                font-size: 20px;
                flex-shrink: 0;
            }

            .ap-alert.success {
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #065f46;
            }

            .ap-alert.success i {
                color: #059669;
            }

            .ap-alert.error {
                background: #fef2f2;
                border: 1px solid #fecaca;
                color: #991b1b;
            }

            .ap-alert.error i {
                color: #dc2626;
            }

            .ap-alert .close-alert {
                margin-left: auto;
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
                opacity: 0.5;
                color: inherit;
                padding: 0;
            }

            .ap-alert .close-alert:hover {
                opacity: 1;
            }

            /* ── Progress Bar ── */
            .ap-progress {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                padding: 16px 20px;
                margin-bottom: 16px;
            }

            .ap-progress-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 10px;
            }

            .ap-progress-label {
                font-size: 12px;
                font-weight: 600;
                color: #64748b;
            }

            .ap-progress-pct {
                font-size: 12px;
                font-weight: 700;
                color: #6366f1;
            }

            .ap-progress-bar {
                width: 100%;
                height: 6px;
                background: #f1f5f9;
                border-radius: 99px;
                overflow: hidden;
            }

            .ap-progress-fill {
                height: 100%;
                width: 0%;
                background: linear-gradient(90deg, #6366f1, #8b5cf6);
                border-radius: 99px;
                transition: width 0.4s ease;
            }

            .ap-progress-steps {
                display: flex;
                justify-content: space-between;
                margin-top: 10px;
            }

            .ap-progress-step {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 11px;
                font-weight: 600;
                color: #94a3b8;
                transition: color 0.2s;
            }

            .ap-progress-step.done {
                color: #059669;
            }

            .ap-progress-step.active {
                color: #6366f1;
            }

            .ap-progress-step i {
                font-size: 14px;
            }

            /* ── Card ── */
            .ap-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 16px;
                transition: border-color 0.2s;
            }

            .ap-card:focus-within {
                border-color: #c7d2fe;
            }

            .ap-card-head {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
            }

            .ap-card-head .h-icon {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                flex-shrink: 0;
            }

            .ap-card-head .h-icon.purple {
                background: #eef2ff;
                color: #6366f1;
            }

            .ap-card-head .h-icon.green {
                background: #ecfdf5;
                color: #059669;
            }

            .ap-card-head .h-icon.amber {
                background: #fffbeb;
                color: #d97706;
            }

            .ap-card-head h3 {
                margin: 0;
                font-size: 15px;
                font-weight: 700;
                color: #1e293b;
            }

            .ap-card-head p {
                margin: 0;
                font-size: 12px;
                color: #94a3b8;
            }

            .ap-card-head .head-right {
                margin-left: auto;
            }

            .ap-section-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 11px;
                font-weight: 700;
                background: #f1f5f9;
                color: #94a3b8;
            }

            .ap-section-badge.filled {
                background: #ecfdf5;
                color: #059669;
            }

            .ap-section-badge i {
                font-size: 12px;
            }

            .ap-card-body {
                padding: 20px;
            }

            /* ── Form Fields ── */
            .ap-field {
                margin-bottom: 16px;
            }

            .ap-field:last-child {
                margin-bottom: 0;
            }

            .ap-field label {
                font-size: 13px;
                font-weight: 600;
                color: #475569;
                margin-bottom: 6px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .ap-field label .li {
                font-size: 15px;
                color: #6366f1;
            }

            .ap-field label .req {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background: #ef4444;
                display: inline-block;
            }

            .ap-field label .opt {
                font-size: 10px;
                font-weight: 500;
                color: #94a3b8;
                background: #f1f5f9;
                padding: 2px 7px;
                border-radius: 4px;
                margin-left: auto;
            }

            .ap-field .iw {
                position: relative;
            }

            .ap-field .iw .fi {
                position: absolute;
                left: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 16px;
                pointer-events: none;
                transition: color 0.15s;
                z-index: 2;
            }

            .ap-field .iw .fc,
            .ap-field .iw .fs {
                padding-left: 38px;
            }

            .ap-field .iw .fc.has-right {
                padding-right: 38px;
            }

            .ap-field .fc,
            .ap-field .fs {
                padding: 10px 14px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 13px;
                color: #1e293b;
                background: #f8fafc;
                transition: all 0.15s ease;
                width: 100%;
                outline: none;
                font-family: inherit;
            }

            .ap-field .fc:focus,
            .ap-field .fs:focus {
                border-color: #a5b4fc;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .ap-field .iw:focus-within .fi {
                color: #6366f1;
            }

            .ap-field .fc::placeholder {
                color: #b8bdd0;
            }

            .ap-field .hint {
                font-size: 12px;
                color: #94a3b8;
                margin-top: 5px;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .ap-field .hint i {
                font-size: 13px;
            }

            .ap-field-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 5px;
            }

            .ap-field .char-count {
                font-size: 11px;
                color: #94a3b8;
                font-weight: 500;
                font-variant-numeric: tabular-nums;
            }

            .ap-field .char-count.warn {
                color: #f59e0b;
            }

            .ap-field .char-count.danger {
                color: #ef4444;
            }

            /* ── Field Status Icon ── */
            .ap-field .status-icon {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 16px;
                z-index: 2;
                opacity: 0;
                transition: all 0.2s ease;
            }

            .ap-field.is-valid .status-icon.valid-ico {
                opacity: 1;
                color: #10b981;
            }

            .ap-field.is-invalid .status-icon.invalid-ico {
                opacity: 1;
                color: #ef4444;
            }

            /* ── Validation ── */
            .ap-field .inv-msg {
                font-size: 12px;
                color: #ef4444;
                margin-top: 5px;
                display: none;
                align-items: center;
                gap: 4px;
                font-weight: 500;
            }

            .ap-field .inv-msg i {
                font-size: 13px;
            }

            .ap-field.is-invalid .fc,
            .ap-field.is-invalid .fs {
                border-color: #ef4444 !important;
                background: #fff5f7 !important;
            }

            .ap-field.is-invalid .iw .fi {
                color: #ef4444 !important;
            }

            .ap-field.is-invalid .inv-msg {
                display: flex !important;
            }

            .ap-field.is-valid .fc,
            .ap-field.is-valid .fs {
                border-color: #10b981 !important;
            }

            .ap-field.is-valid .iw .fi {
                color: #10b981 !important;
            }

            @keyframes apShake {

                0%,
                100% {
                    transform: translateX(0);
                }

                20% {
                    transform: translateX(-5px);
                }

                40% {
                    transform: translateX(5px);
                }

                60% {
                    transform: translateX(-3px);
                }

                80% {
                    transform: translateX(3px);
                }
            }

            .ap-field.is-invalid {
                animation: apShake 0.35s ease;
            }

            /* ── Unit Cards ── */
            .ap-units {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .ap-unit {
                flex: 1;
                min-width: 80px;
                position: relative;
                cursor: pointer;
            }

            .ap-unit input[type="radio"] {
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }

            .ap-unit-inner {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 14px 8px;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                background: #f8fafc;
                transition: all 0.15s ease;
                text-align: center;
                gap: 4px;
            }

            .ap-unit-inner .u-ico {
                font-size: 22px;
                line-height: 1;
            }

            .ap-unit-inner .u-name {
                font-weight: 700;
                font-size: 12px;
                color: #334155;
            }

            .ap-unit-inner small {
                font-size: 10px;
                color: #94a3b8;
            }

            .ap-unit .u-check {
                position: absolute;
                top: 6px;
                right: 6px;
                width: 18px;
                height: 18px;
                border-radius: 50%;
                background: #6366f1;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 11px;
                opacity: 0;
                transform: scale(0.5);
                transition: all 0.15s ease;
            }

            .ap-unit.active .ap-unit-inner {
                border-color: #6366f1;
                background: #eef2ff;
            }

            .ap-unit.active .u-check {
                opacity: 1;
                transform: scale(1);
            }

            .ap-unit:hover .ap-unit-inner {
                border-color: #cbd5e1;
            }

            /* ── Price Input ── */
            .ap-price-wrap {
                display: flex;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                overflow: hidden;
                background: #f8fafc;
                transition: all 0.15s ease;
            }

            .ap-price-wrap:focus-within {
                border-color: #a5b4fc;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .ap-price-symbol {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0 14px;
                background: #f1f5f9;
                border-right: 1px solid #e2e8f0;
                font-size: 16px;
                font-weight: 700;
                color: #059669;
            }

            .ap-price-input {
                flex: 1;
                border: none;
                outline: none;
                padding: 10px 14px;
                font-size: 15px;
                font-weight: 700;
                color: #1e293b;
                background: transparent;
                font-family: inherit;
                -moz-appearance: textfield;
            }

            .ap-price-input::placeholder {
                color: #cbd5e1;
                font-weight: 400;
            }

            .ap-price-input::-webkit-outer-spin-button,
            .ap-price-input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* ── Description Textarea ── */
            .ap-textarea {
                padding: 10px 14px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 13px;
                color: #1e293b;
                background: #f8fafc;
                transition: all 0.15s ease;
                width: 100%;
                outline: none;
                font-family: inherit;
                resize: vertical;
                min-height: 80px;
            }

            .ap-textarea:focus {
                border-color: #a5b4fc;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .ap-textarea::placeholder {
                color: #b8bdd0;
            }

            /* ── Tags Input ── */
            .ap-tags-wrap {
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                background: #f8fafc;
                padding: 6px 10px;
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                align-items: center;
                min-height: 42px;
                transition: all 0.15s ease;
                cursor: text;
            }

            .ap-tags-wrap:focus-within {
                border-color: #a5b4fc;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .ap-tag {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 3px 8px;
                background: #eef2ff;
                color: #4f46e5;
                border-radius: 5px;
                font-size: 12px;
                font-weight: 600;
            }

            .ap-tag .remove-tag {
                cursor: pointer;
                font-size: 14px;
                opacity: 0.6;
                transition: opacity 0.15s;
                line-height: 1;
            }

            .ap-tag .remove-tag:hover {
                opacity: 1;
            }

            .ap-tags-input {
                border: none;
                outline: none;
                background: transparent;
                font-size: 13px;
                font-family: inherit;
                color: #1e293b;
                flex: 1;
                min-width: 100px;
                padding: 3px 0;
            }

            .ap-tags-input::placeholder {
                color: #b8bdd0;
            }

            /* ── Quick Stats ── */
            .ap-quick-stats {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                margin-bottom: 16px;
            }

            .ap-quick-stat {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                padding: 14px;
                text-align: center;
                transition: all 0.15s ease;
            }

            .ap-quick-stat .qs-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                margin: 0 auto 8px;
            }

            .ap-quick-stat .qs-icon.purple {
                background: #eef2ff;
                color: #6366f1;
            }

            .ap-quick-stat .qs-icon.green {
                background: #ecfdf5;
                color: #059669;
            }

            .ap-quick-stat .qs-icon.amber {
                background: #fffbeb;
                color: #d97706;
            }

            .ap-quick-stat .qs-val {
                font-size: 18px;
                font-weight: 800;
                color: #1e293b;
                line-height: 1;
                margin-bottom: 4px;
            }

            .ap-quick-stat .qs-label {
                font-size: 11px;
                font-weight: 600;
                color: #94a3b8;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            /* ── Review Section ── */
            .ap-review {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                padding: 18px;
            }

            .ap-review-head {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 14px;
                padding-bottom: 14px;
                border-bottom: 1px solid #e2e8f0;
            }

            .ap-review-ico {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                background: #eef2ff;
                color: #6366f1;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                flex-shrink: 0;
            }

            .ap-review-name {
                font-size: 16px;
                font-weight: 700;
                color: #1e293b;
                margin-bottom: 4px;
            }

            .ap-review-tags {
                display: flex;
                gap: 6px;
                flex-wrap: wrap;
            }

            .ap-review-tag {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 2px 10px;
                border-radius: 6px;
                font-size: 11px;
                font-weight: 600;
            }

            .ap-review-tag.purple {
                background: #eef2ff;
                color: #6366f1;
            }

            .ap-review-tag.blue {
                background: #eff6ff;
                color: #2563eb;
            }

            .ap-review-details {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }

            .ap-review-item {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .ap-review-item .ri-icon {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                flex-shrink: 0;
            }

            .ap-review-item .ri-icon.purple {
                background: #eef2ff;
                color: #6366f1;
            }

            .ap-review-item .ri-icon.green {
                background: #ecfdf5;
                color: #059669;
            }

            .ap-review-item .ri-icon.amber {
                background: #fffbeb;
                color: #d97706;
            }

            .ap-review-item small {
                font-size: 11px;
                color: #94a3b8;
                display: block;
            }

            .ap-review-item .ri-val {
                font-size: 14px;
                font-weight: 700;
                color: #1e293b;
            }

            .ap-review-desc {
                margin-top: 14px;
                padding-top: 14px;
                border-top: 1px solid #e2e8f0;
            }

            .ap-review-desc small {
                font-size: 11px;
                color: #94a3b8;
                display: block;
                margin-bottom: 4px;
            }

            .ap-review-desc p {
                font-size: 13px;
                color: #64748b;
                margin: 0;
                line-height: 1.5;
            }

            .ap-review-desc .tags-display {
                display: flex;
                gap: 5px;
                flex-wrap: wrap;
                margin-top: 4px;
            }

            .ap-review-desc .tag-pill {
                padding: 2px 8px;
                background: #eef2ff;
                color: #4f46e5;
                border-radius: 4px;
                font-size: 11px;
                font-weight: 600;
            }

            /* ── Divider ── */
            .ap-divider {
                display: flex;
                align-items: center;
                gap: 12px;
                margin: 18px 0 14px;
            }

            .ap-divider::before,
            .ap-divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #e2e8f0;
            }

            .ap-divider span {
                font-size: 11px;
                font-weight: 700;
                color: #94a3b8;
                text-transform: uppercase;
                letter-spacing: 1px;
                white-space: nowrap;
            }

            /* ── Footer Actions ── */
            .ap-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                padding: 16px 20px;
                border-top: 1px solid #f1f5f9;
                flex-wrap: wrap;
            }

            .ap-footer-left {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 12px;
                color: #94a3b8;
            }

            .ap-footer-left i {
                font-size: 14px;
            }

            .ap-footer-right {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .ap-btn-reset {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 9px 18px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                border: 1px solid #e2e8f0;
                background: #fff;
                color: #64748b;
                cursor: pointer;
                transition: all 0.15s ease;
                font-family: inherit;
            }

            .ap-btn-reset:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
            }

            .ap-btn-draft {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 9px 18px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                border: 1px solid #e2e8f0;
                background: #fff;
                color: #d97706;
                cursor: pointer;
                transition: all 0.15s ease;
                font-family: inherit;
            }

            .ap-btn-draft:hover {
                background: #fffbeb;
                border-color: #fde68a;
            }

            .ap-btn-save {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 9px 24px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 700;
                border: none;
                background: #6366f1;
                color: #fff;
                cursor: pointer;
                transition: all 0.15s ease;
                font-family: inherit;
            }

            .ap-btn-save:hover {
                background: #4f46e5;
            }

            .ap-btn-save i {
                font-size: 16px;
            }

            .ap-btn-save .spinner {
                display: none;
                width: 16px;
                height: 16px;
                border: 2px solid rgba(255, 255, 255, 0.25);
                border-top-color: #fff;
                border-radius: 50%;
                animation: apSpin 0.6s linear infinite;
            }

            .ap-btn-save.loading .spinner {
                display: inline-block;
            }

            .ap-btn-save.loading .btn-text {
                display: none;
            }

            .ap-btn-save.loading .load-text {
                display: inline;
            }

            .ap-btn-save .load-text {
                display: none;
            }

            @keyframes apSpin {
                to {
                    transform: rotate(360deg);
                }
            }

            /* ── Responsive ── */
            @media (max-width: 768px) {
                .ap-topbar {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .ap-topbar-title {
                    margin-right: 0;
                }

                .ap-quick-stats {
                    grid-template-columns: repeat(3, 1fr);
                }

                .ap-review-details {
                    grid-template-columns: 1fr;
                }

                .ap-footer {
                    flex-direction: column;
                    align-items: stretch;
                }

                .ap-footer-right {
                    justify-content: stretch;
                }

                .ap-btn-save,
                .ap-btn-reset,
                .ap-btn-draft {
                    flex: 1;
                    justify-content: center;
                }
            }

            @media (max-width: 480px) {
                .ap-wrap {
                    padding: 0 8px;
                }

                .ap-quick-stats {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div class="ap-wrap">

            <!-- ── Top Bar ── -->
            <div class="ap-topbar">
                <div class="ap-topbar-title">
                    <i class="bx bx-package"></i> Add New Product
                </div>
                <a href="<?= site_url('admin/product') ?>" class="ap-top-btn">
                    <i class="bx bx-arrow-back"></i> Back to Products
                </a>
            </div>

            <!-- ── Flash Messages ── -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="ap-alert success">
                    <i class="bx bx-check-circle"></i>
                    <span><?= $this->session->flashdata('success') ?></span>
                    <button class="close-alert" onclick="this.parentElement.remove()"><i class="bx bx-x"></i></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="ap-alert error">
                    <i class="bx bx-error-circle"></i>
                    <span><?= $this->session->flashdata('error') ?></span>
                    <button class="close-alert" onclick="this.parentElement.remove()"><i class="bx bx-x"></i></button>
                </div>
            <?php endif; ?>

            <!-- ── Progress ── -->
            <!-- <div class="ap-progress">
                <div class="ap-progress-top">
                    <span class="ap-progress-label">Form Completion</span>
                    <span class="ap-progress-pct" id="progressPct">0%</span>
                </div>
                <div class="ap-progress-bar">
                    <div class="ap-progress-fill" id="progressFill"></div>
                </div>
                <div class="ap-progress-steps">
                    <div class="ap-progress-step" id="stepBasic"><i class="bx bx-circle"></i> Basic Info</div>
                    <div class="ap-progress-step" id="stepPricing"><i class="bx bx-circle"></i> Pricing</div>
                    <div class="ap-progress-step" id="stepExtra"><i class="bx bx-circle"></i> Extra Details</div>
                </div>
            </div> -->

            <!-- ── Form ── -->
            <form method="post" action="<?= site_url('admin/product/save') ?>" id="productForm" novalidate>

                <!-- ═══ Basic Info ═══ -->
                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="h-icon purple"><i class="bx bx-package"></i></div>
                        <div>
                            <h3>Basic Information</h3>
                            <p>Product name, category and brand</p>
                        </div>
                        <div class="head-right">
                            <span class="ap-section-badge" id="badgeBasic"><i class="bx bx-circle"></i> Pending</span>
                        </div>
                    </div>
                    <div class="ap-card-body">

                        <div class="ap-field" data-track="basic">
                            <label>
                                <i class="bx bx-purchase-tag-alt li"></i> Product Name <span class="req"></span>
                            </label>
                            <div class="iw">
                                <i class="bx bx-text fi"></i>
                                <input type="text" name="name" id="productName" class="fc has-right"
                                    placeholder="e.g. Samsung Galaxy S24 Ultra" required maxlength="150"
                                    autocomplete="off">
                                <i class="bx bx-check-circle status-icon valid-ico"></i>
                                <i class="bx bx-error-circle status-icon invalid-ico"></i>
                            </div>
                            <div class="inv-msg"><i class="bx bx-error-circle"></i> Please enter product name.</div>
                            <div class="ap-field-footer">
                                <span class="hint"><i class="bx bx-info-circle"></i> Enter a unique, descriptive
                                    name</span>
                                <span class="char-count"><span id="nameCharCount">0</span>/150</span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="ap-field" data-track="basic">
                                    <label>
                                        <i class="bx bx-category li"></i> Category <span class="req"></span>
                                    </label>
                                    <div class="iw">
                                        <i class="bx bx-folder fi"></i>
                                        <select name="category_id" id="categorySelect" class="fs" required>
                                            <option value="">-- Select Category --</option>
                                            <?php foreach ($categories as $cat) { ?>
                                                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="inv-msg"><i class="bx bx-error-circle"></i> Please select a category.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ap-field" data-track="basic">
                                    <label>
                                        <i class="bx bx-store li"></i> Brand <span class="opt">Optional</span>
                                    </label>
                                    <div class="iw">
                                        <i class="bx bx-diamond fi"></i>
                                        <input type="text" name="brand" id="productBrand" class="fc"
                                            placeholder="e.g. Samsung, Apple" maxlength="100">
                                    </div>
                                    <div class="hint"><i class="bx bx-info-circle"></i> Manufacturer or brand name</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ═══ Pricing & Stock ═══ -->
                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="h-icon green"><i class="bx bx-dollar-circle"></i></div>
                        <div>
                            <h3>Pricing & Stock</h3>
                            <p>Unit type, quantity and purchase price</p>
                        </div>
                        <div class="head-right">
                            <span class="ap-section-badge" id="badgePricing"><i class="bx bx-circle"></i> Pending</span>
                        </div>
                    </div>
                    <div class="ap-card-body">

                        <div class="ap-field" data-track="pricing">
                            <label><i class="bx bx-cube li"></i> Unit Type</label>
                            <div class="ap-units">
                                <label class="ap-unit active">
                                    <input type="radio" name="unit" value="pcs" checked>
                                    <div class="ap-unit-inner">
                                        <div class="u-ico">📦</div>
                                        <span class="u-name">PCS</span>
                                        <small>Pieces</small>
                                    </div>
                                    <div class="u-check"><i class="bx bx-check"></i></div>
                                </label>
                                <label class="ap-unit">
                                    <input type="radio" name="unit" value="box">
                                    <div class="ap-unit-inner">
                                        <div class="u-ico">📋</div>
                                        <span class="u-name">BOX</span>
                                        <small>Boxes</small>
                                    </div>
                                    <div class="u-check"><i class="bx bx-check"></i></div>
                                </label>
                                <label class="ap-unit">
                                    <input type="radio" name="unit" value="liter">
                                    <div class="ap-unit-inner">
                                        <div class="u-ico">🧴</div>
                                        <span class="u-name">LITER</span>
                                        <small>Liters</small>
                                    </div>
                                    <div class="u-check"><i class="bx bx-check"></i></div>
                                </label>
                                <label class="ap-unit">
                                    <input type="radio" name="unit" value="kg">
                                    <div class="ap-unit-inner">
                                        <div class="u-ico">⚖️</div>
                                        <span class="u-name">KG</span>
                                        <small>Kilograms</small>
                                    </div>
                                    <div class="u-check"><i class="bx bx-check"></i></div>
                                </label>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="ap-field" data-track="pricing">
                                    <label><i class="bx bx-hash li"></i> Quantity <span class="req"></span></label>
                                    <div class="iw">
                                        <i class="bx bx-layer fi"></i>
                                        <input type="number" name="quantity" id="productQty" class="fc"
                                            placeholder="Enter quantity" min="0" required>
                                    </div>
                                    <div class="inv-msg"><i class="bx bx-error-circle"></i> Please enter quantity.</div>
                                    <div class="hint"><i class="bx bx-info-circle"></i> Number of units in stock</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ap-field" data-track="pricing">
                                    <label><i class="bx bx-dollar-circle li"></i> Purchase Price <span
                                            class="req"></span></label>
                                    <div class="ap-price-wrap">
                                        <div class="ap-price-symbol"><span>₹</span></div>
                                        <input type="number" name="purchase_price" id="purchasePrice"
                                            class="ap-price-input" placeholder="0.00" min="0" step="0.01" required>
                                    </div>
                                    <div class="inv-msg"><i class="bx bx-error-circle"></i> Please enter purchase price.
                                    </div>
                                    <div class="hint"><i class="bx bx-info-circle"></i> Cost price from supplier</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ap-field" data-track="pricing">
                                    <label><i class="bx bx-wallet li"></i> Sell Price <span
                                            class="opt">Optional</span></label>
                                    <div class="ap-price-wrap">
                                        <div class="ap-price-symbol"><span>₹</span></div>
                                        <input type="number" name="sell_price" id="sellPrice" class="ap-price-input"
                                            placeholder="0.00" min="0" step="0.01">
                                    </div>
                                    <div class="hint"><i class="bx bx-info-circle"></i> Selling price shown in orders
                                        and product list</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="ap-quick-stats" style="margin-top: 16px;">
                            <div class="ap-quick-stat">
                                <div class="qs-icon purple"><i class="bx bx-cube"></i></div>
                                <div class="qs-val" id="qsUnit">PCS</div>
                                <div class="qs-label">Unit</div>
                            </div>
                            <div class="ap-quick-stat">
                                <div class="qs-icon amber"><i class="bx bx-layer"></i></div>
                                <div class="qs-val" id="qsQty">0</div>
                                <div class="qs-label">Quantity</div>
                            </div>
                            <div class="ap-quick-stat">
                                <div class="qs-icon green"><i class="bx bx-rupee"></i></div>
                                <div class="qs-val" id="qsTotal">₹0</div>
                                <div class="qs-label">Total Value</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ═══ Additional Details ═══ -->
                <div class="ap-card">
                    <!-- <div class="ap-card-head">
                        <div class="h-icon amber"><i class="bx bx-detail"></i></div>
                        <div>
                            <h3>Additional Details</h3>
                            <p>Description and tags (optional)</p>
                        </div>
                        <div class="head-right">
                            <span class="ap-section-badge" id="badgeExtra"><i class="bx bx-circle"></i> Optional</span>
                        </div>
                    </div> -->
                    <!-- <div class="ap-card-body">

                        <div class="ap-field" data-track="extra">
                            <label><i class="bx bx-note li"></i> Description <span class="opt">Optional</span></label>
                            <textarea name="description" id="productDesc" class="ap-textarea" placeholder="Enter product description, features, specifications..." maxlength="500"></textarea>
                            <div class="ap-field-footer">
                                <span class="hint"><i class="bx bx-info-circle"></i> Brief product description</span>
                                <span class="char-count"><span id="descCharCount">0</span>/500</span>
                            </div>
                        </div>

                        <div class="ap-field" data-track="extra">
                            <label><i class="bx bx-purchase-tag li"></i> Tags <span class="opt">Optional</span></label>
                            <div class="ap-tags-wrap" id="tagsWrap">
                                <input type="text" class="ap-tags-input" id="tagInput" placeholder="Type and press Enter to add tags">
                            </div>
                            <input type="hidden" name="tags" id="tagsHidden">
                            <div class="hint"><i class="bx bx-info-circle"></i> Press Enter or comma to add tags</div>
                        </div>

                    </div> -->
                </div>

                <!-- ═══ Review & Save ═══ -->
                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="h-icon purple"><i class="bx bx-check-shield"></i></div>
                        <div>
                            <h3>Review & Save</h3>
                            <p>Verify details before saving</p>
                        </div>
                    </div>
                    <div class="ap-card-body">

                        <div class="ap-review">
                            <div class="ap-review-head">
                                <div class="ap-review-ico"><i class="bx bx-package"></i></div>
                                <div>
                                    <div class="ap-review-name" id="reviewName">Product Name</div>
                                    <div class="ap-review-tags">
                                        <span class="ap-review-tag purple" id="reviewCategory"><i
                                                class="bx bx-category"></i> Category</span>
                                        <span class="ap-review-tag blue" id="reviewBrand"><i class="bx bx-store"></i>
                                            Brand</span>
                                    </div>
                                </div>
                            </div>

                            <div class="ap-review-details">
                                <div class="ap-review-item">
                                    <div class="ri-icon purple"><i class="bx bx-cube"></i></div>
                                    <div>
                                        <small>Unit Type</small>
                                        <div class="ri-val" id="reviewUnit">PCS</div>
                                    </div>
                                </div>
                                <div class="ap-review-item">
                                    <div class="ri-icon amber"><i class="bx bx-layer"></i></div>
                                    <div>
                                        <small>Quantity</small>
                                        <div class="ri-val" id="reviewQty">0</div>
                                    </div>
                                </div>
                                <div class="ap-review-item">
                                    <div class="ri-icon green"><i class="bx bx-dollar-circle"></i></div>
                                    <div>
                                        <small>Purchase Price</small>
                                        <div class="ri-val" id="reviewPrice">₹0.00</div>
                                    </div>
                                </div>
                                <div class="ap-review-item">
                                    <div class="ri-icon blue"><i class="bx bx-wallet"></i></div>
                                    <div>
                                        <small>Sell Price</small>
                                        <div class="ri-val" id="reviewSellPrice">₹0.00</div>
                                    </div>
                                </div>
                            </div>

                            <div class="ap-review-desc" id="reviewDescSection" style="display: none;">
                                <small>Description</small>
                                <p id="reviewDesc"></p>
                            </div>

                            <div class="ap-review-desc" id="reviewTagsSection" style="display: none;">
                                <small>Tags</small>
                                <div class="tags-display" id="reviewTagsDisplay"></div>
                            </div>
                        </div>

                    </div>

                    <div class="ap-footer">
                        <div class="ap-footer-left">
                            <i class="bx bx-info-circle"></i> All required fields must be filled
                        </div>
                        <div class="ap-footer-right">
                            <button type="reset" class="ap-btn-reset" id="resetBtn">
                                <i class="bx bx-reset"></i> Reset
                            </button>
                            <button type="submit" class="ap-btn-save" id="saveBtn">
                                <span class="spinner"></span>
                                <span class="btn-text"><i class="bx bx-check-double"></i> Save Product</span>
                                <span class="load-text">Saving...</span>
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {

                let tags = [];

                // ── Character Counts ──
                $('#productName').on('input', function () {
                    let len = $(this).val().length;
                    $('#nameCharCount').text(len);
                    let $cc = $(this).closest('.ap-field').find('.char-count');
                    $cc.toggleClass('warn', len > 120 && len <= 140).toggleClass('danger', len > 140);
                    updateAll();
                });

                $('#productDesc').on('input', function () {
                    let len = $(this).val().length;
                    $('#descCharCount').text(len);
                    let $cc = $(this).closest('.ap-field').find('.char-count');
                    $cc.toggleClass('warn', len > 400 && len <= 470).toggleClass('danger', len > 470);
                    updateAll();
                });

                // ── Unit Cards ──
                $('.ap-unit input[type="radio"]').change(function () {
                    $('.ap-unit').removeClass('active');
                    $(this).closest('.ap-unit').addClass('active');
                    updateAll();
                });

                // ── Tags ──
                $('#tagInput').on('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ',') {
                        e.preventDefault();
                        let val = $.trim($(this).val().replace(/,/g, ''));
                        if (val && tags.indexOf(val) === -1 && tags.length < 10) {
                            tags.push(val);
                            renderTags();
                            updateAll();
                        }
                        $(this).val('');
                    }
                });

                $('#tagsWrap').on('click', function () {
                    $('#tagInput').focus();
                });

                $(document).on('click', '.remove-tag', function () {
                    let idx = $(this).data('idx');
                    tags.splice(idx, 1);
                    renderTags();
                    updateAll();
                });

                function renderTags() {
                    $('#tagsWrap .ap-tag').remove();
                    tags.forEach(function (tag, idx) {
                        $('<span class="ap-tag">' + tag + ' <span class="remove-tag" data-idx="' + idx + '"><i class="bx bx-x"></i></span></span>').insertBefore('#tagInput');
                    });
                    $('#tagsHidden').val(tags.join(','));
                }

                // ── Live Updates ──
                $('#categorySelect, #productBrand, #purchasePrice, #sellPrice, #productQty').on('input change', updateAll);

                function updateAll() {
                    updateReview();
                    updateQuickStats();
                    updateProgress();
                    updateSectionBadges();
                }

                function updateReview() {
                    let name = $('#productName').val() || 'Product Name';
                    let cat = $('#categorySelect option:selected').text().trim();
                    let brand = $('#productBrand').val() || 'Brand';
                    let unit = $('input[name="unit"]:checked').val().toUpperCase();
                    let price = parseFloat($('#purchasePrice').val()) || 0;
                    let sellPrice = parseFloat($('#sellPrice').val()) || 0;
                    let qty = $('#productQty').val() || '0';
                    let desc = $('#productDesc').val();

                    if (cat === '-- Select Category --') cat = 'Category';

                    $('#reviewName').text(name);
                    $('#reviewCategory').html('<i class="bx bx-category"></i> ' + cat);
                    $('#reviewBrand').html('<i class="bx bx-store"></i> ' + brand);
                    $('#reviewUnit').text(unit);
                    $('#reviewPrice').text('₹' + price.toFixed(2));
                    $('#reviewSellPrice').text('₹' + sellPrice.toFixed(2));
                    $('#reviewQty').text(qty);

                    if (desc) {
                        $('#reviewDescSection').show();
                        $('#reviewDesc').text(desc);
                    } else {
                        $('#reviewDescSection').hide();
                    }

                    if (tags.length > 0) {
                        $('#reviewTagsSection').show();
                        let html = '';
                        tags.forEach(function (t) { html += '<span class="tag-pill">' + t + '</span>'; });
                        $('#reviewTagsDisplay').html(html);
                    } else {
                        $('#reviewTagsSection').hide();
                    }
                }

                function updateQuickStats() {
                    let unit = $('input[name="unit"]:checked').val().toUpperCase();
                    let qty = parseInt($('#productQty').val()) || 0;
                    let price = parseFloat($('#sellPrice').val()) || parseFloat($('#purchasePrice').val()) || 0;
                    let total = qty * price;

                    $('#qsUnit').text(unit);
                    $('#qsQty').text(qty);
                    $('#qsTotal').text('₹' + (total >= 1000 ? (total / 1000).toFixed(1) + 'k' : total.toFixed(0)));
                }

                function updateProgress() {
                    let filled = 0;
                    let total = 4; // name, category, qty, purchase price

                    if ($('#productName').val().trim()) filled++;
                    if ($('#categorySelect').val()) filled++;
                    if ($('#productQty').val()) filled++;
                    if ($('#purchasePrice').val()) filled++;

                    // Bonus for optional
                    let bonus = 0;
                    let bonusTotal = 3;
                    if ($('#productBrand').val().trim()) bonus++;
                    if ($('#productDesc').val().trim()) bonus++;
                    if (tags.length > 0) bonus++;

                    let pct = Math.round(((filled / total) * 80) + ((bonus / bonusTotal) * 20));
                    pct = Math.min(pct, 100);

                    $('#progressFill').css('width', pct + '%');
                    $('#progressPct').text(pct + '%');
                }

                function updateSectionBadges() {
                    // Basic
                    let basicDone = $('#productName').val().trim() && $('#categorySelect').val();
                    let $bb = $('#badgeBasic');
                    if (basicDone) {
                        $bb.addClass('filled').html('<i class="bx bx-check-circle"></i> Complete');
                        $('#stepBasic').removeClass('active').addClass('done').find('i').attr('class', 'bx bx-check-circle');
                    } else {
                        $bb.removeClass('filled').html('<i class="bx bx-circle"></i> Pending');
                        let hasInput = $('#productName').val().trim() || $('#categorySelect').val();
                        $('#stepBasic').removeClass('done').toggleClass('active', !!hasInput).find('i').attr('class', hasInput ? 'bx bx-radio-circle-marked' : 'bx bx-circle');
                    }

                    // Pricing
                    let pricingDone = $('#productQty').val() && $('#purchasePrice').val();
                    let $bp = $('#badgePricing');
                    if (pricingDone) {
                        $bp.addClass('filled').html('<i class="bx bx-check-circle"></i> Complete');
                        $('#stepPricing').removeClass('active').addClass('done').find('i').attr('class', 'bx bx-check-circle');
                    } else {
                        $bp.removeClass('filled').html('<i class="bx bx-circle"></i> Pending');
                        let hasInput = $('#productQty').val() || $('#purchasePrice').val() || $('#sellPrice').val();
                        $('#stepPricing').removeClass('done').toggleClass('active', !!hasInput).find('i').attr('class', hasInput ? 'bx bx-radio-circle-marked' : 'bx bx-circle');
                    }

                    // Extra
                    let extraHas = $('#productDesc').val().trim() || tags.length > 0;
                    let $be = $('#badgeExtra');
                    if (extraHas) {
                        $be.addClass('filled').html('<i class="bx bx-check-circle"></i> Added');
                        $('#stepExtra').removeClass('active').addClass('done').find('i').attr('class', 'bx bx-check-circle');
                    } else {
                        $be.removeClass('filled').html('<i class="bx bx-circle"></i> Optional');
                        $('#stepExtra').removeClass('done active').find('i').attr('class', 'bx bx-circle');
                    }
                }

                // ── Validation ──
                $('#productForm').on('submit', function (e) {
                    let form = this;
                    let isValid = true;

                    $(form).find('.ap-field').removeClass('is-invalid is-valid');

                    $(form).find('[required]').each(function () {
                        let $f = $(this);
                        let $af = $f.closest('.ap-field');
                        let val = $.trim($f.val());

                        if (!val || !this.checkValidity()) {
                            $af.addClass('is-invalid');
                            isValid = false;
                        } else {
                            $af.addClass('is-valid');
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        let $first = $(form).find('.ap-field.is-invalid').first();
                        if ($first.length) {
                            $('html, body').animate({ scrollTop: $first.offset().top - 100 }, 400);
                            $first.find('input, select, textarea').first().focus();
                        }
                        return false;
                    }

                    $('#saveBtn').addClass('loading').prop('disabled', true);
                });

                // ── Real-time Validation ──
                $(document).on('input change', '.ap-field .fc, .ap-field .fs, .ap-field .ap-price-input', function () {
                    let $f = $(this);
                    let $af = $f.closest('.ap-field');

                    if ($f.prop('required')) {
                        if ($.trim($f.val()) && this.checkValidity()) {
                            $af.removeClass('is-invalid').addClass('is-valid');
                        }
                    } else {
                        $af.removeClass('is-invalid');
                    }
                });

                // ── Reset ──
                $('#resetBtn').on('click', function () {
                    setTimeout(function () {
                        $('.ap-field').removeClass('is-invalid is-valid');
                        $('.ap-unit').removeClass('active');
                        $('.ap-unit').first().addClass('active');
                        $('#nameCharCount').text('0');
                        $('#descCharCount').text('0');
                        tags = [];
                        renderTags();
                        updateAll();
                    }, 50);
                });

                // ── Init ──
                updateAll();
            });
        </script>

    </div>
</div>