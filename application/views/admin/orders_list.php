<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            :root {
                --primary: #4F46E5;
                --primary-hover: #4338CA;
                --primary-light: #EEF2FF;
                --text: #1F2937;
                --text-secondary: #6B7280;
                --text-muted: #9CA3AF;
                --border: #E5E7EB;
                --border-light: #F3F4F6;
                --bg: #F9FAFB;
                --white: #FFFFFF;
                --success: #059669;
                --success-bg: #ECFDF5;
                --warning: #D97706;
                --warning-bg: #FFFBEB;
                --danger: #DC2626;
                --danger-bg: #FEF2F2;
                --info: #2563EB;
                --info-bg: #EFF6FF;
                --radius: 8px;
                --radius-lg: 12px;
                --shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
                --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
                --transition: all 0.2s ease;
            }

            .cl-page * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .cl-page {
                font-family: 'Inter', -apple-system, sans-serif;
                color: var(--text);
                line-height: 1.5;
            }

            .cl-page-content {
                max-width: 1280px;
                margin: 0 auto;
                padding: 2rem;
            }

            /* ── Page Header ── */
            .cl-page-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .cl-page-header-left h1 {
                font-size: 1.625rem;
                font-weight: 700;
                color: var(--text);
                letter-spacing: -0.025em;
            }

            .cl-page-header-left p {
                color: var(--text-secondary);
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            .cl-page-header-right {
                display: flex;
                gap: 0.75rem;
            }

            /* ── Buttons ── */
            .cl-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.625rem 1.25rem;
                border-radius: var(--radius);
                font-size: 0.875rem;
                font-weight: 500;
                font-family: inherit;
                cursor: pointer;
                transition: var(--transition);
                border: none;
                white-space: nowrap;
                text-decoration: none;
            }

            .cl-btn-primary {
                background: var(--primary);
                color: var(--white);
                box-shadow: 0 1px 2px rgba(79, 70, 229, 0.3);
            }

            .cl-btn-primary:hover {
                background: var(--primary-hover);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
                color: var(--white);
                text-decoration: none;
            }

            .cl-btn-secondary {
                background: var(--white);
                color: var(--text);
                border: 1px solid var(--border);
            }

            .cl-btn-secondary:hover {
                background: var(--bg);
                border-color: #D1D5DB;
                text-decoration: none;
                color: var(--text);
            }

            .cl-btn-sm {
                padding: 0.375rem 0.75rem;
                font-size: 0.8125rem;
            }

            /* ── Stats Cards ── */
            .cl-stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .cl-stat-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 1.25rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                transition: var(--transition);
            }

            .cl-stat-card:hover {
                box-shadow: var(--shadow-md);
            }

            .cl-stat-icon {
                width: 2.75rem;
                height: 2.75rem;
                border-radius: var(--radius);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                flex-shrink: 0;
            }

            .cl-stat-icon.blue {
                background: var(--info-bg);
                color: var(--info);
            }

            .cl-stat-icon.green {
                background: var(--success-bg);
                color: var(--success);
            }

            .cl-stat-icon.yellow {
                background: var(--warning-bg);
                color: var(--warning);
            }

            .cl-stat-icon.purple {
                background: var(--primary-light);
                color: var(--primary);
            }

            .cl-stat-value {
                font-size: 1.375rem;
                font-weight: 700;
                color: var(--text);
                letter-spacing: -0.025em;
            }

            .cl-stat-label {
                font-size: 0.75rem;
                color: var(--text-muted);
                margin-top: 0.125rem;
            }

            /* ── Toolbar ── */
            .cl-toolbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1rem;
                flex-wrap: wrap;
            }

            .cl-toolbar-left {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                flex: 1;
            }

            .cl-toolbar-right {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .cl-search-box {
                position: relative;
                max-width: 320px;
                flex: 1;
            }

            .cl-search-box input {
                width: 100%;
                padding: 0.625rem 1rem 0.625rem 2.5rem;
                border: 1px solid var(--border);
                border-radius: var(--radius);
                font-size: 0.875rem;
                font-family: inherit;
                background: var(--white);
                transition: var(--transition);
                color: var(--text);
                box-sizing: border-box;
            }

            .cl-search-box input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            }

            .cl-search-box input::placeholder {
                color: var(--text-muted);
            }

            .cl-search-box i {
                position: absolute;
                left: 0.875rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-muted);
                font-size: 0.875rem;
            }

            .cl-per-page {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 0.8125rem;
                color: var(--text-secondary);
                font-weight: 500;
            }

            .cl-per-page select {
                padding: 0.5rem 2rem 0.5rem 0.625rem;
                border: 1px solid var(--border);
                border-radius: var(--radius);
                font-size: 0.8125rem;
                font-weight: 600;
                font-family: inherit;
                color: var(--text);
                background: var(--white);
                cursor: pointer;
                outline: none;
                transition: var(--transition);
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 8px center;
            }

            .cl-per-page select:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            }

            /* ── Table Card ── */
            .cl-table-card {
                background: var(--white);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                overflow: hidden;
            }

            .cl-table-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .cl-table {
                width: 100%;
                border-collapse: collapse;
            }

            .cl-table thead {
                background: var(--bg);
                border-bottom: 1px solid var(--border);
            }

            .cl-table thead th {
                padding: 0.75rem 1.25rem;
                text-align: left;
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--text-secondary);
                text-transform: uppercase;
                letter-spacing: 0.05em;
                white-space: nowrap;
                cursor: pointer;
                user-select: none;
                transition: var(--transition);
            }

            .cl-table thead th:hover {
                color: var(--text);
            }

            .cl-table thead th .sort-icon {
                margin-left: 0.25rem;
                font-size: 0.625rem;
                opacity: 0.4;
            }

            .cl-table thead th:hover .sort-icon {
                opacity: 1;
            }

            .cl-table thead th.sorted {
                color: var(--primary);
            }

            .cl-table thead th.sorted .sort-icon {
                opacity: 1;
                color: var(--primary);
            }

            .cl-table tbody tr {
                border-bottom: 1px solid var(--border-light);
                transition: var(--transition);
            }

            .cl-table tbody tr:last-child {
                border-bottom: none;
            }

            .cl-table tbody tr:hover {
                background: #FAFAFF;
            }

            .cl-table tbody td {
                padding: 1rem 1.25rem;
                font-size: 0.875rem;
                vertical-align: middle;
            }

            /* ── Checkbox ── */
            .cl-checkbox-wrapper {
                display: flex;
                align-items: center;
            }

            .cl-checkbox-wrapper input[type="checkbox"] {
                width: 1rem;
                height: 1rem;
                border-radius: 4px;
                accent-color: var(--primary);
                cursor: pointer;
            }

            /* ── Customer Cell ── */
            .cl-customer-cell {
                display: flex;
                align-items: center;
                gap: 0.875rem;
            }

            .cl-avatar {
                width: 2.75rem;
                height: 2.75rem;
                border-radius: var(--radius);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.8125rem;
                font-weight: 800;
                flex-shrink: 0;
                color: var(--white);
                text-transform: uppercase;
                letter-spacing: 0.04em;
            }

            .cl-avatar.purple {
                background: linear-gradient(135deg, #6366f1, #4f46e5);
            }

            .cl-avatar.teal {
                background: linear-gradient(135deg, #14b8a6, #0d9488);
            }

            .cl-avatar.rose {
                background: linear-gradient(135deg, #f43f5e, #e11d48);
            }

            .cl-avatar.amber {
                background: linear-gradient(135deg, #f59e0b, #d97706);
            }

            .cl-avatar.blue {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
            }

            .cl-avatar.emerald {
                background: linear-gradient(135deg, #10b981, #059669);
            }

            .cl-avatar.violet {
                background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            }

            .cl-avatar.cyan {
                background: linear-gradient(135deg, #06b6d4, #0891b2);
            }

            .cl-customer-info {
                min-width: 0;
            }

            .cl-customer-name {
                font-weight: 600;
                color: var(--text);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 220px;
                display: block;
            }

            .cl-customer-id {
                font-size: 0.75rem;
                color: var(--text-muted);
                margin-top: 0.125rem;
            }

            /* ── Mobile Cell ── */
            .cl-mobile {
                display: flex;
                align-items: center;
                gap: 0.375rem;
                color: var(--text-secondary);
                font-weight: 500;
            }

            .cl-mobile i {
                color: var(--text-muted);
                font-size: 0.8125rem;
            }

            /* ── Address Cell ── */
            .cl-address-text {
                color: var(--text-secondary);
                max-width: 260px;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                line-height: 1.5;
                font-size: 0.8125rem;
            }

            /* ── Orders Badge ── */
            .cl-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.375rem;
                padding: 0.25rem 0.625rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
                white-space: nowrap;
            }

            .cl-badge-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
            }

            .cl-badge-info {
                background: var(--primary-light);
                color: var(--primary);
            }

            .cl-badge-info .cl-badge-dot {
                background: var(--primary);
            }

            .cl-badge-success {
                background: var(--success-bg);
                color: var(--success);
            }

            .cl-badge-success .cl-badge-dot {
                background: var(--success);
            }

            .cl-badge-warning {
                background: var(--warning-bg);
                color: var(--warning);
            }

            .cl-badge-warning .cl-badge-dot {
                background: var(--warning);
            }

            /* ── Actions ── */
            .cl-actions-cell {
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            .cl-action-btn {
                width: 2rem;
                height: 2rem;
                border: none;
                background: none;
                border-radius: var(--radius);
                color: var(--text-muted);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: var(--transition);
                font-size: 0.875rem;
                text-decoration: none;
            }

            .cl-action-btn:hover {
                background: var(--bg);
                color: var(--text);
            }

            .cl-action-btn.view:hover {
                background: var(--info-bg);
                color: var(--info);
            }

            .cl-action-btn.edit:hover {
                background: var(--primary-light);
                color: var(--primary);
            }

            .cl-action-btn.delete:hover {
                background: var(--danger-bg);
                color: var(--danger);
            }

            /* ── Table Footer / Pagination ── */
            .cl-table-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.875rem 1.25rem;
                border-top: 1px solid var(--border);
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .cl-table-info {
                font-size: 0.8125rem;
                color: var(--text-secondary);
            }

            .cl-table-info strong {
                color: var(--text);
                font-weight: 600;
            }

            .cl-pagination {
                display: flex;
                align-items: center;
                gap: 0.25rem;
                list-style: none;
            }

            .cl-page-btn {
                width: 2rem;
                height: 2rem;
                border: 1px solid var(--border);
                background: var(--white);
                border-radius: var(--radius);
                color: var(--text-secondary);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.8125rem;
                font-weight: 500;
                transition: var(--transition);
                font-family: inherit;
            }

            .cl-page-btn:hover:not(.active):not(.disabled) {
                background: var(--bg);
                border-color: #D1D5DB;
                color: var(--text);
            }

            .cl-page-btn.active {
                background: var(--primary);
                border-color: var(--primary);
                color: var(--white);
            }

            .cl-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            /* ── Empty State ── */
            .cl-empty-state {
                text-align: center;
                padding: 4rem 2rem;
            }

            .cl-empty-icon {
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
                background: var(--bg);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                font-size: 1.5rem;
                color: var(--text-muted);
            }

            .cl-empty-title {
                font-size: 1rem;
                font-weight: 600;
                color: var(--text);
                margin-bottom: 0.25rem;
            }

            .cl-empty-text {
                color: var(--text-secondary);
                font-size: 0.875rem;
                margin-bottom: 1.25rem;
            }

            /* ── Bulk Actions Bar ── */
            .cl-bulk-bar {
                display: none;
                align-items: center;
                justify-content: space-between;
                background: var(--primary);
                color: var(--white);
                padding: 0.75rem 1.25rem;
                border-radius: var(--radius-lg);
                margin-bottom: 1rem;
                animation: clSlideDown 0.2s ease;
            }

            .cl-bulk-bar.show {
                display: flex;
            }

            .cl-bulk-bar-left {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-size: 0.875rem;
                font-weight: 500;
            }

            .cl-bulk-bar-right {
                display: flex;
                gap: 0.5rem;
            }

            .cl-bulk-btn {
                padding: 0.375rem 0.875rem;
                background: rgba(255, 255, 255, 0.15);
                color: var(--white);
                border: none;
                border-radius: var(--radius);
                font-size: 0.8125rem;
                font-weight: 500;
                cursor: pointer;
                font-family: inherit;
                transition: var(--transition);
                display: flex;
                align-items: center;
                gap: 0.375rem;
            }

            .cl-bulk-btn:hover {
                background: rgba(255, 255, 255, 0.25);
            }

            @keyframes clSlideDown {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* ── No Results ── */
            .cl-no-results {
                display: none;
                text-align: center;
                padding: 3rem 2rem;
                color: var(--text-muted);
                font-size: 0.875rem;
                font-weight: 500;
            }

            .cl-no-results i {
                font-size: 1.75rem;
                display: block;
                margin-bottom: 0.5rem;
                color: #D1D5DB;
            }

            /* ══════════════════════════════════════════
   MOBILE FIXES — Replace existing media queries
   ══════════════════════════════════════════ */

            @media (max-width: 768px) {

                /* ── Page wrapper ── */
                .cl-page-content {
                    padding: 0.875rem 0.75rem;
                }

                .cl-page-header {
                    flex-direction: column;
                    gap: 0.75rem;
                    margin-bottom: 1rem;
                }

                .cl-page-header-left h1 {
                    font-size: 1.3rem;
                }

                .cl-page-header-right {
                    width: 100%;
                }

                .cl-page-header-right .cl-btn {
                    width: 100%;
                    justify-content: center;
                }

                /* ── Stats ── */
                .cl-stats-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                /* ── Toolbar ── */
                .cl-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 0.625rem;
                    margin-bottom: 0.875rem;
                }

                .cl-toolbar-left {
                    flex-direction: column;
                }

                .cl-search-box {
                    max-width: 100%;
                }

                .cl-toolbar-right {
                    justify-content: flex-end;
                }

                /* ── Bulk bar ── */
                .cl-bulk-bar {
                    flex-direction: column;
                    gap: 0.75rem;
                    text-align: center;
                }

                .cl-bulk-bar-right {
                    justify-content: center;
                    width: 100%;
                }

                .cl-bulk-btn {
                    flex: 1;
                    justify-content: center;
                }

                /* ══════════════════════════════════════════
       TABLE → CARD LAYOUT ON MOBILE
       Hide the thead and convert each tbody row
       into a self-contained card
    ══════════════════════════════════════════ */

                .cl-table-card {
                    background: transparent;
                    border: none;
                    box-shadow: none;
                    border-radius: 0;
                }

                .cl-table-wrapper {
                    overflow: visible;
                }

                /* Hide the table header on mobile */
                .cl-table thead {
                    display: none;
                }

                /* Make each row a card */
                .cl-table,
                .cl-table tbody {
                    display: block;
                    width: 100%;
                }

                .cl-table tbody tr.cl-data-row {
                    display: block;
                    background: #ffffff;
                    border: 1px solid #E5E7EB;
                    border-radius: 12px;
                    padding: 0.875rem 1rem;
                    margin-bottom: 0.625rem;
                    position: relative;
                    transition: box-shadow 0.2s ease;
                }

                .cl-table tbody tr.cl-data-row:hover {
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                    background: #FAFAFF;
                }

                /* Hide all cells by default, show selectively */
                .cl-table tbody tr.cl-data-row td {
                    display: none;
                    padding: 0;
                    border: none;
                    font-size: 0.875rem;
                    vertical-align: middle;
                }

                /* ── Checkbox — top-left corner ── */
                .cl-table tbody tr.cl-data-row td:nth-child(1) {
                    display: block;
                    position: absolute;
                    top: 0.875rem;
                    left: 0.875rem;
                    width: auto;
                }

                /* ── Customer — main info ── */
                .cl-table tbody tr.cl-data-row td:nth-child(2) {
                    display: block;
                    padding-left: 1.75rem;
                    /* offset for checkbox */
                    padding-bottom: 0.625rem;
                    border-bottom: 1px solid #F3F4F6;
                    margin-bottom: 0.625rem;
                }

                .cl-table tbody tr.cl-data-row td:nth-child(2) .cl-customer-name {
                    max-width: 100%;
                    font-size: 0.9375rem;
                }

                /* ── Mobile, Address, Orders — label+value rows ── */
                .cl-table tbody tr.cl-data-row td:nth-child(3),
                .cl-table tbody tr.cl-data-row td:nth-child(4),
                .cl-table tbody tr.cl-data-row td:nth-child(5) {
                    display: flex;
                    align-items: flex-start;
                    gap: 0.5rem;
                    padding: 0.2rem 0;
                }

                /* Inject labels via ::before */
                .cl-table tbody tr.cl-data-row td:nth-child(3)::before {
                    content: "Mobile:";
                    font-size: 0.72rem;
                    font-weight: 600;
                    color: #9CA3AF;
                    text-transform: uppercase;
                    letter-spacing: 0.04em;
                    white-space: nowrap;
                    min-width: 56px;
                    margin-top: 2px;
                }

                .cl-table tbody tr.cl-data-row td:nth-child(4)::before {
                    content: "Address:";
                    font-size: 0.72rem;
                    font-weight: 600;
                    color: #9CA3AF;
                    text-transform: uppercase;
                    letter-spacing: 0.04em;
                    white-space: nowrap;
                    min-width: 56px;
                    margin-top: 2px;
                }

                .cl-table tbody tr.cl-data-row td:nth-child(5)::before {
                    content: "Orders:";
                    font-size: 0.72rem;
                    font-weight: 600;
                    color: #9CA3AF;
                    text-transform: uppercase;
                    letter-spacing: 0.04em;
                    white-space: nowrap;
                    min-width: 56px;
                    margin-top: 2px;
                }

                .cl-address-text {
                    max-width: 100%;
                    -webkit-line-clamp: 2;
                    font-size: 0.8125rem;
                }

                /* ── Actions — bottom right ── */
                .cl-table tbody tr.cl-data-row td:nth-child(6) {
                    display: flex;
                    justify-content: flex-end;
                    padding-top: 0.625rem;
                    margin-top: 0.5rem;
                    border-top: 1px solid #F3F4F6;
                }

                .cl-action-btn {
                    width: 2rem;
                    height: 2rem;
                }

                /* ── Empty state row ── */
                .cl-table tbody tr:not(.cl-data-row) {
                    display: block;
                    background: #ffffff;
                    border: 1px solid #E5E7EB;
                    border-radius: 12px;
                }

                .cl-table tbody tr:not(.cl-data-row) td {
                    display: block;
                    border: none;
                    padding: 0;
                }

                /* ── Table footer ── */
                .cl-table-footer {
                    flex-direction: column;
                    align-items: center;
                    gap: 0.625rem;
                    padding: 0.75rem 0;
                    border-top: none;
                    background: transparent;
                }

                .cl-table-info {
                    font-size: 0.75rem;
                    text-align: center;
                }
            }

            @media (max-width: 480px) {
                .cl-page-content {
                    padding: 0.75rem 0.5rem;
                }

                .cl-stats-grid {
                    grid-template-columns: 1fr;
                }

                .cl-page-btn {
                    width: 1.75rem;
                    height: 1.75rem;
                    font-size: 0.75rem;
                }
            }
        </style>

        <?php
        $avatarColors = ['purple', 'teal', 'rose', 'amber', 'blue', 'emerald', 'violet', 'cyan'];
        $totalCustomers = !empty($customers) ? count($customers) : 0;

        // Calculate stats
        $totalOrders = 0;
        $activeCustomers = 0;
        $newCustomers = 0;
        if (!empty($customers)) {
            foreach ($customers as $c) {
                $totalOrders += (int) $c->total_orders;
                if ((int) $c->total_orders > 0)
                    $activeCustomers++;
            }
            $newCustomers = max(0, $totalCustomers - $activeCustomers);
        }
        ?>

        <div class="cl-page">
            <div class="cl-page-content">

                <!-- Page Header -->
                <div class="cl-page-header">
                    <div class="cl-page-header-left">
                        <h1>Customers</h1>
                        <p>Manage and view all your customer records</p>
                    </div>
                    <div class="cl-page-header-right">
                        <!-- <a href="<?= site_url('admin/orders/export_customers') ?>" class="cl-btn cl-btn-secondary">
                            <i class="fas fa-file-export"></i> Export
                        </a> -->
                        <a href="<?= site_url('admin/orders/new_order') ?>" class="cl-btn cl-btn-primary">
                            <i class="fas fa-plus"></i> New Order
                        </a>
                    </div>
                </div>

                <!-- Stats -->
                <!-- <div class="cl-stats-grid">
                    <div class="cl-stat-card">
                        <div class="cl-stat-icon blue"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="cl-stat-value"><?= $totalCustomers ?></div>
                            <div class="cl-stat-label">Total Customers</div>
                        </div>
                    </div>
                    <div class="cl-stat-card">
                        <div class="cl-stat-icon green"><i class="fas fa-user-check"></i></div>
                        <div>
                            <div class="cl-stat-value"><?= $activeCustomers ?></div>
                            <div class="cl-stat-label">With Orders</div>
                        </div>
                    </div>
                    <div class="cl-stat-card">
                        <div class="cl-stat-icon yellow"><i class="fas fa-user-clock"></i></div>
                        <div>
                            <div class="cl-stat-value"><?= $newCustomers ?></div>
                            <div class="cl-stat-label">No Orders Yet</div>
                        </div>
                    </div>
                    <div class="cl-stat-card">
                        <div class="cl-stat-icon purple"><i class="fas fa-shopping-bag"></i></div>
                        <div>
                            <div class="cl-stat-value"><?= $totalOrders ?></div>
                            <div class="cl-stat-label">Total Orders</div>
                        </div>
                    </div>
                </div> -->

                <!-- Toolbar -->
                <div class="cl-toolbar">
                    <div class="cl-toolbar-left">
                        <!-- <div class="cl-search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search customers..." id="clSearchInput"
                                onkeyup="clSearchCustomers()">
                        </div> -->
                        <div class="cl-per-page">
                            <!-- <span>Show</span>
                            <select id="clPerPage" onchange="clResetPagination()">
                                <option value="10" selected>10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="cl-toolbar-right">
                        <span class="cl-btn cl-btn-secondary cl-btn-sm" style="cursor:default; font-weight:600;">
                            <i class="fas fa-users" style="color:var(--primary);"></i>
                            <span id="clToolbarCount"><?= $totalCustomers ?></span> records
                        </span>
                    </div>
                </div>

                <!-- Bulk Actions Bar -->
                <div class="cl-bulk-bar" id="clBulkBar">
                    <div class="cl-bulk-bar-left">
                        <i class="fas fa-check-circle"></i>
                        <span><strong id="clSelectedCount">0</strong> customers selected</span>
                    </div>
                    <div class="cl-bulk-bar-right">
                        <button class="cl-bulk-btn"><i class="fas fa-trash"></i> Delete</button>
                        <button class="cl-bulk-btn" onclick="clClearSelection()"><i class="fas fa-times"></i>
                            Cancel</button>
                    </div>
                </div>

                <!-- Table -->
                <div class="cl-table-card">
                    <div class="cl-table-wrapper">
                        <table class="cl-table">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">
                                        <div class="cl-checkbox-wrapper">
                                            <input type="checkbox" id="clSelectAll" onchange="clToggleSelectAll(this)">
                                        </div>
                                    </th>
                                    <th class="sorted">
                                        Customer <i class="fas fa-arrow-up sort-icon"></i>
                                    </th>
                                    <th>
                                        Mobile <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th>
                                        Address <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th>
                                        Orders <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="clTableBody">
                                <?php if (!empty($customers)): ?>
                                    <?php foreach ($customers as $index => $customer):
                                        $initials = strtoupper(substr(trim($customer->name), 0, 2));
                                        $colorClass = $avatarColors[$index % count($avatarColors)];
                                        $orders = (int) $customer->total_orders;

                                        if ($orders >= 5) {
                                            $badgeClass = 'cl-badge-success';
                                        } elseif ($orders >= 1) {
                                            $badgeClass = 'cl-badge-info';
                                        } else {
                                            $badgeClass = 'cl-badge-warning';
                                        }
                                    ?>
                                        <tr class="cl-data-row">
                                            <td>
                                                <div class="cl-checkbox-wrapper">
                                                    <input type="checkbox" class="cl-row-checkbox" onchange="clUpdateBulkBar()">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cl-customer-cell">
                                                    <div class="cl-avatar <?= $colorClass ?>"><?= htmlspecialchars($initials) ?>
                                                    </div>
                                                    <div class="cl-customer-info">
                                                        <span
                                                            class="cl-customer-name"><?= htmlspecialchars($customer->name) ?></span>
                                                        <div class="cl-customer-id">
                                                            CUS-<?= str_pad($customer->id, 5, '0', STR_PAD_LEFT) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cl-mobile">
                                                    <i class="fas fa-phone"></i>
                                                    <?= htmlspecialchars($customer->mobile) ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cl-address-text">
                                                    <?= $customer->address ? htmlspecialchars($customer->address) : '<span style="color:var(--text-muted);">No address</span>' ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="cl-badge <?= $badgeClass ?>">
                                                    <span class="cl-badge-dot"></span>
                                                    <?= $orders ?> order<?= $orders !== 1 ? 's' : '' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="cl-actions-cell">
                                                    <a href="<?= site_url('admin/orders/customer/' . $customer->id) ?>"
                                                        class="cl-action-btn view" title="View Orders">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= site_url('admin/orders/edit_customer/' . $customer->id) ?>"
                                                        class="cl-action-btn edit" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="<?= site_url('admin/orders/delete_customer/' . $customer->id) ?>"
                                                        class="cl-action-btn delete" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this customer and all related orders?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">
                                            <div class="cl-empty-state">
                                                <div class="cl-empty-icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                                <div class="cl-empty-title">No customers yet</div>
                                                <div class="cl-empty-text">Start by creating a new order — the customer will
                                                    be added automatically.</div>
                                                <a href="<?= site_url('admin/orders/new_order') ?>"
                                                    class="cl-btn cl-btn-primary">
                                                    <i class="fas fa-plus"></i> Create First Order
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- No Results -->
                    <div class="cl-no-results" id="clNoResults">
                        <i class="fas fa-search"></i>
                        No customers match your search.
                    </div>

                    <!-- Table Footer -->
                    <?php if (!empty($customers)): ?>
                        <div class="cl-table-footer" id="clPaginationWrap">
                            <div class="cl-table-info" id="clPaginationInfo">
                                Showing <strong>1</strong> to <strong>10</strong> of <strong><?= $totalCustomers ?></strong>
                                customers
                            </div>
                            <div class="cl-pagination" id="clPagination"></div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <script>
            let clCurrentPage = 1;

            function clGetPerPage() {
                return parseInt(document.getElementById('clPerPage').value);
            }

            // ── Search ──
            function clSearchCustomers() {
                const query = document.getElementById('clSearchInput').value.toLowerCase().trim();
                const rows = document.querySelectorAll('.cl-data-row');
                let visibleCount = 0;

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const match = !query || text.includes(query);
                    row.style.display = match ? '' : 'none';
                    if (match) visibleCount++;
                });

                document.getElementById('clNoResults').style.display = visibleCount === 0 && query ? 'block' : 'none';
                document.getElementById('clToolbarCount').textContent = visibleCount;

                clCurrentPage = 1;
                clPaginate();
            }

            // ── Pagination ──
            function clResetPagination() {
                clCurrentPage = 1;
                clPaginate();
            }

            function clPaginate() {
                const perPage = clGetPerPage();
                const allRows = Array.from(document.querySelectorAll('.cl-data-row'));
                const rows = allRows.filter(r => r.style.display !== 'none' || r.dataset.filtered !== 'true');

                // Re-filter for search
                const query = document.getElementById('clSearchInput').value.toLowerCase().trim();
                const visibleRows = [];
                allRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const match = !query || text.includes(query);
                    if (match) visibleRows.push(row);
                });

                const total = visibleRows.length;
                const totalPages = Math.max(1, Math.ceil(total / perPage));

                if (clCurrentPage > totalPages) clCurrentPage = totalPages;

                const start = (clCurrentPage - 1) * perPage;
                const end = start + perPage;

                // Hide all first
                allRows.forEach(row => row.style.display = 'none');

                // Show only current page
                visibleRows.forEach((row, i) => {
                    row.style.display = (i >= start && i < end) ? '' : 'none';
                });

                // Update info
                const info = document.getElementById('clPaginationInfo');
                if (info) {
                    const showStart = total > 0 ? start + 1 : 0;
                    const showEnd = Math.min(end, total);
                    info.innerHTML = `Showing <strong>${showStart}</strong> to <strong>${showEnd}</strong> of <strong>${total}</strong> customers`;
                }

                // Build pagination buttons
                const pagDiv = document.getElementById('clPagination');
                if (!pagDiv) return;
                pagDiv.innerHTML = '';

                if (totalPages <= 1) return;

                // Prev
                const prevBtn = document.createElement('button');
                prevBtn.className = 'cl-page-btn' + (clCurrentPage === 1 ? ' disabled' : '');
                prevBtn.innerHTML = '<i class="fas fa-chevron-left" style="font-size:10px;"></i>';
                prevBtn.onclick = () => {
                    if (clCurrentPage > 1) {
                        clCurrentPage--;
                        clPaginate();
                    }
                };
                pagDiv.appendChild(prevBtn);

                // Page numbers
                for (let i = 1; i <= totalPages; i++) {
                    if (totalPages > 7 && i > 2 && i < totalPages - 1 && Math.abs(i - clCurrentPage) > 1) {
                        if (i === 3 || i === totalPages - 2) {
                            const ell = document.createElement('span');
                            ell.className = 'cl-page-btn disabled';
                            ell.textContent = '…';
                            ell.style.cursor = 'default';
                            pagDiv.appendChild(ell);
                        }
                        continue;
                    }
                    const btn = document.createElement('button');
                    btn.className = 'cl-page-btn' + (i === clCurrentPage ? ' active' : '');
                    btn.textContent = i;
                    btn.onclick = ((page) => () => {
                        clCurrentPage = page;
                        clPaginate();
                    })(i);
                    pagDiv.appendChild(btn);
                }

                // Next
                const nextBtn = document.createElement('button');
                nextBtn.className = 'cl-page-btn' + (clCurrentPage === totalPages ? ' disabled' : '');
                nextBtn.innerHTML = '<i class="fas fa-chevron-right" style="font-size:10px;"></i>';
                nextBtn.onclick = () => {
                    if (clCurrentPage < totalPages) {
                        clCurrentPage++;
                        clPaginate();
                    }
                };
                pagDiv.appendChild(nextBtn);
            }

            // ── Bulk Selection ──
            function clToggleSelectAll(el) {
                const checkboxes = document.querySelectorAll('.cl-row-checkbox');
                const visibleRows = Array.from(document.querySelectorAll('.cl-data-row')).filter(r => r.style.display !== 'none');
                visibleRows.forEach(row => {
                    const cb = row.querySelector('.cl-row-checkbox');
                    if (cb) cb.checked = el.checked;
                });
                clUpdateBulkBar();
            }

            function clUpdateBulkBar() {
                const checked = document.querySelectorAll('.cl-row-checkbox:checked').length;
                const bar = document.getElementById('clBulkBar');
                const count = document.getElementById('clSelectedCount');

                if (checked > 0) {
                    bar.classList.add('show');
                    count.textContent = checked;
                } else {
                    bar.classList.remove('show');
                }

                // Update select all checkbox
                const visibleRows = Array.from(document.querySelectorAll('.cl-data-row')).filter(r => r.style.display !== 'none');
                const visibleChecked = visibleRows.filter(r => {
                    const cb = r.querySelector('.cl-row-checkbox');
                    return cb && cb.checked;
                }).length;
                document.getElementById('clSelectAll').checked = visibleRows.length > 0 && visibleChecked === visibleRows.length;
            }

            function clClearSelection() {
                document.querySelectorAll('.cl-row-checkbox').forEach(cb => cb.checked = false);
                document.getElementById('clSelectAll').checked = false;
                clUpdateBulkBar();
            }

            // ── Init ──
            document.addEventListener('DOMContentLoaded', () => {
                clPaginate();
            });
        </script>
    </div>
</div>