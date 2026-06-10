<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

            :root {
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --primary-deeper: #4338ca;
                --primary-light: #eef2ff;
                --primary-50: rgba(99, 102, 241, 0.05);
                --primary-100: rgba(99, 102, 241, 0.1);
                --primary-200: rgba(99, 102, 241, 0.2);
                --success: #10b981;
                --success-dark: #059669;
                --success-light: #ecfdf5;
                --danger: #ef4444;
                --danger-dark: #dc2626;
                --danger-light: #fef2f2;
                --warning: #f59e0b;
                --warning-dark: #d97706;
                --warning-light: #fffbeb;
                --info: #3b82f6;
                --info-light: #eff6ff;
                --violet: #8b5cf6;
                --teal: #14b8a6;
                --teal-dark: #0d9488;
                --orange: #f97316;
                --slate-25: #fcfcfd;
                --slate-50: #f8fafc;
                --slate-100: #f1f5f9;
                --slate-200: #e2e8f0;
                --slate-300: #cbd5e1;
                --slate-400: #94a3b8;
                --slate-500: #64748b;
                --slate-600: #475569;
                --slate-700: #334155;
                --slate-800: #1e293b;
                --slate-900: #0f172a;
                --slate-950: #020617;
                --radius-xs: 8px;
                --radius-sm: 12px;
                --radius: 16px;
                --radius-md: 20px;
                --radius-lg: 24px;
                --radius-xl: 32px;
                --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.04);
                --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.03);
                --shadow: 0 4px 16px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.03);
                --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.07), 0 2px 8px rgba(0, 0, 0, 0.03);
                --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.08), 0 4px 16px rgba(0, 0, 0, 0.03);
                --shadow-primary: 0 8px 40px rgba(99, 102, 241, 0.2);
                --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-fast: all 0.18s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-spring: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            .amc-form-container {
                max-width: 1120px;
                margin: 0 auto;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                -webkit-font-smoothing: antialiased;
                color: var(--slate-800);
            }

            /* ═══════════════════════════════════════════
               BANNER
            ═══════════════════════════════════════════ */
            .form-banner {
                background: linear-gradient(135deg, #312e81 0%, #4338ca 25%, #6366f1 60%, #818cf8 100%);
                border-radius: var(--radius-xl);
                padding: 44px 48px;
                color: #fff;
                margin-bottom: 28px;
                position: relative;
                overflow: hidden;
                box-shadow: var(--shadow-primary), inset 0 1px 0 rgba(255, 255, 255, 0.1);
                animation: fadeInUp 0.5s ease-out;
            }

            .form-banner::before {
                content: '';
                position: absolute;
                top: -60%;
                right: -15%;
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.07) 0%, transparent 55%);
                border-radius: 50%;
                animation: bannerOrb 15s ease-in-out infinite;
                pointer-events: none;
            }

            .form-banner::after {
                content: '';
                position: absolute;
                bottom: -50%;
                left: -8%;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.04) 0%, transparent 55%);
                border-radius: 50%;
                animation: bannerOrb 18s ease-in-out infinite reverse;
                pointer-events: none;
            }

            .form-banner .banner-grid-pattern {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
                background-size: 40px 40px;
                pointer-events: none;
            }

            @keyframes bannerOrb {

                0%,
                100% {
                    transform: translate(0, 0) scale(1);
                }

                33% {
                    transform: translate(15px, -20px) scale(1.02);
                }

                66% {
                    transform: translate(-10px, 10px) scale(0.98);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(16px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .banner-inner {
                position: relative;
                z-index: 2;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 28px;
                flex-wrap: wrap;
            }

            .banner-text h1 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.85rem;
                font-weight: 800;
                margin: 0 0 8px;
                letter-spacing: -0.7px;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .banner-text p {
                font-size: 0.92rem;
                opacity: 0.85;
                margin: 0;
                max-width: 520px;
                font-weight: 400;
                line-height: 1.7;
            }

            .btn-back {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: rgba(255, 255, 255, 0.12);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.16);
                color: #fff;
                padding: 12px 24px;
                border-radius: var(--radius-sm);
                font-size: 0.84rem;
                font-weight: 700;
                text-decoration: none;
                transition: var(--transition);
                letter-spacing: -0.1px;
                flex-shrink: 0;
            }

            .btn-back:hover {
                background: rgba(255, 255, 255, 0.22);
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
                color: #fff;
                text-decoration: none;
            }

            .btn-back i {
                font-size: 18px;
            }

            /* ═══════════════════════════════════════════
               STEPS
            ═══════════════════════════════════════════ */
            .steps-row {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 16px;
                margin-bottom: 28px;
                animation: fadeInUp 0.5s ease-out 0.08s backwards;
            }

            .step-card {
                background: #fff;
                border-radius: var(--radius-md);
                border: 1px solid rgba(226, 232, 240, 0.8);
                padding: 24px 24px 20px;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .step-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                opacity: 0;
                transition: opacity 0.35s, transform 0.35s;
                transform: scaleX(0);
            }

            .step-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-md);
                border-color: transparent;
            }

            .step-card:hover::before {
                opacity: 1;
                transform: scaleX(1);
            }

            .step-card:nth-child(1)::before {
                background: linear-gradient(90deg, #6366f1, #818cf8, #a5b4fc);
            }

            .step-card:nth-child(2)::before {
                background: linear-gradient(90deg, #14b8a6, #2dd4bf, #5eead4);
            }

            .step-card:nth-child(3)::before {
                background: linear-gradient(90deg, #10b981, #34d399, #6ee7b7);
            }

            .step-num {
                width: 44px;
                height: 44px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                font-size: 18px;
                font-weight: 800;
                margin-bottom: 16px;
                flex-shrink: 0;
                transition: var(--transition-spring);
            }

            .step-card:hover .step-num {
                transform: scale(1.1) rotate(-5deg);
            }

            .step-card:nth-child(1) .step-num {
                background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                color: #6366f1;
            }

            .step-card:nth-child(2) .step-num {
                background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
                color: #14b8a6;
            }

            .step-card:nth-child(3) .step-num {
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                color: #059669;
            }

            .step-card h6 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.92rem;
                font-weight: 800;
                color: var(--slate-900);
                margin: 0 0 6px;
                letter-spacing: -0.2px;
            }

            .step-card p {
                margin: 0;
                color: var(--slate-500);
                font-size: 0.78rem;
                line-height: 1.6;
            }

            /* ═══════════════════════════════════════════
               MAIN FORM CARD
            ═══════════════════════════════════════════ */
            .form-card {
                background: #fff;
                border-radius: var(--radius-md);
                border: 1px solid rgba(226, 232, 240, 0.8);
                overflow: hidden;
                transition: var(--transition);
                animation: fadeInUp 0.5s ease-out 0.16s backwards;
            }

            .form-card:hover {
                box-shadow: var(--shadow-md);
                border-color: var(--slate-300);
            }

            .form-card-head {
                padding: 26px 32px 20px;
                border-bottom: 1px solid var(--slate-100);
                background: linear-gradient(180deg, var(--slate-25), #fff);
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .form-card-head-icon {
                width: 46px;
                height: 46px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                font-size: 22px;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: #fff;
                box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
                flex-shrink: 0;
            }

            .form-card-head-text h3 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.12rem;
                font-weight: 800;
                color: var(--slate-900);
                margin: 0;
                letter-spacing: -0.3px;
            }

            .form-card-head-text p {
                font-size: 0.82rem;
                color: var(--slate-400);
                margin: 3px 0 0;
                font-weight: 500;
            }

            /* ── Alert / Tip ── */
            .form-tip {
                margin: 20px 32px 0;
                padding: 16px 20px;
                border-radius: var(--radius-sm);
                display: flex;
                align-items: flex-start;
                gap: 12px;
                font-size: 0.82rem;
                font-weight: 600;
                line-height: 1.6;
                animation: fadeInUp 0.4s ease-out 0.3s backwards;
            }

            .form-tip.tip-info {
                background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                color: #4338ca;
                border: 1px solid rgba(99, 102, 241, 0.12);
            }

            .form-tip.tip-error {
                background: linear-gradient(135deg, #fef2f2, #fee2e2);
                color: #991b1b;
                border: 1px solid rgba(220, 38, 38, 0.12);
            }

            .form-tip-icon {
                width: 32px;
                height: 32px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                font-size: 17px;
                flex-shrink: 0;
            }

            .tip-info .form-tip-icon {
                background: rgba(99, 102, 241, 0.12);
                color: #6366f1;
            }

            .tip-error .form-tip-icon {
                background: rgba(220, 38, 38, 0.12);
                color: #dc2626;
            }

            /* ═══════════════════════════════════════════
               FORM SECTIONS
            ═══════════════════════════════════════════ */
            .form-body {
                padding: 0;
            }

            .form-section {
                padding: 28px 32px;
                border-bottom: 1px solid var(--slate-100);
                position: relative;
            }

            .form-section:last-child {
                border-bottom: none;
            }

            .form-section::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 0;
                background: var(--primary);
                border-radius: 0 3px 3px 0;
                transition: width 0.3s;
            }

            .form-section:focus-within::before {
                width: 4px;
            }

            .form-section:focus-within {
                background: var(--slate-25);
            }

            .section-label {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 20px;
            }

            .section-label-icon {
                width: 36px;
                height: 36px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                font-size: 17px;
                flex-shrink: 0;
            }

            .section-label-icon.indigo {
                background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                color: #6366f1;
            }

            .section-label-icon.teal {
                background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
                color: #14b8a6;
            }

            .section-label-icon.amber {
                background: linear-gradient(135deg, #fffbeb, #fef3c7);
                color: #d97706;
            }

            .section-label-icon.emerald {
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                color: #059669;
            }

            .section-label h5 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.92rem;
                font-weight: 800;
                color: var(--slate-900);
                margin: 0;
                letter-spacing: -0.2px;
            }

            .section-label .sec-divider {
                flex: 1;
                height: 1px;
                background: linear-gradient(90deg, var(--slate-200), transparent);
            }

            /* ── Form Grid ── */
            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .form-grid .full {
                grid-column: 1 / -1;
            }

            /* ── Form Field ── */
            .f-group {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .f-group label {
                font-size: 0.76rem;
                font-weight: 700;
                color: var(--slate-700);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .f-group label .req {
                color: var(--danger);
                font-weight: 800;
            }

            .f-group label i {
                font-size: 15px;
                color: var(--slate-400);
            }

            .f-group input,
            .f-group select,
            .f-group textarea {
                width: 100%;
                border: 1.5px solid var(--slate-200);
                border-radius: var(--radius-sm);
                padding: 12px 16px;
                font-size: 0.88rem;
                font-family: 'Inter', sans-serif;
                font-weight: 500;
                background: #fff;
                color: var(--slate-800);
                outline: none;
                transition: var(--transition);
            }

            .f-group textarea {
                min-height: 120px;
                resize: vertical;
                line-height: 1.7;
            }

            .f-group input:hover,
            .f-group select:hover,
            .f-group textarea:hover {
                border-color: var(--slate-300);
            }

            .f-group input:focus,
            .f-group select:focus,
            .f-group textarea:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
                background: #fff;
            }

            .f-group input:disabled,
            .f-group select:disabled {
                background: var(--slate-50);
                color: var(--slate-400);
                cursor: not-allowed;
            }

            .f-group input::placeholder,
            .f-group textarea::placeholder {
                color: var(--slate-400);
                font-weight: 400;
            }

            .f-group input[readonly] {
                background: var(--slate-50);
                color: var(--slate-600);
                cursor: default;
                border-style: dashed;
            }

            .f-help {
                font-size: 0.72rem;
                color: var(--slate-400);
                font-weight: 500;
                line-height: 1.5;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .f-help i {
                font-size: 13px;
                color: var(--slate-300);
            }

            /* ── Preview Cards ── */
            .preview-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 14px;
            }

            .preview-item {
                background: linear-gradient(135deg, var(--slate-25), var(--slate-50));
                border: 1px solid var(--slate-200);
                border-radius: var(--radius-sm);
                padding: 16px 18px;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .preview-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, var(--primary), var(--violet));
                opacity: 0;
                transition: opacity 0.3s;
            }

            .preview-item.filled::before {
                opacity: 1;
            }

            .preview-item.filled {
                border-color: rgba(99, 102, 241, 0.15);
                background: linear-gradient(135deg, #fafafe, #f5f3ff08);
            }

            .preview-label {
                display: block;
                font-size: 0.64rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.8px;
                margin-bottom: 8px;
            }

            .preview-value {
                font-size: 0.88rem;
                font-weight: 700;
                color: var(--slate-800);
                word-break: break-word;
                line-height: 1.5;
                min-height: 20px;
            }

            .preview-value.placeholder {
                color: var(--slate-300);
                font-weight: 500;
                font-style: italic;
            }

            /* ── Status Preview ── */
            .status-preview-display {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: var(--radius-sm);
                font-size: 0.82rem;
                font-weight: 700;
                border: 1.5px dashed;
                transition: var(--transition);
            }

            .status-preview-display.active {
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                color: #059669;
                border-color: rgba(5, 150, 105, 0.2);
            }

            .status-preview-display.expired {
                background: linear-gradient(135deg, #fef2f2, #fee2e2);
                color: #dc2626;
                border-color: rgba(220, 38, 38, 0.2);
            }

            .status-preview-display.pending {
                background: linear-gradient(135deg, #fffbeb, #fef3c7);
                color: #d97706;
                border-color: rgba(217, 119, 6, 0.2);
            }

            .status-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
            }

            .status-preview-display.active .status-dot {
                background: #10b981;
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
                animation: statusPulse 2s ease-in-out infinite;
            }

            .status-preview-display.expired .status-dot {
                background: #ef4444;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
            }

            .status-preview-display.pending .status-dot {
                background: #f59e0b;
                box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
            }

            @keyframes statusPulse {

                0%,
                100% {
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
                }

                50% {
                    box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
                }
            }

            /* ═══════════════════════════════════════════
               FORM FOOTER / ACTIONS
            ═══════════════════════════════════════════ */
            .form-footer {
                padding: 20px 32px;
                border-top: 1px solid var(--slate-100);
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: linear-gradient(180deg, #fff, var(--slate-25));
                flex-wrap: wrap;
                gap: 12px;
            }

            .form-footer-info {
                font-size: 0.76rem;
                color: var(--slate-400);
                display: flex;
                align-items: center;
                gap: 6px;
                font-weight: 500;
            }

            .form-footer-info i {
                font-size: 16px;
                color: var(--slate-300);
            }

            .form-footer-btns {
                display: flex;
                gap: 10px;
            }

            .f-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 12px 26px;
                border-radius: var(--radius-sm);
                font-size: 0.84rem;
                font-weight: 700;
                font-family: 'Inter', sans-serif;
                border: none;
                cursor: pointer;
                transition: var(--transition);
                text-decoration: none;
                letter-spacing: -0.15px;
            }

            .f-btn i {
                font-size: 18px;
            }

            .f-btn.ghost {
                background: #fff;
                color: var(--slate-700);
                border: 1.5px solid var(--slate-300);
            }

            .f-btn.ghost:hover {
                border-color: var(--slate-400);
                color: var(--slate-800);
                background: var(--slate-50);
                transform: translateY(-1px);
            }

            .f-btn.primary {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: #fff;
                box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
            }

            .f-btn.primary:hover {
                background: linear-gradient(135deg, var(--primary-dark), var(--primary-deeper));
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(99, 102, 241, 0.35);
                color: #fff;
            }

            .f-btn.primary:active {
                transform: translateY(0);
            }

            /* ═══════════════════════════════════════════
               CUSTOMER SELECTED STATE
            ═══════════════════════════════════════════ */
            .customer-selected-badge {
                display: none;
                align-items: center;
                gap: 10px;
                padding: 10px 16px;
                border-radius: var(--radius-sm);
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                border: 1px solid rgba(5, 150, 105, 0.12);
                margin-top: 8px;
                animation: fadeInUp 0.3s ease-out;
            }

            .customer-selected-badge.show {
                display: flex;
            }

            .customer-selected-badge .cs-icon {
                width: 28px;
                height: 28px;
                border-radius: 50%;
                background: #10b981;
                color: #fff;
                display: grid;
                place-items: center;
                font-size: 14px;
                flex-shrink: 0;
            }

            .customer-selected-badge .cs-text {
                font-size: 0.78rem;
                font-weight: 600;
                color: #065f46;
            }

            /* ═══════════════════════════════════════════
               RESPONSIVE
            ═══════════════════════════════════════════ */
            @media (max-width: 992px) {
                .steps-row {
                    grid-template-columns: 1fr;
                }

                .preview-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 768px) {
                .amc-form-container {
                    padding: 0;
                }

                .form-banner {
                    padding: 32px 24px;
                    border-radius: var(--radius-lg);
                }

                .banner-inner {
                    flex-direction: column;
                    text-align: center;
                }

                .banner-text h1 {
                    font-size: 1.5rem;
                }

                .form-section {
                    padding: 24px 20px;
                }

                .form-card-head {
                    padding: 22px 20px 18px;
                }

                .form-tip {
                    margin: 16px 20px 0;
                }

                .form-grid {
                    grid-template-columns: 1fr;
                }

                .form-footer {
                    padding: 16px 20px;
                    flex-direction: column;
                    align-items: stretch;
                }

                .form-footer-btns {
                    justify-content: stretch;
                }

                .form-footer-btns .f-btn {
                    flex: 1;
                    justify-content: center;
                }
            }

            @media (max-width: 480px) {
                .form-banner {
                    padding: 24px 18px;
                    border-radius: var(--radius);
                }

                .banner-text h1 {
                    font-size: 1.25rem;
                }

                .step-card {
                    padding: 18px;
                }
            }
        </style>

        <?php
        $isEdit = isset($is_edit) && $is_edit && !empty($amc);
        $formAction = $isEdit ? site_url('admin/amc/update/' . (int) $amc->id) : site_url('admin/amc/save');
        $formTitle = $isEdit ? 'Edit AMC Contract' : 'AMC Registration Form';
        $formSubtitle = $isEdit
            ? 'Update customer and contract details for this AMC record'
            : 'Customer and product relationship will be validated automatically';
        $formTip = $isEdit
            ? 'Update the AMC details below and save your changes.'
            : 'Start by selecting a customer. The product dropdown will activate once a customer is selected.';
        $selectedCustomerLabel = $isEdit ? trim((string) $amc->customer_name . ' - ' . (string) $amc->customer_mobile) : '';
        $selectedCustomerId = $isEdit ? (int) $amc->customer_id : 0;
        $selectedProductId = $isEdit ? (int) $amc->product_id : 0;
        $selectedStartDate = $isEdit ? (string) $amc->start_date : date('Y-m-d');
        $selectedEndDate = $isEdit ? (string) $amc->end_date : date('Y-m-d', strtotime('+1 year'));
        $selectedAmount = $isEdit ? (string) $amc->amc_amount : '';
        ?>

        <div class="amc-form-container">

            <!-- ═══════ BANNER ═══════ -->
            <!-- <div class="form-banner">
                <div class="banner-grid-pattern"></div>
                <div class="banner-inner">
                    <div class="banner-text">
                        <h1><i class="bx bx-plus-circle" style="vertical-align:middle; margin-right:6px;"></i> Add New
                            AMC</h1>
                        <p>Select an existing customer, choose their purchased product, and create a new Annual
                            Maintenance Contract.</p>
                    </div>
                </div>
            </div> -->
            <a href="<?= site_url('admin/amc') ?>" class="btn-back">
                <i class="bx bx-arrow-back"></i> Back to AMC List
            </a>

            <!-- ═══════ STEPS ═══════ -->
            <!-- <div class="steps-row">
                <div class="step-card">
                    <div class="step-num">1</div>
                    <h6>Select Customer</h6>
                    <p>Search and select an existing customer from the dropdown list by name or mobile number.</p>
                </div>
                <div class="step-card">
                    <div class="step-num">2</div>
                    <h6>Choose Product</h6>
                    <p>Customer's purchased products will load automatically. Select the product for AMC coverage.</p>
                </div>
                <div class="step-card">
                    <div class="step-num">3</div>
                    <h6>Create Contract</h6>
                    <p>Fill in dates and amount to complete the AMC registration process.</p>
                </div>
            </div> -->

            <!-- ═══════ FORM CARD ═══════ -->
            <div class="form-card">
                <div class="form-card-head">
                    <div class="form-card-head-icon">
                        <i class="bx bx-file"></i>
                    </div>
                    <div class="form-card-head-text">
                        <h3><?= $formTitle ?></h3>
                        <p><?= $formSubtitle ?></p>
                    </div>
                </div>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="form-tip tip-error">
                        <div class="form-tip-icon">
                            <i class="bx bx-error-circle"></i>
                        </div>
                        <span><?= htmlspecialchars($this->session->flashdata('error')) ?></span>
                    </div>
                <?php else: ?>
                    <div class="form-tip tip-info">
                        <div class="form-tip-icon">
                            <i class="bx bx-bulb"></i>
                        </div>
                        <span><?= $formTip ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?= $formAction ?>" method="post">
                    <div class="form-body">

                        <!-- ── Section 1: Customer Selection ── -->
                        <div class="form-section">
                            <div class="section-label">
                                <div class="section-label-icon indigo">
                                    <i class="bx bx-user"></i>
                                </div>
                                <h5>Customer Information</h5>
                                <div class="sec-divider"></div>
                            </div>

                            <div class="form-grid">
                                <div class="f-group full">
                                    <label>
                                        <i class="bx bx-search"></i>
                                        Search Customer <span class="req">*</span>
                                    </label>
                                    <input type="text" id="amcCustomer" list="amcCustomerList"
                                        placeholder="Type customer name or mobile number..." autocomplete="off"
                                        value="<?= htmlspecialchars($selectedCustomerLabel) ?>" required>
                                    <input type="hidden" name="customer_id" id="amcCustomerId"
                                        value="<?= $selectedCustomerId ?>" required>
                                    <datalist id="amcCustomerList">
                                        <?php foreach ($customers as $customer): ?>
                                            <option
                                                value="<?= htmlspecialchars((string) $customer->name . ' - ' . (string) $customer->mobile) ?>">
                                            </option>
                                        <?php endforeach; ?>
                                    </datalist>
                                    <span class="f-help">
                                        <i class="bx bx-info-circle"></i>
                                        Type name or mobile number to search existing customers
                                    </span>

                                    <div class="customer-selected-badge" id="customerSelectedBadge">
                                        <div class="cs-icon"><i class="bx bx-check"></i></div>
                                        <span class="cs-text" id="customerSelectedText">Customer selected</span>
                                    </div>
                                </div>

                                <!-- Preview Cards -->
                                <div class="full">
                                    <div class="preview-grid">
                                        <div class="preview-item" id="previewNameCard">
                                            <span class="preview-label">Customer Name</span>
                                            <div class="preview-value placeholder" id="previewCustomerName">Select a
                                                customer</div>
                                        </div>
                                        <div class="preview-item" id="previewMobileCard">
                                            <span class="preview-label">Mobile Number</span>
                                            <div class="preview-value placeholder" id="previewCustomerMobile">Select a
                                                customer</div>
                                        </div>
                                        <div class="preview-item" id="previewAddressCard">
                                            <span class="preview-label">Address</span>
                                            <div class="preview-value placeholder" id="previewCustomerAddress">Select a
                                                customer</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ── Section 2: Product Selection ── -->
                        <div class="form-section">
                            <div class="section-label">
                                <div class="section-label-icon teal">
                                    <i class="bx bx-box"></i>
                                </div>
                                <h5>Product Selection</h5>
                                <div class="sec-divider"></div>
                            </div>

                            <div class="form-grid">
                                <div class="f-group full">
                                    <label>
                                        <i class="bx bx-package"></i>
                                        Customer Product <span class="req">*</span>
                                    </label>
                                    <select name="product_id" id="amcProduct" required <?= $selectedCustomerId > 0 ? '' : 'disabled' ?>>
                                        <option value="">Select customer first</option>
                                    </select>
                                    <span class="f-help">
                                        <i class="bx bx-info-circle"></i>
                                        Products will load automatically after customer selection
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- ── Section 3: Contract Details ── -->
                        <div class="form-section">
                            <div class="section-label">
                                <div class="section-label-icon amber">
                                    <i class="bx bx-calendar"></i>
                                </div>
                                <h5>Contract Details</h5>
                                <div class="sec-divider"></div>
                            </div>

                            <div class="form-grid">
                                <div class="f-group">
                                    <label>
                                        <i class="bx bx-log-in-circle"></i>
                                        AMC Start Date <span class="req">*</span>
                                    </label>
                                    <input type="date" name="start_date" id="amcStartDate"
                                        value="<?= htmlspecialchars($selectedStartDate) ?>" required>
                                </div>

                                <div class="f-group">
                                    <label>
                                        <i class="bx bx-log-out-circle"></i>
                                        AMC End Date <span class="req">*</span>
                                    </label>
                                    <input type="date" name="end_date" id="amcEndDate"
                                        value="<?= htmlspecialchars($selectedEndDate) ?>" required>
                                </div>

                                <div class="f-group">
                                    <label>
                                        <i class="bx bx-rupee"></i>
                                        AMC Amount <span class="req">*</span>
                                    </label>
                                    <input type="number" name="amc_amount" id="amcAmount" min="0" step="0.01"
                                        placeholder="Enter AMC amount" value="<?= htmlspecialchars($selectedAmount) ?>"
                                        required>
                                    <span class="f-help">
                                        <i class="bx bx-info-circle"></i>
                                        Annual maintenance contract value in ₹
                                    </span>
                                </div>

                                <div class="f-group">
                                    <label>
                                        <i class="bx bx-badge-check"></i>
                                        Status Preview
                                    </label>
                                    <div class="status-preview-display active" id="statusPreviewDisplay">
                                        <span class="status-dot"></span>
                                        <span
                                            id="statusPreviewText"><?= strtotime($selectedEndDate) >= strtotime(date('Y-m-d')) ? 'Active' : 'Expired' ?></span>
                                    </div>
                                    <input type="hidden" id="amcStatusPreview"
                                        value="<?= strtotime($selectedEndDate) >= strtotime(date('Y-m-d')) ? 'Active' : 'Expired' ?>">
                                </div>
                            </div>
                        </div>

                        <!-- ── Section 4: Notes ── -->
                    </div>

                    <!-- ── Footer ── -->
                    <div class="form-footer">
                        <div class="form-footer-info">
                            <i class="bx bx-shield-quarter"></i>
                            All contract data is securely stored and encrypted
                        </div>
                        <div class="form-footer-btns">
                            <a href="<?= site_url('admin/amc') ?>" class="f-btn ghost">
                                <i class="bx bx-x"></i> Cancel
                            </a>
                            <button type="submit" class="f-btn primary">
                                <i class="bx bx-check-circle"></i>
                                <?= $isEdit ? 'Update AMC Contract' : 'Save AMC Contract' ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const customerInput = document.getElementById('amcCustomer');
                const customerIdInput = document.getElementById('amcCustomerId');
                const productSelect = document.getElementById('amcProduct');
                const endDateInput = document.getElementById('amcEndDate');
                const statusPreviewDisplay = document.getElementById('statusPreviewDisplay');
                const statusPreviewText = document.getElementById('statusPreviewText');
                const customerSelectedBadge = document.getElementById('customerSelectedBadge');
                const customerSelectedText = document.getElementById('customerSelectedText');
                const customerProductsBaseUrl = <?= json_encode(site_url('admin/amc/customer_products')) ?>;
                const selectedCustomerId = <?= json_encode($selectedCustomerId) ?>;
                const selectedProductId = <?= json_encode($selectedProductId) ?>;

                const customers = <?= json_encode(array_map(function ($customer) {
                    return [
                        'id' => (int) $customer->id,
                        'name' => (string) $customer->name,
                        'mobile' => (string) $customer->mobile,
                        'address' => (string) $customer->address,
                        'label' => (string) $customer->name . ' - ' . (string) $customer->mobile
                    ];
                }, $customers)) ?>;

                function setPreview(customer) {
                    const nameEl = document.getElementById('previewCustomerName');
                    const mobileEl = document.getElementById('previewCustomerMobile');
                    const addressEl = document.getElementById('previewCustomerAddress');
                    const nameCard = document.getElementById('previewNameCard');
                    const mobileCard = document.getElementById('previewMobileCard');
                    const addressCard = document.getElementById('previewAddressCard');

                    if (customer) {
                        nameEl.textContent = customer.name;
                        nameEl.classList.remove('placeholder');
                        nameCard.classList.add('filled');

                        mobileEl.textContent = customer.mobile;
                        mobileEl.classList.remove('placeholder');
                        mobileCard.classList.add('filled');

                        addressEl.textContent = customer.address || 'Address not available';
                        addressEl.classList.remove('placeholder');
                        addressCard.classList.add('filled');

                        customerSelectedBadge.classList.add('show');
                        customerSelectedText.textContent = customer.name + ' selected successfully';
                    } else {
                        nameEl.textContent = 'Select a customer';
                        nameEl.classList.add('placeholder');
                        nameCard.classList.remove('filled');

                        mobileEl.textContent = 'Select a customer';
                        mobileEl.classList.add('placeholder');
                        mobileCard.classList.remove('filled');

                        addressEl.textContent = 'Select a customer';
                        addressEl.classList.add('placeholder');
                        addressCard.classList.remove('filled');

                        customerSelectedBadge.classList.remove('show');
                    }
                }

                function resetProducts(message) {
                    productSelect.innerHTML = '';
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = message;
                    productSelect.appendChild(option);
                    productSelect.disabled = true;
                }

                function updateStatusPreview() {
                    if (!endDateInput.value) {
                        statusPreviewDisplay.className = 'status-preview-display pending';
                        statusPreviewText.textContent = 'Pending';
                        return;
                    }

                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const selectedDate = new Date(endDateInput.value + 'T00:00:00');

                    if (selectedDate >= today) {
                        statusPreviewDisplay.className = 'status-preview-display active';
                        statusPreviewText.textContent = 'Active';
                    } else {
                        statusPreviewDisplay.className = 'status-preview-display expired';
                        statusPreviewText.textContent = 'Expired';
                    }
                }

                function findCustomer(term) {
                    const value = (term || '').trim().toLowerCase();
                    if (!value) return null;

                    return customers.find(function (customer) {
                        return customer.label.toLowerCase() === value
                            || customer.mobile.toLowerCase() === value
                            || customer.name.toLowerCase() === value;
                    }) || null;
                }

                function loadProducts(customerId, preselectedProductId) {
                    resetProducts('Loading products...');

                    fetch(customerProductsBaseUrl + '/' + customerId, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(function (response) { return response.json(); })
                        .then(function (data) {
                            const products = data && Array.isArray(data.products) ? data.products : [];
                            productSelect.innerHTML = '';

                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = products.length ? 'Select product' : 'No product found for this customer';
                            productSelect.appendChild(defaultOption);

                            if (!products.length) {
                                productSelect.disabled = true;
                                return;
                            }

                            products.forEach(function (product) {
                                const option = document.createElement('option');
                                option.value = product.id;
                                option.textContent = product.product_name
                                    + (product.product_modal ? ' | Model: ' + product.product_modal : '')
                                    + (product.date_of_purchase ? ' | Purchase: ' + product.date_of_purchase : '');

                                if (String(preselectedProductId || '') === String(product.id)) {
                                    option.selected = true;
                                }

                                productSelect.appendChild(option);
                            });

                            productSelect.disabled = false;
                        })
                        .catch(function () {
                            resetProducts('Unable to load products');
                        });
                }

                function handleCustomerSelection() {
                    const customer = findCustomer(customerInput.value);

                    if (!customer) {
                        customerIdInput.value = '';
                        setPreview(null);
                        resetProducts('Select customer first');
                        return;
                    }

                    customerIdInput.value = customer.id;
                    setPreview(customer);
                    loadProducts(customer.id, null);
                }

                resetProducts('Select customer first');
                updateStatusPreview();

                if (selectedCustomerId) {
                    const selectedCustomer = customers.find(function (customer) {
                        return String(customer.id) === String(selectedCustomerId);
                    }) || findCustomer(customerInput.value);

                    if (selectedCustomer) {
                        customerInput.value = selectedCustomer.label;
                        customerIdInput.value = selectedCustomer.id;
                        setPreview(selectedCustomer);
                        loadProducts(selectedCustomer.id, selectedProductId);
                    }
                }

                customerInput.addEventListener('change', handleCustomerSelection);
                customerInput.addEventListener('blur', handleCustomerSelection);
                endDateInput.addEventListener('change', updateStatusPreview);
            });
        </script>
    </div>
</div>