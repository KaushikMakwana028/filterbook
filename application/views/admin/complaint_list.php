<div class="page-wrapper">
    <div class="page-content">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

            :root {
                --cp-primary: #6366f1;
                --cp-primary-dark: #4f46e5;
                --cp-primary-light: #818cf8;
                --cp-secondary: #0d9488;
                --cp-text: #0f172a;
                --cp-text-secondary: #334155;
                --cp-muted: #64748b;
                --cp-light-muted: #94a3b8;
                --cp-border: #e2e8f0;
                --cp-border-light: #f1f5f9;
                --cp-white: #ffffff;
                --cp-bg: #f8fafc;
                --cp-warning: #f59e0b;
                --cp-warning-light: rgba(245, 158, 11, 0.1);
                --cp-success: #10b981;
                --cp-success-light: rgba(16, 185, 129, 0.1);
                --cp-danger: #ef4444;
                --cp-danger-light: rgba(239, 68, 68, 0.1);
                --cp-shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
                --cp-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
                --cp-shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.06), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
                --cp-radius: 16px;
                --cp-radius-sm: 10px;
                --cp-radius-xs: 6px;
                --cp-transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .cp-wrap {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            /* ── Flash Messages ── */
            .cp-flash {
                padding: 14px 20px;
                border-radius: var(--cp-radius-sm);
                font-size: 14px;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                animation: cpSlideDown 0.35s ease both;
            }

            .cp-flash i {
                font-size: 20px;
                flex-shrink: 0;
            }

            .cp-flash.success {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(16, 185, 129, 0.03));
                color: #065f46;
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .cp-flash.error {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(239, 68, 68, 0.03));
                color: #991b1b;
                border: 1px solid rgba(239, 68, 68, 0.2);
            }

            @keyframes cpSlideDown {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* ── Hero ── */
            .cp-hero {
                position: relative;
                background: linear-gradient(135deg, #4f46e5 0%, #6366f1 30%, #0d9488 100%);
                color: #fff;
                border-radius: 24px;
                padding: 40px 44px;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                flex-wrap: wrap;
                overflow: hidden;
            }

            .cp-hero::before {
                content: '';
                position: absolute;
                top: -60%;
                right: -10%;
                width: 420px;
                height: 420px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }

            .cp-hero::after {
                content: '';
                position: absolute;
                bottom: -50%;
                left: 15%;
                width: 350px;
                height: 350px;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
                border-radius: 50%;
                pointer-events: none;
            }

            .cp-hero-content {
                position: relative;
                z-index: 1;
            }

            .cp-hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.04em;
                margin-bottom: 14px;
                border: 1px solid rgba(255, 255, 255, 0.12);
            }

            .cp-hero-badge i {
                font-size: 14px;
            }

            .cp-hero h1 {
                margin: 0 0 8px;
                font-size: 32px;
                font-weight: 900;
                letter-spacing: -0.02em;
                line-height: 1.2;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .cp-hero p {
                margin: 0;
                font-size: 15px;
                opacity: 0.85;
                font-weight: 400;
                line-height: 1.5;
            }

            /* ── Stats ── */
            .cp-stats {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
                margin-bottom: 24px;
            }

            .cp-stat {
                background: var(--cp-white);
                border: 1px solid var(--cp-border);
                border-radius: var(--cp-radius);
                box-shadow: var(--cp-shadow);
                padding: 24px 26px;
                transition: var(--cp-transition);
            }

            .cp-stat:hover {
                box-shadow: var(--cp-shadow-md);
                transform: translateY(-2px);
                border-color: #cbd5e1;
            }

            .cp-stat-icon {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 16px;
                font-size: 22px;
            }

            .cp-stat-icon.purple {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(99, 102, 241, 0.05));
                color: var(--cp-primary);
            }

            .cp-stat-icon.amber {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.12), rgba(245, 158, 11, 0.05));
                color: #d97706;
            }

            .cp-stat-icon.green {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.12), rgba(16, 185, 129, 0.05));
                color: var(--cp-success);
            }

            .cp-stat-label {
                color: var(--cp-muted);
                font-size: 11.5px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                margin-bottom: 8px;
            }

            .cp-stat-value {
                font-size: 30px;
                font-weight: 900;
                color: var(--cp-text);
                letter-spacing: -0.03em;
                line-height: 1;
            }

            .cp-stat-sub {
                font-size: 12px;
                color: var(--cp-light-muted);
                font-weight: 500;
                margin-top: 6px;
            }

            /* ── Card ── */
            .cp-card {
                background: var(--cp-white);
                border: 1px solid var(--cp-border);
                border-radius: var(--cp-radius);
                box-shadow: var(--cp-shadow);
                overflow: hidden;
                transition: var(--cp-transition);
                margin-bottom: 28px;
            }

            .cp-card:hover {
                box-shadow: var(--cp-shadow-md);
            }

            /* ── Toolbar ── */
            .cp-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 24px;
                border-bottom: 1px solid var(--cp-border-light);
                gap: 16px;
                flex-wrap: wrap;
            }

            .cp-toolbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .cp-toolbar-title {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 16px;
                font-weight: 800;
                color: var(--cp-text);
                letter-spacing: -0.01em;
            }

            .cp-toolbar-title i {
                font-size: 20px;
                color: var(--cp-primary);
            }

            .cp-toolbar-count {
                background: var(--cp-border-light);
                color: var(--cp-muted);
                padding: 4px 12px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
            }

            .cp-toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            /* ── Filter Select ── */
            .cp-filter-select {
                padding: 10px 36px 10px 14px;
                border: 1.5px solid var(--cp-border);
                border-radius: var(--cp-radius-xs);
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                color: var(--cp-text);
                background: var(--cp-bg);
                cursor: pointer;
                outline: none;
                transition: var(--cp-transition);
                appearance: none;
                -webkit-appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 12px center;
            }

            .cp-filter-select:focus {
                border-color: var(--cp-primary-light);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            /* ── Per Page ── */
            .cp-per-page {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: var(--cp-muted);
                font-weight: 500;
            }

            .cp-per-page select {
                padding: 8px 32px 8px 12px;
                border: 1.5px solid var(--cp-border);
                border-radius: var(--cp-radius-xs);
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                color: var(--cp-text);
                background: var(--cp-bg);
                cursor: pointer;
                outline: none;
                transition: var(--cp-transition);
                appearance: none;
                -webkit-appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 10px center;
            }

            .cp-per-page select:focus {
                border-color: var(--cp-primary-light);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            /* ── Search ── */
            .cp-search {
                position: relative;
                min-width: 280px;
            }

            .cp-search input {
                width: 100%;
                padding: 11px 16px 11px 42px;
                border: 1.5px solid var(--cp-border);
                border-radius: var(--cp-radius-sm);
                font-size: 13px;
                font-weight: 500;
                font-family: inherit;
                outline: none;
                background: var(--cp-bg);
                color: var(--cp-text);
                transition: var(--cp-transition);
            }

            .cp-search input::placeholder {
                color: var(--cp-light-muted);
            }

            .cp-search input:focus {
                border-color: var(--cp-primary-light);
                background: var(--cp-white);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .cp-search .search-icon {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--cp-light-muted);
                font-size: 18px;
                pointer-events: none;
                transition: var(--cp-transition);
            }

            .cp-search input:focus~.search-icon {
                color: var(--cp-primary);
            }

            /* ── Table ── */
            .cp-table-wrap {
                overflow-x: auto;
            }

            .cp-table-wrap::-webkit-scrollbar {
                height: 6px;
            }

            .cp-table-wrap::-webkit-scrollbar-track {
                background: var(--cp-border-light);
            }

            .cp-table-wrap::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 100px;
            }

            .cp-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
            }

            .cp-table thead {
                position: sticky;
                top: 0;
                z-index: 2;
            }

            .cp-table th {
                background: var(--cp-bg);
                color: var(--cp-muted);
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                padding: 14px 18px;
                text-align: left;
                border-bottom: 2px solid var(--cp-border);
                font-weight: 700;
                white-space: nowrap;
            }

            .cp-table td {
                padding: 18px;
                border-bottom: 1px solid var(--cp-border-light);
                color: var(--cp-text-secondary);
                vertical-align: middle;
                font-weight: 500;
            }

            .cp-table tbody tr {
                transition: var(--cp-transition);
            }

            .cp-table tbody tr:hover {
                background: #fafafd;
            }

            .cp-table tbody tr:last-child td {
                border-bottom: 0;
            }

            /* ── Row Num ── */
            .cp-row-num {
                width: 32px;
                height: 32px;
                border-radius: var(--cp-radius-sm);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 800;
                background: var(--cp-border-light);
                color: var(--cp-muted);
            }

            /* ── Customer Cell ── */
            .cp-customer-cell {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .cp-avatar {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.04em;
                position: relative;
                overflow: hidden;
            }

            .cp-avatar::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.15));
                pointer-events: none;
            }

            .cp-avatar.purple {
                background: linear-gradient(135deg, #6366f1, #4f46e5);
            }

            .cp-avatar.teal {
                background: linear-gradient(135deg, #14b8a6, #0d9488);
            }

            .cp-avatar.rose {
                background: linear-gradient(135deg, #f43f5e, #e11d48);
            }

            .cp-avatar.amber {
                background: linear-gradient(135deg, #f59e0b, #d97706);
            }

            .cp-avatar.blue {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
            }

            .cp-avatar.emerald {
                background: linear-gradient(135deg, #10b981, #059669);
            }

            .cp-avatar.violet {
                background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            }

            .cp-avatar.cyan {
                background: linear-gradient(135deg, #06b6d4, #0891b2);
            }

            .cp-customer-name {
                font-weight: 700;
                color: var(--cp-text);
                font-size: 14px;
                margin-bottom: 2px;
                display: block;
            }

            .cp-customer-meta {
                font-size: 12px;
                color: var(--cp-light-muted);
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 4px;
                margin-top: 1px;
            }

            .cp-customer-meta i {
                font-size: 13px;
            }

            /* ── Product ── */
            .cp-product-name {
                font-weight: 700;
                color: var(--cp-text);
                font-size: 14px;
            }

            .cp-product-model {
                font-size: 12px;
                color: var(--cp-light-muted);
                display: flex;
                align-items: center;
                gap: 4px;
                margin-top: 3px;
            }

            .cp-product-model i {
                font-size: 13px;
            }

            /* ── Issue Badge ── */
            .cp-issue-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 14px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(239, 68, 68, 0.03));
                color: #b91c1c;
                border: 1px solid rgba(239, 68, 68, 0.12);
                white-space: nowrap;
            }

            .cp-issue-badge i {
                font-size: 14px;
            }

            /* ── Details Box ── */
            .cp-details-box {
                max-width: 280px;
                max-height: 80px;
                overflow-y: auto;
                font-size: 13px;
                color: var(--cp-muted);
                line-height: 1.6;
                padding: 10px 14px;
                background: var(--cp-bg);
                border: 1px solid var(--cp-border-light);
                border-radius: var(--cp-radius-xs);
                white-space: normal;
                word-break: break-word;
            }

            .cp-details-box::-webkit-scrollbar {
                width: 4px;
            }

            .cp-details-box::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 100px;
            }

            .cp-details-empty {
                color: var(--cp-light-muted);
                font-style: italic;
                font-size: 13px;
            }

            /* ── Status ── */
            .cp-status-select {
                min-width: 130px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 700;
                border-width: 1px;
                box-shadow: none;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }

            .cp-status-select.cp-status-pending {
                background: var(--cp-warning-light);
                color: #92400e;
                border-color: rgba(245, 158, 11, 0.2);
            }

            .cp-status-select.cp-status-approved {
                background: var(--cp-success-light);
                color: #065f46;
                border-color: rgba(16, 185, 129, 0.2);
            }

            .cp-status-select.cp-status-reject {
                background: var(--cp-danger-light);
                color: #991b1b;
                border-color: rgba(239, 68, 68, 0.2);
            }

            /* ── Actions ── */
            .cp-actions {
                display: flex;
                align-items: center;
                gap: 6px;
                justify-content: flex-end;
            }

            .cp-act-btn {
                height: 36px;
                border-radius: var(--cp-radius-xs);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                text-decoration: none;
                font-size: 13px;
                font-weight: 700;
                font-family: inherit;
                transition: var(--cp-transition);
                border: 1px solid transparent;
                padding: 0 14px;
                cursor: pointer;
                white-space: nowrap;
            }

            .cp-act-btn:hover {
                transform: translateY(-1px);
            }

            .cp-act-btn i {
                font-size: 16px;
            }

            .cp-act-btn.view {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(99, 102, 241, 0.03));
                color: var(--cp-primary-dark);
                border-color: rgba(99, 102, 241, 0.15);
            }

            .cp-act-btn.view:hover {
                background: rgba(99, 102, 241, 0.15);
                box-shadow: 0 3px 10px rgba(99, 102, 241, 0.12);
                color: var(--cp-primary-dark);
                text-decoration: none;
            }

            .cp-act-btn.delete {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.08), rgba(239, 68, 68, 0.03));
                color: #991b1b;
                border-color: rgba(239, 68, 68, 0.15);
            }

            .cp-act-btn.delete:hover {
                background: rgba(239, 68, 68, 0.15);
                box-shadow: 0 3px 10px rgba(239, 68, 68, 0.12);
                color: #991b1b;
                text-decoration: none;
            }

            /* ── Empty ── */
            .cp-empty {
                padding: 64px 20px;
                text-align: center;
            }

            .cp-empty-icon {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: var(--cp-border-light);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 18px;
                font-size: 32px;
                color: var(--cp-light-muted);
            }

            .cp-empty h4 {
                margin: 0 0 8px;
                font-size: 18px;
                font-weight: 700;
                color: var(--cp-text-secondary);
            }

            .cp-empty p {
                margin: 0;
                font-size: 14px;
                color: var(--cp-light-muted);
                max-width: 360px;
                margin-left: auto;
                margin-right: auto;
            }

            /* ── Pagination ── */
            .cp-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 18px 24px;
                border-top: 1px solid var(--cp-border-light);
                gap: 16px;
                flex-wrap: wrap;
            }

            .cp-pagination-info {
                font-size: 13px;
                color: var(--cp-muted);
                font-weight: 500;
            }

            .cp-pagination-info strong {
                color: var(--cp-text);
                font-weight: 700;
            }

            .cp-pagination {
                display: flex;
                align-items: center;
                gap: 4px;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .cp-page-btn {
                min-width: 38px;
                height: 38px;
                border: 1.5px solid var(--cp-border);
                border-radius: var(--cp-radius-sm);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: var(--cp-white);
                color: var(--cp-text-secondary);
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: var(--cp-transition);
                padding: 0 6px;
                user-select: none;
            }

            .cp-page-btn:hover:not(.active):not(.disabled) {
                background: var(--cp-bg);
                border-color: #cbd5e1;
                color: var(--cp-primary);
                transform: translateY(-1px);
                box-shadow: var(--cp-shadow-sm);
            }

            .cp-page-btn.active {
                background: linear-gradient(135deg, var(--cp-primary), var(--cp-primary-dark));
                color: #fff;
                border-color: var(--cp-primary);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
                cursor: default;
            }

            .cp-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            .cp-page-btn.nav-btn {
                font-size: 18px;
                color: var(--cp-muted);
            }

            .cp-page-btn.nav-btn:hover:not(.disabled) {
                color: var(--cp-primary);
            }

            .cp-page-ellipsis {
                min-width: 38px;
                height: 38px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: var(--cp-light-muted);
                font-size: 14px;
                font-weight: 700;
                letter-spacing: 0.1em;
                cursor: default;
                user-select: none;
            }

            /* ── No Results ── */
            .cp-no-results {
                display: none;
                text-align: center;
                padding: 40px 20px;
                color: var(--cp-light-muted);
                font-size: 14px;
                font-weight: 500;
            }

            .cp-no-results i {
                font-size: 28px;
                display: block;
                margin-bottom: 8px;
                color: var(--cp-border);
            }

            /* ══════════════════════════════════════════
   MOBILE FIXES — Replace existing media queries
   ══════════════════════════════════════════ */

            @media (max-width: 768px) {

                /* ── Wrapper padding ── */
                .cp-wrap {
                    padding: 0 10px;
                }

                /* ── Hero ── */
                .cp-hero {
                    padding: 24px 20px;
                    border-radius: 16px;
                    flex-direction: column;
                    align-items: flex-start;
                    margin-bottom: 16px;
                }

                .cp-hero h1 {
                    font-size: 22px;
                }

                .cp-hero p {
                    font-size: 13px;
                }

                /* ── Stats ── */
                .cp-stats {
                    grid-template-columns: repeat(3, 1fr);
                    gap: 10px;
                    margin-bottom: 16px;
                }

                .cp-stat {
                    padding: 14px 12px;
                }

                .cp-stat-icon {
                    width: 36px;
                    height: 36px;
                    font-size: 18px;
                    margin-bottom: 10px;
                }

                .cp-stat-value {
                    font-size: 20px;
                }

                .cp-stat-label {
                    font-size: 10px;
                }

                .cp-stat-sub {
                    font-size: 11px;
                }

                /* ── Card ── */
                .cp-card {
                    border-radius: 12px;
                    margin-bottom: 16px;
                }

                /* ── Toolbar ── */
                .cp-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 14px;
                    gap: 10px;
                }

                .cp-toolbar-left {
                    align-items: center;
                }

                .cp-toolbar-title {
                    font-size: 14px;
                }

                .cp-toolbar-right {
                    width: 100%;
                    flex-direction: column;
                    gap: 8px;
                }

                .cp-search {
                    min-width: unset;
                    width: 100%;
                }

                .cp-search input {
                    width: 100%;
                    font-size: 13px;
                    padding: 10px 14px 10px 38px;
                }

                .cp-filter-select,
                .cp-per-page select {
                    width: 100%;
                    font-size: 13px;
                    padding: 10px 32px 10px 12px;
                }

                .cp-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                /* ══════════════════════════════════════════
       TABLE → CARD LAYOUT ON MOBILE
    ══════════════════════════════════════════ */

                /* Remove card overflow so inner cards show */
                .cp-table-wrap {
                    overflow: visible;
                }

                /* Hide thead */
                .cp-table thead {
                    display: none;
                }

                /* Make table/tbody block */
                .cp-table,
                .cp-table tbody {
                    display: block;
                    width: 100%;
                }

                /* Each row = a card */
                .cp-table tbody tr.cp-data-row {
                    display: block;
                    background: #fff;
                    border: 1px solid #e2e8f0;
                    border-radius: 12px;
                    padding: 14px;
                    margin-bottom: 10px;
                    position: relative;
                }

                /* Hide all cells, show individually */
                .cp-table tbody tr.cp-data-row td {
                    display: none;
                    padding: 0;
                    border: none;
                    font-size: 13px;
                }

                /* ── Row number — small top-left chip ── */
                .cp-table tbody tr.cp-data-row td:nth-child(1) {
                    display: block;
                    position: absolute;
                    top: 14px;
                    right: 14px;
                }

                .cp-row-num {
                    width: 26px;
                    height: 26px;
                    font-size: 11px;
                }

                /* ── Customer — top section with avatar ── */
                .cp-table tbody tr.cp-data-row td:nth-child(2) {
                    display: block;
                    padding-bottom: 12px;
                    margin-bottom: 10px;
                    border-bottom: 1px solid #f1f5f9;
                    padding-right: 36px;
                    /* space for row num */
                }

                .cp-customer-name {
                    font-size: 14px;
                }

                .cp-customer-meta {
                    font-size: 12px;
                }

                /* ── Product ── */
                .cp-table tbody tr.cp-data-row td:nth-child(3) {
                    display: flex;
                    flex-direction: column;
                    gap: 2px;
                    padding-bottom: 8px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid #f1f5f9;
                }

                /* ── Issue ── */
                .cp-table tbody tr.cp-data-row td:nth-child(4) {
                    display: block;
                    padding-bottom: 8px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid #f1f5f9;
                }

                /* ── Details ── */
                .cp-table tbody tr.cp-data-row td:nth-child(5) {
                    display: block;
                    padding-bottom: 8px;
                    margin-bottom: 8px;
                    border-bottom: 1px solid #f1f5f9;
                }

                .cp-details-box {
                    max-width: 100%;
                    max-height: 64px;
                    font-size: 12px;
                    padding: 8px 10px;
                }

                /* ── Labels via ::before ── */
                .cp-table tbody tr.cp-data-row td:nth-child(3)::before {
                    content: "Product";
                    font-size: 10px;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    display: block;
                    margin-bottom: 4px;
                }

                .cp-table tbody tr.cp-data-row td:nth-child(4)::before {
                    content: "Issue";
                    font-size: 10px;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    display: block;
                    margin-bottom: 4px;
                }

                .cp-table tbody tr.cp-data-row td:nth-child(5)::before {
                    content: "Details";
                    font-size: 10px;
                    font-weight: 700;
                    color: #94a3b8;
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    display: block;
                    margin-bottom: 4px;
                }

                /* ── Status + Actions — bottom row ── */
                .cp-table tbody tr.cp-data-row td:nth-child(6),
                .cp-table tbody tr.cp-data-row td:nth-child(7) {
                    display: inline-flex;
                    vertical-align: middle;
                }

                /* Status left, actions right using flex row trick */
                .cp-table tbody tr.cp-data-row td:nth-child(6) {
                    padding-top: 10px;
                    flex: 1;
                    align-items: center;
                }

                .cp-table tbody tr.cp-data-row td:nth-child(7) {
                    padding-top: 10px;
                    align-items: center;
                    justify-content: flex-end;
                }

                /* Make the two bottom cells sit in a flex row */
                .cp-table tbody tr.cp-data-row::after {
                    content: '';
                    display: table;
                    clear: both;
                }

                .cp-status-select {
                    min-width: unset;
                    width: auto;
                    font-size: 12px;
                    padding: 6px 28px 6px 12px;
                    border-radius: 999px;
                }

                .cp-issue-badge {
                    font-size: 12px;
                    padding: 5px 12px;
                }

                .cp-act-btn {
                    height: 34px;
                    padding: 0 12px;
                    font-size: 12px;
                }

                .cp-actions {
                    gap: 6px;
                }

                /* ── Empty row ── */
                .cp-table tbody tr.cp-empty-row {
                    display: block;
                    border: 1px solid #e2e8f0;
                    border-radius: 12px;
                    background: #fff;
                }

                .cp-table tbody tr.cp-empty-row td {
                    display: block;
                    border: none;
                    padding: 0;
                }

                /* ── Pagination ── */
                .cp-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    padding: 14px 16px;
                    gap: 10px;
                }

                .cp-pagination-info {
                    font-size: 12px;
                }

                .cp-page-btn {
                    min-width: 34px;
                    height: 34px;
                    font-size: 12px;
                }
            }

            @media (max-width: 480px) {
                .cp-wrap {
                    padding: 0 6px;
                }

                .cp-stats {
                    grid-template-columns: 1fr;
                    gap: 8px;
                }

                .cp-hero h1 {
                    font-size: 20px;
                }

                .cp-pagination {
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 3px;
                }

                .cp-page-btn {
                    min-width: 32px;
                    height: 32px;
                    font-size: 11px;
                }
            }

            /* ── Animations ── */
            @keyframes cpFadeUp {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .cp-hero {
                animation: cpFadeUp 0.45s ease both;
            }

            .cp-stats {
                animation: cpFadeUp 0.45s ease 0.08s both;
            }

            .cp-card {
                animation: cpFadeUp 0.45s ease 0.16s both;
            }
        </style>

        <?php
        $avatarColors = ['purple', 'teal', 'rose', 'amber', 'blue', 'emerald', 'violet', 'cyan'];
        $totalComplaints = !empty($complaints) ? count($complaints) : 0;
        $pendingCount = 0;
        $resolvedCount = 0;
        if (!empty($complaints)) {
            foreach ($complaints as $c) {
                if ((int) $c->status === 1)
                    $pendingCount++;
                else
                    $resolvedCount++;
            }
        }
        ?>

        <div class="cp-wrap">

            <!-- Flash -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="cp-flash success">
                    <i class="bx bx-check-circle"></i>
                    <?= htmlspecialchars($this->session->flashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="cp-flash error">
                    <i class="bx bx-error-circle"></i>
                    <?= htmlspecialchars($this->session->flashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Hero -->
            <!-- <div class="cp-hero">
                <div class="cp-hero-content">
                    <div class="cp-hero-badge">
                        <i class="bx bx-message-square-error"></i> Complaint Center
                    </div>
                    <h1>All Complaints</h1>
                    <p>Track, manage and resolve all customer complaints efficiently from one central dashboard.</p>
                </div>
            </div> -->

            <!-- Stats -->
            <!-- <div class="cp-stats">
                <div class="cp-stat">
                    <div class="cp-stat-icon purple"><i class="bx bx-message-square-detail"></i></div>
                    <div class="cp-stat-label">Total Complaints</div>
                    <div class="cp-stat-value"><?= $totalComplaints ?></div>
                    <div class="cp-stat-sub">All time records</div>
                </div>
                <div class="cp-stat">
                    <div class="cp-stat-icon amber"><i class="bx bx-time-five"></i></div>
                    <div class="cp-stat-label">Pending</div>
                    <div class="cp-stat-value"><?= $pendingCount ?></div>
                    <div class="cp-stat-sub">Awaiting resolution</div>
                </div>
                <div class="cp-stat">
                    <div class="cp-stat-icon green"><i class="bx bx-check-double"></i></div>
                    <div class="cp-stat-label">Resolved</div>
                    <div class="cp-stat-value"><?= $resolvedCount ?></div>
                    <div class="cp-stat-sub">Successfully closed</div>
                </div>
            </div> -->

            <!-- Main Card -->
            <div class="cp-card">
                <div class="cp-toolbar">
                    <div class="cp-toolbar-left">
                        <div class="cp-toolbar-title">
                            <i class="bx bx-list-ul"></i>
                            <span>Complaints</span>
                        </div>
                        <span class="cp-toolbar-count" id="cpToolbarCount"><?= $totalComplaints ?> records</span>
                    </div>
                    <div class="cp-toolbar-right">
                        <div class="cp-per-page">
                            <span>Show</span>
                            <select id="cpPerPage" onchange="cpResetPage()">
                                <option value="10">10</option>
                                <option value="15" selected>15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <select id="cpStatusFilter" class="cp-filter-select" onchange="cpApplyFilters()">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="reject">Reject</option>
                        </select>
                        <div class="cp-search">
                            <input type="text" id="cpSearchInput" placeholder="Search name, mobile, product, issue..."
                                oninput="cpApplyFilters()">
                            <i class="bx bx-search search-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="cp-table-wrap">
                    <table class="cp-table" id="cpTable">
                        <thead>
                            <tr>
                                <th style="width:50px">#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Issue</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th style="text-align:right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cpTableBody">
                            <?php if (!empty($complaints)): ?>
                                <?php foreach ($complaints as $index => $complaint):
                                    $rawStatus = (int) $complaint->status;
                                    $statusKey = 'approved';
                                    if ($rawStatus === 1) {
                                        $statusKey = 'pending';
                                    } elseif ($rawStatus === 3) {
                                        $statusKey = 'reject';
                                    }
                                    $initials = strtoupper(substr(trim($complaint->name), 0, 2));
                                    $colorClass = $avatarColors[$index % count($avatarColors)];
                                    $searchData = strtolower($complaint->name . ' ' . $complaint->mobile . ' ' . $complaint->area . ' ' . $complaint->product_name . ' ' . $complaint->serial_number . ' ' . $complaint->issue . ' ' . $complaint->complain_details);
                                ?>
                                    <tr class="cp-data-row" data-search="<?= htmlspecialchars($searchData) ?>"
                                        data-status="<?= $statusKey ?>">
                                        <td data-label="#"><span class="cp-row-num"><?= $index + 1 ?></span></td>
                                        <td data-label="Customer">
                                            <div class="cp-customer-cell">
                                                <div class="cp-avatar <?= $colorClass ?>"><?= htmlspecialchars($initials) ?>
                                                </div>
                                                <div>
                                                    <span
                                                        class="cp-customer-name"><?= htmlspecialchars($complaint->name) ?></span>
                                                    <div class="cp-customer-meta"><i class="bx bx-phone"></i>
                                                        <?= htmlspecialchars($complaint->mobile) ?></div>
                                                    <div class="cp-customer-meta"><i class="bx bx-map"></i>
                                                        <?= htmlspecialchars($complaint->area) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Product">
                                            <div class="cp-product-name"><?= htmlspecialchars($complaint->product_name) ?></div>
                                            <div class="cp-product-model"><i class="bx bx-chip"></i>
                                                <?= htmlspecialchars($complaint->serial_number) ?></div>
                                        </td>
                                        <td data-label="Issue">
                                            <span class="cp-issue-badge">
                                                <i class="bx bx-error-circle"></i>
                                                <?= htmlspecialchars($complaint->issue) ?>
                                            </span>
                                        </td>
                                        <td data-label="Details">
                                            <?php $details = trim((string) $complaint->complain_details); ?>
                                            <?php if (!empty($details)): ?>
                                                <div class="cp-details-box"><?= nl2br(htmlspecialchars($details)) ?></div>
                                            <?php else: ?>
                                                <span class="cp-details-empty">No details provided</span>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Status">
                                            <form method="post"
                                                action="<?= site_url('admin/complaint/update_status/' . (int) $complaint->id) ?>">
                                                <input type="hidden" name="redirect" value="list">
                                                <select name="status"
                                                    class="form-select form-select-sm cp-status-select cp-status-<?= $statusKey ?>"
                                                    onchange="this.form.submit()">
                                                    <option value="1" <?= $statusKey === 'pending' ? 'selected' : '' ?>>Pending
                                                    </option>
                                                    <option value="2" <?= $statusKey === 'approved' ? 'selected' : '' ?>>Approved
                                                    </option>
                                                    <option value="3" <?= $statusKey === 'reject' ? 'selected' : '' ?>>Reject
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td data-label="Actions">
                                            <div class="cp-actions">
                                                <a href="<?= site_url('admin/complaint/view/' . (int) $complaint->id) ?>"
                                                    class="cp-act-btn view" title="View Details">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a href="<?= site_url('admin/complaint/delete/' . (int) $complaint->id) ?>"
                                                    class="cp-act-btn delete"
                                                    onclick="return confirm('Are you sure you want to delete this complaint?')"
                                                    title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="cp-empty-row">
                                    <td colspan="7">
                                        <div class="cp-empty">
                                            <div class="cp-empty-icon"><i class="bx bx-message-square-x"></i></div>
                                            <h4>No Complaints Found</h4>
                                            <p>When customers submit complaints, they will appear here for you to manage and
                                                resolve.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- No Results -->
                <div class="cp-no-results" id="cpNoResults">
                    <i class="bx bx-search-alt"></i>
                    No complaints match your search or filter criteria.
                </div>

                <!-- Pagination -->
                <?php if (!empty($complaints)): ?>
                    <div class="cp-pagination-wrap" id="cpPaginationWrap">
                        <div class="cp-pagination-info" id="cpPaginationInfo"></div>
                        <div class="cp-pagination" id="cpPagination"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script>
            (function() {
                var currentPage = 1;
                var allRows = [];
                var filteredRows = [];

                function init() {
                    allRows = Array.from(document.querySelectorAll('#cpTable .cp-data-row'));
                    filteredRows = allRows.slice();
                    renderPage();
                }

                function getPerPage() {
                    var sel = document.getElementById('cpPerPage');
                    return sel ? parseInt(sel.value, 10) : 15;
                }

                function getTotalPages() {
                    return Math.max(1, Math.ceil(filteredRows.length / getPerPage()));
                }

                function renderPage() {
                    var perPage = getPerPage();
                    var totalPages = getTotalPages();
                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    var start = (currentPage - 1) * perPage;
                    var end = start + perPage;

                    allRows.forEach(function(r) {
                        r.style.display = 'none';
                    });
                    filteredRows.forEach(function(r, i) {
                        if (i >= start && i < end) {
                            r.style.display = '';
                            var num = r.querySelector('.cp-row-num');
                            if (num) num.textContent = i + 1;
                        }
                    });

                    var infoEl = document.getElementById('cpPaginationInfo');
                    if (infoEl) {
                        var s = filteredRows.length > 0 ? start + 1 : 0;
                        var e = Math.min(end, filteredRows.length);
                        infoEl.innerHTML = 'Showing <strong>' + s + '</strong> to <strong>' + e + '</strong> of <strong>' + filteredRows.length + '</strong> complaints';
                    }

                    var countEl = document.getElementById('cpToolbarCount');
                    if (countEl) countEl.textContent = filteredRows.length + ' records';

                    buildPagination(totalPages);
                }

                function buildPagination(totalPages) {
                    var c = document.getElementById('cpPagination');
                    if (!c) return;
                    c.innerHTML = '';

                    // Prev
                    var prev = document.createElement('button');
                    prev.className = 'cp-page-btn nav-btn' + (currentPage <= 1 ? ' disabled' : '');
                    prev.innerHTML = '<i class="bx bx-chevron-left"></i>';
                    prev.onclick = function() {
                        if (currentPage > 1) {
                            currentPage--;
                            renderPage();
                            scrollToTable();
                        }
                    };
                    c.appendChild(prev);

                    var pages = smartPages(currentPage, totalPages);
                    pages.forEach(function(p) {
                        if (p === '...') {
                            var ell = document.createElement('span');
                            ell.className = 'cp-page-ellipsis';
                            ell.textContent = '•••';
                            c.appendChild(ell);
                        } else {
                            var btn = document.createElement('button');
                            btn.className = 'cp-page-btn' + (p === currentPage ? ' active' : '');
                            btn.textContent = p;
                            btn.onclick = (function(pg) {
                                return function() {
                                    currentPage = pg;
                                    renderPage();
                                    scrollToTable();
                                };
                            })(p);
                            c.appendChild(btn);
                        }
                    });

                    // Next
                    var next = document.createElement('button');
                    next.className = 'cp-page-btn nav-btn' + (currentPage >= totalPages ? ' disabled' : '');
                    next.innerHTML = '<i class="bx bx-chevron-right"></i>';
                    next.onclick = function() {
                        if (currentPage < totalPages) {
                            currentPage++;
                            renderPage();
                            scrollToTable();
                        }
                    };
                    c.appendChild(next);
                }

                function smartPages(cur, total) {
                    if (total <= 7) {
                        var a = [];
                        for (var i = 1; i <= total; i++) a.push(i);
                        return a;
                    }
                    var p = [1];
                    if (cur > 3) p.push('...');
                    for (var j = Math.max(2, cur - 1); j <= Math.min(total - 1, cur + 1); j++) p.push(j);
                    if (cur < total - 2) p.push('...');
                    p.push(total);
                    return p;
                }

                function scrollToTable() {
                    var el = document.querySelector('.cp-card');
                    if (el) el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                // Filters
                window.cpApplyFilters = function() {
                    var q = (document.getElementById('cpSearchInput').value || '').toLowerCase().trim();
                    var status = document.getElementById('cpStatusFilter').value;
                    currentPage = 1;

                    filteredRows = allRows.filter(function(row) {
                        var sd = (row.getAttribute('data-search') || '');
                        var rs = (row.getAttribute('data-status') || '');
                        return (q === '' || sd.indexOf(q) > -1) && (status === '' || rs === status);
                    });

                    var nr = document.getElementById('cpNoResults');
                    var pw = document.getElementById('cpPaginationWrap');

                    if (filteredRows.length === 0 && (q || status)) {
                        allRows.forEach(function(r) {
                            r.style.display = 'none';
                        });
                        nr.style.display = 'block';
                        if (pw) pw.style.display = 'none';
                        var ce = document.getElementById('cpToolbarCount');
                        if (ce) ce.textContent = '0 records';
                    } else {
                        nr.style.display = 'none';
                        if (pw) pw.style.display = '';
                        renderPage();
                    }
                };

                window.cpResetPage = function() {
                    currentPage = 1;
                    renderPage();
                };

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', init);
                } else {
                    init();
                }
            })();
        </script>
    </div>
</div>