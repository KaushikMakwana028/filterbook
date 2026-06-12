<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            /* ══════════════════════════════════════
   Color Fix — Match site primary color
══════════════════════════════════════ */
            .sv-toolbar-title i,
            .sv-toolbar-count,
            .sv-filter-tab.active,
            .sv-pagination-info {
                color: var(--primary, #6366f1) !important;
            }

            .sv-toolbar-count {
                background: rgba(99, 102, 241, 0.1) !important;
                color: var(--primary, #6366f1) !important;
            }

            .sv-filter-tab.active {
                color: var(--primary, #6366f1) !important;
            }

            .sv-add-btn {
                background: var(--primary, #6366f1) !important;
            }

            .sv-add-btn:hover {
                background: var(--primary-dark, #4f46e5) !important;
            }

            .sv-per-page select:focus,
            .sv-search input:focus {
                border-color: var(--primary-light, #818cf8) !important;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08) !important;
            }

            .sv-act-btn.view {
                background: rgba(99, 102, 241, 0.1) !important;
                color: var(--primary, #6366f1) !important;
            }

            .sv-act-btn.view:hover {
                background: rgba(99, 102, 241, 0.18) !important;
            }

            .sv-product-ico {
                background: rgba(99, 102, 241, 0.1) !important;
                color: var(--primary, #6366f1) !important;
            }

            .sv-page-btn.active {
                background: var(--primary, #6366f1) !important;
                border-color: var(--primary, #6366f1) !important;
            }

            .sv-page-btn:hover:not(.active):not(.disabled) {
                color: var(--primary, #6366f1) !important;
            }

            /* ══════════════════════════════════════
   DARK THEME — Services Page
══════════════════════════════════════ */
            [data-theme="dark"] .sv-card {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .sv-toolbar {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .sv-toolbar-title {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .sv-per-page {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-per-page select,
            [data-theme="dark"] .sv-search input {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .sv-search input::placeholder {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .sv-search .search-icon {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .sv-filter-tabs {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .sv-filter-tab {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .sv-filter-tab.active {
                background: var(--bg-secondary) !important;
                color: var(--primary) !important;
            }

            [data-theme="dark"] .sv-table th {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .sv-table td {
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .sv-table tbody tr:hover {
                background: var(--bg-tertiary) !important;
            }

            [data-theme="dark"] .sv-row-num {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-customer-name {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .sv-customer-mobile {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .sv-product-name {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-svc-num {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-date {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-date i {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .sv-pagination-wrap {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .sv-pagination-info strong {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .sv-page-btn {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-empty h4 {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .sv-empty p,
            [data-theme="dark"] .sv-no-results {
                color: var(--text-tertiary) !important;
            }

            .sv-wrap {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .sv-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 20px;
            }

            .sv-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
                gap: 14px;
                flex-wrap: wrap;
            }

            .sv-toolbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sv-toolbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 17px;
                font-weight: 700;
                color: #1e293b;
            }

            .sv-toolbar-title i {
                font-size: 20px;
                color: #7c3aed;
            }

            .sv-toolbar-count {
                background: #f3f0ff;
                color: #7c3aed;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .sv-toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            .sv-per-page {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: #64748b;
                font-weight: 500;
            }

            .sv-per-page select {
                padding: 7px 28px 7px 10px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                color: #1e293b;
                background: #f8fafc;
                cursor: pointer;
                outline: none;
                transition: all 0.15s ease;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 8px center;
            }

            .sv-per-page select:focus {
                border-color: #c4b5fd;
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
            }

            .sv-filter-tabs {
                display: flex;
                gap: 2px;
                background: #f1f5f9;
                border-radius: 8px;
                padding: 3px;
                border: 1px solid #e2e8f0;
            }

            .sv-filter-tab {
                padding: 6px 14px;
                border: none;
                background: transparent;
                border-radius: 6px;
                cursor: pointer;
                font-size: 12px;
                font-weight: 700;
                color: #94a3b8;
                font-family: inherit;
                transition: all 0.15s ease;
                white-space: nowrap;
            }

            .sv-filter-tab.active {
                background: #fff;
                color: #7c3aed;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            }

            .sv-filter-tab:hover:not(.active) {
                color: #64748b;
            }

            .sv-search {
                position: relative;
                min-width: 240px;
            }

            .sv-search input {
                width: 100%;
                padding: 8px 14px 8px 36px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                font-family: inherit;
                outline: none;
                background: #f8fafc;
                color: #1e293b;
                transition: all 0.15s ease;
            }

            .sv-search input::placeholder {
                color: #94a3b8;
            }

            .sv-search input:focus {
                border-color: #c4b5fd;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.08);
            }

            .sv-search .search-icon {
                position: absolute;
                left: 11px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 16px;
                pointer-events: none;
            }

            .sv-add-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                background: #7c3aed;
                color: #fff;
                border: none;
                cursor: pointer;
                transition: all 0.15s ease;
            }

            .sv-add-btn:hover {
                background: #6d28d9;
                color: #fff;
                text-decoration: none;
            }

            .sv-add-btn i {
                font-size: 16px;
            }

            .sv-table-wrap {
                overflow-x: auto;
            }

            .sv-table {
                width: 100%;
                border-collapse: collapse;
            }

            .sv-table th {
                background: #f8fafc;
                font-size: 11px;
                font-weight: 700;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                padding: 12px 16px;
                text-align: left;
                border-bottom: 1px solid #e2e8f0;
                white-space: nowrap;
            }

            .sv-table td {
                padding: 14px 16px;
                font-size: 13px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
                font-weight: 500;
                vertical-align: middle;
            }

            .sv-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .sv-table tbody tr:hover {
                background: #fafbfd;
            }

            .sv-row-num {
                width: 28px;
                height: 28px;
                border-radius: 6px;
                background: #f1f5f9;
                color: #64748b;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 700;
            }

            .sv-customer-cell {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sv-avatar {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
            }

            .sv-avatar.violet {
                background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            }

            .sv-avatar.teal {
                background: linear-gradient(135deg, #14b8a6, #0d9488);
            }

            .sv-avatar.rose {
                background: linear-gradient(135deg, #f43f5e, #e11d48);
            }

            .sv-avatar.amber {
                background: linear-gradient(135deg, #f59e0b, #d97706);
            }

            .sv-avatar.blue {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
            }

            .sv-avatar.emerald {
                background: linear-gradient(135deg, #10b981, #059669);
            }

            .sv-avatar.sky {
                background: linear-gradient(135deg, #0ea5e9, #0284c7);
            }

            .sv-avatar.pink {
                background: linear-gradient(135deg, #ec4899, #db2777);
            }

            .sv-customer-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 13px;
                display: block;
                margin-bottom: 1px;
            }

            .sv-customer-mobile {
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 3px;
            }

            .sv-customer-mobile i {
                font-size: 12px;
            }

            .sv-product-cell {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .sv-product-ico {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #f3f0ff;
                color: #7c3aed;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                flex-shrink: 0;
            }

            .sv-product-name {
                font-weight: 600;
                color: #334155;
                font-size: 13px;
            }

            .sv-svc-num {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
                background: #f1f5f9;
                color: #64748b;
            }

            .sv-svc-num i {
                font-size: 13px;
            }

            .sv-date {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 13px;
                color: #64748b;
                white-space: nowrap;
            }

            .sv-date i {
                font-size: 14px;
                color: #94a3b8;
            }

            .sv-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 12px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .sv-badge i {
                font-size: 13px;
            }

            .sv-badge.done {
                background: #ecfdf5;
                color: #059669;
            }

            .sv-badge.pending {
                background: #fffbeb;
                color: #d97706;
            }

            .sv-actions {
                display: flex;
                align-items: center;
                gap: 4px;
                justify-content: center;
            }

            .sv-act-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                font-size: 16px;
                transition: all 0.15s ease;
                border: none;
                cursor: pointer;
            }

            .sv-act-btn.view {
                background: #f3f0ff;
                color: #7c3aed;
            }

            .sv-act-btn.view:hover {
                background: #ede9fe;
            }

            .sv-empty {
                padding: 48px 20px;
                text-align: center;
            }

            .sv-empty i {
                font-size: 36px;
                color: #cbd5e1;
                margin-bottom: 10px;
                display: block;
            }

            .sv-empty h4 {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 600;
                color: #475569;
            }

            .sv-empty p {
                margin: 0;
                font-size: 13px;
                color: #94a3b8;
            }

            .sv-no-results {
                display: none;
                text-align: center;
                padding: 36px 20px;
                color: #94a3b8;
                font-size: 13px;
                font-weight: 500;
            }

            .sv-no-results i {
                font-size: 24px;
                display: block;
                margin-bottom: 6px;
                color: #cbd5e1;
            }

            .sv-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 20px;
                border-top: 1px solid #f1f5f9;
                gap: 12px;
                flex-wrap: wrap;
            }

            .sv-pagination-info {
                font-size: 13px;
                color: #7c3aed;
                font-weight: 500;
            }

            .sv-pagination-info strong {
                color: #1e293b;
                font-weight: 700;
            }

            .sv-pagination {
                display: flex;
                align-items: center;
                gap: 4px;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .sv-page-btn {
                min-width: 34px;
                height: 34px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #fff;
                color: #475569;
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: all 0.15s ease;
                text-decoration: none;
                padding: 0 4px;
            }

            .sv-page-btn:hover:not(.active):not(.disabled) {
                background: #f8fafc;
                border-color: #cbd5e1;
                color: #7c3aed;
            }

            .sv-page-btn.active {
                background: #7c3aed;
                color: #fff;
                border-color: #7c3aed;
            }

            .sv-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            .sv-page-btn.nav-btn {
                font-size: 16px;
                color: #64748b;
            }

            @media (max-width: 768px) {
                .sv-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 16px;
                    gap: 10px;
                }

                .sv-toolbar-left {
                    justify-content: space-between;
                }

                .sv-toolbar-right {
                    flex-direction: column;
                    gap: 8px;
                }

                .sv-search {
                    min-width: unset;
                    width: 100%;
                }

                .sv-filter-tabs {
                    width: 100%;
                }

                .sv-filter-tab {
                    flex: 1;
                    text-align: center;
                }

                .sv-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                .sv-per-page select {
                    flex: 1;
                    max-width: 120px;
                }

                .sv-add-btn {
                    width: 100%;
                    justify-content: center;
                }

                .sv-table-wrap {
                    overflow-x: auto;
                    overflow-y: hidden;
                    -webkit-overflow-scrolling: touch;
                }

                .sv-table {
                    min-width: 860px;
                }

                .sv-table th,
                .sv-table td {
                    padding: 12px 10px;
                    font-size: 12px;
                }

                .sv-table th {
                    font-size: 10px;
                }

                .sv-customer-cell {
                    gap: 8px;
                    min-width: 180px;
                }

                .sv-avatar {
                    width: 34px;
                    height: 34px;
                    border-radius: 9px;
                    font-size: 11px;
                }

                .sv-customer-name,
                .sv-product-name {
                    font-size: 12px;
                }

                .sv-customer-mobile,
                .sv-svc-num,
                .sv-date,
                .sv-badge {
                    font-size: 11px;
                }

                .sv-product-cell {
                    min-width: 150px;
                }

                .sv-product-ico {
                    width: 30px;
                    height: 30px;
                    border-radius: 8px;
                    font-size: 14px;
                }

                .sv-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }
            }

            @media (max-width: 480px) {
                .sv-wrap {
                    padding: 0 8px;
                }

                .sv-toolbar {
                    padding: 12px;
                }

                .sv-toolbar-title {
                    font-size: 15px;
                }

                .sv-toolbar-title i {
                    font-size: 18px;
                }

                .sv-toolbar-count {
                    font-size: 11px;
                    padding: 2px 8px;
                }
            }

            /* ── Card depth & background ── */
            .sv-wrap {
                padding: 0;
            }

            .sv-card {
                background: #fff !important;
                border-color: #e0e7ff !important;
                box-shadow: 0 4px 24px rgba(99, 102, 241, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04) !important;
                border-radius: 16px !important;
            }

            /* ── Toolbar background ── */
            .sv-toolbar {
                background: linear-gradient(90deg, #f5f3ff 0%, #eef2ff 100%) !important;
                border-bottom-color: #e0e7ff !important;
                border-radius: 16px 16px 0 0;
                padding: 14px 20px !important;
            }

            /* ── Title stronger ── */
            .sv-toolbar-title {
                font-size: 18px !important;
                background: linear-gradient(135deg, #6366f1, #7c3aed);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .sv-toolbar-title i {
                -webkit-text-fill-color: initial;
                background: none;
            }

            /* ── Count pill ── */
            .sv-toolbar-count {
                background: linear-gradient(135deg, #ede9fe, #eef2ff) !important;
                border: 1px solid #c7d2fe;
                font-size: 12px !important;
                border-radius: 8px !important;
            }

            /* ── Filter tabs ── */
            .sv-filter-tabs {
                background: rgba(255, 255, 255, 0.7) !important;
                border-color: #c7d2fe !important;
                border-radius: 10px !important;
                backdrop-filter: blur(4px);
            }

            .sv-filter-tab.active {
                background: linear-gradient(135deg, #6366f1, #7c3aed) !important;
                color: #fff !important;
                box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3) !important;
            }

            /* ── Search input ── */
            .sv-search input {
                background: rgba(255, 255, 255, 0.9) !important;
                border-color: #c7d2fe !important;
                border-radius: 10px !important;
            }

            .sv-search input:focus {
                background: #fff !important;
                border-color: #818cf8 !important;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
            }

            /* ── Per-page & month selects ── */
            .sv-per-page select {
                background: rgba(255, 255, 255, 0.9) !important;
                border-color: #c7d2fe !important;
                border-radius: 10px !important;
            }

            /* ── Add button ── */
            .sv-add-btn {
                background: linear-gradient(135deg, #6366f1, #7c3aed) !important;
                border-radius: 10px !important;
                box-shadow: 0 2px 10px rgba(99, 102, 241, 0.35) !important;
                padding: 9px 18px !important;
            }

            .sv-add-btn:hover {
                background: linear-gradient(135deg, #4f46e5, #6d28d9) !important;
                transform: translateY(-1px);
                box-shadow: 0 4px 16px rgba(99, 102, 241, 0.4) !important;
            }

            /* ── Table header ── */
            .sv-table th {
                background: linear-gradient(90deg, #eef2ff, #f5f3ff) !important;
                color: #6366f1 !important;
                border-bottom: 2px solid #e0e7ff !important;
                font-size: 10.5px !important;
                letter-spacing: 0.08em !important;
            }

            /* ── Row hover ── */
            .sv-table tbody tr:hover {
                background: linear-gradient(90deg, #f5f3ff 0%, #eef2ff 100%) !important;
            }

            .sv-table td {
                border-bottom-color: #f0f0ff !important;
            }

            /* ── Row number ── */
            .sv-row-num {
                background: linear-gradient(135deg, #ede9fe, #eef2ff) !important;
                color: #6366f1 !important;
                font-weight: 700 !important;
                border-radius: 8px !important;
            }

            /* ── Avatar shadow ── */
            .sv-avatar {
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            }

            /* ── Customer name ── */
            .sv-customer-name {
                color: #1e293b !important;
                font-size: 13.5px !important;
            }

            .sv-customer-mobile {
                color: #818cf8 !important;
            }

            .sv-customer-mobile i {
                color: #a5b4fc !important;
            }

            /* ── Product icon ── */
            .sv-product-ico {
                background: linear-gradient(135deg, #ede9fe, #eef2ff) !important;
                color: #6366f1 !important;
                border-radius: 10px !important;
                box-shadow: 0 1px 4px rgba(99, 102, 241, 0.15);
            }

            /* ── Service number ── */
            .sv-svc-num {
                background: linear-gradient(135deg, #eef2ff, #f5f3ff) !important;
                color: #6366f1 !important;
                border: 1px solid #e0e7ff;
                border-radius: 8px !important;
                font-weight: 700 !important;
            }

            /* ── Date ── */
            .sv-date {
                color: #4b5563 !important;
                font-weight: 600 !important;
            }

            .sv-date i {
                color: #818cf8 !important;
            }

            /* ── Badges ── */
            .sv-badge {
                border-radius: 8px !important;
                font-size: 12px !important;
                padding: 5px 12px !important;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
            }

            .sv-badge.pending {
                background: linear-gradient(135deg, #fef3c7, #fffbeb) !important;
                color: #b45309 !important;
                border: 1px solid #fde68a;
            }

            .sv-badge.done {
                background: linear-gradient(135deg, #d1fae5, #ecfdf5) !important;
                color: #065f46 !important;
                border: 1px solid #a7f3d0;
            }

            /* ── View action button ── */
            .sv-act-btn.view {
                background: linear-gradient(135deg, #ede9fe, #eef2ff) !important;
                color: #6366f1 !important;
                border: 1px solid #c7d2fe !important;
                border-radius: 10px !important;
                box-shadow: 0 1px 4px rgba(99, 102, 241, 0.1);
                transition: all 0.18s ease !important;
            }

            .sv-act-btn.view:hover {
                background: linear-gradient(135deg, #6366f1, #7c3aed) !important;
                color: #fff !important;
                border-color: transparent !important;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3) !important;
            }

            /* ── Pagination ── */
            .sv-pagination-wrap {
                background: linear-gradient(90deg, #f5f3ff, #eef2ff) !important;
                border-top-color: #e0e7ff !important;
            }

            .sv-pagination-info {
                color: #6b7280 !important;
                font-weight: 500 !important;
            }

            .sv-pagination-info strong {
                color: #6366f1 !important;
            }

            .sv-page-btn {
                border-radius: 8px !important;
                border-color: #e0e7ff !important;
            }

            .sv-page-btn.active {
                background: linear-gradient(135deg, #6366f1, #7c3aed) !important;
                border-color: transparent !important;
                box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3) !important;
            }

            .sv-page-btn:hover:not(.active):not(.disabled) {
                background: #ede9fe !important;
                border-color: #c7d2fe !important;
                color: #6366f1 !important;
            }

            /* ══ DARK THEME OVERRIDES ══ */
            [data-theme="dark"] .sv-card {
                border-color: rgba(99, 102, 241, 0.2) !important;
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3) !important;
            }

            [data-theme="dark"] .sv-toolbar {
                background: linear-gradient(90deg, rgba(99, 102, 241, 0.12), rgba(124, 58, 237, 0.08)) !important;
                border-bottom-color: rgba(99, 102, 241, 0.2) !important;
            }

            [data-theme="dark"] .sv-filter-tabs {
                background: rgba(255, 255, 255, 0.05) !important;
                border-color: rgba(99, 102, 241, 0.25) !important;
            }

            [data-theme="dark"] .sv-filter-tab.active {
                background: linear-gradient(135deg, #6366f1, #7c3aed) !important;
                color: #fff !important;
            }

            [data-theme="dark"] .sv-table th {
                background: linear-gradient(90deg, rgba(99, 102, 241, 0.12), rgba(124, 58, 237, 0.08)) !important;
                color: #818cf8 !important;
                border-bottom-color: rgba(99, 102, 241, 0.2) !important;
            }

            [data-theme="dark"] .sv-table tbody tr:hover {
                background: rgba(99, 102, 241, 0.08) !important;
            }

            [data-theme="dark"] .sv-table td {
                border-bottom-color: rgba(99, 102, 241, 0.08) !important;
            }

            [data-theme="dark"] .sv-row-num {
                background: rgba(99, 102, 241, 0.15) !important;
                color: #a5b4fc !important;
            }

            [data-theme="dark"] .sv-customer-mobile {
                color: #6366f1 !important;
            }

            [data-theme="dark"] .sv-svc-num {
                background: rgba(99, 102, 241, 0.15) !important;
                border-color: rgba(99, 102, 241, 0.25) !important;
                color: #a5b4fc !important;
            }

            [data-theme="dark"] .sv-date i {
                color: #6366f1 !important;
            }

            [data-theme="dark"] .sv-badge.pending {
                background: rgba(245, 158, 11, 0.15) !important;
                border-color: rgba(245, 158, 11, 0.3) !important;
                color: #fcd34d !important;
            }

            [data-theme="dark"] .sv-badge.done {
                background: rgba(16, 185, 129, 0.15) !important;
                border-color: rgba(16, 185, 129, 0.3) !important;
                color: #6ee7b7 !important;
            }

            [data-theme="dark"] .sv-act-btn.view {
                background: rgba(99, 102, 241, 0.15) !important;
                border-color: rgba(99, 102, 241, 0.3) !important;
                color: #a5b4fc !important;
            }

            [data-theme="dark"] .sv-act-btn.view:hover {
                background: linear-gradient(135deg, #6366f1, #7c3aed) !important;
                color: #fff !important;
            }

            [data-theme="dark"] .sv-pagination-wrap {
                background: linear-gradient(90deg, rgba(99, 102, 241, 0.08), rgba(124, 58, 237, 0.05)) !important;
                border-top-color: rgba(99, 102, 241, 0.2) !important;
            }

            [data-theme="dark"] .sv-pagination-info strong {
                color: #818cf8 !important;
            }

            [data-theme="dark"] .sv-page-btn {
                border-color: rgba(99, 102, 241, 0.2) !important;
            }

            [data-theme="dark"] .sv-page-btn:hover:not(.active):not(.disabled) {
                background: rgba(99, 102, 241, 0.15) !important;
                border-color: rgba(99, 102, 241, 0.35) !important;
            }
        </style>

        <?php
        $totalRows = !empty($services) ? count($services) : 0;
        $doneCount = 0;
        $pendingCount = 0;
        $currentMonth = (int) date('n');
        $monthOptions = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        if (!empty($services)) {
            foreach ($services as $s) {
                $isDone = ((string) ($s->status ?? 0) === '1' || strtolower((string) ($s->status ?? '')) === 'done');
                if ($isDone)
                    $doneCount++;
                else
                    $pendingCount++;
            }
        }
        $avatarColors = ['violet', 'teal', 'rose', 'amber', 'blue', 'emerald', 'sky', 'pink'];
        ?>

        <div class="sv-wrap">
            <div class="sv-card">
                <div class="sv-toolbar">
                    <div class="sv-toolbar-left">
                        <div class="sv-toolbar-title">
                            <i class="bx bx-wrench"></i> Services
                        </div>
                        <span class="sv-toolbar-count" id="svToolbarCount"><?= $totalRows ?> records</span>
                    </div>
                    <div class="sv-toolbar-right">
                        <div class="sv-per-page">
                            <span>Show</span>
                            <select id="svPerPage">
                                <option value="15" selected>15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="sv-per-page">
                            <span>Month</span>
                            <select id="svMonthFilter">
                                <?php foreach ($monthOptions as $monthNumber => $monthLabel): ?>
                                    <option value="<?= $monthNumber ?>" <?= $monthNumber === $currentMonth ? 'selected' : '' ?>>
                                        <?= $monthLabel ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="sv-filter-tabs" id="svFilterTabs">
                            <button class="sv-filter-tab active" data-filter="all">All (<?= $totalRows ?>)</button>
                            <button class="sv-filter-tab" data-filter="pending">Pending (<?= $pendingCount ?>)</button>
                            <button class="sv-filter-tab" data-filter="done">Done (<?= $doneCount ?>)</button>
                        </div>
                        <div class="sv-search">
                            <input type="text" id="svSearchInput" placeholder="Search name, mobile, product...">
                            <i class="bx bx-search search-icon"></i>
                        </div>
                        <a href="<?= site_url('admin/service/add') ?>" class="sv-add-btn">
                            <i class="bx bx-plus"></i> Add Service
                        </a>
                    </div>
                </div>

                <div class="sv-table-wrap" id="svTableView">
                    <table class="sv-table" id="svTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Service No.</th>
                                <th>Service Date</th>
                                <th>Status</th>
                                <th style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="svTableBody">
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $index => $s):
                                    $isDone = ((string) ($s->status ?? 0) === '1' || strtolower((string) ($s->status ?? '')) === 'done');
                                    $statusClass = $isDone ? 'done' : 'pending';
                                    $statusLabel = $isDone ? 'Done' : 'Pending';
                                    $monthValue = !empty($s->service_date) ? (int) date('n', strtotime($s->service_date)) : 0;
                                    $initials = strtoupper(substr(trim($s->customer_name ?? 'CU'), 0, 2));
                                    $colorClass = $avatarColors[$index % count($avatarColors)];
                                ?>
                                    <tr class="sv-data-row" data-status="<?= $statusClass ?>" data-month="<?= $monthValue ?>">
                                        <td><span class="sv-row-num"></span></td>
                                        <td>
                                            <div class="sv-customer-cell">
                                                <div class="sv-avatar <?= $colorClass ?>"><?= htmlspecialchars($initials) ?>
                                                </div>
                                                <div>
                                                    <span
                                                        class="sv-customer-name"><?= htmlspecialchars($s->customer_name ?? ('Customer #' . ($s->customer_id ?? ''))) ?></span>
                                                    <span class="sv-customer-mobile">
                                                        <i class="bx bx-phone"></i>
                                                        <?= htmlspecialchars($s->customer_mobile ?? '-') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sv-product-cell">
                                                <div class="sv-product-ico"><i class="bx bx-devices"></i></div>
                                                <span
                                                    class="sv-product-name"><?= htmlspecialchars($s->product_name ?? '-') ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="sv-svc-num">
                                                <i class="bx bx-hash"></i>
                                                <?= isset($s->service_number) ? (int) $s->service_number : '-' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="sv-date">
                                                <i class="bx bx-calendar"></i>
                                                <?= !empty($s->service_date) ? date('d M Y', strtotime($s->service_date)) : '—' ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="sv-badge <?= $statusClass ?>">
                                                <i class="bx <?= $isDone ? 'bx-check-circle' : 'bx-time-five' ?>"></i>
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="sv-actions">
                                                <a href="<?= site_url('admin/service/view/' . $s->id) ?>"
                                                    class="sv-act-btn view" title="View">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="sv-empty-row">
                                    <td colspan="7">
                                        <div class="sv-empty">
                                            <i class="bx bx-wrench"></i>
                                            <h4>No Services Found</h4>
                                            <p>Service records will appear here once services are scheduled.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="sv-no-results" id="svNoResults">
                    <i class="bx bx-search-alt"></i>
                    No services match your search or filter.
                </div>

                <div class="sv-pagination-wrap" id="svPaginationWrap" style="display:none;">
                    <div class="sv-pagination-info" id="svPaginationInfo"></div>
                    <div class="sv-pagination" id="svPagination"></div>
                </div>
            </div>
        </div>

        <script>
            (function() {
                let currentPage = 1;
                let currentFilter = 'all';
                let searchQuery = '';

                const allRows = Array.from(document.querySelectorAll('.sv-data-row'));
                const perPageSelect = document.getElementById('svPerPage');
                const monthFilterSelect = document.getElementById('svMonthFilter');
                const searchInput = document.getElementById('svSearchInput');
                const filterTabs = document.getElementById('svFilterTabs');
                const noResults = document.getElementById('svNoResults');
                const toolbarCount = document.getElementById('svToolbarCount');
                const paginationWrap = document.getElementById('svPaginationWrap');
                const paginationInfo = document.getElementById('svPaginationInfo');
                const paginationDiv = document.getElementById('svPagination');

                if (allRows.length === 0) return;

                function getPerPage() {
                    const val = perPageSelect.value;
                    return val === 'all' ? 99999 : parseInt(val);
                }

                function getFilteredRows() {
                    return allRows.filter(row => {
                        const status = row.getAttribute('data-status');
                        const rowMonth = row.getAttribute('data-month');
                        const text = row.textContent.toLowerCase();
                        const matchFilter = currentFilter === 'all' || status === currentFilter;
                        const matchMonth = !monthFilterSelect.value || rowMonth === monthFilterSelect.value;
                        const matchSearch = !searchQuery || text.includes(searchQuery);
                        return matchFilter && matchMonth && matchSearch;
                    });
                }

                function render() {
                    const filtered = getFilteredRows();
                    const perPage = getPerPage();
                    const total = filtered.length;
                    const totalPages = Math.max(1, Math.ceil(total / perPage));

                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    const start = (currentPage - 1) * perPage;
                    const end = Math.min(start + perPage, total);
                    const pageRows = filtered.slice(start, end);

                    // Hide all rows first
                    allRows.forEach(r => r.style.display = 'none');

                    // Show only current page rows and set row numbers
                    pageRows.forEach((row, i) => {
                        row.style.display = '';
                        row.querySelector('.sv-row-num').textContent = start + i + 1;
                    });

                    // Update count
                    toolbarCount.textContent = total + ' records';

                    // No results
                    noResults.style.display = total === 0 ? 'block' : 'none';
                    document.getElementById('svTableView').style.display = total === 0 ? 'none' : '';

                    // Pagination visibility
                    if (total > 0 && totalPages > 1) {
                        paginationWrap.style.display = '';
                    } else if (total > 0) {
                        paginationWrap.style.display = '';
                    } else {
                        paginationWrap.style.display = 'none';
                    }

                    // Pagination info
                    const showStart = total > 0 ? start + 1 : 0;
                    const showEnd = end;
                    paginationInfo.innerHTML = 'Showing <strong>' + showStart + '</strong> to <strong>' + showEnd + '</strong> of <strong>' + total + '</strong> services';

                    // Build pagination buttons
                    paginationDiv.innerHTML = '';

                    if (totalPages <= 1) return;

                    // Prev
                    addPageBtn('<i class="bx bx-chevron-left"></i>', currentPage > 1 ? currentPage - 1 : null, 'nav-btn');

                    // Page numbers
                    const maxVisible = 7;
                    let pages = [];

                    if (totalPages <= maxVisible) {
                        for (let i = 1; i <= totalPages; i++) pages.push(i);
                    } else {
                        pages.push(1);
                        if (currentPage > 3) pages.push('...');

                        let rangeStart = Math.max(2, currentPage - 1);
                        let rangeEnd = Math.min(totalPages - 1, currentPage + 1);

                        if (currentPage <= 3) {
                            rangeEnd = Math.min(4, totalPages - 1);
                        }
                        if (currentPage >= totalPages - 2) {
                            rangeStart = Math.max(totalPages - 3, 2);
                        }

                        for (let i = rangeStart; i <= rangeEnd; i++) pages.push(i);

                        if (currentPage < totalPages - 2) pages.push('...');
                        pages.push(totalPages);
                    }

                    pages.forEach(p => {
                        if (p === '...') {
                            const dots = document.createElement('span');
                            dots.className = 'sv-page-btn disabled';
                            dots.textContent = '...';
                            paginationDiv.appendChild(dots);
                        } else {
                            addPageBtn(p, p, p === currentPage ? 'active' : '');
                        }
                    });

                    // Next
                    addPageBtn('<i class="bx bx-chevron-right"></i>', currentPage < totalPages ? currentPage + 1 : null, 'nav-btn');
                }

                function addPageBtn(label, page, extraClass) {
                    const btn = document.createElement('button');
                    btn.className = 'sv-page-btn' + (extraClass ? ' ' + extraClass : '') + (!page ? ' disabled' : '');
                    btn.innerHTML = label;
                    if (page && extraClass !== 'active') {
                        btn.onclick = function() {
                            currentPage = page;
                            render();
                            // Scroll to top of table
                            document.querySelector('.sv-card').scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        };
                    }
                    paginationDiv.appendChild(btn);
                }

                // Events
                searchInput.addEventListener('input', function() {
                    searchQuery = this.value.toLowerCase().trim();
                    currentPage = 1;
                    render();
                });

                perPageSelect.addEventListener('change', function() {
                    currentPage = 1;
                    render();
                });

                monthFilterSelect.addEventListener('change', function() {
                    currentPage = 1;
                    render();
                });

                filterTabs.addEventListener('click', function(e) {
                    const tab = e.target.closest('.sv-filter-tab');
                    if (!tab) return;
                    filterTabs.querySelectorAll('.sv-filter-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    currentFilter = tab.getAttribute('data-filter');
                    currentPage = 1;
                    render();
                });

                // Keyboard nav
                document.addEventListener('keydown', function(e) {
                    if (document.activeElement === searchInput) return;
                    const filtered = getFilteredRows();
                    const perPage = getPerPage();
                    const totalPages = Math.max(1, Math.ceil(filtered.length / perPage));

                    if (e.key === 'ArrowLeft' && currentPage > 1) {
                        currentPage--;
                        render();
                    } else if (e.key === 'ArrowRight' && currentPage < totalPages) {
                        currentPage++;
                        render();
                    }
                });

                // Init
                render();
            })();
        </script>
    </div>
</div>