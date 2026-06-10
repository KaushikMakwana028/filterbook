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
                --radius-xs: 8px;
                --radius-sm: 12px;
                --radius: 16px;
                --radius-md: 20px;
                --radius-lg: 24px;
                --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.04);
                --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.03);
                --shadow: 0 4px 16px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.03);
                --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.07), 0 2px 8px rgba(0, 0, 0, 0.03);
                --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.08), 0 4px 16px rgba(0, 0, 0, 0.03);
                --shadow-primary: 0 4px 20px rgba(99, 102, 241, 0.22);
                --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
                --transition-spring: all 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .page-wrapper,
            .page-content {
                background: transparent !important;
            }

            /* ── Dark theme overrides ── */
            [data-theme="dark"] {
                --slate-25: rgba(255, 255, 255, 0.02);
                --slate-50: var(--bg-tertiary);
                --slate-100: rgba(255, 255, 255, 0.05);
                --slate-200: var(--border-color);
                --slate-300: #334155;
                --slate-400: #64748b;
                --slate-500: #94a3b8;
                --slate-600: #cbd5e1;
                --slate-700: #e2e8f0;
                --slate-800: #f1f5f9;
                --slate-900: #f8fafc;
            }

            [data-theme="dark"] .tbl-card,
            [data-theme="dark"] .amc-page-header {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .tbl-card-header {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .tbl-card-header h4,
            [data-theme="dark"] .page-title {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .tbl-count {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .tbl-toolbar {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .tbl-filter-group,
            [data-theme="dark"] .tbl-view-toggle {
                background: var(--bg-primary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .tbl-filter-btn {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .tbl-filter-btn.active {
                background: var(--bg-secondary) !important;
                color: var(--primary) !important;
            }

            [data-theme="dark"] .tbl-view-btn {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .tbl-view-btn.active {
                background: var(--bg-secondary) !important;
                color: var(--primary) !important;
            }

            [data-theme="dark"] .tbl-search input {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .tbl-search input::placeholder {
                color: #475569 !important;
            }

            [data-theme="dark"] .tbl-card table thead th {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .tbl-card table tbody td {
                color: var(--text-secondary) !important;
                border-color: rgba(255, 255, 255, 0.04) !important;
            }

            [data-theme="dark"] .tbl-card tbody tr:hover {
                background: var(--bg-tertiary) !important;
            }

            [data-theme="dark"] .client-name {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .client-meta {
                color: #64748b !important;
            }

            [data-theme="dark"] .av-status {
                border-color: var(--bg-secondary) !important;
            }

            [data-theme="dark"] .product-name {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .product-model {
                color: #64748b !important;
            }

            [data-theme="dark"] .product-icon-box {
                background: rgba(99, 102, 241, 0.15) !important;
            }

            [data-theme="dark"] .date-val {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .date-progress {
                background: var(--bg-tertiary) !important;
            }

            [data-theme="dark"] .amount-val {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .amount-sub {
                color: #64748b !important;
            }

            [data-theme="dark"] .act-btn {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .tbl-footer {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .tbl-footer-info {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .tbl-footer-info strong {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .btn-export {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .grid-item {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .g-row {
                border-color: rgba(255, 255, 255, 0.05) !important;
            }

            [data-theme="dark"] .g-row-label {
                color: #64748b !important;
            }

            [data-theme="dark"] .g-row-value {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .grid-item-foot {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .btn-hero {
                background: var(--primary) !important;
                color: #fff !important;
                border-color: transparent !important;
            }

            [data-theme="dark"] .no-results-state h4 {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .no-results-state p {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] #tableView table tbody tr.amc-row {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .page-sub {
                color: var(--text-secondary) !important;
            }


            /* ══════════════════════════════════════════
               PAGE HEADER — compact, integrated
            ══════════════════════════════════════════ */
            .amc-page-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                background: #fff;
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: var(--radius-md);
                padding: 18px 24px;
                margin-bottom: 20px;
                flex-wrap: wrap;
            }

            .page-header-left {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .page-header-icon {
                width: 46px;
                height: 46px;
                border-radius: var(--radius-sm);
                background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                display: grid;
                place-items: center;
                font-size: 22px;
                color: var(--primary);
                flex-shrink: 0;
            }

            .page-title {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.08rem;
                font-weight: 800;
                color: var(--slate-900);
                letter-spacing: -0.3px;
                line-height: 1.2;
            }

            .page-sub {
                font-size: 0.76rem;
                color: var(--slate-400);
                font-weight: 500;
                margin-top: 2px;
            }

            .page-header-right {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            /* Quick stat pills */
            .header-pills {
                display: flex;
                gap: 8px;
            }

            .h-pill {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 7px 16px;
                border-radius: var(--radius-sm);
                border: 1px solid var(--slate-200);
                background: var(--slate-50);
                min-width: 64px;
                transition: var(--transition);
            }

            .h-pill:hover {
                border-color: var(--primary);
                background: var(--primary-light);
            }

            .h-pill-val {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1.1rem;
                font-weight: 800;
                color: var(--slate-900);
                line-height: 1;
            }

            .h-pill-lbl {
                font-size: 0.62rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.4px;
                margin-top: 3px;
            }

            .h-pill.active .h-pill-val {
                color: var(--success-dark);
            }

            .h-pill.expired .h-pill-val {
                color: var(--danger-dark);
            }

            [data-theme="dark"] .h-pill {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .h-pill-val {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .h-pill-lbl {
                color: var(--text-secondary) !important;
            }

            .btn-hero {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--primary);
                color: #fff;
                padding: 10px 20px;
                border-radius: var(--radius-sm);
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.83rem;
                font-weight: 700;
                text-decoration: none;
                border: none;
                cursor: pointer;
                box-shadow: var(--shadow-primary);
                transition: var(--transition);
                letter-spacing: -0.1px;
                white-space: nowrap;
            }

            .btn-hero:hover {
                background: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 6px 24px rgba(99, 102, 241, 0.32);
                color: #fff;
                text-decoration: none;
            }

            .btn-hero i {
                font-size: 18px;
            }


            /* ══════════════════════════════════════════
               ALERTS
            ══════════════════════════════════════════ */
            .alert {
                border-radius: var(--radius-sm);
                padding: 12px 18px;
                font-size: 0.84rem;
                font-weight: 500;
                margin-bottom: 16px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .alert-success {
                background: var(--success-light);
                color: var(--success-dark);
                border: 1px solid rgba(16, 185, 129, 0.15);
            }

            .alert-danger {
                background: var(--danger-light);
                color: var(--danger-dark);
                border: 1px solid rgba(239, 68, 68, 0.15);
            }


            /* ══════════════════════════════════════════
               TABLE CARD
            ══════════════════════════════════════════ */
            .tbl-card {
                background: #fff;
                border-radius: var(--radius-md);
                border: 1px solid rgba(226, 232, 240, 0.8);
                overflow: hidden;
                transition: var(--transition);
                margin-bottom: 24px;
            }

            /* ── Card header ── */
            .tbl-card-header {
                padding: 16px 22px;
                display: flex;
                align-items: center;
                gap: 12px;
                border-bottom: 1px solid var(--slate-100);
                background: linear-gradient(180deg, var(--slate-25), #fff);
                flex-wrap: wrap;
            }

            .tbl-card-header-icon {
                width: 36px;
                height: 36px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                font-size: 18px;
            }

            .tbl-card-header-icon.indigo {
                background: linear-gradient(135deg, #eef2ff, #e0e7ff);
                color: #6366f1;
            }

            .tbl-card-header h4 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.92rem;
                font-weight: 800;
                color: var(--slate-900);
                letter-spacing: -0.2px;
            }

            .tbl-count {
                font-size: 0.65rem;
                font-weight: 700;
                color: var(--slate-400);
                background: var(--slate-100);
                padding: 3px 10px;
                border-radius: 14px;
                letter-spacing: 0.3px;
            }

            .tbl-spacer {
                flex: 1;
            }

            /* ── Compact Toolbar ── */
            .tbl-toolbar {
                padding: 12px 22px;
                display: flex;
                align-items: center;
                gap: 10px;
                border-bottom: 1px solid var(--slate-100);
                background: var(--slate-25);
                flex-wrap: wrap;
            }

            .tbl-search {
                position: relative;
                flex: 1;
                min-width: 200px;
                max-width: 320px;
            }

            .tbl-search input {
                width: 100%;
                padding: 8px 14px 8px 36px;
                border-radius: var(--radius-xs);
                border: 1.5px solid var(--slate-200);
                font-size: 0.8rem;
                font-family: 'Inter', sans-serif;
                font-weight: 500;
                transition: var(--transition);
                background: #fff;
                color: var(--slate-800);
            }

            .tbl-search input::placeholder {
                color: var(--slate-400);
            }

            .tbl-search input:focus {
                border-color: var(--primary);
                outline: none;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .tbl-search i {
                position: absolute;
                left: 11px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--slate-400);
                font-size: 15px;
            }

            .tbl-filter-group {
                display: flex;
                background: var(--slate-100);
                border-radius: var(--radius-xs);
                padding: 3px;
                gap: 2px;
                border: 1px solid var(--slate-200);
            }

            .tbl-filter-btn {
                border-radius: 6px;
                padding: 6px 14px;
                font-size: 0.72rem;
                font-weight: 700;
                letter-spacing: 0.2px;
                border: none;
                color: var(--slate-500);
                background: transparent;
                cursor: pointer;
                transition: var(--transition-fast);
                display: inline-flex;
                align-items: center;
                gap: 5px;
                font-family: 'Inter', sans-serif;
            }

            .tbl-filter-btn:hover {
                color: var(--slate-700);
                background: rgba(255, 255, 255, 0.6);
            }

            .tbl-filter-btn.active {
                background: #fff;
                color: var(--primary);
                box-shadow: 0 1px 6px rgba(0, 0, 0, 0.07);
            }

            .tbl-filter-btn .f-count {
                font-size: 0.63rem;
                font-weight: 800;
                background: var(--slate-200);
                padding: 1px 6px;
                border-radius: 10px;
                color: var(--slate-500);
                transition: var(--transition-fast);
            }

            .tbl-filter-btn.active .f-count {
                background: rgba(99, 102, 241, 0.1);
                color: var(--primary);
            }

            .tbl-view-toggle {
                display: flex;
                background: var(--slate-100);
                border-radius: var(--radius-xs);
                padding: 3px;
                gap: 2px;
                border: 1px solid var(--slate-200);
                margin-left: auto;
            }

            .tbl-view-btn {
                width: 30px;
                height: 30px;
                border-radius: 6px;
                border: none;
                background: transparent;
                color: var(--slate-400);
                cursor: pointer;
                transition: var(--transition-fast);
                display: grid;
                place-items: center;
                font-size: 16px;
            }

            .tbl-view-btn:hover {
                color: var(--slate-600);
            }

            .tbl-view-btn.active {
                background: #fff;
                color: var(--primary);
                box-shadow: 0 1px 6px rgba(0, 0, 0, 0.07);
            }

            /* ── Table ── */
            .tbl-card table {
                width: 100%;
                border-collapse: collapse;
                font-size: 0.82rem;
            }

            .tbl-card thead th {
                font-size: 0.65rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.8px;
                padding: 12px 20px;
                border-bottom: 1px solid var(--slate-100);
                background: var(--slate-50);
                white-space: nowrap;
                text-align: left;
                position: sticky;
                top: 0;
                z-index: 5;
            }

            .tbl-card tbody td {
                padding: 14px 20px;
                color: var(--slate-700);
                font-weight: 500;
                border-bottom: 1px solid var(--slate-50);
                vertical-align: middle;
            }

            .tbl-card tbody tr {
                transition: var(--transition-fast);
                position: relative;
            }

            .tbl-card tbody tr::after {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 0;
                background: var(--primary);
                border-radius: 0 3px 3px 0;
                transition: width 0.2s;
            }

            .tbl-card tbody tr:hover::after {
                width: 3px;
            }

            .tbl-card tbody tr:last-child td {
                border-bottom: 0;
            }

            .tbl-card tbody tr:hover {
                background: var(--slate-25);
            }

            /* ── Client Cell ── */
            .client-cell {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .client-avatar {
                width: 40px;
                height: 40px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                font-weight: 800;
                font-size: 13px;
                color: #fff;
                flex-shrink: 0;
                text-transform: uppercase;
                position: relative;
                transition: var(--transition-spring);
            }

            .tbl-card tbody tr:hover .client-avatar {
                transform: scale(1.06) rotate(-3deg);
            }

            .client-avatar.av-indigo {
                background: linear-gradient(135deg, #6366f1, #818cf8);
            }

            .client-avatar.av-rose {
                background: linear-gradient(135deg, #f43f5e, #fb7185);
            }

            .client-avatar.av-cyan {
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
            }

            .client-avatar.av-amber {
                background: linear-gradient(135deg, #f59e0b, #fbbf24);
            }

            .client-avatar.av-emerald {
                background: linear-gradient(135deg, #10b981, #34d399);
            }

            .client-avatar.av-violet {
                background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            }

            .client-avatar .av-status {
                position: absolute;
                bottom: -3px;
                right: -3px;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                border: 2px solid #fff;
            }

            .av-status.online {
                background: var(--success);
                box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
            }

            .av-status.offline {
                background: var(--danger);
                box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
            }

            .client-details {
                display: flex;
                flex-direction: column;
                gap: 1px;
            }

            .client-name {
                font-weight: 700;
                color: var(--slate-800);
                font-size: 0.84rem;
                letter-spacing: -0.2px;
                transition: color 0.2s;
            }

            .tbl-card tbody tr:hover .client-name {
                color: var(--primary);
            }

            .client-meta {
                font-size: 0.72rem;
                color: var(--slate-400);
                display: flex;
                align-items: center;
                gap: 3px;
            }

            .client-meta i {
                font-size: 12px;
                color: var(--slate-300);
            }

            /* ── Product Cell ── */
            .product-cell {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .product-icon-box {
                width: 34px;
                height: 34px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                font-size: 16px;
                background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
                color: var(--primary);
                flex-shrink: 0;
                transition: var(--transition);
            }

            .product-info .product-name {
                font-weight: 700;
                color: var(--slate-800);
                font-size: 0.82rem;
            }

            .product-info .product-model {
                font-size: 0.7rem;
                color: var(--slate-400);
                margin-top: 1px;
            }

            /* ── Date Cell ── */
            .date-cell {
                display: flex;
                flex-direction: column;
                gap: 3px;
            }

            .date-row {
                display: flex;
                align-items: center;
                gap: 7px;
                font-size: 0.78rem;
            }

            .date-dot {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                flex-shrink: 0;
            }

            .date-dot.start {
                background: var(--success);
                box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.12);
            }

            .date-dot.end {
                background: var(--danger);
                box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.12);
            }

            .date-label {
                font-size: 0.63rem;
                font-weight: 700;
                color: var(--slate-400);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                width: 32px;
            }

            .date-val {
                font-weight: 600;
                color: var(--slate-700);
                font-size: 0.78rem;
            }

            .date-progress {
                height: 3px;
                background: var(--slate-100);
                border-radius: 4px;
                margin-top: 5px;
                overflow: hidden;
            }

            .date-progress-fill {
                height: 100%;
                border-radius: 4px;
                transition: width 1s ease;
            }

            .date-progress-fill.active {
                background: linear-gradient(90deg, #10b981, #6ee7b7);
            }

            .date-progress-fill.expired {
                background: linear-gradient(90deg, #ef4444, #fca5a5);
            }

            .days-tag {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                font-size: 0.63rem;
                font-weight: 700;
                padding: 3px 8px;
                border-radius: 20px;
                margin-top: 4px;
                width: fit-content;
            }

            .days-tag.safe {
                background: #ecfdf5;
                color: #059669;
                border: 1px solid rgba(5, 150, 105, 0.1);
            }

            .days-tag.warn {
                background: #fffbeb;
                color: #d97706;
                border: 1px solid rgba(217, 119, 6, 0.1);
            }

            .days-tag.critical {
                background: #fef2f2;
                color: #dc2626;
                border: 1px solid rgba(220, 38, 38, 0.1);
            }

            .days-tag i {
                font-size: 11px;
            }

            /* ── Amount ── */
            .amount-val {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-weight: 800;
                color: var(--slate-900);
                font-size: 0.92rem;
                letter-spacing: -0.3px;
            }

            .amount-sub {
                font-size: 0.66rem;
                color: var(--slate-400);
                font-weight: 500;
                margin-top: 1px;
            }

            /* ── Status Badge ── */
            .tbl-badge {
                display: inline-flex;
                align-items: center;
                font-weight: 700;
                font-size: 0.67rem;
                padding: 4px 10px;
                border-radius: var(--radius-xs);
                letter-spacing: 0.3px;
                gap: 5px;
            }

            .tbl-badge .badge-pulse {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                display: inline-block;
            }

            .tbl-badge.success {
                background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                color: #059669;
                border: 1px solid rgba(5, 150, 105, 0.1);
            }

            .tbl-badge.success .badge-pulse {
                background: #10b981;
                box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
                animation: pulseDot 2s ease-in-out infinite;
            }

            .tbl-badge.danger {
                background: linear-gradient(135deg, #fef2f2, #fee2e2);
                color: #dc2626;
                border: 1px solid rgba(220, 38, 38, 0.1);
            }

            .tbl-badge.danger .badge-pulse {
                background: #ef4444;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
            }

            @keyframes pulseDot {

                0%,
                100% {
                    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
                }

                50% {
                    box-shadow: 0 0 0 5px rgba(16, 185, 129, 0);
                }
            }

            /* ── Action Buttons ── */
            .act-btns {
                display: flex;
                gap: 4px;
            }

            .act-btn {
                width: 32px;
                height: 32px;
                border-radius: var(--radius-xs);
                display: grid;
                place-items: center;
                border: 1px solid var(--slate-200);
                background: #fff;
                color: var(--slate-400);
                cursor: pointer;
                transition: var(--transition);
                font-size: 15px;
                text-decoration: none;
            }

            .act-btn:hover {
                background: var(--primary-light);
                border-color: rgba(99, 102, 241, 0.25);
                color: var(--primary);
                transform: translateY(-2px);
                box-shadow: 0 3px 10px rgba(99, 102, 241, 0.12);
            }

            .act-btn.act-edit:hover {
                background: var(--warning-light);
                border-color: rgba(245, 158, 11, 0.25);
                color: var(--warning-dark);
                box-shadow: 0 3px 10px rgba(245, 158, 11, 0.12);
            }

            .act-btn.act-delete:hover {
                background: var(--danger-light);
                border-color: rgba(239, 68, 68, 0.25);
                color: var(--danger);
                box-shadow: 0 3px 10px rgba(239, 68, 68, 0.12);
            }

            .act-btn.act-renew:hover {
                background: var(--success-light);
                border-color: rgba(16, 185, 129, 0.25);
                color: var(--success-dark);
                box-shadow: 0 3px 10px rgba(16, 185, 129, 0.12);
            }

            /* ── Table Footer ── */
            .tbl-footer {
                padding: 13px 22px;
                border-top: 1px solid var(--slate-100);
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: linear-gradient(180deg, #fff, var(--slate-25));
                flex-wrap: wrap;
                gap: 10px;
            }

            .tbl-footer-info {
                font-size: 0.76rem;
                color: var(--slate-400);
                font-weight: 500;
            }

            .tbl-footer-info strong {
                color: var(--slate-700);
                font-weight: 700;
            }

            .tbl-footer-actions {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .btn-export {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 7px 16px;
                border-radius: var(--radius-xs);
                font-size: 0.76rem;
                font-weight: 700;
                font-family: 'Inter', sans-serif;
                background: #fff;
                color: var(--slate-600);
                border: 1.5px solid var(--slate-200);
                cursor: pointer;
                transition: var(--transition);
                text-decoration: none;
            }

            .btn-export:hover {
                border-color: var(--primary);
                color: var(--primary);
                background: var(--primary-50);
                transform: translateY(-1px);
            }

            .btn-export i {
                font-size: 15px;
            }

            /* ── Grid View ── */
            .grid-view {
                display: none;
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                gap: 16px;
                padding: 20px 22px;
            }

            .grid-view.active {
                display: grid;
            }

            .grid-item {
                background: #fff;
                border-radius: var(--radius);
                border: 1px solid rgba(226, 232, 240, 0.8);
                padding: 20px;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .grid-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .grid-item:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-lg);
                border-color: transparent;
            }

            .grid-item:hover::before {
                opacity: 1;
            }

            .grid-item.g-active::before {
                background: linear-gradient(90deg, #10b981, #34d399, #6ee7b7);
            }

            .grid-item.g-expired::before {
                background: linear-gradient(90deg, #ef4444, #f87171, #fca5a5);
            }

            .grid-item-head {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 16px;
            }

            .grid-item-body .g-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border-bottom: 1px dashed var(--slate-100);
            }

            .grid-item-body .g-row:last-child {
                border-bottom: none;
            }

            .g-row-label {
                font-size: 0.66rem;
                color: var(--slate-400);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .g-row-value {
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--slate-800);
            }

            .grid-item-foot {
                margin-top: 16px;
                padding-top: 12px;
                border-top: 1px solid var(--slate-100);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* ── Empty State ── */
            .no-results-state {
                display: none;
                text-align: center;
                padding: 56px 24px;
            }

            .no-results-state.show {
                display: block;
            }

            .no-results-icon {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
                display: grid;
                place-items: center;
                margin: 0 auto 16px;
                font-size: 28px;
                color: var(--primary);
            }

            .no-results-state h4 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 1rem;
                font-weight: 800;
                color: var(--slate-800);
                margin-bottom: 6px;
            }

            .no-results-state p {
                color: var(--slate-400);
                font-size: 0.84rem;
                max-width: 300px;
                margin: 0 auto;
                line-height: 1.6;
            }

            /* ── Scrollbar ── */
            .table-scroll::-webkit-scrollbar {
                height: 4px;
            }

            .table-scroll::-webkit-scrollbar-track {
                background: var(--slate-100);
            }

            .table-scroll::-webkit-scrollbar-thumb {
                background: var(--slate-300);
                border-radius: 50px;
            }

            .table-scroll::-webkit-scrollbar-thumb:hover {
                background: var(--slate-400);
            }

            /* ── Animations ── */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .amc-page-header {
                animation: fadeInUp 0.4s ease-out;
            }

            .tbl-card {
                animation: fadeInUp 0.4s ease-out 0.1s backwards;
            }

            .amc-row {
                animation: fadeInUp 0.35s ease-out backwards;
            }


            /* ══════════════════════════════════════════
               RESPONSIVE
            ══════════════════════════════════════════ */
            @media (max-width: 960px) {
                .header-pills {
                    display: none;
                }
            }

            @media (max-width: 768px) {
                .amc-page-header {
                    padding: 14px 16px;
                    margin-bottom: 14px;
                }

                .page-title {
                    font-size: 0.96rem;
                }

                .btn-hero {
                    padding: 9px 14px;
                    font-size: 0.8rem;
                }

                .btn-hero span {
                    display: none;
                }

                .tbl-card-header {
                    padding: 14px 16px 12px;
                }

                .tbl-card-header h4 {
                    font-size: 0.88rem;
                }

                .tbl-card-header-icon {
                    width: 32px;
                    height: 32px;
                    font-size: 16px;
                }

                .tbl-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 10px 16px;
                    gap: 8px;
                }

                .tbl-search {
                    max-width: 100%;
                    min-width: unset;
                }

                .tbl-search input {
                    width: 100%;
                }

                .tbl-filter-group {
                    width: 100%;
                    justify-content: space-between;
                }

                .tbl-filter-btn {
                    flex: 1;
                    justify-content: center;
                    padding: 6px 6px;
                    font-size: 0.68rem;
                }

                .tbl-view-toggle {
                    margin-left: 0;
                    align-self: flex-end;
                }

                /* Table → Card on mobile */
                #tableView {
                    overflow: visible !important;
                }

                #tableView table thead {
                    display: none;
                }

                #tableView table,
                #tableView table tbody {
                    display: block;
                    width: 100%;
                }

                #tableView table tbody tr.amc-row {
                    display: block;
                    background: #fff;
                    border: 1px solid var(--slate-200);
                    border-radius: 14px;
                    padding: 14px;
                    margin: 0 16px 10px;
                    position: relative;
                    overflow: hidden;
                    animation: none !important;
                }

                #tableView table tbody tr.amc-row[data-status="active"]::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 4px;
                    background: linear-gradient(180deg, #10b981, #34d399);
                    border-radius: 4px 0 0 4px;
                }

                #tableView table tbody tr.amc-row[data-status="expired"]::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 4px;
                    background: linear-gradient(180deg, #ef4444, #fca5a5);
                    border-radius: 4px 0 0 4px;
                }

                #tableView table tbody tr.amc-row td {
                    display: none;
                    padding: 0;
                    border: none;
                    font-size: 0.82rem;
                }

                #tableView table tbody tr.amc-row td:nth-child(1) {
                    display: flex;
                    align-items: flex-start;
                    justify-content: space-between;
                    padding-left: 8px;
                    padding-bottom: 10px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid var(--slate-100);
                }

                #tableView table tbody tr.amc-row td:nth-child(2) {
                    display: block;
                    padding-left: 8px;
                    padding-bottom: 8px;
                    margin-bottom: 6px;
                    border-bottom: 1px solid var(--slate-100);
                }

                #tableView table tbody tr.amc-row td:nth-child(2)::before {
                    content: "Product";
                    display: block;
                    font-size: 0.63rem;
                    font-weight: 700;
                    color: var(--slate-400);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 5px;
                }

                #tableView table tbody tr.amc-row td:nth-child(3) {
                    display: block;
                    padding-left: 8px;
                    padding-bottom: 8px;
                    margin-bottom: 6px;
                    border-bottom: 1px solid var(--slate-100);
                }

                #tableView table tbody tr.amc-row td:nth-child(3)::before {
                    content: "Contract Period";
                    display: block;
                    font-size: 0.63rem;
                    font-weight: 700;
                    color: var(--slate-400);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 5px;
                }

                #tableView table tbody tr.amc-row td:nth-child(4) {
                    display: block;
                    padding-left: 8px;
                    padding-top: 4px;
                    padding-bottom: 8px;
                    border-bottom: 1px solid var(--slate-100);
                    margin-bottom: 6px;
                }

                #tableView table tbody tr.amc-row td:nth-child(4)::before {
                    content: "Value";
                    display: block;
                    font-size: 0.63rem;
                    font-weight: 700;
                    color: var(--slate-400);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 4px;
                }

                #tableView table tbody tr.amc-row td:nth-child(5) {
                    display: none;
                }

                #tableView table tbody tr.amc-row td:nth-child(6) {
                    display: flex;
                    padding-top: 10px;
                    margin-top: 4px;
                    justify-content: flex-end;
                    padding-left: 8px;
                }

                .grid-view {
                    grid-template-columns: 1fr;
                    padding: 12px 16px;
                    gap: 10px;
                }

                .tbl-footer {
                    padding: 12px 16px;
                    flex-direction: column;
                    align-items: center;
                    gap: 8px;
                    text-align: center;
                }

                .btn-export {
                    width: 100%;
                    justify-content: center;
                }
            }

            @media (max-width: 480px) {
                .amc-page-header {
                    padding: 12px 14px;
                }

                .page-title {
                    font-size: 0.9rem;
                }

                .tbl-toolbar {
                    padding: 8px 12px;
                }

                .tbl-card-header {
                    padding: 12px 14px 10px;
                }
            }
        </style>

        <?php
        $active_amc  = 0;
        $expired_amc = 0;
        $total_value = 0;
        $today       = strtotime(date('Y-m-d'));
        $expiring_soon = 0;

        foreach ($amcs as $amc) {
            $end_ts    = strtotime($amc->end_date);
            $is_active = (int)$amc->status === 1 && $end_ts >= $today;
            if ($is_active) {
                $active_amc++;
                $days_left = floor(($end_ts - $today) / 86400);
                if ($days_left <= 30) $expiring_soon++;
            } else {
                $expired_amc++;
            }
            $total_value += (float)$amc->amc_amount;
        }

        $total_count   = count($amcs);
        $avatar_classes = ['av-indigo', 'av-rose', 'av-cyan', 'av-amber', 'av-emerald', 'av-violet'];
        ?>

        <!-- ═══════ FLASH MESSAGES ═══════ -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="bx bx-check-circle" style="font-size:18px;"></i>
                <?= htmlspecialchars($this->session->flashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="bx bx-error-circle" style="font-size:18px;"></i>
                <?= htmlspecialchars($this->session->flashdata('error')) ?>
            </div>
        <?php endif; ?>

        <!-- ═══════ PAGE HEADER ═══════ -->
        <div class="amc-page-header">
            <div class="page-header-left">
                <div class="page-header-icon">
                    <i class="bx bx-shield-quarter"></i>
                </div>
                <div>
                    <div class="page-title">AMC Management</div>
                    <div class="page-sub">Annual Maintenance Contracts</div>
                </div>
            </div>
            <div class="page-header-right">
                <!-- Quick stat pills — hidden on small screens -->
                <div class="header-pills">
                    <div class="h-pill">
                        <span class="h-pill-val"><?= $total_count ?></span>
                        <span class="h-pill-lbl">Total</span>
                    </div>
                    <div class="h-pill active">
                        <span class="h-pill-val"><?= $active_amc ?></span>
                        <span class="h-pill-lbl">Active</span>
                    </div>
                    <div class="h-pill expired">
                        <span class="h-pill-val"><?= $expired_amc ?></span>
                        <span class="h-pill-lbl">Expired</span>
                    </div>
                </div>
                <a href="<?= site_url('admin/amc/add') ?>" class="btn-hero">
                    <i class="bx bx-plus-circle"></i>
                    <span>Create Contract</span>
                </a>
            </div>
        </div>

        <!-- ═══════ TABLE CARD ═══════ -->
        <div class="tbl-card">

            <!-- Card Header -->
            <div class="tbl-card-header">
                <div class="tbl-card-header-icon indigo">
                    <i class="bx bx-file"></i>
                </div>
                <h4>All AMC Contracts</h4>
                <span class="tbl-count"><?= $total_count ?> RECORDS</span>
                <div class="tbl-spacer"></div>
                <span style="font-size:0.68rem; font-weight:600; color:var(--slate-400);"><?= date('M Y') ?></span>
            </div>

            <!-- Toolbar — search + filter + view toggle, all in one row -->
            <div class="tbl-toolbar">
                <div class="tbl-search">
                    <i class="bx bx-search"></i>
                    <input type="text" id="amcSearchInput" placeholder="Search client, mobile, product…">
                </div>

                <div class="tbl-filter-group" id="filterGroup">
                    <button class="tbl-filter-btn active" data-filter="">
                        All <span class="f-count"><?= $total_count ?></span>
                    </button>
                    <button class="tbl-filter-btn" data-filter="active">
                        <i class="bx bxs-circle" style="font-size:6px; color:var(--success);"></i>
                        Active <span class="f-count"><?= $active_amc ?></span>
                    </button>
                    <button class="tbl-filter-btn" data-filter="expired">
                        <i class="bx bxs-circle" style="font-size:6px; color:var(--danger);"></i>
                        Expired <span class="f-count"><?= $expired_amc ?></span>
                    </button>
                </div>

                <div class="tbl-view-toggle">
                    <button class="tbl-view-btn active" data-view="table" title="Table View">
                        <i class="bx bx-list-ul"></i>
                    </button>
                    <button class="tbl-view-btn" data-view="grid" title="Grid View">
                        <i class="bx bx-grid-alt"></i>
                    </button>
                </div>
            </div>

            <!-- TABLE VIEW -->
            <div class="table-scroll" id="tableView" style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Product</th>
                            <th>Contract Period</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="amcTableBody">
                        <?php
                        $idx = 0;
                        foreach ($amcs as $amc):
                            $end_ts    = strtotime($amc->end_date);
                            $start_ts  = strtotime($amc->start_date);
                            $is_active = (int)$amc->status === 1 && $end_ts >= $today;
                            $days_left = floor(($end_ts - $today) / 86400);
                            $initials  = strtoupper(substr($amc->customer_name, 0, 2));
                            $av_class  = $avatar_classes[$idx % count($avatar_classes)];

                            $total_days = max(floor(($end_ts - $start_ts) / 86400), 1);
                            $elapsed    = floor(($today - $start_ts) / 86400);
                            $progress   = min(max(round(($elapsed / $total_days) * 100), 0), 100);
                            if (!$is_active) $progress = 100;

                            $days_class = 'safe';
                            if (!$is_active)         $days_class = 'critical';
                            elseif ($days_left <= 30) $days_class = 'critical';
                            elseif ($days_left <= 90) $days_class = 'warn';

                            $idx++;
                        ?>
                            <tr class="amc-row"
                                data-search="<?= strtolower($amc->customer_name . ' ' . $amc->customer_mobile . ' ' . $amc->product_name) ?>"
                                data-status="<?= $is_active ? 'active' : 'expired' ?>"
                                style="animation-delay:<?= ($idx * 0.04) ?>s">

                                <!-- Client -->
                                <td>
                                    <div class="client-cell">
                                        <div class="client-avatar <?= $av_class ?>">
                                            <?= $initials ?>
                                            <span class="av-status <?= $is_active ? 'online' : 'offline' ?>"></span>
                                        </div>
                                        <div class="client-details">
                                            <span class="client-name"><?= htmlspecialchars($amc->customer_name) ?></span>
                                            <span class="client-meta"><i class="bx bx-phone"></i><?= htmlspecialchars($amc->customer_mobile) ?></span>
                                            <span class="client-meta"><i class="bx bx-map"></i><?= htmlspecialchars($amc->customer_address) ?></span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Product -->
                                <td>
                                    <div class="product-cell">
                                        <div class="product-icon-box"><i class="bx bx-box"></i></div>
                                        <div class="product-info">
                                            <div class="product-name"><?= htmlspecialchars($amc->product_name) ?></div>
                                            <div class="product-model"><?= $amc->product_modal ?: 'N/A' ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contract Period -->
                                <td>
                                    <div class="date-cell">
                                        <div class="date-row">
                                            <span class="date-dot start"></span>
                                            <span class="date-label">Start</span>
                                            <span class="date-val"><?= date('d M, Y', $start_ts) ?></span>
                                        </div>
                                        <div class="date-row">
                                            <span class="date-dot end"></span>
                                            <span class="date-label">End</span>
                                            <span class="date-val"><?= date('d M, Y', $end_ts) ?></span>
                                        </div>
                                        <div class="date-progress">
                                            <div class="date-progress-fill <?= $is_active ? 'active' : 'expired' ?>" data-width="<?= $progress ?>"></div>
                                        </div>
                                        <?php if ($is_active): ?>
                                            <span class="days-tag <?= $days_class ?>">
                                                <i class="bx bx-time-five"></i><?= $days_left ?> days left
                                            </span>
                                        <?php else: ?>
                                            <span class="days-tag critical">
                                                <i class="bx bx-x-circle"></i>Expired <?= abs($days_left) ?>d ago
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <!-- Value -->
                                <td>
                                    <div class="amount-val">₹<?= number_format($amc->amc_amount, 0) ?></div>
                                    <div class="amount-sub">per year</div>
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="tbl-badge <?= $is_active ? 'success' : 'danger' ?>">
                                        <span class="badge-pulse"></span>
                                        <?= $is_active ? 'Active' : 'Expired' ?>
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="act-btns" style="justify-content:center;">
                                        <a href="<?= site_url('admin/amc/view/' . $amc->id) ?>" class="act-btn" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="<?= site_url('admin/amc/edit/' . $amc->id) ?>" class="act-btn act-edit" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <?php if (!$is_active): ?>
                                            <a href="<?= site_url('admin/amc/renew/' . $amc->id) ?>" class="act-btn act-renew" title="Renew">
                                                <i class="bx bx-refresh"></i>
                                            </a>
                                        <?php endif; ?>
                                        <button class="act-btn act-delete" title="Delete"
                                            onclick="if(confirm('Delete this contract?')) window.location='<?= site_url('admin/amc/delete/' . $amc->id) ?>'">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="no-results-state" id="noResults">
                    <div class="no-results-icon"><i class="bx bx-search-alt"></i></div>
                    <h4>No contracts found</h4>
                    <p>Try adjusting your search or filter to find what you're looking for.</p>
                </div>
            </div>

            <!-- GRID VIEW -->
            <div class="grid-view" id="gridView">
                <?php
                $idx = 0;
                foreach ($amcs as $amc):
                    $end_ts    = strtotime($amc->end_date);
                    $is_active = (int)$amc->status === 1 && $end_ts >= $today;
                    $days_left = floor(($end_ts - $today) / 86400);
                    $initials  = strtoupper(substr($amc->customer_name, 0, 2));
                    $av_class  = $avatar_classes[$idx % count($avatar_classes)];
                    $idx++;

                    $days_class = 'safe';
                    if (!$is_active)         $days_class = 'critical';
                    elseif ($days_left <= 30) $days_class = 'critical';
                    elseif ($days_left <= 90) $days_class = 'warn';
                ?>
                    <div class="grid-item <?= $is_active ? 'g-active' : 'g-expired' ?> amc-grid-item"
                        data-search="<?= strtolower($amc->customer_name . ' ' . $amc->customer_mobile . ' ' . $amc->product_name) ?>"
                        data-status="<?= $is_active ? 'active' : 'expired' ?>">

                        <div class="grid-item-head">
                            <div class="client-cell">
                                <div class="client-avatar <?= $av_class ?>" style="width:38px;height:38px;font-size:12px;">
                                    <?= $initials ?>
                                </div>
                                <div class="client-details">
                                    <span class="client-name"><?= htmlspecialchars($amc->customer_name) ?></span>
                                    <span class="client-meta"><i class="bx bx-phone"></i><?= htmlspecialchars($amc->customer_mobile) ?></span>
                                </div>
                            </div>
                            <span class="tbl-badge <?= $is_active ? 'success' : 'danger' ?>" style="font-size:0.63rem; padding:3px 8px;">
                                <span class="badge-pulse"></span>
                                <?= $is_active ? 'Active' : 'Expired' ?>
                            </span>
                        </div>

                        <div class="grid-item-body">
                            <div class="g-row">
                                <span class="g-row-label">Product</span>
                                <span class="g-row-value"><?= htmlspecialchars($amc->product_name) ?></span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Model</span>
                                <span class="g-row-value" style="color:var(--slate-500);font-weight:600;"><?= $amc->product_modal ?: 'N/A' ?></span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Period</span>
                                <span class="g-row-value" style="font-size:0.74rem;"><?= date('d M Y', strtotime($amc->start_date)) ?> — <?= date('d M Y', $end_ts) ?></span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Value</span>
                                <span class="g-row-value amount-val" style="font-size:0.9rem;">₹<?= number_format($amc->amc_amount, 0) ?></span>
                            </div>
                            <div class="g-row">
                                <span class="g-row-label">Remaining</span>
                                <span class="days-tag <?= $days_class ?>" style="font-size:0.61rem;">
                                    <?php if ($is_active): ?>
                                        <i class="bx bx-time-five"></i><?= $days_left ?> days left
                                    <?php else: ?>
                                        <i class="bx bx-x-circle"></i>Expired <?= abs($days_left) ?>d ago
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>

                        <div class="grid-item-foot">
                            <div class="act-btns">
                                <a href="<?= site_url('admin/amc/view/' . $amc->id) ?>" class="act-btn" title="View"><i class="bx bx-show"></i></a>
                                <a href="<?= site_url('admin/amc/edit/' . $amc->id) ?>" class="act-btn act-edit" title="Edit"><i class="bx bx-edit-alt"></i></a>
                                <?php if (!$is_active): ?>
                                    <a href="<?= site_url('admin/amc/renew/' . $amc->id) ?>" class="act-btn act-renew" title="Renew"><i class="bx bx-refresh"></i></a>
                                <?php endif; ?>
                                <button class="act-btn act-delete" title="Delete"
                                    onclick="if(confirm('Delete this contract?')) window.location='<?= site_url('admin/amc/delete/' . $amc->id) ?>'">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Footer -->
            <div class="tbl-footer">
                <div class="tbl-footer-info">
                    Showing <strong id="visibleCount"><?= $total_count ?></strong> of <strong><?= $total_count ?></strong> contracts
                </div>
                <div class="tbl-footer-actions">
                    <button class="btn-export" onclick="exportAMCCSV()">
                        <i class="bx bx-download"></i> Export CSV
                    </button>
                </div>
            </div>
        </div>

        <script>
            (function() {
                // ── Bar Animations ──
                function animateBars() {
                    document.querySelectorAll('.date-progress-fill').forEach(function(el) {
                        var w = el.getAttribute('data-width');
                        if (w !== null) el.style.width = w + '%';
                    });
                }
                setTimeout(animateBars, 400);

                // ── Search & Filter ──
                function filterTable() {
                    var keyword = document.getElementById('amcSearchInput').value.toLowerCase().trim();
                    var activeBtn = document.querySelector('#filterGroup .tbl-filter-btn.active');
                    var status = activeBtn ? (activeBtn.getAttribute('data-filter') || '') : '';
                    var visible = 0;

                    document.querySelectorAll('.amc-row').forEach(function(row) {
                        var textOk = !keyword || row.getAttribute('data-search').indexOf(keyword) !== -1;
                        var statusOk = !status || row.getAttribute('data-status') === status;
                        var show = textOk && statusOk;
                        row.style.display = show ? '' : 'none';
                        if (show) visible++;
                    });

                    document.querySelectorAll('.amc-grid-item').forEach(function(item) {
                        var textOk = !keyword || item.getAttribute('data-search').indexOf(keyword) !== -1;
                        var statusOk = !status || item.getAttribute('data-status') === status;
                        item.style.display = (textOk && statusOk) ? '' : 'none';
                    });

                    document.getElementById('visibleCount').textContent = visible;
                    var noRes = document.getElementById('noResults');
                    if (visible === 0) {
                        noRes.classList.add('show');
                    } else {
                        noRes.classList.remove('show');
                    }
                }

                document.getElementById('amcSearchInput').addEventListener('input', filterTable);

                document.querySelectorAll('#filterGroup .tbl-filter-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('#filterGroup .tbl-filter-btn').forEach(function(b) {
                            b.classList.remove('active');
                        });
                        btn.classList.add('active');
                        filterTable();
                    });
                });

                // ── View Toggle ──
                document.querySelectorAll('.tbl-view-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var view = btn.getAttribute('data-view');
                        document.querySelectorAll('.tbl-view-btn').forEach(function(b) {
                            b.classList.remove('active');
                        });
                        btn.classList.add('active');

                        var tableView = document.getElementById('tableView');
                        var gridView = document.getElementById('gridView');

                        if (view === 'grid') {
                            tableView.style.display = 'none';
                            gridView.classList.add('active');
                        } else {
                            gridView.classList.remove('active');
                            tableView.style.display = '';
                        }
                    });
                });

                // ── Row stagger ──
                document.querySelectorAll('.amc-row').forEach(function(row, i) {
                    row.style.animationDelay = (i * 0.04) + 's';
                });
            })();

            // ── Export CSV ──
            function exportAMCCSV() {
                var csv = 'Client Name,Mobile,Product,Model,Start Date,End Date,Amount,Status\n';

                document.querySelectorAll('.amc-row').forEach(function(row) {
                    if (row.style.display === 'none') return;
                    var tds = row.querySelectorAll('td');
                    var name = (tds[0].querySelector('.client-name') || {
                        textContent: ''
                    }).textContent.trim();
                    var mobile = (tds[0].querySelector('.client-meta') || {
                        textContent: ''
                    }).textContent.trim();
                    var product = (tds[1].querySelector('.product-name') || {
                        textContent: ''
                    }).textContent.trim();
                    var model = (tds[1].querySelector('.product-model') || {
                        textContent: ''
                    }).textContent.trim();
                    var dateVals = tds[2].querySelectorAll('.date-val');
                    var start = dateVals[0] ? dateVals[0].textContent.trim() : '';
                    var end = dateVals[1] ? dateVals[1].textContent.trim() : '';
                    var amount = (tds[3].querySelector('.amount-val') || {
                        textContent: ''
                    }).textContent.trim();
                    var status = (tds[4].querySelector('.tbl-badge') || {
                        textContent: ''
                    }).textContent.trim();
                    csv += '"' + name + '","' + mobile + '","' + product + '","' + model + '","' + start + '","' + end + '","' + amount + '","' + status + '"\n';
                });

                var blob = new Blob([csv], {
                    type: 'text/csv'
                });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'amc_contracts_' + new Date().toISOString().split('T')[0] + '.csv';
                a.click();
                URL.revokeObjectURL(url);
            }
        </script>
    </div>
</div>