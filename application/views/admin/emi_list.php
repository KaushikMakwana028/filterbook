<div class="page-wrapper">
    <div class="page-content">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

            /* ══════════════════════════════════════
   Color Fix — Match site primary
══════════════════════════════════════ */
            .em-toolbar-title i,
            .em-toolbar-count,
            .em-filter-tab.active,
            .em-pagination-info,
            .em-act-btn {
                color: var(--primary, #6366f1) !important;
            }

            .em-toolbar-count {
                background: rgba(99, 102, 241, 0.1) !important;
                color: var(--primary, #6366f1) !important;
            }

            .em-filter-tab.active {
                color: var(--primary, #6366f1) !important;
            }

            .em-per-page select:focus,
            .em-search input:focus {
                border-color: var(--primary-light, #818cf8) !important;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08) !important;
            }

            .em-product-ico {
                background: rgba(99, 102, 241, 0.1) !important;
                color: var(--primary, #6366f1) !important;
            }

            .em-act-btn {
                background: rgba(99, 102, 241, 0.1) !important;
                color: var(--primary, #6366f1) !important;
            }

            .em-act-btn:hover {
                background: rgba(99, 102, 241, 0.18) !important;
                color: var(--primary-dark, #4f46e5) !important;
            }

            .em-page-btn.active {
                background: var(--primary, #6366f1) !important;
                border-color: var(--primary, #6366f1) !important;
            }

            .em-page-btn:hover:not(.active):not(.disabled) {
                color: var(--primary, #6366f1) !important;
            }

            /* ══════════════════════════════════════
   DARK THEME — EMI Page
══════════════════════════════════════ */
            [data-theme="dark"] .em-card {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .em-toolbar {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .em-toolbar-title {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .em-per-page {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-per-page select,
            [data-theme="dark"] .em-search input {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .em-search input::placeholder {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .em-search .search-icon {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .em-filter-tabs {
                background: var(--bg-tertiary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .em-filter-tab {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .em-filter-tab.active {
                background: var(--bg-secondary) !important;
                color: var(--primary) !important;
            }

            [data-theme="dark"] .em-table th {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .em-table td {
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .em-table tbody tr:hover {
                background: var(--bg-tertiary) !important;
            }

            [data-theme="dark"] .em-row-num {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-customer-name {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .em-customer-mobile {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .em-product-name {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-emi-num {
                background: var(--bg-tertiary) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-amount {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .em-currency {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .em-date {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-date i {
                color: var(--text-tertiary) !important;
            }

            [data-theme="dark"] .em-pagination-wrap {
                border-color: var(--border-color) !important;
            }

            [data-theme="dark"] .em-pagination-info strong {
                color: var(--text-primary) !important;
            }

            [data-theme="dark"] .em-page-btn {
                background: var(--bg-secondary) !important;
                border-color: var(--border-color) !important;
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-empty h4 {
                color: var(--text-secondary) !important;
            }

            [data-theme="dark"] .em-empty p,
            [data-theme="dark"] .em-no-results {
                color: var(--text-tertiary) !important;
            }

            .em-wrap {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 16px;
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            }

            .em-card {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 20px;
            }

            /* ── Toolbar ── */
            .em-toolbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
                gap: 14px;
                flex-wrap: wrap;
            }

            .em-toolbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .em-toolbar-title {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 17px;
                font-weight: 700;
                color: #1e293b;
            }

            .em-toolbar-title i {
                font-size: 20px;
                color: #2563eb;
            }

            .em-toolbar-count {
                background: #eff6ff;
                color: #2563eb;
                padding: 3px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .em-toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            /* ── Per Page ── */
            .em-per-page {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: #64748b;
                font-weight: 500;
            }

            .em-per-page select {
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

            .em-per-page select:focus {
                border-color: #93c5fd;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
            }

            /* ── Filter Tabs ── */
            .em-filter-tabs {
                display: flex;
                gap: 2px;
                background: #f1f5f9;
                border-radius: 8px;
                padding: 3px;
                border: 1px solid #e2e8f0;
            }

            .em-filter-tab {
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

            .em-filter-tab.active {
                background: #fff;
                color: #2563eb;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            }

            .em-filter-tab:hover:not(.active) {
                color: #64748b;
            }

            /* ── Search ── */
            .em-search {
                position: relative;
                min-width: 240px;
            }

            .em-search input {
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

            .em-search input::placeholder {
                color: #94a3b8;
            }

            .em-search input:focus {
                border-color: #93c5fd;
                background: #fff;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
            }

            .em-search .search-icon {
                position: absolute;
                left: 11px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 16px;
                pointer-events: none;
            }

            /* ── Table ── */
            .em-table-wrap {
                overflow-x: auto;
            }

            .em-table {
                width: 100%;
                border-collapse: collapse;
            }

            .em-table th {
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

            .em-table td {
                padding: 14px 16px;
                font-size: 13px;
                color: #334155;
                border-bottom: 1px solid #f1f5f9;
                font-weight: 500;
                vertical-align: middle;
            }

            .em-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .em-table tbody tr:hover {
                background: #fafbfd;
            }

            /* ── Row Num ── */
            .em-row-num {
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

            /* ── Customer Cell ── */
            .em-customer-cell {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .em-avatar {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                font-weight: 800;
                flex-shrink: 0;
                color: #fff;
                text-transform: uppercase;
                background: linear-gradient(135deg, #6366f1, #4f46e5);
            }

            .em-customer-name {
                font-weight: 600;
                color: #1e293b;
                font-size: 13px;
                display: block;
                margin-bottom: 1px;
            }

            .em-customer-mobile {
                font-size: 12px;
                color: #94a3b8;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 3px;
            }

            .em-customer-mobile i {
                font-size: 12px;
            }

            /* ── Product Cell ── */
            .em-product-cell {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .em-product-ico {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: #eff6ff;
                color: #2563eb;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                flex-shrink: 0;
            }

            .em-product-name {
                font-weight: 600;
                color: #334155;
                font-size: 13px;
            }

            /* ── EMI Number ── */
            .em-emi-num {
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

            .em-emi-num i {
                font-size: 13px;
            }

            /* ── Amount ── */
            .em-amount {
                font-weight: 700;
                color: #1e293b;
                font-size: 14px;
                white-space: nowrap;
            }

            .em-amount .em-currency {
                color: #94a3b8;
                font-weight: 500;
                font-size: 12px;
            }

            /* ── Date ── */
            .em-date {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 13px;
                color: #64748b;
                white-space: nowrap;
            }

            .em-date i {
                font-size: 14px;
                color: #94a3b8;
            }

            /* ── Status Badge ── */
            .em-badge {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 4px 12px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 700;
            }

            .em-badge i {
                font-size: 13px;
            }

            .em-badge.paid {
                background: #ecfdf5;
                color: #059669;
            }

            .em-badge.pending {
                background: #fffbeb;
                color: #d97706;
            }

            /* ── Action ── */
            .em-act-btn {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 6px 14px;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 600;
                text-decoration: none;
                background: #eff6ff;
                color: #2563eb;
                transition: all 0.15s ease;
                border: none;
                cursor: pointer;
            }

            .em-act-btn:hover {
                background: #dbeafe;
                color: #1d4ed8;
                text-decoration: none;
            }

            .em-act-btn i {
                font-size: 15px;
            }

            /* ── Empty ── */
            .em-empty {
                padding: 48px 20px;
                text-align: center;
            }

            .em-empty i {
                font-size: 36px;
                color: #cbd5e1;
                margin-bottom: 10px;
                display: block;
            }

            .em-empty h4 {
                margin: 0 0 4px;
                font-size: 15px;
                font-weight: 600;
                color: #475569;
            }

            .em-empty p {
                margin: 0;
                font-size: 13px;
                color: #94a3b8;
            }

            /* ── No Results ── */
            .em-no-results {
                display: none;
                text-align: center;
                padding: 36px 20px;
                color: #94a3b8;
                font-size: 13px;
                font-weight: 500;
            }

            .em-no-results i {
                font-size: 24px;
                display: block;
                margin-bottom: 6px;
                color: #cbd5e1;
            }

            /* ── Pagination ── */
            .em-pagination-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 20px;
                border-top: 1px solid #f1f5f9;
                gap: 12px;
                flex-wrap: wrap;
            }

            .em-pagination-info {
                font-size: 13px;
                color: #2563eb;
                font-weight: 500;
            }

            .em-pagination-info strong {
                color: #1e293b;
                font-weight: 700;
            }

            .em-pagination {
                display: flex;
                align-items: center;
                gap: 4px;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .em-page-btn {
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

            .em-page-btn:hover:not(.active):not(.disabled) {
                background: #f8fafc;
                border-color: #cbd5e1;
                color: #2563eb;
            }

            .em-page-btn.active {
                background: #2563eb;
                color: #fff;
                border-color: #2563eb;
            }

            .em-page-btn.disabled {
                opacity: 0.4;
                cursor: not-allowed;
                pointer-events: none;
            }

            .em-page-btn.nav-btn {
                font-size: 16px;
                color: #64748b;
            }

            /* ── Responsive ── */
            @media (max-width: 768px) {
                .em-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 16px;
                    gap: 10px;
                }

                .em-toolbar-left {
                    justify-content: space-between;
                }

                .em-toolbar-right {
                    flex-direction: column;
                    gap: 8px;
                }

                .em-search {
                    min-width: unset;
                    width: 100%;
                }

                .em-filter-tabs {
                    width: 100%;
                }

                .em-filter-tab {
                    flex: 1;
                    text-align: center;
                }

                .em-per-page {
                    width: 100%;
                    justify-content: space-between;
                }

                .em-per-page select {
                    flex: 1;
                    max-width: 120px;
                }

                .em-table-wrap {
                    overflow-x: auto;
                    overflow-y: hidden;
                    -webkit-overflow-scrolling: touch;
                }

                .em-table {
                    min-width: 920px;
                }

                .em-table th,
                .em-table td {
                    padding: 12px 10px;
                    font-size: 12px;
                }

                .em-table th {
                    font-size: 10px;
                }

                .em-customer-cell {
                    gap: 8px;
                    min-width: 180px;
                }

                .em-avatar {
                    width: 34px;
                    height: 34px;
                    border-radius: 9px;
                    font-size: 12px;
                }

                .em-customer-name,
                .em-product-name {
                    font-size: 12px;
                }

                .em-customer-mobile,
                .em-emi-num,
                .em-date,
                .em-badge,
                .em-act-btn {
                    font-size: 11px;
                }

                .em-product-cell {
                    min-width: 150px;
                }

                .em-product-ico {
                    width: 30px;
                    height: 30px;
                    border-radius: 8px;
                    font-size: 14px;
                }

                .em-amount {
                    font-size: 13px;
                    white-space: nowrap;
                }

                .em-act-btn {
                    padding: 6px 10px;
                    white-space: nowrap;
                }

                .em-pagination-wrap {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }
            }

            @media (max-width: 480px) {
                .em-wrap {
                    padding: 0 8px;
                }

                .em-toolbar {
                    padding: 12px;
                }

                .em-toolbar-title {
                    font-size: 15px;
                }

                .em-toolbar-title i {
                    font-size: 18px;
                }

                .em-toolbar-count {
                    font-size: 11px;
                    padding: 2px 8px;
                }
            }
        </style>

        <?php
        $totalRows = !empty($emis) ? count($emis) : 0;
        $totalPaid = 0;
        $totalPending = 0;
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
        if (!empty($emis)) {
            foreach ($emis as $emi) {
                $s = (string) ($emi->status ?? 0);
                if ($s === '1' || strtolower($s) === 'paid') {
                    $totalPaid++;
                } else {
                    $totalPending++;
                }
            }
        }
        $avatarColors = ['#6366f1', '#0d9488', '#e11d48', '#d97706', '#2563eb', '#059669', '#0284c7', '#db2777'];
        ?>

        <div class="em-wrap">
            <div class="em-card">
                <div class="em-toolbar">
                    <div class="em-toolbar-left">
                        <div class="em-toolbar-title">
                            <i class="bx bx-credit-card"></i> EMI Records
                        </div>
                        <span class="em-toolbar-count" id="emToolbarCount">
                            <?= $totalRows ?> records
                        </span>
                    </div>
                    <div class="em-toolbar-right">
                        <div class="em-per-page">
                            <span>Show</span>
                            <select id="emPerPage">
                                <option value="10" selected>10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="em-per-page">
                            <span>Month</span>
                            <select id="emMonthFilter">
                                <?php foreach ($monthOptions as $monthNumber => $monthLabel): ?>
                                    <option value="<?= $monthNumber ?>" <?= $monthNumber === $currentMonth ? 'selected' : '' ?>>
                                        <?= $monthLabel ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="em-filter-tabs" id="emFilterTabs">
                            <button class="em-filter-tab active" data-filter="all">All (
                                <?= $totalRows ?>)
                            </button>
                            <button class="em-filter-tab" data-filter="pending">Pending (
                                <?= $totalPending ?>)
                            </button>
                            <button class="em-filter-tab" data-filter="paid">Paid (
                                <?= $totalPaid ?>)
                            </button>
                        </div>
                        <div class="em-search">
                            <input type="text" id="emSearchInput" placeholder="Search name, product, amount...">
                            <i class="bx bx-search search-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="em-table-wrap" id="emTableView">
                    <table class="em-table" id="emTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>EMI No.</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="emTableBody">
                            <?php if (!empty($emis)): ?>
                                <?php foreach ($emis as $index => $e):
                                    $amount = isset($e->emi_amount) && $e->emi_amount !== null && $e->emi_amount !== ''
                                        ? (float) $e->emi_amount
                                        : ((isset($e->amount) && $e->amount !== null && $e->amount !== '') ? (float) $e->amount : 0);
                                    $status = ((string) ($e->status ?? 0) === '1' || strtolower((string) ($e->status ?? '')) === 'paid') ? 'paid' : 'pending';
                                    $statusLabel = $status === 'paid' ? 'Paid' : 'Pending';
                                    $dateValue = !empty($e->emi_date) ? $e->emi_date : (!empty($e->due_date) ? $e->due_date : '');
                                    $monthValue = !empty($dateValue) ? (int) date('n', strtotime($dateValue)) : 0;
                                    $customerName = $e->customer_name ?? ('Customer #' . ($e->customer_id ?? ''));
                                    $initials = strtoupper(substr(trim($customerName), 0, 2));
                                    $bgColor = $avatarColors[$index % count($avatarColors)];
                                ?>
                                    <tr class="em-data-row" data-status="<?= $status ?>" data-month="<?= $monthValue ?>">
                                        <td><span class="em-row-num"></span></td>
                                        <td>
                                            <div class="em-customer-cell">
                                                <div class="em-avatar" style="background:<?= $bgColor ?>">
                                                    <?= htmlspecialchars($initials) ?>
                                                </div>
                                                <div>
                                                    <span class="em-customer-name">
                                                        <?= htmlspecialchars($customerName) ?>
                                                    </span>
                                                    <span class="em-customer-mobile">
                                                        <i class="bx bx-phone"></i>
                                                        <?= htmlspecialchars($e->customer_mobile ?? '-') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="em-product-cell">
                                                <div class="em-product-ico"><i class="bx bx-package"></i></div>
                                                <span class="em-product-name">
                                                    <?= htmlspecialchars($e->product_name ?? '-') ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="em-emi-num">
                                                <i class="bx bx-hash"></i>
                                                <?= isset($e->emi_number) ? (int) $e->emi_number : '-' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="em-amount">
                                                <span class="em-currency">₹</span>
                                                <?= number_format($amount, 2) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="em-date">
                                                <i class="bx bx-calendar"></i>
                                                <?= !empty($dateValue) ? date('d M Y', strtotime($dateValue)) : '—' ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="em-badge <?= $status ?>">
                                                <i
                                                    class="bx <?= $status === 'paid' ? 'bx-check-circle' : 'bx-time-five' ?>"></i>
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td style="text-align:center">
                                            <a href="<?= site_url('admin/emi/view/' . $e->id) ?>" class="em-act-btn">
                                                <i class="bx bx-show"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="em-empty">
                                            <i class="bx bx-credit-card"></i>
                                            <h4>No EMI Records Found</h4>
                                            <p>There are no installment records to display at the moment.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="em-no-results" id="emNoResults">
                    <i class="bx bx-search-alt"></i>
                    No records match your search or filter.
                </div>

                <div class="em-pagination-wrap" id="emPaginationWrap" style="display:none;">
                    <div class="em-pagination-info" id="emPaginationInfo"></div>
                    <div class="em-pagination" id="emPagination"></div>
                </div>
            </div>
        </div>

        <script>
            (function() {
                let currentPage = 1;
                let currentFilter = 'all';
                let searchQuery = '';

                const allRows = Array.from(document.querySelectorAll('.em-data-row'));
                const perPageSelect = document.getElementById('emPerPage');
                const monthFilterSelect = document.getElementById('emMonthFilter');
                const searchInput = document.getElementById('emSearchInput');
                const filterTabs = document.getElementById('emFilterTabs');
                const noResults = document.getElementById('emNoResults');
                const toolbarCount = document.getElementById('emToolbarCount');
                const paginationWrap = document.getElementById('emPaginationWrap');
                const paginationInfo = document.getElementById('emPaginationInfo');
                const paginationDiv = document.getElementById('emPagination');
                const tableView = document.getElementById('emTableView');

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

                    allRows.forEach(r => r.style.display = 'none');

                    pageRows.forEach((row, i) => {
                        row.style.display = '';
                        row.querySelector('.em-row-num').textContent = start + i + 1;
                    });

                    toolbarCount.textContent = total + ' records';
                    noResults.style.display = total === 0 ? 'block' : 'none';
                    tableView.style.display = total === 0 ? 'none' : '';

                    if (total > 0) {
                        paginationWrap.style.display = '';
                    } else {
                        paginationWrap.style.display = 'none';
                    }

                    const showStart = total > 0 ? start + 1 : 0;
                    paginationInfo.innerHTML = 'Showing <strong>' + showStart + '</strong> to <strong>' + end + '</strong> of <strong>' + total + '</strong> EMIs';

                    paginationDiv.innerHTML = '';
                    if (totalPages <= 1) return;

                    addBtn('<i class="bx bx-chevron-left"></i>', currentPage > 1 ? currentPage - 1 : null, 'nav-btn');

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

                    pages.forEach(p => {
                        if (p === '...') {
                            const dots = document.createElement('span');
                            dots.className = 'em-page-btn disabled';
                            dots.textContent = '...';
                            paginationDiv.appendChild(dots);
                        } else {
                            addBtn(p, p, p === currentPage ? 'active' : '');
                        }
                    });

                    addBtn('<i class="bx bx-chevron-right"></i>', currentPage < totalPages ? currentPage + 1 : null, 'nav-btn');
                }

                function addBtn(label, page, extraClass) {
                    const btn = document.createElement('button');
                    btn.className = 'em-page-btn' + (extraClass ? ' ' + extraClass : '') + (!page ? ' disabled' : '');
                    btn.innerHTML = label;
                    if (page && extraClass !== 'active') {
                        btn.onclick = function() {
                            currentPage = page;
                            render();
                            document.querySelector('.em-card').scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        };
                    }
                    paginationDiv.appendChild(btn);
                }

                // Search
                searchInput.addEventListener('input', function() {
                    searchQuery = this.value.toLowerCase().trim();
                    currentPage = 1;
                    render();
                });

                // Per page
                perPageSelect.addEventListener('change', function() {
                    currentPage = 1;
                    render();
                });

                monthFilterSelect.addEventListener('change', function() {
                    currentPage = 1;
                    render();
                });

                // Filters
                filterTabs.addEventListener('click', function(e) {
                    const tab = e.target.closest('.em-filter-tab');
                    if (!tab) return;
                    filterTabs.querySelectorAll('.em-filter-tab').forEach(t => t.classList.remove('active'));
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

                render();
            })();
        </script>
    </div>
</div>