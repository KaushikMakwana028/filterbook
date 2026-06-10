<div class="page-wrapper">
    <div class="page-content">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

            :root {
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --primary-light: #eef2ff;
                --success: #10b981;
                --danger: #ef4444;
                --warning: #f59e0b;
                --info: #3b82f6;
                --gray-50: #f8fafc;
                --gray-100: #f1f5f9;
                --gray-200: #e2e8f0;
                --gray-300: #cbd5e1;
                --gray-400: #94a3b8;
                --gray-500: #64748b;
                --gray-600: #475569;
                --gray-700: #334155;
                --gray-800: #1e293b;
                --gray-900: #0f172a;
                --radius: 12px;
                --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
                --shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
                --transition: all 0.2s ease;
            }

            /* ══════════════════════════════
               BASE
            ══════════════════════════════ */
            .pd-wrap {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 20px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            * {
                box-sizing: border-box;
            }

            /* ══════════════════════════════
               BREADCRUMB
            ══════════════════════════════ */
            .pd-breadcrumb {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 24px;
                gap: 12px;
                flex-wrap: wrap;
            }

            .pd-breadcrumb-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .pd-breadcrumb-title {
                font-size: 20px;
                font-weight: 800;
                color: var(--gray-900);
            }

            .pd-breadcrumb-nav {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: var(--gray-400);
            }

            .pd-breadcrumb-nav a {
                color: var(--primary);
                text-decoration: none;
                display: flex;
                align-items: center;
            }

            .pd-breadcrumb-nav a:hover {
                color: var(--primary-dark);
            }

            .pd-breadcrumb-nav .sep {
                font-size: 16px;
            }

            .pd-breadcrumb-right {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .pd-btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: var(--transition);
                text-decoration: none;
                border: none;
                white-space: nowrap;
            }

            .pd-btn i {
                font-size: 16px;
            }

            .pd-btn-outline {
                background: #fff;
                color: var(--gray-600);
                border: 1px solid var(--gray-200);
            }

            .pd-btn-outline:hover {
                background: var(--gray-50);
                border-color: var(--gray-300);
                color: var(--gray-700);
            }

            .pd-btn-primary {
                background: var(--primary);
                color: #fff;
            }

            .pd-btn-primary:hover {
                background: var(--primary-dark);
                color: #fff;
                text-decoration: none;
            }

            /* ══════════════════════════════
               FLASH MESSAGES
            ══════════════════════════════ */
            .pd-alert {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 14px 18px;
                border-radius: 10px;
                margin-bottom: 16px;
                font-size: 13px;
                font-weight: 500;
            }

            .pd-alert i {
                font-size: 20px;
                flex-shrink: 0;
            }

            .pd-alert.success {
                background: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #065f46;
            }

            .pd-alert.success i {
                color: var(--success);
            }

            .pd-alert.error {
                background: #fef2f2;
                border: 1px solid #fecaca;
                color: #991b1b;
            }

            .pd-alert.error i {
                color: var(--danger);
            }

            .pd-alert .close-alert {
                margin-left: auto;
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
                opacity: 0.5;
                color: inherit;
                padding: 0;
            }

            .pd-alert .close-alert:hover {
                opacity: 1;
            }

            /* ══════════════════════════════
               MAIN CARD
            ══════════════════════════════ */
            .pd-card {
                background: #fff;
                border: 1px solid var(--gray-200);
                border-radius: var(--radius);
                overflow: hidden;
                margin-bottom: 24px;
            }

            /* ══════════════════════════════
               TOOLBAR
            ══════════════════════════════ */
            .pd-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 20px;
                border-bottom: 1px solid var(--gray-100);
                gap: 14px;
                flex-wrap: wrap;
            }

            .pd-toolbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .pd-toolbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 16px;
                font-weight: 700;
                color: var(--gray-800);
            }

            .pd-toolbar-title i {
                font-size: 20px;
                color: var(--primary);
            }

            .pd-toolbar-count {
                background: var(--primary-light);
                color: var(--primary);
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .pd-toolbar-right {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }

            /* ── Search ── */
            .pd-search {
                position: relative;
                min-width: 220px;
            }

            .pd-search input {
                width: 100%;
                padding: 8px 14px 8px 36px;
                border: 1px solid var(--gray-200);
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                font-family: inherit;
                outline: none;
                background: var(--gray-50);
                color: var(--gray-800);
                transition: var(--transition);
                box-sizing: border-box;
            }

            .pd-search input::placeholder {
                color: var(--gray-400);
            }

            .pd-search input:focus {
                border-color: #a5b4fc;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            .pd-search .search-icon {
                position: absolute;
                left: 11px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--gray-400);
                font-size: 16px;
                pointer-events: none;
            }

            .pd-search .search-clear {
                position: absolute;
                right: 8px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: var(--gray-400);
                font-size: 16px;
                cursor: pointer;
                padding: 0;
                display: none;
            }

            .pd-search .search-clear.show {
                display: block;
            }

            /* ── Per Page ── */
            .pd-per-page {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: var(--gray-500);
                font-weight: 500;
            }

            .pd-per-page select {
                padding: 7px 28px 7px 10px;
                border: 1px solid var(--gray-200);
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                color: var(--gray-800);
                background: var(--gray-50);
                cursor: pointer;
                outline: none;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 8px center;
                transition: var(--transition);
            }

            .pd-per-page select:focus {
                border-color: #a5b4fc;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
            }

            /* ── Filter Button ── */
            .pd-filter-btn {
                position: relative;
            }

            .pd-filter-dropdown {
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                right: 0;
                width: 280px;
                background: #fff;
                border: 1px solid var(--gray-200);
                border-radius: var(--radius);
                box-shadow: var(--shadow-lg);
                z-index: 100;
                padding: 16px;
            }

            .pd-filter-dropdown.show {
                display: block;
            }

            .pd-filter-dropdown h6 {
                font-size: 14px;
                font-weight: 700;
                color: var(--gray-800);
                margin: 0 0 12px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .pd-filter-group {
                margin-bottom: 12px;
            }

            .pd-filter-group label {
                display: block;
                font-size: 12px;
                font-weight: 600;
                color: var(--gray-600);
                margin-bottom: 4px;
            }

            .pd-filter-group select,
            .pd-filter-group input {
                width: 100%;
                padding: 7px 10px;
                border: 1px solid var(--gray-200);
                border-radius: 8px;
                font-size: 13px;
                font-family: inherit;
                color: var(--gray-800);
                outline: none;
                box-sizing: border-box;
            }

            .pd-filter-group select:focus,
            .pd-filter-group input:focus {
                border-color: #a5b4fc;
            }

            .pd-filter-price-row {
                display: flex;
                gap: 8px;
            }

            .pd-filter-actions {
                display: flex;
                gap: 8px;
                margin-top: 4px;
            }

            .pd-filter-actions .pd-btn {
                flex: 1;
                justify-content: center;
                padding: 7px 12px;
            }

            /* ── View Toggle ── */
            .pd-view-toggle {
                display: flex;
                border: 1px solid var(--gray-200);
                border-radius: 8px;
                overflow: hidden;
            }

            .pd-view-btn {
                padding: 7px 12px;
                background: #fff;
                border: none;
                color: var(--gray-400);
                font-size: 16px;
                cursor: pointer;
                transition: var(--transition);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .pd-view-btn:first-child {
                border-right: 1px solid var(--gray-200);
            }

            .pd-view-btn.active {
                background: var(--primary-light);
                color: var(--primary);
            }

            .pd-view-btn:hover:not(.active) {
                background: var(--gray-50);
                color: var(--gray-600);
            }

            /* ── Active Filters Bar ── */
            .pd-active-filters {
                display: none;
                padding: 10px 20px;
                border-bottom: 1px solid var(--gray-100);
                background: var(--gray-50);
            }

            .pd-active-filters.show {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }

            .pd-active-filters-label {
                font-size: 12px;
                font-weight: 600;
                color: var(--gray-500);
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .pd-filter-tag {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 3px 10px;
                background: var(--primary-light);
                color: var(--primary);
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
            }

            .pd-filter-tag button {
                background: none;
                border: none;
                color: var(--primary);
                cursor: pointer;
                padding: 0;
                font-size: 14px;
                display: flex;
                opacity: 0.6;
            }

            .pd-filter-tag button:hover {
                opacity: 1;
            }

            .pd-clear-filters {
                margin-left: auto;
                font-size: 12px;
                font-weight: 600;
                color: var(--danger);
                background: none;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .pd-clear-filters:hover {
                text-decoration: underline;
            }

            /* ── Bulk Actions Bar ── */
            .pd-bulk-bar {
                display: none;
                padding: 10px 20px;
                border-bottom: 1px solid var(--gray-100);
                background: #eef0ff;
            }

            .pd-bulk-bar.show {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .pd-bulk-count {
                background: var(--primary);
                color: #fff;
                padding: 4px 12px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            /* ══════════════════════════════
               TABLE VIEW
            ══════════════════════════════ */
            .pd-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .pd-table {
                width: 100%;
                border-collapse: collapse;
            }

            .pd-table th {
                background: var(--gray-50);
                font-size: 11px;
                font-weight: 700;
                color: var(--gray-500);
                text-transform: uppercase;
                letter-spacing: 0.06em;
                padding: 12px 14px;
                text-align: left;
                border-bottom: 2px solid var(--gray-200);
                white-space: nowrap;
                user-select: none;
            }

            .pd-table th.sortable {
                cursor: pointer;
                transition: var(--transition);
            }

            .pd-table th.sortable:hover {
                color: var(--primary);
            }

            .pd-th-content {
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .pd-sort-icon {
                font-size: 14px;
                color: var(--gray-300);
                transition: var(--transition);
            }

            .pd-table th.sortable:hover .pd-sort-icon {
                color: var(--primary);
            }

            .pd-table td {
                padding: 14px;
                font-size: 13px;
                color: var(--gray-700);
                border-bottom: 1px solid var(--gray-100);
                font-weight: 500;
                vertical-align: middle;
            }

            .pd-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .pd-table tbody tr {
                transition: var(--transition);
            }

            .pd-table tbody tr:hover {
                background: #fafaff;
            }

            .pd-table tbody tr.selected {
                background: #eef0ff !important;
            }

            /* ── Checkbox ── */
            .pd-check {
                position: relative;
                display: inline-flex;
            }

            .pd-check input {
                display: none;
            }

            .pd-check label {
                width: 20px;
                height: 20px;
                border: 2px solid var(--gray-300);
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: var(--transition);
                background: #fff;
            }

            .pd-check label:hover {
                border-color: var(--primary);
            }

            .pd-check input:checked+label {
                background: var(--primary);
                border-color: var(--primary);
            }

            .pd-check input:checked+label::after {
                content: '✓';
                color: #fff;
                font-size: 11px;
                font-weight: 700;
            }

            /* ── Row Number ── */
            .pd-row-num {
                width: 28px;
                height: 28px;
                border-radius: 6px;
                background: var(--gray-100);
                color: var(--gray-500);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: 700;
            }

            /* ── Product Cell ── */
            .pd-product-cell {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .pd-product-avatar {
                width: 42px;
                height: 42px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                font-weight: 800;
                flex-shrink: 0;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                background: hsl(var(--hue), 85%, 93%);
                color: hsl(var(--hue), 65%, 40%);
            }

            .pd-product-name {
                font-weight: 600;
                color: var(--gray-800);
                font-size: 14px;
                display: block;
                margin-bottom: 1px;
            }

            .pd-product-id {
                font-size: 11px;
                color: var(--gray-400);
            }

            /* ── Tags & Badges ── */
            .pd-category-tag {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                background: rgba(99, 102, 241, 0.08);
                color: var(--primary);
            }

            .pd-category-tag i {
                font-size: 13px;
            }

            .pd-user-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                background: var(--gray-100);
                color: var(--gray-600);
            }

            .pd-user-badge i {
                font-size: 13px;
                color: var(--gray-400);
            }

            .pd-brand-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 600;
                background: rgba(59, 130, 246, 0.08);
                color: var(--info);
            }

            .pd-brand-badge i {
                font-size: 13px;
            }

            .pd-unit-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .pd-unit-pcs {
                background: #fef3c7;
                color: #92400e;
            }

            .pd-unit-box {
                background: #dbeafe;
                color: #1e40af;
            }

            .pd-unit-liter {
                background: #d1fae5;
                color: #065f46;
            }

            .pd-unit-default {
                background: var(--gray-100);
                color: var(--gray-700);
            }

            .pd-qty-badge {
                display: inline-flex;
                align-items: center;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
                background: var(--gray-100);
                color: var(--gray-700);
            }

            /* ── Price ── */
            .pd-price {
                display: flex;
                align-items: baseline;
                gap: 2px;
            }

            .pd-price-sign {
                font-size: 12px;
                color: var(--success);
                font-weight: 600;
            }

            .pd-price-amount {
                font-size: 15px;
                font-weight: 700;
                color: var(--gray-800);
            }

            /* ── Actions ── */
            .pd-actions {
                display: flex;
                align-items: center;
                gap: 4px;
                justify-content: center;
            }

            .pd-act-btn {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                font-size: 16px;
                transition: var(--transition);
                border: none;
                cursor: pointer;
            }

            .pd-act-view {
                background: rgba(59, 130, 246, 0.08);
                color: var(--info);
            }

            .pd-act-view:hover {
                background: var(--info);
                color: #fff;
            }

            .pd-act-edit {
                background: #fef3c7;
                color: #b45309;
            }

            .pd-act-edit:hover {
                background: #fde68a;
            }

            .pd-act-delete {
                background: #fee2e2;
                color: var(--danger);
            }

            .pd-act-delete:hover {
                background: #fecaca;
            }

            /* ══════════════════════════════
               GRID VIEW
            ══════════════════════════════ */
            .pd-grid-container {
                display: none;
                padding: 16px;
            }

            .pd-grid-container.show {
                display: block;
            }

            .pd-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 16px;
            }

            .pd-grid-card {
                border: 1px solid var(--gray-200);
                border-radius: var(--radius);
                padding: 18px;
                background: #fff;
                transition: var(--transition);
                display: flex;
                flex-direction: column;
            }

            .pd-grid-card:hover {
                border-color: var(--primary);
                box-shadow: var(--shadow-md);
                transform: translateY(-2px);
            }

            .pd-grid-card-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 14px;
            }

            .pd-grid-avatar {
                width: 52px;
                height: 52px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 16px;
                background: hsl(var(--hue), 85%, 93%);
                color: hsl(var(--hue), 65%, 40%);
            }

            .pd-grid-card-actions {
                display: flex;
                gap: 4px;
            }

            .pd-grid-action-btn {
                width: 30px;
                height: 30px;
                border-radius: 8px;
                border: 1px solid var(--gray-200);
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                color: var(--gray-500);
                cursor: pointer;
                transition: var(--transition);
                text-decoration: none;
            }

            .pd-grid-action-btn:hover {
                border-color: var(--primary);
                color: var(--primary);
                background: var(--primary-light);
            }

            .pd-grid-action-btn.delete:hover {
                border-color: var(--danger);
                color: var(--danger);
                background: #fef2f2;
            }

            .pd-grid-card-body {
                flex: 1;
            }

            .pd-grid-card-title {
                font-weight: 700;
                font-size: 15px;
                color: var(--gray-800);
                margin: 0 0 8px;
            }

            .pd-grid-tags {
                display: flex;
                gap: 6px;
                flex-wrap: wrap;
                margin-bottom: 14px;
            }

            .pd-grid-card-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 14px;
                border-top: 1px solid var(--gray-100);
            }

            .pd-grid-price small {
                display: block;
                font-size: 11px;
                color: var(--gray-400);
                font-weight: 500;
            }

            .pd-grid-price-value {
                font-size: 18px;
                font-weight: 800;
                color: var(--success);
            }

            /* ══════════════════════════════
               MOBILE CARDS
            ══════════════════════════════ */
            .pd-mobile-cards {
                display: none;
                padding: 12px;
                gap: 10px;
                flex-direction: column;
            }

            .pd-mobile-card {
                background: #fff;
                border: 1px solid var(--gray-200);
                border-radius: 10px;
                padding: 14px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .pd-mobile-card-header {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .pd-mobile-avatar {
                width: 44px;
                height: 44px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
                font-weight: 800;
                flex-shrink: 0;
                text-transform: uppercase;
                background: hsl(var(--hue), 85%, 93%);
                color: hsl(var(--hue), 65%, 40%);
            }

            .pd-mobile-info {
                flex: 1;
                min-width: 0;
            }

            .pd-mobile-name {
                font-weight: 600;
                color: var(--gray-800);
                font-size: 14px;
                display: block;
                margin-bottom: 2px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .pd-mobile-id {
                font-size: 11px;
                color: var(--gray-400);
            }

            .pd-mobile-price {
                text-align: right;
            }

            .pd-mobile-price small {
                display: block;
                font-size: 10px;
                color: var(--gray-400);
            }

            .pd-mobile-price-value {
                font-size: 16px;
                font-weight: 800;
                color: var(--success);
            }

            .pd-mobile-meta {
                display: flex;
                align-items: center;
                gap: 6px;
                flex-wrap: wrap;
            }

            .pd-mobile-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-top: 10px;
                border-top: 1px solid var(--gray-100);
            }

            .pd-mobile-footer-left {
                display: flex;
                align-items: center;
                gap: 6px;
                flex-wrap: wrap;
            }

            .pd-mobile-footer .pd-actions {
                gap: 6px;
            }

            .pd-mobile-footer .pd-act-btn {
                width: 36px;
                height: 36px;
                font-size: 17px;
            }

            /* ══════════════════════════════
               EMPTY & NO RESULTS
            ══════════════════════════════ */
            .pd-empty {
                padding: 48px 20px;
                text-align: center;
            }

            .pd-empty-icon {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: var(--gray-50);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 16px;
            }

            .pd-empty-icon i {
                font-size: 36px;
                color: var(--gray-300);
            }

            .pd-empty h4 {
                margin: 0 0 4px;
                font-size: 16px;
                font-weight: 700;
                color: var(--gray-600);
            }

            .pd-empty p {
                margin: 0 0 16px;
                font-size: 13px;
                color: var(--gray-400);
            }

            .pd-no-results {
                display: none;
                text-align: center;
                padding: 36px 20px;
                color: var(--gray-400);
                font-size: 13px;
                font-weight: 500;
            }

            .pd-no-results i {
                font-size: 36px;
                display: block;
                margin-bottom: 8px;
                color: var(--gray-300);
            }

            /* ══════════════════════════════
               PAGINATION
            ══════════════════════════════ */
            .pd-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 20px;
                border-top: 1px solid var(--gray-100);
                gap: 12px;
                flex-wrap: wrap;
            }

            .pd-pagination-info {
                font-size: 13px;
                color: var(--gray-500);
                font-weight: 500;
            }

            .pd-pagination-info strong {
                color: var(--gray-800);
                font-weight: 700;
            }

            .pd-pagination {
                display: flex;
                align-items: center;
                gap: 4px;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .pd-page-btn {
                min-width: 34px;
                height: 34px;
                border: 1px solid var(--gray-200);
                border-radius: 8px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #fff;
                color: var(--gray-600);
                font-size: 13px;
                font-weight: 600;
                font-family: inherit;
                cursor: pointer;
                transition: var(--transition);
                padding: 0 4px;
            }

            .pd-page-btn:hover:not(.active):not(.disabled) {
                background: var(--gray-50);
                border-color: var(--gray-300);
                color: var(--primary);
            }

            .pd-page-btn.active {
                background: var(--primary);
                color: #fff;
                border-color: var(--primary);
            }

            .pd-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            /* ══════════════════════════════
               MODALS
            ══════════════════════════════ */
            .pd-modal-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 9999;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(4px);
                padding: 16px;
            }

            .pd-modal-overlay.show {
                display: flex;
            }

            .pd-modal {
                background: #fff;
                border-radius: 16px;
                max-width: 440px;
                width: 100%;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
                overflow: hidden;
            }

            /* ── View Modal ── */
            .pd-view-modal-header {
                padding: 20px 24px;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .pd-view-modal-header-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .pd-view-modal-header-icon {
                width: 42px;
                height: 42px;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                color: #fff;
            }

            .pd-view-modal-header h5 {
                margin: 0;
                color: #fff;
                font-size: 16px;
                font-weight: 700;
            }

            .pd-modal-close {
                background: rgba(255, 255, 255, 0.15);
                border: none;
                color: #fff;
                width: 32px;
                height: 32px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                cursor: pointer;
                transition: var(--transition);
            }

            .pd-modal-close:hover {
                background: rgba(255, 255, 255, 0.3);
            }

            .pd-view-modal-body {
                padding: 24px;
            }

            .pd-view-modal-product {
                text-align: center;
                margin-bottom: 20px;
            }

            .pd-view-modal-avatar {
                width: 72px;
                height: 72px;
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 800;
                font-size: 24px;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: #fff;
                margin: 0 auto 12px;
                box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            }

            .pd-view-modal-product h4 {
                margin: 0 0 4px;
                font-size: 18px;
                font-weight: 700;
                color: var(--gray-800);
            }

            .pd-view-modal-product .pd-product-id {
                font-size: 12px;
            }

            .pd-view-detail-list {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .pd-view-detail-row {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 14px;
                border-radius: 10px;
                background: var(--gray-50);
                transition: var(--transition);
            }

            .pd-view-detail-row:hover {
                background: var(--gray-100);
            }

            .pd-view-detail-icon {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                flex-shrink: 0;
            }

            .pd-view-detail-icon.purple {
                background: rgba(99, 102, 241, 0.1);
                color: var(--primary);
            }

            .pd-view-detail-icon.blue {
                background: rgba(59, 130, 246, 0.1);
                color: var(--info);
            }

            .pd-view-detail-icon.orange {
                background: rgba(245, 158, 11, 0.1);
                color: var(--warning);
            }

            .pd-view-detail-icon.green {
                background: rgba(16, 185, 129, 0.1);
                color: var(--success);
            }

            .pd-view-detail-label {
                display: block;
                font-size: 11px;
                color: var(--gray-400);
                font-weight: 500;
            }

            .pd-view-detail-value {
                font-size: 14px;
                font-weight: 600;
                color: var(--gray-800);
            }

            .pd-view-detail-value.price {
                font-size: 18px;
                font-weight: 800;
                color: var(--success);
            }

            .pd-view-modal-footer {
                padding: 16px 24px;
                border-top: 1px solid var(--gray-100);
                display: flex;
                gap: 8px;
                justify-content: flex-end;
            }

            /* ── Delete Modal ── */
            .pd-delete-modal .pd-modal {
                max-width: 380px;
                text-align: center;
            }

            .pd-delete-modal-body {
                padding: 32px 28px;
            }

            .pd-delete-icon {
                width: 72px;
                height: 72px;
                border-radius: 50%;
                background: #fef2f2;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 16px;
                animation: deletePulse 2s infinite;
            }

            .pd-delete-icon i {
                font-size: 32px;
                color: var(--danger);
            }

            @keyframes deletePulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.3);
                }

                70% {
                    box-shadow: 0 0 0 16px rgba(239, 68, 68, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
                }
            }

            .pd-delete-modal-body h4 {
                font-size: 17px;
                font-weight: 700;
                color: var(--gray-800);
                margin: 0 0 6px;
            }

            .pd-delete-modal-body p {
                font-size: 13px;
                color: var(--gray-500);
                margin: 0 0 4px;
            }

            .pd-delete-name {
                display: inline-block;
                padding: 4px 14px;
                background: #fef2f2;
                border: 1px solid #fecaca;
                border-radius: 6px;
                color: #b91c1c;
                font-weight: 700;
                font-size: 14px;
                margin: 8px 0 16px;
                word-break: break-word;
            }

            .pd-delete-modal-actions {
                display: flex;
                gap: 10px;
                justify-content: center;
            }

            .pd-btn-light {
                background: var(--gray-100);
                color: var(--gray-600);
                border: none;
            }

            .pd-btn-light:hover {
                background: var(--gray-200);
            }

            .pd-btn-danger {
                background: var(--danger);
                color: #fff;
                border: none;
            }

            .pd-btn-danger:hover {
                background: #dc2626;
                color: #fff;
                text-decoration: none;
            }

            /* ══════════════════════════════
               RESPONSIVE
            ══════════════════════════════ */
            @media (max-width: 1024px) {
                .pd-grid {
                    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                }
            }

            @media (max-width: 768px) {
                .pd-wrap {
                    padding: 0 12px;
                }

                .pd-breadcrumb {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 10px;
                    margin-bottom: 16px;
                }

                .pd-breadcrumb-right {
                    width: 100%;
                }

                .pd-breadcrumb-right .pd-btn {
                    flex: 1;
                    justify-content: center;
                }

                .pd-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 16px;
                    gap: 10px;
                }

                .pd-toolbar-left {
                    justify-content: space-between;
                }

                .pd-toolbar-right {
                    flex-direction: column;
                    gap: 8px;
                }

                .pd-search {
                    min-width: unset;
                    width: 100%;
                }

                .pd-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                .pd-per-page select {
                    flex: 1;
                    max-width: 120px;
                }

                .pd-toolbar-actions-row {
                    display: flex;
                    gap: 8px;
                    width: 100%;
                }

                .pd-toolbar-actions-row .pd-btn,
                .pd-toolbar-actions-row .pd-filter-btn {
                    flex: 1;
                }

                .pd-toolbar-actions-row .pd-btn {
                    justify-content: center;
                }

                .pd-table-wrap {
                    display: block !important;
                    overflow-x: auto;
                    overflow-y: hidden;
                    -webkit-overflow-scrolling: touch;
                }

                .pd-table {
                    min-width: 1080px;
                }

                .pd-table th,
                .pd-table td {
                    padding: 12px 10px;
                    font-size: 12px;
                }

                .pd-table th {
                    font-size: 10px;
                }

                .pd-product-cell {
                    gap: 10px;
                    min-width: 210px;
                }

                .pd-product-avatar {
                    width: 38px;
                    height: 38px;
                    border-radius: 10px;
                    font-size: 12px;
                }

                .pd-product-name {
                    font-size: 13px;
                }

                .pd-product-id,
                .pd-category-tag,
                .pd-user-badge,
                .pd-brand-badge,
                .pd-unit-badge,
                .pd-qty-badge {
                    font-size: 11px;
                }

                .pd-category-tag,
                .pd-user-badge,
                .pd-brand-badge,
                .pd-unit-badge,
                .pd-qty-badge {
                    padding: 4px 8px;
                    white-space: nowrap;
                }

                .pd-price-amount {
                    font-size: 14px;
                }

                .pd-actions {
                    gap: 4px;
                }

                .pd-act-btn {
                    width: 30px;
                    height: 30px;
                    font-size: 15px;
                }

                .pd-grid-container {
                    display: none !important;
                }

                .pd-grid-container.show {
                    display: none !important;
                }

                .pd-view-toggle {
                    display: none;
                }

                .pd-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    padding: 12px 16px;
                }

                .pd-pagination {
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .pd-page-btn {
                    min-width: 32px;
                    height: 32px;
                    font-size: 12px;
                }

                .pd-modal {
                    margin: 16px;
                }

                .pd-view-modal-footer {
                    flex-direction: column;
                }

                .pd-view-modal-footer .pd-btn {
                    width: 100%;
                    justify-content: center;
                }

                .pd-delete-modal-actions {
                    flex-direction: column;
                }

                .pd-delete-modal-actions .pd-btn {
                    width: 100%;
                    justify-content: center;
                }

                .pd-filter-dropdown {
                    position: fixed;
                    top: auto;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    width: 100%;
                    border-radius: 16px 16px 0 0;
                    max-height: 80vh;
                    overflow-y: auto;
                    padding: 20px;
                }

                .pd-active-filters.show {
                    padding: 10px 16px;
                }

                .pd-bulk-bar.show {
                    padding: 10px 16px;
                }
            }

            @media (max-width: 480px) {
                .pd-wrap {
                    padding: 0 8px;
                }

                .pd-breadcrumb-title {
                    font-size: 17px;
                }

                .pd-toolbar {
                    padding: 12px;
                }

                .pd-toolbar-title {
                    font-size: 15px;
                }

                .pd-toolbar-title i {
                    font-size: 18px;
                }

                .pd-toolbar-count {
                    font-size: 11px;
                    padding: 2px 8px;
                }

                .pd-mobile-cards {
                    display: none !important;
                }

                .pd-view-modal-body {
                    padding: 20px 16px;
                }

                .pd-view-modal-avatar {
                    width: 60px;
                    height: 60px;
                    font-size: 20px;
                }

                .pd-delete-modal-body {
                    padding: 24px 20px;
                }
            }

            @media (max-width: 360px) {
                .pd-breadcrumb-right {
                    flex-direction: column;
                }

                .pd-mobile-meta {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }

            /* ══════════════════════════════
               FILTER OVERLAY (Mobile)
            ══════════════════════════════ */
            .pd-filter-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.3);
                z-index: 99;
            }

            .pd-filter-overlay.show {
                display: block;
            }
        </style>

        <?php
        $totalProducts = !empty($products) ? count($products) : 0;
        ?>

        <div class="pd-wrap">

            <!-- ═══════ Breadcrumb ═══════ -->
            <div class="pd-breadcrumb">
                <div class="pd-breadcrumb-left">
                    <span class="pd-breadcrumb-title">Products</span>
                    <div class="pd-breadcrumb-nav">
                        <a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="bx bx-home-alt"></i></a>
                        <span class="sep"><i class="bx bx-chevron-right"></i></span>
                        <span>Product List</span>
                    </div>
                </div>
                <div class="pd-breadcrumb-right">
                    <button class="pd-btn pd-btn-outline" id="pdRefreshBtn">
                        <i class="bx bx-refresh"></i> Refresh
                    </button>
                    <a href="<?= base_url('index.php/admin/product/add') ?>" class="pd-btn pd-btn-primary">
                        <i class="bx bx-plus"></i> Add Product
                    </a>
                </div>
            </div>

            <!-- ═══════ Flash Messages ═══════ -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="pd-alert success">
                    <i class="bx bx-check-circle"></i>
                    <span><?= $this->session->flashdata('success') ?></span>
                    <button class="close-alert" onclick="this.parentElement.remove()"><i class="bx bx-x"></i></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="pd-alert error">
                    <i class="bx bx-error-circle"></i>
                    <span><?= $this->session->flashdata('error') ?></span>
                    <button class="close-alert" onclick="this.parentElement.remove()"><i class="bx bx-x"></i></button>
                </div>
            <?php endif; ?>

            <!-- ═══════ Main Card ═══════ -->
            <div class="pd-card">

                <!-- Toolbar -->
                <div class="pd-toolbar">
                    <div class="pd-toolbar-left">
                        <div class="pd-toolbar-title">
                            <i class="bx bx-package"></i> All Products
                        </div>
                        <span class="pd-toolbar-count"><?= $totalProducts ?> records</span>
                    </div>
                    <div class="pd-toolbar-right">
                        <div class="pd-per-page">
                            <span>Show</span>
                            <select id="pdPerPage">
                                <option value="10">10</option>
                                <option value="25" selected>25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="pd-search">
                            <input type="text" id="pdSearchInput" placeholder="Search products...">
                            <i class="bx bx-search search-icon"></i>
                            <button class="search-clear" id="pdSearchClear"><i class="bx bx-x"></i></button>
                        </div>
                        <div class="pd-toolbar-actions-row">
                            <!-- <div class="pd-filter-btn" style="position:relative;">
                                <button class="pd-btn pd-btn-outline" id="pdFilterToggle">
                                    <i class="bx bx-filter-alt"></i> Filter
                                </button>
                                <div class="pd-filter-dropdown" id="pdFilterDropdown">
                                    <h6><i class="bx bx-filter"></i> Filter Products</h6>
                                    <div class="pd-filter-group">
                                        <label>Category</label>
                                        <select id="pdFilterCategory">
                                            <option value="">All Categories</option>
                                            <?php
                                            $uniqueCats = [];
                                            if (!empty($products)) {
                                                foreach ($products as $p) {
                                                    if (!in_array($p->category_name, $uniqueCats)) {
                                                        $uniqueCats[] = $p->category_name;
                                                        echo '<option value="' . strtolower($p->category_name) . '">' . htmlspecialchars($p->category_name) . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="pd-filter-group">
                                        <label>Unit</label>
                                        <select id="pdFilterUnit">
                                            <option value="">All Units</option>
                                            <option value="pcs">PCS</option>
                                            <option value="box">BOX</option>
                                            <option value="liter">LITER</option>
                                        </select>
                                    </div>
                                    <div class="pd-filter-group">
                                        <label>Price Range</label>
                                        <div class="pd-filter-price-row">
                                            <input type="number" id="pdPriceMin" placeholder="Min">
                                            <input type="number" id="pdPriceMax" placeholder="Max">
                                        </div>
                                    </div>
                                    <div class="pd-filter-actions">
                                        <button class="pd-btn pd-btn-outline" id="pdClearFilters">
                                            <i class="bx bx-reset"></i> Clear
                                        </button>
                                        <button class="pd-btn pd-btn-primary" id="pdApplyFilters">
                                            <i class="bx bx-check"></i> Apply
                                        </button>
                                    </div>
                                </div>
                            </div> -->
                            <div class="pd-view-toggle">
                                <button class="pd-view-btn active" id="pdTableViewBtn" title="Table View">
                                    <i class="bx bx-list-ul"></i>
                                </button>
                                <button class="pd-view-btn" id="pdGridViewBtn" title="Grid View">
                                    <i class="bx bx-grid-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters Bar -->
                <div class="pd-active-filters" id="pdActiveFilters">
                    <span class="pd-active-filters-label"><i class="bx bx-filter"></i> Filters:</span>
                    <div id="pdFilterTags"></div>
                    <button class="pd-clear-filters" id="pdClearAllFilters">
                        <i class="bx bx-x"></i> Clear All
                    </button>
                </div>

                <!-- Bulk Actions Bar -->
                <div class="pd-bulk-bar" id="pdBulkBar">
                    <span class="pd-bulk-count" id="pdSelectedCount">0 selected</span>
                    <button class="pd-btn pd-btn-outline" style="color:var(--danger);border-color:var(--danger);"
                        id="pdBulkDelete">
                        <i class="bx bx-trash"></i> Delete Selected
                    </button>
                </div>

                <!-- ═══════ TABLE VIEW ═══════ -->
                <div class="pd-table-wrap" id="pdTableView">
                    <table class="pd-table" id="pdTable">
                        <thead>
                            <tr>
                                <th style="width:40px;padding-left:16px;">
                                    <div class="pd-check">
                                        <input type="checkbox" id="pdSelectAll">
                                        <label for="pdSelectAll"></label>
                                    </div>
                                </th>
                                <th style="width:50px;" class="sortable" data-sort="id">
                                    <div class="pd-th-content">
                                        # <i class="bx bx-sort-alt-2 pd-sort-icon"></i>
                                    </div>
                                </th>
                                <th class="sortable" data-sort="name">
                                    <div class="pd-th-content">
                                        Product <i class="bx bx-sort-alt-2 pd-sort-icon"></i>
                                    </div>
                                </th>
                                <th class="sortable" data-sort="category">
                                    <div class="pd-th-content">
                                        Category <i class="bx bx-sort-alt-2 pd-sort-icon"></i>
                                    </div>
                                </th>
                                <th>Added By</th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <th>Qty</th>
                                <th class="sortable" data-sort="price">
                                    <div class="pd-th-content">
                                        Price <i class="bx bx-sort-alt-2 pd-sort-icon"></i>
                                    </div>
                                </th>
                                <th style="width:120px;text-align:center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="pdTableBody">
                            <?php if (!empty($products)): ?>
                                <?php $i = 1;
                                foreach ($products as $row):
                                    $hue = ($row->id * 47) % 360;
                                    $initials = strtoupper(substr($row->name, 0, 2));
                                    $unitLower = strtolower($row->unit ?? '');
                                    $unitClass = in_array($unitLower, ['pcs', 'box', 'liter']) ? 'pd-unit-' . $unitLower : 'pd-unit-default';
                                    $unitIcons = ['pcs' => '📦', 'box' => '📋', 'liter' => '🧴'];
                                    $unitIcon = $unitIcons[$unitLower] ?? '📦';
                                    $displayPrice = $row->sell_price !== null ? (float) $row->sell_price : (float) $row->purchase_price;
                                    ?>
                                    <tr class="pd-data-row" data-id="<?= $row->id ?>" data-name="<?= strtolower($row->name) ?>"
                                        data-category="<?= strtolower($row->category_name) ?>"
                                        data-brand="<?= strtolower($row->brand ?? '') ?>" data-unit="<?= $unitLower ?>"
                                        data-price="<?= $displayPrice ?>">

                                        <td style="padding-left:16px;">
                                            <div class="pd-check">
                                                <input type="checkbox" class="pd-row-check" id="pdCheck<?= $row->id ?>"
                                                    value="<?= $row->id ?>">
                                                <label for="pdCheck<?= $row->id ?>"></label>
                                            </div>
                                        </td>

                                        <td><span class="pd-row-num"><?= $i++ ?></span></td>

                                        <td>
                                            <div class="pd-product-cell">
                                                <div class="pd-product-avatar" style="--hue:<?= $hue ?>">
                                                    <?= $initials ?>
                                                </div>
                                                <div>
                                                    <span class="pd-product-name"><?= htmlspecialchars($row->name) ?></span>
                                                    <span class="pd-product-id">ID:
                                                        #<?= str_pad($row->id, 4, '0', STR_PAD_LEFT) ?></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="pd-category-tag">
                                                <i class="bx bx-folder"></i>
                                                <?= htmlspecialchars($row->category_name) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="pd-user-badge">
                                                <i class="bx bx-user"></i>
                                                <?= $row->user_name ? htmlspecialchars($row->user_name) : 'Unknown' ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="pd-brand-badge">
                                                <i class="bx bx-store"></i>
                                                <?= $row->brand ? htmlspecialchars($row->brand) : '—' ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="pd-unit-badge <?= $unitClass ?>">
                                                <?= $unitIcon ?>         <?= strtoupper($row->unit) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="pd-qty-badge"><?= $row->quantity ?></span>
                                        </td>

                                        <td>
                                            <div class="pd-price">
                                                <span
                                                    class="pd-price-amount"><?= number_format($displayPrice, 2) ?></span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="pd-actions">
                                                <button class="pd-act-btn pd-act-view pd-view-trigger" title="View"
                                                    data-id="<?= $row->id ?>" data-name="<?= htmlspecialchars($row->name) ?>"
                                                    data-category="<?= htmlspecialchars($row->category_name) ?>"
                                                    data-brand="<?= htmlspecialchars($row->brand ?? '') ?>"
                                                    data-unit="<?= strtoupper($row->unit) ?>"
                                                    data-price="<?= number_format($displayPrice, 2) ?>"
                                                    data-purchase-price="<?= number_format((float) $row->purchase_price, 2) ?>"
                                                    data-sell-price="<?= $row->sell_price !== null ? number_format((float) $row->sell_price, 2) : '' ?>"
                                                    data-qty="<?= $row->quantity ?>"
                                                    data-user="<?= htmlspecialchars($row->user_name ?? 'Unknown') ?>">
                                                    <i class="bx bx-show"></i>
                                                </button>
                                                <a href="<?= base_url('index.php/admin/product/edit/' . $row->id) ?>"
                                                    class="pd-act-btn pd-act-edit" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <button class="pd-act-btn pd-act-delete pd-delete-trigger" title="Delete"
                                                    data-id="<?= $row->id ?>" data-name="<?= htmlspecialchars($row->name) ?>">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="pd-empty">
                                            <div class="pd-empty-icon"><i class="bx bx-package"></i></div>
                                            <h4>No Products Found</h4>
                                            <p>Get started by adding your first product.</p>
                                            <a href="<?= base_url('index.php/admin/product/add') ?>"
                                                class="pd-btn pd-btn-primary">
                                                <i class="bx bx-plus"></i> Add Product
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- ═══════ GRID VIEW ═══════ -->
                <div class="pd-grid-container" id="pdGridView">
                    <div class="pd-grid" id="pdGridContent">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $row):
                                $hue = ($row->id * 47) % 360;
                                $initials = strtoupper(substr($row->name, 0, 2));
                                $unitLower = strtolower($row->unit ?? '');
                                $unitClass = in_array($unitLower, ['pcs', 'box', 'liter']) ? 'pd-unit-' . $unitLower : 'pd-unit-default';
                                $displayPrice = $row->sell_price !== null ? (float) $row->sell_price : (float) $row->purchase_price;
                                ?>
                                <div class="pd-grid-item" data-name="<?= strtolower($row->name) ?>"
                                    data-category="<?= strtolower($row->category_name) ?>" data-unit="<?= $unitLower ?>"
                                    data-price="<?= $displayPrice ?>">
                                    <div class="pd-grid-card">
                                        <div class="pd-grid-card-header">
                                            <div class="pd-grid-avatar" style="--hue:<?= $hue ?>">
                                                <?= $initials ?>
                                            </div>
                                            <div class="pd-grid-card-actions">
                                                <a href="<?= base_url('index.php/admin/product/edit/' . $row->id) ?>"
                                                    class="pd-grid-action-btn" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <button class="pd-grid-action-btn delete pd-delete-trigger"
                                                    data-id="<?= $row->id ?>" data-name="<?= htmlspecialchars($row->name) ?>"
                                                    title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="pd-grid-card-body">
                                            <h6 class="pd-grid-card-title"><?= htmlspecialchars($row->name) ?></h6>
                                            <div class="pd-grid-tags">
                                                <span
                                                    class="pd-category-tag"><?= htmlspecialchars($row->category_name) ?></span>
                                                <span
                                                    class="pd-unit-badge <?= $unitClass ?>"><?= strtoupper($row->unit) ?></span>
                                            </div>
                                        </div>
                                        <div class="pd-grid-card-footer">
                                            <div class="pd-grid-price">
                                                <small>Price</small>
                                                <span
                                                    class="pd-grid-price-value">$<?= number_format($displayPrice, 2) ?></span>
                                            </div>
                                            <span class="pd-qty-badge"><?= $row->quantity ?> qty</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ═══════ MOBILE CARDS ═══════ -->
                <div class="pd-mobile-cards" id="pdMobileCards">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $row):
                            $hue = ($row->id * 47) % 360;
                            $initials = strtoupper(substr($row->name, 0, 2));
                            $unitLower = strtolower($row->unit ?? '');
                            $unitClass = in_array($unitLower, ['pcs', 'box', 'liter']) ? 'pd-unit-' . $unitLower : 'pd-unit-default';
                            $displayPrice = $row->sell_price !== null ? (float) $row->sell_price : (float) $row->purchase_price;
                            ?>
                            <div class="pd-mobile-card pd-data-row-mobile" data-name="<?= strtolower($row->name) ?>"
                                data-category="<?= strtolower($row->category_name) ?>"
                                data-brand="<?= strtolower($row->brand ?? '') ?>" data-unit="<?= $unitLower ?>"
                                data-price="<?= $displayPrice ?>">
                                <div class="pd-mobile-card-header">
                                    <div class="pd-mobile-avatar" style="--hue:<?= $hue ?>">
                                        <?= $initials ?>
                                    </div>
                                    <div class="pd-mobile-info">
                                        <span class="pd-mobile-name"><?= htmlspecialchars($row->name) ?></span>
                                        <span class="pd-mobile-id">ID:
                                            #<?= str_pad($row->id, 4, '0', STR_PAD_LEFT) ?></span>
                                    </div>
                                    <div class="pd-mobile-price">
                                        <small>Price</small>
                                        <span
                                            class="pd-mobile-price-value">$<?= number_format($displayPrice, 2) ?></span>
                                    </div>
                                </div>
                                <div class="pd-mobile-meta">
                                    <span class="pd-category-tag">
                                        <i class="bx bx-folder"></i> <?= htmlspecialchars($row->category_name) ?>
                                    </span>
                                    <span class="pd-unit-badge <?= $unitClass ?>">
                                        <?= strtoupper($row->unit) ?>
                                    </span>
                                    <span class="pd-qty-badge"><?= $row->quantity ?> qty</span>
                                </div>
                                <div class="pd-mobile-footer">
                                    <div class="pd-mobile-footer-left">
                                        <span class="pd-user-badge">
                                            <i class="bx bx-user"></i>
                                            <?= $row->user_name ? htmlspecialchars($row->user_name) : 'Unknown' ?>
                                        </span>
                                        <?php if ($row->brand): ?>
                                            <span class="pd-brand-badge">
                                                <i class="bx bx-store"></i> <?= htmlspecialchars($row->brand) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pd-actions">
                                        <button class="pd-act-btn pd-act-view pd-view-trigger" title="View"
                                            data-id="<?= $row->id ?>" data-name="<?= htmlspecialchars($row->name) ?>"
                                            data-category="<?= htmlspecialchars($row->category_name) ?>"
                                            data-brand="<?= htmlspecialchars($row->brand ?? '') ?>"
                                            data-unit="<?= strtoupper($row->unit) ?>"
                                            data-price="<?= number_format($displayPrice, 2) ?>"
                                            data-purchase-price="<?= number_format((float) $row->purchase_price, 2) ?>"
                                            data-sell-price="<?= $row->sell_price !== null ? number_format((float) $row->sell_price, 2) : '' ?>"
                                            data-qty="<?= $row->quantity ?>"
                                            data-user="<?= htmlspecialchars($row->user_name ?? 'Unknown') ?>">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <a href="<?= base_url('index.php/admin/product/edit/' . $row->id) ?>"
                                            class="pd-act-btn pd-act-edit" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <button class="pd-act-btn pd-act-delete pd-delete-trigger" title="Delete"
                                            data-id="<?= $row->id ?>" data-name="<?= htmlspecialchars($row->name) ?>">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="pd-empty">
                            <div class="pd-empty-icon"><i class="bx bx-package"></i></div>
                            <h4>No Products Found</h4>
                            <p>Get started by adding your first product.</p>
                            <a href="<?= base_url('index.php/admin/product/add') ?>" class="pd-btn pd-btn-primary">
                                <i class="bx bx-plus"></i> Add Product
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- No Results -->
                <div class="pd-no-results" id="pdNoResults">
                    <i class="bx bx-search-alt"></i>
                    <p>No matching products found.<br>Try different search terms or filters.</p>
                </div>

                <!-- Pagination -->
                <div class="pd-pagination-wrap" id="pdPaginationWrap">
                    <div class="pd-pagination-info" id="pdPaginationInfo">
                        Showing <strong><?= $totalProducts ?></strong> products
                    </div>
                    <div class="pd-pagination" id="pdPagination">
                        <button class="pd-page-btn disabled"><i class="bx bx-chevrons-left"></i></button>
                        <button class="pd-page-btn disabled"><i class="bx bx-chevron-left"></i></button>
                        <button class="pd-page-btn active">1</button>
                        <button class="pd-page-btn disabled"><i class="bx bx-chevron-right"></i></button>
                        <button class="pd-page-btn disabled"><i class="bx bx-chevrons-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════ VIEW MODAL ═══════ -->
        <div class="pd-modal-overlay" id="pdViewModal">
            <div class="pd-modal">
                <div class="pd-view-modal-header">
                    <div class="pd-view-modal-header-left">
                        <div class="pd-view-modal-header-icon"><i class="bx bx-show"></i></div>
                        <h5>Product Details</h5>
                    </div>
                    <button class="pd-modal-close" onclick="pdCloseViewModal()"><i class="bx bx-x"></i></button>
                </div>
                <div class="pd-view-modal-body">
                    <div class="pd-view-modal-product">
                        <div class="pd-view-modal-avatar" id="pdViewAvatar">PR</div>
                        <h4 id="pdViewName">Product Name</h4>
                        <span class="pd-product-id">ID: #<span id="pdViewId">0000</span></span>
                    </div>
                    <div class="pd-view-detail-list">
                        <div class="pd-view-detail-row">
                            <div class="pd-view-detail-icon purple"><i class="bx bx-category"></i></div>
                            <div>
                                <span class="pd-view-detail-label">Category</span>
                                <span class="pd-view-detail-value" id="pdViewCategory">—</span>
                            </div>
                        </div>
                        <div class="pd-view-detail-row">
                            <div class="pd-view-detail-icon blue"><i class="bx bx-store"></i></div>
                            <div>
                                <span class="pd-view-detail-label">Brand</span>
                                <span class="pd-view-detail-value" id="pdViewBrand">—</span>
                            </div>
                        </div>
                        <div class="pd-view-detail-row">
                            <div class="pd-view-detail-icon orange"><i class="bx bx-cube"></i></div>
                            <div>
                                <span class="pd-view-detail-label">Unit & Quantity</span>
                                <span class="pd-view-detail-value" id="pdViewUnit">—</span>
                            </div>
                        </div>
                        <div class="pd-view-detail-row">
                            <div class="pd-view-detail-icon green"><i class="bx bx-dollar-circle"></i></div>
                            <div>
                                <span class="pd-view-detail-label">Purchase Price</span>
                                <span class="pd-view-detail-value price" id="pdViewPurchasePrice">$0.00</span>
                            </div>
                        </div>
                        <div class="pd-view-detail-row">
                            <div class="pd-view-detail-icon purple"><i class="bx bx-wallet"></i></div>
                            <div>
                                <span class="pd-view-detail-label">Sell Price</span>
                                <span class="pd-view-detail-value price" id="pdViewSellPrice">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-view-modal-footer">
                    <button class="pd-btn pd-btn-light" onclick="pdCloseViewModal()">Close</button>
                    <a href="#" class="pd-btn pd-btn-primary" id="pdViewEditBtn">
                        <i class="bx bx-edit-alt"></i> Edit Product
                    </a>
                </div>
            </div>
        </div>

        <!-- ═══════ DELETE MODAL ═══════ -->
        <div class="pd-modal-overlay pd-delete-modal" id="pdDeleteModal">
            <div class="pd-modal">
                <div class="pd-delete-modal-body">
                    <div class="pd-delete-icon"><i class="bx bx-trash"></i></div>
                    <h4>Delete Product?</h4>
                    <p>You are about to delete</p>
                    <div class="pd-delete-name" id="pdDeleteName">"Product"</div>
                    <p style="font-size:12px;color:var(--gray-400);">This action cannot be undone.</p>
                    <div class="pd-delete-modal-actions">
                        <button class="pd-btn pd-btn-light" onclick="pdCloseDeleteModal()">
                            <i class="bx bx-x"></i> Cancel
                        </button>
                        <a href="#" class="pd-btn pd-btn-danger" id="pdDeleteConfirm">
                            <i class="bx bx-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Overlay (Mobile) -->
        <div class="pd-filter-overlay" id="pdFilterOverlay"></div>

    </div>
</div>

<!-- ═══════ SCRIPTS ═══════ -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ═══════ REFS ═══════
        const searchInput = document.getElementById('pdSearchInput');
        const searchClear = document.getElementById('pdSearchClear');
        const rows = document.querySelectorAll('.pd-data-row');
        const mobileCards = document.querySelectorAll('.pd-data-row-mobile');
        const gridItems = document.querySelectorAll('.pd-grid-item');
        const noResults = document.getElementById('pdNoResults');
        const selectAll = document.getElementById('pdSelectAll');
        const rowChecks = document.querySelectorAll('.pd-row-check');
        const bulkBar = document.getElementById('pdBulkBar');
        const selectedCount = document.getElementById('pdSelectedCount');
        const activeFiltersBar = document.getElementById('pdActiveFilters');
        const filterTags = document.getElementById('pdFilterTags');
        const filterDropdown = document.getElementById('pdFilterDropdown');
        const filterOverlay = document.getElementById('pdFilterOverlay');
        const perPageSelect = document.getElementById('pdPerPage');
        const paginationWrap = document.getElementById('pdPaginationWrap');
        const paginationInfo = document.getElementById('pdPaginationInfo');
        const paginationDiv = document.getElementById('pdPagination');
        const toolbarCount = document.querySelector('.pd-toolbar-count');
        let currentPage = 1;
        let currentQuery = '';
        let activeProductFilters = {
            category: '',
            unit: '',
            minPrice: 0,
            maxPrice: Infinity
        };

        function getPerPage() {
            const value = parseInt((perPageSelect && perPageSelect.value) || '25', 10);
            return Number.isFinite(value) && value > 0 ? value : 25;
        }

        function getDesktopRows() {
            return Array.from(document.querySelectorAll('.pd-data-row'));
        }

        function getMobileRows() {
            return Array.from(document.querySelectorAll('.pd-data-row-mobile'));
        }

        function getGridItems() {
            return Array.from(document.querySelectorAll('.pd-grid-item'));
        }

        function matchesProductFilters(item) {
            const query = currentQuery;
            const category = activeProductFilters.category;
            const unit = activeProductFilters.unit;
            const minPrice = activeProductFilters.minPrice;
            const maxPrice = activeProductFilters.maxPrice;
            const textMatch = query === '' ||
                (item.dataset.name || '').includes(query) ||
                (item.dataset.category || '').includes(query) ||
                (item.dataset.brand || '').includes(query);
            const categoryMatch = !category || (item.dataset.category || '') === category;
            const unitMatch = !unit || (item.dataset.unit || '') === unit;
            const price = parseFloat(item.dataset.price || '0') || 0;
            const priceMatch = price >= minPrice && price <= maxPrice;

            return textMatch && categoryMatch && unitMatch && priceMatch;
        }

        function addProductPageButton(label, page, extraClass = '') {
            if (!paginationDiv) return;
            const btn = document.createElement('button');
            btn.className = 'pd-page-btn' + (extraClass ? ' ' + extraClass : '') + (!page ? ' disabled' : '');
            btn.innerHTML = label;
            if (page && extraClass !== 'active') {
                btn.addEventListener('click', function () {
                    currentPage = page;
                    renderProductPagination();
                    document.querySelector('.pd-card')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            }
            paginationDiv.appendChild(btn);
        }

        function renderProductPagination() {
            const desktopRows = getDesktopRows();
            const mobileRowsList = getMobileRows();
            const gridRows = getGridItems();
            const filteredDesktop = desktopRows.filter(matchesProductFilters);
            const filteredMobile = mobileRowsList.filter(matchesProductFilters);
            const filteredGrid = gridRows.filter(matchesProductFilters);
            const total = filteredDesktop.length;
            const perPage = getPerPage();
            const totalPages = Math.max(1, Math.ceil(total / perPage));
            const start = (Math.min(currentPage, totalPages) - 1) * perPage;
            const end = start + perPage;

            currentPage = Math.min(Math.max(1, currentPage), totalPages);

            desktopRows.forEach(row => row.style.display = 'none');
            filteredDesktop.slice(start, end).forEach((row, index) => {
                row.style.display = '';
                const rowNum = row.querySelector('.pd-row-num');
                if (rowNum) rowNum.textContent = start + index + 1;
            });

            mobileRowsList.forEach(row => row.style.display = 'none');
            filteredMobile.slice(start, end).forEach(row => row.style.display = '');

            gridRows.forEach(item => item.style.display = 'none');
            filteredGrid.slice(start, end).forEach(item => item.style.display = '');

            if (toolbarCount) {
                toolbarCount.textContent = total + ' records';
            }

            if (noResults) {
                noResults.style.display = total === 0 ? 'block' : 'none';
            }

            if (paginationWrap) {
                paginationWrap.style.display = total > 0 ? '' : 'none';
            }

            if (paginationInfo) {
                const showStart = total > 0 ? start + 1 : 0;
                const showEnd = Math.min(end, total);
                paginationInfo.innerHTML = 'Showing <strong>' + showStart + '</strong> to <strong>' + showEnd + '</strong> of <strong>' + total + '</strong> products';
            }

            if (!paginationDiv) return;
            paginationDiv.innerHTML = '';

            if (totalPages <= 1) {
                return;
            }

            addProductPageButton('<i class="bx bx-chevrons-left"></i>', currentPage > 1 ? 1 : null);
            addProductPageButton('<i class="bx bx-chevron-left"></i>', currentPage > 1 ? currentPage - 1 : null);

            let pages = [];
            if (totalPages <= 7) {
                for (let i = 1; i <= totalPages; i++) pages.push(i);
            } else if (currentPage <= 3) {
                pages = [1, 2, 3, 4, '...', totalPages];
            } else if (currentPage >= totalPages - 2) {
                pages = [1, '...', totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
            } else {
                pages = [1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages];
            }

            pages.forEach(page => {
                if (page === '...') {
                    addProductPageButton('...', null);
                } else {
                    addProductPageButton(String(page), page, page === currentPage ? 'active' : '');
                }
            });

            addProductPageButton('<i class="bx bx-chevron-right"></i>', currentPage < totalPages ? currentPage + 1 : null);
            addProductPageButton('<i class="bx bx-chevrons-right"></i>', currentPage < totalPages ? totalPages : null);
        }

        // ═══════ SEARCH ═══════
        searchInput.addEventListener('input', function () {
            currentQuery = this.value.toLowerCase().trim();
            currentPage = 1;
            searchClear.classList.toggle('show', currentQuery !== '');
            renderProductPagination();
        });

        searchClear.addEventListener('click', function () {
            searchInput.value = '';
            searchClear.classList.remove('show');
            currentQuery = '';
            currentPage = 1;
            renderProductPagination();
            searchInput.focus();
        });

        function filterItems(query) {
            currentQuery = (query || '').toLowerCase().trim();
            currentPage = 1;
            renderProductPagination();
        }

        // ═══════ FILTER TOGGLE ═══════
        const filterToggle = document.getElementById('pdFilterToggle');
        if (filterToggle && filterDropdown && filterOverlay) {
            filterToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = filterDropdown.classList.contains('show');
                filterDropdown.classList.toggle('show', !isOpen);
                filterOverlay.classList.toggle('show', !isOpen && window.innerWidth <= 768);
            });

            filterOverlay.addEventListener('click', function () {
                filterDropdown.classList.remove('show');
                filterOverlay.classList.remove('show');
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('.pd-filter-btn')) {
                    filterDropdown.classList.remove('show');
                    filterOverlay.classList.remove('show');
                }
            });
        }

        // ═══════ APPLY FILTERS ═══════
        document.getElementById('pdApplyFilters').addEventListener('click', function () {
            const cat = document.getElementById('pdFilterCategory').value;
            const unit = document.getElementById('pdFilterUnit').value;
            const pMin = parseFloat(document.getElementById('pdPriceMin').value) || 0;
            const pMax = parseFloat(document.getElementById('pdPriceMax').value) || Infinity;

            let found = 0;
            let filtersOn = false;
            filterTags.innerHTML = '';

            const allItems = [...rows, ...mobileCards, ...gridItems];
            allItems.forEach(item => {
                let show = true;
                if (cat && (item.dataset.category || '') !== cat) show = false;
                if (unit && (item.dataset.unit || '') !== unit) show = false;
                const price = parseFloat(item.dataset.price) || 0;
                if (price < pMin || price > pMax) show = false;
                item.style.display = show ? '' : 'none';
                if (show) found++;
            });

            if (cat) { addFilterTag('Category: ' + cat); filtersOn = true; }
            if (unit) { addFilterTag('Unit: ' + unit.toUpperCase()); filtersOn = true; }
            if (pMin > 0 || pMax < Infinity) {
                addFilterTag('Price: $' + pMin + ' - $' + (pMax === Infinity ? '∞' : pMax));
                filtersOn = true;
            }

            activeFiltersBar.classList.toggle('show', filtersOn);
            noResults.style.display = found > 0 ? 'none' : 'block';
            filterDropdown.classList.remove('show');
            filterOverlay.classList.remove('show');
        });

        function addFilterTag(text) {
            const tag = document.createElement('span');
            tag.className = 'pd-filter-tag';
            tag.innerHTML = text + ' <button><i class="bx bx-x"></i></button>';
            tag.querySelector('button').addEventListener('click', function () {
                tag.remove();
                if (!filterTags.children.length) {
                    activeFiltersBar.classList.remove('show');
                    clearAllFilters();
                }
            });
            filterTags.appendChild(tag);
        }

        function clearAllFilters() {
            document.getElementById('pdFilterCategory').value = '';
            document.getElementById('pdFilterUnit').value = '';
            document.getElementById('pdPriceMin').value = '';
            document.getElementById('pdPriceMax').value = '';
            const allItems = [...rows, ...mobileCards, ...gridItems];
            allItems.forEach(item => item.style.display = '');
            noResults.style.display = 'none';
        }

        document.getElementById('pdClearFilters').addEventListener('click', function () {
            clearAllFilters();
            filterDropdown.classList.remove('show');
            filterOverlay.classList.remove('show');
        });

        document.getElementById('pdClearAllFilters').addEventListener('click', function () {
            clearAllFilters();
            activeFiltersBar.classList.remove('show');
            filterTags.innerHTML = '';
        });

        // ═══════ SELECT ALL ═══════
        selectAll.addEventListener('change', function () {
            rowChecks.forEach(cb => { cb.checked = this.checked; });
            updateBulk();
        });
        rowChecks.forEach(cb => cb.addEventListener('change', updateBulk));

        function updateBulk() {
            const checked = document.querySelectorAll('.pd-row-check:checked');
            const count = checked.length;
            bulkBar.classList.toggle('show', count > 0);
            selectedCount.textContent = count + ' selected';
            checked.forEach(cb => cb.closest('tr')?.classList.add('selected'));
            document.querySelectorAll('.pd-row-check:not(:checked)').forEach(cb =>
                cb.closest('tr')?.classList.remove('selected')
            );
        }

        // ═══════ VIEW TOGGLE ═══════
        const tableViewBtn = document.getElementById('pdTableViewBtn');
        const gridViewBtn = document.getElementById('pdGridViewBtn');
        const tableView = document.getElementById('pdTableView');
        const gridView = document.getElementById('pdGridView');

        tableViewBtn.addEventListener('click', function () {
            tableView.style.display = '';
            gridView.classList.remove('show');
            this.classList.add('active');
            gridViewBtn.classList.remove('active');
        });

        gridViewBtn.addEventListener('click', function () {
            gridView.classList.add('show');
            tableView.style.display = 'none';
            this.classList.add('active');
            tableViewBtn.classList.remove('active');
        });

        // ═══════ SORTING ═══════
        let sortState = {};
        document.querySelectorAll('.pd-table th.sortable').forEach(th => {
            th.addEventListener('click', function () {
                const key = this.dataset.sort;
                sortState[key] = !sortState[key];
                const icon = this.querySelector('.pd-sort-icon');
                icon.className = 'bx pd-sort-icon ' + (sortState[key] ? 'bx-sort-up' : 'bx-sort-down');
                icon.style.color = 'var(--primary)';

                const tbody = document.getElementById('pdTableBody');
                const arr = Array.from(tbody.querySelectorAll('.pd-data-row'));
                arr.sort((a, b) => {
                    let aV, bV;
                    if (key === 'id' || key === 'price') {
                        aV = parseFloat(key === 'price' ? a.dataset.price : a.dataset.id);
                        bV = parseFloat(key === 'price' ? b.dataset.price : b.dataset.id);
                        return sortState[key] ? aV - bV : bV - aV;
                    } else {
                        aV = a.dataset[key] || '';
                        bV = b.dataset[key] || '';
                        return sortState[key] ? aV.localeCompare(bV) : bV.localeCompare(aV);
                    }
                });
                arr.forEach(r => tbody.appendChild(r));
            });
        });

        // ═══════ VIEW MODAL ═══════
        document.querySelectorAll('.pd-view-trigger').forEach(btn => {
            btn.addEventListener('click', function () {
                const name = this.dataset.name;
                document.getElementById('pdViewAvatar').textContent = name.substring(0, 2).toUpperCase();
                document.getElementById('pdViewName').textContent = name;
                document.getElementById('pdViewId').textContent = String(this.dataset.id).padStart(4, '0');
                document.getElementById('pdViewCategory').textContent = this.dataset.category;
                document.getElementById('pdViewBrand').textContent = this.dataset.brand || '—';
                document.getElementById('pdViewUnit').textContent = this.dataset.unit + ' · ' + (this.dataset.qty || '0') + ' qty';
                document.getElementById('pdViewPurchasePrice').textContent = '$' + (this.dataset.purchasePrice || this.dataset.price);
                document.getElementById('pdViewSellPrice').textContent = '$' + (this.dataset.sellPrice || this.dataset.price);
                document.getElementById('pdViewEditBtn').href = '<?= base_url("index.php/admin/product/edit/") ?>' + this.dataset.id;
                document.getElementById('pdViewModal').classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        });

        window.pdCloseViewModal = function () {
            document.getElementById('pdViewModal').classList.remove('show');
            document.body.style.overflow = '';
        };

        // ═══════ DELETE MODAL ═══════
        document.querySelectorAll('.pd-delete-trigger').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('pdDeleteName').textContent = '"' + this.dataset.name + '"';
                document.getElementById('pdDeleteConfirm').href = '<?= base_url("index.php/admin/product/delete/") ?>' + this.dataset.id;
                document.getElementById('pdDeleteModal').classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        });

        window.pdCloseDeleteModal = function () {
            document.getElementById('pdDeleteModal').classList.remove('show');
            document.body.style.overflow = '';
        };

        // Close modals on overlay click
        document.querySelectorAll('.pd-modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });

        // ═══════ REFRESH ═══════
        document.getElementById('pdRefreshBtn').addEventListener('click', function () {
            this.querySelector('i').classList.add('bx-spin');
            setTimeout(() => location.reload(), 600);
        });

    });
</script>
